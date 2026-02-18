<?php
// views/leads/stages.php
?>
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Configurar Etapas do Funil</h2>
            <p class="text-sm text-gray-500 mt-1">Gerencie as etapas do seu funil de vendas. Arraste para reordenar.</p>
        </div>
        <a href="<?php echo APP_URL; ?>/painel/leads?view=kanban" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
            <i class="fas fa-arrow-left"></i> Voltar para o Funil
        </a>
    </div>

    <!-- Create New Stage -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Adicionar Nova Etapa</h3>
        <form action="<?php echo APP_URL; ?>/painel/leads/etapas/salvar" method="POST" class="flex gap-4 items-end">
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome da Etapa</label>
                <input type="text" name="name" id="name" required class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500" placeholder="Ex: Negociação">
            </div>
            <div>
                 <label for="color" class="block text-sm font-medium text-gray-700 mb-1">Cor</label>
                 <input type="color" name="color" id="color" value="#3B82F6" class="h-10 w-20 rounded-lg border border-gray-300 cursor-pointer p-1">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm transition-colors">
                Adicionar
            </button>
        </form>
    </div>

    <!-- manage Stages -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <ul id="stages-list" class="divide-y divide-gray-100">
            <?php foreach ($stages as $stage): ?>
                <li class="p-4 flex items-center justify-between hover:bg-gray-50 group transition-colors stage-item" data-id="<?php echo $stage['id']; ?>">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="cursor-move text-gray-400 hover:text-gray-600 p-2 handle">
                            <i class="fas fa-grip-vertical"></i>
                        </div>
                        
                        <form action="<?php echo APP_URL; ?>/painel/leads/etapas/atualizar" method="POST" class="flex-1 flex gap-4 items-center">
                            <input type="hidden" name="id" value="<?php echo $stage['id']; ?>">
                            <div class="w-6 h-6 rounded-full flex-shrink-0 border border-gray-200 shadow-sm" style="background-color: <?php echo $stage['color']; ?>">
                                <input type="color" name="color" value="<?php echo $stage['color']; ?>" class="opacity-0 w-full h-full cursor-pointer" onchange="this.form.submit()">
                            </div>
                            <input type="text" name="name" value="<?php echo htmlspecialchars($stage['name']); ?>" class="flex-1 border-none bg-transparent focus:ring-0 font-medium text-gray-800 p-0 hover:bg-white focus:bg-white transition-colors rounded" onchange="this.form.submit()">
                        </form>
                    </div>

                    <div class="flex items-center gap-2">
                        <?php if (!$stage['is_system']): ?>
                            <a href="<?php echo APP_URL; ?>/painel/leads/etapas/excluir?id=<?php echo $stage['id']; ?>" class="p-2 text-gray-400 hover:text-red-600 transition-colors" onclick="return confirm('Tem certeza? Os leads desta etapa precisarão ser movidos.')">
                                <i class="fas fa-trash"></i>
                            </a>
                        <?php else: ?>
                            <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded-full" title="Etapa padrão do sistema não pode ser excluída">Sistema</span>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('stages-list');
        var sortable = new Sortable(el, {
            handle: '.handle',
            animation: 150,
            onEnd: function() {
                var order = sortable.toArray(); // Returns array of data-id
                
                fetch('<?php echo APP_URL; ?>/painel/leads/etapas/reordenar', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ stages: order })
                });
            }
        });
    });
</script>
