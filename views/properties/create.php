<div class="bg-white p-6 rounded shadow max-w-4xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Cadastrar Novo Imóvel</h2>

    <form action="<?php echo APP_URL; ?>/property/store" method="POST" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Título do Imóvel</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Tipo</label>
                <select name="type" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="Casa">Casa</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Comercial">Comercial</option>
                    <option value="Terreno">Terreno</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Finalidade</label>
                <select name="purpose" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="sale">Venda</option>
                    <option value="rent">Aluguel</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Valor (R$)</label>
                <input type="number" step="0.01" name="price" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="available">Disponível</option>
                    <option value="reserved">Reservado</option>
                    <option value="sold">Vendido</option>
                    <option value="rented">Alugado</option>
                </select>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Endereço Completo</label>
                <input type="text" name="address" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Bairro</label>
                <input type="text" name="neighborhood" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Cidade</label>
                <input type="text" name="city" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="grid grid-cols-4 gap-4 col-span-2">
                <div>
                     <label class="block text-gray-700 font-bold mb-2">Área (m²)</label>
                     <input type="number" step="0.01" name="area" class="w-full border rounded px-3 py-2">
                </div>
                 <div>
                     <label class="block text-gray-700 font-bold mb-2">Quartos</label>
                     <input type="number" name="bedrooms" class="w-full border rounded px-3 py-2">
                </div>
                 <div>
                     <label class="block text-gray-700 font-bold mb-2">Banheiros</label>
                     <input type="number" name="bathrooms" class="w-full border rounded px-3 py-2">
                </div>
                 <div>
                     <label class="block text-gray-700 font-bold mb-2">Vagas</label>
                     <input type="number" name="garages" class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Descrição</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            
            <div class="col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Imagens</label>
                <input type="file" name="images[]" multiple class="w-full border rounded px-3 py-2">
                <p class="text-sm text-gray-500 mt-1">Selecione múltiplas imagens.</p>
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <a href="<?php echo APP_URL; ?>/property" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">Salvar Imóvel</button>
        </div>
    </form>
</div>
