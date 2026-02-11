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
