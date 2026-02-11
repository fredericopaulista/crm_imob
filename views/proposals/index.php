<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Propostas Comerciais</h1>
        <p class="mt-2 text-sm text-gray-700">Histórico de todas as propostas emitidas.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="<?php echo APP_URL; ?>/painel/propostas/novo" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <i class="fas fa-plus mr-1"></i> Nova Proposta
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
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Cliente</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Imóvel</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Valor Proposto</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($proposals as $proposal): ?>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <?php echo $proposal['client_name']; ?>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <?php echo $proposal['property_title']; ?>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-gray-900">
                                R$ <?php echo number_format($proposal['value'], 2, ',', '.'); ?>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo $proposal['status'] == 'sent' ? 'bg-yellow-50 text-yellow-700 ring-yellow-600/20' : ($proposal['status'] == 'approved' ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-gray-50 text-gray-700 ring-gray-600/20'); ?>">
                                    <?php echo ucfirst($proposal['status']); ?>
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="<?php echo APP_URL; ?>/painel/propostas/pdf?id=<?php echo $proposal['id']; ?>" target="_blank" class="text-red-600 hover:text-red-900 mr-3" title="PDF"><i class="fas fa-file-pdf"></i></a>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
