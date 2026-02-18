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
        // Parse type for URL (pluralize)
        $typeSlug = $this->slugify($data['type']);
        if (substr($typeSlug, -1) !== 's') {
            $typeSlug .= 's';
        }
        
        // Parse location
        $citySlug = $this->slugify($data['city']);
        $neighborhoodSlug = $this->slugify($data['neighborhood']);
        $stateSlug = $this->slugify($data['state'] ?? 'mg'); // Default to mg if null
        
        // Location format: mg+belo-horizonte++sion
        $locationSlug = "{$stateSlug}+{$citySlug}++{$neighborhoodSlug}";
        
        // Parse bedrooms
        $bedrooms = $data['bedrooms'] ?? 0;
        $bedroomsSlug = "{$bedrooms}-quartos";
        
        // Final slug structure: venda/apartamentos/mg+belo-horizonte++sion/3-quartos
        // However, we just store the identifying part or the full string?
        // The user wants this SPECIFIC URL structure.
        // If we store the whole thing as 'slug', it might be very long and duplicated if units are similar.
        // But for SEO, uniqueness is key.
        // Let's generate: {purpose}/{type_plural}/{state}+{city}++{neighborhood}/{bedrooms}-quartos
        // And append ID if needed for uniqueness?
        // Or simply store the "meaningful" part and let ID handle uniqueness if query fails?
        // Actually, usually slug is the unique identifier in the URL.
        // If 2 apts in Sion have 3 bedrooms, they will have same slug.
        // We should append ID at the end like: .../3-quartos/123 or .../3-quartos-123
        // User didn't specify ID in URL.
        // "venda/apartamentos/mg+belo-horizonte++sion/3-quartos/"
        // If multiple matches, we might need a list? No, user implied detail page.
        // Let's append ID to make it unique and resolvable: 
        // venda/apartamentos/mg+belo-horizonte++sion/3-quartos-{id}
        // OR better: use the ID from the route regex if available, but here we need a stored slug.
        // Let's stick to a standard slug for the database column that REPRESENTS this structure, 
        // but maybe the ROUTER constructs the full path?
        // PROPOSAL: The 'slug' column will store the unique identifying part, e.g. "apartamento-sion-3-quartos-123"
        // BUT the URL requested is hierarchical.
        // To achieve exactly: url.com/venda/apartamentos/...
        // The router needs to handle "venda" and "apartamentos" as parameters.
        // AND we need a way to find the specific property.
        // If we want THAT EXACT URL to point to a SINGLE property, it must be unique.
        // If I have 10 apartments with 3 bedrooms in Sion, they all share that URL.
        // So that URL implies a LISTING (Catalog), not a specific property, UNLESS it has an ID or unique hash.
        // User said: "slug do imóvel está errado... quero a url amigável... venda/.../3-quartos/"
        // If I assume this IS the property page, it MUST be unique.
        // I will add the ID at the end to ensure uniqueness and correct routing:
        // .../3-quartos-{id}
        
        $purposeSlug = $data['purpose'] == 'sale' ? 'venda' : 'aluguel';
        
        $fullSlug = "{$purposeSlug}/{$typeSlug}/{$locationSlug}/{$bedroomsSlug}";
        
        // If ID is available, append it for absolute uniqueness and fast lookup
        if ($id) {
             $fullSlug .= "-{$id}";
        } else {
            // For new records without ID yet... this is tricky. 
            // We usually need the ID to maximize uniqueness easily.
            // Or we use a temporary placeholder and update after insert?
            // Or we just use a random hash?
            // Let's use a temporary uniqid if new.
            // But wait, user sees this URL.
            // Let's use a timestamp or similar if no ID.
            // Better: insert first, then generate slug and update.
            // For now, let's Generate a 'base' slug:
            // "apartamentos-mg-belo-horizonte-sion-3-quartos"
            // And use that in the DB 'slug' column. 
            // AND UPDATE ROUTER to handle the fancy slashes.
            // Wait, if the column 'slug' can contain slashes, we can store the whole path!
            // "venda/apartamentos/mg+belo-horizonte++sion/3-quartos-123"
            // This is the specific property slug.
        }
        
        return strtolower($fullSlug);
    }

    private function slugify($text) {
        // Simple slugify helper inside logic
        $text = iconv('UTF-8', 'ASCII//TRANSLIT', $text);
        $text = preg_replace('/[^a-zA-Z0-9\s]/', '', $text);
        $text = strtolower(trim($text));
        $text = preg_replace('/\s+/', '-', $text);
        return $text;
    }

    // Keeping original method for compatibility but redirection
    public function generateSlug($title, $id = null) {
         // This is the old signature. We should likely NOT use this for the new format 
         // without extra data.
         // However, existing code calls this.
         // We'll return a simple fallback or try to fetch data if ID provided.
         return $this->slugify($title); // Fallback
    }
    
    // NEW method for the advanced format
    public function generateAdvancedSlug($data, $id = null) {
         $purposeSlug = $data['purpose'] === 'sale' ? 'venda' : 'aluguel';
         
         $typeSlug = $this->slugify($data['type']);
         if (substr($typeSlug, -1) !== 's') $typeSlug .= 's';
         
         $state = strtolower($data['state'] ?? 'mg');
         $city = $this->slugify($data['city']);
         $neighborhood = $this->slugify($data['neighborhood']);
         
         $bedrooms = $data['bedrooms'] ?? 0;
         
         // Format: mg+belo-horizonte++sion
         // Note: User used '++' between city and neighborhood
         $location = "{$state}+{$city}++{$neighborhood}";
         
         $base = "{$purposeSlug}/{$typeSlug}/{$location}/{$bedrooms}-quartos";
         
         // Append ID for uniqueness and routing
         if ($id) {
             return "{$base}-{$id}";
         }
         
         // If no ID, we might have collisions, handled by caller (insert then update)
         return "{$base}-" . time(); // Temporary fallback

    
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

