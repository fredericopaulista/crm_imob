-- Fix UTF-8 encoding issues in clients table
UPDATE clients SET name = 'João Silva' WHERE name LIKE '%Jo%o Silva%';
UPDATE clients SET name = 'Juliana Almeida' WHERE name LIKE '%Juliana%';

-- Fix any other common encoding issues in clients
UPDATE clients SET name = REPLACE(name, 'Ã£o', 'ão');
UPDATE clients SET name = REPLACE(name, 'Ã§Ã£o', 'ção');
UPDATE clients SET name = REPLACE(name, 'Ã¡', 'á');
UPDATE clients SET name = REPLACE(name, 'Ã©', 'é');
UPDATE clients SET name = REPLACE(name, 'Ã­', 'í');
UPDATE clients SET name = REPLACE(name, 'Ã³', 'ó');
UPDATE clients SET name = REPLACE(name, 'Ãº', 'ú');
UPDATE clients SET name = REPLACE(name, 'Ã¢', 'â');
UPDATE clients SET name = REPLACE(name, 'Ãª', 'ê');
UPDATE clients SET name = REPLACE(name, 'Ã´', 'ô');

-- Fix property types if needed
UPDATE properties SET type = REPLACE(type, 'Ã©', 'é');
UPDATE properties SET type = REPLACE(type, 'Ã¡', 'á');
UPDATE properties SET type = REPLACE(type, 'Ã³', 'ó');

-- Fix neighborhoods
UPDATE properties SET neighborhood = REPLACE(neighborhood, 'Ã©', 'é');
UPDATE properties SET neighborhood = REPLACE(neighborhood, 'Ã¡', 'á');
UPDATE properties SET neighborhood = REPLACE(neighborhood, 'Ã³', 'ó');
UPDATE properties SET neighborhood = REPLACE(neighborhood, 'Ã­', 'í');
