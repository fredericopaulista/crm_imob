# Documento de Requisitos do Produto (PRD) - CRM Imobiliário

## 1. Visão Geral do Projeto
O **CRM Imobiliário** é uma aplicação web desenvolvida para gerenciar as operações de uma imobiliária, focando na gestão de imóveis, clientes, propostas e marketing via WhatsApp. O sistema oferece um painel administrativo para corretores e gestores, além de um site público para exibição do catálogo de imóveis.

## 2. Tecnologias Utilizadas
- **Backend:** PHP (Custom MVC Framework)
- **Banco de Dados:** MySQL/MariaDB
- **Frontend:** HTML, CSS, JavaScript (provavelmente com bibliotecas auxiliares)
- **Infraestrutura:** Servidor Web (Apache/Nginx)

## 3. Atores e Permissões
O sistema possui controle de acesso baseado em funções (Role-Based Access Control - RBAC).

### 3.1 Funções (Roles)
- **Admin**: Acesso total ao sistema.
- **Corretor (Agent)**: Acesso restrito focado em vendas e gestão de seus próprios clientes.

### 3.2 Permissões
- Ver Dashboard
- Gerenciar Imóveis
- Gerenciar Clientes
- Gerenciar Propostas
- Acessar Chat
- Gerenciar Usuários
- Gerenciar Perfis/Funções
- Configurações do Sistema
- Gerenciar Marketing (adicional identificada no código)

## 4. Funcionalidades (Requisitos Funcionais)

### 4.1 Gestão de Imóveis (Properties)
- **Cadastro Completo:** Título, tipo, finalidade (venda/aluguel), preço, endereço, bairro, cidade, características (área, quartos, banheiros, garagens).
- **Galeria de Imagens:** Upload e armazenamento de múltiplas imagens (armazenadas como JSON).
- **Status:** Disponível, Reservado, Vendido, Alugado.
- **Listagem e Filtros:** Busca avançada no painel administrativo.

### 4.2 Gestão de Clientes (Clients)
- **Cadastro:** Nome, email, telefone, tipo (comprador, inquilino, proprietário, investidor), origem, status (novo, contactado, negociação, etc.).
- **Etiquetas (Tags):** Classificação de clientes para segmentação.
- **Histórico:** Registro de observações e interações.

### 4.3 Gestão de Propostas (Proposals)
- **Registro:** Vinculação entre cliente e imóvel.
- **Valores:** Valor da proposta e comissão.
- **Workflow:** Status (enviada, negociação, aprovada, rejeitada).

### 4.4 Módulo de Marketing e WhatsApp
- **Integração WhatsApp:** Envio e recebimento de mensagens.
- **Chat:** Interface para atendimento em tempo real (ChatController).
- **Campanhas (Broadcast):** Disparo de mensagens em massa para clientes filtrados por etiquetas.
- **Configurações de Envio:** Definição de horário comercial para disparos automáticos.
- **Importação de Leads:** Importação de contatos via arquivo CSV, com detecção de duplicidade e atribuição de etiquetas.

### 4.5 Site Público
- **Home:** Destaque para imóveis recentes.
- **Catálogo:** Listagem completa com filtros por cidade, bairro, tipo, status e busca textual.
- **Detalhes do Imóvel:** Página dedicada com todas as informações e galeria de fotos.
- **Contato:** Formulário para captação de leads.

### 4.6 Administração e Configurações
- **Gestão de Usuários:** Criação e edição de usuários do sistema.
- **Controle de Acesso:** Gestão de papéis e permissões.
- **Configurações Gerais:** Parametrização do sistema (ex: chaves de API).

## 5. Estrutura de Dados (Resumo)
O banco de dados é relacional e inclui as principais tabelas:
- `users`, `roles`, `permissions`, `role_permissions` (Auth)
- `clients`, `properties`, `proposals` (Core Business)
- `whatsapp_settings`, `conversations`, `messages`, `message_logs` (Chat)
- `settings` (System Config)

## 6. Observações Técnicas
- O sistema utiliza um padrão MVC próprio, sem frameworks de mercado como Laravel ou Symfony.
- A autenticação e sessões são gerenciadas nativamente (`$_SESSION`).
- Há scripts auxiliares para migração e seeds (`seed.php`, `schema.sql`).
- Existe uma estrutura de Webhook para receber atualizações do WhatsApp.

## 7. Futuras Melhorias (Sugestões)
- Implementar recuperação de senha.
- Adicionar relatórios gerenciais e gráficos no Dashboard.
- Melhorar a validação de dados na importação CSV.
- Implementar fila (Queues) para envio de broadcasts para evitar timeout.
