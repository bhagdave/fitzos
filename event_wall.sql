CREATE TABLE `event_wall` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `message` text,
  `image` varchar(245) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `deleted` enum('yes','no') DEFAULT 'no',
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
