<?php
// SEO Metadata
$pageTitle = 'Catálogo de Imóveis em São Paulo - Venda e Aluguel | Correta Pro';
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
<div class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Nosso Catálogo</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Explore nossa seleção completa de imóveis.</p>
        </div>

        <!-- Filters (Mockup) -->
        <div class="bg-gray-50 rounded-xl p-6 mb-12 shadow-sm border border-gray-100">
            <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <select name="city" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" onchange="this.form.submit()">
                    <option value="">Cidade</option>
                    <?php foreach ($cities as $city): ?>
                        <option value="<?php echo htmlspecialchars($city); ?>" <?php echo ($filters['city'] ?? '') == $city ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($city); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <select name="neighborhood" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Bairro</option>
                    <?php foreach ($neighborhoods as $neighborhood): ?>
                        <option value="<?php echo htmlspecialchars($neighborhood); ?>" <?php echo ($filters['neighborhood'] ?? '') == $neighborhood ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($neighborhood); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Tipo de Imóvel</option>
                    <option value="Casa" <?php echo ($filters['type'] ?? '') == 'Casa' ? 'selected' : ''; ?>>Casa</option>
                    <option value="Apartamento" <?php echo ($filters['type'] ?? '') == 'Apartamento' ? 'selected' : ''; ?>>Apartamento</option>
                    <option value="Terreno" <?php echo ($filters['type'] ?? '') == 'Terreno' ? 'selected' : ''; ?>>Terreno</option>
                    <option value="Comercial" <?php echo ($filters['type'] ?? '') == 'Comercial' ? 'selected' : ''; ?>>Comercial</option>
                </select>
                
                <select name="purpose" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Finalidade</option>
                    <option value="sale" <?php echo ($filters['status'] ?? '') == 'sale' ? 'selected' : ''; ?>>Venda</option>
                    <option value="rent" <?php echo ($filters['status'] ?? '') == 'rent' ? 'selected' : ''; ?>>Aluguel</option>
                </select>
                
                <button type="submit" class="bg-indigo-600 text-white rounded-md px-4 py-2 hover:bg-indigo-700 transition-colors">Filtrar</button>
            </form>
        </div>

        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <?php foreach ($properties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/600x400?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative w-full">
                    <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                        <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] hover:scale-105 transition-transform duration-500">
                    </a>
                    <div class="absolute absolute top-0 right-0 rounded-bl-lg bg-indigo-600 px-3 py-1 text-sm font-semibold text-white shadow-sm">
                        <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                    </div>
                </div>
                <div class="max-w-xl p-6 w-full">
                    <div class="flex items-center gap-x-4 text-xs">
                         <span class="rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600"><?php echo $property['type']; ?></span>
                         <span class="text-gray-500"><?php echo $property['city']; ?></span>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-indigo-600 transition-colors">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-3 line-clamp-2 text-sm leading-6 text-gray-600"><?php echo $property['description']; ?></p>
                    </div>
                    
                    <div class="mt-4 flex items-center justify-between text-sm text-gray-500 border-t pt-4 w-full">
                         <div class="flex items-center gap-2" title="<?php echo $property['bedrooms']; ?> Quartos">
                            <i class="fas fa-bed"></i> <?php echo $property['bedrooms']; ?>
                        </div>
                        <div class="flex items-center gap-2" title="<?php echo $property['bathrooms']; ?> Banheiros">
                            <i class="fas fa-bath"></i> <?php echo $property['bathrooms']; ?>
                        </div>
                        <div class="flex items-center gap-2" title="<?php echo $property['area']; ?> m²">
                            <i class="fas fa-ruler-combined"></i> <?php echo $property['area']; ?>m²
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-between w-full">
                        <span class="text-xl font-bold text-indigo-600">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                        <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>" class="rounded-md bg-white border border-indigo-200 px-3 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-50 transition-colors">Ver Detalhes</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>
