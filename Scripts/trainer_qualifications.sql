CREATE  TABLE `trainer_qualifications` (  `trainer_id` INT NOT NULL ,  `certificate_id` INT NOT NULL ,  `date` VARCHAR(45) NULL ,  `validated` ENUM('yes','no') NULL , `number` VARCHAR(145) NULL , PRIMARY KEY (`trainer_id`, `certificate_id`) );