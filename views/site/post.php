<?php
$coverImage = !empty($post['image']) ? APP_URL . '/assets/uploads/' . $post['image'] : null;
?>
<div class="bg-white py-16 min-h-screen">
  <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700 px-6 lg:px-8">
    <div class="text-center mb-10">
        <p class="text-base font-semibold leading-7 text-brand-600">Blog</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="mt-4 flex items-center justify-center gap-4 text-sm text-gray-500">
            <span><?php echo date('d \d\e F, Y', strtotime($post['created_at'])); ?></span>
            <span>&bull;</span>
            <span>Por <?php echo htmlspecialchars($post['author_name'] ?? 'Admin'); ?></span>
        </div>
    </div>
    
    <?php if ($coverImage): ?>
    <figure class="mt-10 mb-10">
      <img class="aspect-video rounded-xl bg-gray-50 object-cover w-full shadow-lg" src="<?php echo $coverImage; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
    </figure>
    <?php endif; ?>

    <div class="mt-10 max-w-2xl mx-auto prose prose-blue prose-lg text-gray-600">
         <?php if (!empty($post['excerpt'])): ?>
            <p class="lead font-medium text-gray-900 text-xl mb-8"><?php echo htmlspecialchars($post['excerpt']); ?></p>
        <?php endif; ?>
        
        <?php echo nl2br($post['content']); // Use a dedicated HTML purifier/renderer in production ?>
    </div>
    
    <div class="mt-16 pt-8 border-t border-gray-200">
        <a href="<?php echo APP_URL; ?>/blog" class="flex items-center gap-2 text-brand-600 hover:text-brand-700 font-semibold transition-colors">
            <i class="fas fa-arrow-left"></i> Voltar para o Blog
        </a>
    </div>
  </div>
</div>
