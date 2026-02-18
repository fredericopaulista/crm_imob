-- Create lead_origins table
CREATE TABLE IF NOT EXISTS lead_origins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed default origins
INSERT INTO lead_origins (name) VALUES
('Site'),
('Google'),
('Facebook'),
('Instagram'),
('Indicação'),
('Portal Imobiliário'),
('WhatsApp'),
('Outros');

-- Add origin_id to clients table
ALTER TABLE clients ADD COLUMN origin_id INT DEFAULT NULL AFTER origin;
ALTER TABLE clients ADD CONSTRAINT fk_client_origin FOREIGN KEY (origin_id) REFERENCES lead_origins(id) ON DELETE SET NULL;

-- Migrate existing data (Best effort matching)
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Site') WHERE origin LIKE '%Site%' OR origin LIKE '%site%';
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Google') WHERE origin LIKE '%Google%' OR origin LIKE '%google%';
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Facebook') WHERE origin LIKE '%Facebook%' OR origin LIKE '%facebook%';
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Instagram') WHERE origin LIKE '%Instagram%' OR origin LIKE '%instagram%';
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Indicação') WHERE origin LIKE '%Indicação%' OR origin LIKE '%Indicacao%' OR origin LIKE '%indicação%';
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'WhatsApp') WHERE origin LIKE '%WhatsApp%' OR origin LIKE '%whatsapp%' OR origin LIKE '%Zap%';

-- Mark others as 'Outros' if they have an origin but no match, or leave null if empty
UPDATE clients SET origin_id = (SELECT id FROM lead_origins WHERE name = 'Outros') WHERE type='lead' AND origin_id IS NULL AND origin IS NOT NULL AND origin != '';
