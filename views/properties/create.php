<div class="space-y-10 divide-y divide-gray-900/10">
    <div class="grid grid-cols-1 gap-x-8 gap-y-8 md:grid-cols-3">
        <div class="px-4 sm:px-0">
            <h2 class="text-base font-semibold leading-7 text-gray-900">Novo Imóvel</h2>
            <p class="mt-1 text-sm leading-6 text-gray-600">Preencha as informações detalhadas para cadastrar uma nova propriedade no sistema.</p>
        </div>

        <form action="<?php echo APP_URL; ?>/property/store" method="POST" enctype="multipart/form-data" class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl md:col-span-2">
            <div class="px-4 py-6 sm:p-8">
                <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    
                    <div class="col-span-full">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Título do Anúncio</label>
                        <div class="mt-2">
                            <input type="text" name="title" id="title" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="type" class="block text-sm font-medium leading-6 text-gray-900">Tipo</label>
                        <div class="mt-2">
                            <select id="type" name="type" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="Casa">Casa</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Comercial">Comercial</option>
                                <option value="Terreno">Terreno</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">Finalidade</label>
                        <div class="mt-2">
                            <select id="purpose" name="purpose" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="sale">Venda</option>
                                <option value="rent">Aluguel</option>
                            </select>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="price" class="block text-sm font-medium leading-6 text-gray-900">Valor (R$)</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="price" id="price" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                     <div class="sm:col-span-3">
                        <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                         <div class="mt-2">
                            <select id="status" name="status" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="available">Disponível</option>
                                <option value="reserved">Reservado</option>
                                <option value="sold">Vendido</option>
                                <option value="rented">Alugado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="address" class="block text-sm font-medium leading-6 text-gray-900">Endereço Completo</label>
                        <div class="mt-2">
                            <input type="text" name="address" id="address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="neighborhood" class="block text-sm font-medium leading-6 text-gray-900">Bairro</label>
                        <div class="mt-2">
                            <input type="text" name="neighborhood" id="neighborhood" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Cidade</label>
                        <div class="mt-2">
                            <input type="text" name="city" id="city" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                        </div>
                    </div>
                    
                    <div class="sm:col-span-2 sm:col-start-1">
                        <label for="bedrooms" class="block text-sm font-medium leading-6 text-gray-900">Quartos</label>
                        <div class="mt-2">
                            <input type="number" name="bedrooms" id="bedrooms" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="bathrooms" class="block text-sm font-medium leading-6 text-gray-900">Banheiros</label>
                        <div class="mt-2">
                            <input type="number" name="bathrooms" id="bathrooms" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <label for="garages" class="block text-sm font-medium leading-6 text-gray-900">Vagas</label>
                        <div class="mt-2">
                            <input type="number" name="garages" id="garages" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="area" class="block text-sm font-medium leading-6 text-gray-900">Área (m²)</label>
                        <div class="mt-2">
                            <input type="number" step="0.01" name="area" id="area" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Descrição Detalhada</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="images" class="block text-sm font-medium leading-6 text-gray-900">Imagens</label>
                        <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                            <div class="text-center">
                                <i class="fas fa-images text-gray-300 text-4xl mb-4"></i>
                                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                    <label for="images" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload de imagens</span>
                                        <input id="images" name="images[]" type="file" multiple class="sr-only">
                                    </label>
                                    <p class="pl-1">ou arraste e solte</p>
                                </div>
                                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF até 10MB</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-end gap-x-6 border-t border-gray-900/10 px-4 py-4 sm:px-8">
                <a href="<?php echo APP_URL; ?>/property" type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancelar</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar Imóvel</button>
            </div>
        </form>
    </div>
</div>
