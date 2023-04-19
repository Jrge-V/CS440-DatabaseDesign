CREATE TABLE favorited (
    username VARCHAR(15) NOT NULL,
    favorited_username VARCHAR(15) NOT NULL
);


INSERT INTO `favorited` VALUES
('Amanda', 'Gary'),
('Gary', 'Neil'),
('Neil', 'Rick'),
('Rick', 'Joe'),
('Joe', 'Amanda'),
('Gary', 'Amanda');


