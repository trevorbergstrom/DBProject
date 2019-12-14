-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: ix-dev    Database: war_planes
-- ------------------------------------------------------
-- Server version	5.7.27

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
-- Table structure for table `Aircraft`
--

DROP TABLE IF EXISTS `Aircraft`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aircraft` (
  `ac_id` int(11) NOT NULL AUTO_INCREMENT,
  `Designation` varchar(32) DEFAULT NULL,
  `NATO_name` varchar(255) NOT NULL,
  `service_celing` int(11) DEFAULT NULL,
  `max_speed` int(11) DEFAULT NULL,
  `crew_count` int(11) DEFAULT NULL,
  `range` int(11) DEFAULT NULL,
  `cruise_speed` int(11) DEFAULT NULL,
  `date_enter_service` datetime DEFAULT NULL,
  `m_id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `origin_c_id` int(11) NOT NULL,
  `img_link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ac_id`),
  KEY `fk_Aircraft_Manufact1_idx` (`m_id`),
  KEY `fk_Aircraft_Mission_designation1_idx` (`mission_id`),
  KEY `fk_Aircraft_Country1_idx` (`origin_c_id`),
  CONSTRAINT `fk_Aircraft_Country1` FOREIGN KEY (`origin_c_id`) REFERENCES `Country` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aircraft_Manufact1` FOREIGN KEY (`m_id`) REFERENCES `Manufact` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aircraft_Mission_designation1` FOREIGN KEY (`mission_id`) REFERENCES `Mission_designation` (`mission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aircraft_Used_By_Country`
--

DROP TABLE IF EXISTS `Aircraft_Used_By_Country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aircraft_Used_By_Country` (
  `ac_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`ac_id`,`c_id`),
  KEY `fk_Aircraft_has_Country_Country1_idx` (`c_id`),
  KEY `fk_Aircraft_has_Country_Aircraft1_idx` (`ac_id`),
  CONSTRAINT `fk_Aircraft_has_Country_Aircraft1` FOREIGN KEY (`ac_id`) REFERENCES `Aircraft` (`ac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aircraft_has_Country_Country1` FOREIGN KEY (`c_id`) REFERENCES `Country` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aircraft_has_Armament`
--

DROP TABLE IF EXISTS `Aircraft_has_Armament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aircraft_has_Armament` (
  `ac_id` int(11) NOT NULL,
  `arm_id` int(11) NOT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`ac_id`,`arm_id`),
  KEY `fk_Aircraft_has_Armament_Armament1_idx` (`arm_id`),
  KEY `fk_Aircraft_has_Armament_Aircraft_idx` (`ac_id`),
  CONSTRAINT `fk_Aircraft_has_Armament_Aircraft` FOREIGN KEY (`ac_id`) REFERENCES `Aircraft` (`ac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aircraft_has_Armament_Armament1` FOREIGN KEY (`arm_id`) REFERENCES `Armament` (`arm_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Aircraft_has_Engine`
--

DROP TABLE IF EXISTS `Aircraft_has_Engine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Aircraft_has_Engine` (
  `ac_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `engine_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`ac_id`,`e_id`),
  KEY `fk_Aircraft_has_Engine_Engine1_idx` (`e_id`),
  KEY `fk_Aircraft_has_Engine_Aircraft1_idx` (`ac_id`),
  CONSTRAINT `fk_Aircraft_has_Engine_Aircraft1` FOREIGN KEY (`ac_id`) REFERENCES `Aircraft` (`ac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Aircraft_has_Engine_Engine1` FOREIGN KEY (`e_id`) REFERENCES `Engine` (`e_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Armament`
--

DROP TABLE IF EXISTS `Armament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Armament` (
  `arm_id` int(11) NOT NULL AUTO_INCREMENT,
  `caliber` decimal(2,0) DEFAULT NULL,
  `weight` decimal(2,0) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`arm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Country`
--

DROP TABLE IF EXISTS `Country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Country` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `continent` varchar(255) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Engine`
--

DROP TABLE IF EXISTS `Engine`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Engine` (
  `e_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `output_power` varchar(45) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `m_id` int(11) NOT NULL,
  PRIMARY KEY (`e_id`),
  KEY `fk_Engine_Manufact1_idx` (`m_id`),
  CONSTRAINT `fk_Engine_Manufact1` FOREIGN KEY (`m_id`) REFERENCES `Manufact` (`m_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Manufact`
--

DROP TABLE IF EXISTS `Manufact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Manufact` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `c_id` int(11) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  KEY `fk_Manufact_Country1_idx` (`c_id`),
  CONSTRAINT `fk_Manufact_Country1` FOREIGN KEY (`c_id`) REFERENCES `Country` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Mission_designation`
--

DROP TABLE IF EXISTS `Mission_designation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Mission_designation` (
  `mission_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`mission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-13 15:23:43
