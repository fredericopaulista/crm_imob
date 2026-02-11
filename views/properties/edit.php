<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Editar Imóvel</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Atualize as informações da propriedade.</p>
        </div>

        <form action="<?php echo APP_URL; ?>/painel/imoveis/atualizar" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <input type="hidden" name="id" value="<?php echo $property['id']; ?>">
            
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="col-span-full">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Título do Anúncio</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($property['title']); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                        <div class="mt-2">
                            <select id="type" name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="Casa" <?php echo ($property['type'] == 'Casa') ? 'selected' : ''; ?>>Casa</option>
                                <option value="Apartamento" <?php echo ($property['type'] == 'Apartamento') ? 'selected' : ''; ?>>Apartamento</option>
                                <option value="Comercial" <?php echo ($property['type'] == 'Comercial') ? 'selected' : ''; ?>>Comercial</option>
                                <option value="Terreno" <?php echo ($property['type'] == 'Terreno') ? 'selected' : ''; ?>>Terreno</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">Finalidade</label>
                        <div class="mt-2">
                            <select id="purpose" name="purpose" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="sale" <?php echo ($property['purpose'] == 'sale') ? 'selected' : ''; ?>>Venda</option>
                                <option value="rent" <?php echo ($property['purpose'] == 'rent') ? 'selected' : ''; ?>>Aluguel</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Valor (R$)</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="price" id="price" value="<?php echo $property['price']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                     <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                         <div class="mt-2">
                            <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="available" <?php echo ($property['status'] == 'available') ? 'selected' : ''; ?>>Disponível</option>
                                <option value="reserved" <?php echo ($property['status'] == 'reserved') ? 'selected' : ''; ?>>Reservado</option>
                                <option value="sold" <?php echo ($property['status'] == 'sold') ? 'selected' : ''; ?>>Vendido</option>
                                <option value="rented" <?php echo ($property['status'] == 'rented') ? 'selected' : ''; ?>>Alugado</option>
                            </select>
                        </div>
                    </div>

                     <div class="sm:col-span-3">
                        <label for="owner_id" class="block text-sm font-medium leading-6 text-gray-900">Proprietário</label>
                         <div class="mt-2">
                            <select id="owner_id" name="owner_id" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="">Selecione (opcional)</option>
                                <?php
                                $clientModel = new Client();
                                $owners = $clientModel->getOwners();
                                foreach ($owners as $owner): ?>
                                    <option value="<?php echo $owner['id']; ?>" <?php echo ($property['owner_id'] == $owner['id']) ? 'selected' : ''; ?>><?php echo htmlspecialchars($owner['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-full">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Endereço Completo</label>
                        <div class="mt-2">
                            <input type="text" name="address" id="address" value="<?php echo htmlspecialchars($property['address']); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="neighborhood" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                        <div class="mt-2">
                            <input type="text" name="neighborhood" id="neighborhood" value="<?php echo htmlspecialchars($property['neighborhood']); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                        <div class="mt-2">
                            <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($property['city']); ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Área (m²)</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="area" id="area" value="<?php echo $property['area']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="bedrooms" class="block text-sm font-medium leading-6 text-gray-900">Quartos</label>
                        <div class="mt-2">
                            <input type="number" name="bedrooms" id="bedrooms" value="<?php echo $property['bedrooms']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Banheiros</label>
                        <div class="mt-2">
                            <input type="number" name="bathrooms" id="bathrooms" value="<?php echo $property['bathrooms']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="garages" class="block text-sm font-medium leading-6 text-gray-900">Vagas</label>
                        <div class="mt-2">
                            <input type="number" name="garages" id="garages" value="<?php echo $property['garages']; ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="4" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?php echo htmlspecialchars($property['description'] ?? ''); ?></textarea>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="images" class="block text-sm font-medium leading-6 text-gray-900">Imagens (opcional - adicionar novas)</label>
                        <div class="mt-2">
                            <input type="file" name="images[]" id="images" multiple accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                        </div>
                        <?php if (!empty($property['images'])): 
                            $existingImages = json_decode($property['images'], true);
                            if ($existingImages): ?>
                            <div class="mt-4">
                                <p class="text-sm text-gray-600 mb-2">Imagens atuais:</p>
                                <div class="grid grid-cols-3 gap-4">
                                    <?php foreach ($existingImages as $img): ?>
                                        <img src="<?php echo APP_URL; ?>/assets/uploads/<?php echo $img; ?>" alt="Imagem do imóvel" class="w-full h-32 object-cover rounded-lg">
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; endif; ?>
                    </div>

                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="<?php echo APP_URL; ?>/painel/imoveis" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
