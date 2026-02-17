<?php
require_once 'models/Post.php';

class BlogController {
    private $postModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/acesso/login');
            exit;
        }
        $this->postModel = new Post();
    }

    public function index() {
        $posts = $this->postModel->getAll();
        $pageTitle = 'Blog - Gerenciar Posts';
        require_once 'views/layout/header_admin.php';
        require_once 'views/blog/index.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function create() {
        $pageTitle = 'Novo Post';
        require_once 'views/layout/header_admin.php';
        require_once 'views/blog/create.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/painel/blog');
            exit;
        }

        $title = $_POST['title'] ?? '';
        // Generate slug from title if empty
        $slug = $_POST['slug'] ?? '';
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        }

        $image = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('post_') . '.' . $ext;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                $image = $filename;
            }
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $_POST['content'] ?? '',
            'excerpt' => $_POST['excerpt'] ?? '',
            'image' => $image,
            'status' => $_POST['status'] ?? 'draft',
            'author_id' => $_SESSION['user_id']
        ];

        if ($this->postModel->create($data)) {
            $_SESSION['success'] = 'Post criado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao criar post.';
        }

        header('Location: ' . APP_URL . '/painel/blog');
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/blog');
            exit;
        }
        
        $post = $this->postModel->find($id);
        if (!$post) {
            header('Location: ' . APP_URL . '/painel/blog');
            exit;
        }

        $pageTitle = 'Editar Post';
        require_once 'views/layout/header_admin.php';
        require_once 'views/blog/edit.php';
        require_once 'views/layout/footer_admin.php';
    }

    public function update() {
        // Handle update logic similar to store but with ID
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/painel/blog');
            exit;
        }
        
        $id = $_POST['id'];
        $existingPost = $this->postModel->find($id);
        
        $slug = $_POST['slug'] ?? '';
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['title'])));
        }
        
        $image = $existingPost['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'assets/uploads/';
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('post_') . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                $image = $filename;
            }
        }
        
        $data = [
            'title' => $_POST['title'],
            'slug' => $slug,
            'content' => $_POST['content'],
            'excerpt' => $_POST['excerpt'],
            'image' => $image,
            'status' => $_POST['status']
        ];
        
        if ($this->postModel->update($id, $data)) {
            $_SESSION['success'] = 'Post atualizado com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar post.';
        }
        
         header('Location: ' . APP_URL . '/painel/blog');
         exit;
    }

    public function delete() {
         $id = $_POST['id'] ?? null;
         if ($id && $this->postModel->delete($id)) {
             $_SESSION['success'] = 'Post excluído com sucesso.';
         } else {
             $_SESSION['error'] = 'Erro ao excluir post.';
         }
         header('Location: ' . APP_URL . '/painel/blog');
         exit;
    }
}
