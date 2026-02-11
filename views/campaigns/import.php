<div class="md:flex md:items-center md:justify-between">
    <div class="min-w-0 flex-1">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Importar Contatos</h2>
    </div>
</div>

<?php if (isset($_GET['success'])): ?>
<div class="rounded-md bg-green-50 p-4 mt-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-green-400"></i>
        </div>
        <div class="ml-3">
            <h3 class="text-sm font-medium text-green-800">Importação Concluída!</h3>
            <div class="mt-2 text-sm text-green-700">
                <p><?php echo $_GET['imported'] ?? 0; ?> contatos importados com sucesso.</p>
                <p><?php echo $_GET['skipped'] ?? 0; ?> contatos pulados (duplicados).</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="mt-8">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Upload de Arquivo CSV</h3>
            <div class="mt-2 max-w-xl text-sm text-gray-500">
                <p>O arquivo deve estar no formato CSV e conter as colunas: <strong>Nome, Telefone, Email</strong> (opcional).</p>
            </div>
            <form action="<?php echo APP_URL; ?>/marketing/processar-importacao" method="POST" enctype="multipart/form-data" class="mt-5">
                <div class="mb-4">
                    <label for="csv_file" class="block text-sm font-medium leading-6 text-gray-900">Selecione o arquivo</label>
                    <div class="mt-2">
                        <input type="file" name="csv_file" id="csv_file" accept=".csv" required class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium leading-6 text-gray-900">Tags / Campanha (Opcional)</label>
                    <div class="mt-2">
                        <input type="text" name="tags" id="tags" placeholder="Ex: Importação 2023, Lead Frio (separe por vírgula)" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">As tags ajudam a filtrar estes contatos para disparos futuros.</p>
                </div>

                <div class="relative flex items-start mb-6">
                    <div class="flex h-6 items-center">
                        <input id="skip_header" aria-describedby="skip_header-description" name="skip_header" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="ml-3 text-sm leading-6">
                        <label for="skip_header" class="font-medium text-gray-900">Pular primeira linha</label>
                        <span id="skip_header-description" class="text-gray-500"><span class="sr-only">Pular primeira linha </span>(cabeçalho)</span>
                    </div>
                </div>

                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Importar</button>
            </form>
        </div>
    </div>
</div>
