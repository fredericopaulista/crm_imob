<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-50/50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' | Painel ' . company_name() : 'Painel Administrativo'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Manrope', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        },
                        sidebar: '#0f172a',
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-gray-900 bg-gray-50/50">

<div class="min-h-full">
    
    <!-- Mobile Menu Overlay -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" style="display: none;" id="mobile-menu">
        <div class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1 transform transition-transform">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5" onclick="document.getElementById('mobile-menu').style.display='none'">
                        <span class="sr-only">Fechar</span>
                        <i class="fas fa-times text-white text-xl"></i>
                    </button>
                </div>
                <!-- Sidebar Mobile Content -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-sidebar px-6 pb-4">
                     <div class="flex h-16 shrink-0 items-center gap-2 mt-4">
                        <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white text-sm shadow-lg shadow-brand-500/30">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight"><?php echo company_name(); ?></span>
                    </div>
                    <?php include 'views/layout/sidebar_nav.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-sidebar px-6 pb-4 border-r border-white/5 shadow-xl">
            <div class="flex h-16 shrink-0 items-center gap-2 mt-4 mb-4">
                <div class="w-10 h-10 bg-brand-600 rounded-xl flex items-center justify-center text-white text-lg shadow-lg shadow-brand-500/30">
                    <i class="fas fa-home"></i>
                </div>
                <span class="text-2xl font-bold text-white tracking-tight"><?php echo company_name(); ?></span>
            </div>
            <?php include 'views/layout/sidebar_nav.php'; ?>
        </div>
    </div>

    <div class="lg:pl-72 flex flex-col min-h-screen transition-all duration-300">
        <!-- Top bar -->
        <div class="sticky top-0 z-40 flex h-20 shrink-0 items-center gap-x-4 border-b border-gray-100 bg-white/80 backdrop-blur-md px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden hover:text-brand-600 transition-colors" onclick="document.getElementById('mobile-menu').style.display='block'">
                <span class="sr-only">Abrir menu</span>
                <i class="fas fa-bars text-xl"></i>
            </button>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <!-- Page Title / Breadcrumbs -->
                <div class="relative flex flex-1 items-center">
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight"><?php echo isset($pageTitle) ? $pageTitle : 'Painel'; ?></h1>
                </div>
                
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Notifications -->
                    <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-brand-600 transition-colors relative group">
                        <span class="sr-only">Notificações</span>
                        <i class="far fa-bell text-xl group-hover:scale-110 transition-transform"></i>
                        <span class="absolute top-2 right-2 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white animate-pulse"></span>
                    </button>

                    <!-- Separator -->
                    <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                    <!-- Profile dropdown -->
                    <div class="relative">
                        <button type="button" class="-m-1.5 flex items-center p-1.5 focus:outline-none group" id="user-menu-button">
                            <span class="sr-only">Menu do usuário</span>
                             <?php 
                                $avatar = isset($_SESSION['user_avatar']) && !empty($_SESSION['user_avatar']) 
                                    ? APP_URL . '/assets/uploads/avatars/' . $_SESSION['user_avatar'] 
                                    : 'https://ui-avatars.com/api/?name=' . urlencode($_SESSION['user_name'] ?? 'Admin') . '&background=random&color=fff';
                            ?>
                            <img class="h-10 w-10 rounded-full bg-gray-50 ring-2 ring-brand-100 object-cover group-hover:ring-brand-500 transition-all" src="<?php echo $avatar; ?>" alt="">
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm font-semibold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors" aria-hidden="true">
                                    <?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário'; ?>
                                </span>
                                <i class="fas fa-chevron-down ml-2 text-gray-400 text-xs transition-transform duration-200 group-hover:text-brand-600"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-10 flex-1">
            <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
