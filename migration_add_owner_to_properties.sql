-- Add owner_id to properties table to associate properties with owners
ALTER TABLE properties ADD COLUMN owner_id INT NULL;
ALTER TABLE properties ADD CONSTRAINT fk_property_owner FOREIGN KEY (owner_id) REFERENCES clients(id) ON DELETE SET NULL;
ALTER TABLE properties ADD INDEX idx_owner_id (owner_id);
