<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Gerenciar Perfis de Acesso</h1>
        <p class="mt-2 text-sm text-gray-700">Defina quais funções cada tipo de usuário pode acessar.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="<?php echo APP_URL; ?>/perfis/novo" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <i class="fas fa-plus mr-1"></i> Novo Perfil
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
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nome do Perfil</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Descrição</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($roles as $role): ?>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <?php echo $role['name']; ?>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $role['description']; ?></td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="<?php echo APP_URL; ?>/perfis/editar?id=<?php echo $role['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i><span class="sr-only">Editar, <?php echo $role['name']; ?></span></a>
                                <?php if ($role['name'] !== 'Admin'): // Prevent deleting Admin role ?>
                                <a href="<?php echo APP_URL; ?>/perfis/excluir?id=<?php echo $role['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este perfil? Usuários vinculados a ele podem perder acesso.');" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i><span class="sr-only">Excluir, <?php echo $role['name']; ?></span></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
