<?php
    $images = json_decode($property['images'], true);
    $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/600x400?text=Sem+Foto';
    $allImages = array_map(function($img) { return APP_URL . '/assets/uploads/' . $img; }, $images ?? []);
    if (empty($allImages)) $allImages = [$coverImage];
    
    // SEO Metadata
    $pageTitle = $property['title'] . ' | Correta Pro';
    $metaTitle = $property['title'] . ' - R$ ' . number_format($property['price'], 2, ',', '.');
    // Ensure description is safe
    $cleanDesc = strip_tags($property['description']);
    $metaDescription = substr($cleanDesc, 0, 160);
    $canonicalUrl = APP_URL . '/imovel/' . ($property['slug'] ?? $property['id']);
    $ogImage = $coverImage;
?>

<div class="bg-gray-50 min-h-screen pb-12">
    <!-- Breadcrumb -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center h-14 text-sm font-medium text-gray-500">
                <a href="<?php echo APP_URL; ?>" class="hover:text-brand-600 transition-colors"><i class="fas fa-home"></i></a>
                <i class="fas fa-chevron-right text-xs mx-3 text-gray-300"></i>
                <a href="<?php echo APP_URL; ?>/imoveis" class="hover:text-brand-600 transition-colors">Imóveis</a>
                <i class="fas fa-chevron-right text-xs mx-3 text-gray-300"></i>
                <span class="text-gray-900 truncate max-w-xs"><?php echo $property['title']; ?></span>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
            <div>
                 <div class="flex items-center gap-2 mb-2">
                    <span class="inline-flex items-center rounded-md bg-brand-50 px-2 py-1 text-xs font-medium text-brand-700 ring-1 ring-inset ring-brand-700/10">
                        <?php echo $property['type']; ?>
                    </span>
                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                        <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                    </span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 tracking-tight sm:text-4xl mb-2"><?php echo $property['title']; ?></h1>
                <div class="flex items-center text-gray-500 text-sm">
                    <i class="fas fa-map-marker-alt text-brand-500 mr-2"></i>
                    <?php echo $property['neighborhood'] . ', ' . $property['city']; ?>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500 mb-1">Valor do Imóvel</p>
                <div class="text-3xl font-bold text-brand-600">
                    R$ <?php echo number_format($property['price'], 2, ',', '.'); ?>
                </div>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-[500px] mb-12 rounded-2xl overflow-hidden shadow-lg">
            <!-- Main Image (Left, spans 2 cols, full height) -->
            <div class="md:col-span-2 md:row-span-2 relative group cursor-pointer h-full">
                <img src="<?php echo $coverImage; ?>" alt="Foto Principal" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
            </div>
            
            <!-- Side Images -->
            <?php 
                // Display up to 4 side images
                $sideImages = array_slice($allImages, 1, 4);
                // Fill with cover if not enough, or just hide? Let's hide empty slots or use placeholders
                for ($i = 0; $i < 4; $i++):
                    $imgSrc = isset($sideImages[$i]) ? $sideImages[$i] : $coverImage; // Fallback
                    // Only show if we actually have images, else duplicate cover is weird but keeps layout
            ?>
            <div class="relative group cursor-pointer hidden md:block">
                <img src="<?php echo $imgSrc; ?>" alt="Foto <?php echo $i+2; ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors"></div>
                <?php if ($i === 3 && count($allImages) > 5): ?>
                    <div class="absolute inset-0 bg-black/60 flex items-center justify-center text-white font-bold text-lg backdrop-blur-sm transition-opacity">
                        +<?php echo count($allImages) - 5; ?> Fotos
                    </div>
                <?php endif; ?>
            </div>
            <?php endfor; ?>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Overview Cards -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <i class="fas fa-ruler-combined text-2xl text-brand-500 mb-2"></i>
                        <span class="text-lg font-bold text-gray-900"><?php echo $property['area']; ?>m²</span>
                        <span class="text-xs text-gray-500">Área Útil</span>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <i class="fas fa-bed text-2xl text-brand-500 mb-2"></i>
                        <span class="text-lg font-bold text-gray-900"><?php echo $property['bedrooms']; ?></span>
                        <span class="text-xs text-gray-500">Quartos</span>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <i class="fas fa-bath text-2xl text-brand-500 mb-2"></i>
                        <span class="text-lg font-bold text-gray-900"><?php echo $property['bathrooms']; ?></span>
                        <span class="text-xs text-gray-500">Banheiros</span>
                    </div>
                    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col items-center text-center">
                        <i class="fas fa-car text-2xl text-brand-500 mb-2"></i>
                        <span class="text-lg font-bold text-gray-900"><?php echo $property['garages']; ?></span>
                        <span class="text-xs text-gray-500">Vagas</span>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <i class="fas fa-align-left text-brand-500"></i> Sobre o Imóvel
                    </h3>
                    <div class="prose prose-blue text-gray-600 max-w-none leading-relaxed">
                        <?php echo nl2br(htmlspecialchars($property['description'])); ?>
                    </div>
                </div>

                <!-- Features -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                         <i class="fas fa-list-check text-brand-500"></i> Características
                    </h3>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4">
                        <!-- Example features, dynamic if available in DB -->
                        <li class="flex items-center text-gray-600 text-sm">
                            <i class="fas fa-check text-green-500 mr-2"></i> Ar Condicionado
                        </li>
                        <li class="flex items-center text-gray-600 text-sm">
                            <i class="fas fa-check text-green-500 mr-2"></i> Piscina
                        </li>
                        <li class="flex items-center text-gray-600 text-sm">
                            <i class="fas fa-check text-green-500 mr-2"></i> Varanda Gourmet
                        </li>
                        <li class="flex items-center text-gray-600 text-sm">
                            <i class="fas fa-check text-green-500 mr-2"></i> Portaria 24h
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Sidebar (Sticky) -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    
                    <!-- Agent Card -->
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="https://ui-avatars.com/api/?name=Correta+Pro&background=random" alt="Agent" class="w-14 h-14 rounded-full border-2 border-brand-100">
                            <div>
                                <h4 class="font-bold text-gray-900">Correta Pro</h4>
                                <p class="text-xs text-gray-500">Consultoria Imobiliária</p>
                                <div class="flex text-yellow-400 text-xs mt-1">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                             <a href="https://wa.me/5511999999999?text=Ol%C3%A1%2C%20vi%20o%20im%C3%B3vel%20<?php echo urlencode($property['title']); ?>%20no%20site%20e%20gostaria%20de%20mais%20informa%C3%A7%C3%B5es." target="_blank" class="flex items-center justify-center w-full bg-green-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-green-700 transition-all shadow-lg shadow-green-500/30 hover:-translate-y-0.5">
                                <i class="fab fa-whatsapp text-xl mr-2"></i> Chamar no WhatsApp
                            </a>
                            <button onclick="document.getElementById('contact-form').scrollIntoView({behavior: 'smooth'})" class="flex items-center justify-center w-full bg-brand-600 text-white font-semibold py-3 px-4 rounded-xl hover:bg-brand-700 transition-all shadow-lg shadow-brand-500/30 hover:-translate-y-0.5">
                                <i class="fas fa-envelope mr-2"></i> Agendar Visita
                            </button>
                        </div>
                    </div>

                    <!-- Simplified Contact Form -->
                    <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100" id="contact-form">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Enviar Mensagem</h3>
                        <form action="<?php echo APP_URL; ?>/contato/enviar" method="POST" class="space-y-4">
                            <input type="hidden" name="property_id" value="<?php echo $property['id']; ?>">
                            <div>
                                <label for="name" class="sr-only">Nome</label>
                                <input type="text" name="name" id="name" placeholder="Seu Nome" class="block w-full rounded-lg border-gray-200 bg-gray-50 text-sm focus:border-brand-500 focus:ring-brand-500">
                            </div>
                            <div>
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" placeholder="Seu Email" class="block w-full rounded-lg border-gray-200 bg-gray-50 text-sm focus:border-brand-500 focus:ring-brand-500">
                            </div>
                            <div>
                                <label for="phone" class="sr-only">Telefone</label>
                                <input type="tel" name="phone" id="phone" placeholder="Seu Telefone" class="block w-full rounded-lg border-gray-200 bg-gray-50 text-sm focus:border-brand-500 focus:ring-brand-500">
                            </div>
                             <div>
                                <label for="message" class="sr-only">Mensagem</label>
                                <textarea name="message" id="message" rows="3" placeholder="Olá, gostaria de mais informações sobre este imóvel..." class="block w-full rounded-lg border-gray-200 bg-gray-50 text-sm focus:border-brand-500 focus:ring-brand-500"></textarea>
                            </div>
                            <button type="submit" class="w-full bg-gray-900 text-white font-semibold py-2.5 rounded-xl hover:bg-gray-800 transition-colors">
                                Enviar Solicitação
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
