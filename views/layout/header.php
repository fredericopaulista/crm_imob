<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ImobHub CRM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="bg-gray-900 shadow-xl h-16 fixed bottom-0 md:relative md:h-screen z-10 w-full md:w-64">
            <div class="md:mt-12 md:w-64 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/dashboard" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-500">
                            <i class="fas fa-chart-line pr-0 md:pr-3 text-blue-500"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">Dashboard</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/property" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                            <i class="fas fa-home pr-0 md:pr-3 text-purple-500"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">Imóveis</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/client" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                            <i class="fas fa-users pr-0 md:pr-3 text-green-500"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">Clientes</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/proposal" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-yellow-500">
                            <i class="fas fa-file-contract pr-0 md:pr-3 text-yellow-500"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">Propostas</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/whatsapp" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-400">
                            <i class="fab fa-whatsapp pr-0 md:pr-3 text-green-400"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">WhatsApp</span>
                        </a>
                    </li>
                    <li class="mr-3 flex-1">
                        <a href="<?php echo APP_URL; ?>/auth/logout" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                            <i class="fas fa-sign-out-alt pr-0 md:pr-3 text-red-500"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 block md:inline-block">Sair</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Check Session -->
        <?php if (!isset($_SESSION['user_id'])) { header('Location: ' . APP_URL . '/auth/login'); exit; } ?>
        
        <!-- Main Content -->
        <div class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

            <div class="bg-gray-800 pt-3">
                <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                    <h3 class="font-bold pl-2"><?php echo isset($pageTitle) ? $pageTitle : 'Painel de Controle'; ?></h3>
                </div>
            </div>

            <div class="p-6">
