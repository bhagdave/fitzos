CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `session_name` varchar(45) DEFAULT NULL,
  `session_key` varchar(95) DEFAULT NULL,
  `session_user_id` int(11) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
