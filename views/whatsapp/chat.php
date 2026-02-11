<div class="flex h-[calc(100vh-8rem)] bg-white rounded-lg shadow ring-1 ring-gray-900/5 overflow-hidden">
    <!-- Sidebar -->
    <div class="w-1/3 border-r border-gray-200 flex flex-col bg-gray-50">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-white sticky top-0 z-10">
            <h2 class="text-lg font-semibold text-gray-800">Conversas</h2>
            <a href="<?php echo APP_URL; ?>/whatsapp/settings" class="text-gray-400 hover:text-gray-600 transition">
                <i class="fas fa-cog"></i>
            </a>
        </div>
        
        <div class="flex-1 overflow-y-auto">
            <?php foreach ($clients as $client): ?>
            <a href="<?php echo APP_URL; ?>/whatsapp?client_id=<?php echo $client['id']; ?>" class="block hover:bg-white transition duration-150 ease-in-out border-b border-gray-100 <?php echo ($activeClientId == $client['id']) ? 'bg-white border-l-4 border-l-indigo-500' : 'bg-transparent border-l-4 border-l-transparent'; ?>">
                <div class="flex items-center px-4 py-4">
                    <div class="relative flex-shrink-0">
                        <img class="h-10 w-10 rounded-full bg-gray-200" src="https://ui-avatars.com/api/?name=<?php echo urlencode($client['name']); ?>&background=random" alt="">
                         <!-- Status indicator (Mock) -->
                        <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-white bg-green-400"></span>
                    </div>
                    <div class="ml-4 min-w-0 flex-1">
                        <div class="flex items-center justify-between">
                            <p class="truncate text-sm font-medium <?php echo ($activeClientId == $client['id']) ? 'text-indigo-600' : 'text-gray-900'; ?>"><?php echo $client['name']; ?></p>
                            <p class="text-xs text-gray-500">12:30</p>
                        </div>
                        <p class="truncate text-xs text-gray-500 mt-0.5">Clique para ver a conversa...</p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="w-2/3 flex flex-col relative bg-[#efeae2]">
        <!-- Background Pattern (Subtle) -->
         <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');"></div>

        <?php if ($activeClient): ?>
        
        <!-- Header -->
        <div class="flex-none bg-white p-3 border-b border-gray-200 flex items-center z-10 shadow-sm">
            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name=<?php echo urlencode($activeClient['name']); ?>&background=random" alt="">
            <div class="ml-4">
                <p class="text-sm font-semibold text-gray-900"><?php echo $activeClient['name']; ?></p>
                <p class="text-xs text-gray-500"><?php echo $activeClient['phone']; ?></p>
            </div>
            <div class="ml-auto flex space-x-4 text-gray-500">
                <button class="hover:text-gray-700"><i class="fas fa-search"></i></button>
                <button class="hover:text-gray-700"><i class="fas fa-ellipsis-v"></i></button>
            </div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-4 z-10" id="messages-container">
            <?php foreach ($messages as $msg): ?>
                <div class="flex <?php echo ($msg['direction'] == 'outbound') ? 'justify-end' : 'justify-start'; ?>">
                    <div class="<?php echo ($msg['direction'] == 'outbound') ? 'bg-[#d9fdd3]' : 'bg-white'; ?> px-4 py-2 rounded-lg shadow-sm max-w-md relative text-sm text-gray-800">
                        <p><?php echo nl2br($msg['body']); ?></p>
                        <div class="text-[10px] text-gray-400 text-right mt-1 ml-4 min-w-[50px] flex justify-end items-center gap-1">
                            <?php echo date('H:i', strtotime($msg['created_at'])); ?>
                            <?php if ($msg['direction'] == 'outbound'): ?>
                                <i class="fas fa-check-double text-blue-500"></i>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
             <?php if (empty($messages)): ?>
                <div class="flex justify-center mt-20">
                     <div class="bg-yellow-50 text-yellow-800 px-4 py-2 rounded shadow text-xs">
                        <i class="fas fa-lock text-[10px] mr-1"></i> As mensagens são protegidas com a criptografia de ponta a ponta.
                     </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Input Area -->
        <div class="flex-none bg-gray-100 p-3 z-10">
            <form id="chat-form" class="flex items-center space-x-2">
                <input type="hidden" name="client_id" value="<?php echo $activeClientId; ?>">
                
                <button type="button" class="text-gray-500 hover:text-gray-700 p-2"><i class="far fa-smile fa-lg"></i></button>
                <button type="button" class="text-gray-500 hover:text-gray-700 p-2"><i class="fas fa-paperclip fa-lg"></i></button>
                
                <div class="flex-1">
                    <input type="text" name="message" class="w-full border-0 rounded-lg px-4 py-2 focus:ring-0 focus:outline-none" placeholder="Mensagem" required autocomplete="off">
                </div>
                
                <button type="submit" class="text-gray-500 hover:text-indigo-600 p-2"><i class="fas fa-paper-plane fa-lg"></i></button>
            </form>
        </div>

        <script>
            // Simple AJAX to send message
            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const input = this.querySelector('input[name="message"]');
                const messageText = input.value;
                
                // Optimistic UI Update (Optional, for now just wait)
                
                fetch('<?php echo APP_URL; ?>/whatsapp/sendMessage', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'success') {
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
            <div class="flex-1 flex flex-col items-center justify-center text-center z-10">
                <div class="bg-gray-200 rounded-full p-6 mb-4">
                    <i class="fab fa-whatsapp text-6xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-light text-gray-600">Correta Pro Web</h3>
                <p class="text-sm text-gray-500 mt-2">Envie e receba mensagens sem precisar manter o celular conectado.</p>
                <div class="mt-8 border-t border-gray-300 w-64 pt-4">
                    <p class="text-xs text-gray-400"><i class="fas fa-lock mr-1"></i> Protegido com criptografia de ponta a ponta</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
