<?php
class Setting {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    /**
     * Get a setting value by key
     */
    public function get($key, $default = null) {
        $stmt = $this->conn->prepare("SELECT setting_value FROM settings WHERE setting_key = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['setting_value'] : $default;
    }
    
    /**
     * Set a setting value
     */
    public function set($key, $value) {
        $stmt = $this->conn->prepare("
            INSERT INTO settings (setting_key, setting_value) 
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE setting_value = ?, updated_at = CURRENT_TIMESTAMP
        ");
        return $stmt->execute([$key, $value, $value]);
    }
    
    /**
     * Get all settings as key-value array
     */
    public function getAll() {
        $stmt = $this->conn->query("SELECT setting_key, setting_value FROM settings");
        $settings = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $settings[$row['setting_key']] = $row['setting_value'];
        }
        return $settings;
    }
    
    /**
     * Update multiple settings at once
     */
    public function updateMultiple($settings) {
        $this->conn->beginTransaction();
        try {
            foreach ($settings as $key => $value) {
                $this->set($key, $value);
            }
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }
    
    /**
     * Delete a setting
     */
    public function delete($key) {
        $stmt = $this->conn->prepare("DELETE FROM settings WHERE setting_key = ?");
        return $stmt->execute([$key]);
    }
}
