<?php

class Appointment {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll($filters = []) {
        $sql = "SELECT a.*, 
                       c.name as lead_name, 
                       p.title as property_title, 
                       p.address as property_address,
                       u.name as user_name
                FROM appointments a
                JOIN clients c ON a.lead_id = c.id
                JOIN properties p ON a.property_id = p.id
                JOIN users u ON a.user_id = u.id
                WHERE 1=1";
        
        $params = [];

        if (!empty($filters['user_id'])) {
            $sql .= " AND a.user_id = :user_id";
            $params[':user_id'] = $filters['user_id'];
        }

        if (!empty($filters['status'])) {
            $sql .= " AND a.status = :status";
            $params[':status'] = $filters['status'];
        }
        
        if (!empty($filters['date_start'])) {
            $sql .= " AND a.visit_date >= :date_start";
            $params[':date_start'] = $filters['date_start'];
        }

        if (!empty($filters['date_end'])) {
            $sql .= " AND a.visit_date <= :date_end";
            $params[':date_end'] = $filters['date_end'];
        }

        $sql .= " ORDER BY a.visit_date ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT a.*, 
                       c.name as lead_name, 
                       p.title as property_title, 
                       u.name as user_name
                FROM appointments a
                JOIN clients c ON a.lead_id = c.id
                JOIN properties p ON a.property_id = p.id
                JOIN users u ON a.user_id = u.id
                WHERE a.id = :id";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO appointments (lead_id, property_id, user_id, visit_date, status, notes) 
                VALUES (:lead_id, :property_id, :user_id, :visit_date, :status, :notes)";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':lead_id' => $data['lead_id'],
            ':property_id' => $data['property_id'],
            ':user_id' => $data['user_id'],
            ':visit_date' => $data['visit_date'],
            ':status' => $data['status'] ?? 'scheduled',
            ':notes' => $data['notes'] ?? null
        ]);
    }

    public function update($id, $data) {
        $sql = "UPDATE appointments SET 
                lead_id = :lead_id, 
                property_id = :property_id, 
                user_id = :user_id, 
                visit_date = :visit_date, 
                status = :status, 
                notes = :notes 
                WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':lead_id' => $data['lead_id'],
            ':property_id' => $data['property_id'],
            ':user_id' => $data['user_id'],
            ':visit_date' => $data['visit_date'],
            ':status' => $data['status'],
            ':notes' => $data['notes'] ?? null,
            ':id' => $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM appointments WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    
    public function updateStatus($id, $status) {
        $stmt = $this->conn->prepare("UPDATE appointments SET status = :status WHERE id = :id");
        return $stmt->execute([':status' => $status, ':id' => $id]);
    }
}
