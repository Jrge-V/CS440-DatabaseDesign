/* Add this info into phpMyAdmin in the sql tab*/
DROP DATABASE IF EXISTS `userinfo_cs440`;
CREATE DATABASE `userinfo_cs440`;
USE `userinfo_cs440`;  
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(15)  PRIMARY KEY NOT NULL,
  `password` varchar(50)  DEFAULT NULL,
  `firstName` varchar(30) DEFAULT NULL,
  `lastName` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL UNIQUE
);

INSERT INTO `user` VALUES
('Amanda','amanda70','Amanda', 'White', 'AmandaWhite@email.com'),
('Gary','gary80','Gary', 'Blue', 'GaryBlue@email.com'),
('Neil','neil90','Neil', 'Green', 'NeilGreen@email.com'),
('Rick','rick00','Rick', 'Black', 'RickBlack@email.com'),
('Joe','joe10','Joe', 'Red', 'JoeRed@email.com');

/*for items */
DROP TABLE IF EXISTS `items`;
CREATE TABLE items (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(255) NOT NULL,
    price FLOAT NOT NULL,
    username VARCHAR(255) NOT NULL,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


/*for reviews */
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE reviews (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    item_id INT(11) NOT NULL,
    username VARCHAR(255) NOT NULL,
    rating ENUM('excellent', 'good', 'fair', 'poor') NOT NULL,
    review TEXT NOT NULL,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
