<?php

class RoleController {
    
    public function __construct() {
        // Enforce Admin Access
        // We'll use the new permission system here later, but for now hardcode 'admin' role check via session
        // However, since we authorized new roles, we should check permissions. 
        // But since we are mid-migration, let's stick to session role check if possible, OR implement checkPermission helper now.
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
    }

    public function index() {
        if (!can('manage_roles')) {
            echo "Acesso negado.";
            exit;
        }

        $roleModel = new Role();
        $roles = $roleModel->getAll();

        $pageTitle = 'Controle de Perfis';
        require_once 'views/layout/header.php';
        require_once 'views/roles/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        if (!can('manage_roles')) {
            echo "Acesso negado.";
            exit;
        }

        $permissionModel = new Permission();
        $permissions = $permissionModel->getAll();

        $pageTitle = 'Cadastrar Perfil';
        require_once 'views/layout/header.php';
        require_once 'views/roles/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if (!can('manage_roles')) {
            echo "Acesso negado.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

            $roleModel = new Role();
            if ($roleModel->create($name, $description, $permissions)) {
                header('Location: ' . APP_URL . '/painel/perfis');
            } else {
                echo "Erro ao criar perfil.";
            }
        }
    }

    public function edit($id) {
        if (!can('manage_roles')) {
            echo "Acesso negado.";
            exit;
        }

        $roleModel = new Role();
        $role = $roleModel->getById($id);

        if (!$role) {
            header('Location: ' . APP_URL . '/painel/perfis');
            exit;
        }

        $permissionModel = new Permission();
        $allPermissions = $permissionModel->getAll();
        $rolePermissions = $roleModel->getPermissions($id);

        $pageTitle = 'Editar Perfil';
        require_once 'views/layout/header.php';
        require_once 'views/roles/edit.php';
        require_once 'views/layout/footer.php';
    }

    public function update($id) {
        if (!can('manage_roles')) {
            echo "Acesso negado.";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $permissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];

            $roleModel = new Role();
            if ($roleModel->update($id, $name, $description, $permissions)) {
                 header('Location: ' . APP_URL . '/painel/perfis');
            } else {
                 echo "Erro ao atualizar perfil.";
            }
        }
    }

    // Helper function to check permissions -> Moved to helpers.php
}
