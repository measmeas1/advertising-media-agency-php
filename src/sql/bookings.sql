CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    user_id INT NOT NULL,
    code VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    message TEXT,
    payment_status ENUM('Pending','Paid','Partial','Cancelled') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

ALTER TABLE bookings
DROP COLUMN status;
ADD COLUMN user_id INT NOT NULL AFTER product_id,
ADD COLUMN code VARCHAR(255) NOT NULL AFTER user_id,
ADD COLUMN name VARCHAR(255) NOT NULL AFTER code,
ADD COLUMN email VARCHAR(255) NOT NULL AFTER name,
ADD COLUMN payment_status ENUM('Pending','Paid','Partial','Cancelled') 
    DEFAULT 'Pending' AFTER message;
ADD FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;