<?php
// SEO Metadata
$pageTitle = 'Catálogo de Imóveis em São Paulo - Venda e Aluguel | ' . company_name();
$metaTitle = 'Catálogo Completo de Imóveis em SP - Apartamentos, Casas e Mais';
$metaDescription = 'Explore nosso catálogo completo de imóveis em São Paulo. Apartamentos, casas, coberturas e lofts para venda e aluguel. Filtros avançados para encontrar o imóvel ideal. Confira!';
$canonicalUrl = APP_URL . '/imoveis';
$ogImage = APP_URL . '/assets/og-catalog.jpg';

// Generate ItemList Schema
$itemListElement = [];
$position = 1;
foreach ($properties as $property) {
    $itemListElement[] = [
        "@type" => "ListItem",
        "position" => $position++,
        "url" => APP_URL . '/imovel/' . ($property['slug'] ?? $property['id'])
    ];
}
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": <?php echo json_encode($itemListElement); ?>
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
    "@type": "ListItem",
    "position": 1,
    "name": "Home",
    "item": "<?php echo APP_URL; ?>"
  },{
    "@type": "ListItem",
    "position": 2,
    "name": "Imóveis",
    "item": "<?php echo APP_URL; ?>/imoveis"
  }]
}
</script>
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 relative z-10" aria-label="Breadcrumb">
          <ol role="list" class="flex items-center space-x-4">
            <li>
              <div>
                <a href="<?php echo APP_URL; ?>" class="text-gray-500 hover:text-brand-600 transition-colors">
                  <i class="fas fa-home flex-shrink-0"></i>
                  <span class="sr-only">Home</span>
                </a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <i class="fas fa-chevron-right h-5 w-5 flex-shrink-0 text-gray-400"></i>
                <a href="#" class="ml-4 text-sm font-medium text-gray-700 hover:text-brand-600 transition-colors" aria-current="page">Imóveis</a>
              </div>
            </li>
          </ol>
        </nav>
        <div class="mx-auto max-w-2xl text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Nosso Catálogo</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Explore nossa seleção completa de imóveis exclusivos.</p>
        </div>

        <!-- Filters (Redesigned) -->
        <div class="bg-white rounded-2xl p-6 mb-12 shadow-lg shadow-gray-200/50 border border-gray-100">
            <form class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- City Filter -->
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-city text-gray-400 group-hover:text-brand-500 transition-colors"></i>
                    </div>
                    <select name="city" class="block w-full rounded-xl border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all shadow-sm group-hover:ring-brand-200" onchange="this.form.submit()">
                        <option value="">Cidade</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?php echo htmlspecialchars($city); ?>" <?php echo ($filters['city'] ?? '') == $city ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($city); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- Neighborhood Filter -->
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-map-marker-alt text-gray-400 group-hover:text-brand-500 transition-colors"></i>
                    </div>
                    <select name="neighborhood" class="block w-full rounded-xl border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all shadow-sm group-hover:ring-brand-200">
                        <option value="">Bairro</option>
                        <?php foreach ($neighborhoods as $neighborhood): ?>
                            <option value="<?php echo htmlspecialchars($neighborhood); ?>" <?php echo ($filters['neighborhood'] ?? '') == $neighborhood ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($neighborhood); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Type Filter -->
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-home text-gray-400 group-hover:text-brand-500 transition-colors"></i>
                    </div>
                    <select name="type" class="block w-full rounded-xl border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all shadow-sm group-hover:ring-brand-200">
                        <option value="">Tipo de Imóvel</option>
                        <option value="Casa" <?php echo ($filters['type'] ?? '') == 'Casa' ? 'selected' : ''; ?>>Casa</option>
                        <option value="Apartamento" <?php echo ($filters['type'] ?? '') == 'Apartamento' ? 'selected' : ''; ?>>Apartamento</option>
                        <option value="Terreno" <?php echo ($filters['type'] ?? '') == 'Terreno' ? 'selected' : ''; ?>>Terreno</option>
                        <option value="Comercial" <?php echo ($filters['type'] ?? '') == 'Comercial' ? 'selected' : ''; ?>>Comercial</option>
                    </select>
                </div>
                
                <!-- Purpose Filter -->
                <div class="relative group">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-tag text-gray-400 group-hover:text-brand-500 transition-colors"></i>
                    </div>
                    <select name="purpose" class="block w-full rounded-xl border-0 py-3 pl-10 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-brand-600 sm:text-sm sm:leading-6 transition-all shadow-sm group-hover:ring-brand-200">
                        <option value="">Finalidade</option>
                        <option value="sale" <?php echo ($filters['status'] ?? '') == 'sale' ? 'selected' : ''; ?>>Venda</option>
                        <option value="rent" <?php echo ($filters['status'] ?? '') == 'rent' ? 'selected' : ''; ?>>Aluguel</option>
                    </select>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-brand-600 text-white rounded-xl px-4 py-3 font-semibold hover:bg-brand-700 transition-all duration-300 flex items-center justify-center gap-2 shadow-lg shadow-brand-500/30 transform hover:-translate-y-0.5">
                    <i class="fas fa-filter"></i> 
                    <span>Filtrar</span>
                </button>
            </form>
        </div>

        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <?php foreach ($properties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/600x400?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:shadow-gray-200/50 transition-all duration-300 group">
                <div class="relative w-full overflow-hidden">
                    <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                        <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] group-hover:scale-110 transition-transform duration-700">
                    </a>
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="absolute top-4 right-4">
                        <span class="rounded-lg bg-white/90 backdrop-blur-sm px-3 py-1 text-sm font-bold text-brand-600 shadow-sm border border-brand-100">
                             <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                        </span>
                    </div>
                </div>
                <div class="p-6 w-full flex flex-col flex-grow">
                    <div class="flex items-center gap-x-4 text-xs mb-3">
                         <span class="rounded-full bg-brand-50 px-3 py-1 font-medium text-brand-600 ring-1 ring-inset ring-brand-700/10"><?php echo $property['type']; ?></span>
                         <span class="text-gray-500 flex items-center gap-1"><i class="fas fa-map-pin text-gray-400"></i> <?php echo $property['city']; ?></span>
                    </div>
                    <div class="group relative flex-grow">
                        <h3 class="text-lg font-bold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-2 line-clamp-2 text-sm leading-6 text-gray-600"><?php echo $property['description']; ?></p>
                    </div>
                    
                    <div class="mt-6 flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4 w-full">
                         <div class="flex items-center gap-1.5" title="<?php echo $property['bedrooms']; ?> Quartos">
                            <i class="fas fa-bed text-gray-400"></i> <span class="font-medium text-gray-700"><?php echo $property['bedrooms']; ?></span>
                        </div>
                        <div class="flex items-center gap-1.5" title="<?php echo $property['bathrooms']; ?> Banheiros">
                            <i class="fas fa-bath text-gray-400"></i> <span class="font-medium text-gray-700"><?php echo $property['bathrooms']; ?></span>
                        </div>
                        <div class="flex items-center gap-1.5" title="<?php echo $property['area']; ?> m²">
                            <i class="fas fa-ruler-combined text-gray-400"></i> <span class="font-medium text-gray-700"><?php echo $property['area']; ?>m²</span>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between w-full pt-2">
                        <span class="text-xl font-bold text-brand-600">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                        <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>" class="rounded-lg bg-brand-50 px-3 py-2 text-sm font-semibold text-brand-600 hover:bg-brand-100 transition-colors">Ver Detalhes</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>
