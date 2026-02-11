<?php

class WhatsAppService {
    private $conn;
    private $waba_id;
    private $phone_number_id;
    private $access_token;
    private $api_version = 'v18.0';

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
        $this->loadSettings();
    }

    private function loadSettings() {
        $stmt = $this->conn->prepare("SELECT * FROM whatsapp_settings WHERE id = 1");
        $stmt->execute();
        $settings = $stmt->fetch();
        if ($settings) {
            $this->waba_id = $settings['waba_id'];
            $this->phone_number_id = $settings['phone_number_id'];
            $this->access_token = $settings['access_token'];
        }
    }

    public function sendMessage($to, $type, $content) {
        if (!$this->phone_number_id || !$this->access_token) {
            return ['error' => 'WhatsApp not configured'];
        }

        $url = "https://graph.facebook.com/{$this->api_version}/{$this->phone_number_id}/messages";
        
        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => $type
        ];

        if ($type === 'text') {
            $data['text'] = ['body' => $content];
        } elseif ($type === 'template') {
            // content should be an array with name and language
            $data['template'] = $content;
        }

        return $this->makeRequest($url, $data);
    }

    private function makeRequest($url, $data) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->access_token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function updateSettings($waba_id, $phone_number_id, $access_token, $webhook_verify_token) {
        $sql = "UPDATE whatsapp_settings SET waba_id = :waba_id, phone_number_id = :phone_number_id, access_token = :access_token, webhook_verify_token = :webhook_verify_token WHERE id = 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':waba_id' => $waba_id,
            ':phone_number_id' => $phone_number_id,
            ':access_token' => $access_token,
            ':webhook_verify_token' => $webhook_verify_token
        ]);
    }

    public function getSettings() {
        $stmt = $this->conn->prepare("SELECT * FROM whatsapp_settings WHERE id = 1");
        $stmt->execute();
        return $stmt->fetch();
    }
}
