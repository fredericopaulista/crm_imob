<nav class="flex flex-1 flex-col">
    <ul role="list" class="flex flex-1 flex-col gap-y-1">
        <?php 
            $currentParams = explode('/', isset($_GET['url']) ? $_GET['url'] : 'dashboard'); 
            $currentParams = array_values(array_filter($currentParams));
            $activeModule = isset($currentParams[0]) && $currentParams[0] == 'painel' && isset($currentParams[1]) ? $currentParams[1] : (isset($currentParams[0]) ? $currentParams[0] : 'dashboard');
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
                    <a href="<?php echo APP_URL; ?>/painel/imoveis" class="<?php echo ($activeModule == 'imoveis') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
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
                <?php endif; ?>
            </ul>
        </li>

        <li class="mt-auto">
             <div class="h-px bg-white/5 my-4 mx-2"></div>
             <ul role="list" class="-mx-2 space-y-1">
                <li>
                    <a href="<?php echo APP_URL; ?>/painel/configuracoes" class="<?php echo ($activeModule == 'configuracoes') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/20' : 'text-gray-400 hover:text-white hover:bg-white/5'; ?> group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold transition-all duration-200">
                        <i class="fas fa-cog w-5 text-[16px] flex items-center justify-center opacity-75 group-hover:opacity-100 transition-opacity"></i>
                        Configurações
                    </a>
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
