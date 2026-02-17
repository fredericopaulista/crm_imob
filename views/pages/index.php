<?php
// views/pages/index.php
?>
<div class="bg-white rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Páginas de Conteúdo</h2>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700">
                <tr>
                    <th class="px-6 py-3">Título</th>
                    <th class="px-6 py-3">Slug (URL)</th>
                    <th class="px-6 py-3">Última Atualização</th>
                    <th class="px-6 py-3 text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                <?php foreach ($pages as $page): ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        <?php echo htmlspecialchars($page['title']); ?>
                    </td>
                    <td class="px-6 py-4">
                        /<?php echo htmlspecialchars($page['slug']); ?>
                    </td>
                    <td class="px-6 py-4">
                        <?php echo date('d/m/Y H:i', strtotime($page['updated_at'])); ?>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="<?php echo APP_URL; ?>/painel/paginas/editar?id=<?php echo $page['id']; ?>" class="font-medium text-brand-600 hover:text-brand-900 transition-colors mr-3">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="<?php echo APP_URL; ?>/<?php echo $page['slug']; ?>" target="_blank" class="font-medium text-gray-500 hover:text-gray-900 transition-colors">
                            <i class="fas fa-external-link-alt"></i> Ver
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
