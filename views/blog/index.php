<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-gray-800">Gerenciar Posts</h2>
        <a href="<?php echo APP_URL; ?>/painel/blog/novo" class="bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
            <i class="fas fa-plus"></i> Novo Post
        </a>
    </div>
    
    <?php if (isset($_SESSION['success'])): ?>
    <div class="mx-6 mt-6 bg-green-50 text-green-700 p-4 rounded-lg border border-green-200 flex items-center gap-2">
        <i class="fas fa-check-circle"></i>
        <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
    <div class="mx-6 mt-6 bg-red-50 text-red-700 p-4 rounded-lg border border-red-200 flex items-center gap-2">
        <i class="fas fa-exclamation-circle"></i>
        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-900 font-semibold border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Título</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Autor</th>
                    <th class="px-6 py-4">Data</th>
                    <th class="px-6 py-4 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (empty($posts)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        Nenhum post encontrado.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">
                            <?php echo htmlspecialchars($post['title']); ?>
                            <a href="<?php echo APP_URL . '/blog/' . $post['slug']; ?>" target="_blank" class="text-gray-400 hover:text-brand-600 ml-2 text-xs">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <?php 
                                $statusClass = $post['status'] === 'published' 
                                    ? 'bg-green-100 text-green-700 ring-green-600/20' 
                                    : 'bg-yellow-100 text-yellow-700 ring-yellow-600/20';
                                $statusLabel = $post['status'] === 'published' ? 'Publicado' : 'Rascunho';
                            ?>
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo $statusClass; ?>">
                                <?php echo $statusLabel; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="h-6 w-6 rounded-full bg-gray-200 flex items-center justify-center text-xs text-gray-500 font-bold">
                                    <?php echo substr($post['author_name'] ?? 'U', 0, 1); ?>
                                </div>
                                <?php echo htmlspecialchars($post['author_name'] ?? 'Sistema'); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <?php echo date('d/m/Y', strtotime($post['created_at'])); ?>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex justify-end gap-2">
                                <a href="<?php echo APP_URL; ?>/painel/blog/editar?id=<?php echo $post['id']; ?>" class="p-2 text-brand-600 hover:bg-brand-50 rounded-lg transition-colors" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo APP_URL; ?>/painel/blog/excluir" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este post?');" class="inline">
                                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Excluir">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
