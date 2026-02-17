    </div> <!-- End Main Content Spacing -->

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Brand -->
                <div>
                     <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white text-sm">
                            <i class="fas fa-home"></i>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight"><?php echo company_name(); ?></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Transformando sonhos em realidade com transparência, tecnologia e atendimento personalizado. Encontre hoje o seu lugar no mundo.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition-all">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                         <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-green-600 hover:text-white transition-all">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 border-b border-gray-800 pb-2 inline-block">Menu Rápido</h3>
                    <ul class="space-y-3">
                        <li><a href="<?php echo APP_URL; ?>" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Início</a></li>
                        <li><a href="<?php echo APP_URL; ?>/imoveis" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Buscar Imóveis</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Sobre Nós</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Blog</a></li>
                        <li><a href="<?php echo APP_URL; ?>/contato" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Fale Conosco</a></li>
                    </ul>
                </div>

                <!-- Properties -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 border-b border-gray-800 pb-2 inline-block">Imóveis</h3>
                    <ul class="space-y-3">
                        <li><a href="<?php echo APP_URL; ?>/imoveis?type=Casa" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Casas à Venda</a></li>
                        <li><a href="<?php echo APP_URL; ?>/imoveis?type=Apartamento" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Apartamentos</a></li>
                        <li><a href="<?php echo APP_URL; ?>/imoveis?purpose=rent" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Aluguel</a></li>
                        <li><a href="<?php echo APP_URL; ?>/imoveis?type=Cobertura" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Coberturas de Luxo</a></li>
                        <li><a href="<?php echo APP_URL; ?>/imoveis?status=launch" class="text-gray-400 hover:text-brand-500 transition-colors text-sm">Lançamentos</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 border-b border-gray-800 pb-2 inline-block">Contato</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-3 text-gray-400 text-sm">
                            <i class="fas fa-map-marker-alt mt-1 text-brand-500"></i>
                            <span><?php echo get_setting('company_address', 'Av. Paulista, 1000 - Bela Vista, São Paulo - SP'); ?></span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
                            <i class="fas fa-phone-alt text-brand-500"></i>
                            <span><?php echo get_setting('company_phone', '(11) 99999-9999'); ?></span>
                        </li>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
                            <i class="fas fa-envelope text-brand-500"></i>
                            <span><?php echo get_setting('company_email', 'contato@corretapro.com.br'); ?></span>
                        </li>
                        <?php if (get_setting('company_creci')): ?>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
                            <i class="fas fa-id-card text-brand-500"></i>
                            <span>CRECI: <?php echo get_setting('company_creci'); ?></span>
                        </li>
                        <?php endif; ?>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
                            <i class="fas fa-clock text-brand-500"></i>
                            <span><?php echo get_setting('company_hours', 'Seg - Sex: 09:00 - 18:00'); ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-500 text-xs">
                    &copy; <?php echo date('Y'); ?> <?php echo company_name(); ?>. Todos os direitos reservados.
                </p>
                <div class="flex gap-6 text-xs text-gray-500">
                    <a href="<?php echo APP_URL; ?>/termos-de-uso" class="hover:text-white transition-colors">Termos de Uso</a>
                    <a href="<?php echo APP_URL; ?>/politica-de-privacidade" class="hover:text-white transition-colors">Política de Privacidade</a>
                    <a href="<?php echo APP_URL; ?>/cookies" class="hover:text-white transition-colors">Cookies</a>
                    <a href="<?php echo APP_URL; ?>/sitemap" class="hover:text-white transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
