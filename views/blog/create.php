<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Novo Post</h2>
        <a href="<?php echo APP_URL; ?>/painel/blog" class="text-gray-500 hover:text-gray-700 flex items-center gap-1">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>
    </div>

    <form action="<?php echo APP_URL; ?>/painel/blog/salvar" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 space-y-6">
        
        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título do Post</label>
            <input type="text" name="title" id="title" required class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500" placeholder="Digite o título do artigo...">
        </div>

        <!-- Slug & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug (URL Amigável)</label>
                <input type="text" name="slug" id="slug" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500" placeholder="titulo-do-artigo (opcional)">
                <p class="mt-1 text-xs text-gray-500">Deixe em branco para gerar automaticamente do título.</p>
            </div>
            <div>
                 <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                 <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500">
                     <option value="draft">Rascunho</option>
                     <option value="published">Publicado</option>
                 </select>
            </div>
        </div>

        <!-- Image -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Imagem Capa</label>
            <div class="mt-1 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 hover:bg-gray-50 transition-colors cursor-pointer" onclick="document.getElementById('image').click()">
                <div class="text-center">
                    <i class="fas fa-image text-4xl text-gray-300 mb-4"></i>
                    <div class="flex text-sm leading-6 text-gray-600 justify-center">
                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-brand-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-brand-600 focus-within:ring-offset-2 hover:text-brand-500">
                        <span>Fazer upload de imagem</span>
                        <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                        </label>
                    </div>
                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF até 10MB</p>
                </div>
            </div>
            <div id="image-preview" class="mt-4 hidden">
                <img src="" alt="Preview" class="h-48 w-full object-cover rounded-lg">
            </div>
        </div>

        <!-- Excerpt -->
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Resumo / Subtítulo</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500" placeholder="Um breve resumo do post..."></textarea>
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Conteúdo</label>
            <textarea name="content" id="content" rows="15" class="w-full rounded-lg border-gray-300 focus:border-brand-500 focus:ring-brand-500 font-mono text-sm" placeholder="Escreva seu artigo aqui... (Aceita HTML básico)"></textarea>
        </div>

        <div class="pt-4 border-t border-gray-100 flex justify-end">
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-8 py-3 rounded-lg font-semibold shadow-lg shadow-brand-500/30 transition-all transform hover:-translate-y-0.5">
                Salvar Post
            </button>
        </div>
    </form>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.querySelector('#image-preview img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
