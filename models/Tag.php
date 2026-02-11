<?php

class Tag {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($name) {
        // Check if exists first
        $existing = $this->getByName($name);
        if ($existing) {
            return $existing['id'];
        }

        $stmt = $this->conn->prepare("INSERT INTO tags (name) VALUES (:name)");
        $stmt->bindParam(':name', $name);
        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM tags ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByName($name) {
        $stmt = $this->conn->prepare("SELECT * FROM tags WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }
}
