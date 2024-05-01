CREATE TABLE IF NOT EXISTS `estate` (
    `id` INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(255) NOT NULL,
    `summary` TEXT,
    `type` VARCHAR(20) NOT NULL,
    `price` INT(10) NOT NULL,
    `currency` CHAR(3) NOT NULL
);

INSERT INTO `estate` (`title`, `summary`, `type`, `price`, `currency`)
VALUES
("Cottage number One", "This is the best cottage", "cottage", 500000, "RUB"),
("Room of hostel", "Let receive this room", "room", 300000, "RUB"),
("Daily Flat", "Flat for one day", "flat", 250000, "RUB"),
("Pavilion for barbeque", "", "Nice choice", 50000, "RUB"),
("Big house of countryside", "Just look at this miracle", "house", 200000, "RUB"),
("Cottage number Two", "Cottage of two stars", "cottage", 350000, "RUB"),
("Pavilion on the river bank", "Enjoy the wonderful atmosphere and views", "pavilion", 75000, "RUB"),
("Garage for only big cars", "Trucks are welcome", "garage", 1500000, "RUB"),
("Flat on the second floor", "Come here alone", "flat", 750000, "RUB"),
("House for your family", "Spend time with the whole family together", "house", 420000, "RUB");
