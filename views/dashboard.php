<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1: Imóveis -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 hover:shadow-md transition-shadow">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <i class="fas fa-home fa-lg"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Total de Imóveis</dt>
                        <dd>
                            <div class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">10</span>
                                <span class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                    <i class="fas fa-arrow-up self-center flex-shrink-0 text-green-500 mr-1"></i>
                                    12%
                                </span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-3">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/property" class="font-medium text-indigo-600 hover:text-indigo-500">Ver todos <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>

    <!-- Card 2: Leads -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 hover:shadow-md transition-shadow">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-purple-50 text-purple-600">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Leads Ativos</dt>
                        <dd>
                            <div class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">28</span>
                                <span class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                    <i class="fas fa-arrow-up self-center flex-shrink-0 text-green-500 mr-1"></i>
                                    4%
                                </span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-3">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/client" class="font-medium text-indigo-600 hover:text-indigo-500">Gerenciar Leads <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>

    <!-- Card 3: Propostas -->
    <div class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5 hover:shadow-md transition-shadow">
        <div class="p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-yellow-50 text-yellow-600">
                        <i class="fas fa-file-invoice-dollar fa-lg"></i>
                    </div>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="truncate text-sm font-medium text-gray-500">Propostas em Aberto</dt>
                        <dd>
                            <div class="flex items-baseline">
                                <span class="text-2xl font-bold text-gray-900">5</span>
                                <span class="ml-2 flex items-baseline text-sm font-semibold text-gray-500">
                                    <i class="fas fa-minus self-center flex-shrink-0 text-gray-400 mr-1"></i>
                                    0%
                                </span>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-3">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/proposal" class="font-medium text-indigo-600 hover:text-indigo-500">Ver Propostas <span aria-hidden="true"> &rarr;</span></a>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Quick Actions -->
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5">
        <div class="border-b border-gray-200 px-6 py-4">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Ações Rápidas</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <a href="<?php echo APP_URL; ?>/property/create" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400 hover:bg-gray-50 transition-all">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-50 text-indigo-700">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-medium text-gray-900">Novo Imóvel</p>
                        <p class="truncate text-sm text-gray-500">Cadastrar propriedade</p>
                    </div>
                </a>

                <a href="<?php echo APP_URL; ?>/client/create" class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400 hover:bg-gray-50 transition-all">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-700">
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
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-900/5">
         <div class="border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h3 class="text-base font-semibold leading-6 text-gray-900">WhatsApp Oficial</h3>
            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Conectado</span>
        </div>
        <div class="p-6 flex flex-col items-center justify-center text-center h-48">
            <div class="rounded-full bg-green-100 p-4 mb-4">
                 <i class="fab fa-whatsapp text-4xl text-green-600"></i>
            </div>
            <p class="text-sm text-gray-500 mb-4">Centralize seu atendimento via API Oficial da Meta.</p>
            <a href="<?php echo APP_URL; ?>/whatsapp" class="rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                Acessar Chat
            </a>
        </div>
    </div>
</div>
