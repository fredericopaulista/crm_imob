<?php

class PropertyController {
    public function index() {
        $propertyModel = new Property();
        
        // Collect filter parameters
        $filters = [
            'search' => filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'type' => filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ];
        
        $properties = $propertyModel->getAll($filters);
        
        $pageTitle = 'Gestão de Imóveis';
        require_once 'views/layout/header.php';
        require_once 'views/properties/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $pageTitle = 'Cadastrar Imóvel';
        require_once 'views/layout/header.php';
        require_once 'views/properties/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // Handle Image Upload
             $images = [];
             if (!empty($_FILES['images']['name'][0])) {
                 foreach ($_FILES['images']['tmp_name'] as $key => $tmpIcon) {
                     $fileName = time() . '_' . $_FILES['images']['name'][$key];
                     $targetPath = 'assets/uploads/' . $fileName;
                     if (move_uploaded_file($tmpIcon, $targetPath)) {
                         $images[] = $fileName;
                     }
                 }
             }

            $data = [
                'title' => $_POST['title'],
                'type' => $_POST['title'],
                'purpose' => $_POST['purpose'],
                'price' => $_POST['price'],
                'address' => $_POST['address'],
                'neighborhood' => $_POST['neighborhood'],
                'city' => $_POST['city'],
                'area' => $_POST['area'],
                'bedrooms' => $_POST['bedrooms'],
                'bathrooms' => $_POST['bathrooms'],
                'garages' => $_POST['garages'],
                'description' => $_POST['description'],
                'status' => $_POST['status'],
                'images' => json_encode($images)
            ];

            $propertyModel = new Property();
            if ($propertyModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/imoveis');
            } else {
                echo "Error creating property";
            }
        }
    }

    public function edit() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/imoveis');
            exit;
        }

        $propertyModel = new Property();
        $property = $propertyModel->find($id);

        if (!$property) {
            header('Location: ' . APP_URL . '/painel/imoveis');
            exit;
        }

        $pageTitle = 'Editar Imóvel';
        require_once 'views/layout/header.php';
        require_once 'views/properties/create.php'; // Reuse create form
        require_once 'views/layout/footer.php';
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            
            $data = [
                'title' => $_POST['title'],
                'type' => $_POST['type'],
                'purpose' => $_POST['purpose'],
                'price' => $_POST['price'],
                'address' => $_POST['address'],
                'neighborhood' => $_POST['neighborhood'],
                'city' => $_POST['city'],
                'area' => $_POST['area'],
                'bedrooms' => $_POST['bedrooms'],
                'bathrooms' => $_POST['bathrooms'],
                'garages' => $_POST['garages'],
                'description' => $_POST['description'],
                'status' => $_POST['status']
            ];

            $propertyModel = new Property();
            if ($propertyModel->update($id, $data)) {
                header('Location: ' . APP_URL . '/painel/imoveis');
            } else {
                echo "Error updating property";
            }
        }
    }

    public function delete() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . APP_URL . '/painel/imoveis');
            exit;
        }

        $propertyModel = new Property();
        if ($propertyModel->delete($id)) {
            header('Location: ' . APP_URL . '/painel/imoveis');
        } else {
            echo "Error deleting property";
        }
    }
}
