ALTER TABLE `fitzos`.`trainer` 
ADD COLUMN `age` INT NULL AFTER `member_id`,
ADD COLUMN `gender` ENUM('male','female') NULL AFTER `age`,
ADD COLUMN `location` VARCHAR(45) NULL AFTER `gender`,
ADD COLUMN `bio` VARCHAR(255) NULL AFTER `location`;
