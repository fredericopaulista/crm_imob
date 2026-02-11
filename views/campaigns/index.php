<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Marketing</h2>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-2">
    <!-- Card 1: Import -->
    <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
        <div class="flex-shrink-0">
            <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-indigo-600">
                <i class="fas fa-file-csv text-white"></i>
            </div>
        </div>
        <div class="min-w-0 flex-1">
            <a href="<?php echo APP_URL; ?>/campaign/import" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true"></span>
                <p class="text-sm font-medium text-gray-900">Importar Contatos</p>
                <p class="truncate text-sm text-gray-500">Faça upload de lista CSV.</p>
            </a>
        </div>
    </div>

    <!-- Card 2: Broadcast -->
    <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:border-gray-400">
        <div class="flex-shrink-0">
            <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-green-600">
                <i class="fab fa-whatsapp text-white"></i>
            </div>
        </div>
        <div class="min-w-0 flex-1">
            <a href="<?php echo APP_URL; ?>/campaign/broadcast" class="focus:outline-none">
                <span class="absolute inset-0" aria-hidden="true"></span>
                <p class="text-sm font-medium text-gray-900">Disparo em Massa</p>
                <p class="truncate text-sm text-gray-500">Envie mensagens para todos os clientes.</p>
            </a>
        </div>
    </div>
</div>
