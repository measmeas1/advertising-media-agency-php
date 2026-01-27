CREATE TABLE product_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    duration VARCHAR(100),
    platform VARCHAR(100),
    target_audience VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
);


INSERT INTO product_details (product_id, duration, platform, target_audience) VALUES
(1, '1 Month', 'Facebook', 'Local Businesses, SMEs'),
(2, '1 Month', 'Instagram', 'Fashion, Beauty, Retail'),
(3, '1 Month', 'Photography', 'E-commerce Sellers'),
(4, '1 Month', 'Video Editing', 'Content Creators, YouTubers'),
(5, '2 Months', 'Brand Identity', 'Startups, Small Businesses'),
(6, '1 Month', 'Google Ads + SEO', 'Online Stores, Service Businesses'),
(7, '2 Months', 'Video Production', 'Corporate, Brands'),
(8, '1 Month', 'PR & Events', 'Event Organizers, Brands');
