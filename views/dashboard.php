<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1: Imóveis -->
    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-brand-50 to-brand-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
            <div class="flex items-center justify-between pointer-events-none">
                 <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 text-brand-600 ring-1 ring-brand-600/10 shadow-sm">
                    <i class="fas fa-home fa-lg"></i>
                </div>
                <span class="inline-flex items-center rounded-md bg-brand-50 px-2.5 py-1 text-xs font-semibold text-brand-700 ring-1 ring-inset ring-brand-700/10">Ativos</span>
            </div>
            <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Total de Imóveis</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalProperties; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 border-t border-gray-100">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/painel/imoveis" class="font-semibold text-brand-600 hover:text-brand-500 flex items-center gap-1 group-hover:gap-2 transition-all">
                    Ver todos <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card 2: Leads -->
    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
         <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-purple-50 to-purple-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
            <div class="flex items-center justify-between pointer-events-none">
                 <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-purple-600 ring-1 ring-purple-600/10 shadow-sm">
                    <i class="fas fa-users fa-lg"></i>
                </div>
                <span class="inline-flex items-center rounded-md bg-purple-50 px-2.5 py-1 text-xs font-semibold text-purple-700 ring-1 ring-inset ring-purple-700/10">Potenciais</span>
            </div>
             <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Leads Ativos</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalClients; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 border-t border-gray-100">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/painel/clientes" class="font-semibold text-purple-600 hover:text-purple-500 flex items-center gap-1 group-hover:gap-2 transition-all">
                    Gerenciar Leads <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Card 3: Propostas -->
    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
         <div class="absolute top-0 right-0 -mt-4 -mr-4 h-24 w-24 rounded-full bg-gradient-to-br from-yellow-50 to-yellow-100 opacity-50 blur-2xl transition-all group-hover:scale-150"></div>
        <div class="p-6 relative">
             <div class="flex items-center justify-between pointer-events-none">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-yellow-50 text-yellow-600 ring-1 ring-yellow-600/10 shadow-sm">
                    <i class="fas fa-file-invoice-dollar fa-lg"></i>
                </div>
                 <span class="inline-flex items-center rounded-md bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-700 ring-1 ring-inset ring-yellow-600/20">Em Aberto</span>
            </div>
            <div class="mt-4">
                 <p class="text-sm font-medium text-gray-500">Propostas</p>
                 <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900"><?php echo $totalProposals; ?></p>
            </div>
        </div>
        <div class="bg-gray-50/50 px-6 py-3 border-t border-gray-100">
            <div class="text-sm">
                <a href="<?php echo APP_URL; ?>/painel/propostas" class="font-semibold text-yellow-600 hover:text-yellow-500 flex items-center gap-1 group-hover:gap-2 transition-all">
                    Ver Propostas <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Sales Funnel Chart -->
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 p-6">
        <h3 class="text-base font-bold leading-6 text-gray-900 mb-4">Funil de Vendas</h3>
        <div class="relative h-64">
            <canvas id="funnelChart"></canvas>
        </div>
    </div>

    <!-- Lead Origins Chart -->
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 p-6">
        <h3 class="text-base font-bold leading-6 text-gray-900 mb-4">Origem dos Leads</h3>
        <div class="relative h-64">
            <canvas id="originsChart"></canvas>
        </div>
    </div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <!-- Quick Actions -->
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 overflow-hidden">
        <div class="border-b border-gray-100 bg-white px-6 py-5">
            <h3 class="text-base font-bold leading-6 text-gray-900">Ações Rápidas</h3>
        </div>
        <div class="p-6 bg-gray-50/30">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                 <a href="<?php echo APP_URL; ?>/painel/imoveis/novo" class="group relative flex items-center space-x-3 rounded-xl border border-gray-200 bg-white px-6 py-5 shadow-sm hover:border-brand-300 hover:ring-1 hover:ring-brand-300 transition-all hover:-translate-y-0.5 hover:shadow-md cursor-pointer">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-brand-50 text-brand-700 group-hover:bg-brand-600 group-hover:text-white transition-colors">
                            <i class="fas fa-plus"></i>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-bold text-gray-900">Novo Imóvel</p>
                        <p class="truncate text-sm text-gray-500">Cadastrar propriedade</p>
                    </div>
                </a>

                <a href="<?php echo APP_URL; ?>/painel/clientes/novo" class="group relative flex items-center space-x-3 rounded-xl border border-gray-200 bg-white px-6 py-5 shadow-sm hover:border-green-300 hover:ring-1 hover:ring-green-300 transition-all hover:-translate-y-0.5 hover:shadow-md cursor-pointer">
                    <div class="flex-shrink-0">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-green-50 text-green-700 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="fas fa-user-plus"></i>
                        </span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <span class="absolute inset-0" aria-hidden="true"></span>
                        <p class="text-sm font-bold text-gray-900">Novo Cliente</p>
                        <p class="truncate text-sm text-gray-500">Cadastrar lead</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- WhatsApp Widget -->
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-900/5 overflow-hidden">
         <div class="border-b border-gray-100 bg-white px-6 py-5 flex justify-between items-center">
            <h3 class="text-base font-bold leading-6 text-gray-900">WhatsApp Oficial</h3>
            <?php if ($whatsappConnected): ?>
            <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 animate-pulse">
                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span> Conectado
            </span>
            <?php else: ?>
            <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                <span class="w-1.5 h-1.5 bg-red-500 rounded-full mr-1.5"></span> Desconectado
            </span>
            <?php endif; ?>
        </div>
        <div class="p-8 flex flex-col items-center justify-center text-center h-full relative overflow-hidden">
             <!-- Decorative bg pattern -->
             <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#000000_1px,transparent_1px)] [background-size:16px_16px]"></div>
             
            <div class="relative z-10 rounded-full <?php echo $whatsappConnected ? 'bg-green-50 ring-4 ring-green-50/50' : 'bg-gray-50 ring-4 ring-gray-50/50'; ?> p-5 mb-5 transition-transform hover:scale-110 duration-300">
                 <i class="fab fa-whatsapp text-5xl <?php echo $whatsappConnected ? 'text-green-600' : 'text-gray-400'; ?>"></i>
            </div>
            
            <?php if ($whatsappConnected): ?>
            <p class="text-sm text-gray-600 mb-6 z-10 max-w-xs mx-auto">Centralize seu atendimento, envie campanhas e gerencie leads via API Oficial da Meta.</p>
            <a href="<?php echo APP_URL; ?>/painel/whatsapp" class="z-10 rounded-xl bg-green-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-green-500/30 hover:bg-green-700 hover:-translate-y-0.5 transition-all w-full sm:w-auto">
                Acessar Chat
            </a>
            <?php else: ?>
            <p class="text-sm text-gray-600 mb-6 z-10 max-w-xs mx-auto">Configure a API do WhatsApp para iniciar o atendimento automatizado e campanhas.</p>
            <a href="<?php echo APP_URL; ?>/painel/whatsapp/configuracoes" class="z-10 rounded-xl bg-brand-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-brand-500/30 hover:bg-brand-700 hover:-translate-y-0.5 transition-all w-full sm:w-auto">
                Configurar Agora
            </a>
            <?php endif; ?>
        </div>
    </div>
    </div>
</div>

    </div>
</div>

<!-- Chart.js UMD for browser support -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Debugging
    console.log('Initializing Dashboard Charts...');
    
    if (typeof Chart === 'undefined') {
        console.error('Chart.js library not loaded!');
        alert('Erro ao carregar gráficos: Biblioteca Chart.js não encontrada.');
        return;
    }
    // Funnel Chart
    const funnelCtx = document.getElementById('funnelChart').getContext('2d');
    const funnelData = <?php echo json_encode($leadsByStage ?? []); ?>;
    
    console.log('Funnel Data:', funnelData);

    if (!funnelData || funnelData.length === 0) {
        // Render empty state if no data
        funnelCtx.font = "14px Manrope";
        funnelCtx.fillStyle = "#9ca3af";
        funnelCtx.textAlign = "center";
        funnelCtx.fillText("Sem dados no funil", 150, 75);
    } else {
        new Chart(funnelCtx, {
        type: 'bar',
        data: {
            labels: funnelData.map(item => item.name),
            datasets: [{
                label: 'Leads',
                data: funnelData.map(item => item.count),
                backgroundColor: funnelData.map(item => {
                    // Map tailwind colors to hex or use simplistic mapping
                    const colorMap = {
                        'blue': '#3b82f6',
                        'yellow': '#eab308',
                        'green': '#22c55e',
                        'purple': '#a855f7',
                        'red': '#ef4444',
                        'gray': '#6b7280',
                        'indigo': '#6366f1',
                        'pink': '#ec4899'
                    };
                    return colorMap[item.color] || '#cbd5e1';
                }),
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
    }

    // Origins Chart
    const originsCtx = document.getElementById('originsChart').getContext('2d');
    const originsData = <?php echo json_encode($leadsByOrigin ?? []); ?>;

    console.log('Origins Data:', originsData);

    if (!originsData || originsData.length === 0) {
        originsCtx.font = "14px Manrope";
        originsCtx.fillStyle = "#9ca3af";
        originsCtx.textAlign = "center";
        originsCtx.fillText("Sem dados de origem", 150, 75);
    } else {
        new Chart(originsCtx, {
        type: 'doughnut',
        data: {
            labels: originsData.map(item => item.name),
            datasets: [{
                data: originsData.map(item => item.count),
                backgroundColor: [
                    '#3b82f6', '#10b981', '#f59e0b', '#ef4444', 
                    '#8b5cf6', '#ec4899', '#6366f1', '#14b8a6'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        usePointStyle: true,
                        boxWidth: 6
                    }
                }
            },
            cutout: '70%'
        }
    });
    }
});
</script>
