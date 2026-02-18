<?php
require_once 'config.php';
require_once 'db.php';

try {
    $conn = Database::getInstance()->getConnection();
    
    $sql = "CREATE TABLE IF NOT EXISTS appointments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        lead_id INT NOT NULL,
        property_id INT NOT NULL,
        user_id INT NOT NULL,
        visit_date DATETIME NOT NULL,
        status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (lead_id) REFERENCES clients(id) ON DELETE CASCADE,
        FOREIGN KEY (property_id) REFERENCES properties(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    );";

    $conn->exec($sql);
    echo "<h1>Sucesso!</h1><p>A tabela 'appointments' foi criada com sucesso.</p>";
    echo "<p><a href='" . APP_URL . "/painel/agenda'>Ir para a Agenda</a></p>";

} catch (PDOException $e) {
    echo "<h1>Erro</h1><p>" . $e->getMessage() . "</p>";
}
