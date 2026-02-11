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
}
