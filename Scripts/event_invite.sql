CREATE  TABLE `fitzos`.`event_invite` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `member_id` INT NULL ,
  `event_id` INT NULL ,
  `sent` TIMESTAMP NULL ,
  `accepted` ENUM('YES','NO') NULL ,
  PRIMARY KEY (`id`) );

