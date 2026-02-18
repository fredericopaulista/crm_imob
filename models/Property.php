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

        // Filter by city
        if (!empty($filters['city'])) {
            $sql .= " AND city = :city";
            $params[':city'] = $filters['city'];
        }

        // Filter by neighborhood
        if (!empty($filters['neighborhood'])) {
            $sql .= " AND neighborhood = :neighborhood";
            $params[':neighborhood'] = $filters['neighborhood'];
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function create($data) {
        // Insert first to get ID, then update slug
        // Or generate temporary slug
        $tempSlug = uniqid('prop_');
        
        $sql = "INSERT INTO properties (title, slug, type, purpose, price, address, neighborhood, city, state, area, bedrooms, bathrooms, garages, description, status, featured, images, owner_id) 
                VALUES (:title, :slug, :type, :purpose, :price, :address, :neighborhood, :city, :state, :area, :bedrooms, :bathrooms, :garages, :description, :status, :featured, :images, :owner_id)";
        
        $stmt = $this->conn->prepare($sql);
        
        $params = [
            ':title' => $data['title'],
            ':slug' => $tempSlug,
            ':type' => $data['type'],
            ':purpose' => $data['purpose'],
            ':price' => $data['price'],
            ':address' => $data['address'],
            ':neighborhood' => $data['neighborhood'],
            ':city' => $data['city'],
            ':state' => $data['state'] ?? 'MG',
            ':area' => $data['area'] ?? null,
            ':bedrooms' => $data['bedrooms'] ?? null,
            ':bathrooms' => $data['bathrooms'] ?? null,
            ':garages' => $data['garages'] ?? null,
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'],
            ':featured' => $data['featured'] ?? 0,
            ':images' => $data['images'] ?? '[]',
            ':owner_id' => $data['owner_id'] ?? null
        ];

        if ($stmt->execute($params)) {
            $id = $this->conn->lastInsertId();
            // Now generate proper slug with ID
            $newSlug = $this->generateAdvancedSlug($data, $id);
            $this->updateSlug($id, $newSlug);
            return true;
        }
        return false;
    }

    public function update($id, $data) {
        // Generate new slug
        $slug = $this->generateAdvancedSlug($data, $id);
        
        $sql = "UPDATE properties SET 
                title = :title,
                slug = :slug,
                type = :type, 
                purpose = :purpose, 
                price = :price, 
                address = :address, 
                neighborhood = :neighborhood, 
                city = :city,
                state = :state,
                area = :area, 
                bedrooms = :bedrooms, 
                bathrooms = :bathrooms, 
                garages = :garages, 
                description = :description, 
                status = :status,
                featured = :featured,
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
            ':state' => $data['state'] ?? 'MG',
            ':area' => $data['area'] ?? null,
            ':bedrooms' => $data['bedrooms'] ?? null,
            ':bathrooms' => $data['bathrooms'] ?? null,
            ':garages' => $data['garages'] ?? null,
            ':description' => $data['description'] ?? null,
            ':status' => $data['status'],
            ':featured' => $data['featured'] ?? 0,
            ':owner_id' => $data['owner_id'] ?? null,
            ':id' => $id
        ]);
    }

    public function getFeatured($limit = 6) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE featured = 1 AND status = 'available' ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByPurpose($purpose, $limit = 12) {
        $stmt = $this->conn->prepare("SELECT * FROM properties WHERE purpose = :purpose AND status = 'available' ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':purpose', $purpose);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
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
         // Fallback to simple slugify for compatibility
         return $this->slugify($title);
    }
    
    public function generateAdvancedSlug($data, $id = null) {
         $purposeSlug = $data['purpose'] === 'sale' ? 'venda' : 'aluguel';
         
         $typeSlug = $this->slugify($data['type']);
         if (substr($typeSlug, -1) !== 's') $typeSlug .= 's';
         
         $state = strtolower($data['state'] ?? 'mg');
         $city = $this->slugify($data['city']);
         $neighborhood = $this->slugify($data['neighborhood']);
         
         $bedrooms = $data['bedrooms'] ?? 0;
         
         $location = "{$state}+{$city}++{$neighborhood}";
         
         $base = "{$purposeSlug}/{$typeSlug}/{$location}/{$bedrooms}-quartos";
         
         if ($id) {
             return "{$base}-{$id}";
         }
         
         return "{$base}-" . time();
    }

    private function slugify($text) {
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);
        $text = strtolower(trim($text));
        $text = preg_replace('/\s+/', '-', $text);
        return $text;
    }    /**
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

    public function getCities() {
        $stmt = $this->conn->query("SELECT DISTINCT city FROM properties WHERE status = 'available' AND city IS NOT NULL AND city != '' ORDER BY city ASC");
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getNeighborhoods($city = null) {
        $sql = "SELECT DISTINCT neighborhood FROM properties WHERE status = 'available' AND neighborhood IS NOT NULL AND neighborhood != ''";
        $params = [];
        
        if ($city) {
            $sql .= " AND city = :city";
            $params[':city'] = $city;
        }
        
        $sql .= " ORDER BY neighborhood ASC";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM properties WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function deleteMany($ids) {
        if (empty($ids)) return false;
        
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->conn->prepare("DELETE FROM properties WHERE id IN ($placeholders)");
        return $stmt->execute($ids);
    }
}

