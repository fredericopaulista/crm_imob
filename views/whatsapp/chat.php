<div class="flex h-[calc(100vh-140px)] bg-white rounded shadow text-gray-800 antialiased overflow-hidden">
    <!-- Sidebar -->
    <div class="w-1/3 border-r border-gray-200 flex flex-col">
        <div class="bg-gray-100 p-4 border-b border-gray-200 px-6">
             <div class="flex justify-between items-center">
                <h3 class="font-bold text-gray-600">Conversas</h3>
                <a href="<?php echo APP_URL; ?>/whatsapp/settings" class="text-gray-500 hover:text-gray-700"><i class="fas fa-cog"></i></a>
             </div>
        </div>
        <div class="flex-1 overflow-y-auto">
            <?php foreach ($clients as $client): ?>
            <a href="<?php echo APP_URL; ?>/whatsapp?client_id=<?php echo $client['id']; ?>" class="block px-6 py-4 hover:bg-gray-50 border-b border-gray-100 <?php echo ($activeClientId == $client['id']) ? 'bg-blue-50' : ''; ?>">
                <div class="flex justify-between">
                    <div>
                        <span class="font-bold text-gray-800"><?php echo $client['name']; ?></span>
                        <p class="text-sm text-gray-500 mt-1 truncate">Clique para ver a conversa</p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Main Chat -->
    <div class="w-2/3 flex flex-col">
        <?php if ($activeClient): ?>
        
        <!-- Chat Header -->
        <div class="bg-gray-100 p-4 border-b border-gray-200 flex items-center">
            <div class="ml-4">
                <p class="font-bold"><?php echo $activeClient['name']; ?></p>
                <p class="text-xs text-gray-500"><?php echo $activeClient['phone']; ?></p>
            </div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 bg-slate-50" id="messages-container">
            <?php foreach ($messages as $msg): ?>
                <div class="flex mb-4 <?php echo ($msg['direction'] == 'outbound') ? 'justify-end' : ''; ?>">
                    <div class="<?php echo ($msg['direction'] == 'outbound') ? 'bg-green-100' : 'bg-white'; ?> py-2 px-4 rounded-lg shadow-sm max-w-md">
                        <p class="text-sm"><?php echo nl2br($msg['body']); ?></p>
                        <p class="text-[10px] text-gray-400 text-right mt-1"><?php echo date('H:i', strtotime($msg['created_at'])); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
             <?php if (empty($messages)): ?>
                <p class="text-center text-gray-400 mt-10">Nenhuma mensagem trocada ainda.</p>
            <?php endif; ?>
        </div>

        <!-- Input -->
        <div class="bg-gray-100 p-4 border-t border-gray-200">
            <form id="chat-form" class="flex">
                <input type="hidden" name="client_id" value="<?php echo $activeClientId; ?>">
                <input type="text" name="message" class="flex-1 border border-gray-300 rounded-l px-4 py-2 focus:outline-none" placeholder="Digite sua mensagem..." required>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-r hover:bg-blue-700 font-bold"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>

        <script>
            // Simple AJAX to send message
            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                
                fetch('<?php echo APP_URL; ?>/whatsapp/sendMessage', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
                        // Reload page to show message (in real app, append to DOM)
                        location.reload(); 
                    } else {
                        alert('Erro ao enviar mensagem');
                    }
                });
            });

             // Auto scroll to bottom
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        </script>

        <?php else: ?>
            <div class="flex-1 flex items-center justify-center bg-gray-50">
                <p class="text-gray-500">Selecione uma conversa para iniciar o atendimento.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
