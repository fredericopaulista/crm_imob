<?php

class LeadController {
    public function index() {
        $view = $_GET['view'] ?? 'kanban'; // Default to kanban

        if ($view === 'settings') {
            // Redirect to stage controller logic or handle here
             header('Location: ' . APP_URL . '/painel/leads/etapas');
             exit;
        }

        $clientModel = new Client();
        $leads = $clientModel->getLeads();
        
        if ($view === 'kanban') {
            require_once 'models/LeadStage.php';
            $stageModel = new LeadStage();
            $stages = $stageModel->getAll();
            
            // Group leads by stage
            $leadsByStage = [];
            foreach ($stages as $stage) {
                $leadsByStage[$stage['id']] = [];
            }
            foreach ($leads as $lead) {
                if (isset($leadsByStage[$lead['stage_id']])) {
                    $leadsByStage[$lead['stage_id']][] = $lead;
                } elseif (!empty($leadsByStage)) {
                     // Fallback for leads with deleted stages or null
                     // Put in first stage? Or a "Uncategorized" bucket?
                     // For now, put in first stage if exists
                     $firstStageId = array_key_first($leadsByStage);
                     $leadsByStage[$firstStageId][] = $lead;
                }
            }
            
            $pageTitle = 'Funil de Vendas (Kanban)';
            require_once 'views/layout/header_admin.php';
            require_once 'views/leads/kanban.php';
            require_once 'views/layout/footer_admin.php';
        } else {
            $pageTitle = 'Lista de Leads';
            require_once 'views/layout/header_admin.php';
            require_once 'views/leads/index.php';
            require_once 'views/layout/footer_admin.php';
        }
    }

    public function updateStage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $leadId = $input['lead_id'] ?? null;
            $stageId = $input['stage_id'] ?? null;

            if ($leadId && $stageId) {
                $clientModel = new Client();
                if ($clientModel->updateStage($leadId, $stageId)) {
                    echo json_encode(['success' => true]);
                } else {
                    echo json_encode(['success' => false]);
                }
                exit;
            }
        }
    }
    
    // ... existing create, store, edit, update, delete, convert methods ...
    public function create() {
        require_once 'models/LeadStage.php';
        $stageModel = new LeadStage();
        $stages = $stageModel->getAll();

        require_once 'models/LeadOrigin.php';
        $originModel = new LeadOrigin();
        $origins = $originModel->getAll();

        $pageTitle = 'Novo Lead';
        require_once 'views/layout/header_admin.php'; // Updated to admin header
        require_once 'views/leads/create.php';
        require_once 'views/layout/footer_admin.php'; // Updated to admin footer
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':type' => 'lead',
                ':origin_id' => $_POST['origin_id'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => 'new', // Legacy compatibility
                ':stage_id' => $_POST['stage_id'] ?? null
            ];

            $clientModel = new Client();
            if ($clientModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/leads');
            } else {
                echo "Erro ao criar lead";
            }
        }
    }
    
    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/leads');
            exit;
        }

        $clientModel = new Client();
        $lead = $clientModel->getById($id);

        if (!$lead || $lead['type'] !== 'lead') {
            header('Location: ' . APP_URL . '/painel/leads');
            exit;
        }

        require_once 'models/LeadStage.php';
        $stageModel = new LeadStage();
        $stages = $stageModel->getAll();

        require_once 'models/LeadOrigin.php';
        $originModel = new LeadOrigin();
        $origins = $originModel->getAll();

        $pageTitle = 'Editar Lead';
        require_once 'views/layout/header_admin.php';
        require_once 'views/leads/edit.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $stageId = filter_input(INPUT_POST, 'stage_id', FILTER_VALIDATE_INT);
            $originId = filter_input(INPUT_POST, 'origin_id', FILTER_VALIDATE_INT);
            
            // Fix: include stage_id and origin_id in update
            $sql = "UPDATE clients SET name = :name, email = :email, phone = :phone, origin_id = :origin_id, observations = :observations, stage_id = :stage_id WHERE id = :id AND type = 'lead'";
            
            $conn = Database::getInstance()->getConnection();
            $stmt = $conn->prepare($sql);
            
            $success = $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':origin_id' => $originId,
                ':observations' => $_POST['observations'] ?? null,
                ':stage_id' => $stageId,
                ':id' => $id
            ]);

            if ($success) {
                header('Location: ' . APP_URL . '/painel/leads');
            } else {
                echo "Erro ao atualizar lead";
            }
        }
    }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/leads');
            exit;
        }

        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id AND type = 'lead'");
        
        if ($stmt->execute([':id' => $id])) {
            header('Location: ' . APP_URL . '/painel/leads');
        } else {
            echo "Erro ao excluir lead";
        }
    }

    public function convert() {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $newType = filter_input(INPUT_POST, 'new_type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$id || !in_array($newType, ['buyer', 'tenant'])) {
            header('Location: ' . APP_URL . '/painel/leads');
            exit;
        }

        $clientModel = new Client();
        if ($clientModel->convertLeadToClient($id, $newType)) {
            header('Location: ' . APP_URL . '/painel/clientes');
        } else {
            echo "Erro ao converter lead";
        }
    }
}
