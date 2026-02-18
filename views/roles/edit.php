<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Editar Perfil</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Atualize as permissões deste perfil.</p>
        </div>

        <form action="<?php echo APP_URL; ?>/painel/perfis/atualizar" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <input type="hidden" name="id" value="<?php echo $role['id']; ?>">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="col-span-full">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome do Perfil</label>
                        <div class="mt-2">
                            <input type="text" name="name" id="name" value="<?php echo $role['name']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo $role['description']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <fieldset>
                            <legend class="text-sm font-semibold leading-6 text-gray-900">Permissões</legend>
                            <p class="mt-1 text-sm leading-6 text-gray-600">Selecione o que este perfil pode acessar.</p>
                            <div class="mt-6">
                                <?php require 'views/roles/form_fields.php'; ?>
                            </div>
                        </fieldset>
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="<?php echo APP_URL; ?>/role" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
