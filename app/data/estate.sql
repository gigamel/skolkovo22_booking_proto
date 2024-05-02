DROP TABLE IF EXISTS `estate`;

CREATE TABLE `estate` (
    `id` INT(4) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `summary` TEXT,
    `type` VARCHAR(20) NOT NULL,
    `price` INT(10) NOT NULL,
    `currency` CHAR(3) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `estate` (`id`, `title`, `summary`, `type`, `price`, `currency`)
VALUES
(1,"Cottage number One", "This is the best cottage", "cottage", 500000, "RUB"),
(2,"Room of hostel", "Let receive this room", "room", 300000, "RUB"),
(3,"Daily Flat", "Flat for one day", "flat", 250000, "RUB"),
(4,"Pavilion for barbeque", "", "Nice choice", 50000, "RUB"),
(5,"Big house of countryside", "Just look at this miracle", "house", 200000, "RUB"),
(6,"Cottage number Two", "Cottage of two stars", "cottage", 350000, "RUB"),
(7,"Pavilion on the river bank", "Enjoy the wonderful atmosphere and views", "pavilion", 75000, "RUB"),
(8,"Garage for only big cars", "Trucks are welcome", "garage", 1500000, "RUB"),
(9,"Flat on the second floor", "Come here alone", "flat", 750000, "RUB"),
(10,"House for your family", "Spend time with the whole family together", "house", 420000, "RUB");

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
    `id` INT(6) NOT NULL AUTO_INCREMENT,
    `source` VARCHAR(255) NOT NULL,
    `alt` VARCHAR(32) DEFAULT "",
    `mime_type` VARCHAR(15) NOT NULL,
    `entity_type` VARCHAR(20) NOT NULL,
    `entity_id` INT(4) NOT NULL,
    PRIMARY KEY (`id`)
);

INSERT INTO `file` (`source`, `mime_type`, `entity_type`, `entity_id`)
VALUES
("upload/house_1.jpg", "image/jpg", "estate", 5),
("upload/cottage_1.jpg", "image/jpg", "estate", 1),
("upload/pavilion_1.jpeg", "image/jpeg", "estate", 7);
