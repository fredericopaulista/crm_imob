<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Editar Usuário</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Atualize as informações do usuário.</p>
        </div>

        <form action="<?php echo APP_URL; ?>/painel/usuarios/atualizar" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome Completo</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">E-mail</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha (Nova)</label>
                        <div class="mt-2">
                            <input type="password" name="password" id="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                         <p class="mt-2 text-sm text-gray-500">Deixe em branco para manter a senha atual.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="role_id" class="block text-sm font-medium leading-6 text-gray-900">Função/Perfil</label>
                        <div class="mt-2">
                            <select id="role_id" name="role_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <?php foreach ($roles as $role): ?>
                                <option value="<?php echo $role['id']; ?>" <?php echo $user['role_id'] == $role['id'] ? 'selected' : ''; ?>><?php echo $role['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Author Profile Fields -->
                    <div class="col-span-full border-t border-gray-900/10 pt-8 mt-4">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Perfil de Autor (Blog)</h3>
                        <p class="text-sm text-gray-500 mb-4">Essas informações aparecerão na página do autor no blog.</p>
                    </div>

                    <div class="col-span-full">
                        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">Biografia</label>
                        <div class="mt-2">
                            <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label class="block text-sm font-medium leading-6 text-gray-900">Avatar / Foto de Perfil</label>
                        <div class="mt-2 flex items-center gap-x-3">
                            <?php if (!empty($user['avatar'])): ?>
                                <img src="<?php echo APP_URL . '/assets/uploads/avatars/' . $user['avatar']; ?>" alt="Avatar" class="h-12 w-12 rounded-full object-cover bg-gray-50">
                            <?php else: ?>
                                <i class="fas fa-user-circle text-gray-300 text-5xl"></i>
                            <?php endif; ?>
                            <input type="file" name="avatar" accept="image/*" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="social_linkedin" class="block text-sm font-medium leading-6 text-gray-900">LinkedIn (URL)</label>
                        <div class="mt-2">
                            <input type="url" name="social_linkedin" id="social_linkedin" value="<?php echo htmlspecialchars($user['social_linkedin'] ?? ''); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="social_instagram" class="block text-sm font-medium leading-6 text-gray-900">Instagram (URL)</label>
                        <div class="mt-2">
                            <input type="url" name="social_instagram" id="social_instagram" value="<?php echo htmlspecialchars($user['social_instagram'] ?? ''); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="<?php echo APP_URL; ?>/painel/usuarios" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
