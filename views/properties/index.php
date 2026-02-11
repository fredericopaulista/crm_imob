<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Imóveis</h1>
        <p class="mt-2 text-sm text-gray-700">Lista completa de imóveis cadastrados no sistema.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="<?php echo APP_URL; ?>/painel/imoveis/novo" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <i class="fas fa-plus mr-1"></i> Novo Imóvel
        </a>
    </div>
</div>

<!-- Search Filter -->
<div class="mt-6 bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-lg p-4">
    <form method="GET" action="<?php echo APP_URL; ?>/painel/imoveis" class="grid grid-cols-1 gap-4 sm:grid-cols-4">
        <div>
            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Buscar por Nome</label>
            <input type="text" name="search" id="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 border" 
                   placeholder="Digite o título...">
        </div>
        
        <div>
            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
            <select name="type" id="type" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 border">
                <option value="">Todos os tipos</option>
                <option value="Apartamento" <?php echo (isset($_GET['type']) && $_GET['type'] == 'Apartamento') ? 'selected' : ''; ?>>Apartamento</option>
                <option value="Casa" <?php echo (isset($_GET['type']) && $_GET['type'] == 'Casa') ? 'selected' : ''; ?>>Casa</option>
                <option value="Cobertura" <?php echo (isset($_GET['type']) && $_GET['type'] == 'Cobertura') ? 'selected' : ''; ?>>Cobertura</option>
                <option value="Sobrado" <?php echo (isset($_GET['type']) && $_GET['type'] == 'Sobrado') ? 'selected' : ''; ?>>Sobrado</option>
                <option value="Loft" <?php echo (isset($_GET['type']) && $_GET['type'] == 'Loft') ? 'selected' : ''; ?>>Loft</option>
            </select>
        </div>
        
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
            <select name="status" id="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 border">
                <option value="">Todos os status</option>
                <option value="available" <?php echo (isset($_GET['status']) && $_GET['status'] == 'available') ? 'selected' : ''; ?>>Disponível</option>
                <option value="sold" <?php echo (isset($_GET['status']) && $_GET['status'] == 'sold') ? 'selected' : ''; ?>>Vendido</option>
                <option value="rented" <?php echo (isset($_GET['status']) && $_GET['status'] == 'rented') ? 'selected' : ''; ?>>Alugado</option>
                <option value="unavailable" <?php echo (isset($_GET['status']) && $_GET['status'] == 'unavailable') ? 'selected' : ''; ?>>Indisponível</option>
            </select>
        </div>
        
        <div class="flex items-end gap-2">
            <button type="submit" class="flex-1 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                <i class="fas fa-search mr-1"></i> Filtrar
            </button>
            <a href="<?php echo APP_URL; ?>/painel/imoveis" class="rounded-md bg-gray-200 px-3 py-2 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-300">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </form>
</div>


<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Título</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tipo</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Finalidade</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Valor</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($properties as $property): ?>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo $property['title']; ?></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $property['type']; ?></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo $property['purpose'] == 'sale' ? 'bg-green-50 text-green-700 ring-green-600/20' : 'bg-blue-50 text-blue-700 ring-blue-600/20'; ?>">
                                    <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div class="flex items-center gap-x-2">
                                    <div class="h-1.5 w-1.5 rounded-full <?php echo $property['status'] == 'available' ? 'bg-emerald-500' : 'bg-gray-400'; ?>"></div>
                                    <span class="capitalize"><?php 
                                        $statusLabels = [
                                            'available' => 'Disponível',
                                            'sold' => 'Vendido',
                                            'rented' => 'Alugado',
                                            'reserved' => 'Reservado',
                                            'unavailable' => 'Indisponível'
                                        ];
                                        echo $statusLabels[$property['status']] ?? ucfirst($property['status']);
                                    ?></span>
                                </div>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="<?php echo APP_URL; ?>/painel/imoveis/editar?id=<?php echo $property['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i><span class="sr-only">Editar, <?php echo $property['title']; ?></span></a>
                                <a href="<?php echo APP_URL; ?>/painel/imoveis/excluir?id=<?php echo $property['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este imóvel?');"><i class="fas fa-trash"></i><span class="sr-only">Excluir, <?php echo $property['title']; ?></span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
