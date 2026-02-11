<div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Cadastrar Novo Cliente</h2>

    <form action="<?php echo APP_URL; ?>/client/store" method="POST">
        <div class="grid grid-cols-1 gap-6">
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">Nome Completo</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">E-mail</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Telefone (WhatsApp)</label>
                <input type="text" name="phone" class="w-full border rounded px-3 py-2" placeholder="5511999999999" required>
                <p class="text-xs text-gray-500 mt-1">Formato: 55 + DDD + Número (apenas números)</p>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Tipo de Cliente</label>
                <select name="type" class="w-full border rounded px-3 py-2 bg-white" required>
                    <option value="buyer">Comprador</option>
                    <option value="tenant">Locatário</option>
                    <option value="owner">Proprietário</option>
                    <option value="investor">Investidor</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Origem do Lead</label>
                <select name="origin" class="w-full border rounded px-3 py-2 bg-white">
                    <option value="site">Site</option>
                    <option value="indication">Indicação</option>
                    <option value="social">Redes Sociais</option>
                    <option value="portal">Portais</option>
                    <option value="other">Outro</option>
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Observações</label>
                <textarea name="observations" rows="3" class="w-full border rounded px-3 py-2"></textarea>
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <a href="<?php echo APP_URL; ?>/client" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 hover:bg-gray-600">Cancelar</a>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">Salvar Cliente</button>
        </div>
    </form>
</div>
