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

    public function getLeads() {
        $stmt = $this->conn->prepare("
            SELECT c.*, s.name as stage_name, s.color as stage_color, o.name as origin_name 
            FROM clients c 
            LEFT JOIN lead_stages s ON c.stage_id = s.id 
            LEFT JOIN lead_origins o ON c.origin_id = o.id
            WHERE c.type = 'lead' 
            ORDER BY c.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getClients() {
        $stmt = $this->conn->prepare("SELECT * FROM clients WHERE type IN ('buyer', 'tenant') ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getOwners() {
        $stmt = $this->conn->prepare("SELECT * FROM clients WHERE type = 'owner' ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function convertLeadToClient($id, $newType) {
        $sql = "UPDATE clients SET type = :type, status = 'contacted' WHERE id = :id AND type = 'lead'";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':type' => $newType, ':id' => $id]);
    }

    public function create($data) {
        // If stage_id is not set, set default to first stage
        if (!isset($data[':stage_id'])) {
            $stmt = $this->conn->query("SELECT id FROM lead_stages ORDER BY order_index ASC LIMIT 1");
            $defaultStage = $stmt->fetchColumn();
            $data[':stage_id'] = $defaultStage;
        }

        $sql = "INSERT INTO clients (name, email, phone, type, origin_id, observations, status, stage_id) VALUES (:name, :email, :phone, :type, :origin_id, :observations, :status, :stage_id)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
    
    public function updateStage($leadId, $stageId) {
        $sql = "UPDATE clients SET stage_id = :stage_id WHERE id = :id AND type = 'lead'";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':stage_id' => $stageId, ':id' => $leadId]);
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

    public function getLeadsByStageCount() {
        $stmt = $this->conn->prepare("
            SELECT s.name, s.color, COUNT(c.id) as count
            FROM lead_stages s
            LEFT JOIN clients c ON s.id = c.stage_id AND c.type = 'lead'
            GROUP BY s.id, s.name, s.color
            ORDER BY s.order_index ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLeadsByOriginCount() {
        $stmt = $this->conn->prepare("
            SELECT o.name, COUNT(c.id) as count
            FROM lead_origins o
            LEFT JOIN clients c ON o.id = c.origin_id AND c.type = 'lead'
            WHERE o.active = 1
            GROUP BY o.id, o.name
            HAVING count > 0
            ORDER BY count DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM clients");
        return $stmt->fetchColumn();
    }
}
