<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales/pt-br.js'></script>

<div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Agenda de Visitas</h1>
        <p class="mt-2 text-sm text-gray-700">Visualize e gerencie seus agendamentos.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
        <div class="flex gap-2">
            <button id="toggleView" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                Alternar Lista/Calendário
            </button>
            <a href="<?php echo APP_URL; ?>/painel/agenda/novo" class="block rounded-md bg-brand-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-brand-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600">
                Novo Agendamento
            </a>
        </div>
    </div>
</div>

<!-- Calendar Container -->
<div id="calendar-container" class="mt-8 bg-white p-4 rounded-xl shadow-sm ring-1 ring-gray-900/5">
    <div id='calendar'></div>
</div>

<!-- List Container (Hidden by default, used as fallback or toggle) -->
<div id="list-container" class="mt-8 flow-root hidden">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Data/Hora</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cliente</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Imóvel</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Ações</span></th>
                        </tr>
                    </thead>
                     <tbody class="divide-y divide-gray-200 bg-white">
                        <?php if (empty($appointments)): ?>
                            <tr><td colspan="5" class="py-4 text-center text-sm text-gray-500">Nenhum agendamento.</td></tr>
                        <?php else: ?>
                            <?php foreach ($appointments as $appointment): ?>
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo date('d/m/Y H:i', strtotime($appointment['visit_date'])); ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($appointment['lead_name']); ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($appointment['property_title']); ?></td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo htmlspecialchars($appointment['status']); ?></td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="<?php echo APP_URL; ?>/painel/agenda/editar?id=<?php echo $appointment['id']; ?>" class="text-brand-600 hover:text-brand-900">Editar</a>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var listContainer = document.getElementById('list-container');
    var calendarContainer = document.getElementById('calendar-container');
    var toggleBtn = document.getElementById('toggleView');
    
    // Initialize Calendar
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt-br',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            day: 'Dia',
            list: 'Lista'
        },
        events: <?php echo json_encode($calendarEvents ?? []); ?>,
        eventClick: function(info) {
            if (info.event.url) {
                window.location.href = info.event.url;
                info.jsEvent.preventDefault();
            }
        }
    });
    
    calendar.render();

    // Toggle View Logic
    toggleBtn.addEventListener('click', function() {
        if (calendarContainer.classList.contains('hidden')) {
            calendarContainer.classList.remove('hidden');
            listContainer.classList.add('hidden');
            calendar.render(); // Re-render to fix sizing
        } else {
            calendarContainer.classList.add('hidden');
            listContainer.classList.remove('hidden');
        }
    });
});
</script>
