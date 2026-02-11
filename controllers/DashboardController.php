<?php

class DashboardController {
    public function index() {
        $clientModel = new Client();
        $propertyModel = new Property();
        $proposalModel = new Proposal();

        $totalClients = $clientModel->count();
        $totalProperties = $propertyModel->count();
        $totalProposals = $proposalModel->count();

        $pageTitle = 'Painel Geral';
        require_once 'views/layout/header.php';
        require_once 'views/dashboard.php';
        require_once 'views/layout/footer.php';
    }
}
