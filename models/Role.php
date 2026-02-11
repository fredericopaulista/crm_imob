<?php

class Role {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM roles ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($name, $description, $permissions) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT INTO roles (name, description) VALUES (:name, :description)");
            $stmt->execute([':name' => $name, ':description' => $description]);
            $roleId = $this->conn->lastInsertId();

            $this->syncPermissions($roleId, $permissions);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function update($id, $name, $description, $permissions) {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("UPDATE roles SET name = :name, description = :description WHERE id = :id");
            $stmt->execute([':name' => $name, ':description' => $description, ':id' => $id]);

            $this->syncPermissions($id, $permissions);

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM roles WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    private function syncPermissions($roleId, $permissions) {
        // Clear existing
        $stmt = $this->conn->prepare("DELETE FROM role_permissions WHERE role_id = :role_id");
        $stmt->execute([':role_id' => $roleId]);

        // Insert new
        if (!empty($permissions)) {
            $stmt = $this->conn->prepare("INSERT INTO role_permissions (role_id, permission_id) VALUES (:role_id, :permission_id)");
            foreach ($permissions as $permId) {
                $stmt->execute([':role_id' => $roleId, ':permission_id' => $permId]);
            }
        }
    }

    public function getPermissions($roleId) {
        $stmt = $this->conn->prepare("SELECT permission_id FROM role_permissions WHERE role_id = :role_id");
        $stmt->bindParam(':role_id', $roleId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
