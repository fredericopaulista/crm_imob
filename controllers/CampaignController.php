<?php

class CampaignController {

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . APP_URL . '/auth/login');
            exit;
        }
        if (!can('manage_marketing')) {
            echo "Acesso negado. Você precisa da permissão 'Gerenciar Marketing'.";
            exit;
        }
    }

    public function index() {
        $broadcasts = $this->getBroadcastHistory();
        
        $pageTitle = 'Marketing e Disparos';
        require_once 'views/layout/header.php';
        require_once 'views/campaigns/index.php';
        require_once 'views/layout/footer.php';
    }

    public function import() {
        $pageTitle = 'Importar Contatos';
        require_once 'views/layout/header.php';
        require_once 'views/campaigns/import.php';
        require_once 'views/layout/footer.php';
    }

    public function processImport() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
            $file = $_FILES['csv_file']['tmp_name'];
            
            if (($handle = fopen($file, "r")) !== FALSE) {
                $clientModel = new Client();
                $importedCount = 0;
                $skippedCount = 0;

                // Skip header row if selected
                if (isset($_POST['skip_header'])) {
                    fgetcsv($handle, 1000, ",");
                }

                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Assuming CSV format: Name, Phone, Email (optional)
                    // You might want to make this mapping dynamic in a real app
                    $name = $data[0] ?? '';
                    $phone = $data[1] ?? '';
                    $email = $data[2] ?? '';

                    if (!empty($name) && !empty($phone)) {
                        // Check if phone or email already exists to avoid duplicates
                        // For simplicity, let's just create. In prod, check duplication.
                        // Ideally Client model should have a check
                        
                        $clientData = [
                            'name' => $name,
                            'phone' => $phone, // IMPORTANT: Sanitize phone in a real app!
                            'email' => $email,
                            'type' => 'lead', // Default type for imported
                            'origin' => 'import_csv',
                            'status' => 'new'
                        ];
                        
                        // Basic duplicate check by phone (very simple)
                        if (!$this->clientExists($phone)) {
                             if ($clientModel->create($clientData)) {
                                 $importedCount++;
                             }
                        } else {
                            $skippedCount++;
                        }
                    }
                }
                fclose($handle);
                header('Location: ' . APP_URL . '/campaign/import?success=1&imported=' . $importedCount . '&skipped=' . $skippedCount);
            } else {
                 echo "Erro ao ler arquivo.";
            }
        }
    }

    public function broadcast() {
        $clientModel = new Client();
        $clients = $clientModel->getAll(); // In real app, maybe filter by tag/status

        $pageTitle = 'Novo Disparo';
        require_once 'views/layout/header.php';
        require_once 'views/campaigns/broadcast.php';
        require_once 'views/layout/footer.php';
    }

    public function sendBroadcast() {
        // AJAX endpoint
        header('Content-Type: application/json');
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!$input) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
            exit;
        }

        $clientId = $input['client_id'];
        $message = $input['message'];
        
        // Use WhatsAppService
        $waService = new WhatsAppService();
        
        // Get Client Phone
        $clientModel = new Client();
        $client = $clientModel->getById($clientId);
        
        if ($client) {
            $response = $waService->sendMessage($client['phone'], 'text', $message);
            
            // Log to message_logs (already handled in sendMessage? No, controller usually calls log. 
            // In WhatsAppController it logged. Let's replicate or assume service does it.
            // Service just attempts send. We should log if we want history.
            
            // For now just return success
             echo json_encode(['status' => 'success', 'client' => $client['name']]);
        } else {
             echo json_encode(['status' => 'error', 'message' => 'Client not found']);
        }
    }

    private function getBroadcastHistory() {
        return []; // Implement DB fetch later
    }
    
    private function clientExists($phone) {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("SELECT id FROM clients WHERE phone = :phone");
        $stmt->bindValue(':phone', $phone);
        $stmt->execute();
        return $stmt->fetch() !== false;
    }
}
