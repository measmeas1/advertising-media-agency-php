CREATE TABLE product_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    duration VARCHAR(100),
    platform VARCHAR(100),
    target_audience VARCHAR(255),
    service_includes TEXT,
    requirements TEXT,
    delivery_time VARCHAR(100),
    revisions INT DEFAULT 0,
    notes TEXT,
    image_url VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id)
        ON DELETE CASCADE
);