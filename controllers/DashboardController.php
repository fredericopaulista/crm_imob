<?php

class DashboardController {
    public function index() {
        $pageTitle = 'Dashboard';
        require_once 'views/layout/header.php';
        require_once 'views/dashboard.php';
        require_once 'views/layout/footer.php';
    }
}
