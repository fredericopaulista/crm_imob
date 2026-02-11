<?php

class Client {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM clients ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO clients (name, email, phone, type, origin, observations, status) VALUES (:name, :email, :phone, :type, :origin, :observations, :status)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM clients WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addTag($clientId, $tagId) {
        // Check if already tagged
        $stmt = $this->conn->prepare("SELECT * FROM client_tags WHERE client_id = :client_id AND tag_id = :tag_id");
        $stmt->bindParam(':client_id', $clientId);
        $stmt->bindParam(':tag_id', $tagId);
        $stmt->execute();
        
        if (!$stmt->fetch()) {
            $stmt = $this->conn->prepare("INSERT INTO client_tags (client_id, tag_id) VALUES (:client_id, :tag_id)");
            $stmt->bindParam(':client_id', $clientId);
            $stmt->bindParam(':tag_id', $tagId);
            return $stmt->execute();
        }
        return true;
    }

    public function getTags($clientId) {
        $stmt = $this->conn->prepare("
            SELECT t.* 
            FROM tags t
            JOIN client_tags ct ON t.id = ct.tag_id
            WHERE ct.client_id = :client_id
        ");
        $stmt->bindParam(':client_id', $clientId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByTag($tagId) {
        $stmt = $this->conn->prepare("
            SELECT c.* 
            FROM clients c
            JOIN client_tags ct ON c.id = ct.client_id
            WHERE ct.tag_id = :tag_id
            ORDER BY c.created_at DESC
        ");
        $stmt->bindParam(':tag_id', $tagId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
