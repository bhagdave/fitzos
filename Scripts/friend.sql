CREATE TABLE `fitzos`.`friend` (
  `friend_id` INT NOT NULL,
  `member_id_requested` INT NULL,
  `member_id_requestee` INT NULL,
  `status` ENUM('requested','rejected','accepted','closed') NULL,
  `requested` TIMESTAMP NULL,
  `accepted` TIMESTAMP NULL,
  PRIMARY KEY (`friend_id`));
