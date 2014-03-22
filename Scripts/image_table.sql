CREATE TABLE `image` (
  `image_id` int(11) NOT NULL auto_increment,
  `image_alt` varchar(45) default NULL,
  `image_title` varchar(45) default NULL,
  `image_path` varchar(250) default NULL,
  `image_table` varchar(45) default NULL,
  `image_table_id` int(11) default NULL,
  PRIMARY KEY  (`image_id`),
  KEY `table_id` (`image_table_id`)
) ENGINE=InnoDB

