-- MySQL dump 10.13  Distrib 5.5.28, for Linux (x86_64)
--
-- Host: localhost    Database: fitzos
-- ------------------------------------------------------
-- Server version	5.5.28

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `api_access`
--

DROP TABLE IF EXISTS `api_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `api_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `key` varchar(45) DEFAULT NULL,
  `session_key` varchar(95) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `api_access`
--

LOCK TABLES `api_access` WRITE;
/*!40000 ALTER TABLE `api_access` DISABLE KEYS */;
INSERT INTO `api_access` VALUES (1,'mobile','eu47rh485u3485','bloomers','yes');
/*!40000 ALTER TABLE `api_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `athlete`
--

DROP TABLE IF EXISTS `athlete`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `athlete` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dob` datetime DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `name` varchar(75) DEFAULT NULL,
  `zip` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `height` decimal(4,2) DEFAULT NULL,
  `weight` decimal(4,2) DEFAULT NULL,
  `bmi` decimal(4,2) DEFAULT NULL,
  `body_fat_percentage` decimal(4,2) DEFAULT NULL,
  `units` enum('Metric','Imperial') DEFAULT NULL,
  `activity` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `image` varchar(145) DEFAULT NULL,
  `show_status` enum('Yes','No') DEFAULT NULL,
  `show_progress` enum('Yes','No') DEFAULT NULL,
  `find_trainer` enum('Yes','No') DEFAULT NULL,
  `show_tables` enum('Yes','No') DEFAULT NULL,
  `search` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `athlete`
--

LOCK TABLES `athlete` WRITE;
/*!40000 ALTER TABLE `athlete` DISABLE KEYS */;
/*!40000 ALTER TABLE `athlete` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` text,
  `date` timestamp NULL DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(45) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `connections`
--

DROP TABLE IF EXISTS `connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `connections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_table` varchar(45) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `destination_table` varchar(45) DEFAULT NULL,
  `destination_id` int(11) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `connections`
--

LOCK TABLES `connections` WRITE;
/*!40000 ALTER TABLE `connections` DISABLE KEYS */;
/*!40000 ALTER TABLE `connections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `endorsement`
--

DROP TABLE IF EXISTS `endorsement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `endorsement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_table` varchar(45) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `summary` varchar(145) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `endorsement`
--

LOCK TABLES `endorsement` WRITE;
/*!40000 ALTER TABLE `endorsement` DISABLE KEYS */;
/*!40000 ALTER TABLE `endorsement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` text,
  `date` timestamp NULL DEFAULT NULL,
  `published` enum('yes','no') DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `type` enum('LIVE','VIRTUAL') DEFAULT NULL,
  `sub_type` enum('FREE','PAID') DEFAULT NULL,
  `public` enum('PRIVATE','PUBLIC') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exercise`
--

DROP TABLE IF EXISTS `exercise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exercise` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `category` varchar(45) DEFAULT NULL,
  `video` varchar(450) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exercise`
--

LOCK TABLES `exercise` WRITE;
/*!40000 ALTER TABLE `exercise` DISABLE KEYS */;
INSERT INTO `exercise` VALUES (1,'Off-Day','','NO VIDEO\r',NULL,NULL,NULL),(2,'Ab Coaster','Abdominals','\r',NULL,NULL,NULL),(3,'Abdominal Roll Wheel','Abdominals','\r',NULL,NULL,NULL),(4,'Absolo Machine','Abdominals','\r',NULL,NULL,NULL),(5,'Active Single-Leg Hip Raise','Abdominals','\r',NULL,NULL,NULL),(6,'Ball Crunches','Abdominals','\r',NULL,NULL,NULL),(7,'Barbell Floor Wipers','Abdominals','\r',NULL,NULL,NULL),(8,'Barbell Rollout','Abdominals','\r',NULL,NULL,NULL),(9,'Barbell Rollout with Pushup','Abdominals','\r',NULL,NULL,NULL),(10,'Bear Crunch','Abdominals','\r',NULL,NULL,NULL),(11,'Belly Blaster','Abdominals','\r',NULL,NULL,NULL),(12,'Bench Crunches','Abdominals','\r',NULL,NULL,NULL),(13,'Bench Knee Tuck with Twist','Abdominals','\r',NULL,NULL,NULL),(14,'Bench Knee Tucks','Abdominals','\r',NULL,NULL,NULL),(15,'Bicycle Crunches','Abdominals','\r',NULL,NULL,NULL),(16,'Birddog','Abdominals','\r',NULL,NULL,NULL),(17,'Bosu Cross-Body Mountain Climber','Abdominals','\r',NULL,NULL,NULL),(18,'Bosu Knee Tucks','Abdominals','\r',NULL,NULL,NULL),(19,'Bosu Oblique Crunch','Abdominals','\r',NULL,NULL,NULL),(20,'Bosu Plank Raise','Abdominals','\r',NULL,NULL,NULL),(21,'Bosu Side Plank','Abdominals','\r',NULL,NULL,NULL),(22,'BOSU X-Crunch','Abdominals','\r',NULL,NULL,NULL),(23,'Bowflex: Seated (Resisted) Abdominal Crunch','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(24,'Bridge (Plank)','Abdominals','\r',NULL,NULL,NULL),(25,'Butterfly Situp','Abdominals','\r',NULL,NULL,NULL),(26,'Cable Core Press','Abdominals','\r',NULL,NULL,NULL),(27,'Cable Crunches','Abdominals','\r',NULL,NULL,NULL),(28,'Clam Crunches','Abdominals','\r',NULL,NULL,NULL),(29,'Closed Leg Toe Touches','Abdominals','\r',NULL,NULL,NULL),(30,'Core Stabilization with Twist','Abdominals','\r',NULL,NULL,NULL),(31,'Crab Foot Reach','Abdominals','\r',NULL,NULL,NULL),(32,'Cross-Body Mountain Climber','Abdominals','\r',NULL,NULL,NULL),(33,'Crunch Twists','Abdominals','\r',NULL,NULL,NULL),(34,'Crunches','Abdominals','\r',NULL,NULL,NULL),(35,'Cybex Ab Crunch Machine','Abdominals','\r',NULL,NULL,NULL),(36,'DB Complex: Mt Climber, RL Raise, Rotational Lunge','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(37,'DB Complex: Turkish Getup and Braced Squat','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(38,'Decline Ab Twists','Abdominals','\r',NULL,NULL,NULL),(39,'Decline Bench Leg Raise Hip Thrusts','Abdominals','\r',NULL,NULL,NULL),(40,'Diagonal Crunch with Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(41,'Double Hip Extension','Abdominals','\r',NULL,NULL,NULL),(42,'Dumbbell Bow Extension','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(43,'Dumbbell Crunches','Abdominals','\r',NULL,NULL,NULL),(44,'Dumbbell Side Bends','Abdominals','\r',NULL,NULL,NULL),(45,'Elevated Bird Dog','Abdominals','\r',NULL,NULL,NULL),(46,'Farmers Walk on Toes','Abdominals','\r',NULL,NULL,NULL),(47,'Figure 8','Abdominals','\r',NULL,NULL,NULL),(48,'Figure Eight Crunches','Abdominals','\r',NULL,NULL,NULL),(49,'Floor I-Position Raise','Abdominals','\r',NULL,NULL,NULL),(50,'Floor Lying Leg Thrusts','Abdominals','\r',NULL,NULL,NULL),(51,'Flutter Kicks','Abdominals','\r',NULL,NULL,NULL),(52,'Four-Point Band Crunch','Abdominals','\r',NULL,NULL,NULL),(53,'Glute Bridge with Abduction','Abdominals','\r',NULL,NULL,NULL),(54,'Glute-Hamstring Hyperextensions','Abdominals','\r',NULL,NULL,NULL),(55,'Half-Kneeling Anti-Rotation Press','Abdominals','\r',NULL,NULL,NULL),(56,'Hanging Knee Raise with Twist','Abdominals','\r',NULL,NULL,NULL),(57,'Hanging Knee Tucks','Abdominals','\r',NULL,NULL,NULL),(58,'Hanging Knee-Up with Scapula Retraction','Abdominals','\r',NULL,NULL,NULL),(59,'Hanging Knees-to-Elbows','Abdominals','\r',NULL,NULL,NULL),(60,'Hanging Leg Raises','Abdominals','\r',NULL,NULL,NULL),(61,'Heel Drop','Abdominals','\r',NULL,NULL,NULL),(62,'Heels To Heaven','Abdominals','\r',NULL,NULL,NULL),(63,'High Knee Skips','Abdominals','\r',NULL,NULL,NULL),(64,'High Knees','Abdominals','\r',NULL,NULL,NULL),(65,'Hip Lift','Abdominals','\r',NULL,NULL,NULL),(66,'Hip Lift March','Abdominals','\r',NULL,NULL,NULL),(67,'Hip Up','Abdominals','\r',NULL,NULL,NULL),(68,'Hollow Rock Hyperextensions','Abdominals','\r',NULL,NULL,NULL),(69,'Incline Sit Ups with Weight','Abdominals','\r',NULL,NULL,NULL),(70,'Incline Sit-Ups','Abdominals','\r',NULL,NULL,NULL),(71,'Jacknife on Two Stability Balls','Abdominals','\r',NULL,NULL,NULL),(72,'Jump Rope','Abdominals','\r',NULL,NULL,NULL),(73,'Jumping Medicine Ball Slam','Abdominals','\r',NULL,NULL,NULL),(74,'Kayaker','Abdominals','\r',NULL,NULL,NULL),(75,'Kettlebell Russian Sit Ups','Abdominals','\r',NULL,NULL,NULL),(76,'Knee to Chest Crunches','Abdominals','\r',NULL,NULL,NULL),(77,'Knee-Up Crunches','Abdominals','\r',NULL,NULL,NULL),(78,'Kneeling Vacuum','Abdominals','\r',NULL,NULL,NULL),(79,'L-Sit Alternating Legs','Abdominals','\r',NULL,NULL,NULL),(80,'L-Sit with Hold','Abdominals','\r',NULL,NULL,NULL),(81,'Landmine Twists','Abdominals','\r',NULL,NULL,NULL),(82,'Lateral Roll','Abdominals','\r',NULL,NULL,NULL),(83,'Leg Lifts','Abdominals','\r',NULL,NULL,NULL),(84,'Leg Raises','Abdominals','\r',NULL,NULL,NULL),(85,'Lying Leg Drops','Abdominals','\r',NULL,NULL,NULL),(86,'Machine Crunches','Abdominals','\r',NULL,NULL,NULL),(87,'Machine Side Crunches','Abdominals','\r',NULL,NULL,NULL),(88,'Machine Side Twists','Abdominals','\r',NULL,NULL,NULL),(89,'Medicine Ball 180 Throw','Abdominals','\r',NULL,NULL,NULL),(90,'Medicine Ball Crunch with Swiss Ball Raise','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(91,'Medicine Ball Lying Leg Raise','Abdominals','\r',NULL,NULL,NULL),(92,'Medicine Ball Rotations','Abdominals','\r',NULL,NULL,NULL),(93,'Medicine Ball Side-to-Side Shuffle','Abdominals','\r',NULL,NULL,NULL),(94,'Medicine Ball V Sit-Ups','Abdominals','\r',NULL,NULL,NULL),(95,'Medicine Ball Windshield Wiper','Abdominals','\r',NULL,NULL,NULL),(96,'Medicine-Ball Russian Twist','Abdominals','\r',NULL,NULL,NULL),(97,'Medicine-Ball Wall Circuit','Abdominals','\r',NULL,NULL,NULL),(98,'Mogul Jump','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(99,'Mountain Climber with Pushup','Abdominals','\r',NULL,NULL,NULL),(100,'Mountain Climbers','Abdominals','\r',NULL,NULL,NULL),(101,'Negative Crunches','Abdominals','\r',NULL,NULL,NULL),(102,'Open Half-Kneel with T-Reach','Abdominals','\r',NULL,NULL,NULL),(103,'Passive Single-Leg Hip Raise','Abdominals','\r',NULL,NULL,NULL),(104,'Peguin Hell Tap Crunches','Abdominals','\r',NULL,NULL,NULL),(105,'Pike Walk','Abdominals','\r',NULL,NULL,NULL),(106,'Pilates: Back Arm Rowing','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(107,'Pilates: Coordination with Ball','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(108,'Pilates: Footwork on Ball','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(109,'Pilates: Mermaid with Ball','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(110,'Pilates: Mermaid with Twist','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(111,'Pilates: Roll Back and Up','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(112,'Pilates: Rollover','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(113,'Pilates: Swan on Ball','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(114,'Plank Knees In and Out','Abdominals','\r',NULL,NULL,NULL),(115,'Plank on Swiss Ball','Abdominals','\r',NULL,NULL,NULL),(116,'Plank Press with Feet on Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(117,'Plank with Alternating Leg Lift','Abdominals','\r',NULL,NULL,NULL),(118,'Plank with Elevated Feet','Abdominals','\r',NULL,NULL,NULL),(119,'Rectus Abdominis Contraction','Abdominals','\r',NULL,NULL,NULL),(120,'Reverse Crunches','Abdominals','\r',NULL,NULL,NULL),(121,'Reverse Plank','Abdominals','\r',NULL,NULL,NULL),(122,'Reverse Table Pose','Abdominals','\r',NULL,NULL,NULL),(123,'Rocky Abs','Abdominals','\r',NULL,NULL,NULL),(124,'Rocky Solo with Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(125,'Rolling Side Plank','Abdominals','\r',NULL,NULL,NULL),(126,'Roman Chair Oblique Twists','Abdominals','\r',NULL,NULL,NULL),(127,'Roman Chair Sit-Ups','Abdominals','\r',NULL,NULL,NULL),(128,'Rotary Torso Machine','Abdominals','\r',NULL,NULL,NULL),(129,'Running Man Abs','Abdominals','\r',NULL,NULL,NULL),(130,'Russian Sit Ups','Abdominals','\r',NULL,NULL,NULL),(131,'Russian Twist','Abdominals','\r',NULL,NULL,NULL),(132,'Russian Twist with Overhead Press','Abdominals','\r',NULL,NULL,NULL),(133,'Seated Knee Tuck with Twist','Abdominals','\r',NULL,NULL,NULL),(134,'Seated Twist and Tilt','Abdominals','\r',NULL,NULL,NULL),(135,'Side Crunches','Abdominals','\r',NULL,NULL,NULL),(136,'Side Jackknifes','Abdominals','\r',NULL,NULL,NULL),(137,'Side Plank','Abdominals','\r',NULL,NULL,NULL),(138,'Side Plank Dips','Abdominals','\r',NULL,NULL,NULL),(139,'Side Plank with Elevated Feet','Abdominals','\r',NULL,NULL,NULL),(140,'Side Plank with Oblique Twist','Abdominals','\r',NULL,NULL,NULL),(141,'Side Plank with Rotation','Abdominals','\r',NULL,NULL,NULL),(142,'Side-Ups','Abdominals','\r',NULL,NULL,NULL),(143,'Single and Double Stability Ball Plank','Abdominals','\r',NULL,NULL,NULL),(144,'Single-Leg Hip Extension','Abdominals','\r',NULL,NULL,NULL),(145,'Single-Leg Side Plank','Abdominals','\r',NULL,NULL,NULL),(146,'Sit-Ups','Abdominals','\r',NULL,NULL,NULL),(147,'Six Minute Ab Workout','Abdominals','\r',NULL,NULL,NULL),(148,'Spiderman with T-Reach','Abdominals','\r',NULL,NULL,NULL),(149,'Sprint Run','Abdominals','\r',NULL,NULL,NULL),(150,'Squat Thrusts','Abdominals','\r',NULL,NULL,NULL),(151,'Stability Ball Alternating Side Planks','Abdominals','\r',NULL,NULL,NULL),(152,'Stability Ball and Bosu Plank Press','Abdominals','\r',NULL,NULL,NULL),(153,'Standing Dumbbell Core Stabilization','Abdominals','\r',NULL,NULL,NULL),(154,'Standing Russian Twist','Abdominals','\r',NULL,NULL,NULL),(155,'Stick Crunch','Abdominals','\r',NULL,NULL,NULL),(156,'Straight-Arm Side Bridge','Abdominals','\r',NULL,NULL,NULL),(157,'Stretch Band Oblique Twists','Abdominals','\r',NULL,NULL,NULL),(158,'Suitcase Crunch with Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(159,'Superband Split Squat and Anti-Rotation','Abdominals','\r',NULL,NULL,NULL),(160,'Supine March and Press','Abdominals','\r',NULL,NULL,NULL),(161,'Swiper','Abdominals','\r',NULL,NULL,NULL),(162,'Swiss Ball Back Extension','Abdominals','\r',NULL,NULL,NULL),(163,'Swiss Ball Band Crunch','Abdominals','\r',NULL,NULL,NULL),(164,'Swiss Ball Crunch with Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(165,'Swiss Ball Front Plank','Abdominals','\r',NULL,NULL,NULL),(166,'Swiss Ball Jackknife Rotation','Abdominals','\r',NULL,NULL,NULL),(167,'Swiss Ball Jackknifes','Abdominals','\r',NULL,NULL,NULL),(168,'Swiss Ball Leg Lifts','Abdominals','\r',NULL,NULL,NULL),(169,'Swiss Ball Oblique Crunch','Abdominals','\r',NULL,NULL,NULL),(170,'Swiss Ball Plank Raise','Abdominals','\r',NULL,NULL,NULL),(171,'Swiss Ball Rocky Twist','Abdominals','\r',NULL,NULL,NULL),(172,'Swiss Ball Roll Up','Abdominals','\r',NULL,NULL,NULL),(173,'Swiss Ball Rollout','Abdominals','\r',NULL,NULL,NULL),(174,'Swiss Ball Side Crunch','Abdominals','\r',NULL,NULL,NULL),(175,'Swiss Ball Twist on Medicine Ball','Abdominals','\r',NULL,NULL,NULL),(176,'Swiss-Ball Hip Raise','Abdominals','\r',NULL,NULL,NULL),(177,'Swiss-Ball Jackknife with Pushup','Abdominals','\r',NULL,NULL,NULL),(178,'Swiss-Ball Knee Drive','Abdominals','\r',NULL,NULL,NULL),(179,'Swiss-Ball Pike','Abdominals','\r',NULL,NULL,NULL),(180,'Table Top on Bosu with Medicine Ball Throw','Abdominals','\r',NULL,NULL,NULL),(181,'Tall Kneeling Anti-Rotation Press','Abdominals','\r',NULL,NULL,NULL),(182,'Three-Point Core Touch','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(183,'Training Camps with Tubing','Abdominals','\r',NULL,NULL,NULL),(184,'TRX Mountain Climber','Abdominals','\r',NULL,NULL,NULL),(185,'TRX Overhead Back Extension','Abdominals','\r',NULL,NULL,NULL),(186,'TRX Pendulum Swing','Abdominals','\r',NULL,NULL,NULL),(187,'TRX Plank and Crunch','Abdominals','\r',NULL,NULL,NULL),(188,'TRX Side Plank','Abdominals','\r',NULL,NULL,NULL),(189,'TRX Standing Rollout','Abdominals','\r',NULL,NULL,NULL),(190,'TRX Torso Rotation','Abdominals','\r',NULL,NULL,NULL),(191,'Under Over','Abdominals','NO VIDEO\r',NULL,NULL,NULL),(192,'V Sit-Ups','Abdominals','\r',NULL,NULL,NULL),(193,'Weighted Crunch','Abdominals','\r',NULL,NULL,NULL),(194,'Weighted Swiss Ball Crunch','Abdominals','\r',NULL,NULL,NULL),(195,'Windshield Wiper','Abdominals','\r',NULL,NULL,NULL),(196,'Yoga Basics','Abdominals','\r',NULL,NULL,NULL),(197,'Alternating Rows on Swiss Ball','Back','\r',NULL,NULL,NULL),(198,'Back Extension with Lower Trap Raise','Back','\r',NULL,NULL,NULL),(199,'Back Row with Tubing','Back','\r',NULL,NULL,NULL),(200,'Band Single-Arm Reverse Fly','Back','\r',NULL,NULL,NULL),(201,'Bar Muscle-Up','Back','\r',NULL,NULL,NULL),(202,'Barbell Clean and Jerk','Back','\r',NULL,NULL,NULL),(203,'Barbell Hang Clean','Back','\r',NULL,NULL,NULL),(204,'Barbell Hang Power Clean','Back','\r',NULL,NULL,NULL),(205,'Barbell Hang Power Snatch','Back','\r',NULL,NULL,NULL),(206,'Barbell Hang Snatch','Back','\r',NULL,NULL,NULL),(207,'Barbell High Pull','Back','\r',NULL,NULL,NULL),(208,'Barbell Power Clean','Back','\r',NULL,NULL,NULL),(209,'Barbell Pressing Snatch Balance','Back','\r',NULL,NULL,NULL),(210,'Barbell Pullover','Back','\r',NULL,NULL,NULL),(211,'Barbell Suitcase Deadlift','Back','\r',NULL,NULL,NULL),(212,'Basketball-Stance Pushup and Row','Back','NO VIDEO\r',NULL,NULL,NULL),(213,'Bent Over Row with Back Extension','Back','\r',NULL,NULL,NULL),(214,'Bent-Over Barbell Rows','Back','\r',NULL,NULL,NULL),(215,'Bent-Over Kettlebell Rows','Back','\r',NULL,NULL,NULL),(216,'Bowflex: Lat Pulldowns','Back','\r',NULL,NULL,NULL),(217,'Bowflex: Lat Row','Back','\r',NULL,NULL,NULL),(218,'Bowflex: Seated Lat Rows','Back','NO VIDEO\r',NULL,NULL,NULL),(219,'Cable Chop (Woodchopper)','Back','\r',NULL,NULL,NULL),(220,'Cable Chop (Woodchopper): Low to High','Back','\r',NULL,NULL,NULL),(221,'Cable Hip Adduction','Back','\r',NULL,NULL,NULL),(222,'Chinup','Back','\r',NULL,NULL,NULL),(223,'Clapping Pull-Ups','Back','\r',NULL,NULL,NULL),(224,'Clean with Front Squat','Back','\r',NULL,NULL,NULL),(225,'Cleans','Back','\r',NULL,NULL,NULL),(226,'Close-Grip Pulldowns','Back','\r',NULL,NULL,NULL),(227,'Cobra on Swiss Ball','Back','\r',NULL,NULL,NULL),(228,'Cross-Bench Dumbbell Pullovers','Back','\r',NULL,NULL,NULL),(229,'DB Complex: Row, One-Arm Press, Rotation Deadlift','Back','NO VIDEO\r',NULL,NULL,NULL),(230,'Decline Dumbbell Pullover','Back','\r',NULL,NULL,NULL),(231,'Double Kettlebell Swing','Back','\r',NULL,NULL,NULL),(232,'Dumbbell High Pull','Back','\r',NULL,NULL,NULL),(233,'Dumbbell Knee Lift with Reverse Row','Back','NO VIDEO\r',NULL,NULL,NULL),(234,'Dumbbell One-Arm Rows on Swiss Ball','Back','\r',NULL,NULL,NULL),(235,'Dumbbell Plank Row','Back','\r',NULL,NULL,NULL),(236,'Dumbbell Power Cleans','Back','\r',NULL,NULL,NULL),(237,'Dumbbell Pullovers','Back','\r',NULL,NULL,NULL),(238,'Dumbbell Romanian Deadlift to High Pull','Back','\r',NULL,NULL,NULL),(239,'Dumbbell Row','Back','\r',NULL,NULL,NULL),(240,'Dumbbell Rows on Swiss Ball','Back','\r',NULL,NULL,NULL),(241,'Dumbbell Shoveling','Back','\r',NULL,NULL,NULL),(242,'Dumbbell Single-Arm Alternating Clean','Back','\r',NULL,NULL,NULL),(243,'Dumbbell Snatch','Back','\r',NULL,NULL,NULL),(244,'Dumbbell Split Lifts','Back','\r',NULL,NULL,NULL),(245,'Dumbbell Turkish Get Up','Back','\r',NULL,NULL,NULL),(246,'Dumbbell Two-Hand Swing','Back','\r',NULL,NULL,NULL),(247,'Dumbbell Woodchopper','Back','\r',NULL,NULL,NULL),(248,'Face Pull','Back','\r',NULL,NULL,NULL),(249,'Gravitron Assisted Pull Up Machine','Back','\r',NULL,NULL,NULL),(250,'Half-Kneeling Neutral-Grip Lat Pulldown','Back','\r',NULL,NULL,NULL),(251,'Hammer Strength Isolateral High Row','Back','\r',NULL,NULL,NULL),(252,'Hammer Strength Isolateral Low Row','Back','\r',NULL,NULL,NULL),(253,'Hanging Ankle to Bar','Back','\r',NULL,NULL,NULL),(254,'Heavy Rope','Back','\r',NULL,NULL,NULL),(255,'Horizontal Wood Chop','Back','\r',NULL,NULL,NULL),(256,'Incline Bench Reverse Dumbbell Fly','Back','\r',NULL,NULL,NULL),(257,'Incline L Raise','Back','\r',NULL,NULL,NULL),(258,'Incline T Raise','Back','\r',NULL,NULL,NULL),(259,'Incline Y Raise','Back','\r',NULL,NULL,NULL),(260,'Inverted Row','Back','\r',NULL,NULL,NULL),(261,'Iso Towel Row Hold','Back','NO VIDEO\r',NULL,NULL,NULL),(262,'Isometric Chinup','Back','\r',NULL,NULL,NULL),(263,'Jumping Chinup','Back','NO VIDEO\r',NULL,NULL,NULL),(264,'Kettlebell Clean and Press','Back','\r',NULL,NULL,NULL),(265,'Kettlebell Half Getups','Back','\r',NULL,NULL,NULL),(266,'Kettlebell One-Arm Row','Back','\r',NULL,NULL,NULL),(267,'Kettlebell One-Hand Swing, Snatch, and Push Press','Back','\r',NULL,NULL,NULL),(268,'Kettlebell One-Handed Snatch','Back','\r',NULL,NULL,NULL),(269,'Kettlebell Plank Row','Back','\r',NULL,NULL,NULL),(270,'Kettlebell Russian One-Hand Swing','Back','\r',NULL,NULL,NULL),(271,'Kettlebell Russian Two-Hand Swing','Back','\r',NULL,NULL,NULL),(272,'Kettlebell Speed Two-Hand Swing','Back','\r',NULL,NULL,NULL),(273,'Kettlebell Turkish Get Up','Back','\r',NULL,NULL,NULL),(274,'Kettlebell Turkish Sit Up','Back','\r',NULL,NULL,NULL),(275,'Kettlebell Two-Hand Swing','Back','\r',NULL,NULL,NULL),(276,'Kettlebell Waiters Walk','Back','\r',NULL,NULL,NULL),(277,'Kneeling One-Arm Rows on Swiss Ball','Back','\r',NULL,NULL,NULL),(278,'Kneeling Underhand-Grip Lat Pulldown','Back','\r',NULL,NULL,NULL),(279,'Lat Pulldown with Neutral Grip','Back','\r',NULL,NULL,NULL),(280,'Lever Pull-Ups','Back','\r',NULL,NULL,NULL),(281,'Lying Bench Reverse Dumbbell Fly','Back','\r',NULL,NULL,NULL),(282,'Machine Incline Pull','Back','\r',NULL,NULL,NULL),(283,'Machine Overhead Pulldown','Back','\r',NULL,NULL,NULL),(284,'Machine Pulldown','Back','\r',NULL,NULL,NULL),(285,'Machine Pullovers','Back','\r',NULL,NULL,NULL),(286,'Machine Seated Rows','Back','\r',NULL,NULL,NULL),(287,'Medicine Ball Chop','Back','\r',NULL,NULL,NULL),(288,'Medicine Ball Cleans','Back','\r',NULL,NULL,NULL),(289,'Medicine Ball Figure 8','Back','\r',NULL,NULL,NULL),(290,'Medicine Ball Thrusters with Throw','Back','\r',NULL,NULL,NULL),(291,'Medicine Ball Woodchopper','Back','\r',NULL,NULL,NULL),(292,'Mixed Grip Chin Up','Back','\r',NULL,NULL,NULL),(293,'Neutral-Grip Chinup','Back','\r',NULL,NULL,NULL),(294,'One-Arm Dumbbell Bent-Over Rows','Back','\r',NULL,NULL,NULL),(295,'One-Leg Bent-Knee Deadlift','Back','\r',NULL,NULL,NULL),(296,'One-Leg Romanian Deadlift','Back','\r',NULL,NULL,NULL),(297,'Overhead Walking Lunges with Barbell','Back','\r',NULL,NULL,NULL),(298,'Overhead Wall Balls','Back','\r',NULL,NULL,NULL),(299,'Pendlay Bent-Over Barbell Rows','Back','\r',NULL,NULL,NULL),(300,'Plank Single-Arm Dumbbell Row','Back','\r',NULL,NULL,NULL),(301,'Plate Bent Over Row','Back','\r',NULL,NULL,NULL),(302,'Prone Cobra','Back','\r',NULL,NULL,NULL),(303,'Pull Up with Neutral Grip','Back','\r',NULL,NULL,NULL),(304,'Pull Ups','Back','\r',NULL,NULL,NULL),(305,'Pull Ups with L-Sit','Back','\r',NULL,NULL,NULL),(306,'Pull Ups with Towel','Back','\r',NULL,NULL,NULL),(307,'Pull Ups: Jumping','Back','\r',NULL,NULL,NULL),(308,'Pull Ups: Kipping Technique','Back','\r',NULL,NULL,NULL),(309,'Pull-Ups: Front Lever','Back','\r',NULL,NULL,NULL),(310,'Pullover with Throw on Swiss Ball','Back','\r',NULL,NULL,NULL),(311,'Push Up Position Row','Back','\r',NULL,NULL,NULL),(312,'Push-Up Position Dumbbell Row','Back','\r',NULL,NULL,NULL),(313,'Pushup Position Row with Squat Thrust','Back','\r',NULL,NULL,NULL),(314,'Rack Chin Ups without Weight','Back','\r',NULL,NULL,NULL),(315,'Reverse Cable Wood Chop','Back','\r',NULL,NULL,NULL),(316,'Reverse Dumbbell Chop','Back','\r',NULL,NULL,NULL),(317,'Reverse Fly','Back','\r',NULL,NULL,NULL),(318,'Reverse Lunge with Row','Back','\r',NULL,NULL,NULL),(319,'Reverse Pec Deck Flyes','Back','\r',NULL,NULL,NULL),(320,'Reverse-Grip Bent-Over Barbell Rows','Back','\r',NULL,NULL,NULL),(321,'Rings: Muscle-Up','Back','\r',NULL,NULL,NULL),(322,'Rope Climb','Back','\r',NULL,NULL,NULL),(323,'Scorpion','Back','\r',NULL,NULL,NULL),(324,'Seated Cable Extensions','Back','\r',NULL,NULL,NULL),(325,'Seated Cable Extensions: Alternating','Back','\r',NULL,NULL,NULL),(326,'Seated Cable Extensions: One-Arm','Back','\r',NULL,NULL,NULL),(327,'Seated Cable Pulldowns','Back','\r',NULL,NULL,NULL),(328,'Seated Cable Pulldowns: Alternating','Back','\r',NULL,NULL,NULL),(329,'Seated Cable Rows','Back','\r',NULL,NULL,NULL),(330,'Seated Cable Rows: Overhead','Back','\r',NULL,NULL,NULL),(331,'Seated Swiss Ball Band Row','Back','\r',NULL,NULL,NULL),(332,'Single Leg Deadlift with Weight','Back','\r',NULL,NULL,NULL),(333,'Single-Arm Lat Pulldown','Back','\r',NULL,NULL,NULL),(334,'Single-Leg Dumbbell Romanian Deadlift','Back','\r',NULL,NULL,NULL),(335,'Single-Leg Dumbbell Rows: Alternating','Back','\r',NULL,NULL,NULL),(336,'Single-Leg Dumbbell Rows: One Arm','Back','\r',NULL,NULL,NULL),(337,'Single-Leg Good Morning','Back','\r',NULL,NULL,NULL),(338,'Split Squat Band Row','Back','\r',NULL,NULL,NULL),(339,'Split Stance Dumbbell Row','Back','\r',NULL,NULL,NULL),(340,'Squat Thrust with Single-Arm Dumbbell Clean','Back','\r',NULL,NULL,NULL),(341,'Standing Band Chop','Back','\r',NULL,NULL,NULL),(342,'Standing Cable Extensions','Back','\r',NULL,NULL,NULL),(343,'Standing Cable Extensions: Alternating','Back','\r',NULL,NULL,NULL),(344,'Standing Cable Extensions: One-Arm','Back','\r',NULL,NULL,NULL),(345,'Standing Cable Pulldowns','Back','\r',NULL,NULL,NULL),(346,'Standing Cable Pulldowns: Alternating','Back','\r',NULL,NULL,NULL),(347,'Standing Cable Pulldowns: One-Arm','Back','\r',NULL,NULL,NULL),(348,'Standing Cable Rows','Back','\r',NULL,NULL,NULL),(349,'Standing Cable Rows: Alternating','Back','\r',NULL,NULL,NULL),(350,'Standing Cable Rows: One-Arm','Back','\r',NULL,NULL,NULL),(351,'Standing Dumbbell Rows','Back','\r',NULL,NULL,NULL),(352,'Standing Dumbbell Rows: Alternating','Back','\r',NULL,NULL,NULL),(353,'Standing Dumbbell Rows: One-Arm','Back','\r',NULL,NULL,NULL),(354,'Standing Reverse Dumbbell Fly','Back','\r',NULL,NULL,NULL),(355,'Standing Soccer Throw','Back','\r',NULL,NULL,NULL),(356,'Straight Arm Cable Pulldown','Back','\r',NULL,NULL,NULL),(357,'Straight-Arm Cable Pulldown','Back','\r',NULL,NULL,NULL),(358,'Straight-Arm Dumbbell Pullback','Back','\r',NULL,NULL,NULL),(359,'Stretch Band High Woodchops','Back','\r',NULL,NULL,NULL),(360,'Stretch Band Low Woodchops','Back','\r',NULL,NULL,NULL),(361,'Stretch Band Narrow Row','Back','\r',NULL,NULL,NULL),(362,'Stretch Band Pullover','Back','\r',NULL,NULL,NULL),(363,'Stretch Band Wide Row','Back','\r',NULL,NULL,NULL),(364,'Sumo Deadlift','Back','\r',NULL,NULL,NULL),(365,'Superband Pulldown','Back','\r',NULL,NULL,NULL),(366,'Superband Squat with One-Arm Row and Rotation','Back','NO VIDEO\r',NULL,NULL,NULL),(367,'Supine Hip Extension on Swiss Ball','Back','\r',NULL,NULL,NULL),(368,'Swimming Pilates','Back','\r',NULL,NULL,NULL),(369,'Swiss Ball Reverse Dumbbell Fly','Back','\r',NULL,NULL,NULL),(370,'T-Bar Rows','Back','\r',NULL,NULL,NULL),(371,'Tempo Inverted Row','Back','\r',NULL,NULL,NULL),(372,'Thoracic Rotation','Back','\r',NULL,NULL,NULL),(373,'Total Gym Body Weight Exercises','Back','\r',NULL,NULL,NULL),(374,'Towel-Grip Inverted Row','Back','\r',NULL,NULL,NULL),(375,'TRX 45 Degree Row','Back','\r',NULL,NULL,NULL),(376,'TRX Bilateral Row','Back','\r',NULL,NULL,NULL),(377,'TRX Glute Bridge','Back','\r',NULL,NULL,NULL),(378,'TRX Reverse Fly','Back','\r',NULL,NULL,NULL),(379,'TRX Suspended Pushup','Back','\r',NULL,NULL,NULL),(380,'TRX Swimmer Pull','Back','\r',NULL,NULL,NULL),(381,'TRX Y-Fly','Back','\r',NULL,NULL,NULL),(382,'Two-In-One Standing Band Row','Back','\r',NULL,NULL,NULL),(383,'Weighted Chinup','Back','\r',NULL,NULL,NULL),(384,'Weighted Rack Chin Ups','Back','\r',NULL,NULL,NULL),(385,'Weighted Rope Pull','Back','\r',NULL,NULL,NULL),(386,'Weighted Wide Grip Pull Up','Back','\r',NULL,NULL,NULL),(387,'Wide Grip Front Chin-Ups','Back','\r',NULL,NULL,NULL),(388,'Wide-Grip Behind-The-Neck Pulldowns','Back','\r',NULL,NULL,NULL),(389,'Wide-Grip Front Pulldowns','Back','\r',NULL,NULL,NULL),(390,'YTWL1 Prone on Bench','Back','\r',NULL,NULL,NULL),(391,'Barbell Bench Press Lockout','Biceps','\r',NULL,NULL,NULL),(392,'Barbell Bicep Curls: Single-Leg','Biceps','\r',NULL,NULL,NULL),(393,'Barbell One-Arm Biceps Curl','Biceps','\r',NULL,NULL,NULL),(394,'Barbell Preacher Curls','Biceps','\r',NULL,NULL,NULL),(395,'Barbell Spider Curls','Biceps','\r',NULL,NULL,NULL),(396,'Biceps Curl with Tubing','Biceps','\r',NULL,NULL,NULL),(397,'Bosu Barbell Curls','Biceps','\r',NULL,NULL,NULL),(398,'Bosu Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(399,'Bosu Dumbbell Hammer Curls','Biceps','\r',NULL,NULL,NULL),(400,'Bosu EZ Bar Curls','Biceps','\r',NULL,NULL,NULL),(401,'Bowflex: Seated Biceps Curl','Biceps','\r',NULL,NULL,NULL),(402,'Bowflex: Standing Biceps Curl','Biceps','\r',NULL,NULL,NULL),(403,'Cable Curls','Biceps','\r',NULL,NULL,NULL),(404,'Concentration Curls','Biceps','\r',NULL,NULL,NULL),(405,'Cross Body Hammer Curls','Biceps','\r',NULL,NULL,NULL),(406,'DB Complex: Curls, StOHD Tri Ext, One-Arm Deadlift','Biceps','NO VIDEO\r',NULL,NULL,NULL),(407,'Decline Hammer Curl','Biceps','\r',NULL,NULL,NULL),(408,'Dumbbell Bicep Curls: Single-Leg','Biceps','\r',NULL,NULL,NULL),(409,'Dumbbell Curl to Press','Biceps','\r',NULL,NULL,NULL),(410,'Dumbbell Hammer Curl and Press','Biceps','\r',NULL,NULL,NULL),(411,'EZ Bar Curls with Close Grip','Biceps','\r',NULL,NULL,NULL),(412,'EZ Bar Curls with Wide Grip','Biceps','\r',NULL,NULL,NULL),(413,'EZ Bar Preacher Curls','Biceps','\r',NULL,NULL,NULL),(414,'EZ Curl Bar Curls','Biceps','\r',NULL,NULL,NULL),(415,'Hammer Curls with Triceps Bar','Biceps','\r',NULL,NULL,NULL),(416,'Incline Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(417,'Incline Flexion Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(418,'Isometric Barbell Curl','Biceps','NO VIDEO\r',NULL,NULL,NULL),(419,'Isometric Squeeze Curl','Biceps','\r',NULL,NULL,NULL),(420,'Kettlebell Pushup','Biceps','\r',NULL,NULL,NULL),(421,'Kettlebell Squeeze Curls','Biceps','\r',NULL,NULL,NULL),(422,'Kneeling Cable, Internal Rotation','Biceps','\r',NULL,NULL,NULL),(423,'Machine Preacher Curls','Biceps','\r',NULL,NULL,NULL),(424,'Prone Dumbbell Curl','Biceps','\r',NULL,NULL,NULL),(425,'Seated Cable Curls: Alternating','Biceps','\r',NULL,NULL,NULL),(426,'Seated Curls','Biceps','\r',NULL,NULL,NULL),(427,'Seated Dumbbell Inner Curls','Biceps','\r',NULL,NULL,NULL),(428,'Seated Hammer Curls','Biceps','\r',NULL,NULL,NULL),(429,'Seated Incline Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(430,'Single-Arm Preacher Hammer Curl','Biceps','\r',NULL,NULL,NULL),(431,'Single-Arm Standing Cable Curl','Biceps','\r',NULL,NULL,NULL),(432,'Split Stance Curl to Press','Biceps','\r',NULL,NULL,NULL),(433,'Standing Alternate Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(434,'Standing Barbell Curls','Biceps','\r',NULL,NULL,NULL),(435,'Standing Barbell Reverse Curls','Biceps','\r',NULL,NULL,NULL),(436,'Standing Cable Bicep Curls: Alternating','Biceps','\r',NULL,NULL,NULL),(437,'Standing Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(438,'Standing Dumbbell Hammer Curls','Biceps','\r',NULL,NULL,NULL),(439,'Standing Dumbbell Reverse Curls','Biceps','\r',NULL,NULL,NULL),(440,'Standing Hammer Curls','Biceps','\r',NULL,NULL,NULL),(441,'Standing Overhead Cable Curls','Biceps','\r',NULL,NULL,NULL),(442,'Suicide Curls','Biceps','\r',NULL,NULL,NULL),(443,'Superband Hammer Curl','Biceps','\r',NULL,NULL,NULL),(444,'Swiss Ball Dumbbell Curls','Biceps','\r',NULL,NULL,NULL),(445,'Swiss Ball Dumbbell Hammer Curls','Biceps','\r',NULL,NULL,NULL),(446,'Swiss Ball Preacher Curls','Biceps','\r',NULL,NULL,NULL),(447,'TRX Biceps Clutch','Biceps','\r',NULL,NULL,NULL),(448,'TRX Biceps Curl','Biceps','\r',NULL,NULL,NULL),(449,'Zottman Curl','Biceps','\r',NULL,NULL,NULL),(450,'Barbell Reverse Calf Raise','Calves','\r',NULL,NULL,NULL),(451,'Calf Presses','Calves','\r',NULL,NULL,NULL),(452,'Donkey Calf Raises','Calves','\r',NULL,NULL,NULL),(453,'One-Leg Dumbbell Calf Raises','Calves','\r',NULL,NULL,NULL),(454,'Seated Barbell Calf Raises','Calves','\r',NULL,NULL,NULL),(455,'Seated Calf Raises','Calves','\r',NULL,NULL,NULL),(456,'Seated Dumbbell Calf Raises','Calves','\r',NULL,NULL,NULL),(457,'Single-Leg Ankle Mobilization','Calves','\r',NULL,NULL,NULL),(458,'Single-Leg Calf Press','Calves','\r',NULL,NULL,NULL),(459,'Smith Machine Standing Calf Raise','Calves','\r',NULL,NULL,NULL),(460,'Standing Barbell Calf Raises','Calves','\r',NULL,NULL,NULL),(461,'Standing Calf Raise (no weight)','Calves','\r',NULL,NULL,NULL),(462,'Standing Calf Raises','Calves','\r',NULL,NULL,NULL),(463,'Tiabialis Raise','Calves','\r',NULL,NULL,NULL),(464,'100 Meter Repeats','Cardio','\r',NULL,NULL,NULL),(465,'10K Race','Cardio','\r',NULL,NULL,NULL),(466,'15K Race','Cardio','\r',NULL,NULL,NULL),(467,'1600M Repeat','Cardio','\r',NULL,NULL,NULL),(468,'200-Yard Sprint','Cardio','NO VIDEO\r',NULL,NULL,NULL),(469,'200M Repeat','Cardio','\r',NULL,NULL,NULL),(470,'20K Race','Cardio','\r',NULL,NULL,NULL),(471,'220 yard sprint (1/8 mile)','Cardio','\r',NULL,NULL,NULL),(472,'25K Race','Cardio','\r',NULL,NULL,NULL),(473,'30-Day Shred Workout','Cardio','\r',NULL,NULL,NULL),(474,'400M Repeat','Cardio','\r',NULL,NULL,NULL),(475,'440 yard sprint (1/4 mile)','Cardio','\r',NULL,NULL,NULL),(476,'5-25-5 Metabolic Circuit','Cardio','NO VIDEO\r',NULL,NULL,NULL),(477,'55% Max Cycling (RPE 3)','Cardio','\r',NULL,NULL,NULL),(478,'55% Max Run (RPE 3)','Cardio','\r',NULL,NULL,NULL),(479,'5K Race','Cardio','\r',NULL,NULL,NULL),(480,'65% Max Cycling (RPE 4)','Cardio','\r',NULL,NULL,NULL),(481,'65% Max Run (RPE 4)','Cardio','\r',NULL,NULL,NULL),(482,'75% Max Cycling (RPE 5)','Cardio','\r',NULL,NULL,NULL),(483,'75% Max Sprint (RPE 5)','Cardio','\r',NULL,NULL,NULL),(484,'800M Repeat','Cardio','\r',NULL,NULL,NULL),(485,'85% Max Cycling (RPE 6)','Cardio','\r',NULL,NULL,NULL),(486,'85% Max Sprint (RPE 6)','Cardio','\r',NULL,NULL,NULL),(487,'90% Max Cycling (RPE 7)','Cardio','\r',NULL,NULL,NULL),(488,'90% Max Sprint (RPE 7)','Cardio','\r',NULL,NULL,NULL),(489,'95% Max Cycling (RPE 8)','Cardio','\r',NULL,NULL,NULL),(490,'95% Max Sprint (RPE 8)','Cardio','\r',NULL,NULL,NULL),(491,'A Skip','Cardio','\r',NULL,NULL,NULL),(492,'Active Rest - Cycling (RPE 2)','Cardio','\r',NULL,NULL,NULL),(493,'Active Rest - Jog (RPE 2)','Cardio','\r',NULL,NULL,NULL),(494,'Active Rest - Walk (RPE 1)','Cardio','\r',NULL,NULL,NULL),(495,'Advanced Curves Workout','Cardio','\r',NULL,NULL,NULL),(496,'Aerobic Endurance (RPE 6)','Cardio','\r',NULL,NULL,NULL),(497,'Aerobic Threshold (RPE 8)','Cardio','\r',NULL,NULL,NULL),(498,'Aerobics','Cardio','\r',NULL,NULL,NULL),(499,'Afternoon Run','Cardio','\r',NULL,NULL,NULL),(500,'Afternoon Walk','Cardio','\r',NULL,NULL,NULL),(501,'Alternating Dumbbell Bench and Jump Squat','Cardio','NO VIDEO\r',NULL,NULL,NULL),(502,'Arm Roll','Cardio','\r',NULL,NULL,NULL),(503,'B Skip','Cardio','\r',NULL,NULL,NULL),(504,'Backwards Run','Cardio','\r',NULL,NULL,NULL),(505,'Badminton (Casual)','Cardio','\r',NULL,NULL,NULL),(506,'Badminton (Competitive)','Cardio','\r',NULL,NULL,NULL),(507,'Bag Kicking','Cardio','\r',NULL,NULL,NULL),(508,'Barbell Front Squat and Pull Up','Cardio','NO VIDEO\r',NULL,NULL,NULL),(509,'Barry\'s Boot Camp','Cardio','\r',NULL,NULL,NULL),(510,'Baseball','Cardio','\r',NULL,NULL,NULL),(511,'Basic Curves Workout','Cardio','\r',NULL,NULL,NULL),(512,'Basketball','Cardio','\r',NULL,NULL,NULL),(513,'Best Way to Exercise: Direct Hip Rotations','Cardio','\r',NULL,NULL,NULL),(514,'Best Way to Exercise: Lying Hip Thrusts','Cardio','\r',NULL,NULL,NULL),(515,'Best Way to Exercise: Modified Leg Lifts','Cardio','\r',NULL,NULL,NULL),(516,'Best Way to Exercise: Tight Glute Ab Lifts','Cardio','\r',NULL,NULL,NULL),(517,'Best Way to Exercise: Toe Tap Rock Back','Cardio','\r',NULL,NULL,NULL),(518,'Bikram Yoga','Cardio','\r',NULL,NULL,NULL),(519,'BodyRock Boot Camp: Squats, Shoulders and Lifts','Cardio','\r',NULL,NULL,NULL),(520,'BodyRock Fitness - 12 Minute Exercise Challenge','Cardio','\r',NULL,NULL,NULL),(521,'BodyRock Fitness 550 Rep Workout','Cardio','\r',NULL,NULL,NULL),(522,'BodyRock Fitness Boot Camp Workout I: Burpees','Cardio','\r',NULL,NULL,NULL),(523,'BodyRock Fitness Boot Camp Workout I: Rope Pullups','Cardio','\r',NULL,NULL,NULL),(524,'BodyRock Fitness Boot Camp Workout I: Wood Chops','Cardio','\r',NULL,NULL,NULL),(525,'BodyRock Fitness Boot Camp: Santana Pushups','Cardio','\r',NULL,NULL,NULL),(526,'BodyRock Fitness Boot Camp: Side Lunge Touch Down','Cardio','\r',NULL,NULL,NULL),(527,'BodyRock Fitness Hot Abs Torture Workout - Part 3','Cardio','\r',NULL,NULL,NULL),(528,'BodyRock Fitness Hot Abs Torture Workout - Part 4','Cardio','\r',NULL,NULL,NULL),(529,'BodyRock Fitness Killer 300 Rep Workout','Cardio','\r',NULL,NULL,NULL),(530,'BodyRock Fitness Killer 600 Rep Workout','Cardio','\r',NULL,NULL,NULL),(531,'BodyRock Fitness: Booty Bounce Workout','Cardio','\r',NULL,NULL,NULL),(532,'BodyRock Fitness: Cardio Exercise Workout 1','Cardio','\r',NULL,NULL,NULL),(533,'BodyRock Fitness: Cardio Exercise Workout 2','Cardio','\r',NULL,NULL,NULL),(534,'BodyRock Fitness: Cardio Exercise Workout 3','Cardio','\r',NULL,NULL,NULL),(535,'BodyRock Fitness: Cardio Exercise Workout 4','Cardio','\r',NULL,NULL,NULL),(536,'BodyRock Fitness: Cardio Exercise Workout 5','Cardio','\r',NULL,NULL,NULL),(537,'BodyRock Fitness: F The Gym Workout','Cardio','\r',NULL,NULL,NULL),(538,'BodyRock Fitness: Ga Ga for Tight Buns Workout','Cardio','\r',NULL,NULL,NULL),(539,'BodyRock Fitness: Put It Down On Me Workout','Cardio','\r',NULL,NULL,NULL),(540,'BodyRock Fitness: Sexy Beast Workout','Cardio','\r',NULL,NULL,NULL),(541,'BodyRock Fitness: Sexy Chick Workout','Cardio','\r',NULL,NULL,NULL),(542,'BodyRock Fitness: Ultimate Stretching Routine','Cardio','\r',NULL,NULL,NULL),(543,'Bound Stairs','Cardio','\r',NULL,NULL,NULL),(544,'Bounding High Knees','Cardio','\r',NULL,NULL,NULL),(545,'Bowflex','Cardio','\r',NULL,NULL,NULL),(546,'Bowling','Cardio','\r',NULL,NULL,NULL),(547,'Box Jumps I','Cardio','\r',NULL,NULL,NULL),(548,'Boxing','Cardio','\r',NULL,NULL,NULL),(549,'Brisk Ride','Cardio','\r',NULL,NULL,NULL),(550,'Brisk Walk','Cardio','\r',NULL,NULL,NULL),(551,'Butt Kicks','Cardio','\r',NULL,NULL,NULL),(552,'Calisthenics - High Effort','Cardio','\r',NULL,NULL,NULL),(553,'Canoe/Kayaking','Cardio','\r',NULL,NULL,NULL),(554,'Cardio Kickboxing','Cardio','\r',NULL,NULL,NULL),(555,'Cardio Warm Up','Cardio','\r',NULL,NULL,NULL),(556,'ChaLEAN Extreme Workout','Cardio','\r',NULL,NULL,NULL),(557,'Cone Drill','Cardio','\r',NULL,NULL,NULL),(558,'Cool Down','Cardio','\r',NULL,NULL,NULL),(559,'Core Rhythms','Cardio','\r',NULL,NULL,NULL),(560,'Crisscrosses','Cardio','\r',NULL,NULL,NULL),(561,'Cross Country Skiing','Cardio','\r',NULL,NULL,NULL),(562,'Cross-Country Skiing Machine','Cardio','\r',NULL,NULL,NULL),(563,'Cross-Ski','Cardio','\r',NULL,NULL,NULL),(564,'CrossFit Workout of the Day','Cardio','\r',NULL,NULL,NULL),(565,'Cybex Arc Trainer','Cardio','\r',NULL,NULL,NULL),(566,'Dancing','Cardio','\r',NULL,NULL,NULL),(567,'Depth Jumps','Cardio','\r',NULL,NULL,NULL),(568,'Dumbbell Push Press and One-Arm Dumbbell Row','Cardio','NO VIDEO\r',NULL,NULL,NULL),(569,'Easy Ride','Cardio','\r',NULL,NULL,NULL),(570,'Easy Run','Cardio','\r',NULL,NULL,NULL),(571,'Elliptical Trainer','Cardio','\r',NULL,NULL,NULL),(572,'Evening Run','Cardio','\r',NULL,NULL,NULL),(573,'Evening Walk','Cardio','\r',NULL,NULL,NULL),(574,'Fartlek Running','Cardio','\r',NULL,NULL,NULL),(575,'Fast Continuous Run','Cardio','\r',NULL,NULL,NULL),(576,'Fitness Walk','Cardio','\r',NULL,NULL,NULL),(577,'Fitness Walk: 3 MPH','Cardio','\r',NULL,NULL,NULL),(578,'Fitness Walk: 4 MPH','Cardio','\r',NULL,NULL,NULL),(579,'Fitness Walk: 5 MPH','Cardio','\r',NULL,NULL,NULL),(580,'Flirty Girl Fitness','Cardio','\r',NULL,NULL,NULL),(581,'Football','Cardio','\r',NULL,NULL,NULL),(582,'Gardening','Cardio','\r',NULL,NULL,NULL),(583,'Goblet Squat and Chinup','Cardio','\r',NULL,NULL,NULL),(584,'Golf','Cardio','\r',NULL,NULL,NULL),(585,'Gymnastics (General)','Cardio','\r',NULL,NULL,NULL),(586,'Half Marathon','Cardio','\r',NULL,NULL,NULL),(587,'Half-Marathon','Cardio','\r',NULL,NULL,NULL),(588,'Half-Mile Repeat','Cardio','\r',NULL,NULL,NULL),(589,'Hammer Curls and Lying Triceps Extensions','Cardio','NO VIDEO\r',NULL,NULL,NULL),(590,'Hard Cardio - 75% Max HR (RPE 7)','Cardio','\r',NULL,NULL,NULL),(591,'High Knee Drills','Cardio','\r',NULL,NULL,NULL),(592,'High Knee Extensions','Cardio','\r',NULL,NULL,NULL),(593,'High Knee Over Side','Cardio','\r',NULL,NULL,NULL),(594,'Hiking','Cardio','\r',NULL,NULL,NULL),(595,'Hill Repeats','Cardio','\r',NULL,NULL,NULL),(596,'Home Repair','Cardio','\r',NULL,NULL,NULL),(597,'Household Tasks','Cardio','\r',NULL,NULL,NULL),(598,'Hurdle Reach','Cardio','\r',NULL,NULL,NULL),(599,'Hurdle Step Overs','Cardio','\r',NULL,NULL,NULL),(600,'Hydrants','Cardio','\r',NULL,NULL,NULL),(601,'Ice Hockey','Cardio','\r',NULL,NULL,NULL),(602,'Ice Skating','Cardio','\r',NULL,NULL,NULL),(603,'Incline Alternating Bench and Lateral Step Ups','Cardio','NO VIDEO\r',NULL,NULL,NULL),(604,'Incline Walk','Cardio','\r',NULL,NULL,NULL),(605,'Insanity Workout by Beach Body','Cardio','\r',NULL,NULL,NULL),(606,'Interval Cardio','Cardio','\r',NULL,NULL,NULL),(607,'Jazzercise','Cardio','\r',NULL,NULL,NULL),(608,'Jiu-Jitsu','Cardio','\r',NULL,NULL,NULL),(609,'Jog in Place','Cardio','\r',NULL,NULL,NULL),(610,'Jog in Place - Fast','Cardio','\r',NULL,NULL,NULL),(611,'Judo','Cardio','\r',NULL,NULL,NULL),(612,'Jump Rope: Double Unders','Cardio','\r',NULL,NULL,NULL),(613,'Jumping Jacks','Cardio','\r',NULL,NULL,NULL),(614,'Jumping Rope','Cardio','\r',NULL,NULL,NULL),(615,'Jumpstart 10-10-10 Circuit','Cardio','NO VIDEO\r',NULL,NULL,NULL),(616,'Jumpstart Cool Down Circuit','Cardio','NO VIDEO\r',NULL,NULL,NULL),(617,'Jumpstart Warm Up Circuit','Cardio','NO VIDEO\r',NULL,NULL,NULL),(618,'Karate','Cardio','\r',NULL,NULL,NULL),(619,'KettleWorx DVD','Cardio','\r',NULL,NULL,NULL),(620,'Kickboxing','Cardio','\r',NULL,NULL,NULL),(621,'Kneeling Catch and Throw','Cardio','\r',NULL,NULL,NULL),(622,'Lacrosse','Cardio','\r',NULL,NULL,NULL),(623,'LBN Do Anything Workout','Cardio','NO VIDEO\r',NULL,NULL,NULL),(624,'LBN Dynamic Warm Up Circuit','Cardio','NO VIDEO\r',NULL,NULL,NULL),(625,'Leaps','Cardio','\r',NULL,NULL,NULL),(626,'Left-Leg Hops','Cardio','\r',NULL,NULL,NULL),(627,'Leg Toss','Cardio','\r',NULL,NULL,NULL),(628,'Les Mills Body Pump Class','Cardio','\r',NULL,NULL,NULL),(629,'Les Mills BodyAttack','Cardio','\r',NULL,NULL,NULL),(630,'Les Mills BodyCombat','Cardio','\r',NULL,NULL,NULL),(631,'Les Mills BodyJam','Cardio','\r',NULL,NULL,NULL),(632,'Les Mills BodyPump','Cardio','\r',NULL,NULL,NULL),(633,'Long Run','Cardio','\r',NULL,NULL,NULL),(634,'Low Walks','Cardio','\r',NULL,NULL,NULL),(635,'Marathon','Cardio','\r',NULL,NULL,NULL),(636,'March in Place','Cardio','\r',NULL,NULL,NULL),(637,'March in Place - Wide','Cardio','\r',NULL,NULL,NULL),(638,'Max Cycling (RPE 10)','Cardio','\r',NULL,NULL,NULL),(639,'Max Sprint (RPE 10)','Cardio','\r',NULL,NULL,NULL),(640,'Max Walk','Cardio','\r',NULL,NULL,NULL),(641,'Medicine Ball Chest Pass','Cardio','\r',NULL,NULL,NULL),(642,'Medicine Ball Discus Throw','Cardio','\r',NULL,NULL,NULL),(643,'Medicine Ball Football Throw','Cardio','\r',NULL,NULL,NULL),(644,'Medicine Ball Hip Level Catch and Throw','Cardio','\r',NULL,NULL,NULL),(645,'Medicine Ball One-Leg Overhead Throw','Cardio','\r',NULL,NULL,NULL),(646,'Medicine Ball Overhead Throw','Cardio','\r',NULL,NULL,NULL),(647,'Medicine Ball Rotation Passes','Cardio','\r',NULL,NULL,NULL),(648,'Medicine Ball Shot Put','Cardio','\r',NULL,NULL,NULL),(649,'Medicine Ball Sit-Up Throw','Cardio','\r',NULL,NULL,NULL),(650,'Medicine Ball Soccer Push','Cardio','\r',NULL,NULL,NULL),(651,'Medicine Ball: Standing Throw, Open Feet','Cardio','\r',NULL,NULL,NULL),(652,'Medium Run','Cardio','\r',NULL,NULL,NULL),(653,'Mile Repeat','Cardio','\r',NULL,NULL,NULL),(654,'Mixed Martial Arts','Cardio','\r',NULL,NULL,NULL),(655,'Model Fitness: Holiday Workout','Cardio','\r',NULL,NULL,NULL),(656,'Model Fitness: Kim\'s Dumbbell Workout','Cardio','\r',NULL,NULL,NULL),(657,'Model Fitness: The Art of Breathing','Cardio','\r',NULL,NULL,NULL),(658,'Model Fitness: Yoga For Your Guns','Cardio','\r',NULL,NULL,NULL),(659,'Morning Run','Cardio','\r',NULL,NULL,NULL),(660,'Morning Walk','Cardio','\r',NULL,NULL,NULL),(661,'Mowing Lawn','Cardio','\r',NULL,NULL,NULL),(662,'Muay Thai','Cardio','\r',NULL,NULL,NULL),(663,'Open-Legged Touches','Cardio','NO VIDEO\r',NULL,NULL,NULL),(664,'Optional Cardio - 60% Max HR (RPE 3)','Cardio','\r',NULL,NULL,NULL),(665,'Optional Walk','Cardio','\r',NULL,NULL,NULL),(666,'Outdoor Cycling','Cardio','\r',NULL,NULL,NULL),(667,'Outdoor Running','Cardio','\r',NULL,NULL,NULL),(668,'Over The Hurdle Continuous','Cardio','\r',NULL,NULL,NULL),(669,'Over The Hurdle Front and Back','Cardio','\r',NULL,NULL,NULL),(670,'Over The Hurdle Lead High Knee','Cardio','\r',NULL,NULL,NULL),(671,'P90X','Cardio','\r',NULL,NULL,NULL),(672,'Pace Ride','Cardio','\r',NULL,NULL,NULL),(673,'Pace Walk','Cardio','\r',NULL,NULL,NULL),(674,'Pilates','Cardio','\r',NULL,NULL,NULL),(675,'Pilates: 10 Minute Flex-Full','Cardio','\r',NULL,NULL,NULL),(676,'Pilates: 10 Minute Sculpting','Cardio','\r',NULL,NULL,NULL),(677,'Pilates: 10 Minute Shoulders','Cardio','\r',NULL,NULL,NULL),(678,'Plyometric Training','Cardio','\r',NULL,NULL,NULL),(679,'Pre-Lift Cardio Warm Up','Cardio','\r',NULL,NULL,NULL),(680,'Prowler Sled Push for Time','Cardio','\r',NULL,NULL,NULL),(681,'Pure Barre Class','Cardio','\r',NULL,NULL,NULL),(682,'Race','Cardio','\r',NULL,NULL,NULL),(683,'Race Pace Run','Cardio','\r',NULL,NULL,NULL),(684,'Raking Leaves','Cardio','\r',NULL,NULL,NULL),(685,'Recovery Jog','Cardio','\r',NULL,NULL,NULL),(686,'Recumbent Stationary Bike','Cardio','\r',NULL,NULL,NULL),(687,'Right-Leg Hops','Cardio','\r',NULL,NULL,NULL),(688,'Rock Climbing','Cardio','\r',NULL,NULL,NULL),(689,'Roller Skating','Cardio','\r',NULL,NULL,NULL),(690,'Rollerblading','Cardio','\r',NULL,NULL,NULL),(691,'Rope Climber','Cardio','\r',NULL,NULL,NULL),(692,'Rope Climbing','Cardio','\r',NULL,NULL,NULL),(693,'Rowing Machine','Cardio','\r',NULL,NULL,NULL),(694,'Rugby','Cardio','\r',NULL,NULL,NULL),(695,'Running Stairs','Cardio','\r',NULL,NULL,NULL),(696,'Short Run','Cardio','\r',NULL,NULL,NULL),(697,'Shoveling Snow','Cardio','\r',NULL,NULL,NULL),(698,'Shuttle Runs','Cardio','\r',NULL,NULL,NULL),(699,'Single Leg Butt Kicks','Cardio','\r',NULL,NULL,NULL),(700,'Single Leg High Knee','Cardio','\r',NULL,NULL,NULL),(701,'Skateboarding','Cardio','\r',NULL,NULL,NULL),(702,'Sledge Hammer Tire Smash','Cardio','\r',NULL,NULL,NULL),(703,'Snorkeling','Cardio','\r',NULL,NULL,NULL),(704,'Snow Shoeing','Cardio','\r',NULL,NULL,NULL),(705,'Snowboarding','Cardio','\r',NULL,NULL,NULL),(706,'Soccer (Casual)','Cardio','\r',NULL,NULL,NULL),(707,'Soccer (Competitive)','Cardio','\r',NULL,NULL,NULL),(708,'Softball','Cardio','\r',NULL,NULL,NULL),(709,'Spartacus 2.0: Step 1','Cardio','NO VIDEO\r',NULL,NULL,NULL),(710,'Spartacus 2.0: Step 2','Cardio','NO VIDEO\r',NULL,NULL,NULL),(711,'Special 40 meters','Cardio','\r',NULL,NULL,NULL),(712,'Speedwalking','Cardio','\r',NULL,NULL,NULL),(713,'Spinning','Cardio','\r',NULL,NULL,NULL),(714,'Sports Rehab: 180 to 90 Toe Touch','Cardio','\r',NULL,NULL,NULL),(715,'Sports Rehab: Big Turns with Medicine Ball','Cardio','\r',NULL,NULL,NULL),(716,'Sports Rehab: Double Leg Eagles','Cardio','\r',NULL,NULL,NULL),(717,'Sports Rehab: Haybales','Cardio','\r',NULL,NULL,NULL),(718,'Sports Rehab: Hip Hikes','Cardio','\r',NULL,NULL,NULL),(719,'Sports Rehab: Lateral Lunge and Lateral Shuffle','Cardio','\r',NULL,NULL,NULL),(720,'Sports Rehab: Lateral Plank Progression','Cardio','\r',NULL,NULL,NULL),(721,'Sports Rehab: Long Snappers','Cardio','\r',NULL,NULL,NULL),(722,'Sports Rehab: Lunge Matrix','Cardio','\r',NULL,NULL,NULL),(723,'Sports Rehab: Myrtl Hip Girdle Routine','Cardio','\r',NULL,NULL,NULL),(724,'Sports Rehab: One Leg Balance with Cycling','Cardio','\r',NULL,NULL,NULL),(725,'Sports Rehab: One Leg Balance with Hip Hike','Cardio','\r',NULL,NULL,NULL),(726,'Sports Rehab: Prone Alternating Arms and Legs','Cardio','\r',NULL,NULL,NULL),(727,'Sports Rehab: Prone Lower Body Crawl','Cardio','\r',NULL,NULL,NULL),(728,'Sports Rehab: Prone Plank on Medicine Ball','Cardio','\r',NULL,NULL,NULL),(729,'Sports Rehab: Prone Plank Stage 1','Cardio','\r',NULL,NULL,NULL),(730,'Sports Rehab: Prone Plank Stage 2','Cardio','\r',NULL,NULL,NULL),(731,'Sports Rehab: Prone Plank Stage 3','Cardio','\r',NULL,NULL,NULL),(732,'Sports Rehab: Prone Plank Stage 4','Cardio','\r',NULL,NULL,NULL),(733,'Sports Rehab: Prone Plank Stage 5','Cardio','\r',NULL,NULL,NULL),(734,'Sports Rehab: Russian Twist','Cardio','\r',NULL,NULL,NULL),(735,'Sports Rehab: Side Plank Series','Cardio','\r',NULL,NULL,NULL),(736,'Sports Rehab: Single Leg Eagles','Cardio','\r',NULL,NULL,NULL),(737,'Sports Rehab: Standing Torso Rotations','Cardio','\r',NULL,NULL,NULL),(738,'Sports Rehab: Supine Plank Series','Cardio','\r',NULL,NULL,NULL),(739,'Sports Rehab: Wide Outs','Cardio','\r',NULL,NULL,NULL),(740,'Sprints','Cardio','\r',NULL,NULL,NULL),(741,'Squash/Racquetball','Cardio','\r',NULL,NULL,NULL),(742,'Stair Walk/Two Steps/Two Plates','Cardio','NO VIDEO\r',NULL,NULL,NULL),(743,'Stairclimbing Machine','Cardio','\r',NULL,NULL,NULL),(744,'Standing Long Jump','Cardio','\r',NULL,NULL,NULL),(745,'Standing Triple Jump','Cardio','\r',NULL,NULL,NULL),(746,'Steady-State Cardio','Cardio','\r',NULL,NULL,NULL),(747,'Straight Leg Bound','Cardio','\r',NULL,NULL,NULL),(748,'Straight Leg Over The Side','Cardio','\r',NULL,NULL,NULL),(749,'Strength & Conditioning Session','Cardio','NO VIDEO\r',NULL,NULL,NULL),(750,'Stretching','Cardio','\r',NULL,NULL,NULL),(751,'Swimming','Cardio','\r',NULL,NULL,NULL),(752,'Tae Kwon Do','Cardio','\r',NULL,NULL,NULL),(753,'Tai Chi','Cardio','\r',NULL,NULL,NULL),(754,'Tempo Run','Cardio','\r',NULL,NULL,NULL),(755,'Tennis','Cardio','\r',NULL,NULL,NULL),(756,'The Abs Diet DVD','Cardio','\r',NULL,NULL,NULL),(757,'The Abs Diet Workout 2 DVD','Cardio','\r',NULL,NULL,NULL),(758,'The Abs Diet Workout for Women DVD','Cardio','\r',NULL,NULL,NULL),(759,'Thursday\'s Boot Camp','Cardio','NO VIDEO\r',NULL,NULL,NULL),(760,'Toe Touches','Cardio','\r',NULL,NULL,NULL),(761,'Tracy Anderson Workout','Cardio','\r',NULL,NULL,NULL),(762,'Train with Chris','Cardio','NO VIDEO\r',NULL,NULL,NULL),(763,'Treadclimber Machine','Cardio','\r',NULL,NULL,NULL),(764,'Treadmill Run: Incline 0%','Cardio','\r',NULL,NULL,NULL),(765,'Treadmill Run: Incline 1%','Cardio','\r',NULL,NULL,NULL),(766,'Treadmill Run: Incline 2%','Cardio','\r',NULL,NULL,NULL),(767,'Treadmill Run: Incline 3%','Cardio','\r',NULL,NULL,NULL),(768,'Treadmill Running','Cardio','\r',NULL,NULL,NULL),(769,'Treadmill Walk: Incline 0%','Cardio','\r',NULL,NULL,NULL),(770,'Treadmill Walk: Incline 10%','Cardio','\r',NULL,NULL,NULL),(771,'Treadmill Walk: Incline 15%','Cardio','\r',NULL,NULL,NULL),(772,'Treadmill Walk: Incline 3%','Cardio','\r',NULL,NULL,NULL),(773,'Treadmill Walk: Incline 5%','Cardio','\r',NULL,NULL,NULL),(774,'Treadmill Walk: Incline 7%','Cardio','\r',NULL,NULL,NULL),(775,'Triple Jumps','Cardio','\r',NULL,NULL,NULL),(776,'Tuesday\'s Sports Conditioning Class','Cardio','NO VIDEO\r',NULL,NULL,NULL),(777,'Ultimate Frisbee','Cardio','\r',NULL,NULL,NULL),(778,'Upright Stationary Bike','Cardio','\r',NULL,NULL,NULL),(779,'Volleyball','Cardio','\r',NULL,NULL,NULL),(780,'Walking (steps/day)','Cardio','\r',NULL,NULL,NULL),(781,'Water Aerobics','Cardio','\r',NULL,NULL,NULL),(782,'Water Skiing','Cardio','\r',NULL,NULL,NULL),(783,'Weighted Hula Hoop','Cardio','\r',NULL,NULL,NULL),(784,'WH DVD: Perfect Body Workout','Cardio','\r',NULL,NULL,NULL),(785,'WH DVD: Ultimate Fat Burn','Cardio','\r',NULL,NULL,NULL),(786,'Wii Aerobics','Cardio','\r',NULL,NULL,NULL),(787,'Wii Cardio Boxing','Cardio','\r',NULL,NULL,NULL),(788,'Wii EA Active','Cardio','\r',NULL,NULL,NULL),(789,'Wii Fit','Cardio','\r',NULL,NULL,NULL),(790,'Winsor Pilates','Cardio','\r',NULL,NULL,NULL),(791,'Wrestling','Cardio','\r',NULL,NULL,NULL),(792,'Yard Work','Cardio','\r',NULL,NULL,NULL),(793,'Yoga','Cardio','\r',NULL,NULL,NULL),(794,'Yoga Booty Ballet','Cardio','\r',NULL,NULL,NULL),(795,'Yoga for Beginners','Cardio','\r',NULL,NULL,NULL),(796,'Yoga Level 1: Basic Meditation Posture','Cardio','\r',NULL,NULL,NULL),(797,'Yoga Level 1: Boat Pose 1','Cardio','\r',NULL,NULL,NULL),(798,'Yoga Level 1: Bound Angle Pose','Cardio','\r',NULL,NULL,NULL),(799,'Yoga Level 1: Bridge Pose','Cardio','\r',NULL,NULL,NULL),(800,'Yoga Level 1: Cat Pose','Cardio','\r',NULL,NULL,NULL),(801,'Yoga Level 1: Chair Pose','Cardio','\r',NULL,NULL,NULL),(802,'Yoga Level 1: Child\'s Pose','Cardio','\r',NULL,NULL,NULL),(803,'Yoga Level 1: Cobbler\'s Pose','Cardio','\r',NULL,NULL,NULL),(804,'Yoga Level 1: Cobra','Cardio','\r',NULL,NULL,NULL),(805,'Yoga Level 1: Corpse Pose','Cardio','\r',NULL,NULL,NULL),(806,'Yoga Level 1: Cow Face Pose','Cardio','\r',NULL,NULL,NULL),(807,'Yoga Level 1: Cow Pose','Cardio','\r',NULL,NULL,NULL),(808,'Yoga Level 1: Cross Legged Twist','Cardio','\r',NULL,NULL,NULL),(809,'Yoga Level 1: Cupid Pose','Cardio','\r',NULL,NULL,NULL),(810,'Yoga Level 1: Dolphin Arm Plank','Cardio','\r',NULL,NULL,NULL),(811,'Yoga Level 1: Downward Facing Dog','Cardio','\r',NULL,NULL,NULL),(812,'Yoga Level 1: Eagle Pose','Cardio','\r',NULL,NULL,NULL),(813,'Yoga Level 1: Frog Pose','Cardio','\r',NULL,NULL,NULL),(814,'Yoga Level 1: Half Locust 1','Cardio','\r',NULL,NULL,NULL),(815,'Yoga Level 1: Half Locust 2','Cardio','\r',NULL,NULL,NULL),(816,'Yoga Level 1: Half Moon Pose','Cardio','\r',NULL,NULL,NULL),(817,'Yoga Level 1: Half Standing Forward Bend','Cardio','\r',NULL,NULL,NULL),(818,'Yoga Level 1: Intense Straddle Leg Stretch','Cardio','\r',NULL,NULL,NULL),(819,'Yoga Level 1: Knees to Chest','Cardio','\r',NULL,NULL,NULL),(820,'Yoga Level 1: Lunge','Cardio','\r',NULL,NULL,NULL),(821,'Yoga Level 1: Meditation','Cardio','\r',NULL,NULL,NULL),(822,'Yoga Level 1: Mountain Arms Overhead','Cardio','\r',NULL,NULL,NULL),(823,'Yoga Level 1: Mountain Pose','Cardio','\r',NULL,NULL,NULL),(824,'Yoga Level 1: Plank Pose','Cardio','\r',NULL,NULL,NULL),(825,'Yoga Level 1: Reclining Twist','Cardio','\r',NULL,NULL,NULL),(826,'Yoga Level 1: Saw Pose','Cardio','\r',NULL,NULL,NULL),(827,'Yoga Level 1: Seated Forward Bend','Cardio','\r',NULL,NULL,NULL),(828,'Yoga Level 1: Staff Pose','Cardio','\r',NULL,NULL,NULL),(829,'Yoga Level 1: Standing Forward Bend','Cardio','\r',NULL,NULL,NULL),(830,'Yoga Level 1: Tree Pose','Cardio','\r',NULL,NULL,NULL),(831,'Yoga Level 1: Triangle Pose','Cardio','\r',NULL,NULL,NULL),(832,'Yoga Level 1: Victorious Breath','Cardio','\r',NULL,NULL,NULL),(833,'Yoga Level 1: Wall Inversion Legs Apart','Cardio','\r',NULL,NULL,NULL),(834,'Yoga Level 1: Wall Inversion Legs Together','Cardio','\r',NULL,NULL,NULL),(835,'Yoga Level 1: Warrior 1','Cardio','\r',NULL,NULL,NULL),(836,'Yoga Level 1: Warrior 2','Cardio','\r',NULL,NULL,NULL),(837,'Yoga Level 2: Boat Pose 2','Cardio','\r',NULL,NULL,NULL),(838,'Yoga Level 2: Camel Pose','Cardio','\r',NULL,NULL,NULL),(839,'Yoga Level 2: Crow Pose','Cardio','\r',NULL,NULL,NULL),(840,'Yoga Level 2: Dancer\'s Pose','Cardio','\r',NULL,NULL,NULL),(841,'Yoga Level 2: Fish Pose','Cardio','\r',NULL,NULL,NULL),(842,'Yoga Level 2: Four Limbed Staff Pose','Cardio','\r',NULL,NULL,NULL),(843,'Yoga Level 2: Half Lord of the Fish','Cardio','\r',NULL,NULL,NULL),(844,'Yoga Level 2: Locust','Cardio','\r',NULL,NULL,NULL),(845,'Yoga Level 2: Low Lunge Arms Raised','Cardio','\r',NULL,NULL,NULL),(846,'Yoga Level 2: Reverse Plank Pose','Cardio','\r',NULL,NULL,NULL),(847,'Yoga Level 2: Revolved Triangle Pose','Cardio','\r',NULL,NULL,NULL),(848,'Yoga Level 2: Side Plank Pose','Cardio','\r',NULL,NULL,NULL),(849,'Yoga Level 2: Tree with Lotus','Cardio','\r',NULL,NULL,NULL),(850,'Yoga Level 2: Twisting Chair','Cardio','\r',NULL,NULL,NULL),(851,'Yoga Level 2: Upward Facing Dog','Cardio','\r',NULL,NULL,NULL),(852,'Yoga Routine: Abs Toning','Cardio','NO VIDEO\r',NULL,NULL,NULL),(853,'Yoga Routine: Fat Burning','Cardio','NO VIDEO\r',NULL,NULL,NULL),(854,'Yoga Routine: Flexibility','Cardio','NO VIDEO\r',NULL,NULL,NULL),(855,'Yoga Routine: Full Body Toning','Cardio','NO VIDEO\r',NULL,NULL,NULL),(856,'Yoga Routine: Metabolism Revving','Cardio','NO VIDEO\r',NULL,NULL,NULL),(857,'Yoga Routine: Strength','Cardio','NO VIDEO\r',NULL,NULL,NULL),(858,'Zumba','Cardio','\r',NULL,NULL,NULL),(859,'Alternating Medicine Ball Press on Swiss Ball','Chest','\r',NULL,NULL,NULL),(860,'Band-Resisted Pushup','Chest','\r',NULL,NULL,NULL),(861,'Barbell Bench Press','Chest','\r',NULL,NULL,NULL),(862,'Barbell Bench Press: Speed','Chest','\r',NULL,NULL,NULL),(863,'Barbell Board Press','Chest','\r',NULL,NULL,NULL),(864,'Barbell Floor Press','Chest','\r',NULL,NULL,NULL),(865,'Barbell Pin Press','Chest','\r',NULL,NULL,NULL),(866,'Bear Crawl','Chest','\r',NULL,NULL,NULL),(867,'Bowflex: Bench Press','Chest','\r',NULL,NULL,NULL),(868,'Bowflex: Incline Bench Press','Chest','\r',NULL,NULL,NULL),(869,'Burpees','Chest','\r',NULL,NULL,NULL),(870,'Cable Crossovers','Chest','\r',NULL,NULL,NULL),(871,'Chest Stretch','Chest','\r',NULL,NULL,NULL),(872,'Clapping Push-Up with Two Medicine Balls','Chest','\r',NULL,NULL,NULL),(873,'Clock Walk with Hands','Chest','\r',NULL,NULL,NULL),(874,'Close-Grip Incline Barbell Press','Chest','\r',NULL,NULL,NULL),(875,'DB Complex: Alt Bench, Hang Snatch, Jump Squat','Chest','NO VIDEO\r',NULL,NULL,NULL),(876,'DB Complex: Bench, Hang Pull, and Front Squat','Chest','NO VIDEO\r',NULL,NULL,NULL),(877,'DB Complex: DB Bench, One-Arm Snatch, Goblet Squat','Chest','NO VIDEO\r',NULL,NULL,NULL),(878,'DB Complex: Ft-El Pushup, Ft-El Split Squat, Shrug','Chest','NO VIDEO\r',NULL,NULL,NULL),(879,'DB Complex: Spiderman, One-Arm Swing, and Squat','Chest','NO VIDEO\r',NULL,NULL,NULL),(880,'DB Complex: T-Pushup, Alt Lat Raise w Hold, Stepup','Chest','NO VIDEO\r',NULL,NULL,NULL),(881,'Decline Barbell Press','Chest','\r',NULL,NULL,NULL),(882,'Decline Dumbbell Bench Press','Chest','\r',NULL,NULL,NULL),(883,'Decline Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(884,'Decline Pushups','Chest','\r',NULL,NULL,NULL),(885,'Dive Bomber Pushups','Chest','\r',NULL,NULL,NULL),(886,'Drop Catch Push Up','Chest','\r',NULL,NULL,NULL),(887,'Dumbbell Alternating Bench on Swiss Ball','Chest','\r',NULL,NULL,NULL),(888,'Dumbbell Alternating Chest Press on Swiss Ball','Chest','\r',NULL,NULL,NULL),(889,'Dumbbell Bench Press','Chest','\r',NULL,NULL,NULL),(890,'Dumbbell Bench Press: Speed','Chest','\r',NULL,NULL,NULL),(891,'Dumbbell Chest Press on Swiss Ball','Chest','\r',NULL,NULL,NULL),(892,'Dumbbell Chest Press: Alternating','Chest','\r',NULL,NULL,NULL),(893,'Dumbbell Floor Press','Chest','\r',NULL,NULL,NULL),(894,'Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(895,'Dumbbell Incline Fly with Twist','Chest','\r',NULL,NULL,NULL),(896,'Dumbbell Incline Press with Neutral Grip','Chest','\r',NULL,NULL,NULL),(897,'Dumbbell One and a Half Pushup','Chest','\r',NULL,NULL,NULL),(898,'Dumbbell Pushup and Row','Chest','\r',NULL,NULL,NULL),(899,'Elevated Plyometric Pushup','Chest','\r',NULL,NULL,NULL),(900,'Elevated Push Ups','Chest','\r',NULL,NULL,NULL),(901,'Elevated Push-Up on Two Stability Balls','Chest','\r',NULL,NULL,NULL),(902,'Elevated Stability Ball Push-Up - Alternate','Chest','\r',NULL,NULL,NULL),(903,'Flat Bench Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(904,'Hammer Strength Decline Press','Chest','\r',NULL,NULL,NULL),(905,'Hammer Strength Iso-Lateral Incline Press','Chest','\r',NULL,NULL,NULL),(906,'Hand Touches','Chest','\r',NULL,NULL,NULL),(907,'Hindu Pushup','Chest','\r',NULL,NULL,NULL),(908,'Inchworm To Pushup','Chest','\r',NULL,NULL,NULL),(909,'Incline Barbell Bench Press: Speed','Chest','\r',NULL,NULL,NULL),(910,'Incline Barbell Press','Chest','\r',NULL,NULL,NULL),(911,'Incline Cable Flyes','Chest','\r',NULL,NULL,NULL),(912,'Incline Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(913,'Incline Dumbbell Press','Chest','\r',NULL,NULL,NULL),(914,'Incline Dumbbell Press: Speed','Chest','\r',NULL,NULL,NULL),(915,'Incline Pushups: Hands on Bench','Chest','\r',NULL,NULL,NULL),(916,'Incline Single-Arm Dumbbell Bench Press','Chest','\r',NULL,NULL,NULL),(917,'Incline Swiss Ball Dumbbell Chest Press','Chest','\r',NULL,NULL,NULL),(918,'Kettlebell Bench Press','Chest','\r',NULL,NULL,NULL),(919,'Kettlebell Burpee with Shrug','Chest','\r',NULL,NULL,NULL),(920,'Kettlebell One-Arm Bench Press','Chest','\r',NULL,NULL,NULL),(921,'Machine Chest Press','Chest','\r',NULL,NULL,NULL),(922,'Machine Incline Chest Press','Chest','\r',NULL,NULL,NULL),(923,'Machine Wide Fly','Chest','\r',NULL,NULL,NULL),(924,'Man Makers','Chest','\r',NULL,NULL,NULL),(925,'Mechanical Change Pushup','Chest','\r',NULL,NULL,NULL),(926,'Medicine Ball on Stability Ball Push-Up','Chest','\r',NULL,NULL,NULL),(927,'Medicine Ball Pushup Progression','Chest','\r',NULL,NULL,NULL),(928,'Medicine Ball T-Push-Ups','Chest','\r',NULL,NULL,NULL),(929,'Medicine Ball with Stability Ball Push-Ups','Chest','\r',NULL,NULL,NULL),(930,'Medicine Ball: Chest Press with Rotation','Chest','\r',NULL,NULL,NULL),(931,'Medicine Ball: Standing Chest Pass','Chest','\r',NULL,NULL,NULL),(932,'Multi-Ball Plyo Push-Up','Chest','\r',NULL,NULL,NULL),(933,'One-Arm Incline Neutral Dumbbell Press','Chest','\r',NULL,NULL,NULL),(934,'Parallel-Bar Dips','Chest','\r',NULL,NULL,NULL),(935,'Pec Deck Flyes','Chest','\r',NULL,NULL,NULL),(936,'Plank to Pushup','Chest','\r',NULL,NULL,NULL),(937,'Plank Walk to Handstand','Chest','\r',NULL,NULL,NULL),(938,'Plank Walkup with Dumbbell Drag','Chest','\r',NULL,NULL,NULL),(939,'Prison Cell Pushups','Chest','\r',NULL,NULL,NULL),(940,'Push Up Plus','Chest','\r',NULL,NULL,NULL),(941,'Push Ups with Weight','Chest','\r',NULL,NULL,NULL),(942,'Push-Up on Two Medicine Balls','Chest','\r',NULL,NULL,NULL),(943,'Push-Ups on Two Stability Balls','Chest','\r',NULL,NULL,NULL),(944,'Pushup and Squat Countdowns','Chest','\r',NULL,NULL,NULL),(945,'Pushup Hold','Chest','\r',NULL,NULL,NULL),(946,'Pushup Position and Row','Chest','\r',NULL,NULL,NULL),(947,'Pushups','Chest','\r',NULL,NULL,NULL),(948,'Pushups - 4 Ball','Chest','\r',NULL,NULL,NULL),(949,'Pushups: Close-Grip','Chest','\r',NULL,NULL,NULL),(950,'Pushups: Feet on Swiss Ball','Chest','\r',NULL,NULL,NULL),(951,'Pushups: Handstand','Chest','\r',NULL,NULL,NULL),(952,'Pushups: Kneeling','Chest','\r',NULL,NULL,NULL),(953,'Pushups: Medicine Ball','Chest','\r',NULL,NULL,NULL),(954,'Pushups: One-Arm Medicine Ball','Chest','\r',NULL,NULL,NULL),(955,'Pushups: Plyometric','Chest','\r',NULL,NULL,NULL),(956,'Pushups: Rotation','Chest','\r',NULL,NULL,NULL),(957,'Pushups: Walking Offset','Chest','\r',NULL,NULL,NULL),(958,'Pushups: Wide-Grip','Chest','\r',NULL,NULL,NULL),(959,'Reverse Burpee','Chest','\r',NULL,NULL,NULL),(960,'Reverse Dumbbell Chest Press','Chest','\r',NULL,NULL,NULL),(961,'Reverse Pushups','Chest','\r',NULL,NULL,NULL),(962,'Seated Cable Chest Press','Chest','\r',NULL,NULL,NULL),(963,'Seated Cable Press: Alternating','Chest','\r',NULL,NULL,NULL),(964,'Seated Cable Press: One-Arm','Chest','\r',NULL,NULL,NULL),(965,'Single-Arm Chest Press with Rotation','Chest','\r',NULL,NULL,NULL),(966,'Single-Arm Split Stance Band Press','Chest','\r',NULL,NULL,NULL),(967,'Smith Machine Regular Bench Press','Chest','\r',NULL,NULL,NULL),(968,'Sphinx Stability Ball Press-Up','Chest','\r',NULL,NULL,NULL),(969,'Spiderman Pushup','Chest','\r',NULL,NULL,NULL),(970,'Split Stance Band Press','Chest','\r',NULL,NULL,NULL),(971,'Standing Cable Chest Press','Chest','\r',NULL,NULL,NULL),(972,'Standing Cable Chest Press: Alt. Arm, Single-Leg','Chest','\r',NULL,NULL,NULL),(973,'Standing Cable Chest Press: Alternating','Chest','\r',NULL,NULL,NULL),(974,'Standing Cable Chest Press: One-Arm','Chest','\r',NULL,NULL,NULL),(975,'Standing Cable Chest Press: Single-Leg','Chest','\r',NULL,NULL,NULL),(976,'Standing Cable Press: One Arm Single-Leg','Chest','\r',NULL,NULL,NULL),(977,'Standing Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(978,'Stop-and-Go Pushup','Chest','\r',NULL,NULL,NULL),(979,'Stretch Band Chest Flyes','Chest','\r',NULL,NULL,NULL),(980,'Suspended Pushup Hold','Chest','\r',NULL,NULL,NULL),(981,'Swiss Ball Dumbbell Flyes','Chest','\r',NULL,NULL,NULL),(982,'Swiss-Ball Pushup','Chest','\r',NULL,NULL,NULL),(983,'T-Pushup','Chest','\r',NULL,NULL,NULL),(984,'Tate Press','Chest','\r',NULL,NULL,NULL),(985,'Tempo Pushups','Chest','\r',NULL,NULL,NULL),(986,'TRX Atomic Pushup','Chest','\r',NULL,NULL,NULL),(987,'TRX Chest Fly','Chest','\r',NULL,NULL,NULL),(988,'TRX Incline Press','Chest','\r',NULL,NULL,NULL),(989,'TRX Pushup and Superman','Chest','\r',NULL,NULL,NULL),(990,'TRX Pushup with Pike','Chest','\r',NULL,NULL,NULL),(991,'Upward Cable Crossovers','Chest','\r',NULL,NULL,NULL),(992,'Walk Out Pushups','Chest','\r',NULL,NULL,NULL),(993,'Wall Pushups','Chest','\r',NULL,NULL,NULL),(994,'Wide Grip Upper Chest Bench Press','Chest','\r',NULL,NULL,NULL),(995,'Bar Hold','Forearms','\r',NULL,NULL,NULL),(996,'Barbell Reverse Wrist Curls','Forearms','\r',NULL,NULL,NULL),(997,'Barbell Wrist Curls','Forearms','\r',NULL,NULL,NULL),(998,'Cable Wrist Curls','Forearms','\r',NULL,NULL,NULL),(999,'Dumbbell Reverse Wrist Curls','Forearms','\r',NULL,NULL,NULL),(1000,'Dumbbell Wrist Curls','Forearms','\r',NULL,NULL,NULL),(1001,'Plate Pinches','Forearms','\r',NULL,NULL,NULL),(1002,'Weight Roll-Ups','Forearms','\r',NULL,NULL,NULL),(1003,'Back Extension: Ground','Lower Back','\r',NULL,NULL,NULL),(1004,'Back Extension: Plank Hold with Lift','Lower Back','\r',NULL,NULL,NULL),(1005,'Back Extensions','Lower Back','\r',NULL,NULL,NULL),(1006,'Back Extensions with Weight','Lower Back','\r',NULL,NULL,NULL),(1007,'Bosu Hamstring Tilts','Lower Back','\r',NULL,NULL,NULL),(1008,'Bowflex: Low Back Extension','Lower Back','\r',NULL,NULL,NULL),(1009,'Deadlifts','Lower Back','\r',NULL,NULL,NULL),(1010,'Good Mornings','Lower Back','\r',NULL,NULL,NULL),(1011,'Machine Low Back Extensions','Lower Back','\r',NULL,NULL,NULL),(1012,'Plate Good Morning','Lower Back','\r',NULL,NULL,NULL),(1013,'Reverse Hyperextension','Lower Back','\r',NULL,NULL,NULL),(1014,'Swiss-Ball Reverse Hyperextension','Lower Back','\r',NULL,NULL,NULL),(1015,'Stretch Band Upper Cuts','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1016,'30 Degree Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1017,'Ahrens Press','Shoulders','\r',NULL,NULL,NULL),(1018,'Alternating Prone Abduction on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1019,'Barbell Behind-the-Neck Push Jerk','Shoulders','\r',NULL,NULL,NULL),(1020,'Barbell Cuban Press','Shoulders','\r',NULL,NULL,NULL),(1021,'Barbell Front Raise','Shoulders','\r',NULL,NULL,NULL),(1022,'Barbell Push Jerk','Shoulders','\r',NULL,NULL,NULL),(1023,'Barbell Push Press','Shoulders','\r',NULL,NULL,NULL),(1024,'Barbell Snatch-Grip, External Rotation','Shoulders','\r',NULL,NULL,NULL),(1025,'Bosu Bent-Over Lateral One-Leg DB Raise','Shoulders','\r',NULL,NULL,NULL),(1026,'Bosu Lateral Cable Raise','Shoulders','\r',NULL,NULL,NULL),(1027,'Bosu Lateral Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1028,'Bowflex: Seated Shoulder Press','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1029,'Bowflex: Standing Lateral Shoulder Raise','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1030,'Cross-Body Cable Raises','Shoulders','\r',NULL,NULL,NULL),(1031,'DB Complex: Inv Shd Press, Rr Lateral Raise, Lunge','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1032,'DB Complex: Lateral Raise, Pushup wRow, Wt Hip Ext','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1033,'DB Complex: Shift Press, UGrip RLRaise, Side Lunge','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1034,'Decline or Braced Dumbbell Row','Shoulders','\r',NULL,NULL,NULL),(1035,'Dumbbell Arnold Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1036,'Dumbbell Bottom-Half Getup','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1037,'Dumbbell Cross Punch','Shoulders','\r',NULL,NULL,NULL),(1038,'Dumbbell Cuban Press','Shoulders','\r',NULL,NULL,NULL),(1039,'Dumbbell Lying Shoulder External Rotation','Shoulders','\r',NULL,NULL,NULL),(1040,'Dumbbell Overhead Shouldering','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1041,'Dumbbell Push Press','Shoulders','\r',NULL,NULL,NULL),(1042,'Dumbbell Shoulder Press on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1043,'Dumbbell Shoulder Press, Staggered Stance','Shoulders','\r',NULL,NULL,NULL),(1044,'Floor Slides','Shoulders','\r',NULL,NULL,NULL),(1045,'Front Cable Raises','Shoulders','\r',NULL,NULL,NULL),(1046,'Front Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1047,'Front Raise with Plate','Shoulders','\r',NULL,NULL,NULL),(1048,'Incline Rear Raise on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1049,'Isometric Lateral Raise','Shoulders','\r',NULL,NULL,NULL),(1050,'Jobe Exercises','Shoulders','\r',NULL,NULL,NULL),(1051,'Kettlebell Halo','Shoulders','\r',NULL,NULL,NULL),(1052,'Kettlebell Press','Shoulders','\r',NULL,NULL,NULL),(1053,'Kettlebell See Saw Overhead Press','Shoulders','\r',NULL,NULL,NULL),(1054,'Kettlebell Snatch','Shoulders','\r',NULL,NULL,NULL),(1055,'Kettlebell: Around Body Pass','Shoulders','\r',NULL,NULL,NULL),(1056,'Kettlebell: Figure 8','Shoulders','\r',NULL,NULL,NULL),(1057,'Kettlebell: Windmill','Shoulders','\r',NULL,NULL,NULL),(1058,'Kneeling Prone Abduction on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1059,'Kneeling Prone Scaption on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1060,'Lateral Cable Raises','Shoulders','\r',NULL,NULL,NULL),(1061,'Lateral Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1062,'Lateral Raise and Rear Lateral Raise','Shoulders','\r',NULL,NULL,NULL),(1063,'Lateral Raise with External Rotation','Shoulders','\r',NULL,NULL,NULL),(1064,'Machine Lateral Raises','Shoulders','\r',NULL,NULL,NULL),(1065,'Machine Rear Delltoid','Shoulders','\r',NULL,NULL,NULL),(1066,'Machine Rear Deltoid Extensions','Shoulders','\r',NULL,NULL,NULL),(1067,'Machine Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1068,'Medicine Ball: Alternating Scoop Toss','Shoulders','\r',NULL,NULL,NULL),(1069,'Modified Front Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1070,'Modified Lateral Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1071,'Modified Rear Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1072,'Plate Pickup Overhead Lift','Shoulders','\r',NULL,NULL,NULL),(1073,'Rear Cable Raises','Shoulders','\r',NULL,NULL,NULL),(1074,'Rear Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1075,'Rear Dumbbell Raises, Thumbs Pointing Out','Shoulders','\r',NULL,NULL,NULL),(1076,'Reverse Rear Dumbbell Raises','Shoulders','\r',NULL,NULL,NULL),(1077,'Seated Alternating Dumbbell Scaption','Shoulders','\r',NULL,NULL,NULL),(1078,'Seated Barbell Front Press','Shoulders','\r',NULL,NULL,NULL),(1079,'Seated Behind-The-Neck Press','Shoulders','\r',NULL,NULL,NULL),(1080,'Seated Dumbbell Abduction on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1081,'Seated Dumbbell Flexion on Swiss Ball','Shoulders','\r',NULL,NULL,NULL),(1082,'Seated Dumbbell Press','Shoulders','\r',NULL,NULL,NULL),(1083,'Seated Dumbbell Press with Neutral Grip','Shoulders','\r',NULL,NULL,NULL),(1084,'Seated Dumbbell Shrugs','Shoulders','\r',NULL,NULL,NULL),(1085,'Shoulder Press Pushup','Shoulders','\r',NULL,NULL,NULL),(1086,'Shoulder Press with Tubing','Shoulders','\r',NULL,NULL,NULL),(1087,'Single-Arm Lateral Shoulder Raise','Shoulders','\r',NULL,NULL,NULL),(1088,'Smith Machine Behind-The-Neck Press','Shoulders','\r',NULL,NULL,NULL),(1089,'Smith Machine Front Press','Shoulders','\r',NULL,NULL,NULL),(1090,'Standing Alternating Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1091,'Standing Alternating Shoulder Scaption','Shoulders','\r',NULL,NULL,NULL),(1092,'Standing Barbell Press','Shoulders','\r',NULL,NULL,NULL),(1093,'Standing Cable Abducted External Rotation','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1094,'Standing Cable Abducted Internal Rotation','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1095,'Standing Cable, External Rotation','Shoulders','\r',NULL,NULL,NULL),(1096,'Standing Dumbbell Press','Shoulders','\r',NULL,NULL,NULL),(1097,'Standing Shoulder Press, Single-Leg','Shoulders','\r',NULL,NULL,NULL),(1098,'Standing Shoulder Pull, External Rotation','Shoulders','\r',NULL,NULL,NULL),(1099,'Standing Shoulder Pull, Internal Rotation','Shoulders','\r',NULL,NULL,NULL),(1100,'Stretch Band Cross Punches','Shoulders','\r',NULL,NULL,NULL),(1101,'Stretch Band Narrow Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1102,'Stretch Band Wide Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1103,'Superband Band Splitter','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1104,'Twisting Dumbbell Shoulder Press','Shoulders','\r',NULL,NULL,NULL),(1105,'Wall Slides','Shoulders','\r',NULL,NULL,NULL),(1106,'Weight Lifting Session','Shoulders','NO VIDEO\r',NULL,NULL,NULL),(1107,'180 Rotation Squat Jumps','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1108,'3-Position Hip Flexor Stretch','Thighs','\r',NULL,NULL,NULL),(1109,'45-lb Plate Push','Thighs','\r',NULL,NULL,NULL),(1110,'Alternating Lunges with Shoulder Press','Thighs','\r',NULL,NULL,NULL),(1111,'Angled Leg Press','Thighs','\r',NULL,NULL,NULL),(1112,'Angled Leg Press (toes pointed in)','Thighs','\r',NULL,NULL,NULL),(1113,'Angled Leg Press (toes pointed out)','Thighs','\r',NULL,NULL,NULL),(1114,'Anti-Rotation Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1115,'Backward Walking Inverted Hamstring','Thighs','\r',NULL,NULL,NULL),(1116,'Balance Pod Squats and Kettlebell Curl to Press','Thighs','\r',NULL,NULL,NULL),(1117,'Band Squat to Curl to Press','Thighs','\r',NULL,NULL,NULL),(1118,'Barbell Clean and Press','Thighs','\r',NULL,NULL,NULL),(1119,'Barbell Complex','Thighs','\r',NULL,NULL,NULL),(1120,'Barbell Hack Squat','Thighs','\r',NULL,NULL,NULL),(1121,'Barbell Hip Raise','Thighs','\r',NULL,NULL,NULL),(1122,'Barbell Lunges','Thighs','\r',NULL,NULL,NULL),(1123,'Barbell Lunges: Lateral','Thighs','\r',NULL,NULL,NULL),(1124,'Barbell Rack Pull','Thighs','\r',NULL,NULL,NULL),(1125,'Barbell Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1126,'Barbell Split Squat','Thighs','\r',NULL,NULL,NULL),(1127,'Barbell Squat','Thighs','\r',NULL,NULL,NULL),(1128,'Barbell Squats','Thighs','\r',NULL,NULL,NULL),(1129,'Barbell Sumo Squat','Thighs','\r',NULL,NULL,NULL),(1130,'Barbell Thrusters','Thighs','\r',NULL,NULL,NULL),(1131,'Barbell Transverse Step Ups','Thighs','\r',NULL,NULL,NULL),(1132,'Body Weight Power Squats','Thighs','\r',NULL,NULL,NULL),(1133,'Bosu Dumbbell Squats','Thighs','\r',NULL,NULL,NULL),(1134,'Bosu Single Leg Lunge with Lateral Raise','Thighs','\r',NULL,NULL,NULL),(1135,'BOSU Warrior 3 to Knee Lift','Thighs','\r',NULL,NULL,NULL),(1136,'Bowflex: Leg Extensions','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1137,'Bowflex: Seated (Straight Leg) Calf Raise','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1138,'Bowflex: Squats','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1139,'Box Jumps','Thighs','\r',NULL,NULL,NULL),(1140,'Box Squat','Thighs','\r',NULL,NULL,NULL),(1141,'Bulgarian Split Squat with Press','Thighs','\r',NULL,NULL,NULL),(1142,'Bulgarian Split Squat without Weight','Thighs','\r',NULL,NULL,NULL),(1143,'Butt Kick Jumps','Thighs','\r',NULL,NULL,NULL),(1144,'Butt Lift (Bridge)','Thighs','\r',NULL,NULL,NULL),(1145,'Cable Hip Abductions','Thighs','\r',NULL,NULL,NULL),(1146,'Cable Knee Drive','Thighs','\r',NULL,NULL,NULL),(1147,'Cable Pull Through','Thighs','\r',NULL,NULL,NULL),(1148,'Clam Shell','Thighs','\r',NULL,NULL,NULL),(1149,'Close-Stance Leg Press','Thighs','\r',NULL,NULL,NULL),(1150,'Cross Behind Step Ups','Thighs','\r',NULL,NULL,NULL),(1151,'DB Complex: Stepup, Scaption, Curl Lunge Press','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1152,'DB Complex: Stepup, Shoulder Raise, Deadlift wRow','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1153,'Deadlift with High Pull','Thighs','\r',NULL,NULL,NULL),(1154,'Donkey Kicks without Weight','Thighs','\r',NULL,NULL,NULL),(1155,'Duck Hack Squats','Thighs','\r',NULL,NULL,NULL),(1156,'Dumbbell Alternating Side Lunge and Press','Thighs','\r',NULL,NULL,NULL),(1157,'Dumbbell Bulgarian Split Squat','Thighs','\r',NULL,NULL,NULL),(1158,'Dumbbell Clean and Press','Thighs','\r',NULL,NULL,NULL),(1159,'Dumbbell Crossover Lunge','Thighs','\r',NULL,NULL,NULL),(1160,'Dumbbell Deadlifts','Thighs','\r',NULL,NULL,NULL),(1161,'Dumbbell Donkey Kicks','Thighs','\r',NULL,NULL,NULL),(1162,'Dumbbell Front Squat','Thighs','\r',NULL,NULL,NULL),(1163,'Dumbbell High-Low Farmers Walk','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1164,'Dumbbell Hot Potato Squat','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1165,'Dumbbell Jump Squat','Thighs','\r',NULL,NULL,NULL),(1166,'Dumbbell Lunge and Rotary','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1167,'Dumbbell Lunge with Shoulder Press','Thighs','\r',NULL,NULL,NULL),(1168,'Dumbbell Lunge with Single-Arm Overhead Press','Thighs','\r',NULL,NULL,NULL),(1169,'Dumbbell Lunge, Curl, and Press','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1170,'Dumbbell Lunges','Thighs','\r',NULL,NULL,NULL),(1171,'Dumbbell Offset Farmer\'s Walk','Thighs','\r',NULL,NULL,NULL),(1172,'Dumbbell Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1173,'Dumbbell Rotational Deadlift','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1174,'Dumbbell Side Lunge and Curl','Thighs','\r',NULL,NULL,NULL),(1175,'Dumbbell Side Lunge and Touch','Thighs','\r',NULL,NULL,NULL),(1176,'Dumbbell Skier Swing','Thighs','\r',NULL,NULL,NULL),(1177,'Dumbbell Split Jumps','Thighs','\r',NULL,NULL,NULL),(1178,'Dumbbell Split Squats','Thighs','\r',NULL,NULL,NULL),(1179,'Dumbbell Squat and Alternating Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1180,'Dumbbell Squat Thrusters','Thighs','\r',NULL,NULL,NULL),(1181,'Dumbbell Squat to Curl to Press','Thighs','\r',NULL,NULL,NULL),(1182,'Dumbbell Squat to Shoulder Press and Twist','Thighs','\r',NULL,NULL,NULL),(1183,'Dumbbell Squat with Rotational Press','Thighs','\r',NULL,NULL,NULL),(1184,'Dumbbell Squat, Overhead Press, and Calf Raise','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1185,'Dumbbell Squats','Thighs','\r',NULL,NULL,NULL),(1186,'Dumbbell Step Ups','Thighs','\r',NULL,NULL,NULL),(1187,'Dumbbell Step Ups with Curls','Thighs','\r',NULL,NULL,NULL),(1188,'Dumbbell Step Ups: Lateral','Thighs','\r',NULL,NULL,NULL),(1189,'Dumbbell Step Ups: Transverse','Thighs','\r',NULL,NULL,NULL),(1190,'Dumbbell Step-Ups: Crossovers','Thighs','\r',NULL,NULL,NULL),(1191,'Dumbbell Stepover','Thighs','\r',NULL,NULL,NULL),(1192,'Dumbbell Straight-leg Deadlift and Row','Thighs','\r',NULL,NULL,NULL),(1193,'Dumbbell Sumo Squat','Thighs','\r',NULL,NULL,NULL),(1194,'Dumbbell Threaded Lunge','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1195,'Extended Set Squats','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1196,'Face-the-Wall Hip Flexor Stretch','Thighs','\r',NULL,NULL,NULL),(1197,'Farmers Carry','Thighs','\r',NULL,NULL,NULL),(1198,'Foam Rolling','Thighs','\r',NULL,NULL,NULL),(1199,'Forward Lunges','Thighs','\r',NULL,NULL,NULL),(1200,'Front Kettlebell Squat and Press','Thighs','\r',NULL,NULL,NULL),(1201,'Front Squats','Thighs','\r',NULL,NULL,NULL),(1202,'Glute Hamstring Raise','Thighs','\r',NULL,NULL,NULL),(1203,'Glute Machine Press','Thighs','\r',NULL,NULL,NULL),(1204,'Goblet Cross-Behind Lunge','Thighs','\r',NULL,NULL,NULL),(1205,'Goblet Squat','Thighs','\r',NULL,NULL,NULL),(1206,'Goblet Squat with Rotation','Thighs','\r',NULL,NULL,NULL),(1207,'Hack Squats','Thighs','\r',NULL,NULL,NULL),(1208,'High Knee Run','Thighs','\r',NULL,NULL,NULL),(1209,'Hindu Squat','Thighs','\r',NULL,NULL,NULL),(1210,'Hip Abduction Machine','Thighs','\r',NULL,NULL,NULL),(1211,'Hip Adduction Machine','Thighs','\r',NULL,NULL,NULL),(1212,'Hip Flexor Stretch','Thighs','\r',NULL,NULL,NULL),(1213,'Ice Skater','Thighs','\r',NULL,NULL,NULL),(1214,'In-Place Side Lunge','Thighs','\r',NULL,NULL,NULL),(1215,'Inchworm','Thighs','\r',NULL,NULL,NULL),(1216,'Iso-Hold Squat','Thighs','\r',NULL,NULL,NULL),(1217,'Isometric Lunge','Thighs','\r',NULL,NULL,NULL),(1218,'Isometric Sumo Squat','Thighs','\r',NULL,NULL,NULL),(1219,'Isometric Triceps Extension','Thighs','\r',NULL,NULL,NULL),(1220,'Jump Squats: Body Weight','Thighs','\r',NULL,NULL,NULL),(1221,'Jumping Jacks: Basic','Thighs','\r',NULL,NULL,NULL),(1222,'Jumps','Thighs','\r',NULL,NULL,NULL),(1223,'Kettlebell Deadlifts','Thighs','\r',NULL,NULL,NULL),(1224,'Kettlebell Front Squats','Thighs','\r',NULL,NULL,NULL),(1225,'Kettlebell Jumps','Thighs','\r',NULL,NULL,NULL),(1226,'Kettlebell Lateral Walk','Thighs','\r',NULL,NULL,NULL),(1227,'Kettlebell Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1228,'Kettlebell Side Lunge and Touch','Thighs','\r',NULL,NULL,NULL),(1229,'Kettlebell Squat Thrust with Pushup','Thighs','\r',NULL,NULL,NULL),(1230,'Kettlebell Straight-Leg Deadlift','Thighs','\r',NULL,NULL,NULL),(1231,'Kettlebell Suitcase Deadlift','Thighs','\r',NULL,NULL,NULL),(1232,'Knee Tuck Jump','Thighs','\r',NULL,NULL,NULL),(1233,'Knee-to-Knee Hip Mobilization','Thighs','\r',NULL,NULL,NULL),(1234,'Lateral Shuffle','Thighs','\r',NULL,NULL,NULL),(1235,'Leg Curl on Swiss Ball','Thighs','\r',NULL,NULL,NULL),(1236,'Leg Extensions','Thighs','\r',NULL,NULL,NULL),(1237,'Leg Floor Work','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1238,'Leg Floor Work with Weight','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1239,'Low Box Lateral Shuffle','Thighs','\r',NULL,NULL,NULL),(1240,'Lunge Jump','Thighs','\r',NULL,NULL,NULL),(1241,'Lunge Slides','Thighs','\r',NULL,NULL,NULL),(1242,'Lunges with Tubing','Thighs','\r',NULL,NULL,NULL),(1243,'Lunges: Front to Balance','Thighs','\r',NULL,NULL,NULL),(1244,'Lunges: Sagittal to Balance','Thighs','\r',NULL,NULL,NULL),(1245,'Lying Bench Dumbbell Hamstring Curl','Thighs','\r',NULL,NULL,NULL),(1246,'Lying Cable Knee Drive','Thighs','\r',NULL,NULL,NULL),(1247,'Lying Leg Curls','Thighs','\r',NULL,NULL,NULL),(1248,'Medicine Ball Squat Jump','Thighs','\r',NULL,NULL,NULL),(1249,'Medicine Ball Squat Press with Rotation','Thighs','\r',NULL,NULL,NULL),(1250,'Medicine Ball Squat to Press with Rotation','Thighs','\r',NULL,NULL,NULL),(1251,'Medicine-Ball Backboard Taps','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1252,'Offset Dumbbell Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1253,'One-Arm Kettlebell Overhead Squats','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1254,'Overhead Body-Weight Squat with Broomstick','Thighs','\r',NULL,NULL,NULL),(1255,'Overhead Dumbbell Lunge','Thighs','\r',NULL,NULL,NULL),(1256,'Overhead Squat','Thighs','\r',NULL,NULL,NULL),(1257,'Overhead Squat: No Weight','Thighs','\r',NULL,NULL,NULL),(1258,'Overhead Superband Lateral Walk','Thighs','\r',NULL,NULL,NULL),(1259,'Overhead Walking Lunges with Dumbbells','Thighs','\r',NULL,NULL,NULL),(1260,'Partial Dumbbell Squats','Thighs','\r',NULL,NULL,NULL),(1261,'Plate Lunge Walk','Thighs','\r',NULL,NULL,NULL),(1262,'Plate Overhead Lunge Walk','Thighs','\r',NULL,NULL,NULL),(1263,'Plie Squat','Thighs','\r',NULL,NULL,NULL),(1264,'Plyo Lunge Switch with Medicine Ball','Thighs','\r',NULL,NULL,NULL),(1265,'Plyo Squat Lunges','Thighs','\r',NULL,NULL,NULL),(1266,'Precor Machine Glute Isolator','Thighs','\r',NULL,NULL,NULL),(1267,'Prisoner Squats','Thighs','\r',NULL,NULL,NULL),(1268,'Prowler Sled Push','Thighs','\r',NULL,NULL,NULL),(1269,'Quadruped Hip Extension','Thighs','\r',NULL,NULL,NULL),(1270,'Reverse Lunge and Swing','Thighs','\r',NULL,NULL,NULL),(1271,'Reverse Lunge with Toe Touch','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1272,'Romanian Deadlift','Thighs','\r',NULL,NULL,NULL),(1273,'Rotational Dumbbell Straight-Leg Deadlift','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1274,'Seal Jumping Jacks','Thighs','\r',NULL,NULL,NULL),(1275,'Seated Leg Curls','Thighs','\r',NULL,NULL,NULL),(1276,'Seated Machine Leg Press','Thighs','\r',NULL,NULL,NULL),(1277,'Side Leg Raise','Thighs','\r',NULL,NULL,NULL),(1278,'Side Lunge Slide','Thighs','\r',NULL,NULL,NULL),(1279,'Side Lunge to Shoulder Press','Thighs','\r',NULL,NULL,NULL),(1280,'Side-to-Side Hops','Thighs','\r',NULL,NULL,NULL),(1281,'Single Leg Lateral Hops','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1282,'Single- Leg Directional Lunge','Thighs','\r',NULL,NULL,NULL),(1283,'Single- Leg Directional Reach','Thighs','\r',NULL,NULL,NULL),(1284,'Single-Arm Dumbbell Swing','Thighs','\r',NULL,NULL,NULL),(1285,'Single-Arm Overhead Reverse Lunge','Thighs','\r',NULL,NULL,NULL),(1286,'Single-Arm, Single-Leg, Straight-Leg Deadlift','Thighs','\r',NULL,NULL,NULL),(1287,'Single-Leg Balance on Bosu','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1288,'Single-Leg Deadlift','Thighs','\r',NULL,NULL,NULL),(1289,'Single-Leg Deadlift with Jump','Thighs','\r',NULL,NULL,NULL),(1290,'Single-Leg Hip Raise','Thighs','\r',NULL,NULL,NULL),(1291,'Single-Leg Hop with Dumbbell','Thighs','\r',NULL,NULL,NULL),(1292,'Single-Leg Press','Thighs','\r',NULL,NULL,NULL),(1293,'Single-Leg Squat','Thighs','\r',NULL,NULL,NULL),(1294,'Single-Leg Touchdown Squats','Thighs','\r',NULL,NULL,NULL),(1295,'Single-Leg, Straight-Leg Deadlift Reach','Thighs','\r',NULL,NULL,NULL),(1296,'Sissy Squats','Thighs','\r',NULL,NULL,NULL),(1297,'Smith Machine Front Squats','Thighs','\r',NULL,NULL,NULL),(1298,'Smith Machine Squats','Thighs','\r',NULL,NULL,NULL),(1299,'Smith Machine Sumo Squat','Thighs','\r',NULL,NULL,NULL),(1300,'Speed Squat with Iso Hold','Thighs','\r',NULL,NULL,NULL),(1301,'Speed Squats (Tabata Squats)','Thighs','\r',NULL,NULL,NULL),(1302,'Spiderman','Thighs','\r',NULL,NULL,NULL),(1303,'Split Jumps','Thighs','\r',NULL,NULL,NULL),(1304,'Split Squat with Front Foot Elevated','Thighs','\r',NULL,NULL,NULL),(1305,'Split Squat with Shoulder Press','Thighs','\r',NULL,NULL,NULL),(1306,'Sprint Strides','Thighs','\r',NULL,NULL,NULL),(1307,'Squat - (No extra weights)','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1308,'Squat to Posterior Chain Stretch','Thighs','\r',NULL,NULL,NULL),(1309,'Squat to Stand','Thighs','\r',NULL,NULL,NULL),(1310,'Squat to Standing Cable Row','Thighs','\r',NULL,NULL,NULL),(1311,'Squat with Prying','Thighs','\r',NULL,NULL,NULL),(1312,'Squats with Swiss Ball','Thighs','\r',NULL,NULL,NULL),(1313,'Squats with Tubing','Thighs','\r',NULL,NULL,NULL),(1314,'Squats: Body Weight','Thighs','\r',NULL,NULL,NULL),(1315,'Standing Cable Leg Lifts','Thighs','\r',NULL,NULL,NULL),(1316,'Standing Leg Curls','Thighs','\r',NULL,NULL,NULL),(1317,'Standing Leg Press','Thighs','\r',NULL,NULL,NULL),(1318,'Standing Single-Leg Cable Extensions','Thighs','\r',NULL,NULL,NULL),(1319,'Static Squat In-and-Out Jump','Thighs','\r',NULL,NULL,NULL),(1320,'Stationary Lunge and Row','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1321,'Step Ups with Medicine Ball','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1322,'Step Ups: Barbell','Thighs','\r',NULL,NULL,NULL),(1323,'Step Ups: Lateral Skips','Thighs','\r',NULL,NULL,NULL),(1324,'Step Ups: Lateral to Balance','Thighs','\r',NULL,NULL,NULL),(1325,'Step Ups: Sagittal Power','Thighs','\r',NULL,NULL,NULL),(1326,'Step Ups: Sagittal to Balance','Thighs','\r',NULL,NULL,NULL),(1327,'Step Ups: Single-Leg Front Skips','Thighs','\r',NULL,NULL,NULL),(1328,'Step Ups: Single-Leg Sagittal Skips','Thighs','\r',NULL,NULL,NULL),(1329,'Step Ups: Transverse to Balance','Thighs','\r',NULL,NULL,NULL),(1330,'Step Ups: Traverse Power','Thighs','\r',NULL,NULL,NULL),(1331,'Step with Rear Leg Lift','Thighs','\r',NULL,NULL,NULL),(1332,'Step-Ups','Thighs','\r',NULL,NULL,NULL),(1333,'Stiff-Legged Deadlifts','Thighs','\r',NULL,NULL,NULL),(1334,'Stiff-Legged Dumbbell Deadlifts','Thighs','\r',NULL,NULL,NULL),(1335,'Straight-Leg Crab Hip Hold','Thighs','\r',NULL,NULL,NULL),(1336,'Stretch Band Lunge with Twist','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1337,'Stretch Band Squat Hold with Twist','Thighs','\r',NULL,NULL,NULL),(1338,'Swiss Ball Hip Extension and Leg Curl','Thighs','\r',NULL,NULL,NULL),(1339,'Swiss Ball One-Leg Curls','Thighs','\r',NULL,NULL,NULL),(1340,'Tempo Barbell Squat','Thighs','\r',NULL,NULL,NULL),(1341,'Thrusters: Body Weight','Thighs','\r',NULL,NULL,NULL),(1342,'Toe Taps With Medicine Ball','Thighs','\r',NULL,NULL,NULL),(1343,'TRX Crossing Balance Lunge','Thighs','\r',NULL,NULL,NULL),(1344,'TRX Hamstring Curl','Thighs','\r',NULL,NULL,NULL),(1345,'TRX Hip Drop','Thighs','\r',NULL,NULL,NULL),(1346,'TRX Hip Extension Leg Curl','Thighs','\r',NULL,NULL,NULL),(1347,'TRX Overhead Squat','Thighs','\r',NULL,NULL,NULL),(1348,'TRX Sprinters Start','Thighs','\r',NULL,NULL,NULL),(1349,'TRX Supine Runner','Thighs','\r',NULL,NULL,NULL),(1350,'TRX Suspended Lunge','Thighs','\r',NULL,NULL,NULL),(1351,'Vertical Leg Press','Thighs','\r',NULL,NULL,NULL),(1352,'Walking Butt Kickers','Thighs','\r',NULL,NULL,NULL),(1353,'Walking Cross-Behind Lunge','Thighs','\r',NULL,NULL,NULL),(1354,'Walking Diagonal Swing','Thighs','\r',NULL,NULL,NULL),(1355,'Walking Heel to Butt','Thighs','\r',NULL,NULL,NULL),(1356,'Walking High Knees','Thighs','\r',NULL,NULL,NULL),(1357,'Walking Knee Hugs','Thighs','\r',NULL,NULL,NULL),(1358,'Walking Leg Cradle','Thighs','\r',NULL,NULL,NULL),(1359,'Walking Lunges with Dumbbells','Thighs','\r',NULL,NULL,NULL),(1360,'Walking Lunges without Weight','Thighs','\r',NULL,NULL,NULL),(1361,'Walking Straight-Leg Kicks','Thighs','\r',NULL,NULL,NULL),(1362,'Wall Sits','Thighs','\r',NULL,NULL,NULL),(1363,'Wide Stance Barbell Squat','Thighs','\r',NULL,NULL,NULL),(1364,'Wide-Grip Stiff-Legged Deadlift','Thighs','\r',NULL,NULL,NULL),(1365,'Windmill Side Lunge','Thighs','NO VIDEO\r',NULL,NULL,NULL),(1366,'Barbell Shrugs','Trapezius','\r',NULL,NULL,NULL),(1367,'Barbell Upright Rows','Trapezius','\r',NULL,NULL,NULL),(1368,'Cable Upright Rows','Trapezius','\r',NULL,NULL,NULL),(1369,'DB Complex: 3-Stop Pushup, Jump Shrug, Split Squat','Trapezius','NO VIDEO\r',NULL,NULL,NULL),(1370,'DB Complex: Alt Row, Push Press, One Leg Deadlift','Trapezius','NO VIDEO\r',NULL,NULL,NULL),(1371,'DB Complex: One-Leg Row, Alt Press, Squat Thrust','Trapezius','NO VIDEO\r',NULL,NULL,NULL),(1372,'DB Complex: Row, Shoulder Press, St-Leg Deadlift','Trapezius','NO VIDEO\r',NULL,NULL,NULL),(1373,'Dumbbell Lawnmower Pull','Trapezius','NO VIDEO\r',NULL,NULL,NULL),(1374,'Dumbbell Shrugs','Trapezius','\r',NULL,NULL,NULL),(1375,'Dumbbell Upright Rows','Trapezius','\r',NULL,NULL,NULL),(1376,'EZ Bar Upright Rows','Trapezius','\r',NULL,NULL,NULL),(1377,'Forward Leaning Shrugs','Trapezius','\r',NULL,NULL,NULL),(1378,'Four Way Neck Machine','Trapezius','\r',NULL,NULL,NULL),(1379,'Medicine Ball Drop Under','Trapezius','\r',NULL,NULL,NULL),(1380,'Medicine Ball Lunge','Trapezius','\r',NULL,NULL,NULL),(1381,'Medicine Ball Slam','Trapezius','\r',NULL,NULL,NULL),(1382,'Modified Shrugs','Trapezius','\r',NULL,NULL,NULL),(1383,'Suspended Inverted Row Hold with Feet on Bosu','Trapezius','\r',NULL,NULL,NULL),(1384,'Alternating Supine Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1385,'Alternating Triceps Extension on Swiss Ball','Triceps','\r',NULL,NULL,NULL),(1386,'Barbell Lying Triceps Extension to Press','Triceps','\r',NULL,NULL,NULL),(1387,'Bent-Over Triceps Cable Extension','Triceps','\r',NULL,NULL,NULL),(1388,'Bowflex: Lying Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1389,'Bowflex: Triceps Pushdown','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1390,'Cable Triceps Kickbacks','Triceps','\r',NULL,NULL,NULL),(1391,'Cable Triceps Pushdown with V-Bar','Triceps','\r',NULL,NULL,NULL),(1392,'Close-Grip Bench Press','Triceps','\r',NULL,NULL,NULL),(1393,'DB Complex: Alt Tricep Ext, Zottman Curl, Deadlift','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1394,'DB Complex: Close Pushup, Ski Swing, OHD Split Sqt','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1395,'DB Complex: Lying Triceps Ext, Curl, Deadlift','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1396,'DB Complex: OHD Shrug, Thrusters, Walking Lunge','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1397,'DB Complex: Pullover, Curl and Hold, Split Jump','Triceps','NO VIDEO\r',NULL,NULL,NULL),(1398,'Decline Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1399,'Dumbbell Lying Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1400,'Dumbbell Triceps Press','Triceps','\r',NULL,NULL,NULL),(1401,'Hammer Strength Seated Dip Press','Triceps','\r',NULL,NULL,NULL),(1402,'Incline Lying Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1403,'Isometric Dip','Triceps','\r',NULL,NULL,NULL),(1404,'Lying Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1405,'Machine Triceps Dips','Triceps','\r',NULL,NULL,NULL),(1406,'Machine Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1407,'Machine Triceps Press','Triceps','\r',NULL,NULL,NULL),(1408,'One-Arm Dumbbell Extensions','Triceps','\r',NULL,NULL,NULL),(1409,'One-Arm Dumbbell Kickbacks','Triceps','\r',NULL,NULL,NULL),(1410,'One-Arm Triceps Extensions on Swiss Ball','Triceps','\r',NULL,NULL,NULL),(1411,'One-Dumbbell Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1412,'Prone Triceps Extensions on Swiss Ball','Triceps','\r',NULL,NULL,NULL),(1413,'Pushups: Close Grip','Triceps','\r',NULL,NULL,NULL),(1414,'Pushups: Close Grip with Rotation','Triceps','\r',NULL,NULL,NULL),(1415,'Reverse-Grip Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1416,'Rings: Triceps Dips','Triceps','\r',NULL,NULL,NULL),(1417,'Rope Extensions','Triceps','\r',NULL,NULL,NULL),(1418,'Seated Overhead Cable Extensions','Triceps','\r',NULL,NULL,NULL),(1419,'Side-to-Side Inverted Row','Triceps','\r',NULL,NULL,NULL),(1420,'Single-Arm Lying Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1421,'Single-Arm Reverse-Grip Pushdown','Triceps','\r',NULL,NULL,NULL),(1422,'Standing Alternating Triceps Kickbacks','Triceps','\r',NULL,NULL,NULL),(1423,'Standing Dumbbell Two-Arm Triceps Kickback','Triceps','\r',NULL,NULL,NULL),(1424,'Superband Overhead Triceps Extension','Triceps','\r',NULL,NULL,NULL),(1425,'Supine Triceps Extensions','Triceps','\r',NULL,NULL,NULL),(1426,'Swiss Ball Overhead Trceps Extensions','Triceps','\r',NULL,NULL,NULL),(1427,'Swiss Ball Trceps Kickbacks','Triceps','\r',NULL,NULL,NULL),(1428,'Swiss Ball Triceps Unilateral Extensions','Triceps','\r',NULL,NULL,NULL),(1429,'Triceps Bench Dips','Triceps','\r',NULL,NULL,NULL),(1430,'Triceps Cable Pushdowns','Triceps','\r',NULL,NULL,NULL),(1431,'Triceps Ladders','Triceps','\r',NULL,NULL,NULL),(1432,'Triceps Parallel-Bar Dips','Triceps','\r',NULL,NULL,NULL),(1433,'TRX Kneeling Triceps Press','Triceps','\r',NULL,NULL,NULL),(1434,'TRX Triceps Press','Triceps','\r',NULL,NULL,NULL),(1435,'Weighted Parallel-Bar Dips','Triceps','\r',NULL,NULL,NULL);
/*!40000 ALTER TABLE `exercise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `table` varchar(45) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum`
--

LOCK TABLES `forum` WRITE;
/*!40000 ALTER TABLE `forum` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forum_messages`
--

DROP TABLE IF EXISTS `forum_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forum_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `message` text,
  `forum_id` int(11) DEFAULT NULL,
  `published` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forum_messages`
--

LOCK TABLES `forum_messages` WRITE;
/*!40000 ALTER TABLE `forum_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `forum_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_archives`
--

DROP TABLE IF EXISTS `fuel_archives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_archives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ref_id` int(10) unsigned NOT NULL,
  `table_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci NOT NULL,
  `version` smallint(5) unsigned NOT NULL,
  `version_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived_user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_archives`
--

LOCK TABLES `fuel_archives` WRITE;
/*!40000 ALTER TABLE `fuel_archives` DISABLE KEYS */;
INSERT INTO `fuel_archives` VALUES (1,1,'member','{\"id\":1,\"active\":\"yes\",\"first_name\":\"Dave\",\"last_name\":\"Gill\",\"language\":\"english\",\"salt\":\"oireroierjriwej484u4\",\"email\":\"dave_gill@blueyonder.co.uk\",\"password\":\"h6redmine\"}',1,'2013-05-12 19:34:03',1),(2,1,'fuel_pages','{\"id\":1,\"location\":\"chris\",\"layout\":\"main\",\"published\":\"yes\",\"cache\":\"yes\",\"date_added\":\"2013-05-12 15:50:40\",\"last_modified\":\"2013-05-12 15:50:40\",\"last_modified_by\":\"\",\"variables\":[{\"page_id\":1,\"name\":\"page_title\",\"value\":\"Chris Test Page\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":1,\"name\":\"heading\",\"value\":\"Chris\' Test Heading\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":1,\"name\":\"meta_description\",\"value\":\"Chris\' Awesome Meta\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":1,\"name\":\"meta_keywords\",\"value\":\"Fitness Extremmmeee!!!\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":1,\"name\":\"body\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":1,\"name\":\"body_class\",\"value\":null,\"type\":\"string\",\"language\":\"english\"}]}',1,'2013-05-12 22:50:40',3),(3,2,'fuel_pages','{\"id\":2,\"location\":\"development\",\"layout\":\"main\",\"published\":\"yes\",\"cache\":\"yes\",\"date_added\":\"2013-06-01 13:57:47\",\"last_modified\":\"2013-06-01 13:57:47\",\"last_modified_by\":\"\",\"variables\":[{\"page_id\":2,\"name\":\"page_title\",\"value\":\"Development Progress\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":2,\"name\":\"heading\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":2,\"name\":\"meta_description\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":2,\"name\":\"meta_keywords\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":2,\"name\":\"body\",\"value\":\"I am currently building the site up from scratch and will report progress on this page. So as of 1st June we have a web server setup and parts of the CMS.  I am slowly building up the database to cater for the Fitzos system and was working with Ross this evening to add to that database.  I am also going to be creating the templates ready for the website content as well.  So keep watching this space...\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":2,\"name\":\"body_class\",\"value\":null,\"type\":\"string\",\"language\":\"english\"}]}',1,'2013-06-01 20:57:47',1),(4,2,'fuel_pages','{\"id\":\"2\",\"location\":\"development\",\"layout\":\"main\",\"published\":\"yes\",\"cache\":\"yes\",\"date_added\":\"2013-06-01 13:57:47\",\"last_modified\":\"2013-06-01 14:06:47\",\"last_modified_by\":\"1\",\"variables\":[{\"page_id\":\"2\",\"name\":\"page_title\",\"value\":\"Development Progress\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"2\",\"name\":\"heading\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"2\",\"name\":\"meta_description\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"2\",\"name\":\"meta_keywords\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"2\",\"name\":\"body\",\"value\":\"I am currently building the site up from scratch and will report progress on this page. So as of 1st June we have a web server setup and parts of the CMS.  I am slowly building up the database to cater for the Fitzos system and adding parts to the CMS to cater for the parts of the database I have created. I have been working with Ross this evening to add to that database.  I am also going to be creating the templates ready for the website content as well.  So keep watching this space...\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"2\",\"name\":\"body_class\",\"value\":null,\"type\":\"string\",\"language\":\"english\"}]}',2,'2013-06-01 21:06:47',1),(5,3,'fuel_pages','{\"id\":3,\"location\":\"terms\",\"layout\":\"main\",\"published\":\"yes\",\"cache\":\"yes\",\"date_added\":\"2013-08-05 10:47:56\",\"last_modified\":\"2013-08-05 10:47:56\",\"last_modified_by\":\"\",\"variables\":[{\"page_id\":3,\"name\":\"page_title\",\"value\":\"Terms & Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":3,\"name\":\"heading\",\"value\":\"Terms & Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":3,\"name\":\"meta_description\",\"value\":\"Terms and conditions for usafe of Fitzos\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":3,\"name\":\"meta_keywords\",\"value\":\"Terms, Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":3,\"name\":\"body\",\"value\":null,\"type\":\"string\",\"language\":\"english\"},{\"page_id\":3,\"name\":\"body_class\",\"value\":null,\"type\":\"string\",\"language\":\"english\"}]}',1,'2013-08-05 17:47:56',1),(6,3,'fuel_pages','{\"id\":\"3\",\"location\":\"terms\",\"layout\":\"main\",\"published\":\"yes\",\"cache\":\"yes\",\"date_added\":\"2013-08-05 10:47:56\",\"last_modified\":\"2013-08-05 10:48:49\",\"last_modified_by\":\"1\",\"variables\":[{\"page_id\":\"3\",\"name\":\"page_title\",\"value\":\"Terms & Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"3\",\"name\":\"heading\",\"value\":\"Terms & Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"3\",\"name\":\"meta_description\",\"value\":\"Terms and conditions for usafe of Fitzos\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"3\",\"name\":\"meta_keywords\",\"value\":\"Terms, Conditions\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"3\",\"name\":\"body\",\"value\":\"Did you come here for something in particular or just general Riker-bashing? Now we know what they mean by \'advanced\' tactical training. What\'s a knock-out like you doing in a computer-generated gin joint like this? Some days you get the bear, and some days the bear gets you. Besides, you look good in a dress. Fear is the true enemy, the only enemy. Congratulations - you just destroyed the Enterprise. Fate. It protects fools, little children, and ships named \\\"Enterprise.\\\" Commander William Riker of the Starship Enterprise.\",\"type\":\"string\",\"language\":\"english\"},{\"page_id\":\"3\",\"name\":\"body_class\",\"value\":null,\"type\":\"string\",\"language\":\"english\"}]}',2,'2013-08-05 17:48:49',1);
/*!40000 ALTER TABLE `fuel_archives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blocks`
--

DROP TABLE IF EXISTS `fuel_blocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blocks` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view` text COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blocks`
--

LOCK TABLES `fuel_blocks` WRITE;
/*!40000 ALTER TABLE `fuel_blocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blog_categories`
--

DROP TABLE IF EXISTS `fuel_blog_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blog_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'If left blank, the slug will automatically be created for you.',
  `precedence` int(11) unsigned DEFAULT '0',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`slug`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blog_categories`
--

LOCK TABLES `fuel_blog_categories` WRITE;
/*!40000 ALTER TABLE `fuel_blog_categories` DISABLE KEYS */;
INSERT INTO `fuel_blog_categories` VALUES (1,'Uncategorized','uncategorized',0,'yes');
/*!40000 ALTER TABLE `fuel_blog_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blog_comments`
--

DROP TABLE IF EXISTS `fuel_blog_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blog_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `author_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author_ip` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_spam` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `date_added` datetime NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blog_comments`
--

LOCK TABLES `fuel_blog_comments` WRITE;
/*!40000 ALTER TABLE `fuel_blog_comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blog_comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blog_links`
--

DROP TABLE IF EXISTS `fuel_blog_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blog_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `target` enum('blank','self','parent') DEFAULT 'blank',
  `description` varchar(100) DEFAULT NULL,
  `precedence` int(11) NOT NULL DEFAULT '0',
  `published` enum('yes','no') DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blog_links`
--

LOCK TABLES `fuel_blog_links` WRITE;
/*!40000 ALTER TABLE `fuel_blog_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blog_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blog_posts`
--

DROP TABLE IF EXISTS `fuel_blog_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blog_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `content_filtered` text COLLATE utf8_unicode_ci NOT NULL,
  `formatting` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `excerpt` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'A condensed version of the content',
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'This is the last part of the url string. If left blank, the slug will automatically be created for you.',
  `author_id` int(10) unsigned NOT NULL COMMENT 'If left blank, you will assumed be the author.',
  `main_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `list_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `thumbnail_image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sticky` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `allow_comments` enum('yes','no') COLLATE utf8_unicode_ci DEFAULT 'no',
  `post_date` datetime NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permalink` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blog_posts`
--

LOCK TABLES `fuel_blog_posts` WRITE;
/*!40000 ALTER TABLE `fuel_blog_posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blog_posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_blog_users`
--

DROP TABLE IF EXISTS `fuel_blog_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_blog_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fuel_user_id` int(10) unsigned NOT NULL,
  `display_name` varchar(50) NOT NULL,
  `website` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `avatar_image` varchar(255) NOT NULL DEFAULT '',
  `twitter` varchar(255) NOT NULL DEFAULT '',
  `facebook` varchar(255) NOT NULL DEFAULT '',
  `linkedin` varchar(255) NOT NULL DEFAULT '',
  `google` varchar(255) NOT NULL DEFAULT '',
  `date_added` datetime DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_blog_users`
--

LOCK TABLES `fuel_blog_users` WRITE;
/*!40000 ALTER TABLE `fuel_blog_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_blog_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_categories`
--

DROP TABLE IF EXISTS `fuel_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `slug` varchar(100) NOT NULL DEFAULT '',
  `context` varchar(100) NOT NULL DEFAULT '',
  `precedence` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `published` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_categories`
--

LOCK TABLES `fuel_categories` WRITE;
/*!40000 ALTER TABLE `fuel_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_logs`
--

DROP TABLE IF EXISTS `fuel_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_logs`
--

LOCK TABLES `fuel_logs` WRITE;
/*!40000 ALTER TABLE `fuel_logs` DISABLE KEYS */;
INSERT INTO `fuel_logs` VALUES (1,'2013-05-05 04:04:36',1,'Users item <em>rchernin92@gmail.com</em> edited','info'),(2,'2013-05-05 04:05:53',1,'Users item <em>fitzos@improvewithchris.com</em> edited','info'),(3,'2013-05-05 04:06:31',1,'Users item <em>orione96@gmail.com</em> edited','info'),(4,'2013-05-12 12:34:03',1,'Members item <em>yes</em> edited','info'),(5,'2013-05-13 05:18:15',1,'Permissions item <em>Clubs</em> edited','info'),(6,'2013-05-13 05:19:11',1,'Users item <em>fitzos@improvewithchris.com</em> edited','info'),(7,'2013-06-01 12:30:31',2,'Members item <em>no</em> edited','info'),(8,'2013-06-01 12:30:33',2,'Members item <em>yes</em> edited','info'),(9,'2013-06-01 14:06:47',1,'Pages item <em>development</em> edited','info'),(10,'2013-08-05 10:48:49',1,'Pages item <em>terms</em> edited','info');
/*!40000 ALTER TABLE `fuel_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_navigation`
--

DROP TABLE IF EXISTS `fuel_navigation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The part of the path after the domain name that you want the link to go to (e.g. comany/about_us)',
  `group_id` int(5) unsigned NOT NULL DEFAULT '1',
  `nav_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The nav key is a friendly ID that you can use for setting the selected state. If left blank, a default value will be set for you.',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name you want to appear in the menu',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Used for creating menu hierarchies. No value means it is a root level menu item',
  `precedence` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The higher the number, the greater the precedence and farther up the list the navigational element will appear',
  `attributes` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Extra attributes that can be used for navigation implementation',
  `selected` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The pattern to match for the active state. Most likely you leave this field blank',
  `hidden` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no' COMMENT 'A hidden value can be used in rendering the menu. In some areas, the menu item may not want to be displayed',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Determines whether the item is displayed or not',
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`location`,`parent_id`,`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_navigation`
--

LOCK TABLES `fuel_navigation` WRITE;
/*!40000 ALTER TABLE `fuel_navigation` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_navigation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_navigation_groups`
--

DROP TABLE IF EXISTS `fuel_navigation_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_navigation_groups` (
  `id` int(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_navigation_groups`
--

LOCK TABLES `fuel_navigation_groups` WRITE;
/*!40000 ALTER TABLE `fuel_navigation_groups` DISABLE KEYS */;
INSERT INTO `fuel_navigation_groups` VALUES (1,'main','yes');
/*!40000 ALTER TABLE `fuel_navigation_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_page_variables`
--

DROP TABLE IF EXISTS `fuel_page_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_page_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(10) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('string','int','boolean','array') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'string',
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_id` (`page_id`,`name`,`language`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_page_variables`
--

LOCK TABLES `fuel_page_variables` WRITE;
/*!40000 ALTER TABLE `fuel_page_variables` DISABLE KEYS */;
INSERT INTO `fuel_page_variables` VALUES (1,1,'page_title','','Chris Test Page','string','english','yes'),(2,1,'heading','','Chris\' Test Heading','string','english','yes'),(3,1,'meta_description','','Chris\' Awesome Meta','string','english','yes'),(4,1,'meta_keywords','','Fitness Extremmmeee!!!','string','english','yes'),(5,1,'body','','','string','english','yes'),(6,1,'body_class','','','string','english','yes'),(14,2,'heading','','','string','english','yes'),(15,2,'meta_description','','','string','english','yes'),(16,2,'meta_keywords','','','string','english','yes'),(17,2,'body','','I am currently building the site up from scratch and will report progress on this page. So as of 1st June we have a web server setup and parts of the CMS.  I am slowly building up the database to cater for the Fitzos system and adding parts to the CMS to cater for the parts of the database I have created. I have been working with Ross this evening to add to that database.  I am also going to be creating the templates ready for the website content as well.  So keep watching this space...','string','english','yes'),(13,2,'page_title','','Development Progress','string','english','yes'),(18,2,'body_class','','','string','english','yes'),(27,3,'meta_description','','Terms and conditions for usafe of Fitzos','string','english','yes'),(26,3,'heading','','Terms & Conditions','string','english','yes'),(25,3,'page_title','','Terms & Conditions','string','english','yes'),(28,3,'meta_keywords','','Terms, Conditions','string','english','yes'),(29,3,'body','','Did you come here for something in particular or just general Riker-bashing? Now we know what they mean by \'advanced\' tactical training. What\'s a knock-out like you doing in a computer-generated gin joint like this? Some days you get the bear, and some days the bear gets you. Besides, you look good in a dress. Fear is the true enemy, the only enemy. Congratulations - you just destroyed the Enterprise. Fate. It protects fools, little children, and ships named \"Enterprise.\" Commander William Riker of the Starship Enterprise.','string','english','yes'),(30,3,'body_class','','','string','english','yes');
/*!40000 ALTER TABLE `fuel_page_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_pages`
--

DROP TABLE IF EXISTS `fuel_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Add the part of the url after the root of your site (usually after the domain name). For the homepage, just put the word ''home''',
  `layout` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'The name of the template to associate with this page',
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'A ''yes'' value will display the page and an ''no'' value will give a 404 error message',
  `cache` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes' COMMENT 'Cache controls whether the page will pull from the database or from a saved file which is more effeicent. If a page has content that is dynamic, it''s best to set cache to ''no''',
  `date_added` datetime DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_modified_by` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `location` (`location`),
  KEY `layout` (`layout`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_pages`
--

LOCK TABLES `fuel_pages` WRITE;
/*!40000 ALTER TABLE `fuel_pages` DISABLE KEYS */;
INSERT INTO `fuel_pages` VALUES (1,'chris','main','yes','yes','2013-05-12 15:50:40','2013-05-12 15:50:40',3),(2,'development','main','yes','yes','2013-06-01 13:57:47','2013-06-01 14:06:47',1),(3,'terms','main','yes','yes','2013-08-05 10:47:56','2013-08-05 10:48:49',1);
/*!40000 ALTER TABLE `fuel_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_permissions`
--

DROP TABLE IF EXISTS `fuel_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'In most cases, this should be the name of the module (e.g. news)',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_permissions`
--

LOCK TABLES `fuel_permissions` WRITE;
/*!40000 ALTER TABLE `fuel_permissions` DISABLE KEYS */;
INSERT INTO `fuel_permissions` VALUES (1,'Pages','pages','yes'),(2,'Pages: Create','pages/create','yes'),(3,'Pages: Edit','pages/edit','yes'),(4,'Pages: Publish','pages/publish','yes'),(5,'Pages: Delete','pages/delete','yes'),(6,'Blocks','blocks','yes'),(7,'Blocks: Create','blocks/create','yes'),(8,'Blocks: Edit','blocks/edit','yes'),(9,'Blocks: Publish','blocks/publish','yes'),(10,'Blocks: Delete','blocks/delete','yes'),(11,'Navigation','navigation','yes'),(12,'Navigation: Create','navigation/create','yes'),(13,'Navigation: Edit','navigation/edit','yes'),(14,'Navigation: Publish','navigation/publish','yes'),(15,'Navigation: Delete','navigation/delete','yes'),(16,'Categories','categories','yes'),(17,'Categories: Create','categories/create','yes'),(18,'Categories: Edit','categories/edit','yes'),(19,'Categories: Publish','categories/publish','yes'),(20,'Categories: Delete','categories/delete','yes'),(21,'Tags','tags','yes'),(22,'Tags: Create','tags/create','yes'),(23,'Tags: Edit','tags/edit','yes'),(24,'Tags: Publish','tags/publish','yes'),(25,'Tags: Delete','tags/delete','yes'),(26,'Site Variables','sitevariables','yes'),(27,'Assets','assets','yes'),(28,'Site Documentation','site_docs','yes'),(29,'Users','users','yes'),(30,'Permissions','permissions','yes'),(31,'Cache','cache','yes'),(32,'Logs','logs','yes'),(33,'Settings','settings','yes'),(34,'Generate Code','generate','yes'),(35,'Clubs','Clubs','yes'),(36,'Clubs: Create','Clubs/create','yes'),(37,'Clubs: Edit','Clubs/edit','yes'),(38,'Clubs: Publish','Clubs/publish','yes'),(39,'Clubs: Delete','Clubs/delete','yes'),(40,'Blog Categories','blog_categories','yes'),(41,'Blog Categories: Create','blog_categories/create','yes'),(42,'Blog Categories: Delete','blog_categories/delete','yes'),(43,'Blog Categories: Edit','blog_categories/edit','yes'),(44,'Blog Categories: Publish','blog_categories/publish','yes'),(45,'Blog Comments','blog_comments','yes'),(46,'Blog Comments: Create','blog_comments/create','yes'),(47,'Blog Comments: Delete','blog_comments/delete','yes'),(48,'Blog Comments: Edit','blog_comments/edit','yes'),(49,'Blog Comments: Publish','blog_comments/publish','yes'),(50,'Blog Links','blog_links','yes'),(51,'Blog Links: Create','blog_links/create','yes'),(52,'Blog Links: Delete','blog_links/delete','yes'),(53,'Blog Links: Edit','blog_links/edit','yes'),(54,'Blog Links: Publish','blog_links/publish','yes'),(55,'Blog Posts','blog_posts','yes'),(56,'Blog Posts: Create','blog_posts/create','yes'),(57,'Blog Posts: Delete','blog_posts/delete','yes'),(58,'Blog Posts: Edit','blog_posts/edit','yes'),(59,'Blog Posts: Publish','blog_posts/publish','yes'),(60,'Blog Users','blog_users','yes'),(61,'Blog Users: Create','blog_users/create','yes'),(62,'Blog Users: Delete','blog_users/delete','yes'),(63,'Blog Users: Edit','blog_users/edit','yes'),(64,'Blog Users: Publish','blog_users/publish','yes'),(65,'Blog Settings','blog/settings','yes');
/*!40000 ALTER TABLE `fuel_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_relationships`
--

DROP TABLE IF EXISTS `fuel_relationships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_relationships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `candidate_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `candidate_key` int(11) NOT NULL,
  `foreign_table` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foreign_key` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=148 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_relationships`
--

LOCK TABLES `fuel_relationships` WRITE;
/*!40000 ALTER TABLE `fuel_relationships` DISABLE KEYS */;
INSERT INTO `fuel_relationships` VALUES (1,'fuel_users',2,'fuel_permissions',27),(2,'fuel_users',2,'fuel_permissions',6),(3,'fuel_users',2,'fuel_permissions',7),(4,'fuel_users',2,'fuel_permissions',10),(5,'fuel_users',2,'fuel_permissions',8),(6,'fuel_users',2,'fuel_permissions',9),(7,'fuel_users',2,'fuel_permissions',31),(8,'fuel_users',2,'fuel_permissions',16),(9,'fuel_users',2,'fuel_permissions',17),(10,'fuel_users',2,'fuel_permissions',20),(11,'fuel_users',2,'fuel_permissions',18),(12,'fuel_users',2,'fuel_permissions',19),(13,'fuel_users',2,'fuel_permissions',34),(14,'fuel_users',2,'fuel_permissions',32),(15,'fuel_users',2,'fuel_permissions',11),(16,'fuel_users',2,'fuel_permissions',12),(17,'fuel_users',2,'fuel_permissions',15),(18,'fuel_users',2,'fuel_permissions',13),(19,'fuel_users',2,'fuel_permissions',14),(20,'fuel_users',2,'fuel_permissions',1),(21,'fuel_users',2,'fuel_permissions',2),(22,'fuel_users',2,'fuel_permissions',5),(23,'fuel_users',2,'fuel_permissions',3),(24,'fuel_users',2,'fuel_permissions',4),(25,'fuel_users',2,'fuel_permissions',30),(26,'fuel_users',2,'fuel_permissions',33),(27,'fuel_users',2,'fuel_permissions',28),(28,'fuel_users',2,'fuel_permissions',26),(29,'fuel_users',2,'fuel_permissions',21),(30,'fuel_users',2,'fuel_permissions',22),(31,'fuel_users',2,'fuel_permissions',25),(32,'fuel_users',2,'fuel_permissions',23),(33,'fuel_users',2,'fuel_permissions',24),(34,'fuel_users',2,'fuel_permissions',29),(35,'fuel_users',3,'fuel_permissions',27),(36,'fuel_users',3,'fuel_permissions',6),(37,'fuel_users',3,'fuel_permissions',7),(38,'fuel_users',3,'fuel_permissions',10),(39,'fuel_users',3,'fuel_permissions',8),(40,'fuel_users',3,'fuel_permissions',9),(41,'fuel_users',3,'fuel_permissions',31),(42,'fuel_users',3,'fuel_permissions',16),(43,'fuel_users',3,'fuel_permissions',17),(44,'fuel_users',3,'fuel_permissions',20),(45,'fuel_users',3,'fuel_permissions',18),(46,'fuel_users',3,'fuel_permissions',19),(47,'fuel_users',3,'fuel_permissions',34),(48,'fuel_users',3,'fuel_permissions',32),(49,'fuel_users',3,'fuel_permissions',11),(50,'fuel_users',3,'fuel_permissions',12),(51,'fuel_users',3,'fuel_permissions',15),(52,'fuel_users',3,'fuel_permissions',13),(53,'fuel_users',3,'fuel_permissions',14),(54,'fuel_users',3,'fuel_permissions',1),(55,'fuel_users',3,'fuel_permissions',2),(56,'fuel_users',3,'fuel_permissions',5),(57,'fuel_users',3,'fuel_permissions',3),(58,'fuel_users',3,'fuel_permissions',4),(59,'fuel_users',3,'fuel_permissions',30),(60,'fuel_users',3,'fuel_permissions',33),(61,'fuel_users',3,'fuel_permissions',28),(62,'fuel_users',3,'fuel_permissions',26),(63,'fuel_users',3,'fuel_permissions',21),(64,'fuel_users',3,'fuel_permissions',22),(65,'fuel_users',3,'fuel_permissions',25),(66,'fuel_users',3,'fuel_permissions',23),(67,'fuel_users',3,'fuel_permissions',24),(68,'fuel_users',3,'fuel_permissions',29),(69,'fuel_users',4,'fuel_permissions',27),(70,'fuel_users',4,'fuel_permissions',6),(71,'fuel_users',4,'fuel_permissions',7),(72,'fuel_users',4,'fuel_permissions',10),(73,'fuel_users',4,'fuel_permissions',8),(74,'fuel_users',4,'fuel_permissions',9),(75,'fuel_users',4,'fuel_permissions',31),(76,'fuel_users',4,'fuel_permissions',16),(77,'fuel_users',4,'fuel_permissions',17),(78,'fuel_users',4,'fuel_permissions',20),(79,'fuel_users',4,'fuel_permissions',18),(80,'fuel_users',4,'fuel_permissions',19),(81,'fuel_users',4,'fuel_permissions',34),(82,'fuel_users',4,'fuel_permissions',32),(83,'fuel_users',4,'fuel_permissions',11),(84,'fuel_users',4,'fuel_permissions',12),(85,'fuel_users',4,'fuel_permissions',15),(86,'fuel_users',4,'fuel_permissions',13),(87,'fuel_users',4,'fuel_permissions',14),(88,'fuel_users',4,'fuel_permissions',1),(89,'fuel_users',4,'fuel_permissions',2),(90,'fuel_users',4,'fuel_permissions',5),(91,'fuel_users',4,'fuel_permissions',3),(92,'fuel_users',4,'fuel_permissions',4),(93,'fuel_users',4,'fuel_permissions',30),(94,'fuel_users',4,'fuel_permissions',33),(95,'fuel_users',4,'fuel_permissions',28),(96,'fuel_users',4,'fuel_permissions',26),(97,'fuel_users',4,'fuel_permissions',21),(98,'fuel_users',4,'fuel_permissions',22),(99,'fuel_users',4,'fuel_permissions',25),(100,'fuel_users',4,'fuel_permissions',23),(101,'fuel_users',4,'fuel_permissions',24),(102,'fuel_users',4,'fuel_permissions',29),(108,'fuel_users',4,'fuel_permissions',35),(107,'fuel_users',3,'fuel_permissions',35),(106,'fuel_users',2,'fuel_permissions',35),(109,'fuel_users',3,'fuel_permissions',27),(110,'fuel_users',3,'fuel_permissions',6),(111,'fuel_users',3,'fuel_permissions',7),(112,'fuel_users',3,'fuel_permissions',10),(113,'fuel_users',3,'fuel_permissions',8),(114,'fuel_users',3,'fuel_permissions',9),(115,'fuel_users',3,'fuel_permissions',31),(116,'fuel_users',3,'fuel_permissions',16),(117,'fuel_users',3,'fuel_permissions',17),(118,'fuel_users',3,'fuel_permissions',20),(119,'fuel_users',3,'fuel_permissions',18),(120,'fuel_users',3,'fuel_permissions',19),(121,'fuel_users',3,'fuel_permissions',35),(122,'fuel_users',3,'fuel_permissions',36),(123,'fuel_users',3,'fuel_permissions',39),(124,'fuel_users',3,'fuel_permissions',37),(125,'fuel_users',3,'fuel_permissions',38),(126,'fuel_users',3,'fuel_permissions',34),(127,'fuel_users',3,'fuel_permissions',32),(128,'fuel_users',3,'fuel_permissions',11),(129,'fuel_users',3,'fuel_permissions',12),(130,'fuel_users',3,'fuel_permissions',15),(131,'fuel_users',3,'fuel_permissions',13),(132,'fuel_users',3,'fuel_permissions',14),(133,'fuel_users',3,'fuel_permissions',1),(134,'fuel_users',3,'fuel_permissions',2),(135,'fuel_users',3,'fuel_permissions',5),(136,'fuel_users',3,'fuel_permissions',3),(137,'fuel_users',3,'fuel_permissions',4),(138,'fuel_users',3,'fuel_permissions',30),(139,'fuel_users',3,'fuel_permissions',33),(140,'fuel_users',3,'fuel_permissions',28),(141,'fuel_users',3,'fuel_permissions',26),(142,'fuel_users',3,'fuel_permissions',21),(143,'fuel_users',3,'fuel_permissions',22),(144,'fuel_users',3,'fuel_permissions',25),(145,'fuel_users',3,'fuel_permissions',23),(146,'fuel_users',3,'fuel_permissions',24),(147,'fuel_users',3,'fuel_permissions',29);
/*!40000 ALTER TABLE `fuel_relationships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_settings`
--

DROP TABLE IF EXISTS `fuel_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `key` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `value` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `module` (`module`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_settings`
--

LOCK TABLES `fuel_settings` WRITE;
/*!40000 ALTER TABLE `fuel_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_site_variables`
--

DROP TABLE IF EXISTS `fuel_site_variables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_site_variables` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'leave blank if you want the variable to be available to all pages',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_site_variables`
--

LOCK TABLES `fuel_site_variables` WRITE;
/*!40000 ALTER TABLE `fuel_site_variables` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_site_variables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_tags`
--

DROP TABLE IF EXISTS `fuel_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `precedence` int(11) NOT NULL,
  `published` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_tags`
--

LOCK TABLES `fuel_tags` WRITE;
/*!40000 ALTER TABLE `fuel_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `fuel_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_users`
--

DROP TABLE IF EXISTS `fuel_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fuel_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `reset_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `super_admin` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `active` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_users`
--

LOCK TABLES `fuel_users` WRITE;
/*!40000 ALTER TABLE `fuel_users` DISABLE KEYS */;
INSERT INTO `fuel_users` VALUES (1,'admin','451ad1865534d51d972a27d4230e27fdac5c1fb5','dave_gill@blueyonder.co.uk','Admin','test','english','','3c795ae289539f5fd703c33b88459f6d','yes','yes'),(2,'ross','5eca8b95581dce834e147cbcae35a5fa3f966a50','rchernin92@gmail.com','Ross','Chernin','','','c07f8675e2f031cd607ea32e268a8c6f','yes','yes'),(3,'chris','1ddab0ac1666759fc7e048064136c3dc6d690976','fitzos@improvewithchris.com','Chris','Johnson','','','87e6cffd13278df1a57c42741e779fa5','yes','yes'),(4,'jim','361ecba523a6157719535b0ed91fa0d03a116568','orione96@gmail.com','Jim','Xue','','','1415c1dc9f971e79e8a61b6a36b1e6bc','yes','yes');
/*!40000 ALTER TABLE `fuel_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_table_name` varchar(45) DEFAULT NULL,
  `from_table_id` int(11) DEFAULT NULL,
  `to_table_name` varchar(45) DEFAULT NULL,
  `to_table_id` int(11) DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` enum('yes','no') DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (1,'yes','Dave','Gill','english','7215495cae791941ce539f009fa8a7c4','dave_gill@blueyonder.co.uk','6b2985d2607c5690b2f5ba02a3d45abe');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `from_table` varchar(45) DEFAULT NULL,
  `from_key` int(11) DEFAULT NULL,
  `to_table` varchar(45) DEFAULT NULL,
  `to_key` int(11) DEFAULT NULL,
  `notification` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `published` enum('yes','no') DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `read` tinyint(4) DEFAULT NULL,
  `type` enum('AD','NOTE','MESSAGE') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_fields`
--

DROP TABLE IF EXISTS `profile_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(45) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `field` varchar(45) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_fields`
--

LOCK TABLES `profile_fields` WRITE;
/*!40000 ALTER TABLE `profile_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `profile_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resume`
--

DROP TABLE IF EXISTS `resume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `athlete_id` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `description` text,
  `summary` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resume`
--

LOCK TABLES `resume` WRITE;
/*!40000 ALTER TABLE `resume` DISABLE KEYS */;
/*!40000 ALTER TABLE `resume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport`
--

DROP TABLE IF EXISTS `sport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport`
--

LOCK TABLES `sport` WRITE;
/*!40000 ALTER TABLE `sport` DISABLE KEYS */;
/*!40000 ALTER TABLE `sport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sport_statistics`
--

DROP TABLE IF EXISTS `sport_statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sport_statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sport_id` int(11) DEFAULT NULL,
  `statistic_name` varchar(45) DEFAULT NULL,
  `max_value` varchar(45) DEFAULT NULL,
  `min_value` varchar(45) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sport_statistics`
--

LOCK TABLES `sport_statistics` WRITE;
/*!40000 ALTER TABLE `sport_statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `sport_statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_table` varchar(45) DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `statistic_name` varchar(45) DEFAULT NULL,
  `statistic_value` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistics`
--

LOCK TABLES `statistics` WRITE;
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `content` text,
  `date` timestamp NULL DEFAULT NULL,
  `active` enum('yes','no') DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `last_modified` timestamp NULL DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainer`
--

DROP TABLE IF EXISTS `trainer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trainer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` enum('yes','no') DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `salt` varchar(32) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `content` text,
  `qualifications` varchar(255) DEFAULT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `accreditations` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainer`
--

LOCK TABLES `trainer` WRITE;
/*!40000 ALTER TABLE `trainer` DISABLE KEYS */;
/*!40000 ALTER TABLE `trainer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-13  8:06:26
