<?php
// SEO Metadata
$pageTitle = 'Contato - Fale Conosco | Correta Pro Imóveis';
$metaTitle = 'Entre em Contato - Correta Pro | Atendimento Personalizado';
$metaDescription = 'Entre em contato com a Correta Pro. Tire suas dúvidas sobre imóveis em São Paulo. Atendimento via WhatsApp, telefone ou formulário. Estamos prontos para ajudar você a encontrar o imóvel ideal.';
$canonicalUrl = APP_URL . '/contato';
$ogImage = APP_URL . '/assets/og-contact.jpg';
?>
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-2xl space-y-16 md:flex md:gap-x-10 md:space-y-0">
      <div class="max-w-xl lg:flex-auto">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900">Fale Conosco</h2>
        <p class="mt-2 text-lg leading-8 text-gray-600">Estamos prontos para tirar suas dúvidas e ajudar você a encontrar o imóvel ideal.</p>
        
        <div class="mt-10 space-y-4 text-base leading-7 text-gray-600">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fas fa-envelope text-white"></i>
                </div>
                <div>contato@corretapro.com.br</div>
            </div>
             <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fas fa-phone text-white"></i>
                </div>
                <div>(11) 99999-9999</div>
            </div>
             <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-600">
                    <i class="fas fa-map-marker-alt text-white"></i>
                </div>
                <div>Av. Paulista, 1000 - São Paulo, SP</div>
            </div>
        </div>
      </div>
      
      <div class="w-full">
         <form action="<?php echo APP_URL; ?>/enviar-contato" method="POST" class="bg-white rounded-2xl shadow-xl ring-1 ring-gray-900/5 p-8">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Nome Completo</label>
                    <div class="mt-2.5">
                    <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="email" class="block text-sm font-semibold leading-6 text-gray-900">Email</label>
                    <div class="mt-2.5">
                    <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                 <div class="sm:col-span-2">
                    <label for="phone" class="block text-sm font-semibold leading-6 text-gray-900">Telefone</label>
                    <div class="mt-2.5">
                    <input type="tel" name="phone" id="phone" autocomplete="tel" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block text-sm font-semibold leading-6 text-gray-900">Mensagem</label>
                    <div class="mt-2.5">
                    <textarea name="message" id="message" rows="4" class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                    </div>
                </div>
            </div>
            <div class="mt-8 flex justify-end">
                <button type="submit" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 w-full sm:w-auto">Enviar Mensagem</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
