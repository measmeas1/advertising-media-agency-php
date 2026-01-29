CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status ENUM('active','inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name, status) VALUES
('Social Media Marketing', 'active'),
('Content Creation', 'active'),
('Brand Strategy', 'active'),
('Digital Marketing', 'active'),
('Video Production', 'active'),
('PR & Events', 'active');
