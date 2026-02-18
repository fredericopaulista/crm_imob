<?php
// SEO Metadata
// $pageTitle is set in the controller
$metaTitle = $pageTitle . ' | ' . company_name();
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
  },{
    "@type": "ListItem",
    "position": 3,
    "name": "<?php echo $heading; ?>",
    "item": "<?php echo APP_URL . '/' . $urlPurpose . '/' . $urlType; ?>"
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
                <a href="<?php echo APP_URL; ?>/imoveis" class="ml-4 text-sm font-medium text-gray-700 hover:text-brand-600 transition-colors">Imóveis</a>
              </div>
            </li>
            <li>
              <div class="flex items-center">
                <i class="fas fa-chevron-right h-5 w-5 flex-shrink-0 text-gray-400"></i>
                <span class="ml-4 text-sm font-medium text-gray-500" aria-current="page"><?php echo $heading; ?></span>
              </div>
            </li>
          </ol>
        </nav>

        <div class="mx-auto max-w-2xl text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?php echo $heading; ?></h2>
             <p class="mt-2 text-lg leading-8 text-gray-600">
                Confira nossa seleção de <strong><?php echo strtolower($typeLabel); ?></strong>
                <?php echo ($dbPurpose == 'sale') ? 'à venda' : 'para alugar'; ?>.
            </p>
        </div>

        <?php if (empty($properties)): ?>
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center p-6 bg-gray-100 rounded-full mb-6">
                    <i class="fas fa-search text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Nenhum imóvel encontrado</h3>
                <p class="mt-2 text-gray-500 mb-8">Não encontramos imóveis nesta categoria no momento.</p>
                <a href="<?php echo APP_URL; ?>/imoveis" class="inline-flex items-center justify-center rounded-xl bg-brand-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600 transition-all">
                    Ver todos os imóveis
                </a>
            </div>
        <?php else: ?>
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
        <?php endif; ?>
    </div>
</div>
