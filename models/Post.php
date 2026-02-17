<?php
class Post {
    private $conn;
    private $table_name = "posts";

    public $id;
    public $title;
    public $slug;
    public $content;
    public $excerpt;
    public $image;
    public $status;
    public $author_id;
    public $created_at;
    public $updated_at;

    public function __construct($db = null) {
        if ($db) {
            $this->conn = $db;
        } else {
            $this->conn = Database::getInstance()->getConnection();
        }
    }

    public function getAll($limit = null, $status = null) {
        $query = "SELECT p.*, u.name as author_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN users u ON p.author_id = u.id";
        
        if ($status) {
            $query .= " WHERE p.status = :status";
        }
        
        $query .= " ORDER BY p.created_at DESC";
        
        if ($limit) {
            $query .= " LIMIT " . (int)$limit;
        }

        $stmt = $this->conn->prepare($query);
        
        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $query = "SELECT p.*, u.name as author_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN users u ON p.author_id = u.id 
                  WHERE p.id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findBySlug($slug) {
        $query = "SELECT p.*, u.name as author_name 
                  FROM " . $this->table_name . " p 
                  LEFT JOIN users u ON p.author_id = u.id 
                  WHERE p.slug = :slug LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':slug', $slug);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  (title, slug, content, excerpt, image, status, author_id) 
                  VALUES (:title, :slug, :content, :excerpt, :image, :status, :author_id)";

        $stmt = $this->conn->prepare($query);

        // Sanitize and bind
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':excerpt', $data['excerpt']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':author_id', $data['author_id']);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, 
                      slug = :slug, 
                      content = :content, 
                      excerpt = :excerpt, 
                      image = :image, 
                      status = :status 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':excerpt', $data['excerpt']);
        $stmt->bindParam(':image', $data['image']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
