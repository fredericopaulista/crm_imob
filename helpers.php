<?php

if (!function_exists('can')) {
    function can($permissionSlug) {
        if (isset($_SESSION['user_permissions']) && in_array($permissionSlug, $_SESSION['user_permissions'])) {
            return true;
        }
        // Fallback for Admin role during migration/maintenance
        if (isset($_SESSION['user_role']) && strcasecmp($_SESSION['user_role'], 'Admin') === 0) return true; 

        return false;
    }
}

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT value FROM settings WHERE key_name = ?");
        $stmt->execute([$key]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $result ? $result['value'] : $default;
    }
}

if (!function_exists('company_name')) {
    function company_name() {
        return htmlspecialchars(get_setting('company_name', 'Correta Pro'));
    }
}
