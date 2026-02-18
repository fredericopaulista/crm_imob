<?php
require_once 'config.php';
require_once 'db.php';

try {
    $conn = Database::getInstance()->getConnection();
    
    // Check if column exists
    $stmt = $conn->query("SHOW COLUMNS FROM properties LIKE 'featured'");
    $result = $stmt->fetch();
    
    if (!$result) {
        $sql = "ALTER TABLE properties ADD COLUMN featured TINYINT(1) DEFAULT 0 AFTER status";
        $conn->exec($sql);
        echo "<h1>Sucesso!</h1><p>Coluna 'featured' adicionada à tabela 'properties'.</p>";
    } else {
        echo "<h1>Aviso</h1><p>A coluna 'featured' já existe.</p>";
    }
    
    echo "<p><a href='" . APP_URL . "/painel/imoveis'>Voltar para Imóveis</a></p>";

} catch (PDOException $e) {
    echo "<h1>Erro</h1><p>" . $e->getMessage() . "</p>";
}
