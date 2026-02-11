<?php

class ClientController {
    public function index() {
        $clientModel = new Client();
        $clients = $clientModel->getClients(); // Only buyers and tenants
        
        $pageTitle = 'Gestão de Clientes';
        require_once 'views/layout/header.php';
        require_once 'views/clients/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Cadastrar Cliente';
        require_once 'views/layout/header.php';
        require_once 'views/clients/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':type' => $_POST['type'], // buyer or tenant
                ':origin' => $_POST['origin'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => 'contacted'
            ];

            $clientModel = new Client();
            if ($clientModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/clientes');
            } else {
                echo "Error creating client";
            }
        }
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/clientes');
            exit;
        }

        $clientModel = new Client();
        $client = $clientModel->getById($id);

        if (!$client || !in_array($client['type'], ['buyer', 'tenant'])) {
            header('Location: ' . APP_URL . '/painel/clientes');
            exit;
        }

        $pageTitle = 'Editar Cliente';
        require_once 'views/layout/header.php';
        require_once 'views/clients/edit.php';
        require_once 'views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            
            $sql = "UPDATE clients SET name = :name, email = :email, phone = :phone, type = :type, origin = :origin, observations = :observations, status = :status WHERE id = :id AND type IN ('buyer', 'tenant')";
            
            $conn = Database::getInstance()->getConnection();
            $stmt = $conn->prepare($sql);
            
            $success = $stmt->execute([
                ':name' => $_POST['name'],
                ':email' => $_POST['email'] ?? null,
                ':phone' => $_POST['phone'],
                ':type' => $_POST['type'],
                ':origin' => $_POST['origin'] ?? null,
                ':observations' => $_POST['observations'] ?? null,
                ':status' => $_POST['status'],
                ':id' => $id
            ]);

            if ($success) {
                header('Location: ' . APP_URL . '/painel/clientes');
            } else {
                echo "Erro ao atualizar cliente";
            }
        }
    }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/clientes');
            exit;
        }

        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("DELETE FROM clients WHERE id = :id AND type IN ('buyer', 'tenant')");
        
        if ($stmt->execute([':id' => $id])) {
            header('Location: ' . APP_URL . '/painel/clientes');
        } else {
            echo "Erro ao excluir cliente";
        }
    }
}
