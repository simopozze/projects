-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: my_pozzebondelivery
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `idAccount` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idAccount`),
  KEY `user` (`user`),
  CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user`) REFERENCES `clienti` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (27,45,'€ x™žh>»¿¬X¿{m'),(28,46,'€˜!7‹ê•¼©Æ•Žå(æ‡ª'),(29,47,NULL);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clienti`
--

DROP TABLE IF EXISTS `clienti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clienti` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `mail` varchar(300) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clienti`
--

LOCK TABLES `clienti` WRITE;
/*!40000 ALTER TABLE `clienti` DISABLE KEYS */;
INSERT INTO `clienti` VALUES (45,'Simone','Pozzebon','pozze.simo@gmail.com'),(46,'Mario','Rossi','rossi.mario@yahoo.it'),(47,'',NULL,'mattia.pozzebronx@gmail.com');
/*!40000 ALTER TABLE `clienti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `spedizioni`
--

DROP TABLE IF EXISTS `spedizioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `spedizioni` (
  `idSpedizione` int(11) NOT NULL AUTO_INCREMENT,
  `mittente` int(11) DEFAULT NULL,
  `destinatario` int(11) DEFAULT NULL,
  `truckTracking` varchar(30) DEFAULT NULL,
  `descb` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idSpedizione`),
  KEY `mittente` (`mittente`),
  KEY `destinatario` (`destinatario`),
  CONSTRAINT `spedizioni_ibfk_1` FOREIGN KEY (`mittente`) REFERENCES `clienti` (`idCliente`),
  CONSTRAINT `spedizioni_ibfk_2` FOREIGN KEY (`destinatario`) REFERENCES `clienti` (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `spedizioni`
--

LOCK TABLES `spedizioni` WRITE;
/*!40000 ALTER TABLE `spedizioni` DISABLE KEYS */;
INSERT INTO `spedizioni` VALUES (16,46,45,'autista1','                spedizione 1 mario rossi'),(17,45,46,'autista1','                spedizione 1 simone pozzebon');
/*!40000 ALTER TABLE `spedizioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tappe`
--

DROP TABLE IF EXISTS `tappe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tappe` (
  `idTappa` int(11) NOT NULL AUTO_INCREMENT,
  `spedizione` int(11) DEFAULT NULL,
  `dat` date DEFAULT NULL,
  `ora` varchar(5) DEFAULT NULL,
  `addr` varchar(100) DEFAULT NULL,
  `lat` float(200,10) DEFAULT NULL,
  `lon` float(200,10) DEFAULT NULL,
  PRIMARY KEY (`idTappa`),
  KEY `spedizione` (`spedizione`),
  CONSTRAINT `tappe_ibfk_1` FOREIGN KEY (`spedizione`) REFERENCES `spedizioni` (`idSpedizione`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tappe`
--

LOCK TABLES `tappe` WRITE;
/*!40000 ALTER TABLE `tappe` DISABLE KEYS */;
INSERT INTO `tappe` VALUES (27,16,'2021-04-02','11:12','Via Roma',40.0249252319,-82.9643402100),(28,17,'2021-04-22','23:12','Via Cavolano 20/W',45.9314155579,12.5075931549),(29,17,'2021-04-23','14:10','Via Cavolano 20/W',45.9314155579,12.5075931549),(30,17,'2021-07-08','10:12','Via Interna 7 Pordenone',45.9681053162,12.6610736847);
/*!40000 ALTER TABLE `tappe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-12 16:39:00
