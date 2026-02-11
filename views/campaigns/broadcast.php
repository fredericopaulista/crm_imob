<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Novo Disparo</h2>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Selection & Message Configuration -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form id="broadcastForm">
                <div class="mb-6">
                    <label class="block text-sm font-medium leading-6 text-gray-900">Destinatários</label>
                    <p class="text-sm text-gray-500 mb-2">Selecione quem receberá a mensagem.</p>
                    <div class="space-y-4">
                        <div class="flex items-center">
                            <input id="all_clients" name="recipient_type" type="radio" value="all" checked class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="all_clients" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Todos os Clientes (<?php echo count($clients); ?>)</label>
                        </div>
                        <!-- Future: Add Tag Selection -->
                    </div>
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium leading-6 text-gray-900">Mensagem</label>
                    <div class="mt-2">
                        <textarea rows="4" name="message" id="message" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Digite sua mensagem aqui..."></textarea>
                    </div>
                </div>

                <button type="button" onclick="startBroadcast()" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <i class="fas fa-paper-plane mr-2"></i> Iniciar Disparo
                </button>
            </form>
        </div>
    </div>

    <!-- Progress & Logs -->
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Progresso do Envio</h3>
            
            <div id="progress-container" class="hidden mt-4">
                <div class="relative pt-1">
                    <div class="flex mb-2 items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-indigo-600 bg-indigo-200">
                                Enviando
                            </span>
                        </div>
                        <div class="text-right">
                            <span id="progress-text" class="text-xs font-semibold inline-block text-indigo-600">
                                0%
                            </span>
                        </div>
                    </div>
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-indigo-200">
                        <div id="progress-bar" style="width:0%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-indigo-500 transition-all duration-500"></div>
                    </div>
                </div>
                <div id="log-container" class="mt-4 h-64 overflow-y-auto bg-gray-50 p-4 rounded border border-gray-200 text-xs font-mono">
                    <p class="text-gray-500">Aguardando início...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const allClients = <?php echo json_encode($clients); ?>;
    let clientsToSend = [];
    let currentIndex = 0;
    
    function startBroadcast() {
        const message = document.getElementById('message').value;
        if (!message) {
            alert('Por favor, digite uma mensagem.');
            return;
        }

        if (!confirm('Deseja iniciar o disparo para ' + allClients.length + ' contatos?')) {
            return;
        }

        clientsToSend = allClients; // Filter if needed later
        currentIndex = 0;
        
        document.getElementById('progress-container').classList.remove('hidden');
        document.getElementById('log-container').innerHTML = ''; // Clear logs
        updateLog('Iniciando disparo...', 'info');
        
        sendNext();
    }

    function sendNext() {
        if (currentIndex >= clientsToSend.length) {
            updateLog('Disparo concluído!', 'success');
            return;
        }

        const client = clientsToSend[currentIndex];
        const message = document.getElementById('message').value;

        updateLog('Enviando para: ' + client.name + ' (' + client.phone + ')...', 'info');

        fetch('<?php echo APP_URL; ?>/campaign/sendBroadcast', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                client_id: client.id,
                message: message
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateLog('Enviado com sucesso para ' + client.name, 'success');
            } else {
                updateLog('Erro ao enviar para ' + client.name + ': ' + data.message, 'error');
            }
        })
        .catch(error => {
            updateLog('Erro de rede ao enviar para ' + client.name, 'error');
        })
        .finally(() => {
            currentIndex++;
            updateProgress();
            // Small delay to be nice to the server/API
            setTimeout(sendNext, 1000); 
        });
    }

    function updateProgress() {
        const percent = Math.round((currentIndex / clientsToSend.length) * 100);
        document.getElementById('progress-bar').style.width = percent + '%';
        document.getElementById('progress-text').innerText = percent + '%';
    }

    function updateLog(message, type) {
        const container = document.getElementById('log-container');
        const p = document.createElement('p');
        p.innerText = '[' + new Date().toLocaleTimeString() + '] ' + message;
        
        if (type === 'error') p.className = 'text-red-600';
        else if (type === 'success') p.className = 'text-green-600';
        else p.className = 'text-gray-600';

        container.appendChild(p);
        container.scrollTop = container.scrollHeight;
    }
</script>
