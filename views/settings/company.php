<div class="space-y-6">
    <div class="mb-6">
        <h2 class="text-base font-semibold leading-7 text-gray-900">Dados da Empresa</h2>
        <p class="mt-1 text-sm leading-6 text-gray-600">Configure as informações da sua imobiliária para exibição no site.</p>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="<?php echo APP_URL; ?>/painel/configuracoes/empresa/salvar" method="POST">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="sm:col-span-4">
                        <label for="company_name" class="block text-sm font-medium leading-6 text-gray-900">Nome da Imobiliária</label>
                        <div class="mt-2">
                            <input type="text" name="company_name" id="company_name" value="<?php echo htmlspecialchars($settings['company_name'] ?? 'Correta Pro'); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="company_creci" class="block text-sm font-medium leading-6 text-gray-900">Registro CRECI</label>
                        <div class="mt-2">
                            <input type="text" name="company_creci" id="company_creci" value="<?php echo htmlspecialchars($settings['company_creci'] ?? ''); ?>" placeholder="Ex: J-12345" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="company_address" class="block text-sm font-medium leading-6 text-gray-900">Endereço Completo</label>
                        <div class="mt-2">
                            <input type="text" name="company_address" id="company_address" value="<?php echo htmlspecialchars($settings['company_address'] ?? ''); ?>" placeholder="Av. Paulista, 1000 - Bela Vista, São Paulo - SP" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="company_phone" class="block text-sm font-medium leading-6 text-gray-900">Telefone / WhatsApp</label>
                        <div class="mt-2">
                            <input type="text" name="company_phone" id="company_phone" value="<?php echo htmlspecialchars($settings['company_phone'] ?? ''); ?>" placeholder="(11) 99999-9999" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="company_email" class="block text-sm font-medium leading-6 text-gray-900">E-mail de Contato</label>
                        <div class="mt-2">
                            <input type="email" name="company_email" id="company_email" value="<?php echo htmlspecialchars($settings['company_email'] ?? ''); ?>" placeholder="contato@imobiliaria.com.br" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                     <div class="sm:col-span-3">
                        <label for="company_hours" class="block text-sm font-medium leading-6 text-gray-900">Horário de Funcionamento</label>
                        <div class="mt-2">
                            <input type="text" name="company_hours" id="company_hours" value="<?php echo htmlspecialchars($settings['company_hours'] ?? ''); ?>" placeholder="Seg - Sex: 09:00 - 18:00" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-brand-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">Salvar Dados</button>
                </div>
            </form>
        </div>
    </div>
</div>
