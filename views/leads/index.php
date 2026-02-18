<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gestão de Leads</h2>
    <div class="flex gap-2">
        <a href="<?php echo APP_URL; ?>/painel/leads?view=list" class="px-3 py-2 bg-brand-50 border border-brand-200 text-brand-700 rounded-lg text-sm font-medium">
            <i class="fas fa-list mr-2"></i> Lista
        </a>
        <a href="<?php echo APP_URL; ?>/painel/leads?view=kanban" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm font-medium">
            <i class="fas fa-columns mr-2"></i> Kanban
        </a>
        <a href="<?php echo APP_URL; ?>/painel/leads?view=settings" class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors text-sm font-medium">
            <i class="fas fa-cog mr-2"></i> Etapas
        </a>
        <a href="<?php echo APP_URL; ?>/painel/leads/novo" class="bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Novo Lead
        </a>
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nome</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Contato</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Origem</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full bg-gray-100" src="https://ui-avatars.com/api/?name=<?php echo urlencode($lead['name']); ?>&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900"><?php echo $lead['name']; ?></div>
                                        <div class="text-gray-500"><?php echo $lead['email']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="text-gray-900"><?php echo $lead['phone']; ?></div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                                    <?php echo $lead['origin'] ?? 'Não informado'; ?>
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <?php 
                                    $statusLabels = [
                                        'new' => ['label' => 'Novo', 'color' => 'green'],
                                        'contacted' => ['label' => 'Contatado', 'color' => 'blue'],
                                        'negotiation' => ['label' => 'Negociação', 'color' => 'yellow'],
                                        'closed' => ['label' => 'Fechado', 'color' => 'purple'],
                                        'lost' => ['label' => 'Perdido', 'color' => 'red']
                                    ];
                                    $status = $statusLabels[$lead['status']] ?? ['label' => ucfirst($lead['status']), 'color' => 'gray'];
                                ?>
                                <span class="inline-flex items-center rounded-md bg-<?php echo $status['color']; ?>-50 px-2 py-1 text-xs font-medium text-<?php echo $status['color']; ?>-700 ring-1 ring-inset ring-<?php echo $status['color']; ?>-700/10">
                                    <?php echo $status['label']; ?>
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <button onclick="convertLead(<?php echo $lead['id']; ?>, '<?php echo $lead['name']; ?>')" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-exchange-alt"></i> Converter
                                </button>
                                <a href="<?php echo APP_URL; ?>/painel/leads/editar?id=<?php echo $lead['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="<?php echo APP_URL; ?>/painel/leads/excluir?id=<?php echo $lead['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este lead?');">
                                    <i class="fas fa-trash"></i> Excluir
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Conversão -->
<div id="convertModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Converter Lead em Cliente</h3>
        <p class="text-sm text-gray-500 mb-4">Selecione o tipo de cliente:</p>
        <form id="convertForm" method="POST" action="<?php echo APP_URL; ?>/painel/leads/converter">
            <input type="hidden" name="id" id="convertLeadId">
            <div class="space-y-3">
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="new_type" value="buyer" class="mr-3" required>
                    <div>
                        <div class="font-medium">Comprador</div>
                        <div class="text-sm text-gray-500">Cliente interessado em comprar imóvel</div>
                    </div>
                </label>
                <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                    <input type="radio" name="new_type" value="tenant" class="mr-3" required>
                    <div>
                        <div class="font-medium">Locatário</div>
                        <div class="text-sm text-gray-500">Cliente interessado em alugar imóvel</div>
                    </div>
                </label>
            </div>
            <div class="mt-6 flex gap-3">
                <button type="button" onclick="closeConvertModal()" class="flex-1 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    Cancelar
                </button>
                <button type="submit" class="flex-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    Converter
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function convertLead(id, name) {
    document.getElementById('convertLeadId').value = id;
    document.getElementById('convertModal').classList.remove('hidden');
}

function closeConvertModal() {
    document.getElementById('convertModal').classList.add('hidden');
}
</script>
