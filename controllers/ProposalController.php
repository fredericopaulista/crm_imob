<?php

class ProposalController {
    public function index() {
        $proposalModel = new Proposal();
        $proposals = $proposalModel->getAll();
        
        $pageTitle = 'Gestão de Propostas';
        require_once 'views/layout/header.php';
        require_once 'views/proposals/index.php';
        require_once 'views/layout/footer.php';
    }

    public function create() {
        $clientModel = new Client();
        $clients = $clientModel->getAll();

        $propertyModel = new Property();
        $properties = $propertyModel->getAll();

        $pageTitle = 'Nova Proposta Comercial';
        require_once 'views/layout/header.php';
        require_once 'views/proposals/create.php';
        require_once 'views/layout/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'client_id' => $_POST['client_id'],
                'property_id' => $_POST['property_id'],
                'value' => $_POST['value'],
                'conditions' => $_POST['conditions'],
                'observations' => $_POST['observations'],
                'status' => 'sent'
            ];

            $proposalModel = new Proposal();
            if ($proposalModel->create($data)) {
                header('Location: ' . APP_URL . '/painel/propostas');
            } else {
                echo "Error creating proposal";
            }
        }
    }

    public function generatePdf($id) {
        // In a real scenario, you would use Composer to install dompdf
        // require 'vendor/autoload.php';
        // use Dompdf\Dompdf;
        
        // Mock PDF generation for this environment without Composer access
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT p.*, c.name as client_name, c.email as client_email, pr.title as property_title, pr.address as property_address 
                                FROM proposals p 
                                JOIN clients c ON p.client_id = c.id 
                                JOIN properties pr ON p.property_id = pr.id 
                                WHERE p.id = :id");
        $stmt->execute([':id' => $id]);
        $proposal = $stmt->fetch();

        if (!$proposal) {
            die("Proposta não encontrada.");
        }

        // HTML Layout for PDF
        $html = "
        <html>
        <head>
            <style>
                body { font-family: sans-serif; }
                .header { text-align: center; margin-bottom: 30px; }
                .content { margin: 20px; }
                .box { border: 1px solid #ccc; padding: 20px; margin-bottom: 20px; }
                h1 { color: #333; }
                .label { font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>Proposta Comercial #{$proposal['id']}</h1>
                <p>" . APP_NAME . "</p>
            </div>
            <div class='content'>
                <div class='box'>
                    <h3>Dados do Cliente</h3>
                    <p><span class='label'>Nome:</span> {$proposal['client_name']}</p>
                    <p><span class='label'>Email:</span> {$proposal['client_email']}</p>
                </div>
                <div class='box'>
                    <h3>Dados do Imóvel</h3>
                    <p><span class='label'>Imóvel:</span> {$proposal['property_title']}</p>
                    <p><span class='label'>Endereço:</span> {$proposal['property_address']}</p>
                </div>
                <div class='box'>
                    <h3>Detalhes da Proposta</h3>
                    <p><span class='label'>Valor Oferecido:</span> R$ " . number_format($proposal['value'], 2, ',', '.') . "</p>
                    <p><span class='label'>Condições:</span><br>" . nl2br($proposal['conditions']) . "</p>
                    <p><span class='label'>Status:</span> " . ucfirst($proposal['status']) . "</p>
                    <p><span class='label'>Data:</span> " . date('d/m/Y H:i', strtotime($proposal['created_at'])) . "</p>
                </div>
            </div>
            <script>window.print();</script>
        </body>
        </html>
        ";

        echo $html;
        // NOTE: To use real PDF, uncomment below after running 'composer require dompdf/dompdf'
        /*
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('proposta-'.$id.'.pdf');
        */
    }
}
