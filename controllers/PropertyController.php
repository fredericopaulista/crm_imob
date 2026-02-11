<?php

class PropertyController {
    public function index() {
        $propertyModel = new Property();
        $properties = $propertyModel->getAll();
        
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
}
