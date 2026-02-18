<div class="space-y-6">
    
    <div class="border-b border-gray-200 pb-5">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Integração com Portais Imobiliários</h3>
        <p class="mt-2 text-sm text-gray-500">Gere links de integração XML para publicar seus imóveis automaticamente no Grupo Zap, VivaReal e OLX.</p>
    </div>

    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-2">
        
        <!-- Grupo Zap / VivaReal -->
        <div class="rounded-lg bg-white shadow ring-1 ring-gray-900/5">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="ml-4 mt-2">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">Grupo Zap / VivaReal</h3>
                    </div>
                    <div class="ml-4 mt-2 flex-shrink-0">
                         <img src="https://assets.zap.com.br/assets/v2/img/zap-logo.svg" alt="Zap" class="h-6">
                    </div>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <p class="text-sm text-gray-500 mb-4">Utilize o link abaixo para integrar seus imóveis com o portal Zap Imóveis e VivaReal.</p>
                
                <div class="relative">
                    <label for="zap-feed" class="sr-only">URL do Feed Zap</label>
                    <input type="text" name="zap-feed" id="zap-feed" class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6" value="<?php echo $feedZapUrl; ?>" readonly>
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <button type="button" onclick="navigator.clipboard.writeText('<?php echo $feedZapUrl; ?>'); alert('Link copiado!');" class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-xs font-medium text-gray-400 hover:text-gray-500">
                            Copiar
                        </button>
                    </div>
                </div>
                
                <div class="mt-4">
                     <a href="<?php echo $feedZapUrl; ?>" target="_blank" class="text-sm font-semibold text-brand-600 hover:text-brand-500">
                        Testar Link <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- OLX -->
        <div class="rounded-lg bg-white shadow ring-1 ring-gray-900/5">
            <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
                 <div class="-ml-4 -mt-2 flex flex-wrap items-center justify-between sm:flex-nowrap">
                    <div class="ml-4 mt-2">
                        <h3 class="text-base font-semibold leading-6 text-gray-900">OLX</h3>
                    </div>
                     <div class="ml-4 mt-2 flex-shrink-0">
                         <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Logotipo_de_OLX.png" alt="OLX" class="h-6">
                    </div>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <p class="text-sm text-gray-500 mb-4">Utilize o link abaixo para integrar seus imóveis com a OLX (Padrão XML).</p>
                
                 <div class="relative">
                    <label for="olx-feed" class="sr-only">URL do Feed OLX</label>
                    <input type="text" name="olx-feed" id="olx-feed" class="block w-full rounded-md border-0 py-1.5 pr-14 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6" value="<?php echo $feedOlxUrl; ?>" readonly>
                    <div class="absolute inset-y-0 right-0 flex py-1.5 pr-1.5">
                        <button type="button" onclick="navigator.clipboard.writeText('<?php echo $feedOlxUrl; ?>'); alert('Link copiado!');" class="inline-flex items-center rounded border border-gray-200 px-2 font-sans text-xs font-medium text-gray-400 hover:text-gray-500">
                            Copiar
                        </button>
                    </div>
                </div>

                <div class="mt-4">
                     <a href="<?php echo $feedOlxUrl; ?>" target="_blank" class="text-sm font-semibold text-brand-600 hover:text-brand-500">
                        Testar Link <span aria-hidden="true">→</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-6 rounded-md bg-blue-50 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400" aria-hidden="true"></i>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-blue-700">Ao cadastrar esses links nos portais, seus imóveis serão atualizados automaticamente a cada 24 horas (ou conforme frequência do portal).</p>
            </div>
        </div>
    </div>
    
    <!-- Cron Instruction -->
    <div class="rounded-lg bg-gray-50 shadow ring-1 ring-gray-900/5 mt-8">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Atualização Automática (Opcional, mas Recomendado)</h3>
        </div>
        <div class="px-4 py-5 sm:p-6">
            <p class="text-sm text-gray-500 mb-4">
                Para melhorar a performance e garantir que os feeds sejam gerados mesmo com muitos imóveis, configure uma tarefa Cron no seu servidor (cPanel ou Terminal) para rodar toda noite (ex: 01:00 AM).
            </p>
            
            <div class="bg-gray-800 rounded-md p-4 relative group">
                <code class="text-sm text-green-400 font-mono break-all" id="cron-command">
                    /usr/local/bin/php <?php echo BASE_PATH; ?>/cron/update_feeds.php
                </code>
                 <button type="button" onclick="navigator.clipboard.writeText(document.getElementById('cron-command').innerText.trim()); alert('Comando copiado!');" class="absolute top-2 right-2 hidden group-hover:flex items-center rounded bg-gray-700 px-2 py-1 text-xs font-medium text-gray-300 hover:text-white">
                    Copiar
                </button>
            </div>
            
            <p class="mt-4 text-xs text-gray-400">
                * O caminho do PHP (/usr/local/bin/php) pode variar conforme sua hospedagem. Consulte o suporte se tiver dúvidas.
            </p>
        </div>
    </div>
</div>
