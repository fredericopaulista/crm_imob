<?php
require_once 'models/Setting.php';
require_once 'models/Property.php';

class SettingsController {
    private $db;
    private $setting;
    private $property;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->setting = new Setting($this->db);
        $this->property = new Property();
    }
    
    /**
     * Display settings page
     */
    public function index() {
        $settings = $this->setting->getAll();
        require_once 'views/settings/index.php';
    }
    
    /**
     * Update settings
     */
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . APP_URL . '/painel/configuracoes');
            exit;
        }
        
        $settingsToUpdate = [
            'google_search_console' => $_POST['google_search_console'] ?? '',
            'google_analytics' => $_POST['google_analytics'] ?? ''
        ];
        
        if ($this->setting->updateMultiple($settingsToUpdate)) {
            $_SESSION['success'] = 'Configurações atualizadas com sucesso!';
        } else {
            $_SESSION['error'] = 'Erro ao atualizar configurações.';
        }
        
        header('Location: ' . APP_URL . '/painel/configuracoes');
        exit;
    }
    
    /**
     * Generate sitemap.xml
     */
    public function generateSitemap() {
        $properties = $this->property->getAll();
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Homepage
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . APP_URL . "/</loc>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>1.0</priority>\n";
        $xml .= "  </url>\n";
        
        // Catalog page
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . APP_URL . "/imoveis</loc>\n";
        $xml .= "    <changefreq>daily</changefreq>\n";
        $xml .= "    <priority>0.9</priority>\n";
        $xml .= "  </url>\n";
        
        // Contact page
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . APP_URL . "/contato</loc>\n";
        $xml .= "    <changefreq>monthly</changefreq>\n";
        $xml .= "    <priority>0.7</priority>\n";
        $xml .= "  </url>\n";
        
        // Property pages
        foreach ($properties as $property) {
            $slug = $property['slug'] ?? $property['id'];
            $lastmod = date('Y-m-d', strtotime($property['updated_at']));
            
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . APP_URL . "/imovel/{$slug}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.8</priority>\n";
            $xml .= "  </url>\n";
        }
        
        $xml .= '</urlset>';
        
        // Save to file
        file_put_contents('sitemap.xml', $xml);
        
        // Update setting
        $this->setting->set('sitemap_generated_at', date('Y-m-d H:i:s'));
        
        $_SESSION['success'] = 'Sitemap gerado com sucesso! Arquivo: sitemap.xml';
        header('Location: ' . APP_URL . '/painel/configuracoes');
        exit;
    }
    
    /**
     * Generate robots.txt
     */
    public function generateRobots() {
        $content = "User-agent: *\n";
        $content .= "Allow: /\n";
        $content .= "Disallow: /painel/\n";
        $content .= "Disallow: /assets/uploads/\n\n";
        $content .= "Sitemap: " . APP_URL . "/sitemap.xml\n";
        
        // Save to file
        file_put_contents('robots.txt', $content);
        
        // Update setting
        $this->setting->set('robots_generated_at', date('Y-m-d H:i:s'));
        
        $_SESSION['success'] = 'Robots.txt gerado com sucesso! Arquivo: robots.txt';
        header('Location: ' . APP_URL . '/painel/configuracoes');
        exit;
    }
    
    /**
     * Download sitemap
     */
    public function downloadSitemap() {
        if (file_exists('sitemap.xml')) {
            header('Content-Type: application/xml');
            header('Content-Disposition: attachment; filename="sitemap.xml"');
            readfile('sitemap.xml');
            exit;
        } else {
            $_SESSION['error'] = 'Sitemap não encontrado. Gere o sitemap primeiro.';
            header('Location: ' . APP_URL . '/painel/configuracoes');
            exit;
        }
    }
    
    /**
     * Download robots.txt
     */
    public function downloadRobots() {
        if (file_exists('robots.txt')) {
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="robots.txt"');
            readfile('robots.txt');
            exit;
        } else {
            $_SESSION['error'] = 'Robots.txt não encontrado. Gere o arquivo primeiro.';
            header('Location: ' . APP_URL . '/painel/configuracoes');
            exit;
        }
    }
}
