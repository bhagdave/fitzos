CREATE TABLE `trainers_preference` (
  `trainer_id` int(11) NOT NULL,
  `preference_id` int(11) NOT NULL,
  PRIMARY KEY (`trainer_id`,`preference_id`)
) ENGINE=InnoDB
