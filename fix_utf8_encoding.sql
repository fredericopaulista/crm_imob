-- Fix UTF-8 encoding issues in property titles
UPDATE properties SET title = 'Casa Térrea com Quintal em Pinheiros' WHERE id = 2;
UPDATE properties SET title = 'Sobrado em Condomínio Fechado' WHERE id = 5;
UPDATE properties SET title = 'Apartamento Alto Padrão na Berrini' WHERE id = 9;

-- Fix descriptions if needed
UPDATE properties SET description = REPLACE(description, 'TÃ©rrea', 'Térrea');
UPDATE properties SET description = REPLACE(description, 'CondomÃ­nio', 'Condomínio');
UPDATE properties SET description = REPLACE(description, 'SuÃ­te', 'Suíte');
UPDATE properties SET description = REPLACE(description, 'LocalizaÃ§Ã£o', 'Localização');
UPDATE properties SET description = REPLACE(description, 'prÃ³ximo', 'próximo');
UPDATE properties SET description = REPLACE(description, 'metrÃ´', 'metrô');
UPDATE properties SET description = REPLACE(description, 'dormitÃ³rios', 'dormitórios');
UPDATE properties SET description = REPLACE(description, 'Ã¡rea', 'área');
UPDATE properties SET description = REPLACE(description, 'espaÃ§osa', 'espaçosa');
UPDATE properties SET description = REPLACE(description, 'prÃ¡tica', 'prática');
UPDATE properties SET description = REPLACE(description, 'Ã³tima', 'ótima');
UPDATE properties SET description = REPLACE(description, 'padrÃ£o', 'padrão');
UPDATE properties SET description = REPLACE(description, 'regiÃ£o', 'região');
