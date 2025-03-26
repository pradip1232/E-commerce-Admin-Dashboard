CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(16) NOT NULL,
    product_sku VARCHAR(14) NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_category VARCHAR(255) NOT NULL,
    hsn_number VARCHAR(50) NOT NULL,
    tax_rate DECIMAL(5,2) NOT NULL,
    key_benefits TEXT NOT NULL,
    description TEXT NOT NULL,
    product_benefits TEXT NOT NULL,
    product_usage TEXT NOT NULL,
    images TEXT,
    videos TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);