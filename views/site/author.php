<?php
$avatarUrl = !empty($author['avatar']) ? APP_URL . '/assets/uploads/avatars/' . $author['avatar'] : 'https://ui-avatars.com/api/?name=' . urlencode($author['name']) . '&background=0D8ABC&color=fff';
?>
<!-- Schema.org for Person -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "name": "<?php echo htmlspecialchars($author['name']); ?>",
  "description": "<?php echo htmlspecialchars($author['bio'] ?? ''); ?>",
  "image": "<?php echo $avatarUrl; ?>",
  "url": "<?php echo APP_URL . '/blog/autor/' . $author['id']; ?>",
  "sameAs": [
    "<?php echo $author['social_linkedin'] ?? ''; ?>",
    "<?php echo $author['social_instagram'] ?? ''; ?>"
  ]
}
</script>

<div class="bg-gray-50 py-16 min-h-screen">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        
        <!-- Author Profile Card -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 mb-12 flex flex-col md:flex-row items-center md:items-start gap-8">
            <img src="<?php echo $avatarUrl; ?>" alt="<?php echo htmlspecialchars($author['name']); ?>" class="w-32 h-32 rounded-full object-cover shadow-lg border-4 border-white ring-1 ring-gray-100">
            <div class="text-center md:text-left flex-1">
                <h1 class="text-3xl font-bold text-gray-900"><?php echo htmlspecialchars($author['name']); ?></h1>
                <p class="text-brand-600 font-medium mb-4"><?php echo htmlspecialchars($author['old_role'] ?? 'Colaborador'); ?></p>
                <?php if (!empty($author['bio'])): ?>
                    <p class="text-gray-600 max-w-2xl mx-auto md:mx-0"><?php echo nl2br(htmlspecialchars($author['bio'])); ?></p>
                <?php endif; ?>
                
                <div class="mt-6 flex gap-4 justify-center md:justify-start">
                    <?php if (!empty($author['social_linkedin'])): ?>
                        <a href="<?php echo $author['social_linkedin']; ?>" target="_blank" class="text-gray-400 hover:text-[#0077b5] transition-colors text-2xl"><i class="fab fa-linkedin"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($author['social_instagram'])): ?>
                        <a href="<?php echo $author['social_instagram']; ?>" target="_blank" class="text-gray-400 hover:text-[#E1306C] transition-colors text-2xl"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                </div>
            </div>
             <div class="text-center md:text-right">
                <div class="text-4xl font-bold text-gray-900"><?php echo count($authorPosts); ?></div>
                <div class="text-sm text-gray-500 uppercase tracking-wide font-semibold">Artigos Publicados</div>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-8">Artigos de <?php echo htmlspecialchars($author['name']); ?></h2>
            
             <div class="grid max-w-2xl grid-cols-1 gap-x-8 gap-y-12 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                 <?php if (empty($authorPosts)): ?>
                 <div class="col-span-3 text-center py-12">
                     <p class="text-gray-500 text-lg">Este autor ainda não publicou nenhum artigo.</p>
                 </div>
                 <?php else: ?>
                    <?php foreach ($authorPosts as $post): 
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
</div>
