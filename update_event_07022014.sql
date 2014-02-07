ALTER TABLE `fitzos`.`event` 
CHANGE COLUMN `image` `image` VARCHAR(256) NULL DEFAULT NULL ,
ADD COLUMN `time` VARCHAR(45) NULL AFTER `team_id`,
ADD COLUMN `member_id` INT(11) NULL AFTER `time`,
ADD COLUMN `location` VARCHAR(245) NULL AFTER `member_id`;