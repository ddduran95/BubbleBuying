-- MySQL dump 10.13  Distrib 5.5.39, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: bubblebd
-- ------------------------------------------------------
-- Server version	5.5.39

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
-- Current Database: `bubblebd`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `bubblebd` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `bubblebd`;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chat` (
  `chat` int(11) NOT NULL AUTO_INCREMENT,
  `producto` int(11) NOT NULL,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `comprador` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`chat`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,1,'barajas','ddduran'),(2,2,'barajas','laserraptor'),(3,7,'ddduran','laserraptor');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `chat` int(11) NOT NULL,
  `autor` int(1) COLLATE latin1_spanish_ci NOT NULL,
  `tiempo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mensaje` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`chat`,`tiempo`,`mensaje`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES
(1,'1','2016-12-01 20:41:15','Mensaje 1 '),
(1,'0','2016-12-01 20:42:04','Mensaje 3'),
(2,'1','2016-12-01 20:42:18','Mensaje 2'),
(2,'0','2016-12-01 20:42:18','Mensaje 4');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `producto` (
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` enum('Tecnologia','Libros','Cosas de casa','Videojuegos','Niños','Electrodomesticos','Ropa','Motor','Deportes') COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES ('Taza Star Wars','Es una taza muy bonita casi sin usar',15,'taza.jpg',1,'barajas','Cosas de casa'),('Moto','Corre a toda velocidad',20,'moto.jpg',2,'ddduran','Motor'),('Iphone','Buen movil si no fuera porque es un Iphone.',600,'iphone.jpg',3,'laserraptor','Tecnologia'),('Vientos de Invierno','Sexta entrega de la famosa saga de Canción de Hielo y Fuego. Está nuevo.',40,'vientosinvierno.jpg',4,'ddduran','Libros'),('Bloorborne GOTY','Edición Game of the Year de Bloodborne para PS4.',34,'bloodborne.jpg',5,'laserraptor','Videojuegos'),('Lego Star Wars','Lego Star Wars para niños de entre 7-14 años. Sin usar por falta de niño.',59.99,'lego.jpg',6,'barajas','Niños'),('Microondas','Microondas perfecto estado. Quenta pero non cociña.',24,'microondas.jpg',7,'ddduran','Electrodomesticos'),('Abrigo naranja Zara','Abrigo de Zara de color naranja. Abriga mucho. Ideal para cuando tienes frío.',40,'abrigo.jpg',8,'barajas','Ropa'),('Balon de fútbol','Balón Mikasa. Es muy duro. No se recomienda golpearlo con la cabeza.',20,'mikasa.jpg',9,'laserraptor','Deportes'),('Mochila Frozen','Mochila de Frozen muy bonita. La vendo porque mi hija ya se ha hecho mayor. Pues con 20 años ya me dirás tú que hacía con esta mochila, pero bueno, a lo que iba porque al final me voy por las ramas y me pierdo, comprala por favor.',22,'mochila.jpg',11,'barajas','Niños'),('Figura Sora','Figura de Sora, personaje principal de la saga kingdom hearts. Buen estado. Chulísima.',135,'figurasora.jpg',10,'laserraptor','Videojuegos');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `alias` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('Samuel Ramilo Conde','laserraptor','root','luky.png'),('Ismael Vizcaya Somoza','barajas','root','vader.png'),('Daniel de Alonso Durán','ddduran','root','hansolo.png');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-04 19:02:19
