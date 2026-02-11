<?php
require_once 'config.php';

try {
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Conectado ao banco de dados com sucesso!\n\n";
    
    // Insert 10 Clients
    echo "Inserindo 10 clientes...\n";
    $clientsSQL = "INSERT INTO clients (name, email, phone, type, status, created_at) VALUES
    ('João Silva', 'joao.silva@email.com', '(11) 98765-4321', 'lead', 'new', NOW()),
    ('Maria Santos', 'maria.santos@email.com', '(11) 97654-3210', 'owner', 'active', NOW()),
    ('Pedro Oliveira', 'pedro.oliveira@email.com', '(11) 96543-2109', 'lead', 'new', NOW()),
    ('Ana Costa', 'ana.costa@email.com', '(11) 95432-1098', 'tenant', 'active', NOW()),
    ('Carlos Ferreira', 'carlos.ferreira@email.com', '(11) 94321-0987', 'lead', 'contacted', NOW()),
    ('Juliana Almeida', 'juliana.almeida@email.com', '(11) 93210-9876', 'owner', 'active', NOW()),
    ('Roberto Souza', 'roberto.souza@email.com', '(11) 92109-8765', 'lead', 'new', NOW()),
    ('Fernanda Lima', 'fernanda.lima@email.com', '(11) 91098-7654', 'tenant', 'active', NOW()),
    ('Lucas Martins', 'lucas.martins@email.com', '(11) 90987-6543', 'lead', 'contacted', NOW()),
    ('Patricia Rocha', 'patricia.rocha@email.com', '(11) 89876-5432', 'owner', 'active', NOW())";
    
    $conn->exec($clientsSQL);
    echo "✓ 10 clientes inseridos com sucesso!\n\n";
    
    // Insert 10 Properties
    echo "Inserindo 10 imóveis...\n";
    $propertiesSQL = "INSERT INTO properties (title, description, type, purpose, price, area, bedrooms, bathrooms, garages, address, neighborhood, city, status, images, created_at) VALUES
    (
        'Apartamento Moderno no Jardins',
        'Lindo apartamento de 3 dormitórios com suíte, varanda gourmet e 2 vagas de garagem. Condomínio com piscina, academia e salão de festas. Localização privilegiada próximo ao metrô.',
        'Apartamento',
        'sale',
        850000.00,
        120,
        3,
        2,
        2,
        'Rua Augusta, 1500',
        'Jardins',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Casa Térrea com Quintal em Pinheiros',
        'Casa espaçosa com 4 quartos, sendo 2 suítes, sala ampla, cozinha planejada e quintal com churrasqueira. Ideal para famílias.',
        'Casa',
        'sale',
        1200000.00,
        250,
        4,
        3,
        3,
        'Rua dos Pinheiros, 890',
        'Pinheiros',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Cobertura Duplex na Vila Madalena',
        'Cobertura duplex com vista panorâmica, 3 suítes, terraço com piscina privativa, churrasqueira e 4 vagas. Acabamento de luxo.',
        'Cobertura',
        'sale',
        2500000.00,
        300,
        3,
        4,
        4,
        'Rua Harmonia, 456',
        'Vila Madalena',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Apartamento Compacto para Aluguel',
        'Studio moderno e funcional, totalmente mobiliado, com 1 vaga. Perfeito para profissionais solteiros. Próximo ao metrô Faria Lima.',
        'Apartamento',
        'rent',
        3500.00,
        45,
        1,
        1,
        1,
        'Av. Faria Lima, 2300',
        'Itaim Bibi',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Sobrado em Condomínio Fechado',
        'Sobrado novo com 3 suítes, sala com pé direito duplo, cozinha americana, área gourmet e piscina. Condomínio com segurança 24h.',
        'Sobrado',
        'sale',
        950000.00,
        180,
        3,
        3,
        2,
        'Rua das Acácias, 123',
        'Morumbi',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Loft Industrial no Brooklin',
        'Loft estilo industrial com mezanino, pé direito alto, janelas amplas e 1 vaga. Área nobre do Brooklin.',
        'Loft',
        'rent',
        4200.00,
        80,
        1,
        1,
        1,
        'Rua Funchal, 567',
        'Brooklin',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Apartamento de Frente para o Parque',
        'Apartamento de 2 dormitórios com vista para o Parque Ibirapuera, varanda, cozinha planejada e 1 vaga. Condomínio clube.',
        'Apartamento',
        'sale',
        720000.00,
        85,
        2,
        2,
        1,
        'Av. República do Líbano, 890',
        'Moema',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Casa Comercial para Aluguel',
        'Casa comercial com 5 salas, 2 banheiros, copa e 3 vagas. Ideal para escritórios, clínicas ou consultórios.',
        'Casa',
        'rent',
        8500.00,
        200,
        5,
        2,
        3,
        'Rua Oscar Freire, 1234',
        'Jardins',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Apartamento Alto Padrão na Berrini',
        'Apartamento de alto padrão com 4 suítes, sala de estar e jantar, lavabo, varanda integrada e 3 vagas. Lazer completo.',
        'Apartamento',
        'sale',
        1800000.00,
        220,
        4,
        5,
        3,
        'Av. Eng. Luís Carlos Berrini, 1500',
        'Brooklin',
        'São Paulo',
        'available',
        '[]',
        NOW()
    ),
    (
        'Kitnet Mobiliada Centro',
        'Kitnet mobiliada e equipada, ideal para estudantes ou profissionais. Próximo ao metrô República e universidades.',
        'Kitnet',
        'rent',
        1800.00,
        28,
        1,
        1,
        0,
        'Rua Barão de Itapetininga, 345',
        'Centro',
        'São Paulo',
        'available',
        '[]',
        NOW()
    )";
    
    $conn->exec($propertiesSQL);
    echo "✓ 10 imóveis inseridos com sucesso!\n\n";
    
    // Count totals
    $clientCount = $conn->query("SELECT COUNT(*) FROM clients")->fetchColumn();
    $propertyCount = $conn->query("SELECT COUNT(*) FROM properties")->fetchColumn();
    
    echo "========================================\n";
    echo "RESUMO:\n";
    echo "========================================\n";
    echo "Total de clientes no banco: $clientCount\n";
    echo "Total de imóveis no banco: $propertyCount\n";
    echo "========================================\n\n";
    echo "✅ Dados inseridos com sucesso!\n";
    echo "Acesse http://localhost:8000 para ver o site público com os imóveis.\n";
    
} catch(PDOException $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
