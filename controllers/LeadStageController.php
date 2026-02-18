<?php
require_once 'models/LeadStage.php';

class LeadStageController {
    private $stageModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->stageModel = new LeadStage();
    }

    public function index() {
        // Build settings view for stages
        $stages = $this->stageModel->getAll();
        // Since this is likely loaded via AJAX or included in a simplified view for now
        // Or we can create a dedicated settings page. 
        // For the user request "possibilidade de editar o nome de cada etapa e criar novas etapas", 
        // we'll make a dedicated setting page or modal.
        // Let's assume a dedicated view for now to keep it clean.
        
        $pageTitle = 'Configurar Etapas do Funil';
        require_once 'views/layout/header_admin.php';
        require_once 'views/leads/stages.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'color' => $_POST['color'] ?? '#3B82F6'
            ];
            $this->stageModel->create($data);
            header('Location: ' . APP_URL . '/painel/leads?view=settings');
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'name' => $_POST['name'],
                'color' => $_POST['color']
            ];
            $this->stageModel->update($id, $data);
            header('Location: ' . APP_URL . '/painel/leads?view=settings');
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->stageModel->delete($id);
        }
        header('Location: ' . APP_URL . '/painel/leads?view=settings');
    }
    
    public function reorder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            if (isset($input['stages'])) {
                $this->stageModel->updateOrder($input['stages']);
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }
}
