<div class="flex h-[calc(100vh-8rem)] bg-white rounded-xl shadow-xl ring-1 ring-gray-900/5 overflow-hidden">
    <!-- Sidebar -->
    <div class="w-1/3 border-r border-gray-100 flex flex-col bg-gray-50/50 backdrop-blur-sm">
        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-white/80 sticky top-0 z-10 backdrop-blur-md">
            <h2 class="text-lg font-bold text-gray-900 tracking-tight">Atendimento</h2>
            <a href="<?php echo APP_URL; ?>/whatsapp/configuracoes" class="text-gray-400 hover:text-indigo-600 transition-colors bg-gray-50 hover:bg-indigo-50 p-2 rounded-lg">
                <i class="fas fa-cog"></i>
            </a>
        </div>
        
        <div class="flex-1 overflow-y-auto custom-scrollbar">
            <?php foreach ($clients as $client): ?>
            <a href="<?php echo APP_URL; ?>/whatsapp?client_id=<?php echo $client['id']; ?>" class="group block transition-all duration-200 ease-in-out border-b border-gray-100 hover:bg-white <?php echo ($activeClientId == $client['id']) ? 'bg-white border-l-4 border-l-indigo-600 shadow-sm' : 'bg-transparent border-l-4 border-l-transparent'; ?>">
                <div class="flex items-center px-4 py-4">
                    <div class="relative flex-shrink-0">
                        <img class="h-12 w-12 rounded-full bg-gray-200 ring-2 ring-white shadow-sm" src="https://ui-avatars.com/api/?name=<?php echo urlencode($client['name']); ?>&background=random" alt="">
                         <!-- Status indicator (Mock) -->
                        <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full ring-2 ring-white bg-green-500"></span>
                    </div>
                    <div class="ml-4 min-w-0 flex-1">
                        <div class="flex items-center justify-between">
                            <p class="truncate text-sm font-semibold <?php echo ($activeClientId == $client['id']) ? 'text-indigo-900' : 'text-gray-900'; ?> transition-colors group-hover:text-indigo-600"><?php echo $client['name']; ?></p>
                            <span class="text-[10px] text-gray-400 bg-gray-50 px-1.5 py-0.5 rounded-full">12:30</span>
                        </div>
                        <p class="truncate text-xs text-gray-500 mt-1 flex items-center gap-1 group-hover:text-gray-600">
                             <?php if ($activeClientId == $client['id']): ?>
                                <i class="fas fa-check-double text-[10px] text-blue-500"></i>
                             <?php endif; ?>
                             Clique para ver a conversa...
                        </p>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Main Chat Area -->
    <div class="w-2/3 flex flex-col relative bg-[#f0f2f5]">
        <!-- Background Pattern -->
         <div class="absolute inset-0 opacity-[0.03]" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');"></div>

        <?php if ($activeClient): ?>
        
        <!-- Header -->
        <div class="flex-none bg-white/90 backdrop-blur-md p-3 border-b border-gray-200 flex items-center z-10 shadow-sm">
            <div class="flex items-center gap-3">
                 <button class="md:hidden mr-2 text-gray-500"><i class="fas fa-arrow-left"></i></button>
                <img class="h-10 w-10 rounded-full ring-2 ring-gray-100" src="https://ui-avatars.com/api/?name=<?php echo urlencode($activeClient['name']); ?>&background=random" alt="">
                <div>
                    <h3 class="text-sm font-bold text-gray-900"><?php echo $activeClient['name']; ?></h3>
                    <p class="text-xs text-gray-500 flex items-center gap-1"><span class="block w-1.5 h-1.5 rounded-full bg-green-500"></span> Online</p>
                </div>
            </div>
            <div class="ml-auto flex space-x-2 text-gray-400">
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors"><i class="fas fa-search"></i></button>
                <button class="p-2 hover:bg-gray-100 rounded-full transition-colors"><i class="fas fa-ellipsis-v"></i></button>
            </div>
        </div>

        <!-- Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-2 z-10 scroll-smooth" id="messages-container">
             <!-- Encryption Notice -->
             <div class="flex justify-center mb-6">
                 <div class="bg-yellow-50 text-yellow-800 px-3 py-1.5 rounded-lg shadow-sm text-[10px] border border-yellow-100 flex items-center gap-1.5">
                    <i class="fas fa-lock text-[10px]"></i> As mensagens são protegidas com a criptografia de ponta a ponta.
                 </div>
            </div>

            <?php foreach ($messages as $msg): ?>
                <div class="flex <?php echo ($msg['direction'] == 'outbound') ? 'justify-end' : 'justify-start'; ?> group">
                     <div class="<?php echo ($msg['direction'] == 'outbound') ? 'bg-green-100 rounded-tr-none' : 'bg-white rounded-tl-none'; ?> px-4 py-2 rounded-2xl shadow-sm max-w-[75%] relative text-sm text-gray-800 hover:shadow-md transition-shadow duration-200">
                        <p class="leading-relaxed"><?php echo nl2br($msg['body']); ?></p>
                        <div class="text-[10px] text-gray-400 text-right mt-1 min-w-[50px] flex justify-end items-center gap-1 select-none">
                            <?php echo date('H:i', strtotime($msg['created_at'])); ?>
                            <?php if ($msg['direction'] == 'outbound'): ?>
                                <i class="fas fa-check-double text-blue-500 text-[10px]"></i>
                            <?php endif; ?>
                        </div>
                         <!-- Tail effect (CSS pseudo-element simulated) -->
                        <div class="absolute top-0 <?php echo ($msg['direction'] == 'outbound') ? '-right-2' : '-left-2'; ?> w-4 h-4 <?php echo ($msg['direction'] == 'outbound') ? 'bg-green-100' : 'bg-white'; ?> transform rotate-45 z-[-1]"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Input Area -->
        <div class="flex-none bg-gray-50/90 backdrop-blur p-3 z-10 border-t border-gray-200">
            <form id="chat-form" class="flex items-end space-x-2">
                <input type="hidden" name="client_id" value="<?php echo $activeClientId; ?>">
                
                <button type="button" class="text-gray-500 hover:text-gray-700 p-3 rounded-full hover:bg-gray-200 transition-colors"><i class="far fa-smile fa-lg"></i></button>
                <button type="button" class="text-gray-500 hover:text-gray-700 p-3 rounded-full hover:bg-gray-200 transition-colors"><i class="fas fa-paperclip fa-lg"></i></button>
                
                <div class="flex-1 bg-white rounded-2xl border-0 shadow-sm focus-within:shadow-md transition-shadow">
                    <input type="text" name="message" class="w-full bg-transparent border-0 rounded-2xl px-4 py-3 focus:ring-0 focus:outline-none placeholder-gray-400" placeholder="Digite uma mensagem" required autocomplete="off">
                </div>
                
                <button type="submit" class="text-white bg-indigo-600 hover:bg-indigo-700 p-3 rounded-full shadow-md hover:shadow-lg transition-all active:scale-95 flex items-center justify-center h-10 w-10">
                    <i class="fas fa-paper-plane text-sm"></i>
                </button>
            </form>
        </div>

        <script>
            // Simple AJAX to send message
            document.getElementById('chat-form').addEventListener('submit', function(e) {
                e.preventDefault();
                // ... logic ...
                const formData = new FormData(this);
                // Optimistic UI for immediate feedback
                
                fetch('<?php echo APP_URL; ?>/whatsapp/enviar-mensagem', {
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

             // Auto scroll to bottom smoothly
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        </script>

        <?php else: ?>
            <div class="flex-1 flex flex-col items-center justify-center text-center z-10 p-8">
                <div class="bg-gray-50 rounded-full p-8 mb-6 shadow-inner ring-1 ring-gray-100">
                    <i class="fab fa-whatsapp text-6xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 tracking-tight">Correta Pro Web</h3>
                <p class="text-gray-500 mt-3 max-w-sm leading-relaxed">Envie e receba mensagens diretamente do seu CRM sem precisar manter o celular conectado.</p>
                <div class="mt-8 border-t border-gray-200/60 w-64 pt-6">
                    <p class="text-xs text-gray-400 flex items-center justify-center gap-1"><i class="fas fa-lock text-[10px]"></i> Protegido com criptografia de ponta a ponta</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
