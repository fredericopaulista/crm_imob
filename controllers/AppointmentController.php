<?php

class AppointmentController {
    private $appointmentModel;
    private $clientModel;
    private $propertyModel;
    private $userModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->appointmentModel = new Appointment();
        $this->clientModel = new Client();
        $this->propertyModel = new Property();
        $this->userModel = new User();
    }

    public function index() {
        $filters = [];
        if (isset($_GET['status'])) $filters['status'] = $_GET['status'];
        if (isset($_GET['date_start'])) $filters['date_start'] = $_GET['date_start'];
        if (isset($_GET['date_end'])) $filters['date_end'] = $_GET['date_end'];
        
        // Admin sees all, agent sees own? For now, everyone sees all or filter by user
        if (isset($_GET['user_id'])) $filters['user_id'] = $_GET['user_id'];

        $appointments = $this->appointmentModel->getAll($filters);
        $appointments = $this->appointmentModel->getAll($filters);
        
        // Prepare events for FullCalendar
        $calendarEvents = [];
        foreach ($appointments as $appt) {
            $color = '#3b82f6'; // Scheduled (Blue)
            if ($appt['status'] == 'completed') $color = '#10b981'; // Green
            if ($appt['status'] == 'cancelled') $color = '#ef4444'; // Red

            $calendarEvents[] = [
                'title' => $appt['lead_name'] . ' - ' . $appt['property_title'],
                'start' => $appt['visit_date'],
                'url' => APP_URL . '/painel/agenda/editar?id=' . $appt['id'],
                'color' => $color,
                'extendedProps' => [
                    'status' => $appt['status'],
                    'user' => $appt['user_name']
                ]
            ];
        }

        $users = $this->userModel->getAll();

        $pageTitle = 'Agenda de Visitas';
        include 'views/layout/header_admin.php';
        include 'views/appointments/index.php';
        include 'views/layout/footer_admin.php';
    }

    public function create() {
        $pageTitle = 'Novo Agendamento';
        $leads = $this->clientModel->getLeads(); // Or all clients? "visit with lead" implies leads
        $properties = $this->propertyModel->getAll(['status' => 'available']);
        $users = $this->userModel->getAll();

        include 'views/layout/header_admin.php';
        include 'views/appointments/create.php';
        include 'views/layout/footer_admin.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'lead_id' => $_POST['lead_id'],
                'property_id' => $_POST['property_id'],
                'user_id' => $_POST['user_id'],
                'visit_date' => $_POST['visit_date'],
                'notes' => $_POST['notes'] ?? '',
                'status' => 'scheduled'
            ];

            if ($this->appointmentModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/agenda?success=Agendamento criado com sucesso');
            } else {
                header('Location: ' . APP_URL . '/painel/agenda/novo?error=Erro ao criar agendamento');
            }
        }
    }

    public function edit() {
        if (!isset($_GET['id'])) {
            header('Location: ' . APP_URL . '/painel/agenda');
            exit;
        }

        $appointment = $this->appointmentModel->getById($_GET['id']);
        if (!$appointment) {
            header('Location: ' . APP_URL . '/painel/agenda?error=Agendamento não encontrado');
            exit;
        }

        $pageTitle = 'Editar Agendamento';
        $leads = $this->clientModel->getLeads();
        $properties = $this->propertyModel->getAll(['status' => 'available']);
        $users = $this->userModel->getAll();

        include 'views/layout/header_admin.php';
        include 'views/appointments/edit.php';
        include 'views/layout/footer_admin.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'lead_id' => $_POST['lead_id'],
                'property_id' => $_POST['property_id'],
                'user_id' => $_POST['user_id'],
                'visit_date' => $_POST['visit_date'],
                'status' => $_POST['status'],
                'notes' => $_POST['notes'] ?? ''
            ];

            if ($this->appointmentModel->update($id, $data)) {
                header('Location: ' . APP_URL . '/painel/agenda?success=Agendamento atualizado com sucesso');
            } else {
                header('Location: ' . APP_URL . '/painel/agenda/editar?id=' . $id . '&error=Erro ao atualizar agendamento');
            }
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            if ($this->appointmentModel->delete($_GET['id'])) {
                header('Location: ' . APP_URL . '/painel/agenda?success=Agendamento excluído');
            } else {
                header('Location: ' . APP_URL . '/painel/agenda?error=Erro ao excluir');
            }
        }
    }
}
