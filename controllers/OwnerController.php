<?php

class OwnerController {
    public function index() {
        $clientModel = new Client();
        $owners = $clientModel->getOwners();
        
        $pageTitle = 'Gestão de Proprietários';
        require_once 'views/layout/header.php';
        require_once 'views/owners/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Novo Proprietário';
        require_once 'views/layout/header.php';
        require_once 'views/owners/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':type' => 'owner',
                ':origin' => $_POST['origin'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => 'contacted'
            ];

            $clientModel = new Client();
            if ($clientModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/proprietarios');
            } else {
                echo "Erro ao criar proprietário";
            }
        }
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/proprietarios');
            exit;
        }

        $clientModel = new Client();
        $owner = $clientModel->getById($id);

        if (!$owner || $owner['type'] !== 'owner') {
            header('Location: ' . APP_URL . '/painel/proprietarios');
            exit;
        }

        $pageTitle = 'Editar Proprietário';
        require_once 'views/layout/header.php';
        require_once 'views/owners/edit.php';
        require_once 'views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            
            $sql = "UPDATE clients SET name = :name, email = :email, phone = :phone, origin = :origin, observations = :observations, status = :status WHERE id = :id AND type = 'owner'";
            
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
                header('Location: ' . APP_URL . '/painel/proprietarios');
            } else {
                echo "Erro ao atualizar proprietário";
            }
        }
    }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/proprietarios');
            exit;
        }

        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id AND type = 'owner'");
        
        if ($stmt->execute([':id' => $id])) {
            header('Location: ' . APP_URL . '/painel/proprietarios');
        } else {
            echo "Erro ao excluir proprietário";
        }
    }
}
