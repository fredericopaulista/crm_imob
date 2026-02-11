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
        $sql = "UPDATE properties SET 
                title = :title, 
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

