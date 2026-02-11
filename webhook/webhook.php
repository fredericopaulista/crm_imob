<?php
require_once '../config.php';
require_once '../db.php';

// Log incoming request
$payload = file_get_contents('php://input');
$conn = Database::getInstance()->getConnection();

/*
$stmt = $conn->prepare("INSERT INTO message_logs (payload, type) VALUES (:payload, 'raw')");
$stmt->execute([':payload' => $payload]);
*/

$verify_token = '';
$stmt = $conn->prepare("SELECT webhook_verify_token FROM whatsapp_settings WHERE id = 1");
$stmt->execute();
$settings = $stmt->fetch();
if ($settings) {
    $verify_token = $settings['webhook_verify_token'];
}

// Verification Request
if (isset($_GET['hub_mode']) && $_GET['hub_mode'] == 'subscribe') {
    if ($_GET['hub_verify_token'] == $verify_token) {
        echo $_GET['hub_challenge'];
        exit;
    } else {
        http_response_code(403);
        exit;
    }
}

// Handle Incoming Messages
$data = json_decode($payload, true);

if (isset($data['object']) && $data['object'] == 'whatsapp_business_account') {
    foreach ($data['entry'] as $entry) {
        foreach ($entry['changes'] as $change) {
            if (isset($change['value']['messages'])) {
                $messages = $change['value']['messages'];
                 foreach ($messages as $message) {
                    $from = $message['from']; // Phone number
                    $body = isset($message['text']['body']) ? $message['text']['body'] : '[Mídia ou outro formato]';
                    $wa_id = $message['id'];

                    // Find Client by Phone
                    // Note: Meta sends phone without +, e.g. 5511999999999. Assuming DB stores same format.
                    $stmt = $conn->prepare("SELECT id FROM clients WHERE phone = :phone LIMIT 1");
                    $stmt->execute([':phone' => $from]);
                    $client = $stmt->fetch();

                    if (!$client) {
                        // Create Client Auto (Optional)
                        $sql = "INSERT INTO clients (name, phone, status, origin) VALUES ('Novo Cliente WA', :phone, 'new', 'whatsapp')";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute([':phone' => $from]);
                        $clientId = $conn->lastInsertId();
                    } else {
                        $clientId = $client['id'];
                    }

                    // Log Message
                    // Get or Create Conversation
                     $stmt = $conn->prepare("SELECT id FROM conversations WHERE client_id = :client_id");
                     $stmt->execute([':client_id' => $clientId]);
                     $conversation = $stmt->fetch();
                     
                     if (!$conversation) {
                          $stmt = $conn->prepare("INSERT INTO conversations (client_id, last_message, last_message_at) VALUES (:client_id, :last_message, NOW())");
                          $stmt->execute([':client_id' => $clientId, ':last_message' => $body]);
                          $conversationId = $conn->lastInsertId();
                     } else {
                          $conversationId = $conversation['id'];
                          $stmt = $conn->prepare("UPDATE conversations SET last_message = :last_message, last_message_at = NOW(), unread_count = unread_count + 1 WHERE id = :id");
                          $stmt->execute([':last_message' => $body, ':id' => $conversationId]);
                     }

                     // Insert Message
                     $stmt = $conn->prepare("INSERT INTO messages (conversation_id, direction, type, body, whatsapp_message_id, status) VALUES (:conversation_id, 'inbound', 'text', :body, :wa_id, 'received')");
                     $stmt->execute([
                         ':conversation_id' => $conversationId,
                         ':body' => $body,
                         ':wa_id' => $wa_id
                     ]);
                 }
            }
        }
    }
}
