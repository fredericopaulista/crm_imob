-- Create lead_stages table
CREATE TABLE IF NOT EXISTS lead_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    order_index INT NOT NULL DEFAULT 0,
    color VARCHAR(7) DEFAULT '#3B82F6', -- Default blue
    is_system TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed default stages
INSERT INTO lead_stages (name, order_index, color, is_system) VALUES
('Novo', 0, '#3B82F6', 1), -- Blue
('Em Atendimento', 1, '#F59E0B', 1), -- Amber/Orange
('Visita Agendada', 2, '#8B5CF6', 1), -- Purple
('Proposta', 3, '#10B981', 1), -- Emerald/Green
('Fechado', 4, '#ef4444', 1); -- Green

-- Add stage_id to clients table
-- Check if column exists first to avoid errors on re-run (MySQL 8.0+ supports IF NOT EXISTS in ADD COLUMN, but for compatibility we use a procedure or just try-catch in PHP, but here simple ALTER is usually fine if we handle errors in PHP or use a block)

ALTER TABLE clients ADD COLUMN stage_id INT DEFAULT NULL AFTER status;
ALTER TABLE clients ADD CONSTRAINT fk_client_stage FOREIGN KEY (stage_id) REFERENCES lead_stages(id) ON DELETE SET NULL;

-- Migrate existing data
UPDATE clients SET stage_id = (SELECT id FROM lead_stages WHERE name = 'Novo') WHERE type = 'lead' AND (status = 'new' OR status IS NULL);
UPDATE clients SET stage_id = (SELECT id FROM lead_stages WHERE name = 'Em Atendimento') WHERE type = 'lead' AND status = 'contacted';
UPDATE clients SET stage_id = (SELECT id FROM lead_stages WHERE name = 'Novo') WHERE type = 'lead' AND stage_id IS NULL; -- Fallback for others
