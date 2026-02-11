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
        $sql = "INSERT INTO properties (title, type, purpose, price, address, neighborhood, city, area, bedrooms, bathrooms, garages, description, status, images) VALUES (:title, :type, :purpose, :price, :address, :neighborhood, :city, :area, :bedrooms, :bathrooms, :garages, :description, :status, :images)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function count() {
        $stmt = $this->conn->query("SELECT COUNT(*) FROM properties");
        return $stmt->fetchColumn();
    }
}
