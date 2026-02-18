<?php
// views/settings/origins/index.php
?>
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Origens de Leads</h2>
            <p class="text-sm text-gray-500 mt-1">Gerencie as fontes de onde seus leads estão vindo.</p>
        </div>
        <a href="<?php echo APP_URL; ?>/painel/leads" class="text-gray-500 hover:text-gray-700 flex items-center gap-1 font-medium">
            <i class="fas fa-arrow-left"></i> Voltar para Leads
        </a>
    </div>

    <!-- Add Origin -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Adicionar Nova Origem</h3>
        <form action="<?php echo APP_URL; ?>/painel/configuracoes/origens/salvar" method="POST" class="flex gap-4 items-end">
            <div class="flex-1">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome da Origem</label>
                <input type="text" name="name" id="name" required class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500" placeholder="Ex: LinkedIn, Evento X...">
            </div>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-2.5 rounded-lg font-semibold shadow-sm transition-colors">
                Adicionar
            </button>
        </form>
    </div>

    <!-- List Origins -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
             <h3 class="font-semibold text-gray-700">Origens Cadastradas</h3>
        </div>
        <ul class="divide-y divide-gray-100">
            <?php foreach ($origins as $origin): ?>
                <li class="p-4 flex items-center justify-between hover:bg-gray-50 group transition-colors">
                    <form action="<?php echo APP_URL; ?>/painel/configuracoes/origens/atualizar" method="POST" class="flex-1 flex gap-4 items-center">
                        <input type="hidden" name="id" value="<?php echo $origin['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($origin['name']); ?>" class="flex-1 border-none bg-transparent focus:ring-0 font-medium text-gray-800 p-0 hover:bg-white focus:bg-white transition-colors rounded px-2" onchange="this.form.submit()">
                    </form>

                    <div class="flex items-center gap-2">
                        <a href="<?php echo APP_URL; ?>/painel/configuracoes/origens/excluir?id=<?php echo $origin['id']; ?>" class="p-2 text-gray-400 hover:text-red-600 transition-colors" onclick="return confirm('Tem certeza? Isso pode afetar históricos de leads.')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
             <?php if (empty($origins)): ?>
                <li class="p-8 text-center text-gray-500">
                    Nenhuma origem cadastrada.
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
