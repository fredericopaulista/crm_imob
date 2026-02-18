<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-1">
        <?php 
            $currentParams = explode('/', isset($_GET['url']) ? $_GET['url'] : 'dashboard'); 
            $currentParams = array_values(array_filter($currentParams));
            // Adjust logic for /painel/module URLs
            $activeModule = isset($currentParams[1]) ? $currentParams[1] : (isset($currentParams[0]) ? $currentParams[0] : 'dashboard');
            if ($activeModule == 'painel') $activeModule = 'dashboard';
        ?>

        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider mb-2 mt-2 px-2">Geral</div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="<?php echo APP_URL; ?>/painel" class="<?php echo ($activeModule == 'dashboard') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-chart-pie w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Dashboard
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider mb-2 mt-6 px-2">Gestão</div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/imoveis" class="<?php echo ($activeModule == 'imoveis' && !isset($currentParams[2])) ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-building w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Imóveis
                    </a>
                </li>

                <li>
                    <a href="<?php echo APP_URL; ?>/painel/proprietarios" class="<?php echo ($activeModule == 'proprietarios') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-user-tie w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Proprietários
                    </a>
                </li>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/propostas" class="<?php echo ($activeModule == 'propostas') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-file-signature w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Propostas
                    </a>
                </li>
            </ul>
        </li>

         <li>
            <div class="text-xs font-semibold leading-6 text-gray-400 uppercase tracking-wider mb-2 mt-6 px-2">Comercial</div>
            <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/leads" class="<?php echo ($activeModule == 'leads') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-bolt w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity text-yellow-500"></i>
                        Leads
                    </a>
                </li>
                 <li>
                    <a href="<?php echo APP_URL; ?>/painel/clientes" class="<?php echo ($activeModule == 'clientes') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-users w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/whatsapp" class="<?php echo ($activeModule == 'whatsapp') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fab fa-whatsapp w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity text-green-500"></i>
                        WhatsApp
                    </a>
                </li>
                 <?php if (can('manage_marketing')): ?>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/marketing" class="<?php echo ($activeModule == 'marketing') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-bullhorn w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Marketing
                    </a>
                </li>
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/blog" class="<?php echo ($activeModule == 'blog') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-newspaper w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Blog
                    </a>
                </li>
            </ul>
        </li>

        <li class="mt-auto">
             <div class="h-px bg-white/5 my-4 mx-2"></div>
             
             <!-- System & Settings -->
             <div class="text-xs font-semibold leading-6 text-gray-500 uppercase tracking-wider mb-2 px-2">Sistema</div>
             <ul role="list" class="-mx-2 space-y-1">
                <?php if (can('manage_users')): ?>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/usuarios" class="<?php echo ($activeModule == 'usuarios') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-users-cog w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Usuários
                    </a>
                </li>
                <?php endif; ?>
                
                <?php if (can('manage_roles')): ?>
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/perfis" class="<?php echo ($activeModule == 'perfis') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-id-badge w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Perfis e Permissões
                    </a>
                </li>
                <?php endif; ?>

                <li>
                    <button type="button" class="w-full text-left <?php echo ($activeModule == 'configuracoes' || ($activeModule == 'marketing' && isset($currentParams[2]) && $currentParams[2] == 'configuracoes') || ($activeModule == 'imoveis' && isset($currentParams[2]) && $currentParams[2] == 'importar')) ? 'text-white' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200" onclick="this.nextElementSibling.classList.toggle('hidden'); this.querySelector('.fa-chevron-right').classList.toggle('rotate-90');">
                        <i class="fas fa-cog w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Configurações
                        <i class="fas fa-chevron-right ml-auto text-xs transition-transform duration-200 <?php echo ($activeModule == 'configuracoes' || ($activeModule == 'marketing' && isset($currentParams[2]) && $currentParams[2] == 'configuracoes') || ($activeModule == 'imoveis' && isset($currentParams[2]) && $currentParams[2] == 'importar')) ? 'rotate-90' : ''; ?>"></i>
                    </button>
                    <ul class="mt-1 px-2 space-y-1 <?php echo ($activeModule == 'configuracoes' || ($activeModule == 'marketing' && isset($currentParams[2]) && $currentParams[2] == 'configuracoes') || ($activeModule == 'imoveis' && isset($currentParams[2]) && $currentParams[2] == 'importar')) ? '' : 'hidden'; ?>">
                        <li>
                            <a href="<?php echo APP_URL; ?>/painel/configuracoes" class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 <?php echo ($activeModule == 'configuracoes') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> transition-colors">
                                <i class="fas fa-search w-4 mr-2 text-xs"></i> SEO
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL; ?>/painel/marketing/configuracoes" class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 <?php echo ($activeModule == 'marketing' && isset($currentParams[2]) && $currentParams[2] == 'configuracoes') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> transition-colors">
                                <i class="fas fa-bullhorn w-4 mr-2 text-xs"></i> Marketing
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL; ?>/painel/configuracoes/empresa" class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 <?php echo ($activeModule == 'configuracoes' && isset($currentParams[2]) && $currentParams[2] == 'empresa') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> transition-colors">
                                <i class="fas fa-building w-4 mr-2 text-xs"></i> Dados da Empresa
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL; ?>/painel/paginas" class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 <?php echo ($activeModule == 'paginas') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> transition-colors">
                                <i class="fas fa-file-alt w-4 mr-2 text-xs"></i> Páginas Legais
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo APP_URL; ?>/painel/imoveis/importar" class="block rounded-md py-2 pr-2 pl-9 text-sm leading-6 <?php echo ($activeModule == 'imoveis' && isset($currentParams[2]) && $currentParams[2] == 'importar') ? 'text-white bg-white/5' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> transition-colors">
                                <i class="fas fa-file-import w-4 mr-2 text-xs"></i> Importar XML
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="<?php echo APP_URL; ?>/acesso/sair" class="text-gray-400 hover:text-white hover:bg-red-500/10 hover:text-red-400 group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-sign-out-alt w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Sair
                    </a>
                </li>
             </ul>
        </li>
    </ul>
</nav>
