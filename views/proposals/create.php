<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Nova Proposta Comercial</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Formalize a negociação entre cliente e proprietário.</p>
        </div>

        <form action="<?php echo APP_URL; ?>/propostas/salvar" method="POST" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="col-span-full">
                        <label for="client_id" class="block text-sm font-medium leading-6 text-gray-900">Cliente (Comprador/Locatário)</label>
                        <div class="mt-2">
                            <select id="client_id" name="client_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="property_id" class="block text-sm font-medium leading-6 text-gray-900">Imóvel</label>
                        <div class="mt-2">
                            <select id="property_id" name="property_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                <option value="">Selecione...</option>
                                <?php foreach ($properties as $property): ?>
                                    <option value="<?php echo $property['id']; ?>"><?php echo $property['title']; ?> (R$ <?php echo number_format($property['price'], 2, ',', '.'); ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="value" class="block text-sm font-medium leading-6 text-gray-900">Valor da Proposta (R$)</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="value" id="value" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="conditions" class="block text-sm font-medium leading-6 text-gray-900">Condições de Pagamento</label>
                        <div class="mt-2">
                            <textarea id="conditions" name="conditions" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Ex: Entrada de 20% + Financiamento"></textarea>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="observations" class="block text-sm font-medium leading-6 text-gray-900">Observações Internas</label>
                        <div class="mt-2">
                            <textarea id="observations" name="observations" rows="2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="<?php echo APP_URL; ?>/propostas" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Gerar Proposta</button>
            </div>
        </form>
    </div>
</div>
