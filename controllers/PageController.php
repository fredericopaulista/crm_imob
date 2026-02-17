<?php
require_once 'models/Page.php';

class PageController {
    private $pageModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->pageModel = new Page();
    }

    public function index() {
        $pages = $this->pageModel->getAll();
        $pageTitle = 'Gerenciar Páginas';
        require_once 'views/layout/header_admin.php';
        require_once 'views/pages/index.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/paginas');
            exit;
        }

        $page = $this->pageModel->getById($id);
        if (!$page) {
            header('Location: ' . APP_URL . '/painel/paginas');
            exit;
        }

        $pageTitle = 'Editar Página - ' . $page['title'];
        require_once 'views/layout/header_admin.php';
        require_once 'views/pages/edit.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'title' => $_POST['title'],
                'content' => $_POST['content']
            ];

            if ($this->pageModel->update($id, $data)) {
                $_SESSION['success'] = 'Página atualizada com sucesso!';
            } else {
                $_SESSION['error'] = 'Erro ao atualizar página.';
            }

            header('Location: ' . APP_URL . '/painel/paginas');
        }
    }
}
