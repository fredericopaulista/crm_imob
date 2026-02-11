<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Correta Pro'; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
                        <a href="<?php echo APP_URL; ?>/imoveis" class="text-base font-medium text-gray-500 hover:text-indigo-600 transition-colors">Imóveis</a>
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
