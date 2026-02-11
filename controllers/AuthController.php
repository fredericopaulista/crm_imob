<?php

class AuthController {
    public function login() {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/painel');
            exit;
        }
        require_once 'views/auth/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $userModel = new User();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                
                // Load Permissions from DB
                $_SESSION['user_role'] = $user['role_name'] ?? 'Usuario'; 
                $_SESSION['user_permissions'] = $userModel->getPermissions($user['id']);
                
                header('Location: ' . APP_URL . '/painel');
                exit;
            } else {
                $error = "E-mail ou senha inválidos.";
                require_once 'views/auth/login.php';
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . APP_URL . '/acesso/login');
        exit;
    }
}
