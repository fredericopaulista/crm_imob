<div class="bg-gray-50 py-16 min-h-screen">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
         <div class="mx-auto max-w-2xl text-center mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Nosso Blog</h2>
            <p class="mt-2 text-lg leading-8 text-gray-600">Notícias, dicas e novidades do mercado imobiliário.</p>
        </div>

        <div class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
             <?php if (empty($posts)): ?>
             <div class="col-span-3 text-center py-12">
                 <p class="text-gray-500 text-lg">Nenhum artigo publicado no momento.</p>
             </div>
             <?php else: ?>
                <?php foreach ($posts as $post): 
                    $coverImage = !empty($post['image']) ? APP_URL . '/assets/uploads/' . $post['image'] : 'https://placehold.co/600x400?text=Sem+Foto';
                ?>
                <article class="flex flex-col items-start justify-between bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 group">
                    <div class="relative w-full overflow-hidden">
                        <a href="<?php echo APP_URL; ?>/blog/<?php echo $post['slug']; ?>">
                            <img src="<?php echo $coverImage; ?>" alt="<?php echo $post['title']; ?>" class="aspect-[16/9] w-full bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2] group-hover:scale-110 transition-transform duration-700">
                        </a>
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6 w-full flex flex-col flex-grow">
                        <div class="flex items-center gap-x-4 text-xs mb-3 text-gray-500">
                             <time datetime="<?php echo $post['created_at']; ?>"><?php echo date('d/m/Y', strtotime($post['created_at'])); ?></time>
                             <span>por <?php echo $post['author_name'] ?? 'Admin'; ?></span>
                        </div>
                        <div class="group relative flex-grow">
                            <h3 class="text-xl font-bold leading-6 text-gray-900 group-hover:text-brand-600 transition-colors mb-3">
                                <a href="<?php echo APP_URL; ?>/blog/<?php echo $post['slug']; ?>">
                                    <span class="absolute inset-0"></span>
                                    <?php echo $post['title']; ?>
                                </a>
                            </h3>
                            <p class="mt-2 line-clamp-3 text-sm leading-6 text-gray-600"><?php echo $post['excerpt']; ?></p>
                        </div>
                        
                        <div class="mt-6 pt-4 border-t border-gray-100 w-full">
                            <a href="<?php echo APP_URL; ?>/blog/<?php echo $post['slug']; ?>" class="text-brand-600 font-semibold text-sm hover:text-brand-700 flex items-center gap-1 group-hover:gap-2 transition-all">
                                Ler Mais <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
             <?php endif; ?>
        </div>
    </div>
</div>
