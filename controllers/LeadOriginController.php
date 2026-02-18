<?php
require_once 'models/LeadOrigin.php';

class LeadOriginController {
    private $originModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->originModel = new LeadOrigin();
    }

    public function index() {
        $origins = $this->originModel->getAll();
        
        $pageTitle = 'Origens de Leads';
        $activeModule = 'configuracoes';
        
        require_once 'views/layout/header_admin.php';
        require_once 'views/settings/origins/index.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name']
            ];
            $this->originModel->create($data);
            header('Location: ' . APP_URL . '/painel/configuracoes/origens');
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'name' => $_POST['name']
            ];
            $this->originModel->update($id, $data);
            header('Location: ' . APP_URL . '/painel/configuracoes/origens');
        }
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->originModel->delete($id);
        }
        header('Location: ' . APP_URL . '/painel/configuracoes/origens');
    }
}
