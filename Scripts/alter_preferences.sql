ALTER TABLE `fitzos`.`trainer_preferences` 
CHANGE COLUMN `id` `trainer_id` INT(11) NOT NULL AUTO_INCREMENT ,
ADD COLUMN `value` VARCHAR(45) NULL AFTER `preference`;
