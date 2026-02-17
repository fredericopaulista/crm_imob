<?php
// views/pages/edit.php
?>
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100">
        <h2 class="text-lg font-semibold text-gray-800">Editar Página: <?php echo htmlspecialchars($page['title']); ?></h2>
    </div>
    
    <form action="<?php echo APP_URL; ?>/painel/paginas/atualizar" method="POST" class="p-6">
        <input type="hidden" name="id" value="<?php echo $page['id']; ?>">
        
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título da Página</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($page['title']); ?>" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border" required>
        </div>

        <div class="mb-6">
            <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL (Slug) - <span class="text-gray-500 font-normal">Não editável</span></label>
            <input type="text" value="<?php echo htmlspecialchars($page['slug']); ?>" class="w-full rounded-md border-gray-300 bg-gray-100 text-gray-500 sm:text-sm p-2.5 border cursor-not-allowed" disabled>
        </div>

        <div class="mb-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Conteúdo</label>
            <div class="text-xs text-gray-500 mb-2">Use tags HTML básicas para formatar (h2, p, ul, strong, etc).</div>
            <textarea name="content" id="content" rows="20" class="w-full rounded-md border-gray-300 shadow-sm focus:border-brand-500 focus:ring-brand-500 sm:text-sm p-2.5 border font-mono text-sm"><?php echo htmlspecialchars($page['content']); ?></textarea>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="<?php echo APP_URL; ?>/painel/paginas" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-brand-600 border border-transparent rounded-md hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500">
                Salvar Alterações
            </button>
        </div>
    </form>
</div>
