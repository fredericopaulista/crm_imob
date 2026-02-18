<?php
class LeadStage {
    private $conn;
    private $table = 'lead_stages';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table . " ORDER BY order_index ASC");
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
        $query = "INSERT INTO " . $this->table . " (name, color, order_index) VALUES (:name, :color, :order_index)";
        $stmt = $this->conn->prepare($query);

        // Get max order_index to append to end
        $maxOrderStmt = $this->conn->query("SELECT MAX(order_index) FROM " . $this->table);
        $maxOrder = $maxOrderStmt->fetchColumn();
        $orderIndex = $maxOrder !== false ? $maxOrder + 1 : 0;

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':color', $data['color']);
        $stmt->bindParam(':order_index', $orderIndex);

        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET name = :name, color = :color WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':color', $data['color']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        // Prevent deleting system stages if needed, but for now allow strict control
        // Check if stage is system?
        $stage = $this->getById($id);
        if ($stage && $stage['is_system']) {
            return false; // Cannot delete system stage
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function updateOrder($stages) {
        $query = "UPDATE " . $this->table . " SET order_index = :order_index WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        foreach ($stages as $index => $id) {
            $stmt->bindValue(':order_index', $index);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
        }
        return true;
    }
}
