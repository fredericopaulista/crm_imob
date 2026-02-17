<?php
require_once 'config.php';
require_once 'db.php';
require_once 'models/Post.php';

// Ensure upload directory exists
$uploadDir = 'assets/uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// 6 Articles Data
$articles = [
    [
        'title' => 'Tendências do Mercado Imobiliário em 2026',
        'slug' => 'tendencias-mercado-imobiliario-2026',
        'excerpt' => 'Descubra o que esperar do setor de imóveis para o próximo ano. Tecnologia, sustentabilidade e novas formas de morar estão em alta.',
        'content' => '<p>O mercado imobiliário está em constante evolução. Em 2026, observamos uma forte tendência para imóveis sustentáveis e integrados com tecnologia smart home.</p><p>Além disso, a busca por espaços flexíveis, que permitam o trabalho remoto (home office) com conforto, continua sendo uma prioridade para muitos compradores.</p><h3>Sustentabilidade em Foco</h3><p>Empreendimentos com painéis solares, reuso de água e certificações verdes estão se valorizando cada vez mais. Não é apenas sobre economia, mas sobre consciência ambiental.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_trends_2026.jpg'
    ],
    [
        'title' => 'Como Financiar seu Primeiro Imóvel',
        'slug' => 'como-financiar-primeiro-imovel',
        'excerpt' => 'Um guia completo para quem deseja sair do aluguel. Entenda as taxas, documentos e melhores bancos para financiamento.',
        'content' => '<p>Comprar o primeiro imóvel é um sonho para muitos brasileiros. No entanto, o processo de financiamento pode parecer complexo.</p><p>O primeiro passo é organizar suas finanças. É importante ter uma reserva para a entrada (geralmente 20% do valor do imóvel) e para os custos adicionais de documentação (ITBI e Registro).</p><h3>Escolhendo o Banco</h3><p>Pesquise as taxas de juros em diferentes instituições. Pequenas diferenças na taxa podem representar uma grande economia ao longo de 30 anos.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_finance.jpg'
    ],
    [
        'title' => 'Dicas para Valorizar seu Imóvel antes da Venda',
        'slug' => 'dicas-valorizar-imovel-venda',
        'excerpt' => 'Pequenas reformas e cuidados podem aumentar significativamente o valor de avaliação da sua casa ou apartamento.',
        'content' => '<p>Quer vender seu imóvel mais rápido e por um preço melhor? A primeira impressão é a que fica.</p><p>Invista em uma pintura nova, de preferência com cores neutras. Isso ajuda o comprador a visualizar seus próprios móveis no espaço.</p><h3>Manutenção em Dia</h3><p>Conserte torneiras pingando, maçanetas soltas e lâmpadas queimadas. Esses pequenos detalhes passam a sensação de um imóvel bem cuidado.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_renovation.jpg'
    ],
    [
        'title' => 'Casa ou Apartamento: Qual a Melhor Escolha?',
        'slug' => 'casa-ou-apartamento-melhor-escolha',
        'excerpt' => 'Segurança, espaço, lazer e custos. Analisamos os prós e contras de cada opção para ajudar você a decidir.',
        'content' => '<p>Essa é uma dúvida clássica. A resposta depende muito do seu estilo de vida e do momento familiar.</p><h3>Vantagens da Casa</h3><p>Geralmente oferece mais espaço, privacidade e liberdade. Ideal para quem tem animais de estimação grandes ou gosta de jardim.</p><h3>Vantagens do Apartamento</h3><p>Maior segurança, áreas de lazer completas e menos preocupação com manutenção externa. Ideal para quem viaja muito ou busca praticidade.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1493809842364-78817add7ffb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_house_apt.jpg'
    ],
    [
        'title' => 'Os Melhores Bairros de São Paulo para se Viver',
        'slug' => 'melhores-bairros-sao-paulo',
        'excerpt' => 'Conheça as regiões com maior qualidade de vida, segurança e infraestrutura na capital paulista.',
        'content' => '<p>São Paulo é uma cidade de contrastes e muitas opções. Mas alguns bairros se destacam pela qualidade de vida.</p><p><strong>Vila Madalena:</strong> Para quem busca vida noturna, cultura e arte.</p><p><strong>Moema:</strong> Excelente infraestrutura, próximo ao Parque Ibirapuera e aeroporto.</p><p><strong>Tatuapé:</strong> Um dos bairros que mais cresce na Zona Leste, com ótimos restaurantes e shoppings.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1578002171601-902a5a772520?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_sp.jpg'
    ],
    [
        'title' => 'Documentação para Compra e Venda de Imóveis',
        'slug' => 'documentacao-compra-venda-imoveis',
        'excerpt' => 'Evite dores de cabeça burocráticas. Confira o checklist de documentos essenciais para fechar negócio com segurança.',
        'content' => '<p>A parte burocrática é a mais chata, mas a mais importante da transação imobiliária. A falta de um documento pode anular a venda.</p><h3>Do Vendedor</h3><p>Matrícula atualizada do imóvel, certidões negativas de débitos (municipais, estaduais e federais) e documentos pessoais.</p><h3>Do Comprador</h3><p>RG, CPF, comprovante de residência e renda (para financiamento). Consultar um advogado especialista é sempre recomendado.</p>',
        'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'image_name' => 'blog_docs.jpg'
    ]
];

$postModel = new Post();
$count = 0;

echo "Iniciando criação de posts...\n";

foreach ($articles as $article) {
    // 1. Download Image
    $imagePath = $uploadDir . $article['image_name'];
    if (!file_exists($imagePath)) {
        echo "Baixando imagem para: " . $article['title'] . "...\n";
        $imageData = file_get_contents($article['image_url']);
        if ($imageData) {
            file_put_contents($imagePath, $imageData);
        } else {
            echo "Erro ao baixar imagem. Usando placeholder.\n";
            // Create a simple placeholder if download fails? Or just skip
        }
    }

    // 2. Check if post exists
    if ($postModel->findBySlug($article['slug'])) {
        echo "Post já existe: " . $article['title'] . "\n";
        continue;
    }

    // 3. Create Post
    $data = [
        'title' => $article['title'],
        'slug' => $article['slug'],
        'content' => $article['content'],
        'excerpt' => $article['excerpt'],
        'image' => $article['image_name'],
        'status' => 'published',
        'author_id' => 1 // Assuming Admin ID 1
    ];

    if ($postModel->create($data)) {
        echo "Post criado: " . $article['title'] . "\n";
        $count++;
    } else {
        echo "Erro ao criar post: " . $article['title'] . "\n";
    }
}

echo "Sucesso! $count posts criados.\n";
