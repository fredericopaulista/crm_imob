-- Add indexes for better performance on client filtering
ALTER TABLE clients ADD INDEX idx_type (type);
ALTER TABLE clients ADD INDEX idx_status (status);

-- Update type enum to include 'lead' if not present
ALTER TABLE clients MODIFY COLUMN type enum('lead','buyer','tenant','owner','investor') NOT NULL DEFAULT 'buyer';
