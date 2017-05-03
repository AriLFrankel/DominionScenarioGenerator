CREATE DATABASE IF NOT EXISTS `dominion_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dominion_db`;

CREATE TABLE  `savored_games` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR (100) NOT NULL,
    `date_played` DATE NOT NULL,
    `game_length` INT( 11 ) NOT NULL,
    `winner` VARCHAR ( 200 ) DEFAULT NULL,
    `commentary` VARCHAR( 2000 ) DEFAULT NULL,
    `game_cards` VARCHAR(1000) NOT NULL
) ENGINE = INNODB;

CREATE TABLE  `cards` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `set` VARCHAR (100) NOT NULL,
    `name` VARCHAR (100) NOT NULL,
    `price` INT( 11 ) NOT NULL,
    `draw` INT( 11 ) DEFAULT NULL,
    `action` INT( 11 ) DEFAULT NULL,
    `attack` INT( 11 ) DEFAULT NULL,
    `buy` INT( 11 ) DEFAULT NULL,
    `money` INT( 11 ) DEFAULT NULL,
    `interaction` INT( 11 ) DEFAULT NULL
) ENGINE = INNODB;