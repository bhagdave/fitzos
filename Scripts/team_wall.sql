CREATE  TABLE `fitzos`.`team_wall` (
  `id` INT NOT NULL ,
  `team_id` INT NULL ,
  `message` TEXT NULL ,
  `image` VARCHAR(245) NULL ,
  `date` TIMESTAMP NULL ,
  PRIMARY KEY (`id`) );