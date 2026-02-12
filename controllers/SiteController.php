<?php

class SiteController {
    
    public function index() {
        $propertyModel = new Property();
        // Get recent properties for homepage
        // Ideally add limit to getAll, but for now fetch all and slice
        $allProperties = $propertyModel->getAll();
        $recentProperties = array_slice($allProperties, 0, 6);
        
        $pageTitle = 'Home - Correta Pro';
        require_once 'views/site/layout/header.php';
        require_once 'views/site/home.php';
        require_once 'views/site/layout/footer.php';
    }

    public function catalog() {
        $propertyModel = new Property();
        $properties = $propertyModel->getAll();
        
        $pageTitle = 'Imóveis - Correta Pro';
        require_once 'views/site/layout/header.php';
        require_once 'views/site/catalog.php';
        require_once 'views/site/layout/footer.php';
    }

    public function detail() {
        // Try slug first, fallback to ID for backwards compatibility
        $slug = filter_input(INPUT_GET, 'slug', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        $propertyModel = new Property();
        
        if ($slug) {
            // DEBUG
            echo "Searching for slug: " . htmlspecialchars($slug) . "<br>";
            $property = $propertyModel->findBySlug($slug);
            var_dump($property);
        } elseif ($id) {
            $property = $propertyModel->find($id);
        } else {
            // DEBUG
            echo "No slug or ID provided<br>";
             // header('Location: ' . APP_URL . '/imoveis');
            exit;
        }

        if (!$property) {
            header('Location: ' . APP_URL . '/imoveis');
            exit;
        }
        
        $pageTitle = $property['title'] . ' - Correta Pro';
        require_once 'views/site/layout/header.php';
        require_once 'views/site/detail.php';
        require_once 'views/site/layout/footer.php';
    }

    public function contact() {
        $pageTitle = 'Contato - Correta Pro';
        require_once 'views/site/layout/header.php';
        require_once 'views/site/contact.php';
        require_once 'views/site/layout/footer.php';
    }
    
    public function sendContact() {
        // Handle contact form submission
        // In a real app, send email or save to leads
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             // For now just redirect back with success
             header('Location: ' . APP_URL . '/contato?success=1');
        }
    }
}
