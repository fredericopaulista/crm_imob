<?php

class Property {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll($filters = []) {
        $sql = "SELECT * FROM properties WHERE 1=1";
        $params = [];
        
        // Filter by search term (title)
        if (!empty($filters['search'])) {
            $sql .= " AND title LIKE :search";
            $params[':search'] = '%' . $filters['search'] . '%';
        }
        
        // Filter by type
        if (!empty($filters['type'])) {
            $sql .= " AND type = :type";
            $params[':type'] = $filters['type'];
        }
        
        // Filter by status
        if (!empty($filters['status'])) {
            $sql .= " AND status = :status";
            $params[':status'] = $filters['status'];
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
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

    public function update($id, $data) {
        // Generate slug from title if title is being updated
        $slug = $this->generateSlug($data['title'], $id);
        
        $sql = "UPDATE properties SET 
                title = :title,
                slug = :slug,
                type = :type, 
                purpose = :purpose, 
                price = :price, 
                address = :address, 
                neighborhood = :neighborhood, 
                city = :city, 
                area = :area, 
                bedrooms = :bedrooms, 
                bathrooms = :bathrooms, 
                garages = :garages, 
                description = :description, 
                status = :status,
                owner_id = :owner_id
                WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':title' => $data['title'],
            ':slug' => $slug,
            ':type' => $data['type'],
            ':purpose' => $data['purpose'],
            ':price' => $data['price'],
            ':address' => $data['address'],
            ':neighborhood' => $data['neighborhood'],
            ':city' => $data['city'],
            ':area' => $data['area'] ?? null,
            ':bedrooms' => $data['bedrooms'] ?? null,
            ':bathrooms' => $data['bathrooms'] ?? null,
            ':garages' => $data['garages'] ?? null,
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'],
            ':owner_id' => $data['owner_id'] ?? null,
            ':id' => $id
        ]);
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
        // Convert to lowercase
        $slug = mb_strtolower($title, 'UTF-8');
        
        // Remove accents and special characters manually for better compatibility
        $replacements = [
            '/[áàâãä]/u' => 'a',
            '/[éèêë]/u' => 'e',
            '/[íìîï]/u' => 'i',
            '/[óòôõö]/u' => 'o',
            '/[úùûü]/u' => 'u',
            '/[ç]/u' => 'c',
            '/[ñ]/u' => 'n',
            '/[^a-z0-9\s-]/' => '', // Remove unwanted chars
            '/[\s-]+/' => '-'       // Convert spaces and repeated hyphens to single hyphen
        ];
        
        $slug = preg_replace(array_keys($replacements), array_values($replacements), $slug);
        
        // Remove leading/trailing hyphens
        $slug = trim($slug, '-');
        
        if (empty($slug)) {
            $slug = 'imovel-' . time();
        }
        
        // Check if slug exists
        $counter = 1;
        $originalSlug = $slug;
        
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

