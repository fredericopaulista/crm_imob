<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Correta Pro CRM</title>
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
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="h-full font-sans antialiased text-gray-900">
    
    <div class="flex min-h-full">
        <!-- Left Side: Image & Branding -->
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Modern Apartment">
             <div class="absolute inset-0 bg-gradient-to-t from-brand-900/90 to-brand-900/40 mix-blend-multiply"></div>
             <div class="absolute inset-0 flex flex-col justify-end p-16 text-white z-10">
                 <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-brand-600 text-xl shadow-xl mb-6">
                    <i class="fas fa-home"></i>
                </div>
                 <h2 class="text-4xl font-extrabold tracking-tight mb-4">Transforme sua gestão imobiliária.</h2>
                 <p class="text-lg text-brand-100 max-w-md leading-relaxed">
                     A plataforma completa para corretores de alta performance. Gerencie leads, imóveis e contratos em um só lugar.
                 </p>
             </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="flex flex-1 flex-col justify-center px-4 py-12 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Mobile Branding -->
                 <div class="lg:hidden mb-8 text-center">
                    <div class="mx-auto h-12 w-12 bg-brand-600 rounded-xl flex items-center justify-center text-white text-xl shadow-lg mb-4">
                        <i class="fas fa-home"></i>
                    </div>
                     <h2 class="text-2xl font-bold text-gray-900">Correta<span class="text-brand-600">Pro</span></h2>
                </div>

                <div>
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Bem-vindo de volta!</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-500">
                        Acesse sua conta para continuar.
                    </p>
                </div>

                <div class="mt-10">
                     <?php if (isset($error)): ?>
                        <div class="rounded-md bg-red-50 p-4 mb-6 border border-red-100 animate-fade-in">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-circle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Falha ao entrar</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <p><?php echo $error; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo APP_URL; ?>/acesso/autenticar" method="POST" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Endereço de e-mail</label>
                            <div class="mt-2 relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="far fa-envelope text-gray-400 sm:text-sm"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all" placeholder="voce@exemplo.com">
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Senha</label>
                                <div class="text-sm">
                                    <a href="#" class="font-semibold text-brand-600 hover:text-brand-500 transition-colors">Esqueceu a senha?</a>
                                </div>
                            </div>
                            <div class="mt-2 relative rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <i class="fas fa-lock text-gray-400 sm:text-xs"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-2.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all" placeholder="••••••••">
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="flex w-full justify-center rounded-lg bg-brand-600 px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all hover:-translate-y-0.5 shadow-brand-500/30">
                                Entrar no Sistema
                            </button>
                        </div>
                    </form>

                    <p class="mt-10 text-center text-sm text-gray-500">
                        Não tem uma conta?
                        <a href="<?php echo APP_URL; ?>/contato" class="font-semibold leading-6 text-brand-600 hover:text-brand-500 transition-colors">Fale com o suporte</a>
                    </p>
                    
                    <div class="mt-6 border-t border-gray-100 pt-6 text-center">
                         <a href="<?php echo APP_URL; ?>" class="text-xs text-gray-400 hover:text-brand-600 transition-colors flex items-center justify-center gap-2">
                            <i class="fas fa-arrow-left"></i> Voltar para o Site Público
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
