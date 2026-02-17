CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(255) NOT NULL UNIQUE,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO pages (slug, title, content) VALUES
('termos-de-uso', 'Termos de Uso', '<h2>1. Termos</h2><p>Ao acessar ao site <a href="/">Correta Pro</a>, concorda em cumprir estes termos de serviço, todas as leis e regulamentos aplicáveis...</p>'),
('politica-de-privacidade', 'Política de Privacidade', '<h2>Política de Privacidade</h2><p>A sua privacidade é importante para nós. É política do Correta Pro respeitar a sua privacidade em relação a qualquer informação sua que possamos coletar no site <a href="/">Correta Pro</a>, e outros sites que possuímos e operamos.</p>'),
('cookies', 'Política de Cookies', '<h2>O que são cookies?</h2><p>Como é prática comum em quase todos os sites profissionais, este site usa cookies, que são pequenos arquivos baixados no seu computador, para melhorar sua experiência.</p>')
ON DUPLICATE KEY UPDATE title = VALUES(title);
