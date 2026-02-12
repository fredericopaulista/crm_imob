<?php
require_once 'config.php';
require_once 'db.php';
require_once 'models/Client.php';
require_once 'models/Property.php';

// Increase execution time
set_time_limit(300);

echo "<h1>🌱 Seeding Imóveis e Proprietários</h1>";
echo "<pre>";

$clientModel = new Client();
$propertyModel = new Property();

// 1. Check for existing owners
$owners = $clientModel->getOwners();

if (count($owners) < 5) {
    echo "⚠️ Poucos proprietários encontrados (" . count($owners) . "). Criando mais 10 proprietários...\n";
    
    $firstNames = ['João', 'Maria', 'Pedro', 'Ana', 'Carlos', 'Fernanda', 'Luiz', 'Beatriz', 'Ricardo', 'Juliana'];
    $lastNames = ['Silva', 'Santos', 'Oliveira', 'Souza', 'Rodrigues', 'Ferreira', 'Almeida', 'Costa', 'Gomes', 'Martins'];
    
    for ($i = 0; $i < 10; $i++) {
        $name = $firstNames[array_rand($firstNames)] . ' ' . $lastNames[array_rand($lastNames)];
        $email = strtolower(str_replace(' ', '.', $name)) . rand(100, 999) . '@email.com';
        
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => '(11) 9' . rand(1000, 9999) . '-' . rand(1000, 9999),
            'type' => 'owner',
            'origin' => 'indication',
            'status' => 'contacted',
            'notes' => 'Gerado automaticamente pelo seeder.'
        ];
        
        if ($clientModel->create($data)) {
            echo "✅ Criado proprietário: $name\n";
        }
    }
    
    // Refresh owners list
    $owners = $clientModel->getOwners();
}

$ownerIds = array_column($owners, 'id');
echo "📋 Total de proprietários disponíveis: " . count($ownerIds) . "\n\n";

// 2. Generate 20 Properties
echo "🚀 Iniciando criação de 20 imóveis...\n";

$types = ['Casa', 'Apartamento', 'Terreno', 'Comercial'];
$purposes = ['sale', 'rent'];
$neighborhoods = ['Jardins', 'Pinheiros', 'Vila Madalena', 'Itaim Bibi', 'Moema', 'Brooklin', 'Perdizes', 'Pompeia', 'Vila Mariana', 'Higienópolis'];

for ($i = 1; $i <= 20; $i++) {
    $type = $types[array_rand($types)];
    $purpose = $purposes[array_rand($purposes)];
    $neighborhood = $neighborhoods[array_rand($neighborhoods)];
    $bedrooms = rand(1, 5);
    $area = rand(40, 500);
    
    $title = "$type com $bedrooms quartos em $neighborhood";
    if ($type == 'Terreno') $title = "Terreno de {$area}m² em $neighborhood";
    if ($type == 'Comercial') $title = "Conjunto Comercial em $neighborhood";
    
    $price = ($purpose == 'sale') ? rand(300000, 5000000) : rand(1500, 15000);
    
    $ownerId = $ownerIds[array_rand($ownerIds)];
    
    $data = [
        'title' => $title,
        'type' => $type,
        'purpose' => $purpose,
        'price' => $price,
        'address' => "Rua Exemplo, " . rand(100, 3000),
        'neighborhood' => $neighborhood,
        'city' => 'São Paulo',
        'area' => $area,
        'bedrooms' => $bedrooms,
        'bathrooms' => rand(1, 4),
        'garages' => rand(0, 4),
        'description' => "Excelente oportunidade de $type para " . ($purpose == 'sale' ? 'venda' : 'locação') . ". Localização privilegiada em $neighborhood. Agende sua visita!",
        'status' => 'available',
        'owner_id' => $ownerId,
        'images' => '[]'
    ];
    
    if ($propertyModel->create($data)) {
        echo "✅ Imóvel #$i criado: $title (Proprietário ID: $ownerId)\n";
    } else {
        echo "❌ Erro ao criar imóvel #$i\n";
    }
}

echo "\n✨ Concluído! 20 imóveis gerados e vinculados a proprietários.\n";
echo "</pre>";
