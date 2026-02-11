<?php

class Property {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM properties ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        // Generate slug from title
        $slug = $this->generateSlug($data[':title'] ?? $data['title']);
        $data[':slug'] = $slug;
        
        $sql = "INSERT INTO properties (title, slug, type, purpose, price, address, neighborhood, city, area, bedrooms, bathrooms, garages, description, status, images) VALUES (:title, :slug, :type, :purpose, :price, :address, :neighborhood, :city, :area, :bedrooms, :bathrooms, :garages, :description, :status, :images)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM properties");
        return $stmt->fetchColumn();
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    
    /**
     * Find property by slug
     */
    public function findBySlug($slug) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE slug = :slug");
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch();
    }
    
    /**
     * Generate SEO-friendly slug from title
     */
    public function generateSlug($title, $id = null) {
        // Convert to lowercase and remove accents
        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $title);
        $slug = strtolower($slug);
        
        // Replace spaces and special characters with hyphens
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        
        // Remove leading/trailing hyphens
        $slug = trim($slug, '-');
        
        // Check if slug exists
        $originalSlug = $slug;
        $counter = 1;
        
        while ($this->slugExists($slug, $id)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }
    
    /**
     * Check if slug already exists (excluding current property)
     */
    private function slugExists($slug, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM properties WHERE slug = :slug AND id != :id");
            $stmt->execute([':slug' => $slug, ':id' => $excludeId]);
        } else {
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM properties WHERE slug = :slug");
            $stmt->execute([':slug' => $slug]);
        }
        return $stmt->fetchColumn() > 0;
    }
    
    /**
     * Update property slug
     */
    public function updateSlug($id, $slug) {
        $stmt = $this->conn->prepare("UPDATE properties SET slug = :slug WHERE id = :id");
        return $stmt->execute([':slug' => $slug, ':id' => $id]);
    }
}

