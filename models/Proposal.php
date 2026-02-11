<?php

class Proposal {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $sql = "SELECT p.*, c.name as client_name, pr.title as property_title 
                FROM proposals p 
                JOIN clients c ON p.client_id = c.id 
                JOIN properties pr ON p.property_id = pr.id 
                ORDER BY p.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($data) {
        $sql = "INSERT INTO proposals (client_id, property_id, value, conditions, observations, status) VALUES (:client_id, :property_id, :value, :conditions, :observations, :status)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM proposals");
        return $stmt->fetchColumn();
    }
}
