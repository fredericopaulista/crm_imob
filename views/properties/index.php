<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Lista de Imóveis</h2>
        <a href="<?php echo APP_URL; ?>/property/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Novo Imóvel</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Título</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Finalidade</th>
                    <th class="px-4 py-3">Preço</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                <?php foreach ($properties as $property): ?>
                <tr class="text-gray-700">
                    <td class="px-4 py-3"><?php echo $property['title']; ?></td>
                    <td class="px-4 py-3"><?php echo $property['type']; ?></td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 font-semibold leading-tight text-white <?php echo $property['purpose'] == 'sale' ? 'bg-green-500' : 'bg-orange-500'; ?> rounded-full text-xs">
                            <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                        </span>
                    </td>
                    <td class="px-4 py-3">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></td>
                    <td class="px-4 py-3">
                         <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full text-xs">
                            <?php echo ucfirst($property['status']); ?>
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-2"><i class="fas fa-edit"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
