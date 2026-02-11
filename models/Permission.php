<?php

class Permission {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM permissions ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
