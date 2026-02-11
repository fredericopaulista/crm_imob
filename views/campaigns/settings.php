<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Configurações de Campanha</h2>
    </div>
</div>

<?php if (isset($_GET['success'])): ?>
<div class="rounded-md bg-green-50 p-4 mt-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-green-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-green-800">Sucesso</h3>
            <div class="mt-2 text-sm text-green-700">
                <p>Configurações atualizadas com sucesso.</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="mt-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Horário de Disparos</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>Defina o intervalo de horário permitido para envio de mensagens automáticas. Disparos fora deste horário serão bloqueados.</p>
            </div>
            <form action="<?php echo APP_URL; ?>/marketing/salvar-configuracoes" method="POST" class="mt-5">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="business_hours_start" class="block text-sm font-medium leading-6 text-gray-900">Horário de Início</label>
                        <div class="mt-2">
                            <input type="time" name="business_hours_start" id="business_hours_start" value="<?php echo $settings['business_hours_start'] ?? '08:00'; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="business_hours_end" class="block text-sm font-medium leading-6 text-gray-900">Horário de Término</label>
                        <div class="mt-2">
                            <input type="time" name="business_hours_end" id="business_hours_end" value="<?php echo $settings['business_hours_end'] ?? '18:00'; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
