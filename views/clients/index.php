<div class="bg-white p-6 rounded shadow">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Lista de Clientes</h2>
        <a href="<?php echo APP_URL; ?>/client/create" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Novo Cliente</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                    <th class="px-4 py-3">Nome</th>
                    <th class="px-4 py-3">Telefone</th>
                    <th class="px-4 py-3">Tipo</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y">
                <?php foreach ($clients as $client): ?>
                <tr class="text-gray-700">
                    <td class="px-4 py-3">
                        <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold"><?php echo $client['name']; ?></p>
                                <p class="text-xs text-gray-600"><?php echo $client['email']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm"><?php echo $client['phone']; ?></td>
                    <td class="px-4 py-3 text-xs">
                        <span class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full">
                            <?php echo ucfirst($client['type']); ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm"><?php echo ucfirst($client['status']); ?></td>
                    <td class="px-4 py-3 text-sm">
                        <a href="#" class="text-blue-600 hover:text-blue-900 mr-2"><i class="fas fa-edit"></i></a>
                        <a href="#" class="text-green-600 hover:text-green-900 mr-2"><i class="fab fa-whatsapp"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
