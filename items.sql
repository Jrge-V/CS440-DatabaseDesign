CREATE TABLE items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    username VARCHAR(255) NOT NULL,
    post_date DATE DEFAULT CURRENT_DATE
);