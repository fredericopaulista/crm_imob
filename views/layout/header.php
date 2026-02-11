<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correta Pro - CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5', // Indigo 600
                        secondary: '#64748b', // Slate 500
                        sidebar: '#0f172a', // Slate 900
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full">

<div class="min-h-full">
    
    <!-- Off-canvas menu for mobile (Hidden by default) -->
    <div class="relative z-50 lg:hidden" role="dialog" aria-modal="true" style="display: none;" id="mobile-menu">
        <div class="fixed inset-0 bg-gray-900/80"></div>
        <div class="fixed inset-0 flex">
            <div class="relative mr-16 flex w-full max-w-xs flex-1">
                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5" onclick="document.getElementById('mobile-menu').style.display='none'">
                        <span class="sr-only">Fechar menu</span>
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
                <!-- Mobile Sidebar -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-sidebar px-6 pb-4 ring-1 ring-white/10">
                    <div class="flex h-16 shrink-0 items-center">
                        <span class="text-white text-xl font-bold tracking-tight">Correta<span class="text-indigo-500">Pro</span></span>
                    </div>
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <?php $currentParams = explode('/', isset($_GET['url']) ? $_GET['url'] : 'dashboard'); $activeModule = $currentParams[0]; ?>
                                    
                                    <li>
                                        <a href="<?php echo APP_URL; ?>/dashboard" class="<?php echo $activeModule == 'dashboard' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="fas fa-chart-pie h-6 w-6 shrink-0 text-[16px] flex items-center justify-center"></i>
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo APP_URL; ?>/property" class="<?php echo $activeModule == 'property' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="fas fa-home h-6 w-6 shrink-0 text-[16px] flex items-center justify-center"></i>
                                            Imóveis
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo APP_URL; ?>/client" class="<?php echo $activeModule == 'client' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="fas fa-users h-6 w-6 shrink-0 text-[16px] flex items-center justify-center"></i>
                                            Clientes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo APP_URL; ?>/proposal" class="<?php echo $activeModule == 'proposal' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="fas fa-file-contract h-6 w-6 shrink-0 text-[16px] flex items-center justify-center"></i>
                                            Propostas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo APP_URL; ?>/chat" class="<?php echo $activeModule == 'chat' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                            <i class="fab fa-whatsapp h-6 w-6 shrink-0 text-[16px] flex items-center justify-center"></i>
                                            WhatsApp
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
        <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-sidebar px-6 pb-4">
            <div class="flex h-16 shrink-0 items-center border-b border-gray-800">
                <span class="text-white text-2xl font-bold tracking-tight">Correta<span class="text-indigo-500">Pro</span></span>
            </div>
            <nav class="flex flex-1 flex-col">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <?php $currentParams = explode('/', isset($_GET['url']) ? $_GET['url'] : 'dashboard'); $activeModule = $currentParams[0]; ?>

                            <li>
                                <a href="<?php echo APP_URL; ?>/dashboard" class="<?php echo $activeModule == 'dashboard' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white">D</span>
                                    <span class="truncate">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo APP_URL; ?>/property" class="<?php echo $activeModule == 'property' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white"><i class="fas fa-home"></i></span>
                                    <span class="truncate">Imóveis</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo APP_URL; ?>/client" class="<?php echo $activeModule == 'client' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white"><i class="fas fa-users"></i></span>
                                    <span class="truncate">Clientes</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo APP_URL; ?>/proposal" class="<?php echo $activeModule == 'proposal' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-gray-400 group-hover:text-white"><i class="fas fa-file-contract"></i></span>
                                    <span class="truncate">Propostas</span>
                                </a>
                            </li>
                             <li>
                                <a href="<?php echo APP_URL; ?>/chat" class="<?php echo $activeModule == 'chat' ? 'bg-indigo-700 text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold transition-all duration-200">
                                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-lg border border-gray-700 bg-gray-800 text-[0.625rem] font-medium text-green-400 group-hover:text-white"><i class="fab fa-whatsapp"></i></span>
                                    <span class="truncate">WhatsApp</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="mt-auto">
                        <a href="<?php echo APP_URL; ?>/chat/settings" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-400 hover:bg-gray-800 hover:text-white">
                            <i class="fas fa-cog h-6 w-6 shrink-0 flex items-center justify-center"></i>
                            Configurações
                        </a>
                        <a href="<?php echo APP_URL; ?>/auth/logout" class="group -mx-2 flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold text-gray-400 hover:bg-gray-800 hover:text-white">
                            <i class="fas fa-sign-out-alt h-6 w-6 shrink-0 flex items-center justify-center "></i>
                            Sair
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="lg:pl-72">
        <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
            <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" onclick="document.getElementById('mobile-menu').style.display='block'">
                <span class="sr-only">Abrir menu</span>
                <i class="fas fa-bars fa-lg"></i>
            </button>

            <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                <div class="relative flex flex-1 items-center">
                    <h1 class="text-xl font-semibold text-gray-900"><?php echo isset($pageTitle) ? $pageTitle : 'Painel'; ?></h1>
                </div>
                <div class="flex items-center gap-x-4 lg:gap-x-6">
                    <!-- Notifications -->
                    <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Notificações</span>
                        <i class="fas fa-bell fa-lg"></i>
                    </button>

                    <!-- Separator -->
                    <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>

                    <!-- Profile dropdown -->
                    <div class="relative">
                        <button type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Menu do usuário</span>
                            <img class="h-8 w-8 rounded-full bg-gray-50" src="https://ui-avatars.com/api/?name=<?php echo isset($_SESSION['user_name']) ? urlencode($_SESSION['user_name']) : 'Admin'; ?>&background=random" alt="">
                            <span class="hidden lg:flex lg:items-center">
                                <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true"><?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Usuário'; ?></span>
                                <i class="fas fa-chevron-down ml-2 text-gray-400 text-xs"></i>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <main class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
