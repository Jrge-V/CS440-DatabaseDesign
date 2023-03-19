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