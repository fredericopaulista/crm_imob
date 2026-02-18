<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Novo Imóvel</h2>
        <p class="mt-2 text-sm text-gray-500">Preencha as informações detalhadas para cadastrar uma nova propriedade no sistema.</p>
    </div>

    <form action="<?php echo APP_URL; ?>/imoveis/salvar" method="POST" enctype="multipart/form-data" class="space-y-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Main Content -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Card: Basic Information -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-8">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 mb-6">Informações Principais</h3>
                        <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Título do Anúncio</label>
                                <div class="mt-2">
                                    <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Ex: Apartamento de Luxo no Belvedere" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição Detalhada</label>
                                <div class="mt-2">
                                    <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Descreva os detalhes do imóvel..."></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card: Characteristics -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-8">
                         <h3 class="text-base font-semibold leading-7 text-gray-900 mb-6">Características do Imóvel</h3>
                         <div class="grid grid-cols-2 gap-x-6 gap-y-8 sm:grid-cols-4">
                            
                            <div class="col-span-1">
                                <label for="bedrooms" class="block text-sm font-medium leading-6 text-gray-900">Quartos</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-bed text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" name="bedrooms" id="bedrooms" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Banheiros</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-bath text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" name="bathrooms" id="bathrooms" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="garages" class="block text-sm font-medium leading-6 text-gray-900">Vagas</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-car text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" name="garages" id="garages" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Área (m²)</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-ruler-combined text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" step="0.01" name="area" id="area" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
                                </div>
                            </div>
                         </div>
                    </div>
                </div>

                <!-- Card: Media -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-8">
                        <h3 class="text-base font-semibold leading-7 text-gray-900 mb-6">Mídia e Imagens</h3>
                        
                        <div class="col-span-full">
                            <label for="images" class="block text-sm font-medium leading-6 text-gray-900">Galeria de Fotos</label>
                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 transition-colors hover:bg-gray-50 bg-gray-50/30">
                                <div class="text-center">
                                    <i class="fas fa-cloud-upload-alt text-brand-500 text-4xl mb-4"></i>
                                    <div class="mt-4 flex flex-col items-center text-sm leading-6 text-gray-600">
                                        <label for="images" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500 px-3 py-2 shadow-sm ring-1 ring-gray-300">
                                            <span>Selecionar arquivos</span>
                                            <input id="images" name="images[]" type="file" multiple class="sr-only">
                                        </label>
                                        <p class="pl-1 mt-2">ou arraste e solte aqui</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-500 mt-2">PNG, JPG, GIF até 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <!-- Right Column: Sidebar -->
            <div class="space-y-8">
                
                <!-- Card: Status & Visibility -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-6 space-y-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Publicação</h3>
                        
                        <div>
                            <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                            <select id="status" name="status" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="available" class="text-green-600 font-medium">Disponível</option>
                                <option value="reserved" class="text-yellow-600">Reservado</option>
                                <option value="sold" class="text-red-600">Vendido</option>
                                <option value="rented" class="text-blue-600">Alugado</option>
                            </select>
                        </div>

                         <div class="relative flex gap-x-3 items-start">
                            <div class="flex h-6 items-center">
                              <input id="featured" name="featured" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="text-sm leading-6">
                              <label for="featured" class="font-medium text-gray-900">Destaque na Home</label>
                              <p class="text-gray-500">Exibir este imóvel na seção principal.</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-t border-gray-900/5 px-4 py-4 sm:px-6 bg-gray-50 sm:rounded-b-xl flex justify-between items-center">
                         <a href="<?php echo APP_URL; ?>/painel/imoveis" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-600">Cancelar</a>
                         <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Imóvel</button>
                    </div>
                </div>

                <!-- Card: Categorization -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                     <div class="px-4 py-6 sm:p-6 space-y-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Classificação</h3>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Valor (R$)</label>
                            <div class="relative mt-2 rounded-md shadow-sm">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                  <span class="text-gray-500 sm:text-sm">R$</span>
                                </div>
                                <input type="number" step="0.01" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 font-semibold text-lg" placeholder="0,00" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                                <select id="type" name="type" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="Casa">Casa</option>
                                    <option value="Apartamento">Apartamento</option>
                                    <option value="Comercial">Comercial</option>
                                    <option value="Terreno">Terreno</option>
                                </select>
                            </div>
                            <div>
                                <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">Finalidade</label>
                                <select id="purpose" name="purpose" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="sale">Venda</option>
                                    <option value="rent">Aluguel</option>
                                </select>
                            </div>
                        </div>
                     </div>
                </div>

                <!-- Card: Location -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-6 space-y-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Localização</h3>

                        <div>
                            <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Endereço</label>
                            <input type="text" name="address" id="address" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                        
                        <div>
                            <label for="neighborhood" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                                <input type="text" name="city" id="city" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium leading-6 text-gray-900">UF</label>
                                <select id="state" name="state" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="AC">AC</option>
                                    <option value="AL">AL</option>
                                    <option value="AP">AP</option>
                                    <option value="AM">AM</option>
                                    <option value="BA">BA</option>
                                    <option value="CE">CE</option>
                                    <option value="DF">DF</option>
                                    <option value="ES">ES</option>
                                    <option value="GO">GO</option>
                                    <option value="MA">MA</option>
                                    <option value="MT">MT</option>
                                    <option value="MS">MS</option>
                                    <option value="MG" selected>MG</option>
                                    <option value="PA">PA</option>
                                    <option value="PB">PB</option>
                                    <option value="PR">PR</option>
                                    <option value="PE">PE</option>
                                    <option value="PI">PI</option>
                                    <option value="RJ">RJ</option>
                                    <option value="RN">RN</option>
                                    <option value="RS">RS</option>
                                    <option value="RO">RO</option>
                                    <option value="RR">RR</option>
                                    <option value="SC">SC</option>
                                    <option value="SP">SP</option>
                                    <option value="SE">SE</option>
                                    <option value="TO">TO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card: Owner -->
                <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl">
                    <div class="px-4 py-6 sm:p-6 space-y-6">
                        <h3 class="text-base font-semibold leading-7 text-gray-900">Proprietário</h3>
                        
                        <div>
                            <select id="owner_id" name="owner_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Selecione um cliente...</option>
                                <?php
                                $clientModel = new Client();
                                $owners = $clientModel->getOwners();
                                foreach ($owners as $owner): ?>
                                    <option value="<?php echo $owner['id']; ?>"><?php echo htmlspecialchars($owner['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="mt-2 text-xs text-gray-500">Selecione o proprietário deste imóvel se ele já estiver cadastrado.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
