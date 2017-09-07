-- MySQL dump 10.13  Distrib 5.6.22, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: bakou_ccc
-- ------------------------------------------------------
-- Server version	5.6.22-1+deb.sury.org~trusty+1

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
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthAssignment` (
  `itemname` varchar(64) CHARACTER SET latin1 NOT NULL,
  `userid` varchar(64) CHARACTER SET latin1 NOT NULL,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  PRIMARY KEY (`itemname`,`userid`),
  CONSTRAINT `FK_AuthAssignment` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthAssignment`
--

LOCK TABLES `AuthAssignment` WRITE;
/*!40000 ALTER TABLE `AuthAssignment` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthAssignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItem` (
  `name` varchar(64) CHARACTER SET latin1 NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET latin1,
  `bizrule` text CHARACTER SET latin1,
  `data` text CHARACTER SET latin1,
  `sort_order` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItem`
--

LOCK TABLES `AuthItem` WRITE;
/*!40000 ALTER TABLE `AuthItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AuthItemChild` (
  `parent` varchar(64) CHARACTER SET latin1 NOT NULL,
  `child` varchar(64) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AuthItemChild`
--

LOCK TABLES `AuthItemChild` WRITE;
/*!40000 ALTER TABLE `AuthItemChild` DISABLE KEYS */;
/*!40000 ALTER TABLE `AuthItemChild` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color_code`
--

DROP TABLE IF EXISTS `color_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `no` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `col` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `col_description` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qual` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `upate_at` datetime DEFAULT NULL,
  `color_code_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barcode_indx` (`barcode_number`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color_code`
--

LOCK TABLES `color_code` WRITE;
/*!40000 ALTER TABLE `color_code` DISABLE KEYS */;
INSERT INTO `color_code` VALUES (1,'11111','SD99C60','L','NB','Navy Black','','0','2015-07-02 05:44:03','2015-07-02 05:44:03','#000080'),(2,'22222','SD99C60','XL','B','Black','','1','2015-07-02 05:48:10','2015-07-02 05:48:10','#800000'),(3,'33333','SD99C60','M','S','Silver','','1','2015-07-02 10:00:11','2015-07-02 10:00:11','#a52a2a'),(4,'44444','','XXL','W','White','','1','2015-07-02 23:01:05','2015-07-02 23:01:05','pink');
/*!40000 ALTER TABLE `color_code` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `color_reader`
--

DROP TABLE IF EXISTS `color_reader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `color_reader` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `color_code_id` int(11) NOT NULL,
  `target_color_code_id` int(11) NOT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `color_reader`
--

LOCK TABLES `color_reader` WRITE;
/*!40000 ALTER TABLE `color_reader` DISABLE KEYS */;
INSERT INTO `color_reader` VALUES (1,1,4,'2015-07-02 23:42:56','2015-07-02 23:42:56',2),(2,4,4,'2015-07-02 23:44:57','2015-07-02 23:44:57',2),(3,1,4,'2015-07-02 23:50:20','2015-07-02 23:50:20',2),(4,4,4,'2015-07-02 23:50:53','2015-07-02 23:50:53',2),(5,2,3,'2015-07-02 23:51:44','2015-07-02 23:51:44',2),(6,3,3,'2015-07-02 23:51:54','2015-07-02 23:51:54',2),(7,3,4,'2015-07-03 02:16:27','2015-07-03 02:16:27',2),(8,3,4,'2015-07-03 02:16:35','2015-07-03 02:16:35',2),(9,3,4,'2015-07-03 02:16:53','2015-07-03 02:16:53',2),(10,3,4,'2015-07-03 02:18:41','2015-07-03 02:18:41',2),(11,3,4,'2015-07-03 02:19:53','2015-07-03 02:19:53',2),(12,3,4,'2015-07-03 02:20:51','2015-07-03 02:20:51',2),(13,3,4,'2015-07-03 02:21:57','2015-07-03 02:21:57',2),(14,1,2,'2015-07-03 04:31:05','2015-07-03 04:31:05',2),(15,2,2,'2015-07-03 04:31:11','2015-07-03 04:31:11',2),(16,4,2,'2015-07-03 04:31:18','2015-07-03 04:31:18',2),(17,4,2,'2015-07-18 05:12:10','2015-07-18 05:12:10',2),(18,4,2,'2015-07-18 05:12:23','2015-07-18 05:12:23',2);
/*!40000 ALTER TABLE `color_reader` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dob` date DEFAULT NULL,
  `mobile_no` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `adddress1` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `address2` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `country_code` varchar(2) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `notes` text CHARACTER SET utf8,
  `status` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'Owner','System',NULL,'012999068','','',NULL,'','','','1'),(2,'Super','super','1970-01-01','016999963','super addresss1','super address',NULL,'','','','1');
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee_image`
--

DROP TABLE IF EXISTS `employee_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `photo` blob NOT NULL,
  `thumbnail` blob,
  `filename` varchar(30) CHARACTER SET latin1 NOT NULL,
  `filetype` varchar(15) CHARACTER SET latin1 DEFAULT NULL,
  `path` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `width` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `height` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_employee_image_emp_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee_image`
--

LOCK TABLES `employee_image` WRITE;
/*!40000 ALTER TABLE `employee_image` DISABLE KEYS */;
/*!40000 ALTER TABLE `employee_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `item_number` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `size_id` smallint(6) NOT NULL,
  `color_id` smallint(6) DEFAULT NULL,
  `name` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name_jp` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_barcode_unix` (`barcode`),
  KEY `FK_size_id` (`size_id`),
  KEY `FK_color_id` (`color_id`),
  CONSTRAINT `FK_color_id` FOREIGN KEY (`color_id`) REFERENCES `item_color` (`id`),
  CONSTRAINT `FK_size_id` FOREIGN KEY (`size_id`) REFERENCES `item_size` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (1,'111111','001',1,1,'Black T-Shirt','T-shirt Black','1','2015-07-22 13:40:13','2015-07-22 13:40:13',NULL,NULL,'3170_black_tshirt.jpg'),(2,'222222','002',2,2,'shoe','shoe','1','2015-07-22 13:40:31','2015-07-22 13:40:31',NULL,NULL,'8288_shoe.jpg');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_color`
--

DROP TABLE IF EXISTS `item_color`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_color` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hex_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_color_name_unix` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_color`
--

LOCK TABLES `item_color` WRITE;
/*!40000 ALTER TABLE `item_color` DISABLE KEYS */;
INSERT INTO `item_color` VALUES (1,'NB',NULL,NULL,'1','2015-07-18 03:58:54','2015-07-18 03:58:54',NULL,NULL),(2,'R',NULL,NULL,'1','2015-07-18 05:08:20','2015-07-18 05:08:20',NULL,NULL),(3,'W','',NULL,'0','2015-07-20 09:54:41','2015-07-23 13:44:08',NULL,NULL);
/*!40000 ALTER TABLE `item_color` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_size`
--

DROP TABLE IF EXISTS `item_size`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_size` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_zie_name_unix` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_size`
--

LOCK TABLES `item_size` WRITE;
/*!40000 ALTER TABLE `item_size` DISABLE KEYS */;
INSERT INTO `item_size` VALUES (1,'M','Mango','1','2015-07-18 03:45:51','2015-07-23 13:03:55',NULL,NULL),(2,'XL','Very Large','0','2015-07-18 05:08:20','2015-07-23 13:06:18',NULL,NULL);
/*!40000 ALTER TABLE `item_size` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rbac_user`
--

DROP TABLE IF EXISTS `rbac_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rbac_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) CHARACTER SET utf8 NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `user_password` varchar(128) CHARACTER SET utf8 NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  `date_entered` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_indx` (`user_name`),
  KEY `FK_rbac_user_group_id` (`group_id`),
  KEY `FK_rbac_user_employee_id` (`employee_id`),
  CONSTRAINT `FK_rbac_user_emp_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rbac_user`
--

LOCK TABLES `rbac_user` WRITE;
/*!40000 ALTER TABLE `rbac_user` DISABLE KEYS */;
INSERT INTO `rbac_user` VALUES (2,'admin',NULL,1,'$2a$08$mVfZ0ZgpzQkw9zDRYFKzUunVTh8pxTBhJoikVwjoQ9TVGb4zDtIMS',0,1,NULL,'2015-02-15 16:08:19',NULL),(3,'super',NULL,2,'$2a$08$FyizoJZyZAE7.FiumWcHOerQydWMvSKO/onI2aqke.g2x.R4V09ZW',0,1,'2013-10-10 09:44:04','2015-06-03 10:26:38',NULL);
/*!40000 ALTER TABLE `rbac_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` char(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('f2a3kevjonl5pd5nu21b68doe3',1437876185,'9276711b8da015c0887e25c196dc6fc2__isAdmin|b:0;');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_key` (`category`,`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_audit_logs`
--

DROP TABLE IF EXISTS `tbl_audit_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_audit_logs` (
  `unique_id` varbinary(30) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ipaddress` varchar(50) CHARACTER SET latin1 NOT NULL,
  `logtime` datetime NOT NULL,
  `controller` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `action` varchar(255) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `details` text COLLATE utf8mb4_unicode_ci,
  `employee_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_audit_logs`
--

LOCK TABLES `tbl_audit_logs` WRITE;
/*!40000 ALTER TABLE `tbl_audit_logs` DISABLE KEYS */;
INSERT INTO `tbl_audit_logs` VALUES ('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:13','item','admin',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:16','barcodeReader','index',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:17','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:19','barcodeReader','resetSample',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:20','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:23','barcodeReader','index',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:25','barcodeReader','index',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:28','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:30','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:31','barcodeReader','scanSample',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:33','item','admin',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:39:35','item','create',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:13','item','create',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:31','item','create',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:33','item','admin',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:36','barcodeReader','index',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:37','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:38','barcodeReader','scanSample',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:40','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:42','request','suggestItem',NULL,2),('55af37916f7b1','super','192.168.10.1','2015-07-22 13:40:43','barcodeReader','add',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:39:40','barcodeReader','index',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:39:45','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:39:56','item','delete',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:39:57','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:39:59','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:04','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:06','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:16','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:21','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:25','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:40:27','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:25','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:28','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:29','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:53','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:56','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:41:58','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:16','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:18','item','create',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:20','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:23','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:26','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:27','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:30','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:31','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:34','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:36','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:42:47','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:43:15','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:43:18','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:43:21','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:43:23','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:13','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:25','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:29','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:32','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:48','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:51','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:52:52','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:53:17','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:53:20','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:54:13','site','error',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:01','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:04','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:08','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:10','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:12','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:15','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:17','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:19','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:22','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:24','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:26','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:34','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:37','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:40','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:44','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:44','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:46','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:47','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:52','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:52','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:57','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:58','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:55:59','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:27','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:30','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:31','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:32','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:32','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:33','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:34','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:35','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:37','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:39','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:39','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:42','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:43','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:44','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:46','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:47','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:48','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:49','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:50','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:50','item','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:56:57','itemSize','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:57:00','itemColor','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 10:57:02','itemSize','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 11:10:11','site','error',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 11:10:27','itemSize','admin',NULL,2),('55b061f9b8a6f','super','192.168.10.1','2015-07-23 11:19:07','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:15','barcodeReader','index',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:21','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:26','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:28','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:46','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:50','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:53:52','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:55:02','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:55:05','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:56:04','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:56:39','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:56:49','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:57:39','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:57:40','item','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:57:43','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:57:45','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:58:54','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 12:59:10','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:11','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:21','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:34','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:37','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:41','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:00:44','itemSize','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:02:15','itemSize','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:03:01','itemSize','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:03:04','itemSize','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:03:58','itemSize','view',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:04:05','itemSize','index',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:06:08','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:06:11','itemSize','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:06:19','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:17:04','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:19:43','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:19:47','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:19:52','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:13','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:16','itemSize','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:16','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:17','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:20','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:21','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:20:23','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:21:05','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:21:08','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:21:08','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:21:10','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:39','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:40','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:41','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:42','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:43','itemSize','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:43','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:45','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:47','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:48','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:51','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:53','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:54','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:55','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:56','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:57','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:23:59','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:01','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:02','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:03','itemSize','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:05','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:07','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:09','itemSize','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:09','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:11','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:12','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:15','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:21','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:22','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:28','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:30','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:33','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:37','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:38','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:24:41','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:26','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:29','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:31','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:32','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:34','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:34','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:35','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:36','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:38','itemSize','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:26:38','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:44','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:47','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:49','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:49','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:51','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:51','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:54','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:27:56','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:28:28','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:28:32','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:28:34','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:28:37','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:16','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:18','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:39','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:41','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:43','item','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:30:45','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:31:35','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:33:13','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:33:15','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:38:30','site','error',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:39:10','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:39:53','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:39:56','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:40:16','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:40:18','itemColor','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:41:08','itemColor','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:41:27','itemColor','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:41:30','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:41:32','itemColor','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:44:05','itemColor','Update',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:44:08','itemColor','view',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:44:10','itemColor','index',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:47:33','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:47:33','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:47:40','itemColor','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:47:41','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:47:55','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:03','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:03','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:07','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:08','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:10','itemColor','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:10','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:11','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:12','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:48:57','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:02','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:03','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:03','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:04','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:05','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:06','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:08','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:08','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:12','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:14','itemSize','view',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:52','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:49:58','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:23','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:26','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:29','itemColor','delete',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:29','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:37','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:41','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:42','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:50:44','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:09','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:10','itemSize','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:12','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:14','itemColor','admin',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:15','itemColor','create',NULL,2),('55b0814837964','super','192.168.10.1','2015-07-23 13:51:17','itemColor','admin',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:15:06','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:15:11','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:15:12','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:15:14','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:15:15','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:16:10','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:16:11','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:16:12','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:16:13','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:25','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:30','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:31','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:33','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:35','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:36','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:37','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:38','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:40','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:40','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:41','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:42','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:43','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:47','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:23:49','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:24:22','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:24:27','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:24:29','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:14','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:14','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:15','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:16','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:17','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:18','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:19','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:22','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:25','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:26','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:28','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:29','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:30','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:31','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:32','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:33','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:34','barcodeReader','resetSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:34','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:35','barcodeReader','scanSample',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:36','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:37','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:40','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:42','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:25:43','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:27:22','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:27:47','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:28:03','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:28:17','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:28:24','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:29:13','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:29:25','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:30:11','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:32:19','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:33:08','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:33:27','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:33:36','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:34:22','site','error',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:34:39','site','error',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:35:47','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:36:16','barcodeReader','index',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:37:51','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:37:52','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:33','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:34','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:39','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:39','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:42','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:42','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:45','request','suggestItem',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:39:46','barcodeReader','add',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:40:03','item','admin',NULL,2),('55b345893ceb8','super','192.168.10.1','2015-07-25 15:40:05','barcodeReader','index',NULL,2);
/*!40000 ALTER TABLE `tbl_audit_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction_log`
--

DROP TABLE IF EXISTS `transaction_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `target_item_id` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci DEFAULT '1',
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `create_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction_log`
--

LOCK TABLES `transaction_log` WRITE;
/*!40000 ALTER TABLE `transaction_log` DISABLE KEYS */;
INSERT INTO `transaction_log` VALUES (1,2,1,'1','2015-07-22 13:40:43','2015-07-22 13:40:43',2),(2,1,1,'1','2015-07-25 15:15:14','2015-07-25 15:15:14',2),(3,2,1,'1','2015-07-25 15:16:13','2015-07-25 15:16:13',2),(4,1,1,'1','2015-07-25 15:23:38','2015-07-25 15:23:38',2),(5,1,1,'1','2015-07-25 15:23:40','2015-07-25 15:23:40',2),(6,2,1,'1','2015-07-25 15:23:43','2015-07-25 15:23:43',2),(7,2,1,'1','2015-07-25 15:23:49','2015-07-25 15:23:49',2),(8,1,1,'1','2015-07-25 15:25:19','2015-07-25 15:25:19',2),(9,1,2,'1','2015-07-25 15:25:37','2015-07-25 15:25:37',2),(10,2,2,'1','2015-07-25 15:25:43','2015-07-25 15:25:43',2),(11,1,2,'1','2015-07-25 15:37:52','2015-07-25 15:37:52',2),(12,1,2,'1','2015-07-25 15:39:34','2015-07-25 15:39:34',2),(13,1,2,'1','2015-07-25 15:39:39','2015-07-25 15:39:39',2),(14,1,2,'1','2015-07-25 15:39:42','2015-07-25 15:39:42',2),(15,2,2,'1','2015-07-25 15:39:45','2015-07-25 15:39:45',2);
/*!40000 ALTER TABLE `transaction_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_log`
--

DROP TABLE IF EXISTS `user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_log` (
  `unique_id` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sessoin_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `last_action` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `modified_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`unique_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_log`
--

LOCK TABLES `user_log` WRITE;
/*!40000 ALTER TABLE `user_log` DISABLE KEYS */;
INSERT INTO `user_log` VALUES ('5594abc0d0771','tvn8ri73bgcdejgq1t0ujrlju5',3,2,'2015-07-02 10:10:56',NULL,'2015-07-02 04:19:31',1,'2015-07-02 03:10:56','super'),('5594cd5828c4a','vg9qrs8s2p5l45mk951jgc84t7',3,2,'2015-07-02 12:34:16',NULL,'2015-07-02 06:40:39',1,'2015-07-02 05:34:16','super'),('5594f279d0407','v9t1ilcpb7c5hrbc6kasjlgm34',3,2,'2015-07-02 15:12:41',NULL,'2015-07-02 08:22:48',1,'2015-07-02 08:12:41','super'),('5595075fa0e21','79c3b0refn6k5arqle8jeqkgc3',3,2,'2015-07-02 16:41:51',NULL,'2015-07-02 10:00:16',1,'2015-07-02 09:41:51','super'),('5595be48ec58b','f9q3bs673sjf7v71djqtklf984',3,2,'2015-07-03 05:42:16',NULL,'2015-07-02 23:51:54',1,'2015-07-02 22:42:17','super'),('5595e794de2cd','dnpnobsqcp56vvm6dlqev5vk36',3,2,'2015-07-03 08:38:28','2015-07-03 09:23:18','2015-07-03 02:23:17',0,'2015-07-03 02:23:18','super'),('5595f21972f7b','a52uste7eic5ujqc21np246gj1',3,2,'2015-07-03 09:23:21',NULL,'2015-07-03 02:32:43',1,'2015-07-03 02:23:21','super'),('55960ac689a9b','1ruoa1uk8n6cobvu42qekjelc4',3,2,'2015-07-03 11:08:38',NULL,'2015-07-03 04:31:18',1,'2015-07-03 04:08:38','super'),('559616a78f570','8f3vdfug6na0an7utf8060sio3',3,2,'2015-07-03 11:59:19',NULL,'2015-07-03 05:11:42',1,'2015-07-03 04:59:19','super'),('55962fcc18411','g7f68q8i9kuituvpu20m9bqeb0',3,2,'2015-07-03 13:46:36',NULL,'2015-07-03 06:46:36',1,'2015-07-03 06:46:36','super'),('559662d5b4839','gvp6au0jreetuk68682rt65o72',3,2,'2015-07-03 17:24:21',NULL,'2015-07-03 10:47:04',1,'2015-07-03 10:24:21','super'),('55a9b8fc4e265','18v1g0t9ekhsud3tvfu9udkl24',3,2,'2015-07-18 09:25:00',NULL,'2015-07-18 06:05:45',1,'2015-07-18 02:25:00','super'),('55aa087cb819d','u2kc2is8k919h4d82jubgv9nh5',3,2,'2015-07-18 15:04:12','2015-07-18 16:31:43','2015-07-18 09:31:16',0,'2015-07-18 09:31:43','super'),('55aa6b82914c4','6ekh5s3lafhkd052is5to2j6s3',3,2,'2015-07-18 22:06:42',NULL,'2015-07-18 16:02:05',1,'2015-07-18 15:06:42','super'),('55aa8ff74b9e9','f4sclmntnkqnptpick9kilr5g7',3,2,'2015-07-19 00:42:15',NULL,'2015-07-18 18:18:52',1,'2015-07-18 17:42:15','super'),('55aaf218513a5','7obr63sr9kf1nel1elhn1bbfo7',3,2,'2015-07-19 07:40:56','2015-07-19 07:52:08','2015-07-19 00:52:05',0,'2015-07-19 00:52:08','super'),('55aaf4bbdf26b','m8qdqhqb7e6l88977q8nugan26',3,2,'2015-07-19 07:52:11',NULL,'2015-07-19 01:01:53',1,'2015-07-19 00:52:11','super'),('55ab0808bf139','iet0rqovua0o7qru44t060jrk1',3,2,'2015-07-19 09:14:32',NULL,'2015-07-19 02:29:25',1,'2015-07-19 02:14:32','super'),('55ac586f35412','l6doootb772tccc40nplr6g4n6',3,2,'2015-07-20 09:09:51',NULL,'2015-07-20 02:12:03',1,'2015-07-20 02:09:51','super'),('55ac62d49a712','iq8bt5ovqjkkgs9i1f2nbjb9u1',3,2,'2015-07-20 09:54:12','2015-07-20 09:55:38','2015-07-20 02:55:36',0,'2015-07-20 02:55:38','super'),('55ac975e09740','pn48jk1fhi3onoeg9jdkfciis4',3,2,'2015-07-20 13:38:22',NULL,'2015-07-20 06:52:56',1,'2015-07-20 06:38:22','super'),('55aef76e49104','k8advb6v2rmfcjul23b3u63kf2',3,2,'2015-07-22 08:52:46',NULL,'2015-07-22 02:14:34',1,'2015-07-22 01:52:46','super'),('55af0306d307f','fts8v9j80vugeqm5ccinbv65d0',3,2,'2015-07-22 09:42:14',NULL,'2015-07-22 04:35:35',1,'2015-07-22 02:42:14','super'),('55af23b8bba12','a0cmeg6scvbicm30hlae107il2',3,2,'2015-07-22 12:01:44','2015-07-22 12:20:10','2015-07-22 05:19:35',0,'2015-07-22 05:20:10','super'),('55af280c411e1','nupig1g2c638cmgeruh6gkqjs6',3,2,'2015-07-22 12:20:12',NULL,'2015-07-22 05:54:11',1,'2015-07-22 05:20:12','super'),('55af37916f7b1','g3d8hklhfislrcvposj2r8kdb0',3,2,'2015-07-22 13:26:25','2015-07-22 13:40:46','2015-07-22 06:40:43',0,'2015-07-22 06:40:46','super'),('55b061f9b8a6f','k46q9t62t2dmd55qslbbpvvtl2',3,2,'2015-07-23 10:39:37',NULL,'2015-07-23 04:19:07',1,'2015-07-23 03:39:37','super'),('55b0814837964','8l4c84dqdhbvqhrnsi9g9if2r7',3,2,'2015-07-23 12:53:12','2015-07-23 13:51:20','2015-07-23 06:51:17',0,'2015-07-23 06:51:20','super'),('55b345893ceb8','e2ppcuj3neobi0if3llt44c0r0',3,2,'2015-07-25 15:15:05','2015-07-25 15:42:41','2015-07-25 08:40:05',0,'2015-07-25 08:42:41','super');
/*!40000 ALTER TABLE `user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_item`
--

DROP TABLE IF EXISTS `v_item`;
/*!50001 DROP VIEW IF EXISTS `v_item`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_item` AS SELECT 
 1 AS `item_id`,
 1 AS `name`,
 1 AS `name_jp`,
 1 AS `barcode`,
 1 AS `item_number`,
 1 AS `status`,
 1 AS `image`,
 1 AS `size`,
 1 AS `size_fullname`,
 1 AS `color_name`,
 1 AS `hex_code`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `v_transaction`
--

DROP TABLE IF EXISTS `v_transaction`;
/*!50001 DROP VIEW IF EXISTS `v_transaction`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `v_transaction` AS SELECT 
 1 AS `id`,
 1 AS `item_id`,
 1 AS `target_item_id`,
 1 AS `status_f`,
 1 AS `status`,
 1 AS `scan_status`,
 1 AS `create_at`,
 1 AS `update_at`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_item`
--

/*!50001 DROP VIEW IF EXISTS `v_item`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE 
/*!50001 VIEW `v_item` AS select `i`.`id` AS `item_id`,`i`.`name` AS `name`,`i`.`name_jp` AS `name_jp`,`i`.`barcode` AS `barcode`,`i`.`item_number` AS `item_number`,`i`.`status` AS `status`,(case when ((length(`i`.`image`) = 0) or isnull(length(`i`.`image`))) then 'no_photo.jpg' else `i`.`image` end) AS `image`,`s`.`name` AS `size`,`s`.`full_name` AS `size_fullname`,`c`.`name` AS `color_name`,`c`.`hex_code` AS `hex_code` from ((`item` `i` left join `item_size` `s` on((`s`.`id` = `i`.`size_id`))) left join `item_color` `c` on((`c`.`id` = `i`.`color_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_transaction`
--

/*!50001 DROP VIEW IF EXISTS `v_transaction`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE 
/*!50001 VIEW `v_transaction` AS select `transaction_log`.`id` AS `id`,`transaction_log`.`item_id` AS `item_id`,`transaction_log`.`target_item_id` AS `target_item_id`,(case when (`transaction_log`.`status` = '1') then 'Complete' when (`transaction_log`.`status` = '2') then 'Cancel' end) AS `status_f`,`transaction_log`.`status` AS `status`,(case when (`transaction_log`.`item_id` <> `transaction_log`.`target_item_id`) then 'Falied' else 'Passed' end) AS `scan_status`,`transaction_log`.`create_at` AS `create_at`,`transaction_log`.`update_at` AS `update_at` from `transaction_log` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-02  7:41:20
