-- MariaDB dump 10.19  Distrib 10.6.10-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: KS
-- ------------------------------------------------------
-- Server version	10.6.10-MariaDB-1+b1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AdLog`
--

DROP TABLE IF EXISTS `AdLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdLog` (
  `IdAd` int(11) NOT NULL,
  `NomAd` varchar(20) DEFAULT 'admin',
  `PassAd` varchar(10) DEFAULT 'admin',
  PRIMARY KEY (`IdAd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdLog`
--

LOCK TABLES `AdLog` WRITE;
/*!40000 ALTER TABLE `AdLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `AdLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Comments` (
  `IdCom` varchar(10) NOT NULL,
  `IdPost` varchar(10) NOT NULL,
  `Matricule` int(11) NOT NULL,
  `Content` varchar(250) DEFAULT NULL,
  `DateCom` varchar(20) DEFAULT '-',
  PRIMARY KEY (`IdCom`,`IdPost`,`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Notifs`
--

DROP TABLE IF EXISTS `Notifs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Notifs` (
  `IdPost` varchar(10) NOT NULL,
  `Matricule` int(11) NOT NULL,
  `Content` varchar(250) DEFAULT NULL,
  `read_flag` varchar(2) DEFAULT 'n',
  PRIMARY KEY (`IdPost`,`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Notifs`
--

LOCK TABLES `Notifs` WRITE;
/*!40000 ALTER TABLE `Notifs` DISABLE KEYS */;
/*!40000 ALTER TABLE `Notifs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostLog`
--

DROP TABLE IF EXISTS `PostLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostLog` (
  `IdPost` varchar(10) NOT NULL,
  `Matricule` int(11) NOT NULL,
  `Title` varchar(20) DEFAULT NULL,
  `Content` varchar(260) DEFAULT NULL,
  `code` varchar(15000) DEFAULT NULL,
  `Likes` int(11) DEFAULT 0,
  `Dislikes` int(11) DEFAULT 0,
  `IsReported` varchar(2) DEFAULT 'n',
  `Tags` varchar(100) DEFAULT '-',
  `DatePost` varchar(20) DEFAULT '-',
  PRIMARY KEY (`IdPost`,`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostLog`
--

LOCK TABLES `PostLog` WRITE;
/*!40000 ALTER TABLE `PostLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Requests`
--

DROP TABLE IF EXISTS `Requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Requests` (
  `IdReq` int(11) NOT NULL,
  `Matricule` int(11) DEFAULT NULL,
  `req_type` varchar(20) DEFAULT NULL,
  `Content` varchar(250) DEFAULT NULL,
  `read_flag` varchar(2) DEFAULT 'n',
  PRIMARY KEY (`IdReq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Requests`
--

LOCK TABLES `Requests` WRITE;
/*!40000 ALTER TABLE `Requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `Requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserLog`
--

DROP TABLE IF EXISTS `UserLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserLog` (
  `Matricule` int(11) NOT NULL,
  `Nom` varchar(20) DEFAULT NULL,
  `Prenom` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `Classe` varchar(3) DEFAULT NULL,
  `IsMentor` varchar(1) DEFAULT 'n',
  `Skills` varchar(100) DEFAULT '-',
  `Interests` varchar(100) DEFAULT '-',
  PRIMARY KEY (`Matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserLog`
--

LOCK TABLES `UserLog` WRITE;
/*!40000 ALTER TABLE `UserLog` DISABLE KEYS */;
INSERT INTO `UserLog` VALUES (1060,'Kely','Saina','k','L3','n','-','-');
/*!40000 ALTER TABLE `UserLog` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-03-05 20:26:36
