<div class="bg-white p-6 rounded shadow max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Configurações da API do WhatsApp (Meta)</h2>

    <form action="<?php echo APP_URL; ?>/whatsapp/configuracoes" method="POST">
        <div class="grid grid-cols-1 gap-6">
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">WhatsApp Business Account ID</label>
                <input type="text" name="waba_id" value="<?php echo $settings['waba_id'] ?? ''; ?>" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Phone Number ID</label>
                <input type="text" name="phone_number_id" value="<?php echo $settings['phone_number_id'] ?? ''; ?>" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Access Token (Permanente)</label>
                <textarea name="access_token" rows="3" class="w-full border rounded px-3 py-2"><?php echo $settings['access_token'] ?? ''; ?></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Webhook Verify Token</label>
                <input type="text" name="webhook_verify_token" value="<?php echo $settings['webhook_verify_token'] ?? ''; ?>" class="w-full border rounded px-3 py-2">
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <p class="font-bold text-sm mb-2">Webhook URL:</p>
                <code class="bg-gray-200 p-1 text-sm block overflow-x-auto"><?php echo APP_URL; ?>/webhook/webhook.php</code>
            </div>

        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">Salvar Configurações</button>
        </div>
    </form>
</div>
