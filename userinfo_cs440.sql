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
  `email` varchar(60) DEFAULT NULL UNIQUE
);

INSERT INTO `user` VALUES ('Amanda','admin','Amanda', 'White', 'AmandaWhite@email.com'),
('Gary','admin','Gary', 'Blue', 'GaryBlue@email.com'),
('Joe','admin','Joe', 'Red', 'JoeRed@email.com');