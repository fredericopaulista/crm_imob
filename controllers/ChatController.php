<?php

class ChatController {
    
    public function index() {
        // Chat Interface
        $clientModel = new Client();
        $clients = $clientModel->getAll(); // In real app, order by last message
        
        $activeClientId = isset($_GET['client_id']) ? $_GET['client_id'] : null;
        $messages = [];
        $activeClient = null;

        if ($activeClientId) {
            $conn = Database::getInstance()->getConnection();
            
            // Get Client
            $activeClient = $clientModel->getById($activeClientId);

            // Get Conversation
            $stmt = $conn->prepare("SELECT id FROM conversations WHERE client_id = :client_id");
            $stmt->execute([':client_id' => $activeClientId]);
            $conversation = $stmt->fetch();

            if ($conversation) {
                // Get Messages
                $stmtMsg = $conn->prepare("SELECT * FROM messages WHERE conversation_id = :conversation_id ORDER BY created_at ASC");
                $stmtMsg->execute([':conversation_id' => $conversation['id']]);
                $messages = $stmtMsg->fetchAll();
            }
        }

        $pageTitle = 'Atendimento WhatsApp';
        require_once 'views/layout/header.php';
        require_once 'views/whatsapp/chat.php';
        require_once 'views/layout/footer.php';
    }

    public function settings() {
        $waService = new WhatsAppService();
        $settings = $waService->getSettings();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $waService->updateSettings(
                $_POST['waba_id'],
                $_POST['phone_number_id'],
                $_POST['access_token'],
                $_POST['webhook_verify_token']
            );
            header('Location: ' . APP_URL . '/whatsapp/configuracoes');
            exit;
        }

        $pageTitle = 'Conexão WhatsApp (API)';
        require_once 'views/layout/header.php';
        require_once 'views/whatsapp/settings.php';
        require_once 'views/layout/footer.php';
    }

    public function sendMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clientId = $_POST['client_id'];
            $message = $_POST['message'];

            $clientModel = new Client();
            $client = $clientModel->getById($clientId);

            if ($client) {
                $waService = new WhatsAppService();
                $response = $waService->sendMessage($client['phone'], 'text', $message);
                
                if (isset($response['messages'][0]['id'])) {
                    // Log message to DB
                    $conn = Database::getInstance()->getConnection();
                    
                    // Allow conversation creation or get existing
                    $stmt = $conn->prepare("SELECT id FROM conversations WHERE client_id = :client_id");
                    $stmt->execute([':client_id' => $clientId]);
                    $conversation = $stmt->fetch();
                    
                    if (!$conversation) {
                         $stmt = $conn->prepare("INSERT INTO conversations (client_id, last_message, last_message_at) VALUES (:client_id, :last_message, NOW())");
                         $stmt->execute([':client_id' => $clientId, ':last_message' => $message]);
                         $conversationId = $conn->lastInsertId();
                    } else {
                         $conversationId = $conversation['id'];
                         // Update last message
                         $stmt = $conn->prepare("UPDATE conversations SET last_message = :last_message, last_message_at = NOW() WHERE id = :id");
                         $stmt->execute([':last_message' => $message, ':id' => $conversationId]);
                    }

                    // Insert Message
                    $stmt = $conn->prepare("INSERT INTO messages (conversation_id, direction, type, body, whatsapp_message_id, status) VALUES (:conversation_id, 'outbound', 'text', :body, :wa_id, 'sent')");
                    $stmt->execute([
                        ':conversation_id' => $conversationId,
                        ':body' => $message,
                        ':wa_id' => $response['messages'][0]['id']
                    ]);
                }
            }
            
            // Return JSON for AJAX
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'data' => $response]);
            exit;
        }
    }
}
