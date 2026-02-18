<?php
// views/leads/kanban.php
?>
<div class="flex flex-col h-[calc(100vh-140px)]">
    <!-- Header / Controls -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Funil de Vendas</h2>
            <p class="text-sm text-gray-500">Arraste os cards para mover os leads entre as etapas.</p>
        </div>
        <div class="flex gap-2">
            <a href="<?php echo APP_URL; ?>/painel/leads?view=list" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm font-medium">
                <i class="fas fa-list mr-2"></i> Lista
            </a>
            <a href="<?php echo APP_URL; ?>/painel/leads?view=kanban" class="px-3 py-2 bg-brand-50 border border-brand-200 text-brand-700 rounded-lg text-sm font-medium">
                <i class="fas fa-columns mr-2"></i> Kanban
            </a>
            <a href="<?php echo APP_URL; ?>/painel/leads?view=settings" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm font-medium">
                <i class="fas fa-cog mr-2"></i> Etapas
            </a>
            <a href="<?php echo APP_URL; ?>/painel/leads/novo" class="px-4 py-2 bg-brand-600 text-white rounded-lg hover:bg-brand-700 transition-colors text-sm font-medium shadow-sm">
                <i class="fas fa-plus mr-2"></i> Novo Lead
            </a>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="flex-1 overflow-x-auto overflow-y-hidden">
        <div class="inline-flex h-full gap-4 pb-4 px-1 min-w-full">
            <?php foreach ($stages as $stage): ?>
                <div class="flex flex-col w-72 md:w-80 flex-shrink-0 bg-gray-100 rounded-xl border border-gray-200 max-h-full">
                    <!-- Column Header -->
                    <div class="p-3 border-b border-gray-200 flex justify-between items-center bg-white rounded-t-xl">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full" style="background-color: <?php echo $stage['color']; ?>"></div>
                            <h3 class="font-semibold text-gray-700 text-sm truncate uppercase tracking-wide"><?php echo htmlspecialchars($stage['name']); ?></h3>
                            <span class="text-xs text-gray-400 font-medium ml-1 bg-gray-100 px-2 py-0.5 rounded-full">
                                <?php echo isset($leadsByStage[$stage['id']]) ? count($leadsByStage[$stage['id']]) : 0; ?>
                            </span>
                        </div>
                    </div>

                    <!-- Draggable Area -->
                    <div class="flex-1 overflow-y-auto p-3 space-y-3 kanban-column" data-stage-id="<?php echo $stage['id']; ?>">
                        <?php if (isset($leadsByStage[$stage['id']])): ?>
                            <?php foreach ($leadsByStage[$stage['id']] as $lead): ?>
                                <div class="kanban-card bg-white p-4 rounded-lg shadow-sm border border-gray-200 cursor-move hover:shadow-md transition-shadow group relative" data-lead-id="<?php echo $lead['id']; ?>">
                                    <div class="flex justify-between items-start mb-2">
                                        <h4 class="font-semibold text-gray-800 text-sm hover:text-brand-600">
                                            <a href="<?php echo APP_URL; ?>/painel/leads/editar?id=<?php echo $lead['id']; ?>" class="focus:outline-none">
                                                <span class="absolute inset-0" aria-hidden="true"></span>
                                                <?php echo htmlspecialchars($lead['name']); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    
                                    <?php if (!empty($lead['phone'])): ?>
                                    <div class="flex items-center text-xs text-gray-500 mb-1">
                                        <i class="fab fa-whatsapp text-green-500 mr-1.5 w-3"></i>
                                        <?php echo htmlspecialchars($lead['phone']); ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (!empty($lead['origin'])): ?>
                                    <div class="mt-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-800">
                                        <?php echo htmlspecialchars($lead['origin']); ?>
                                    </div>
                                    <?php endif; ?>

                                    <div class="mt-3 text-[10px] text-gray-400 flex justify-between items-center border-t border-gray-100 pt-2">
                                        <span><?php echo date('d/m H:i', strtotime($lead['created_at'])); ?></span>
                                        <a href="<?php echo APP_URL; ?>/painel/leads/editar?id=<?php echo $lead['id']; ?>" class="text-gray-400 hover:text-brand-600 relative z-10 transition-colors">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- SortableJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const columns = document.querySelectorAll('.kanban-column');
        
        columns.forEach(column => {
            new Sortable(column, {
                group: 'kanban',
                animation: 150,
                ghostClass: 'bg-blue-50',
                delay: 100, // Slight delay to prevent accidental drags on click
                delayOnTouchOnly: true,
                onEnd: function(evt) {
                    const itemEl = evt.item;
                    const newStageId = evt.to.getAttribute('data-stage-id');
                    const leadId = itemEl.getAttribute('data-lead-id');
                    
                    // Update server
                    if (newStageId && leadId) {
                        updateLeadStage(leadId, newStageId);
                        
                        // Update counts (optional visual enhancement)
                        updateColumnCounts();
                    }
                }
            });
        });

        function updateLeadStage(leadId, stageId) {
            fetch('<?php echo APP_URL; ?>/painel/leads/atualizar-etapa', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    lead_id: leadId,
                    stage_id: stageId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('Erro ao atualizar etapa. Recarregue a página.');
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Erro de conexão. Tente novamente.');
                location.reload();
            });
        }
        
        function updateColumnCounts() {
             document.querySelectorAll('.kanban-column').forEach(col => {
                 const count = col.querySelectorAll('.kanban-card').length;
                 const stageId = col.getAttribute('data-stage-id');
                 // This assumes the counter is the only span with bg-gray-100 inside the header container
                 // A more robust selector would be better, but this works for this DOM structure
                 const header = col.parentElement.querySelector('.rounded-t-xl');
                 if(header) {
                     const counter = header.querySelector('span.rounded-full');
                     if(counter) counter.textContent = count;
                 }
             });
        }
    });
</script>
