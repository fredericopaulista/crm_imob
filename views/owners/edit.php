<div class="space-y-6">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Editar Proprietário</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Atualize as informações do proprietário.</p>
    </div>

    <form method="POST" action="<?php echo APP_URL; ?>/painel/proprietarios/atualizar" class="space-y-6">
        <input type="hidden" name="id" value="<?php echo $owner['id']; ?>">
        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome *</label>
                <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($owner['name']); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($owner['email'] ?? ''); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Telefone *</label>
                <input type="text" name="phone" id="phone" required value="<?php echo htmlspecialchars($owner['phone']); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="origin" class="block text-sm font-medium leading-6 text-gray-900">Origem</label>
                <input type="text" name="origin" id="origin" value="<?php echo htmlspecialchars($owner['origin'] ?? ''); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3"
                       placeholder="Ex: Indicação, Captação">
            </div>

            <div>
                <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status *</label>
                <select name="status" id="status" required
                        class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
                    <option value="new" <?php echo ($owner['status'] == 'new') ? 'selected' : ''; ?>>Novo</option>
                    <option value="contacted" <?php echo ($owner['status'] == 'contacted') ? 'selected' : ''; ?>>Ativo</option>
                    <option value="closed" <?php echo ($owner['status'] == 'closed') ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>

            <div class="sm:col-span-2">
                <label for="observations" class="block text-sm font-medium leading-6 text-gray-900">Observações</label>
                <textarea name="observations" id="observations" rows="4"
                          class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3"><?php echo htmlspecialchars($owner['observations'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-x-6">
            <a href="<?php echo APP_URL; ?>/painel/proprietarios" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Salvar
            </button>
        </div>
    </form>
</div>
