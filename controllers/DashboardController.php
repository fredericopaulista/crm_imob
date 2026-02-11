<?php

class DashboardController {
    public function index() {
        $clientModel = new Client();
        $propertyModel = new Property();
        $proposalModel = new Proposal();

        $totalClients = $clientModel->count();
        $totalProperties = $propertyModel->count();
        $totalProposals = $proposalModel->count();

        // Check WhatsApp Connection
        $waService = new WhatsAppService();
        $waSettings = $waService->getSettings();
        $whatsappConnected = !empty($waSettings['waba_id']) && !empty($waSettings['phone_number_id']) && !empty($waSettings['access_token']);

        $pageTitle = 'Painel Geral';
        require_once 'views/layout/header.php';
        require_once 'views/dashboard.php';
        require_once 'views/layout/footer.php';
    }
}
