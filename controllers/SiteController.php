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
        
        // Get filters from GET request
        $filters = [
            'search' => filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'type' => filter_input(INPUT_GET, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'status' => filter_input(INPUT_GET, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'city' => filter_input(INPUT_GET, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'neighborhood' => filter_input(INPUT_GET, 'neighborhood', FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        ];
        
        $properties = $propertyModel->getAll($filters);
        
        // Get data for dropdowns
        $cities = $propertyModel->getCities();
        
        // Get neighborhoods for selected city, or all if no city selected
        $neighborhoods = $propertyModel->getNeighborhoods($filters['city'] ?? null);
        
        $pageTitle = 'Imóveis - Correta Pro';
        require_once 'views/site/layout/header.php';
        require_once 'views/site/catalog.php';
        require_once 'views/site/layout/footer.php';
    }

    public function detail() {
        // Use $_GET directly because filter_input doesn't see values set in index.php
        $slug = isset($_GET['slug']) ? filter_var($_GET['slug'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
        $id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : null;
        
        $propertyModel = new Property();
        
        if ($slug) {
            $property = $propertyModel->findBySlug($slug);
        } elseif ($id) {
            $property = $propertyModel->find($id);
        } else {
             header('Location: ' . APP_URL . '/imoveis');
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
