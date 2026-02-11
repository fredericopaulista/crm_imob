<div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Criar Nova Proposta</h2>

    <form action="<?php echo APP_URL; ?>/proposal/store" method="POST">
        <div class="grid grid-cols-1 gap-6">
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">Cliente</label>
                <select name="client_id" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="">Selecione um cliente...</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client['id']; ?>"><?php echo $client['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Imóvel</label>
                <select name="property_id" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="">Selecione um imóvel...</option>
                    <?php foreach ($properties as $property): ?>
                        <option value="<?php echo $property['id']; ?>"><?php echo $property['title']; ?> - R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Valor da Proposta (R$)</label>
                <input type="number" step="0.01" name="value" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Condições de Pagamento</label>
                <textarea name="conditions" rows="3" class="w-full border rounded px-3 py-2" placeholder="Ex: Entrada de 20% + Financiamento"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Observações Internas</label>
                <textarea name="observations" rows="2" class="w-full border rounded px-3 py-2"></textarea>
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <a href="<?php echo APP_URL; ?>/proposal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">Gerar Proposta</button>
        </div>
    </form>
</div>
