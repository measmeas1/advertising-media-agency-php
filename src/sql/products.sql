CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE CASCADE
);

INSERT INTO products (category_id, title, price, description) VALUES
(1, 'Facebook Ads Campaign', 150.00, 'Full management of Facebook ads to grow your page and leads.'),
(1, 'Instagram Ads Campaign', 180.00, 'Creative ads + targeting for Instagram to increase sales.'),
(2, 'Product Photography', 120.00, 'Professional product photos for e-commerce and social media.'),
(2, 'Video Editing Package', 200.00, 'Edit your raw video into a high quality promotional video.'),
(3, 'Brand Identity Package', 250.00, 'Logo, color palette, typography, and brand guideline.'),
(4, 'SEO & Google Ads Package', 300.00, 'SEO + Google ads management to increase website traffic.'),
(5, 'Commercial Video Production', 500.00, 'Full video production for TV or online ads.'),
(6, 'Event PR & Coverage', 220.00, 'Event coverage, press release, and media outreach.');
