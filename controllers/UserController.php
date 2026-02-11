<?php

class UserController {

    public function __construct() {
        // Enforce Admin Access
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: ' . APP_URL . '/dashboard');
            exit;
        }
    }

    public function index() {
        $userModel = new User();
        $users = $userModel->getAll();

        $pageTitle = 'Gerenciar Usuários';
        require_once 'views/layout/header.php';
        require_once 'views/users/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Novo Usuário';
        require_once 'views/layout/header.php';
        require_once 'views/users/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role' => $_POST['role']
            ];

            $userModel = new User();
            if ($userModel->create($data)) {
                header('Location: ' . APP_URL . '/user');
            } else {
                echo "Erro ao criar usuário.";
            }
        }
    }

    public function edit($id) {
        $userModel = new User();
        $user = $userModel->getUserById($id);

        if (!$user) {
            header('Location: ' . APP_URL . '/user');
            exit;
        }

        $pageTitle = 'Editar Usuário';
        require_once 'views/layout/header.php';
        require_once 'views/users/edit.php';
        require_once 'views/layout/footer.php';
    }

    public function update($id) {
         if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role' => $_POST['role'],
                'password' => $_POST['password'] // Can be empty
            ];

            $userModel = new User();
            if ($userModel->update($id, $data)) {
                header('Location: ' . APP_URL . '/user');
            } else {
                 echo "Erro ao atualizar usuário.";
            }
        }
    }

    public function delete($id) {
        // Prevent deleting yourself
        if ($id == $_SESSION['user_id']) {
            header('Location: ' . APP_URL . '/user?error=cannot_delete_self');
            exit;
        }

        $userModel = new User();
        $userModel->delete($id);
        header('Location: ' . APP_URL . '/user');
    }
}
