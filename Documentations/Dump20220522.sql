-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: webvysionsport
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brand` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'CRISTALINE','Cristaline','sbzeOAP1cPUuu6LO3hmE9CzpW4UcYNXP7uXlQGIlPC',8,'image/png',0,7),(2,'LU','Lu','xmcQbRDLGhXrmxf8r50O2dCWxa9DJ6Ts3VzqAheNVNw',8,'image/jpeg',0,1),(3,'','Lu2','eYdeodGsZKarSq0dCWdS12lgll6USBa2jcDJhWMw5NR1',8,'image/jpeg',1,1);
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'WATERS',0,0),(2,'SOURCE WATERS',0,0),(3,'MINERAL WATERS',0,0),(4,'SNACKS',0,0),(5,'SWEET SNACKS',0,0),(6,'COOKIES_CAKE',0,0),(7,'BISCUITS',0,0),(8,'CHOCOLATE_COOKIES',0,0);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoryname`
--

DROP TABLE IF EXISTS `categoryname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoryname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcategory` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcategoryunique` (`idcategory`) USING BTREE,
  KEY `indcategory` (`idcategory`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indcategorylanguage` (`idcategory`,`idlanguage`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Category Name';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoryname`
--

LOCK TABLES `categoryname` WRITE;
/*!40000 ALTER TABLE `categoryname` DISABLE KEYS */;
INSERT INTO `categoryname` VALUES (1,1,1,'Eaux',0,0),(2,2,1,'Eaux de sources',0,0),(3,3,1,'Eaux minérales',0,0),(4,4,1,'Snacks',0,0),(5,5,1,'Snacks sucrés',0,0),(6,6,1,'Biscuits et gâteaux',0,0),(7,7,1,'Biscuits',0,0),(8,8,1,'Biscuits au chocolat',0,0);
/*!40000 ALTER TABLE `categoryname` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coachuser`
--

DROP TABLE IF EXISTS `coachuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coachuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `styidusercoach` int unsigned NOT NULL,
  `styiduser` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `dateend` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcoachuserunique` (`styidusercoach`,`styiduser`,`statut`) USING BTREE,
  KEY `indusercoach` (`styidusercoach`),
  KEY `induser` (`styiduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='All user assigned User coach';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coachuser`
--

LOCK TABLES `coachuser` WRITE;
/*!40000 ALTER TABLE `coachuser` DISABLE KEYS */;
INSERT INTO `coachuser` VALUES (1,1,2,20220101,20221231,0,0),(2,1,3,20220101,20221231,0,0);
/*!40000 ALTER TABLE `coachuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diet`
--

DROP TABLE IF EXISTS `diet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diet` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int unsigned NOT NULL,
  `iddiettemplate` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inddietunique` (`iduser`,`iddiettemplate`,`datestart`) USING BTREE,
  KEY `inddiettemplate` (`iddiettemplate`),
  KEY `inddiettemplateuser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Diets';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diet`
--

LOCK TABLES `diet` WRITE;
/*!40000 ALTER TABLE `diet` DISABLE KEYS */;
INSERT INTO `diet` VALUES (1,1,1,20220518,0,0),(2,1,2,20220518,0,0);
/*!40000 ALTER TABLE `diet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dietstudent`
--

DROP TABLE IF EXISTS `dietstudent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dietstudent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iddiet` int unsigned NOT NULL,
  `iduser` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inddietunique` (`iddiet`,`iduser`) USING BTREE,
  KEY `inddiet` (`iddiet`),
  KEY `induser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Diets Students';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dietstudent`
--

LOCK TABLES `dietstudent` WRITE;
/*!40000 ALTER TABLE `dietstudent` DISABLE KEYS */;
INSERT INTO `dietstudent` VALUES (1,1,1,0,0),(2,1,2,0,0);
/*!40000 ALTER TABLE `dietstudent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diettemplate`
--

DROP TABLE IF EXISTS `diettemplate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `diettemplate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `duration` int unsigned NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inddietunique` (`iduser`,`name`,`duration`) USING BTREE,
  KEY `inddiettemplate` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Diet Template';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diettemplate`
--

LOCK TABLES `diettemplate` WRITE;
/*!40000 ALTER TABLE `diettemplate` DISABLE KEYS */;
INSERT INTO `diettemplate` VALUES (1,1,'Diète 1',7,'Débutant,confirmé',0,0),(2,1,'Diète 2',14,'Sèche,PDM',0,0),(3,1,'Diète 3',21,'Débutant,confirmé',0,0),(4,1,'Diète 4',28,'Débutant,confirmé',0,0);
/*!40000 ALTER TABLE `diettemplate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `food` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbrand` int unsigned NOT NULL,
  `idscorenutri` int unsigned NOT NULL,
  `idscorenova` int unsigned NOT NULL,
  `idscoreeco` int unsigned NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodunique` (`idbrand`,`code`) USING BTREE,
  KEY `indbrand` (`idbrand`),
  KEY `indscorenutri` (`idscorenutri`),
  KEY `indscorenova` (`idscorenova`),
  KEY `indscoreeco` (`idscoreeco`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (1,1,2,2,2,'SPRING_WATER','Spring water','Spring water',0,0),(2,2,5,5,6,'PRINCE CHOCOLATE','Prince Chocolate','Prince Chocolate',0,0);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodcategory`
--

DROP TABLE IF EXISTS `foodcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foodcategory` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idcategory` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodcategoryunique` (`idfood`,`idcategory`) USING BTREE,
  KEY `indfood` (`idfood`),
  KEY `indcategory` (`idcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food Category';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodcategory`
--

LOCK TABLES `foodcategory` WRITE;
/*!40000 ALTER TABLE `foodcategory` DISABLE KEYS */;
INSERT INTO `foodcategory` VALUES (1,1,1,0,0),(2,1,2,0,0),(3,1,3,0,0),(4,2,4,0,0),(5,2,5,0,0),(6,2,6,0,0),(7,2,7,0,0),(8,2,8,0,0);
/*!40000 ALTER TABLE `foodcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodlabel`
--

DROP TABLE IF EXISTS `foodlabel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foodlabel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idlabel` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodlabelunique` (`idfood`,`idlabel`) USING BTREE,
  KEY `indfood` (`idfood`),
  KEY `indlabel` (`idlabel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food Label';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodlabel`
--

LOCK TABLES `foodlabel` WRITE;
/*!40000 ALTER TABLE `foodlabel` DISABLE KEYS */;
INSERT INTO `foodlabel` VALUES (1,1,1,0,0),(2,1,2,0,0),(3,1,3,0,0),(4,1,4,0,0),(5,1,5,0,0);
/*!40000 ALTER TABLE `foodlabel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodname`
--

DROP TABLE IF EXISTS `foodname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foodname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodunique` (`idfood`,`idlanguage`) USING BTREE,
  KEY `indfood` (`idfood`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indfoodlanguage` (`idfood`,`idlanguage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food Name';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodname`
--

LOCK TABLES `foodname` WRITE;
/*!40000 ALTER TABLE `foodname` DISABLE KEYS */;
INSERT INTO `foodname` VALUES (1,1,1,'Eaux de sources',0,0),(2,2,1,'Prince Chocolat',0,0);
/*!40000 ALTER TABLE `foodname` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodnutritional`
--

DROP TABLE IF EXISTS `foodnutritional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foodnutritional` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idnutritional` int unsigned NOT NULL,
  `nutritional` float unsigned NOT NULL,
  `idweighttype` int unsigned NOT NULL,
  `idweighttypebase` int unsigned NOT NULL,
  `weighttypebase` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodnutritionalunique` (`idfood`,`idnutritional`,`nutritional`,`idweighttypebase`) USING BTREE,
  KEY `indfood` (`idfood`),
  KEY `indnutritionaltype` (`idnutritional`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food Nutritional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodnutritional`
--

LOCK TABLES `foodnutritional` WRITE;
/*!40000 ALTER TABLE `foodnutritional` DISABLE KEYS */;
INSERT INTO `foodnutritional` VALUES (1,1,6,0.021,2,7,100,0,0),(2,1,8,100,4,7,100,0,0),(3,1,9,2.6,3,7,100,0,0),(4,1,10,3.3,3,7,100,0,0),(5,1,11,1.9,3,7,100,0,0),(6,1,12,2.2,3,7,100,0,0),(7,1,13,2.6,3,7,100,0,0),(8,1,14,2.6,3,7,100,0,0),(9,1,15,0.1,3,7,100,0,0),(10,1,16,1.9,3,7,100,0,0),(11,1,18,2,3,7,100,0,0),(12,1,19,6,3,7,100,0,0),(13,2,1,1962,13,2,100,0,0),(14,2,2,17.6,2,2,100,0,0),(15,2,3,69,2,2,100,0,0),(16,2,20,32.6,2,2,100,0,0),(17,2,4,6,2,2,100,0,0),(18,2,6,6,2,2,100,0,0),(19,2,0,49,2,2,100,0,0);
/*!40000 ALTER TABLE `foodnutritional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foodweight`
--

DROP TABLE IF EXISTS `foodweight`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foodweight` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idweighttype` int unsigned NOT NULL,
  `weight` float(6,2) unsigned NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indfoodweightunique` (`idfood`,`idweighttype`,`weight`) USING BTREE,
  KEY `indfood` (`idfood`),
  KEY `indweighttype` (`idweighttype`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Food Weight';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foodweight`
--

LOCK TABLES `foodweight` WRITE;
/*!40000 ALTER TABLE `foodweight` DISABLE KEYS */;
INSERT INTO `foodweight` VALUES (1,1,12,1.00,'kQ27w8XfDeYeMuCivssZ32t0WQFNPEw42VoXG',8,'image/jpeg',0,6),(2,1,12,1.50,'pq4m1gPVQqpW0aIgeifGczTK6R3XsgYeXrHb2xUGw',8,'image/jpeg',0,1),(3,2,2,300.00,'',0,'',0,0);
/*!40000 ALTER TABLE `foodweight` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `label`
--

DROP TABLE IF EXISTS `label`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `label` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Labels';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `label`
--

LOCK TABLES `label` WRITE;
/*!40000 ALTER TABLE `label` DISABLE KEYS */;
INSERT INTO `label` VALUES (1,'BIO','Bio','sw9MNWKfjdpBgfaHoufWuWeQVHrXonxdJfILmav8VTtpM',8,'image/png',0,6),(2,'ECOCERT','Ecocert','',0,'',0,0),(3,'BIO_EUROPEEN','Bio européen','RcWpmMuOfpYYY50nyG1kV7wDBBM90i6wwAVI667xiD',8,'image/png',0,2),(4,'FR-BIO-01','FR-BIO-01','',0,'',0,0),(5,'MADE_IN_FRANCE','Fabriqué en France','',0,'',0,0),(6,'AB_AGRI_BIO','AB Agriculture Biologique','ZwQmJoghLUHM108y7ZILp8v2vRXCkatp3SMQgZI2Di',8,'image/png',0,2);
/*!40000 ALTER TABLE `label` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutritional`
--

DROP TABLE IF EXISTS `nutritional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutritional` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Nutritional';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutritional`
--

LOCK TABLES `nutritional` WRITE;
/*!40000 ALTER TABLE `nutritional` DISABLE KEYS */;
INSERT INTO `nutritional` VALUES (1,'ENERGIE',0,2),(2,'MATIERES_GRASSES',0,2),(3,'GLUCIDES',0,0),(4,'FIBRES_ALIMENTAIRES',0,0),(5,'PROTEINES',0,0),(6,'SEL',0,0),(7,'ALCOOL',0,0),(8,'BIOTINE',0,0),(9,'SILICE',0,0),(10,'BICARBONATE',0,0),(11,'POTASSIUM',0,0),(12,'CHLORURE',0,0),(13,'CALCIUM',0,0),(14,'MAGNESIUM',0,0),(15,'FLUORURE',0,0),(16,'CAFEINE',0,0),(17,'FRUITS_LEGUMES_NOIX',0,0),(18,'NITRATE',0,0),(19,'SULFATE',0,0),(20,'SUGAR',0,0);
/*!40000 ALTER TABLE `nutritional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nutritionalname`
--

DROP TABLE IF EXISTS `nutritionalname`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nutritionalname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idnutritional` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indnutritionalunique` (`idnutritional`,`idlanguage`) USING BTREE,
  KEY `indnutritional` (`idnutritional`),
  KEY `indlanguage` (`idlanguage`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Nutritional Names';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nutritionalname`
--

LOCK TABLES `nutritionalname` WRITE;
/*!40000 ALTER TABLE `nutritionalname` DISABLE KEYS */;
INSERT INTO `nutritionalname` VALUES (1,1,1,'Énergie',0,0),(2,2,1,'Matières grasses',0,2),(3,3,1,'Glucides',0,0),(4,4,1,'Fibres alimentaires',0,0),(5,5,1,'Protéines',0,0),(6,6,1,'Sel',0,0),(7,7,1,'Alcool',0,0),(8,8,1,'Biotine (Vitamine B8',0,0),(9,9,1,'Silice',0,0),(10,10,1,'Bicarbonate',0,0),(11,11,1,'Potassium',0,0),(12,12,1,'Chlorure',0,0),(13,13,1,'Calcium',0,0),(14,14,1,'Magnésium',0,0),(15,15,1,'Fluorure',0,0),(16,16,1,'Caféine',0,0),(17,17,1,'Fruits‚ légumes‚ noix et huiles de colza‚ noix et olive',0,0),(18,18,1,'Nitrate',0,0),(19,19,1,'Sulfate',0,0),(20,20,1,'Sucre',0,0);
/*!40000 ALTER TABLE `nutritionalname` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipe`
--

DROP TABLE IF EXISTS `recipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipe` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Recipes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipe`
--

LOCK TABLES `recipe` WRITE;
/*!40000 ALTER TABLE `recipe` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipeingredient`
--

DROP TABLE IF EXISTS `recipeingredient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipeingredient` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idingredient` int unsigned NOT NULL,
  `weight` int unsigned NOT NULL,
  `calorie` int unsigned NOT NULL,
  `proetin` int unsigned NOT NULL,
  `glucide` int unsigned NOT NULL,
  `lipid` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indrecipeingredientunique` (`idrecipe`,`idingredient`) USING BTREE,
  KEY `indrecipe` (`idrecipe`),
  KEY `indingredient` (`idingredient`),
  KEY `indrecipeingredient` (`idrecipe`,`idingredient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Recipes Ingredients';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipeingredient`
--

LOCK TABLES `recipeingredient` WRITE;
/*!40000 ALTER TABLE `recipeingredient` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipeingredient` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipename`
--

DROP TABLE IF EXISTS `recipename`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indrecipelanguageunique` (`idrecipe`,`idlanguage`) USING BTREE,
  KEY `indrecipe` (`idrecipe`),
  KEY `indrecipelanguage` (`idrecipe`,`idlanguage`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Recipes Names';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipename`
--

LOCK TABLES `recipename` WRITE;
/*!40000 ALTER TABLE `recipename` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipename` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipeuser`
--

DROP TABLE IF EXISTS `recipeuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipeuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idstyuser` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indrecipeuserunique` (`idrecipe`,`idstyuser`) USING BTREE,
  KEY `indrecipe` (`idrecipe`),
  KEY `induser` (`idstyuser`),
  KEY `indrecipeuser` (`idrecipe`,`idstyuser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Recipes User';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipeuser`
--

LOCK TABLES `recipeuser` WRITE;
/*!40000 ALTER TABLE `recipeuser` DISABLE KEYS */;
/*!40000 ALTER TABLE `recipeuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scoreeco`
--

DROP TABLE IF EXISTS `scoreeco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scoreeco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `letter` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indletterunique` (`letter`) USING BTREE,
  KEY `indletter` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Eco scores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scoreeco`
--

LOCK TABLES `scoreeco` WRITE;
/*!40000 ALTER TABLE `scoreeco` DISABLE KEYS */;
INSERT INTO `scoreeco` VALUES (1,'?','#B3B3B3','?','oN7XILi341bDkRBT0vvrh4rH60CPFqdKEjcIUCUIC',8,'image/png',0,3),(2,'A','#208E51','A','2MokkX0c7WyJ7WwIW7dRHOvoZ4tx3Glezd7pJpGXdD8r',8,'image/png',0,10),(3,'B','#5FAE31','B','1Nmjj7pBLhdxL9lVWL5ma0reA7aQk1G5gkmNAsWjJsx',8,'image/png',0,1),(4,'C','#E7B40B','C','WRQvRrZi0v7YDJ8HVXYeIpprnbzobre2rkoC46jZsXi',8,'image/png',0,1),(5,'D','#E47323','D','R1H2S5wYdPxmdJmGmRE8Ij29jyGZBLKLQtA4scqz',8,'image/png',0,1),(6,'E','#EF131F','E','LEaFDLFn2jsxJvVoW4oI0XdaA2937ifkJeSqM',8,'image/png',0,1);
/*!40000 ALTER TABLE `scoreeco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scorenova`
--

DROP TABLE IF EXISTS `scorenova`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scorenova` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indnumberunique` (`number`) USING BTREE,
  KEY `indnumber` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Nova scores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scorenova`
--

LOCK TABLES `scorenova` WRITE;
/*!40000 ALTER TABLE `scorenova` DISABLE KEYS */;
INSERT INTO `scorenova` VALUES (1,'?','#B3B3B3','Inconnu','',0,'',0,1),(2,'1','#00A501','Aliments non transformés ou transformés minimalement','nVG5HZT1eJ4s4bcJ8CdrrDCOdpR7UfSaXbKyoph11',8,'image/png',0,2),(3,'2','#F7C600','Ingrédients culinaires transformés','2636oN5CSL6cozQyz2SI8rpcPXPrQil42JMSKL',8,'image/png',0,2),(4,'3','#F76300','Aliments transformés','4wecSt1XR8pWM83zi62kRXmHC5w5SrDP45pXbcH3clW0',8,'image/png',0,2),(5,'4','#F60000','Produits alimentaires et boissons ultra-transformés','HjkFRBqak892z7YIpx4ADAjmrgT0MyVqhCrI21hxnuS',8,'image/png',0,2);
/*!40000 ALTER TABLE `scorenova` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scorenutri`
--

DROP TABLE IF EXISTS `scorenutri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scorenutri` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `letter` varchar(2) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indletterunique` (`letter`) USING BTREE,
  KEY `indletter` (`letter`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Nutri scores';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scorenutri`
--

LOCK TABLES `scorenutri` WRITE;
/*!40000 ALTER TABLE `scorenutri` DISABLE KEYS */;
INSERT INTO `scorenutri` VALUES (1,'?','#B3B3B3','?','b1XUM0rUzUHzyDxD3ty5K0hoaDkFil8IUifnZkdaDkFfLx',8,'image/png',0,1),(2,'A','#0A8E45','A','FGVcmso8DgtfPXbOfJ01hHE8qAxDTRk5fwrhdMMG14s7',8,'image/png',0,1),(3,'B','#7AC547','B','k5sDam5wRoXwXWNKEcdRtMuiyUwImjiVmfm5L',8,'image/png',0,1),(4,'C','#FFC734','C','JzEGqAgXGKFwurEGq3e5K0vaYuC9u5iNtsiovaoV',8,'image/png',0,1),(5,'D','#FF7D24','D','LV8ESimfvaHWoYqPA3MS2jAS7jie5r2cGbCIo4b5nk',8,'image/png',0,1),(6,'E','#FF421A','E','PJPD4GCrPMhWCqtT9JnDj0qUEPQuHBYlkCRJJgcxfS',8,'image/png',0,1);
/*!40000 ALTER TABLE `scorenutri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sociallink`
--

DROP TABLE IF EXISTS `sociallink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sociallink` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `colorbg` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `iconfa` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linksocial` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indiconfa` (`iconfa`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Social Link';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sociallink`
--

LOCK TABLES `sociallink` WRITE;
/*!40000 ALTER TABLE `sociallink` DISABLE KEYS */;
INSERT INTO `sociallink` VALUES (1,'#ffffff','#3b5998','fa-facebook','www.facebook.fr','',0,'',0),(2,'#ffffff','#1da1f2','fa-twitter','www.twitter.fr','',0,'',0),(3,'#ffffff','#007bb5','fa-linkedin','www.linkedin.fr','',0,'',0),(4,'#ffffff','#f46f30','fa-instagram','www.instagram.fr','',0,'',0),(5,'#ffffff','#c32361','fa-dribbble','www.dribbble.fr','',0,'',0),(6,'#ffffff','#3d464d','fa-dropbox','www.dropbox.fr','',0,'',0),(7,'#ffffff','#db4437','fa-google','www.google.fr','',0,'',0),(8,'#ffffff','#bd081c','fa-pinterest','www.pinterest.fr','',0,'',0),(9,'#ffffff','#00aff0','fa-skype','www.skype.fr','',0,'',0),(10,'#ffffff','#00b489','fa-vine','www.vine.fr','',0,'',0);
/*!40000 ALTER TABLE `sociallink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styapplication`
--

DROP TABLE IF EXISTS `styapplication`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styapplication` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Applications';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styapplication`
--

LOCK TABLES `styapplication` WRITE;
/*!40000 ALTER TABLE `styapplication` DISABLE KEYS */;
INSERT INTO `styapplication` VALUES (1,'WEBVYSION_SPORT','WebVysion Sport',0,2);
/*!40000 ALTER TABLE `styapplication` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stycoatchuser`
--

DROP TABLE IF EXISTS `stycoatchuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stycoatchuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoatch` int unsigned NOT NULL,
  `iduser` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `dateend` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indstycoatchuserunique` (`idusercoatch`,`iduser`,`statut`) USING BTREE,
  KEY `indusercoatch` (`idusercoatch`),
  KEY `induser` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='All user assigned User Coatch';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stycoatchuser`
--

LOCK TABLES `stycoatchuser` WRITE;
/*!40000 ALTER TABLE `stycoatchuser` DISABLE KEYS */;
INSERT INTO `stycoatchuser` VALUES (1,1,2,20220101,20221231,0,0);
/*!40000 ALTER TABLE `stycoatchuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styenterpisewhitemarking`
--

DROP TABLE IF EXISTS `styenterpisewhitemarking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styenterpisewhitemarking` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `identerprise` int unsigned NOT NULL,
  `idsubscriptionpackage` int unsigned NOT NULL,
  `date_start` int unsigned NOT NULL,
  `date_end` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indstyenterpisewhitemarkingunique` (`identerprise`,`idsubscriptionpackage`) USING BTREE,
  KEY `indenterprise` (`identerprise`),
  KEY `indsubscriptionpackage` (`idsubscriptionpackage`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Enterpise white Marking';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styenterpisewhitemarking`
--

LOCK TABLES `styenterpisewhitemarking` WRITE;
/*!40000 ALTER TABLE `styenterpisewhitemarking` DISABLE KEYS */;
INSERT INTO `styenterpisewhitemarking` VALUES (1,1,3,20220101,20230101,0,0),(2,2,3,20220101,20230101,0,0);
/*!40000 ALTER TABLE `styenterpisewhitemarking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styenterprise`
--

DROP TABLE IF EXISTS `styenterprise`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styenterprise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `co` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `zipcode` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logoimagehtmlname` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logoimagename` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `logosize` int unsigned NOT NULL,
  `logotype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `idregion` int unsigned NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `idusermanager` int unsigned NOT NULL,
  `idstyenterpriseparent` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`) USING BTREE,
  UNIQUE KEY `indcode` (`code`) USING BTREE,
  KEY `indname` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='StyEnterprises';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styenterprise`
--

LOCK TABLES `styenterprise` WRITE;
/*!40000 ALTER TABLE `styenterprise` DISABLE KEYS */;
INSERT INTO `styenterprise` VALUES (1,'WEBVYSION','WEBVYSION','contact@webvysion.fr','1','1','','7 Distrix Street','77777','DistriX City','','',0,' ',1,77,1,1,0,0,0);
/*!40000 ALTER TABLE `styenterprise` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styenterprisepos`
--

DROP TABLE IF EXISTS `styenterprisepos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styenterprisepos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `styidenterprise` int unsigned NOT NULL,
  `idpos` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`) USING BTREE,
  UNIQUE KEY `indenterprisepos` (`styidenterprise`,`idpos`) USING BTREE,
  UNIQUE KEY `indposenterprise` (`idpos`,`styidenterprise`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='StyEnterprise POS';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styenterprisepos`
--

LOCK TABLES `styenterprisepos` WRITE;
/*!40000 ALTER TABLE `styenterprisepos` DISABLE KEYS */;
INSERT INTO `styenterprisepos` VALUES (1,1,1,0,0);
/*!40000 ALTER TABLE `styenterprisepos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styfunctionality`
--

DROP TABLE IF EXISTS `styfunctionality`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styfunctionality` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstymodule` int unsigned NOT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Module Functionalities';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styfunctionality`
--

LOCK TABLES `styfunctionality` WRITE;
/*!40000 ALTER TABLE `styfunctionality` DISABLE KEYS */;
INSERT INTO `styfunctionality` VALUES (1,1,'ADMIN_ENTERPRISE','ADMIN_ENTERPRISE',0,0),(2,1,'ADMIN_USER','ADMIN_USER',0,0),(3,1,'ADMIN_USER_TYPE','ADMIN_USER_TYPE',0,0),(4,1,'SECURITY_APPLICATION','SECURITY_APPLICATION',0,0),(5,1,'SECURITY_MODULE','SECURITY_MODULE',0,0),(6,1,'SECURITY_FUNCTIONALITY','SECURITY_FUNCTIONALITY',0,0),(7,1,'SECURITY_ROLE','SECURITY_ROLE',0,0),(8,1,'SECURITY_RIGHT','SECURITY_RIGHT',0,0),(9,1,'FOOD_FOOD','FOOD_FOOD',0,0),(10,1,'FOOD_BRAND','FOOD_BRAND',0,0),(11,1,'FOOD_ECO_SCORE','FOOD_ECO_SCORE',0,0),(12,1,'FOOD_NOVA_SCORE','FOOD_NOVA_SCORE',0,0),(13,1,'FOOD_NUTRI_SCORE','FOOD_NUTRI_SCORE',0,0),(14,1,'FOOD_LABEL','FOOD_LABEL',0,0),(15,1,'CODE_TABLE_WEIGHT_TYPE','CODE_TABLE_WEIGHT_TYPE',0,0),(16,1,'CODE_TABLE_LANGUES','CODE_TABLE_LANGUES',0,0),(17,1,'CODE_TABLE_FOOD_CATEGORY','CODE_TABLE_FOOD_CATEGORY',0,0),(18,1,'CODE_TABLE_NUTRITIONAL','CODE_TABLE_NUTRITIONAL',0,0);
/*!40000 ALTER TABLE `styfunctionality` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stylanguage`
--

DROP TABLE IF EXISTS `stylanguage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stylanguage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security languages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stylanguage`
--

LOCK TABLES `stylanguage` WRITE;
/*!40000 ALTER TABLE `stylanguage` DISABLE KEYS */;
INSERT INTO `stylanguage` VALUES (1,'FR','Français','RJsUuveRc4qF11eQxFZHYA1xN2guopPK41FGTfrT8Ixz',8,'image/png',0,1),(2,'EN','English','tLDcblpqbIFEMIqBlbMgWGvzApnoZWd6qFY9PEzY5',8,'image/png',0,5);
/*!40000 ALTER TABLE `stylanguage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stymodule`
--

DROP TABLE IF EXISTS `stymodule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stymodule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyapplication` int unsigned NOT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Modules';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stymodule`
--

LOCK TABLES `stymodule` WRITE;
/*!40000 ALTER TABLE `stymodule` DISABLE KEYS */;
INSERT INTO `stymodule` VALUES (1,1,'SECURITY','SECURITY',0,0);
/*!40000 ALTER TABLE `stymodule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styright`
--

DROP TABLE IF EXISTS `styright`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` int unsigned NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Rights';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styright`
--

LOCK TABLES `styright` WRITE;
/*!40000 ALTER TABLE `styright` DISABLE KEYS */;
INSERT INTO `styright` VALUES (1,1,'View','',0,0),(2,2,'Change','',0,0),(3,4,'Add','',0,0),(4,8,'Remove','',0,0),(5,16,'Delete','',0,0),(6,32,'Print','',0,0),(7,64,'List','',0,0),(8,128,'Follow','',0,0),(9,256,'Security','',0,0),(10,512,'Publish','',0,0),(11,1024,'Restore','',0,0),(12,2048,'Duplicate','',0,0),(13,4096,'Agenda','',0,0),(14,2147483648,'Manage','',0,0);
/*!40000 ALTER TABLE `styright` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styrole`
--

DROP TABLE IF EXISTS `styrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styrole` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Roles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styrole`
--

LOCK TABLES `styrole` WRITE;
/*!40000 ALTER TABLE `styrole` DISABLE KEYS */;
INSERT INTO `styrole` VALUES (1,'SEC_MAN','Security Manager','Security Manager',0,0),(2,'WEB_MAN','WebVysion Manager','WebVysion Manager',0,0),(3,'WEB_USER','WebVysion User','WebVysion User',0,0),(4,'ENT_MAN','Enterprise Manager','Enterprise Manager',0,0),(5,'COATCH_MAN','Coatch Manager','Coatch Manager',0,0),(6,'COATCH','Coatch','Coatch',0,0),(7,'STUDENT','Elève','Elève',0,0);
/*!40000 ALTER TABLE `styrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styroleright`
--

DROP TABLE IF EXISTS `styroleright`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styroleright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyrole` int unsigned NOT NULL,
  `idstyapplication` int unsigned NOT NULL,
  `idstymodule` int unsigned NOT NULL,
  `idstyfunctionality` int unsigned NOT NULL,
  `sumofrights` int unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indrole` (`idstyrole`),
  KEY `indroleapp` (`idstyrole`,`idstyapplication`),
  KEY `indroleappmodule` (`idstyrole`,`idstyapplication`,`idstymodule`),
  KEY `indroleappmodulefunc` (`idstyrole`,`idstyapplication`,`idstymodule`,`idstyfunctionality`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Role Rights';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styroleright`
--

LOCK TABLES `styroleright` WRITE;
/*!40000 ALTER TABLE `styroleright` DISABLE KEYS */;
INSERT INTO `styroleright` VALUES (1,1,1,1,1,2147483648,0),(2,1,1,1,2,2147483648,0),(3,1,1,1,3,2147483648,0),(4,1,1,1,4,2147483648,0),(5,1,1,1,5,2147483648,0),(6,1,1,1,6,2147483648,0),(7,1,1,1,7,2147483648,0),(8,1,1,1,8,2147483648,0);
/*!40000 ALTER TABLE `styroleright` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stytemporarycode`
--

DROP TABLE IF EXISTS `stytemporarycode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stytemporarycode` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuserpazzi` int unsigned NOT NULL,
  `idstyapplication` int unsigned NOT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `validitydate` int unsigned NOT NULL,
  `validitytime` int unsigned NOT NULL,
  `used` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `induser` (`idstyuserpazzi`),
  KEY `induserapp` (`idstyuserpazzi`,`idstyapplication`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Forget Password Temporary Code';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stytemporarycode`
--

LOCK TABLES `stytemporarycode` WRITE;
/*!40000 ALTER TABLE `stytemporarycode` DISABLE KEYS */;
/*!40000 ALTER TABLE `stytemporarycode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styuser`
--

DROP TABLE IF EXISTS `styuser`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyusertype` tinyint unsigned NOT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `firstname` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `linktopicture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emailbackup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `initpass` tinyint unsigned DEFAULT NULL,
  `idlanguage` int unsigned DEFAULT NULL,
  `idstyenterprise` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indlogin` (`login`),
  KEY `indenterpise` (`idstyenterprise`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security Users';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styuser`
--

LOCK TABLES `styuser` WRITE;
/*!40000 ALTER TABLE `styuser` DISABLE KEYS */;
INSERT INTO `styuser` VALUES (1,1,'One','One','User1','zEZHMoYs2048gmFkWooCO0MqJUWJLmZMC1Q5id8uQn',8,'image/jpeg','f','one.user1@distrix.org','','','',0,1,1,0,16),(2,2,'Two','Two','User2','',0,'','f','two.user2@distrix.org','','','',0,1,1,0,0),(3,2,'Three','Three','User3',' ',0,'','f','three.user3@distrix.org',' ',' ',' ',0,1,1,0,0);
/*!40000 ALTER TABLE `styuser` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styuserright`
--

DROP TABLE IF EXISTS `styuserright`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styuserright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int unsigned NOT NULL,
  `idstyapplication` int unsigned NOT NULL,
  `idstymodule` int unsigned NOT NULL,
  `idstyfunctionality` int unsigned NOT NULL,
  `sumofrights` int unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `induser` (`idstyuser`),
  KEY `induserapp` (`idstyuser`,`idstyapplication`),
  KEY `induserappmodule` (`idstyuser`,`idstyapplication`,`idstymodule`),
  KEY `induserappmodulefunc` (`idstyuser`,`idstyapplication`,`idstymodule`,`idstyfunctionality`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security User Rights';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styuserright`
--

LOCK TABLES `styuserright` WRITE;
/*!40000 ALTER TABLE `styuserright` DISABLE KEYS */;
INSERT INTO `styuserright` VALUES (1,1,1,1,1,2147483648,0),(2,1,1,1,2,2147483648,0),(3,1,1,1,3,2147483648,0),(4,1,1,1,4,2147483648,0),(5,1,1,1,5,2147483648,0),(6,1,1,1,6,2147483648,0),(7,1,1,1,7,2147483648,0),(8,1,1,1,8,2147483648,0),(9,1,1,1,9,2147483648,0),(10,1,1,1,10,2147483648,0),(11,1,1,1,11,2147483648,0),(12,1,1,1,12,2147483648,0),(13,1,1,1,13,2147483648,0),(14,1,1,1,14,2147483648,0),(15,1,1,1,15,2147483648,0),(16,1,1,1,16,2147483648,0),(17,1,1,1,17,2147483648,0),(18,1,1,1,18,2147483648,0);
/*!40000 ALTER TABLE `styuserright` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styuserrole`
--

DROP TABLE IF EXISTS `styuserrole`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styuserrole` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int unsigned NOT NULL,
  `idstyrole` int unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `induserrole` (`idstyuser`,`idstyrole`),
  UNIQUE KEY `indroleuser` (`idstyrole`,`idstyuser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security User Roles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styuserrole`
--

LOCK TABLES `styuserrole` WRITE;
/*!40000 ALTER TABLE `styuserrole` DISABLE KEYS */;
INSERT INTO `styuserrole` VALUES (1,1,1,0),(2,2,2,0);
/*!40000 ALTER TABLE `styuserrole` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styusersociallink`
--

DROP TABLE IF EXISTS `styusersociallink`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styusersociallink` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int unsigned NOT NULL,
  `idsociallink` int unsigned NOT NULL,
  `sociallink` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indroleuser` (`idstyuser`,`idsociallink`),
  KEY `indstyuser` (`idstyuser`),
  KEY `indsociallink` (`idsociallink`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security User Roles';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styusersociallink`
--

LOCK TABLES `styusersociallink` WRITE;
/*!40000 ALTER TABLE `styusersociallink` DISABLE KEYS */;
INSERT INTO `styusersociallink` VALUES (1,1,1,'http://www.socialnetwork1.fr',0),(2,1,2,'http://www.socialnetwork2.fr',0),(3,1,3,'http://www.socialnetwork3.fr',0),(4,1,4,'http://www.socialnetwork4.fr',0),(5,1,5,'http://www.socialnetwork5.fr',0),(6,1,6,'http://www.socialnetwork6.fr',0),(7,1,7,'http://www.socialnetwork7.fr',0),(8,1,8,'http://www.socialnetwork8.fr',0),(9,1,9,'http://www.socialnetwork9.fr',0),(10,1,10,'http://www.socialnetwork10.fr',0);
/*!40000 ALTER TABLE `styusersociallink` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styusertype`
--

DROP TABLE IF EXISTS `styusertype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styusertype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL DEFAULT '0',
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcode` (`code`),
  UNIQUE KEY `indname` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Security User Types';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styusertype`
--

LOCK TABLES `styusertype` WRITE;
/*!40000 ALTER TABLE `styusertype` DISABLE KEYS */;
INSERT INTO `styusertype` VALUES (1,'INTERNAL','Internal',0,0),(2,'EXTERNAL','External',0,0);
/*!40000 ALTER TABLE `styusertype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `styusertypename`
--

DROP TABLE IF EXISTS `styusertypename`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `styusertypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyusertype` int unsigned NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `code` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indstyusertypecode` (`idstyusertype`,`idcountry`,`idlanguage`,`code`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Sty User Type Names';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `styusertypename`
--

LOCK TABLES `styusertypename` WRITE;
/*!40000 ALTER TABLE `styusertypename` DISABLE KEYS */;
INSERT INTO `styusertypename` VALUES (1,1,77,1,'INTERNAL','Interne',0,0),(2,1,77,2,'INTERNAL','Internal',0,0),(3,2,77,1,'EXTERNAL','Externe',0,0),(4,2,77,2,'EXTERNAL','external',0,0);
/*!40000 ALTER TABLE `styusertypename` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptionpackage`
--

DROP TABLE IF EXISTS `subscriptionpackage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptionpackage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Subscription Package';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptionpackage`
--

LOCK TABLES `subscriptionpackage` WRITE;
/*!40000 ALTER TABLE `subscriptionpackage` DISABLE KEYS */;
INSERT INTO `subscriptionpackage` VALUES (1,'FREE',0,0,0),(2,'LIGHT',4.9,0,0),(3,'WHITE_MARKING',9.9,0,0);
/*!40000 ALTER TABLE `subscriptionpackage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptionpackagename`
--

DROP TABLE IF EXISTS `subscriptionpackagename`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptionpackagename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idsubscriptionpackage` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indsubscriptionpackageunique` (`idsubscriptionpackage`,`idlanguage`) USING BTREE,
  KEY `indsubscriptionpackage` (`idsubscriptionpackage`),
  KEY `indlanguage` (`idlanguage`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Subscription Package Name';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptionpackagename`
--

LOCK TABLES `subscriptionpackagename` WRITE;
/*!40000 ALTER TABLE `subscriptionpackagename` DISABLE KEYS */;
INSERT INTO `subscriptionpackagename` VALUES (1,1,1,'Gratuit',0,0),(2,2,1,'Formule limitée',0,0),(3,3,1,'Formule en marque blanche',0,0);
/*!40000 ALTER TABLE `subscriptionpackagename` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weighttype`
--

DROP TABLE IF EXISTS `weighttype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weighttype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `issolid` tinyint unsigned NOT NULL,
  `isliquid` tinyint unsigned NOT NULL,
  `isother` tinyint unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE,
  KEY `indcode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Weight Type';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weighttype`
--

LOCK TABLES `weighttype` WRITE;
/*!40000 ALTER TABLE `weighttype` DISABLE KEYS */;
INSERT INTO `weighttype` VALUES (1,'KG',1,0,0,0,4),(2,'G',1,0,0,0,0),(3,'MG',1,0,0,0,0),(4,'UG',1,0,0,0,0),(5,'LIBRA',1,0,0,0,0),(6,'ONZA',1,0,0,0,0),(7,'ML',0,1,0,0,0),(8,'CL',0,1,0,0,0),(9,'DL',0,1,0,0,0),(10,'DAL',0,1,0,0,0),(11,'HL',0,1,0,0,0),(12,'L',0,1,0,0,0),(13,'KCAL',0,0,1,0,0),(14,'CAL',0,0,1,0,0);
/*!40000 ALTER TABLE `weighttype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `weighttypename`
--

DROP TABLE IF EXISTS `weighttypename`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `weighttypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idweighttype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `abbreviation` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indweighttypenameunique` (`idweighttype`,`idlanguage`) USING BTREE,
  KEY `indweighttype` (`idweighttype`),
  KEY `indlanguage` (`idlanguage`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Weight Type Name';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `weighttypename`
--

LOCK TABLES `weighttypename` WRITE;
/*!40000 ALTER TABLE `weighttypename` DISABLE KEYS */;
INSERT INTO `weighttypename` VALUES (1,1,1,'Kilogramme','Kilogramme','kg',0,2),(2,2,1,'Gramme','Gramme','g',0,0),(3,3,1,'Miligramme','Miligramme','mg',0,0),(4,4,1,'Microgramme','Microgramme','μg',0,0),(5,5,1,'Pound','Pound - libra','lb',0,0),(6,6,1,'Ounce','Ounce - onza','oz',0,0),(7,7,1,'Mililitre','Mililitre','ml',0,0),(8,8,1,'Centilitre','Centilitre','cl',0,0),(9,9,1,'Décilitre','Décilitre','dl',0,0),(10,10,1,'Décalitre','Décalitre','dal',0,0),(11,11,1,'Hectolitre','Hectolitre','hl',0,0),(12,12,1,'Litre','Litre','l',0,0),(13,13,1,'Kilocalorie','Kilocalorie','kcal',0,0),(14,14,1,'Calorie','Calorie','calorie',0,0);
/*!40000 ALTER TABLE `weighttypename` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-22 20:49:17
