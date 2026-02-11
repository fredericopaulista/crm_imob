<div class="flex flex-wrap">
    <!-- Card 1 -->
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-green-600"><i class="fas fa-home fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Total Imóveis</h5>
                    <h3 class="font-bold text-3xl">10 <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-gradient-to-b from-pink-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Leads Ativos</h5>
                    <h3 class="font-bold text-3xl">28 <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="w-full md:w-1/2 xl:w-1/3 p-6">
        <div class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-file-invoice-dollar fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Propostas</h5>
                    <h3 class="font-bold text-3xl">5 <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-row flex-wrap flex-grow mt-2">
    <!-- Quick Actions -->
    <div class="w-full md:w-1/2 p-6">
        <div class="bg-white border-transparent rounded-lg shadow-xl">
            <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Ações Rápidas</h5>
            </div>
            <div class="p-5">
                 <a href="<?php echo APP_URL; ?>/property/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2 mb-2 inline-block">
                    <i class="fas fa-plus mr-2"></i> Novo Imóvel
                </a>
                <a href="<?php echo APP_URL; ?>/client/create" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mr-2 mb-2 inline-block">
                    <i class="fas fa-user-plus mr-2"></i> Novo Cliente
                </a>
                <a href="<?php echo APP_URL; ?>/whatsapp" class="bg-green-600 hover:bg-green-800 text-white font-bold py-2 px-4 rounded mr-2 mb-2 inline-block">
                    <i class="fab fa-whatsapp mr-2"></i> Abrir Chat
                </a>
            </div>
        </div>
    </div>
</div>
