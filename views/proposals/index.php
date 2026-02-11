<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Gerenciar Propostas</h2>
        <a href="<?php echo APP_URL; ?>/proposal/create" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Nova Proposta</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">Imóvel</th>
                    <th class="px-4 py-3">Valor Proposto</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                <?php foreach ($proposals as $proposal): ?>
                <tr class="text-gray-700">
                    <td class="px-4 py-3"><?php echo $proposal['client_name']; ?></td>
                    <td class="px-4 py-3 text-sm"><?php echo $proposal['property_title']; ?></td>
                    <td class="px-4 py-3 font-bold">R$ <?php echo number_format($proposal['value'], 2, ',', '.'); ?></td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">
                            <?php echo ucfirst($proposal['status']); ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-2" title="Editar"><i class="fas fa-edit"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900 mr-2" title="PDF"><i class="fas fa-file-pdf"></i></a>
                         <a href="#" class="text-green-600 hover:text-green-900" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
