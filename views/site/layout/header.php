<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Primary Meta Tags -->
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Correta Pro - Encontre o Imóvel dos Seus Sonhos em São Paulo'; ?></title>
    <meta name="title" content="<?php echo isset($metaTitle) ? $metaTitle : 'Correta Pro - Imóveis em São Paulo | Compra, Venda e Aluguel'; ?>">
    <meta name="description" content="<?php echo isset($metaDescription) ? $metaDescription : 'Encontre apartamentos, casas e coberturas em São Paulo. Imóveis para venda e aluguel nos melhores bairros. Atendimento personalizado e as melhores ofertas do mercado.'; ?>">
    <meta name="keywords" content="imóveis são paulo, apartamentos venda, casas aluguel, imobiliária sp, corretora imóveis, jardins, pinheiros, vila madalena, brooklin, moema">
    <meta name="author" content="Correta Pro">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo isset($canonicalUrl) ? $canonicalUrl : APP_URL; ?>">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo isset($canonicalUrl) ? $canonicalUrl : APP_URL; ?>">
    <meta property="og:title" content="<?php echo isset($metaTitle) ? $metaTitle : 'Correta Pro - Imóveis em São Paulo'; ?>">
    <meta property="og:description" content="<?php echo isset($metaDescription) ? $metaDescription : 'Encontre o imóvel perfeito em São Paulo. Apartamentos, casas e coberturas para venda e aluguel.'; ?>">
    <meta property="og:image" content="<?php echo isset($ogImage) ? $ogImage : APP_URL . '/assets/og-image.jpg'; ?>">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:site_name" content="Correta Pro">
    
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo isset($canonicalUrl) ? $canonicalUrl : APP_URL; ?>">
    <meta property="twitter:title" content="<?php echo isset($metaTitle) ? $metaTitle : 'Correta Pro - Imóveis em São Paulo'; ?>">
    <meta property="twitter:description" content="<?php echo isset($metaDescription) ? $metaDescription : 'Encontre o imóvel perfeito em São Paulo.'; ?>">
    <meta property="twitter:image" content="<?php echo isset($ogImage) ? $ogImage : APP_URL . '/assets/og-image.jpg'; ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo APP_URL; ?>/assets/favicon.ico">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Structured Data / Schema.org -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "RealEstateAgent",
        "name": "Correta Pro",
        "description": "Imobiliária especializada em imóveis de alto padrão em São Paulo",
        "url": "<?php echo APP_URL; ?>",
        "telephone": "+55-11-99999-9999",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Av. Paulista, 1000",
            "addressLocality": "São Paulo",
            "addressRegion": "SP",
            "postalCode": "01310-100",
            "addressCountry": "BR"
        },
        "areaServed": "São Paulo, SP",
        "priceRange": "$$-$$$"
    }
    </script>
    
    <style>
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #4f46e5, #9333ea);
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    <header class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-md bg-white/90">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="flex w-full items-center justify-between border-b border-indigo-500 py-6 lg:border-none">
                <div class="flex items-center">
                    <a href="<?php echo APP_URL; ?>/" class="flex items-center gap-2">
                        <span class="sr-only">Correta Pro</span>
                        <i class="fas fa-home text-indigo-600 text-2xl"></i>
                        <span class="text-xl font-bold text-gray-900 tracking-tight">Correta<span class="text-indigo-600">Pro</span></span>
                    </a>
                    <div class="ml-10 hidden space-x-8 lg:block">
                        <a href="<?php echo APP_URL; ?>/" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">Home</a>
                        <a href="<?php echo APP_URL; ?>/imoveis" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">Todos os Imóveis</a>
                        <a href="<?php echo APP_URL; ?>/imoveis?status=sale" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">À Venda</a>
                        <a href="<?php echo APP_URL; ?>/imoveis?status=rent" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">Para Alugar</a>
                        <a href="<?php echo APP_URL; ?>/contato" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">Contato</a>
                    </div>
                </div>
                <div class="ml-10 space-x-4">
                    <a href="<?php echo APP_URL; ?>/acesso/login" class="inline-block rounded-md bg-indigo-600 px-4 py-2 text-base font-medium text-white hover:bg-indigo-700 transition-all hover:shadow-md">Área do Corretor</a>
                </div>
            </div>
            <div class="flex flex-wrap justify-center space-x-6 py-4 lg:hidden">
                <a href="<?php echo APP_URL; ?>/" class="text-base font-medium text-gray-500 hover:text-indigo-600">Home</a>
                <a href="<?php echo APP_URL; ?>/imoveis" class="text-base font-medium text-gray-500 hover:text-indigo-600">Imóveis</a>
                <a href="<?php echo APP_URL; ?>/contato" class="text-base font-medium text-gray-500 hover:text-indigo-600">Contato</a>
            </div>
        </nav>
    </header>
    <main class="flex-grow">
