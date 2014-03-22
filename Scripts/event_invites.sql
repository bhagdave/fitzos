CREATE TABLE `fitzos`.`event_invites` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `event_id` INT NULL,
  `member_id` INT NULL,
  `status` ENUM('invited','declined','accepted') NULL,
  `invite_sent` TIMESTAMP NULL,
  PRIMARY KEY (`id`));
