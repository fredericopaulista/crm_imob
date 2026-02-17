            </div>
        </main>
        
        <footer class="mt-auto border-t border-gray-100 bg-white py-6">
            <div class="px-4 sm:px-6 lg:px-8 text-center text-xs text-gray-400">
                &copy; <?php echo date('Y'); ?> <?php echo company_name(); ?> CRM. Versão 2.1.0-beta
            </div>
        </footer>
    </div>
</div>

<!-- TinyMCE (WYSIWYG Editor) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.wysiwyg',
        height: 500,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | ' +
            'bold italic forecolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | help',
        content_style: 'body { font-family:Manrope,Helvetica,Arial,sans-serif; font-size:14px }',
        branding: false,
        promotion: false
    });
</script>

<script>
    // Toggle User Menu
    document.getElementById('user-menu-button').addEventListener('click', function() {
        var menu = document.getElementById('user-menu');
        menu.classList.toggle('hidden');
        menu.classList.toggle('transform');
        menu.classList.toggle('opacity-0');
        menu.classList.toggle('scale-95');
    });
</script>

</body>
</html>
