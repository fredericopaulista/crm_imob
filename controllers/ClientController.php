<?php

class ClientController {
    public function index() {
        $clientModel = new Client();
        $clients = $clientModel->getAll();
        
        $pageTitle = 'Clientes';
        require_once 'views/layout/header.php';
        require_once 'views/clients/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Novo Cliente';
        require_once 'views/layout/header.php';
        require_once 'views/clients/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'type' => $_POST['type'],
                'origin' => $_POST['origin'],
                'observations' => $_POST['observations'],
                'status' => 'new'
            ];

            $clientModel = new Client();
            if ($clientModel->create($data)) {
                header('Location: ' . APP_URL . '/client');
            } else {
                echo "Error creating client";
            }
        }
    }
}
