CREATE TABLE reviews (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(11) NOT NULL,
    username VARCHAR(255) NOT NULL,
    rating ENUM('excellent', 'good', 'fair', 'poor') NOT NULL,
    review TEXT NOT NULL,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
