CREATE TABLE IF NOT EXISTS `estate` (
    `id` INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `summary` TEXT,
    `type` VARCHAR(20) NOT NULL,
    `price` INT(10) NOT NULL,
    `currency` CHAR(3) NOT NULL
);
