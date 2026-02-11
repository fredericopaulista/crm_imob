<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Gerenciar Usuários</h1>
        <p class="mt-2 text-sm text-gray-700">Lista de usuários com acesso ao sistema.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="<?php echo APP_URL; ?>/usuarios/novo" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
            <i class="fas fa-plus mr-1"></i> Novo Usuário
        </a>
    </div>
</div>

<?php if (isset($_GET['error']) && $_GET['error'] == 'cannot_delete_self'): ?>
<div class="rounded-md bg-red-50 p-4 mt-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-times-circle text-red-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-red-800">Ação não permitida</h3>
            <div class="mt-2 text-sm text-red-700">
                <p>Você não pode excluir seu próprio usuário enquanto estiver logado.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nome</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">E-mail</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Função</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Data de Criação</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <img class="h-10 w-10 rounded-full bg-gray-100" src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=random" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="font-medium text-gray-900"><?php echo $user['name']; ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $user['email']; ?></td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <?php $roleName = $user['role_name'] ?? 'Sem Perfil'; ?>
                                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo strcasecmp($roleName, 'Admin') === 0 ? 'bg-purple-50 text-purple-700 ring-purple-600/20' : 'bg-blue-50 text-blue-700 ring-blue-600/20'; ?>">
                                    <?php echo htmlspecialchars($roleName); ?>
                                </span>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo date('d/m/Y H:i', strtotime($user['created_at'])); ?></td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <a href="<?php echo APP_URL; ?>/usuarios/editar?id=<?php echo $user['id']; ?>" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i><span class="sr-only">Editar, <?php echo $user['name']; ?></span></a>
                                <a href="<?php echo APP_URL; ?>/usuarios/excluir?id=<?php echo $user['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i><span class="sr-only">Excluir, <?php echo $user['name']; ?></span></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
