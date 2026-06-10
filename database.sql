CREATE TABLE tickets (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    concert_name VARCHAR(255) NOT NULL,
    ticket_code VARCHAR(255) UNIQUE NOT NULL, 
    is_used BOOLEAN DEFAULT FALSE,             
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transactions (
    id SERIAL PRIMARY KEY,
    order_id VARCHAR(100) UNIQUE NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',     
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
