<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Editar Imóvel</h2>
        <p class="mt-2 text-sm text-gray-500">Atualize as informações desta propriedade.</p>
    </div>

    <form action="<?php echo APP_URL; ?>/painel/imoveis/atualizar" method="POST" enctype="multipart/form-data" class="space-y-8">
        <input type="hidden" name="id" value="<?php echo $property['id']; ?>">
        
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
                                    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($property['title']); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição Detalhada</label>
                                <div class="mt-2">
                                    <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo htmlspecialchars($property['description'] ?? ''); ?></textarea>
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
                                    <input type="number" name="bedrooms" id="bedrooms" value="<?php echo $property['bedrooms']; ?>" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Banheiros</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-bath text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" name="bathrooms" id="bathrooms" value="<?php echo $property['bathrooms']; ?>" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="garages" class="block text-sm font-medium leading-6 text-gray-900">Vagas</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-car text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" name="garages" id="garages" value="<?php echo $property['garages']; ?>" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-1">
                                <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Área (m²)</label>
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                      <i class="fas fa-ruler-combined text-gray-400 sm:text-xs"></i>
                                    </div>
                                    <input type="number" step="0.01" name="area" id="area" value="<?php echo $property['area']; ?>" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                             <label for="images" class="block text-sm font-medium leading-6 text-gray-900">Imagens (adicionar novas)</label>
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

                            <?php if (!empty($property['images'])): 
                                $existingImages = json_decode($property['images'], true);
                                if ($existingImages): ?>
                                <div class="mt-6 border-t border-gray-100 pt-6">
                                    <p class="text-sm font-medium text-gray-900 mb-4">Galeria Atual</p>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                        <?php foreach ($existingImages as $img): ?>
                                            <div class="group relative aspect-video bg-gray-100 rounded-lg overflow-hidden">
                                                <img src="<?php echo APP_URL; ?>/assets/uploads/<?php echo $img; ?>" alt="Imagem do imóvel" class="absolute inset-0 h-full w-full object-cover group-hover:opacity-75 transition-opacity">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; endif; ?>
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
                                <option value="available" <?php echo ($property['status'] == 'available') ? 'selected' : ''; ?>>Disponível</option>
                                <option value="reserved" <?php echo ($property['status'] == 'reserved') ? 'selected' : ''; ?>>Reservado</option>
                                <option value="sold" <?php echo ($property['status'] == 'sold') ? 'selected' : ''; ?>>Vendido</option>
                                <option value="rented" <?php echo ($property['status'] == 'rented') ? 'selected' : ''; ?>>Alugado</option>
                            </select>
                        </div>

                         <div class="relative flex gap-x-3 items-start">
                            <div class="flex h-6 items-center">
                              <input id="featured" name="featured" type="checkbox" value="1" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" <?php echo (!empty($property['featured'])) ? 'checked' : ''; ?>>
                            </div>
                            <div class="text-sm leading-6">
                              <label for="featured" class="font-medium text-gray-900">Destaque na Home</label>
                              <p class="text-gray-500">Exibir este imóvel na seção principal.</p>
                            </div>
                        </div>
                    </div>
                     <div class="border-t border-gray-900/5 px-4 py-4 sm:px-6 bg-gray-50 sm:rounded-b-xl flex justify-between items-center">
                         <a href="<?php echo APP_URL; ?>/painel/imoveis" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-600">Cancelar</a>
                         <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Alterações</button>
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
                                <input type="number" step="0.01" name="price" id="price" value="<?php echo $property['price']; ?>" class="block w-full rounded-md border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 font-semibold text-lg" placeholder="0,00" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                             <div>
                                <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                                <select id="type" name="type" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="Casa" <?php echo ($property['type'] == 'Casa') ? 'selected' : ''; ?>>Casa</option>
                                    <option value="Apartamento" <?php echo ($property['type'] == 'Apartamento') ? 'selected' : ''; ?>>Apartamento</option>
                                    <option value="Comercial" <?php echo ($property['type'] == 'Comercial') ? 'selected' : ''; ?>>Comercial</option>
                                    <option value="Terreno" <?php echo ($property['type'] == 'Terreno') ? 'selected' : ''; ?>>Terreno</option>
                                </select>
                            </div>
                            <div>
                                <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">Finalidade</label>
                                <select id="purpose" name="purpose" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <option value="sale" <?php echo ($property['purpose'] == 'sale') ? 'selected' : ''; ?>>Venda</option>
                                    <option value="rent" <?php echo ($property['purpose'] == 'rent') ? 'selected' : ''; ?>>Aluguel</option>
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
                            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($property['address']); ?>" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                        
                        <div>
                            <label for="neighborhood" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" value="<?php echo htmlspecialchars($property['neighborhood']); ?>" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                                <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($property['city']); ?>" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                            </div>
                             <div>
                                <label for="state" class="block text-sm font-medium leading-6 text-gray-900">UF</label>
                                <select id="state" name="state" class="mt-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                    <?php
                                    $states = ['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'];
                                    $currentState = $property['state'] ?? 'MG';
                                    foreach ($states as $uf) {
                                        $selected = ($currentState === $uf) ? 'selected' : '';
                                        echo "<option value=\"{$uf}\" {$selected}>{$uf}</option>";
                                    }
                                    ?>
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
                                    <option value="<?php echo $owner['id']; ?>" <?php echo ($property['owner_id'] == $owner['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($owner['name']); ?></option>
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
