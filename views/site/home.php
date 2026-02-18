<?php
// SEO Metadata
$pageTitle = company_name() . ' - Imóveis em São Paulo | Compra, Venda e Aluguel';
$metaTitle = 'Imóveis em São Paulo - Apartamentos, Casas e Coberturas | ' . company_name();
$metaDescription = 'Encontre o imóvel dos seus sonhos em São Paulo. Apartamentos, casas e coberturas nos melhores bairros: Jardins, Pinheiros, Vila Madalena, Brooklin. Venda e aluguel com atendimento personalizado.';
$canonicalUrl = APP_URL . '/';
$ogImage = APP_URL . '/assets/og-home.jpg';
?>

<!-- Hero Section -->
<div class="relative bg-white pt-16 pb-32 overflow-hidden">
    <div class="absolute inset-0">
        <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1600596542815-2495db9a9cf4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" alt="Imóvel de luxo">
        <div class="absolute inset-0 bg-gray-900/60 mix-blend-multiply"></div>
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl text-center mb-6 drop-shadow-lg">
            Encontre o Imóvel dos Seus Sonhos
        </h1>
        <p class="mt-6 text-xl text-gray-100 max-w-3xl mx-auto text-center drop-shadow-md">
            Milhares de opções de casas, apartamentos e coberturas nos melhores bairros de São Paulo. Seu novo lar está aqui.
        </p>

        <!-- Search Box -->
        <div class="mt-10 max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-4 sm:p-6 transform transition-all hover:scale-[1.01]">
            <form action="<?php echo APP_URL; ?>/imoveis" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <label for="city" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Localização</label>
                    <div class="relative">
                         <i class="fas fa-map-marker-alt absolute left-3 top-3 text-gray-400"></i>
                        <input type="text" name="city" id="city" placeholder="Bairro ou Cidade" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-gray-900 placeholder-gray-400 bg-gray-50/50">
                    </div>
                </div>
                
                <div class="relative">
                    <label for="type" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Tipo</label>
                    <div class="relative">
                        <i class="fas fa-home absolute left-3 top-3 text-gray-400"></i>
                        <select name="type" id="type" class="block w-full pl-10 pr-10 py-2.5 border border-gray-200 rounded-lg focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-gray-900 bg-gray-50/50 appearance-none">
                            <option value="">Todos os tipos</option>
                            <option value="Apartamento">Apartamento</option>
                            <option value="Casa">Casa</option>
                            <option value="Cobertura">Cobertura</option>
                            <option value="Comercial">Comercial</option>
                        </select>
                        <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none text-xs"></i>
                    </div>
                </div>

                <div class="relative">
                     <label for="price_max" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Preço Máx.</label>
                     <div class="relative">
                         <span class="absolute left-3 top-2.5 text-gray-400 text-sm">R$</span>
                        <input type="number" name="price_max" id="price_max" placeholder="Ex: 500.000" class="block w-full pl-9 pr-3 py-2.5 border border-gray-200 rounded-lg focus:ring-brand-500 focus:border-brand-500 sm:text-sm text-gray-900 placeholder-gray-400 bg-gray-50/50">
                    </div>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="w-full bg-brand-600 border border-transparent rounded-xl py-2.5 px-4 flex items-center justify-center text-base font-medium text-white hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 shadow-lg shadow-brand-500/30 transition-all hover:translate-y-[-1px]">
                        <i class="fas fa-search mr-2"></i> Buscar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-semibold text-brand-600 tracking-wide uppercase">Por que nos escolher?</h2>
            <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                A melhor experiência imobiliária
            </p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
             <div class="pt-6">
                <div class="flow-root bg-white rounded-3xl px-6 pb-8 pt-10 shadow-sm hover:shadow-xl transition-shadow duration-300 h-full border border-gray-100">
                    <div class="-mt-14">
                        <div class="inline-flex items-center justify-center p-3 bg-brand-600 rounded-2xl shadow-lg shadow-brand-500/40">
                            <i class="fas fa-check-circle text-white text-2xl"></i>
                        </div>
                        <h3 class="mt-8 text-xl font-bold text-gray-900 tracking-tight">Imóveis Verificados</h3>
                        <p class="mt-5 text-base text-gray-500 leading-relaxed">
                            Todos os imóveis passam por uma rigorosa verificação jurídica e técnica antes de serem anunciados.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                 <div class="flow-root bg-white rounded-3xl px-6 pb-8 pt-10 shadow-sm hover:shadow-xl transition-shadow duration-300 h-full border border-gray-100">
                    <div class="-mt-14">
                        <div class="inline-flex items-center justify-center p-3 bg-brand-600 rounded-2xl shadow-lg shadow-brand-500/40">
                             <i class="fas fa-user-shield text-white text-2xl"></i>
                        </div>
                        <h3 class="mt-8 text-xl font-bold text-gray-900 tracking-tight">Segurança Total</h3>
                        <p class="mt-5 text-base text-gray-500 leading-relaxed">
                            Assessoria jurídica completa do início ao fim do processo, garantindo tranquilidade para comprador e vendedor.
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                 <div class="flow-root bg-white rounded-3xl px-6 pb-8 pt-10 shadow-sm hover:shadow-xl transition-shadow duration-300 h-full border border-gray-100">
                    <div class="-mt-14">
                        <div class="inline-flex items-center justify-center p-3 bg-brand-600 rounded-2xl shadow-lg shadow-brand-500/40">
                             <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                        <h3 class="mt-8 text-xl font-bold text-gray-900 tracking-tight">Suporte Premium</h3>
                        <p class="mt-5 text-base text-gray-500 leading-relaxed">
                            Atendimento personalizado e dedicado via WhatsApp, telefone ou presencialmente em nosso escritório.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Properties -->
<?php if (!empty($featuredProperties)): ?>
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Imóveis em Destaque ⭐</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">Confira nossa seleção exclusiva das melhores oportunidades.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
             <?php foreach ($featuredProperties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/800x600/f3f4f6/9ca3af?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between group cursor-pointer" onclick="window.location.href='<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>'">
                <div class="relative w-full overflow-hidden rounded-2xl shadow-md transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                    <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-700 shadow-sm">
                         <?php echo $property['purpose'] == 'sale' ? 'Venda' : 'Aluguel'; ?>
                    </div>
                     <span class="absolute bottom-4 left-4 bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-md shadow-sm">
                        <i class="fas fa-star mr-1"></i> Destaque
                    </span>
                </div>
                <div class="max-w-xl w-full mt-4">
                    <div class="flex items-center gap-x-4 text-xs">
                        <span class="text-brand-600 font-bold bg-brand-50 px-2 py-1 rounded-md"><?php echo $property['type']; ?></span>
                        <time datetime="<?php echo $property['created_at']; ?>" class="text-gray-500"><?php echo date('d M Y', strtotime($property['created_at'])); ?></time>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-bold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600 line-clamp-2"><?php echo $property['description']; ?></p>
                    </div>
                    
                     <div class="mt-4 flex items-center justify-between text-gray-500 text-sm border-t border-gray-100 pt-4">
                         <div class="flex items-center gap-1.5"><i class="fas fa-bed"></i> <?php echo $property['bedrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-bath"></i> <?php echo $property['bathrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-ruler-combined"></i> <?php echo $property['area']; ?>m²</div>
                    </div>

                    <div class="mt-4 flex items-center justify-between">
                         <span class="text-2xl font-bold text-gray-900">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                         <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-brand-600 group-hover:text-white transition-all">
                             <i class="fas fa-arrow-right text-sm"></i>
                         </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Sale Properties -->
<?php if (!empty($saleProperties)): ?>
<div class="bg-gray-50 py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Imóveis à Venda 🏠</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">Encontre a casa dos seus sonhos para comprar.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
             <?php foreach ($saleProperties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/800x600/f3f4f6/9ca3af?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between group cursor-pointer" onclick="window.location.href='<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>'">
                 <div class="relative w-full overflow-hidden rounded-2xl shadow-md transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                    <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-700 shadow-sm">
                         Venda
                    </div>
                </div>
                <div class="max-w-xl w-full mt-4">
                     <div class="flex items-center gap-x-4 text-xs">
                        <span class="text-brand-600 font-bold bg-brand-50 px-2 py-1 rounded-md"><?php echo $property['type']; ?></span>
                        <time datetime="<?php echo $property['created_at']; ?>" class="text-gray-500"><?php echo date('d M Y', strtotime($property['created_at'])); ?></time>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-bold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600 line-clamp-2"><?php echo $property['description']; ?></p>
                    </div>
                     <div class="mt-4 flex items-center justify-between text-gray-500 text-sm border-t border-gray-100 pt-4">
                         <div class="flex items-center gap-1.5"><i class="fas fa-bed"></i> <?php echo $property['bedrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-bath"></i> <?php echo $property['bathrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-ruler-combined"></i> <?php echo $property['area']; ?>m²</div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                         <span class="text-2xl font-bold text-gray-900">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                         <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-brand-600 group-hover:text-white transition-all">
                             <i class="fas fa-arrow-right text-sm"></i>
                         </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="mt-12 text-center">
            <a href="<?php echo APP_URL; ?>/imoveis?type=&purpose=sale" class="text-sm font-semibold leading-6 text-brand-600 hover:text-brand-500">Ver todos à venda <span aria-hidden="true">→</span></a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Rent Properties -->
<?php if (!empty($rentProperties)): ?>
<div class="bg-white py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Imóveis para Alugar 🔑</h2>
            <p class="mt-4 text-lg leading-8 text-gray-600">As melhores opções de aluguel na região.</p>
        </div>
        <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
             <?php foreach ($rentProperties as $property): 
                $images = json_decode($property['images'], true);
                $coverImage = !empty($images) ? APP_URL . '/assets/uploads/' . $images[0] : 'https://placehold.co/800x600/f3f4f6/9ca3af?text=Sem+Foto';
            ?>
            <article class="flex flex-col items-start justify-between group cursor-pointer" onclick="window.location.href='<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>'">
                 <div class="relative w-full overflow-hidden rounded-2xl shadow-md transition-all duration-300 group-hover:shadow-xl group-hover:-translate-y-1">
                    <img src="<?php echo $coverImage; ?>" alt="<?php echo $property['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] transition-transform duration-500 group-hover:scale-110">
                   <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                     <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-brand-700 shadow-sm">
                         Aluguel
                    </div>
                </div>
                <div class="max-w-xl w-full mt-4">
                     <div class="flex items-center gap-x-4 text-xs">
                        <span class="text-brand-600 font-bold bg-brand-50 px-2 py-1 rounded-md"><?php echo $property['type']; ?></span>
                        <time datetime="<?php echo $property['created_at']; ?>" class="text-gray-500"><?php echo date('d M Y', strtotime($property['created_at'])); ?></time>
                    </div>
                    <div class="group relative">
                        <h3 class="mt-3 text-lg font-bold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors">
                            <a href="<?php echo APP_URL; ?>/imovel/<?php echo $property['slug'] ?? $property['id']; ?>">
                                <span class="absolute inset-0"></span>
                                <?php echo $property['title']; ?>
                            </a>
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-gray-600 line-clamp-2"><?php echo $property['description']; ?></p>
                    </div>
                     <div class="mt-4 flex items-center justify-between text-gray-500 text-sm border-t border-gray-100 pt-4">
                         <div class="flex items-center gap-1.5"><i class="fas fa-bed"></i> <?php echo $property['bedrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-bath"></i> <?php echo $property['bathrooms']; ?></div>
                         <div class="flex items-center gap-1.5"><i class="fas fa-ruler-combined"></i> <?php echo $property['area']; ?>m²</div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                         <span class="text-2xl font-bold text-gray-900">R$ <?php echo number_format($property['price'], 2, ',', '.'); ?></span>
                         <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-brand-600 group-hover:text-white transition-all">
                             <i class="fas fa-arrow-right text-sm"></i>
                         </div>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="mt-12 text-center">
             <a href="<?php echo APP_URL; ?>/imoveis?type=&purpose=rent" class="text-sm font-semibold leading-6 text-brand-600 hover:text-brand-500">Ver todos para alugar <span aria-hidden="true">→</span></a>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Testimonials -->
<section class="py-24 bg-gray-900 relative overflow-hidden">
    <!-- Decorative blobs -->
    <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-brand-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-base font-semibold text-brand-400 tracking-wide uppercase">Depoimentos</h2>
            <p class="mt-2 text-3xl font-extrabold text-white sm:text-4xl">
                O que dizem nossos clientes
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-gray-800 rounded-2xl p-8 relative">
                <i class="fas fa-quote-right absolute top-6 right-6 text-gray-700 text-4xl"></i>
                <p class="text-gray-300 leading-relaxed mb-6">"Encontrei meu apartamento ideal em menos de uma semana. O atendimento foi excepcional e muito transparente. Recomendo demais!"</p>
                <div class="flex items-center gap-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Mariana Costa" class="w-12 h-12 rounded-full border-2 border-brand-500">
                    <div>
                        <h4 class="text-white font-bold text-sm">Mariana Costa</h4>
                        <span class="text-gray-500 text-xs">Compradora, Jardins</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 2 -->
             <div class="bg-gray-800 rounded-2xl p-8 relative">
                <i class="fas fa-quote-right absolute top-6 right-6 text-gray-700 text-4xl"></i>
                <p class="text-gray-300 leading-relaxed mb-6">"A plataforma é muito intuitiva e os filtros realmente funcionam. Processo de venda foi rápido e sem burocracia desnecessária."</p>
                <div class="flex items-center gap-4">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Ricardo Mendes" class="w-12 h-12 rounded-full border-2 border-brand-500">
                    <div>
                        <h4 class="text-white font-bold text-sm">Ricardo Mendes</h4>
                        <span class="text-gray-500 text-xs">Investidor, Pinheiros</span>
                    </div>
                </div>
            </div>

            <!-- Testimonial 3 -->
             <div class="bg-gray-800 rounded-2xl p-8 relative">
                <i class="fas fa-quote-right absolute top-6 right-6 text-gray-700 text-4xl"></i>
                <p class="text-gray-300 leading-relaxed mb-6">"Profissionalismo nota 10. A equipe me ajudou a avaliar meu imóvel com precisão e vendemos pelo preço justo em 15 dias."</p>
                <div class="flex items-center gap-4">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Carlos Silva" class="w-12 h-12 rounded-full border-2 border-brand-500">
                    <div>
                        <h4 class="text-white font-bold text-sm">Carlos Silva</h4>
                        <span class="text-gray-500 text-xs">Vendedor, Brooklin</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
