<?php
// views/site/page.php
?>
<div class="bg-white py-24 sm:py-32 min-h-screen">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700">
      <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl mb-10"><?php echo htmlspecialchars($page['title']); ?></h1>
      <div class="prose prose-brand max-w-none">
          <?php echo $page['content']; // Content is trusted as it comes from admin ?>
      </div>
    </div>
  </div>
</div>
