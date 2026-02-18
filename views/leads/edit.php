<div class="space-y-6">
    <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Editar Lead</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Atualize as informações do lead.</p>
    </div>

    <form method="POST" action="<?php echo APP_URL; ?>/painel/leads/atualizar" class="space-y-6">
        <input type="hidden" name="id" value="<?php echo $lead['id']; ?>">
        
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label for="name" class="block text-sm font-medium leading-6 text-gray-900">Nome *</label>
                <input type="text" name="name" id="name" required value="<?php echo htmlspecialchars($lead['name']); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($lead['email'] ?? ''); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium leading-6 text-gray-900">Telefone *</label>
                <input type="text" name="phone" id="phone" required value="<?php echo htmlspecialchars($lead['phone']); ?>"
                       class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-3">
            </div>

            <div>
                <label for="origin_id" class="block text-sm font-medium leading-6 text-gray-900">Origem</label>
                <select name="origin_id" id="origin_id" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500">
                    <option value="">Selecione...</option>
                    <?php foreach ($origins as $origin): ?>
                        <option value="<?php echo $origin['id']; ?>" <?php echo ($lead['origin_id'] == $origin['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($origin['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Stage -->
            <div>
                <label for="stage_id" class="block text-sm font-medium text-gray-700 mb-1">Etapa do Funil</label>
                <select name="stage_id" id="stage_id" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500">
                    <?php foreach ($stages as $stage): ?>
                        <option value="<?php echo $stage['id']; ?>" <?php echo ($lead['stage_id'] == $stage['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($stage['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <label for="observations" class="block text-sm font-medium text-gray-700 mb-1">Observações</label>
            <textarea name="observations" id="observations" rows="4" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500"><?php echo htmlspecialchars($lead['observations'] ?? ''); ?></textarea>
        </div>

        <div class="flex items-center justify-end gap-x-6">
            <a href="<?php echo APP_URL; ?>/painel/leads" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                Salvar
            </button>
        </div>
    </form>
</div>
