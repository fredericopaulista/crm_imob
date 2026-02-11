<?php
    $images = json_decode($property['images'], true);
    $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/600x400?text=Sem+Foto';
    
    // SEO Metadata - Dynamic based on property
    $pageTitle = $property['title'] . ' - ' . $property['neighborhood'] . ', ' . $property['city'] . ' | Correta Pro';
    $metaTitle = $property['title'] . ' - R$ ' . number_format($property['price'], 2, ',', '.') . ' | Correta Pro';
    $metaDescription = substr($property['description'], 0, 155) . '... ' . $property['bedrooms'] . ' quartos, ' . $property['bathrooms'] . ' banheiros, ' . $property['area'] . 'm² em ' . $property['neighborhood'] . ', ' . $property['city'] . '. ' . ($property['purpose'] == 'sale' ? 'Venda' : 'Aluguel') . '.';
    $canonicalUrl = APP_URL . '/imovel/' . $property['id'];
    $ogImage = $coverImage;
?>
<div class="bg-white">
    <div class="pt-6">
        <!-- Image Gallery (Simple) -->
        <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-x-8 lg:px-8">
            <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                <img src="<?php echo $coverImage; ?>" alt="Cover" class="h-full w-full object-cover object-center hover:scale-105 transition-transform duration-500">
            </div>
            <div class="hidden lg:grid lg:grid-cols-1 lg:gap-y-8">
                <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                    <img src="<?php echo !empty($images[1]) ? APP_URL . '/assets/uploads/' . $images[1] : $coverImage; ?>" alt="Image 2" class="h-full w-full object-cover object-center">
                </div>
                <div class="aspect-h-2 aspect-w-3 overflow-hidden rounded-lg">
                    <img src="<?php echo !empty($images[2]) ? APP_URL . '/assets/uploads/' . $images[2] : $coverImage; ?>" alt="Image 3" class="h-full w-full object-cover object-center">
                </div>
            </div>
            <div class="aspect-h-5 aspect-w-4 lg:aspect-h-4 lg:aspect-w-3 sm:overflow-hidden sm:rounded-lg">
                <img src="<?php echo !empty($images[3]) ? APP_URL . '/assets/uploads/' . $images[3] : $coverImage; ?>" alt="Image 4" class="h-full w-full object-cover object-center">
            </div>
        </div>

        <!-- Property Info -->
        <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
            <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"><?php echo $property['title']; ?></h1>
                <p class="text-xl font-medium text-indigo-600 mt-2">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></p>
            </div>

            <!-- Options / CTA -->
            <div class="mt-4 lg:row-span-3 lg:mt-0">
                <h2 class="sr-only">Informações</h2>
                <div class="rounded-lg border border-gray-200 bg-gray-50 p-6 shadow-sm">
                    <h3 class="text-lg font-medium text-gray-900">Interessado neste imóvel?</h3>
                    <p class="mt-2 text-sm text-gray-500">Entre em contato agora mesmo para agendar uma visita.</p>
                    
                    <div class="mt-6">
                        <a href="https://wa.me/5511999999999?text=Olá! Tenho interesse no imóvel: <?php echo urlencode($property['title']); ?>" target="_blank" class="flex w-full items-center justify-center rounded-md border border-transparent bg-green-600 px-8 py-3 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-transform active:scale-95">
                            <i class="fab fa-whatsapp mr-2"></i> Chamar no WhatsApp
                        </a>
                    </div>
                </div>
                
                <div class="mt-8">
                     <h3 class="text-sm font-medium text-gray-900">Características</h3>
                     <ul role="list" class="mt-4 space-y-2">
                        <li class="flex items-center text-sm text-gray-600"><i class="fas fa-ruler-combined w-6 text-gray-400"></i> <?php echo $property['area']; ?> m²</li>
                        <li class="flex items-center text-sm text-gray-600"><i class="fas fa-bed w-6 text-gray-400"></i> <?php echo $property['bedrooms']; ?> Quartos</li>
                        <li class="flex items-center text-sm text-gray-600"><i class="fas fa-bath w-6 text-gray-400"></i> <?php echo $property['bathrooms']; ?> Banheiros</li>
                        <li class="flex items-center text-sm text-gray-600"><i class="fas fa-car w-6 text-gray-400"></i> <?php echo $property['garages']; ?> Vagas</li>
                    </ul>
                </div>
            </div>

            <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                <!-- Description -->
                <div>
                    <h3 class="sr-only">Descrição</h3>
                    <div class="space-y-6">
                        <p class="text-base text-gray-900"><?php echo nl2br($property['description']); ?></p>
                    </div>
                </div>
                
                <div class="mt-10 border-t border-gray-200 pt-10">
                    <h3 class="text-sm font-medium text-gray-900">Localização</h3>
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">
                            <i class="fas fa-map-marker-alt text-red-500 mr-1.5"></i>
                            <?php echo $property['address']; ?> - <?php echo $property['neighborhood']; ?>, <?php echo $property['city']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
