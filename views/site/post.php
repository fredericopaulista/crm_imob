<?php
$coverImage = !empty($post['image']) ? APP_URL . '/assets/uploads/' . $post['image'] : null;

// Date Formatting in PT-BR
function formatDatePtBr($dateString) {
    if (!$dateString) return '';
    $timestamp = strtotime($dateString);
    $months = [
        1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
        5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
        9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
    ];
    
    $day = date('d', $timestamp);
    $month = $months[(int)date('m', $timestamp)];
    $year = date('Y', $timestamp);
    $time = date('H:i', $timestamp);
    
    return "{$day} de {$month} de {$year} às {$time}";
}

$formattedDate = formatDatePtBr($post['created_at']);
$authorName = htmlspecialchars($post['author_name'] ?? 'Admin');
$pageUrl = APP_URL . '/blog/' . $post['slug'];

// Schema.org JSON-LD
$schema = [
    "@context" => "https://schema.org",
    "@type" => "BlogPosting",
    "mainEntityOfPage" => [
        "@type" => "WebPage",
        "@id" => $pageUrl
    ],
    "headline" => $post['title'],
    "description" => $post['excerpt'] ?? substr(strip_tags($post['content']), 0, 160),
    "image" => $coverImage ? [$coverImage] : [],
    "author" => [
        "@type" => "Person",
        "name" => $authorName
    ],
    "publisher" => [
        "@type" => "Organization",
        "name" => company_name(),
        "logo" => [
            "@type" => "ImageObject",
            "url" => APP_URL . "/assets/logo.png" // Ensure this asset exists or use a placeholder
        ]
    ],
    "datePublished" => date('c', strtotime($post['created_at'])),
    "dateModified" => date('c', strtotime($post['updated_at'] ?? $post['created_at']))
];
?>
<!-- Schema.org Markup -->
<script type="application/ld+json">
<?php echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<div class="bg-white py-16 min-h-screen">
  <div class="mx-auto max-w-3xl text-base leading-7 text-gray-700 px-6 lg:px-8">
    <div class="text-center mb-10">
        <a href="<?php echo APP_URL; ?>/blog" class="text-base font-semibold leading-7 text-brand-600 hover:text-brand-700 transition-colors">Blog</a>
        <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl"><?php echo htmlspecialchars($post['title']); ?></h1>
        <div class="mt-4 flex items-center justify-center gap-4 text-sm text-gray-500">
            <time datetime="<?php echo $post['created_at']; ?>" class="flex items-center gap-1">
                <i class="far fa-calendar-alt"></i>
                <?php echo $formattedDate; ?>
            </time>
            <span class="text-gray-300">&bull;</span>
            <span class="flex items-center gap-1">
                <i class="far fa-user"></i>
                Por <?php echo $authorName; ?>
            </span>
        </div>
    </div>
    
    <?php if ($coverImage): ?>
    <figure class="mt-10 mb-10">
      <img class="aspect-video rounded-xl bg-gray-50 object-cover w-full shadow-lg border border-gray-100" src="<?php echo $coverImage; ?>" alt="<?php echo htmlspecialchars($post['title']); ?>">
    </figure>
    <?php endif; ?>

    <div class="mt-10 max-w-2xl mx-auto prose prose-blue prose-lg text-gray-600">
         <?php if (!empty($post['excerpt'])): ?>
            <p class="lead font-medium text-gray-900 text-xl mb-8 border-l-4 border-brand-500 pl-4 bg-gray-50 py-2 rounded-r-lg"><?php echo htmlspecialchars($post['excerpt']); ?></p>
        <?php endif; ?>
        
        <div class="blog-content">
            <?php echo $post['content']; // Raw HTML from TinyMCE ?>
        </div>
    </div>
    
    <!-- Share & Navigation -->
    <div class="mt-16 pt-8 border-t border-gray-200 flex flex-col sm:flex-row justify-between items-center gap-4">
        <a href="<?php echo APP_URL; ?>/blog" class="flex items-center gap-2 text-gray-600 hover:text-brand-600 font-semibold transition-colors group">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Voltar para o Blog
        </a>
        
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium text-gray-500">Compartilhar:</span>
            <a href="https://wa.me/?text=<?php echo urlencode($post['title'] . ' - ' . $pageUrl); ?>" target="_blank" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center hover:bg-green-600 transition-colors" title="Compartilhar no WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($pageUrl); ?>" target="_blank" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors" title="Compartilhar no Facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($post['title']); ?>&url=<?php echo urlencode($pageUrl); ?>" target="_blank" class="w-8 h-8 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 transition-colors" title="Compartilhar no X">
                <i class="fab fa-x-twitter"></i>
            </a>
        </div>
    </div>
  </div>
</div>
