<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Editar Agendamento</h2>
    </div>
</div>

<form action="<?php echo APP_URL; ?>/painel/agenda/atualizar" method="POST" class="mt-8 space-y-6">
    <input type="hidden" name="id" value="<?php echo $appointment['id']; ?>">
    
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
        <div class="px-4 py-6 sm:p-8">
            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                
                <div class="sm:col-span-3">
                    <label for="lead_id" class="block text-sm font-medium leading-6 text-gray-900">Cliente (Lead) *</label>
                    <div class="mt-2">
                        <select id="lead_id" name="lead_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($leads as $lead): ?>
                                <option value="<?php echo $lead['id']; ?>" <?php echo ($appointment['lead_id'] == $lead['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($lead['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="property_id" class="block text-sm font-medium leading-6 text-gray-900">Imóvel *</label>
                    <div class="mt-2">
                         <select id="property_id" name="property_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                            <option value="">Selecione um imóvel</option>
                            <?php foreach ($properties as $property): ?>
                                <option value="<?php echo $property['id']; ?>" <?php echo ($appointment['property_id'] == $property['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($property['title']); ?> (Ref: <?php echo $property['id']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="visit_date" class="block text-sm font-medium leading-6 text-gray-900">Data e Hora *</label>
                    <div class="mt-2">
                        <input type="datetime-local" name="visit_date" id="visit_date" required value="<?php echo date('Y-m-d\TH:i', strtotime($appointment['visit_date'])); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status *</label>
                    <div class="mt-2">
                        <select id="status" name="status" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                            <option value="scheduled" <?php echo ($appointment['status'] == 'scheduled') ? 'selected' : ''; ?>>Agendado</option>
                            <option value="completed" <?php echo ($appointment['status'] == 'completed') ? 'selected' : ''; ?>>Concluído</option>
                            <option value="cancelled" <?php echo ($appointment['status'] == 'cancelled') ? 'selected' : ''; ?>>Cancelado</option>
                        </select>
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">Responsável *</label>
                    <div class="mt-2">
                        <select id="user_id" name="user_id" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                             <?php foreach ($users as $user): ?>
                                <option value="<?php echo $user['id']; ?>" <?php echo ($appointment['user_id'] == $user['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($user['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="notes" class="block text-sm font-medium leading-6 text-gray-900">Observações</label>
                    <div class="mt-2">
                        <textarea id="notes" name="notes" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6"><?php echo htmlspecialchars($appointment['notes']); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
            <a href="<?php echo APP_URL; ?>/painel/agenda" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
            <button type="submit" class="rounded-md bg-brand-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">Salvar Alterações</button>
        </div>
    </div>
</form>
