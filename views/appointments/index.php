<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Agenda de Visitas</h1>
        <p class="mt-2 text-sm text-gray-700">Visualize e gerencie seus agendamentos e visitas.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <a href="<?php echo APP_URL; ?>/painel/agenda/novo" class="block rounded-md bg-brand-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
            Novo Agendamento
        </a>
    </div>
</div>

<div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Data/Hora</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cliente (Lead)</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Imóvel</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Responsável</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Ações</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($appointments)): ?>
                            <tr>
                                <td colspan="6" class="py-4 text-center text-sm text-gray-500">Nenhum agendamento encontrado.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($appointments as $appointment): ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        <?php echo date('d/m/Y H:i', strtotime($appointment['visit_date'])); ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php echo htmlspecialchars($appointment['lead_name']); ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php echo htmlspecialchars($appointment['property_title']); ?>
                                        <div class="text-xs text-gray-400"><?php echo htmlspecialchars($appointment['property_address']); ?></div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php echo htmlspecialchars($appointment['user_name']); ?>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <?php
                                            $statusClasses = [
                                                'scheduled' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                                                'completed' => 'bg-green-50 text-green-700 ring-green-600/20',
                                                'cancelled' => 'bg-red-50 text-red-700 ring-red-600/20',
                                            ];
                                            $statusLabels = [
                                                'scheduled' => 'Agendado',
                                                'completed' => 'Concluído',
                                                'cancelled' => 'Cancelado',
                                            ];
                                            $status = $appointment['status'];
                                        ?>
                                        <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?php echo $statusClasses[$status] ?? 'bg-gray-50 text-gray-600 ring-gray-500/10'; ?>">
                                            <?php echo $statusLabels[$status] ?? ucfirst($status); ?>
                                        </span>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="<?php echo APP_URL; ?>/painel/agenda/editar?id=<?php echo $appointment['id']; ?>" class="text-brand-600 hover:text-brand-900 mr-2">Editar</a>
                                        <a href="<?php echo APP_URL; ?>/painel/agenda/excluir?id=<?php echo $appointment['id']; ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir este agendamento?')">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
