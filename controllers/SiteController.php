<?php

class SiteController {
    
    public function blog() {
        require_once 'models/Post.php';
        $postModel = new Post();
        $posts = $postModel->getAll(null, 'published');
        
        $pageTitle = 'Blog - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/blog.php';
        require_once 'views/layout/footer_public.php';
    }

    public function post() {
        require_once 'models/Post.php';
        $slug = $_GET['slug'] ?? null;
        
        if (!$slug) {
            header('Location: ' . APP_URL . '/blog');
            exit;
        }
        
        $postModel = new Post();
        $post = $postModel->findBySlug($slug);
        
        if (!$post || $post['status'] !== 'published') {
            header('Location: ' . APP_URL . '/blog');
            exit;
        }
        
        $pageTitle = $post['title'] . ' - ' . company_name();
        
        // SEO meta tags could be injected here if header supports it
        
        require_once 'views/layout/header_public.php';
        require_once 'views/site/post.php';
        require_once 'views/layout/footer_public.php';
    }

    public function author() {
        require_once 'models/Post.php';
        require_once 'models/User.php';
        
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . APP_URL . '/blog');
            exit;
        }
        
        $userModel = new User();
        $author = $userModel->getUserById($id);
        
        if (!$author) {
            header('Location: ' . APP_URL . '/blog');
            exit;
        }

        // Get author's posts
        $postModel = new Post();
        // We need to filter by author. The current getAll doesn't support it directly, 
        // but for now let's use a workaround or update Post.php if needed.
        // Actually best practice is to update Post model, but for speed let's fetch all and filter in PHP arrays 
        // since data set is small, OR add a quick filter.
        // Let's modify getAll logic in memory for now or assume we added the filter.
        // Waiting for tool execution... Actually I will update Post model to support author_id filter in getAll or add getByAuthor
        
        // Let's assume I'll filter in PHP for this demo as database is small (6 posts)
        $allPosts = $postModel->getAll(null, 'published');
        $authorPosts = array_filter($allPosts, function($post) use ($id) {
            return $post['author_id'] == $id;
        });
        
        $pageTitle = 'Posts de ' . $author['name'] . ' - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/author.php';
        require_once 'views/layout/footer_public.php';
    }

    public function index() {
        $propertyModel = new Property();
        
        // Fetch properties for different sections
        $featuredProperties = $propertyModel->getFeatured(12); // Limit 12 for featured
        $saleProperties = $propertyModel->getByPurpose('sale', 12); // Limit 12 for sale
        $rentProperties = $propertyModel->getByPurpose('rent', 12); // Limit 12 for rent
        
        $pageTitle = 'Home - ' . company_name();
        $metaTitle = 'Imóveis em São Paulo - Apartamentos, Casas e Coberturas | ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/home.php';
        require_once 'views/layout/footer_public.php';
    }

    public function catalog() {
        $propertyModel = new Property();
        
        // Get filters from GET request
        $filters = [
            'search' => isset($_GET['search']) ? filter_var($_GET['search'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null,
            'type' => isset($_GET['type']) ? filter_var($_GET['type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null,
            'purpose' => isset($_GET['purpose']) ? filter_var($_GET['purpose'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null,
            'status' => isset($_GET['status']) ? filter_var($_GET['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null,
            'city' => isset($_GET['city']) ? filter_var($_GET['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null,
            'neighborhood' => isset($_GET['neighborhood']) ? filter_var($_GET['neighborhood'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null
        ];
        
        $properties = $propertyModel->getAll($filters);
        
        // Get data for dropdowns
        $cities = $propertyModel->getCities();
        
        // Get neighborhoods for selected city, or all if no city selected
        $neighborhoods = $propertyModel->getNeighborhoods($filters['city'] ?? null);
        
        $titlePrefix = 'Imóveis';
        if ($filters['purpose'] == 'sale') $titlePrefix = 'Imóveis à Venda';
        if ($filters['purpose'] == 'rent') $titlePrefix = 'Imóveis para Alugar';

        $pageTitle = $titlePrefix . ' - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/catalog.php';
        require_once 'views/layout/footer_public.php';
    }

    public function catalogSale() {
        $_GET['purpose'] = 'sale';
        $this->catalog();
    }

    public function catalogRent() {
        $_GET['purpose'] = 'rent';
        $this->catalog();
    }

    public function listing() {
        $propertyModel = new Property();

        // 1. Map Purpose
        // URL: venda / aluguel
        // DB: sale / rent
        $purposeMap = [
            'venda' => 'sale',
            'aluguel' => 'rent'
        ];
        $urlPurpose = $_GET['purpose'] ?? '';
        $dbPurpose = $purposeMap[$urlPurpose] ?? null;

        // 2. Map Type
        // URL: apartamentos, casas, comerciais, terrenos, coberturas
        // DB: Apartamento, Casa, Comercial, Terreno, Cobertura
        $typeMap = [
            'apartamentos' => 'Apartamento',
            'casas' => 'Casa',
            'comerciais' => 'Comercial',
            'terrenos' => 'Terreno',
            'coberturas' => 'Cobertura'
        ];
        $urlType = $_GET['type'] ?? '';
        $dbType = $typeMap[$urlType] ?? null;

        // Validations
        if (!$dbPurpose || !$dbType) {
            // Invalid category or purpose, redirect to catalog or 404
            header('Location: ' . APP_URL . '/imoveis');
            exit;
        }

        // 3. Prepare Filters
        $filters = [
            'purpose' => $dbPurpose,
            'type' => $dbType,
            'status' => 'active' // Only show active properties
        ];

        // 4. Fetch Properties
        $properties = $propertyModel->getAll($filters);

        // 5. Prepare View Data
        // Breadcrumb / Title helper
        $purposeLabel = ($dbPurpose === 'sale') ? 'à Venda' : 'para Alugar';
        $typeLabel = $dbType . 's'; // Pluralize roughly for display, or use mapped label
        if ($dbType === 'Comercial') $typeLabel = 'Imóveis Comerciais';
        
        $pageTitle = "$typeLabel $purposeLabel - " . company_name();
        
        // Pass data to view
        require_once 'views/layout/header_public.php';
        require_once 'views/site/listing.php';
        require_once 'views/layout/footer_public.php';
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
        
        $pageTitle = $property['title'] . ' - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/detail.php';
        require_once 'views/layout/footer_public.php';
    }

    public function contact() {
        $pageTitle = 'Contato - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/contact.php';
        require_once 'views/layout/footer_public.php';
    }

    public function page($slug) {
        require_once 'models/Page.php'; // Assuming Page model exists
        $pageModel = new Page();
        $page = $pageModel->getBySlug($slug);
        
        if (!$page) {
            header("HTTP/1.0 404 Not Found");
            require_once 'views/404.php'; // Ensure you have a 404 view or redirect
            exit;
        }
        
        $pageTitle = $page['title'] . ' - ' . company_name();
        require_once 'views/layout/header_public.php';
        require_once 'views/site/page.php';
        require_once 'views/layout/footer_public.php';
    }

    // Wrapper methods for static routes
    public function terms() {
        $this->page('termos-de-uso');
    }

    public function privacy() {
        $this->page('politica-de-privacidade');
    }

    public function cookies() {
        $this->page('cookies');
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
