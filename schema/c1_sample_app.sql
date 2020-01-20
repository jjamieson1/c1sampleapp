-- MySQL dump 10.13  Distrib 5.6.33, for osx10.9 (x86_64)
--
-- Host: localhost    Database: c1_sample_app
-- ------------------------------------------------------
-- Server version	5.6.33-log

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
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `applicationId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `form` text,
  `api_key` varchar(50) DEFAULT NULL,
  `app_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`applicationId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (1,'Building Permit','Apply for a building permit','building_permit',NULL,NULL),(2,'Home Improvment','Apply for a home improvement permit','home_permit',NULL,NULL),(3,'Commissioner For Oaths','An online application to apply to be a Commissioner for Oaths','comm_oaths',NULL,NULL),(9,'Apply for a young workers permit','An online application to allow an employer to hire an under age worker','young_worker','033a6b35-108d-417f-b5c2-aafdd59ae456','144cab4e-0dd1-11e8-ba89-0ed5f89f718b');
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `approvals` (
  `approval_id` int(11) NOT NULL AUTO_INCREMENT,
  `identity_id` varchar(50) NOT NULL,
  `status` varchar(25) DEFAULT 'Pending Review',
  `applicationId` int(11) DEFAULT NULL,
  `details` text,
  `submitted_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `Approved_date` date DEFAULT NULL,
  PRIMARY KEY (`approval_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
INSERT INTO `approvals` VALUES (7,'1','PENDING',2,'Nothing yet',NULL,NULL,NULL),(10,'1','APPROVED',9,'I need it','2018-02-28',NULL,NULL);
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identity`
--

DROP TABLE IF EXISTS `identity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identity` (
  `identity_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `addressLine1` varchar(50) DEFAULT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL,
  `province` varchar(25) DEFAULT NULL,
  `postalcode` varchar(7) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `accountNumber` varchar(50) DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL,
  `c1accountId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`identity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identity`
--

LOCK TABLES `identity` WRITE;
/*!40000 ALTER TABLE `identity` DISABLE KEYS */;
INSERT INTO `identity` VALUES (1,'Jamie','Jamieson','3067377425','2446 Wallace St.','','Regina','Saskatchewan','S4N4B3','jjamie@gmail.com','12345678','1234','1980256b-0cd5-4d5b-b9b6-3c9cb8928953');
/*!40000 ALTER TABLE `identity` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-28 13:54:55
