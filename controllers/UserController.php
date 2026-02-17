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
        require_once 'views/layout/header_admin.php';
        require_once 'views/users/index.php';
        require_once 'views/layout/footer_admin.php';
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

    public function update() {
        if (!can('manage_users')) {
            echo "Acesso negado.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            if (!$id) {
                header('Location: ' . APP_URL . '/painel/usuarios');
                exit;
            }

            // Handle Avatar Upload
            $userModel = new User();
            $currentUser = $userModel->getUserById($id);
            $avatar = $currentUser['avatar'] ?? null;

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'assets/uploads/avatars/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                
                $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $filename = 'avatar_' . $id . '_' . time() . '.' . $ext;
                
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $filename)) {
                    $avatar = $filename;
                }
            }

            $data = [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'role_id' => $_POST['role_id'],
                'bio' => $_POST['bio'] ?? null,
                'avatar' => $avatar,
                'social_linkedin' => $_POST['social_linkedin'] ?? null,
                'social_instagram' => $_POST['social_instagram'] ?? null
            ];

            if (!empty($_POST['password'])) {
                $data['password'] = $_POST['password'];
            }

            if ($userModel->update($id, $data)) {
                // Determine the new role name for session update if changed
                // (Optional, but good for consistency)
                
                // Refresh Session if updating self
                if ($id == $_SESSION['user_id']) {
                    $_SESSION['user_name'] = $data['name'];
                    if (!empty($data['avatar'])) {
                        $_SESSION['user_avatar'] = $data['avatar']; // We might need to add this to AuthController/header too
                    }
                    // We don't easily have role_name here without querying, but name is the most visible one.
                }

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
