<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | ' . company_name() : company_name() . ' - Imóveis Exclusivos'; ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>/assets/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        sidebar: '#0f172a',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-sans text-gray-600 antialiased bg-white">

    <!-- Navigation -->
    <header class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <a href="<?php echo APP_URL; ?>" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white text-xl shadow-lg shadow-brand-500/30 transition-transform group-hover:scale-105">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="text-2xl font-bold text-gray-900 tracking-tight">Correta<span class="text-brand-600">Pro</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden md:flex items-center gap-6">
                    <a href="<?php echo APP_URL; ?>" class="text-gray-600 hover:text-brand-600 font-medium transition-colors">Início</a>
                    <a href="<?php echo APP_URL; ?>/imoveis" class="text-gray-600 hover:text-brand-600 font-medium transition-colors">Imóveis</a>
                    <a href="<?php echo APP_URL; ?>/blog" class="text-gray-600 hover:text-brand-600 font-medium transition-colors">Blog</a>
                    <a href="#sobre" class="text-gray-600 hover:text-brand-600 font-medium transition-colors">Sobre Nós</a>
                    <a href="<?php echo APP_URL; ?>/contato" class="text-gray-600 hover:text-brand-600 font-medium transition-colors">Contato</a>
                </nav>

                <!-- CTA Button -->
                <div class="hidden md:flex items-center gap-4">
                     <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?php echo APP_URL; ?>/painel" class="text-sm font-semibold text-gray-700 hover:text-brand-600">
                             Painel <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                     <?php else: ?>
                        <a href="<?php echo APP_URL; ?>/acesso/login" class="text-sm font-semibold text-gray-700 hover:text-brand-600 px-4">
                            Entrar
                        </a>
                        <a href="<?php echo APP_URL; ?>/contato" class="bg-brand-600 text-white px-5 py-2.5 rounded-full font-semibold shadow-lg shadow-brand-500/30 hover:bg-brand-700 hover:shadow-brand-600/40 transition-all transform hover:-translate-y-0.5">
                            Fale Conosco
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-500 hover:text-brand-600 focus:outline-none p-2">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-100 absolute top-20 left-0 w-full shadow-xl">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="<?php echo APP_URL; ?>" class="block px-3 py-3 rounded-md text-base font-medium text-brand-600 bg-brand-50">Início</a>
                <a href="<?php echo APP_URL; ?>/imoveis" class="block px-3 py-3 rounded-md text-base font-medium text-gray-600 hover:text-brand-600 hover:bg-gray-50">Imóveis</a>
                <a href="#sobre" class="block px-3 py-3 rounded-md text-base font-medium text-gray-600 hover:text-brand-600 hover:bg-gray-50">Sobre Nós</a>
                <a href="<?php echo APP_URL; ?>/contato" class="block px-3 py-3 rounded-md text-base font-medium text-gray-600 hover:text-brand-600 hover:bg-gray-50">Contato</a>
                <div class="pt-4 mt-4 border-t border-gray-100 flex flex-col gap-3">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?php echo APP_URL; ?>/painel" class="block text-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-brand-600 hover:bg-brand-700">Acessar Painel</a>
                    <?php else: ?>
                         <a href="<?php echo APP_URL; ?>/acesso/login" class="block text-center px-4 py-3 border border-gray-300 rounded-lg text-base font-medium text-gray-700 hover:bg-gray-50">Entrar</a>
                        <a href="<?php echo APP_URL; ?>/contato" class="block text-center px-4 py-3 border border-transparent rounded-lg shadow-sm text-base font-medium text-white bg-brand-600 hover:bg-brand-700">Fale Conosco</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <script>
        // Mobile Menu Toggle
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    
    <!-- Spacing for fixed header -->
    <div class="pt-20">
