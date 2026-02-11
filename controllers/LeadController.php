<?php

class LeadController {
    public function index() {
        $clientModel = new Client();
        $leads = $clientModel->getLeads();
        
        $pageTitle = 'Gestão de Leads';
        require_once 'views/layout/header.php';
        require_once 'views/leads/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Novo Lead';
        require_once 'views/layout/header.php';
        require_once 'views/leads/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':type' => 'lead',
                ':origin' => $_POST['origin'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => $_POST['status'] ?? 'new'
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

        $pageTitle = 'Editar Lead';
        require_once 'views/layout/header.php';
        require_once 'views/leads/edit.php';
        require_once 'views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            
            $sql = "UPDATE clients SET name = :name, email = :email, phone = :phone, origin = :origin, observations = :observations, status = :status WHERE id = :id AND type = 'lead'";
            
            $conn = Database::getInstance()->getConnection();
            $stmt = $conn->prepare($sql);
            
            $success = $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':origin' => $_POST['origin'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => $_POST['status'],
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
