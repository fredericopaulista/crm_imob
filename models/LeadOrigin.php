<?php
class LeadOrigin {
    private $conn;
    private $table = 'lead_origins';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE active = 1 ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (name, active) VALUES (:name, 1)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        // Soft delete or hard delete? Let's do soft delete by setting active=0 if we want history, 
        // but user requested CRUD. If we delete, leads with this origin might lose data or need set null.
        // Let's allow hard delete for now but ensure FK set null logic handles it (constraint ON DELETE SET NULL).
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
