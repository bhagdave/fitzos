CREATE TABLE `fitzos`.`team_sports` (
  `team_id` INT NOT NULL,
  `sport_id` INT NOT NULL,
  `fromdate` DATETIME NULL,
  `todate` DATETIME NULL,
  PRIMARY KEY (`team_id`, `sport_id`));
