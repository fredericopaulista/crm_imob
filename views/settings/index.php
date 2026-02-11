<?php require_once 'views/layout/header.php'; ?>

<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Configurações SEO</h1>
        <p class="text-gray-600 mt-2">Gerencie as configurações de SEO e otimização do site</p>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
            <button onclick="showTab('seo')" id="tab-seo" class="tab-button border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600">
                <i class="fas fa-search mr-2"></i>SEO & Analytics
            </button>
            <button onclick="showTab('sitemap')" id="tab-sitemap" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-sitemap mr-2"></i>Sitemap
            </button>
            <button onclick="showTab('robots')" id="tab-robots" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                <i class="fas fa-robot mr-2"></i>Robots.txt
            </button>
        </nav>
    </div>

    <!-- SEO & Analytics Tab -->
    <div id="content-seo" class="tab-content">
        <div class="bg-white shadow rounded-lg p-6">
            <form action="<?php echo APP_URL; ?>/painel/configuracoes/atualizar" method="POST">
                <div class="space-y-6">
                    <!-- Google Search Console -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-google text-blue-600 mr-2"></i>Google Search Console
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Cole o código de verificação do Google Search Console (meta tag)</p>
                        <textarea 
                            name="google_search_console" 
                            rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder='<meta name="google-site-verification" content="seu-codigo-aqui" />'
                        ><?php echo htmlspecialchars($settings['google_search_console'] ?? ''); ?></textarea>
                        <p class="text-xs text-gray-400 mt-1">
                            <a href="https://search.google.com/search-console" target="_blank" class="text-blue-600 hover:underline">
                                <i class="fas fa-external-link-alt mr-1"></i>Obter código no Google Search Console
                            </a>
                        </p>
                    </div>

                    <!-- Google Analytics -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-chart-line text-orange-600 mr-2"></i>Google Analytics (GA4)
                        </label>
                        <p class="text-sm text-gray-500 mb-3">Cole o código de rastreamento do Google Analytics</p>
                        <textarea 
                            name="google_analytics" 
                            rows="8" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono text-sm"
                            placeholder='<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());
  gtag("config", "G-XXXXXXXXXX");
</script>'
                        ><?php echo htmlspecialchars($settings['google_analytics'] ?? ''); ?></textarea>
                        <p class="text-xs text-gray-400 mt-1">
                            <a href="https://analytics.google.com" target="_blank" class="text-blue-600 hover:underline">
                                <i class="fas fa-external-link-alt mr-1"></i>Obter código no Google Analytics
                            </a>
                        </p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">
                            <i class="fas fa-save mr-2"></i>Salvar Configurações
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Sitemap Tab -->
    <div id="content-sitemap" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Sitemap XML</h3>
                <p class="text-gray-600">O sitemap ajuda os motores de busca a indexar seu site de forma mais eficiente.</p>
            </div>

            <?php if (!empty($settings['sitemap_generated_at'])): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-green-900">Sitemap gerado com sucesso</p>
                            <p class="text-xs text-green-700">Última geração: <?php echo date('d/m/Y H:i', strtotime($settings['sitemap_generated_at'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="space-y-4">
                <div class="flex gap-3">
                    <a href="<?php echo APP_URL; ?>/painel/configuracoes/sitemap" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition inline-flex items-center">
                        <i class="fas fa-sync-alt mr-2"></i>Gerar Sitemap
                    </a>
                    
                    <?php if (file_exists('sitemap.xml')): ?>
                        <a href="<?php echo APP_URL; ?>/sitemap.xml" target="_blank" class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition inline-flex items-center">
                            <i class="fas fa-eye mr-2"></i>Visualizar
                        </a>
                    <?php endif; ?>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-2">O que será incluído:</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li><i class="fas fa-check text-green-600 mr-2"></i>Página inicial</li>
                        <li><i class="fas fa-check text-green-600 mr-2"></i>Catálogo de imóveis</li>
                        <li><i class="fas fa-check text-green-600 mr-2"></i>Página de contato</li>
                        <li><i class="fas fa-check text-green-600 mr-2"></i>Todas as páginas de imóveis</li>
                    </ul>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h4 class="font-medium text-blue-900 mb-2"><i class="fas fa-info-circle mr-2"></i>Próximos passos:</h4>
                    <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                        <li>Gere o sitemap clicando no botão acima</li>
                        <li>Acesse o <a href="https://search.google.com/search-console" target="_blank" class="underline">Google Search Console</a></li>
                        <li>Envie a URL: <code class="bg-white px-2 py-1 rounded"><?php echo APP_URL; ?>/sitemap.xml</code></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Robots.txt Tab -->
    <div id="content-robots" class="tab-content hidden">
        <div class="bg-white shadow rounded-lg p-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Robots.txt</h3>
                <p class="text-gray-600">Controle quais áreas do site os motores de busca podem acessar.</p>
            </div>

            <?php if (!empty($settings['robots_generated_at'])): ?>
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm font-medium text-green-900">Robots.txt gerado com sucesso</p>
                            <p class="text-xs text-green-700">Última geração: <?php echo date('d/m/Y H:i', strtotime($settings['robots_generated_at'])); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="space-y-4">
                <div class="flex gap-3">
                    <a href="<?php echo APP_URL; ?>/painel/configuracoes/robots" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition inline-flex items-center">
                        <i class="fas fa-sync-alt mr-2"></i>Gerar Robots.txt
                    </a>
                    
                    <?php if (file_exists('robots.txt')): ?>
                        <a href="<?php echo APP_URL; ?>/robots.txt" target="_blank" class="bg-gray-600 text-white px-6 py-3 rounded-md hover:bg-gray-700 transition inline-flex items-center">
                            <i class="fas fa-eye mr-2"></i>Visualizar
                        </a>
                    <?php endif; ?>
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-2">Configuração padrão:</h4>
                    <pre class="text-sm text-gray-700 bg-white p-3 rounded border border-gray-300 overflow-x-auto"><code>User-agent: *
Allow: /
Disallow: /painel/
Disallow: /assets/uploads/

Sitemap: <?php echo APP_URL; ?>/sitemap.xml</code></pre>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <h4 class="font-medium text-yellow-900 mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Importante:</h4>
                    <p class="text-sm text-yellow-800">O arquivo robots.txt bloqueia o acesso dos motores de busca ao painel administrativo, mantendo-o privado.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-blue-500', 'text-blue-600');
        button.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tabName).classList.remove('hidden');
    
    // Add active state to selected tab
    const activeTab = document.getElementById('tab-' + tabName);
    activeTab.classList.remove('border-transparent', 'text-gray-500');
    activeTab.classList.add('border-blue-500', 'text-blue-600');
}
</script>

<?php require_once 'views/layout/footer.php'; ?>
