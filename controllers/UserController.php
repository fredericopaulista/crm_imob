<?php

class UserController {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
    }

    public function index() {
        $userModel = new User();
        $users = $userModel->getAll();

        $pageTitle = 'Controle de Usuários';
        require_once 'views/layout/header.php';
        require_once 'views/users/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        if (!can('manage_users')) {
            echo "Acesso negado.";
            exit;
        }

        $roleModel = new Role();
        $roles = $roleModel->getAll();

        $pageTitle = 'Cadastrar Usuário';
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
                'role_id' => $_POST['role_id']
            ];

            $userModel = new User();
            if ($userModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/usuarios');
            } else {
                echo "Erro ao criar usuário.";
            }
        }
    }

    public function edit() {
        if (!can('manage_users')) {
            echo "Acesso negado.";
            exit;
        }

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/usuarios');
            exit;
        }

        $userModel = new User();
        $user = $userModel->getUserById($id);

        if (!$user) {
            header('Location: ' . APP_URL . '/painel/usuarios');
            exit;
        }

        $roleModel = new Role();
        $roles = $roleModel->getAll();

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
                'role_id' => $_POST['role_id'],
                'password' => $_POST['password'] // Can be empty
            ];

            $userModel = new User();
            if ($userModel->update($id, $data)) {
                header('Location: ' . APP_URL . '/painel/usuarios');
            } else {
                 echo "Erro ao atualizar usuário.";
            }
        }
    }

    public function delete($id) {
        if (!can('manage_users')) {
            echo "Acesso negado.";
            exit;
        }

        // Prevent deleting yourself
        if ($id == $_SESSION['user_id']) {
            header('Location: ' . APP_URL . '/painel/usuarios?error=cannot_delete_self');
            exit;
        }

        $userModel = new User();
        $userModel->delete($id);
        header('Location: ' . APP_URL . '/painel/usuarios');
    }

    // Helper removed, using global can()
}
