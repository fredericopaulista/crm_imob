<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1: Imóveis -->
    <div class="group relative overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-indigo-50 to-indigo-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
            <div class="flex items-center justify-between pointer-events-none">
                 <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 ring-1 ring-indigo-600/10">
                    <i class="fas fa-home fa-lg"></i>
                </div>
                <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">Ativos</span>
            </div>
            <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Total de Imóveis</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalProperties; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 backdrop-blur-sm">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/imoveis" class="font-medium text-indigo-600 hover:text-indigo-500 flex items-center gap-1 group-hover:gap-2 transition-all">Ver todos <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>

    <!-- Card 2: Leads -->
    <div class="group relative overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
         <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-purple-50 to-purple-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
            <div class="flex items-center justify-between pointer-events-none">
                 <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 ring-1 ring-purple-600/10">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">Potenciais</span>
            </div>
             <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Leads Ativos</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalClients; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 backdrop-blur-sm">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/clientes" class="font-medium text-purple-600 hover:text-purple-500 flex items-center gap-1 group-hover:gap-2 transition-all">Gerenciar Leads <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>

    <!-- Card 3: Propostas -->
    <div class="group relative overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
         <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-yellow-50 to-yellow-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
             <div class="flex items-center justify-between pointer-events-none">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 text-yellow-600 ring-1 ring-yellow-600/10">
                    <i class="fas fa-file-invoice-dollar fa-lg"></i>
                </div>
                 <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">Em Aberto</span>
            </div>
            <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Propostas</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalProposals; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 backdrop-blur-sm">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/propostas" class="font-medium text-yellow-600 hover:text-yellow-500 flex items-center gap-1 group-hover:gap-2 transition-all">Ver Propostas <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Quick Actions -->
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Ações Rápidas</h3>
        </div>
        <div class="p-6 bg-white">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <a href="<?php echo APP_URL; ?>/imoveis/novo" class="group relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400 hover:bg-gray-50 transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-700 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">Novo Imóvel</p>
                        <p class="truncate text-sm text-gray-500">Cadastrar propriedade</p>
                    </div>
                </a>

                <a href="<?php echo APP_URL; ?>/clientes/novo" class="group relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400 hover:bg-gray-50 transition-all hover:-translate-y-0.5 hover:shadow-md">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fas fa-user-plus"></i>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">Novo Cliente</p>
                        <p class="truncate text-sm text-gray-500">Cadastrar lead</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- WhatsApp Widget -->
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 overflow-hidden">
         <div class="border-b border-gray-200 bg-gray-50/50 px-6 py-4 flex justify-between items-center">
            <h3 class="text-base font-semibold leading-6 text-gray-900">WhatsApp Oficial</h3>
            <?php if ($whatsappConnected): ?>
            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 animate-pulse">Conectado</span>
            <?php else: ?>
            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Desconectado</span>
            <?php endif; ?>
        </div>
        <div class="p-6 flex flex-col items-center justify-center text-center h-48 bg-white relative overflow-hidden">
             <!-- Decorative bg pattern -->
             <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px]"></div>
             
            <div class="relative z-10 rounded-full <?php echo $whatsappConnected ? 'bg-green-100 ring-8 ring-green-50' : 'bg-gray-100 ring-8 ring-gray-50'; ?> p-4 mb-4 transition-all">
                 <i class="fab fa-whatsapp text-4xl <?php echo $whatsappConnected ? 'text-green-600' : 'text-gray-400'; ?>"></i>
            </div>
            <?php if ($whatsappConnected): ?>
            <p class="text-sm text-gray-500 mb-4 z-10">Centralize seu atendimento via API Oficial da Meta.</p>
            <a href="<?php echo APP_URL; ?>/whatsapp" class="z-10 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600 transition-all hover:scale-105 active:scale-95">
                Acessar Chat
            </a>
            <?php else: ?>
            <p class="text-sm text-gray-500 mb-4 z-10">Configure a API do WhatsApp para iniciar o atendimento.</p>
            <a href="<?php echo APP_URL; ?>/whatsapp/configuracoes" class="z-10 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all hover:scale-105 active:scale-95">
                Configurar Agora
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>
