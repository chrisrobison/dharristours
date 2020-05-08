-- MySQL dump 10.13  Distrib 8.0.19, for Linux (x86_64)
--
-- Host: localhost    Database: mail
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alias`
--

DROP TABLE IF EXISTS `alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alias` (
  `aliasID` int unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL DEFAULT '',
  `domain` varchar(100) NOT NULL DEFAULT '',
  `routeto` text,
  `client` varchar(50) NOT NULL DEFAULT '',
  `adminuser` varchar(200) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`aliasID`),
  KEY `alias` (`alias`),
  KEY `domain` (`domain`),
  KEY `client` (`client`),
  KEY `active` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=1107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alias`
--

LOCK TABLES `alias` WRITE;
/*!40000 ALTER TABLE `alias` DISABLE KEYS */;
INSERT INTO `alias` VALUES (1104,'chris','dharristours.com','cdr@dharristours.com','cdr','cdr',1),(1105,'sales','dharristours.com','juanaharrisdht@att.net','cdr','cdr',1),(1106,'info','dharristours.com','juanaharrisdht@att.net','cdr','cdr',1);
/*!40000 ALTER TABLE `alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domain` (
  `domainID` int NOT NULL AUTO_INCREMENT,
  `domain` varchar(35) NOT NULL DEFAULT '',
  `parent` varchar(100) NOT NULL DEFAULT '',
  `client` varchar(13) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT 'local',
  `virus` varchar(25) NOT NULL DEFAULT 'true',
  `spam` varchar(25) NOT NULL DEFAULT '5.0',
  `adminuser` varchar(100) NOT NULL DEFAULT '',
  `userdir` varchar(150) NOT NULL DEFAULT '',
  `mailhost` varchar(50) NOT NULL DEFAULT 'ns',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`domainID`),
  KEY `client` (`client`),
  KEY `domainType` (`domain`,`type`),
  KEY `domain` (`domain`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=210 DEFAULT CHARSET=latin1 COMMENT='Local, virtual, and domains the mail server will relay for';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES (207,'dharristours.com','','cdr','mail','1','5','cdr,patrick','/home/cdr/domains/dharristours.com/users/','mail.dharristours.com',1),(208,'heyshutupandlisten.com','','cdr','mail','1','5','cdr,patrick','/home/cdr/domains/heyshutupandlisten.com/users/','mail.heyshutupandlisten.com',1),(209,'evesdad.com','','patrick','mail','1','5','cdr,patrick','/home/patrick/domains/evesdad.com/users/','mail.evesdad.com',1);
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domainalias`
--

DROP TABLE IF EXISTS `domainalias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domainalias` (
  `domainaliasID` int NOT NULL AUTO_INCREMENT,
  `domainalias` varchar(200) NOT NULL,
  `domainID` int NOT NULL,
  `owner` varchar(200) NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`domainaliasID`),
  KEY `domainalias` (`domainalias`),
  KEY `domainID` (`domainID`),
  KEY `active` (`active`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domainalias`
--

LOCK TABLES `domainalias` WRITE;
/*!40000 ALTER TABLE `domainalias` DISABLE KEYS */;
/*!40000 ALTER TABLE `domainalias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expires`
--

DROP TABLE IF EXISTS `expires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expires` (
  `user` varchar(100) NOT NULL,
  `mailbox` varchar(255) NOT NULL,
  `expire_stamp` int NOT NULL,
  PRIMARY KEY (`user`,`mailbox`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expires`
--

LOCK TABLES `expires` WRITE;
/*!40000 ALTER TABLE `expires` DISABLE KEYS */;
/*!40000 ALTER TABLE `expires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `greylist`
--

DROP TABLE IF EXISTS `greylist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `greylist` (
  `id` varchar(200) NOT NULL,
  `expire` int DEFAULT NULL,
  `host` varchar(200) DEFAULT NULL,
  `helo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `greylist`
--

LOCK TABLES `greylist` WRITE;
/*!40000 ALTER TABLE `greylist` DISABLE KEYS */;
/*!40000 ALTER TABLE `greylist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota`
--

DROP TABLE IF EXISTS `quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quota` (
  `user` varchar(100) NOT NULL,
  `bytes` bigint NOT NULL DEFAULT '0',
  `messages` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota`
--

LOCK TABLES `quota` WRITE;
/*!40000 ALTER TABLE `quota` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resenders`
--

DROP TABLE IF EXISTS `resenders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `resenders` (
  `host` varchar(254) NOT NULL,
  `helo` varchar(254) NOT NULL,
  `time` int DEFAULT NULL,
  PRIMARY KEY (`host`,`helo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resenders`
--

LOCK TABLES `resenders` WRITE;
/*!40000 ALTER TABLE `resenders` DISABLE KEYS */;
/*!40000 ALTER TABLE `resenders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sender_reject`
--

DROP TABLE IF EXISTS `sender_reject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sender_reject` (
  `sender` varchar(150) NOT NULL DEFAULT '',
  `submitted_by` varchar(50) NOT NULL DEFAULT '',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sender`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sender_reject`
--

LOCK TABLES `sender_reject` WRITE;
/*!40000 ALTER TABLE `sender_reject` DISABLE KEYS */;
/*!40000 ALTER TABLE `sender_reject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userID` int NOT NULL AUTO_INCREMENT,
  `accountID` int NOT NULL DEFAULT '0',
  `client` varchar(50) NOT NULL DEFAULT '',
  `uid` int NOT NULL DEFAULT '0',
  `gid` int unsigned NOT NULL DEFAULT '0',
  `domain` varchar(75) NOT NULL DEFAULT 'netoasis.net',
  `user` varchar(25) NOT NULL DEFAULT '',
  `id` varchar(150) NOT NULL DEFAULT '',
  `passwd` varchar(50) NOT NULL DEFAULT '',
  `crypted` varchar(200) NOT NULL,
  `type` varchar(25) NOT NULL DEFAULT '',
  `quota` varchar(25) NOT NULL DEFAULT '',
  `dir` varchar(100) NOT NULL DEFAULT '',
  `basedir` varchar(75) NOT NULL DEFAULT '',
  `maildir` varchar(100) NOT NULL DEFAULT '',
  `shell` varchar(75) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `defaultdelivery` varchar(150) NOT NULL DEFAULT '',
  `alt_email` varchar(100) NOT NULL DEFAULT '',
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `cdrmail` tinyint(1) NOT NULL DEFAULT '1',
  `userKey` varchar(50) NOT NULL DEFAULT '',
  `server` varchar(50) DEFAULT 'mail',
  `servertype` varchar(50) DEFAULT 'maildir',
  `maillogin` varchar(50) NOT NULL DEFAULT '',
  `dosetup` tinyint(1) DEFAULT NULL,
  `folders` text,
  `jsfolders` text,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  KEY `userKey` (`userKey`),
  KEY `id` (`id`),
  KEY `user` (`user`),
  KEY `domain` (`domain`),
  KEY `passwd` (`passwd`),
  KEY `crypted` (`crypted`),
  KEY `type` (`type`),
  KEY `server` (`server`),
  KEY `servertype` (`servertype`),
  KEY `maillogin` (`maillogin`)
) ENGINE=InnoDB AUTO_INCREMENT=957 DEFAULT CHARSET=latin1 COMMENT='user email account settings';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (954,0,'cdr',1000,1000,'dharristours.com','cdr','cdr@dharristours.com','Icoancisad1!','d45a23dcae23e44bbe17f5351a0e0caafbe86682f0029f2cc96bd4186f0f59c0','maildir','','/home/cdr/domains/dharristours.com/users/cdr','','/home/cdr/domains/dharristours.com/users/cdr/Maildir','','Christopher D. Robison','','cdr@netoasis.net',1,1,'','mail.dharristours.com','maildir','cdr@dharristours.com',NULL,NULL,NULL,'2020-03-26 23:13:01','2020-03-28 05:14:46'),(955,0,'cdr',1000,1000,'dharristours.com','patrick','patrick@dharristours.com','iapplmi1!','2c78aa1ca1da780f345610898032021e5d4c643e334e5d0844beff00','maildir','','/home/cdr/domains/dharristours.com/users/patrick','','/home/cdr/domains/dharristours.com/users/patrick/Maildir','','Patrick Peterson','','patrickmp@gmail.com',1,1,'','mail.dharristours.com','maildir','cdr@dharristours.com',NULL,NULL,NULL,'2020-03-27 16:30:51','2020-03-28 05:15:13'),(956,0,'cdr',1000,1000,'heyshutupandlisten.com','kathy','kathy@heyshutupandlisten.com','iakrlmi!','56ed25b138ea9adbe8fe7ded6769c456f1b1fd115529612c00df7fa9826280b3','maildir','','/home/cdr/domains/heyshutupandlisten.com/users/kathy','','/home/cdr/domains/heyshutupandlisten.com/users/kathy/Maildir','','Katherine Rodriguez','','kathotrod@gmail.com',1,1,'','mail.heyshutupandlisten.com','maildir','kathy@heyshutupandlisten.com',NULL,NULL,NULL,'2020-04-25 16:05:24','2020-04-25 23:05:24');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userpref`
--

DROP TABLE IF EXISTS `userpref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `userpref` (
  `user` varchar(32) NOT NULL DEFAULT '',
  `domain` varchar(100) NOT NULL DEFAULT '',
  `preference` varchar(30) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT '',
  `userprefID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userprefID`),
  KEY `username` (`user`),
  KEY `domain` (`domain`),
  KEY `preference` (`preference`),
  KEY `userprefID` (`userprefID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userpref`
--

LOCK TABLES `userpref` WRITE;
/*!40000 ALTER TABLE `userpref` DISABLE KEYS */;
/*!40000 ALTER TABLE `userpref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whitelist`
--

DROP TABLE IF EXISTS `whitelist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `whitelist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(75) NOT NULL DEFAULT '*',
  `email` varchar(100) NOT NULL DEFAULT '',
  `lastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=465 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whitelist`
--

LOCK TABLES `whitelist` WRITE;
/*!40000 ALTER TABLE `whitelist` DISABLE KEYS */;
/*!40000 ALTER TABLE `whitelist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-03 15:06:24
