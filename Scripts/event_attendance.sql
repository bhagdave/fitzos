CREATE TABLE `fitzos`.`event_attendance` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NULL,
  `member_id` INT NULL,
  `paid` ENUM('YES','NO') NULL,
  `cancelled` ENUM('YES','NO') NULL,
  PRIMARY KEY (`id`));
