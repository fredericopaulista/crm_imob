<?php
// SEO Metadata
$pageTitle = 'Correta Pro - Imóveis em São Paulo | Compra, Venda e Aluguel';
$metaTitle = 'Imóveis em São Paulo - Apartamentos, Casas e Coberturas | Correta Pro';
$metaDescription = 'Encontre o imóvel dos seus sonhos em São Paulo. Apartamentos, casas e coberturas nos melhores bairros: Jardins, Pinheiros, Vila Madalena, Brooklin. Venda e aluguel com atendimento personalizado.';
$canonicalUrl = APP_URL . '/';
$ogImage = APP_URL . '/assets/og-home.jpg';
?>
<!-- Hero Section -->
<div class="relative isolate overflow-hidden bg-gray-900 py-24 sm:py-32">
    <img src="https://images.unsplash.com/photo-1560518883-ce09059ee971?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2073&q=80" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h1 class="text-4xl font-bold tracking-tight text-white sm:text-6xl">Encontre o imóvel dos seus sonhos</h1>
            <p class="mt-6 text-lg leading-8 text-gray-300">Ajudamos você a encontrar o lar perfeito com segurança, transparência e as melhores ofertas do mercado.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="<?php echo APP_URL; ?>/imoveis" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all hover:scale-105">Ver Imóveis</a>
                <a href="<?php echo APP_URL; ?>/contato" class="text-sm font-semibold leading-6 text-white hover:text-indigo-300">Falar com Consultor <span aria-hidden="true">→</span></a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Properties -->
<?php
// Generate ItemList Schema for Featured Properties
$itemListElement = [];
$position = 1;
foreach ($recentProperties as $property) {
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
  "name": "Imóveis em Destaque",
  "itemListElement": <?php echo json_encode($itemListElement); ?>
}
</script>
<div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Imóveis em Destaque</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Confira as melhores oportunidades selecionadas para você.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
            <?php foreach ($recentProperties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/600x400?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <div class="relative w-full">
                    <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                    <div class="absolute absolute top-0 right-0 rounded-bl-lg bg-indigo-600 px-3 py-1 text-sm font-semibold text-white shadow-sm">
                        <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                    </div>
                </div>
                <div class="max-w-xl p-6 w-full">
                    <div class="flex items-center gap-x-4 text-xs">
                        <time datetime="<?php echo $property['created_at']; ?>" class="text-gray-500"><?php echo date('d/m/Y', strtotime($property['created_at'])); ?></time>
                        <span class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"><?php echo $property['type']; ?></span>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600"><?php echo $property['description']; ?></p>
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
                        <span class="text-2xl font-bold text-indigo-600">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                        <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>" class="rounded-full bg-indigo-50 px-3 py-1.5 text-sm font-semibold text-indigo-600 shadow-sm hover:bg-indigo-100 transition-colors">Detalhes</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="mt-10 text-center">
            <a href="<?php echo APP_URL; ?>/imoveis" class="text-sm font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Ver todos os imóveis <span aria-hidden="true">→</span></a>
        </div>
    </div>
</div>
