    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Horário de Disparos</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>Defina o intervalo de horário permitido para envio de mensagens automáticas. Disparos fora deste horário serão bloqueados.</p>
            </div>
            <form action="<?php echo APP_URL; ?>/painel/marketing/salvar-configuracoes" method="POST" class="mt-5">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="business_hours_start" class="block text-sm font-medium leading-6 text-gray-900">Horário de Início</label>
                        <div class="mt-2">
                            <input type="time" name="business_hours_start" id="business_hours_start" value="<?php echo $settings['business_hours_start'] ?? '08:00'; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="business_hours_end" class="block text-sm font-medium leading-6 text-gray-900">Horário de Término</label>
                        <div class="mt-2">
                            <input type="time" name="business_hours_end" id="business_hours_end" value="<?php echo $settings['business_hours_end'] ?? '18:00'; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-brand-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
