<?php require 'views/layout/header_admin.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- ... content ... -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Importar Imóveis via XML</h2>
        </div>
    </div>
    
    <!-- ... (keep middle content mostly same, assuming it's generic html) ... -->
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="rounded-xl bg-green-50 p-4 mb-6 border border-green-100">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="rounded-xl bg-red-50 p-4 mb-6 border border-red-100">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-times-circle text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-2xl md:col-span-2">
        <form action="<?php echo APP_URL; ?>/painel/imoveis/processar-importacao" method="POST" class="px-4 py-6 sm:p-8">
            <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="col-span-full">
                    <label for="xml_url" class="block text-sm font-bold leading-6 text-gray-900">URL do XML (VivaReal / Zap / OLX)</label>
                    <div class="mt-2">
                        <input type="url" name="xml_url" id="xml_url" required placeholder="https://exemplo.com.br/feed.xml" 
                            class="block w-full rounded-lg border-0 py-2.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6">
                    </div>
                    <p class="mt-3 text-sm leading-6 text-gray-500">Insira a URL do feed XML no padrão VivaReal. O sistema irá importar os imóveis e atualizar os existentes com base no código do imóvel.</p>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8 mt-6">
                <button type="submit" class="rounded-xl bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all hover:-translate-y-0.5">Inciar Importação</button>
            </div>
        </form>
    </div>
</div>

<?php require 'views/layout/footer_admin.php'; ?>
