-- MySQL dump 10.16  Distrib 10.1.36-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: pu
-- ------------------------------------------------------
-- Server version	10.1.36-MariaDB

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
-- Table structure for table `centrals`
--

DROP TABLE IF EXISTS `centrals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centrals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `municipality_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `centrals_department_id_foreign` (`department_id`),
  KEY `centrals_municipality_id_foreign` (`municipality_id`),
  CONSTRAINT `centrals_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `centrals_municipality_id_foreign` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centrals`
--

LOCK TABLES `centrals` WRITE;
/*!40000 ALTER TABLE `centrals` DISABLE KEYS */;
INSERT INTO `centrals` VALUES (1,'Julio Enrique Montano Méndez',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(2,'Carlos Roderico Sandoval Chajón',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(3,'Tilly María Bickford Neutze',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(4,'Pedro Miguel Sallés Peña',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(5,'Hugo Francisco Del Cid Lima',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(6,'Marta Dina Morales',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(7,'Juan Fernando Barrientos Cruz',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42'),(8,'Carlos Ruben Subuyuj Gomez',7,79,'2019-01-29 18:30:42','2019-01-29 18:30:42');
/*!40000 ALTER TABLE `centrals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `prime` tinyint(1) NOT NULL DEFAULT '0',
  `legal` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Alta Verapaz',1,1),(2,'Baja Verapaz',0,1),(3,'Chimaltenango',0,0),(4,'Chiquimula',0,0),(5,'El Progreso',0,0),(6,'Escuintla',1,1),(7,'Guatemala',1,1),(8,'Huehuetenango',1,1),(9,'Izabal',0,1),(10,'Jalapa',0,1),(11,'Jutiapa',0,1),(12,'Petén',0,0),(13,'Quetzaltenango',1,0),(14,'Quiché',1,0),(15,'Retalhuleu',0,1),(16,'Sacatepéquez',0,1),(17,'San Marcos',1,1),(18,'Santa Rosa',0,1),(19,'Sololá',0,0),(20,'Suchitepéquez',0,0),(21,'Totonicapán',0,0),(22,'Zacapa',0,1);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deputies`
--

DROP TABLE IF EXISTS `deputies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deputies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `deputies_department_id_foreign` (`department_id`),
  CONSTRAINT `deputies_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deputies`
--

LOCK TABLES `deputies` WRITE;
/*!40000 ALTER TABLE `deputies` DISABLE KEYS */;
INSERT INTO `deputies` VALUES (1,'Byron Miguel Oliva Pereira',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(2,'Carlos Oswaldo Leal Martinez',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(3,'Oswaldo Pop Bac',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(4,'Ramon Bernardo Carcuz Castañeda',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(5,'Lanny Carolina Aparicio',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(6,'Douglas Tereso Pelaez Orellana',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(7,'Byron Miguel Oliva Sandoval',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(8,'Carlos Alberto Arrue Guzman',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(9,'Roberto Arturo Rossi Kuckling',1,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(10,'Gerson Geovanny Reyes Chajon',2,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(11,'Luis Alfredo Gonzalez Raymundo',2,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(12,'Alberto Hernandez Xoyon',3,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(13,'Emiliano Arturo Guzman Sandoval',3,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(14,'Angelica Del Rosario Patzan Quisque',3,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(15,'Maria Herminia Toj Atz',3,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(16,'Yeny Roxana Set Ixlay',3,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(17,'Evelin Yesena Estrada De La Cruz',5,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(18,'Eldifonso Paiz Bolvito',5,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(19,'Alvaro Estuardo Pazos Zacarias',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(20,'Chi Kin Chang Shum',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(21,'Elvis Yoel Gonzalez',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(22,'Hector Rodolfo Chic Roquel',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(23,'Elda Miriam Morales Lemuz',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(24,'Asbidio Tecun Lemus',6,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(25,'Lazaro Vinicio Zamora',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(26,'Alfredo Monroy',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(27,'Jose Conredo Garcia',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(28,'Limda Pena Barrillas',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(29,'Jose Alejandro Quijada',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(30,'David Monroy',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(31,'Ola Rosenda Ramos',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(32,'Margarita Solares',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(33,'Hugo Barrillas',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(34,'Alexander Blanco',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(35,'Rolando Ortiz Macario',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(36,'Omar Fernando Ruiz',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(37,'Nery Alberto Najera',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(38,'Mariano Rafael Arana Juarez',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(39,'Luis Antonio Monterroso',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(40,'Dora Luz Juarez De Arana',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(41,'Gustavo Adolfo Casasola',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(42,'Jorge Rafael Santos',7,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(43,'Oscar Platero',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(44,'Froylan Villatorro',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(45,'Luis Amado Escobar Ramos',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(46,'Oscar Alfredo Aguirre Villatoro',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(47,'Marco Tulio Toledo Villatoro',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(48,'Adalberto Jacinto Garcia',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(49,'Luis Fernando Toledo Matias',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(50,'Enio Jose Antonio Par Chavajay',8,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(51,'Marian Del Rosario Galindo Martinez',8,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(52,'Andre Velasquez Recinos',8,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(53,'Edgar Donaldo Lima Lopez',10,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(54,'Mario Stanley Monzon Herrera ',10,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(55,'Nudvia Siomara Solares Morales',10,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(56,'Adriana Elizabeth Giron Arango',12,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(57,'Sandra Patricia Rosado De Suarez',12,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(58,'Rafael Carmenate Medina',12,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(59,'Edgar Xuc Choc',12,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(60,'Giddel Eliel Zaso Perez',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(61,'William De Palermo',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(62,'Luis Diego Montenegro',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(63,'Gylmar Amarildo Perez Chiloj',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(64,'Pedro Tistoj Chang',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(65,'Mildred Alejandra Sarti Palacios',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(66,'Cristhian Alejandro Sazo Solis',13,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(67,'Noel Arameo Barillas Pelaez',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(68,'Juan Gutierrez Chajal',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(69,'Christian Francisco Flores Garcia',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(70,'Carlos Giovanni Gonzalez Chiguil',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(71,'Cesar Augusto Pozuelos Hernandez',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(72,'Otto Juan Perez Noriega',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(73,'Dora Elizabeth Tun Rompich',14,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(74,'Eddy Geovanni Paniagua Perez',16,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(75,'Hector Alejandro Arriola Lopez',16,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(76,'Antonia Juana De Jesus Vasquez Quiñonez',16,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(77,'Jeovani Miranda',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(78,'Edgardo Orozco Fuentes',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(79,'Azucena Fabiola Soto',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(80,'Francisco Perez Coronado',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(81,'Sonia Elvira De Leon Mendez',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(82,'Jose Humberto Bonilla',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(83,'Kevin Eli Diaz Ortiz',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(84,'Vinicio Rocael Miranda Vasquez',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(85,'Neptali Adolfo De Leon Mendez',17,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(86,'Valeska Leonor Castellanos Juarez',19,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(87,'Luis Perez Perez',19,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(88,'Luis Rodrigo Xinic Cortez',19,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(89,'Adolfo Armando Villagran Rivera',20,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(90,'Sorayda Mijangos De Gonzales',20,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(91,'Mario Ivan Alvarez Rivera',20,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(92,'Alma Veronica Coronado',20,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(93,'Roswald Robles Gramajo',21,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(94,'Giovanni Francisco Galicia O.',21,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(95,'Rowland Herman Lang Gonzalez',21,'2019-01-25 23:39:40','2019-01-25 23:39:40'),(96,'Diana Lourdes Lopez Chacon',21,'2019-01-25 23:39:40','2019-01-25 23:39:40');
/*!40000 ALTER TABLE `deputies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mayors`
--

DROP TABLE IF EXISTS `mayors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mayors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nominated` tinyint(1) NOT NULL DEFAULT '0',
  `signed_up` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` int(10) unsigned NOT NULL,
  `municipality_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mayors_department_id_foreign` (`department_id`),
  KEY `mayors_municipality_id_foreign` (`municipality_id`),
  CONSTRAINT `mayors_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `mayors_municipality_id_foreign` FOREIGN KEY (`municipality_id`) REFERENCES `municipalities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=186 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mayors`
--

LOCK TABLES `mayors` WRITE;
/*!40000 ALTER TABLE `mayors` DISABLE KEYS */;
INSERT INTO `mayors` VALUES (1,'Profesora Ana Maria Reyes',0,0,1,1,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(2,'Ing. Fabricio Hidalgo',0,0,1,4,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(3,'Gilma Dominga Asig Pop',0,0,1,6,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(4,'Prof. Jose Alfredo Mucu',0,0,1,7,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(5,'Juan Augusto Cal Cal',1,0,1,9,'2019-01-25 23:39:38','2019-01-30 00:35:47'),(6,'Oscar Garcia Chaman Ex. Alc.',0,0,1,12,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(7,'Ariel Caal',0,0,1,14,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(8,'Hugo Guzman',0,0,1,16,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(9,'Henry Artola',0,0,1,17,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(10,'Anibal Sarmiento',0,0,2,19,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(11,'Frans Cardona',0,0,2,20,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(12,'Manuel Aparicio Jeronimo',0,0,2,22,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(13,'Tin Cuellar-Carlos E. Solis Consej',0,0,2,24,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(14,'Edgar Adan Ixtecoc    Alc. Act',0,0,2,25,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(15,'Axel Simaj Alc. Act.',0,0,3,27,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(16,'Justo Rufino Similox Alc.act. ',0,0,3,28,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(17,'Alc. Act.',0,0,3,33,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(18,'Alc. Act.',0,0,3,37,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(19,'Lolo-Candida Corado',0,0,3,39,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(20,'Alc. Act.',0,0,3,40,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(21,'Melvin Mauricio Carranza M.',0,0,5,53,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(22,'Arnoldo Soto Caranza',0,0,5,54,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(23,'Jose Manuel Betancurth',0,0,5,55,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(24,'Mynor Perfecto Santos',0,0,5,56,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(25,'Mynor Monzon',0,0,5,57,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(26,'Gido Godinez',0,0,5,58,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(27,'Carlos Augusto Rodriguez Ruano',0,0,5,60,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(28,'Asbidio Tecun Florian',1,0,6,62,'2019-01-25 23:39:38','2019-01-30 00:36:59'),(29,'Mario Vitelio Yantuchi   Alc. Act. ',0,0,6,68,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(30,'Carlos Gonzalez',1,0,6,70,'2019-01-25 23:39:38','2019-01-30 00:37:12'),(31,'Rolando Guzman  Alc. Act.',0,0,6,71,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(32,'Sebastian Sierro',1,0,7,89,'2019-01-25 23:39:38','2019-01-30 00:31:31'),(33,'Esau Burgos',0,0,7,91,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(34,'Patricio Mendez',0,0,8,92,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(35,'Alejandro Ruiz Calderon',0,0,8,117,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(36,'Francisco Roman Jacinto',0,0,8,93,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(37,'Luis Velasquez',0,0,8,94,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(38,'Ramon Vargas',0,0,8,95,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(39,'Orlando Galvez',0,0,8,96,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(40,'Roderico Martinez',1,0,8,97,'2019-01-25 23:39:38','2019-01-30 00:36:28'),(41,'Diego Velasquez',1,0,8,98,'2019-01-25 23:39:38','2019-01-30 00:36:41'),(42,'Claudio Camposeco',0,0,8,99,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(43,'Francisco Isai Hidalgo Argueta',0,0,8,100,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(44,'Lucio Morales',0,0,8,101,'2019-01-25 23:39:38','2019-01-25 23:39:38'),(45,'Leopoldo Samayoa Ramos',0,0,8,102,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(46,'Yefry Diaz',0,0,8,103,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(47,'Luis Ricardo Garcia Cota',0,0,8,104,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(48,'Juan Garcia',0,0,8,107,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(49,'Filimon Carrillo',0,0,8,108,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(50,'Bartolo Matias',0,0,8,109,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(51,'Carlos Gonzales Sanchez',0,0,8,110,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(52,'Jose Mendoza',0,0,8,113,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(53,'Dimas Morales',0,0,8,115,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(54,'Alfredo Sales',0,0,8,116,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(55,'Diego Marcos',0,0,8,118,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(56,'Macario Jimenez',0,0,8,119,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(57,'Cruz Jeronimo Ramirez',0,0,8,122,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(58,'Hugo Woler',0,0,9,125,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(59,'Norma Hayde Cruz Ruedas',0,0,10,130,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(60,'Santos Arturo Najera Lima',0,0,10,133,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(61,'Misael Asencio Lopez',0,0,11,145,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(62,'Oscar Ronobel Loaysa Lopez',0,0,11,149,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(63,'Vitalino Duarte',0,0,12,154,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(64,'Marcos Fabian',0,0,12,155,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(65,'Alexia De Marin',0,0,12,156,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(66,'Mynor Suarez',0,0,12,157,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(67,'Ruben Sosa',0,0,12,158,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(68,'Moises Reynoso',0,0,12,159,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(69,'Jose Antonio Cac',0,0,12,160,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(70,'Efrain Aguilar',0,0,12,162,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(71,'Juan Cante',0,0,12,164,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(72,'Omar Caal',0,0,12,165,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(73,'Ernesto Rosado',0,0,12,167,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(74,'Manuel Bair',0,0,13,170,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(75,'Miguel Tixal',0,0,13,171,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(76,'Miguel Oroxon',0,0,13,179,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(77,'Lic. Romeo',0,0,13,181,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(78,'Rony Castillo',0,0,13,183,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(79,'Hector Ixcot',0,0,13,188,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(80,'Pablo Sanchez',0,0,14,193,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(81,'Luis Toj Rivera',0,0,14,195,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(82,'German Quib Caal',0,0,14,208,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(83,'Daniel Velasco',0,0,14,199,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(84,'Tomas De La Cruz',0,0,14,207,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(85,'Juan Baten',0,0,14,209,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(86,'Rogelio Natareno',0,0,14,211,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(87,'Miguel Tiquiran Olmos',0,0,14,212,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(88,'Samuel Benites',0,0,15,213,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(89,'Walter Sanchez Hernandez',0,0,15,214,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(90,'Anibal Calderon',0,0,15,216,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(91,'Melvin Arody Barrios Morales',0,0,15,217,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(92,'Justo Chojolan Iquic',0,0,15,220,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(93,'Luis Civil',1,0,16,222,'2019-01-25 23:39:39','2019-01-30 00:33:51'),(94,'Manuel Estrada',0,0,16,223,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(95,'Marco Tulio Vasquez',1,0,16,224,'2019-01-25 23:39:39','2019-01-30 00:33:36'),(96,'Eber Gudiel',1,0,16,225,'2019-01-25 23:39:39','2019-01-30 00:33:20'),(97,'Amilcar Escobar Marroquin',0,0,16,226,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(98,'Cesar Valle',0,0,16,227,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(99,'Sergio Enrique Perez',0,0,16,228,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(100,'Nombre Pendiente',0,0,16,229,'2019-01-25 23:39:39','2019-01-28 20:35:59'),(101,'Edgar García Sicilia',0,0,16,230,'2019-01-25 23:39:39','2019-01-28 21:04:55'),(102,'Otilio Barrientos',0,0,16,231,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(103,'Salomon Hernandez',0,0,16,232,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(104,'Mario Perez Pio',0,0,16,234,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(105,'Hector Francisco Sactic',0,0,16,235,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(106,'Nombre Pendiente',0,0,16,236,'2019-01-25 23:39:39','2019-01-28 20:34:49'),(113,'Misael Florentin Vasquez',1,0,17,255,'2019-01-25 23:39:39','2019-01-30 00:35:02'),(118,'Minchez',1,0,17,262,'2019-01-25 23:39:39','2019-01-30 01:14:15'),(122,'Luis Villegas',0,0,18,270,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(123,'Rocael Yuman',0,0,18,275,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(124,'Anibal Lanuza',0,0,18,281,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(125,'Gaspar Zapeta',0,0,19,284,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(126,'Jose Rufino Cumez Coroxon',0,0,19,285,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(127,'Jorge Perez Martin',0,0,19,286,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(128,'Marcelino Roquel Garcia',0,0,19,287,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(129,'Benedicto Ixtamer',0,0,19,288,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(130,'Adilio Amilcar Azañon De Leon',0,0,19,289,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(131,'Edwin Cua',0,0,19,290,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(132,'Benjamin Ujpan Petzey',0,0,19,291,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(133,'Francisco Gonzalez Mendez',0,0,19,292,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(134,'Oscar Matzer',0,0,19,294,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(135,'Alberto Zapeta',0,0,19,295,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(136,'Dolmo Heriberto Sulugui',0,0,19,297,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(137,'Jose Ramirez',0,0,19,299,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(138,'Miguel Natareno De La Cruz',0,0,20,301,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(139,'German Caal',0,0,20,303,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(140,'German Ruiz',0,0,20,304,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(141,'Celso Garcia',0,0,20,305,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(142,'Ever Garcia',0,0,20,306,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(144,'Rony Anibal Reyes',0,0,20,309,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(146,'Cristobal Salsa',0,0,20,311,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(148,'Victor Paredes',0,0,20,314,'2019-01-25 23:39:39','2019-01-28 21:06:32'),(151,'Luis Ovalle',0,0,20,317,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(153,'Jorge Aresti',0,0,20,319,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(154,'Martin Saquic Poroj',0,0,21,323,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(155,'Amarildo Chun Champet',0,0,21,324,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(156,'Marcos Francisco Mejia Sosa',0,0,21,325,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(157,'Alexander Alvarado',0,0,21,326,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(158,'Juan Antonio Lux',0,0,21,327,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(159,'Juan Justo Lux',0,0,21,328,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(160,'Manrique Duque',0,0,22,334,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(161,'Alcaldesa Actual',0,0,22,340,'2019-01-25 23:39:39','2019-01-25 23:39:39'),(162,'Luis Guerra Olivares',0,0,16,233,'2019-01-28 20:29:53','2019-01-28 20:29:53'),(164,'Alfredo Sanchez',0,0,20,308,'2019-01-28 21:05:57','2019-01-28 21:05:57'),(165,'Martha Ruth De Leon Cifuentes',0,0,20,313,'2019-01-28 21:07:03','2019-01-28 21:07:03'),(166,'Ambrocio Roblero',0,0,17,256,'2019-01-28 23:39:33','2019-01-28 23:39:33'),(167,'Victor Gonzalez',0,0,17,265,'2019-01-28 23:39:52','2019-01-28 23:46:44'),(168,'Ismael Gomez',0,0,17,266,'2019-01-28 23:40:17','2019-01-28 23:40:17'),(169,'Ing. Rafael Chavez',0,0,17,258,'2019-01-28 23:40:58','2019-01-28 23:40:58'),(170,'Marco Antonio Barrios',0,0,17,239,'2019-01-28 23:41:32','2019-01-28 23:41:32'),(171,'Lic. Jose Sanchez',0,0,17,249,'2019-01-28 23:41:54','2019-01-28 23:41:54'),(172,'Lic. Luis Barragan',0,0,17,244,'2019-01-28 23:42:16','2019-01-28 23:42:16'),(173,'Edwin Gomez',0,0,17,267,'2019-01-28 23:42:33','2019-01-28 23:42:33'),(174,'Ing. Rene De Leon',0,0,17,240,'2019-01-28 23:42:46','2019-01-28 23:42:46'),(175,'Estuardo Alvarado',0,0,17,253,'2019-01-28 23:43:05','2019-01-28 23:43:05'),(176,'Lic. Maximiliano Marroquin',0,0,17,257,'2019-01-28 23:43:26','2019-01-28 23:43:26'),(177,'Lic. Antonio Godinez',0,0,17,261,'2019-01-28 23:43:58','2019-01-28 23:43:58'),(178,'Genner Guzman',0,0,17,250,'2019-01-28 23:44:26','2019-01-28 23:44:26'),(179,'Sabino Alvarado',0,0,17,242,'2019-01-28 23:44:41','2019-01-28 23:44:41'),(180,'Manuel Perez',0,0,17,252,'2019-01-28 23:45:13','2019-01-28 23:45:13'),(181,'Erick Pocasangre',0,0,7,90,'2019-01-29 00:05:42','2019-01-29 00:05:42'),(182,'Gustavo Medrano',0,0,7,76,'2019-01-29 00:05:53','2019-01-29 00:05:53'),(183,'Rene Wollers',0,0,7,80,'2019-01-29 00:06:11','2019-01-29 00:06:11'),(184,'Rafita',0,0,7,82,'2019-01-29 00:06:24','2019-01-29 00:06:24'),(185,'Ricardo Quiñones',0,0,7,79,'2019-01-29 21:15:20','2019-01-29 21:15:20');
/*!40000 ALTER TABLE `mayors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=340 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (325,'2014_10_12_000000_create_users_table',1),(326,'2014_10_12_100000_create_password_resets_table',1),(327,'2015_01_20_084450_create_roles_table',1),(328,'2015_01_20_084525_create_role_user_table',1),(329,'2015_01_24_080208_create_permissions_table',1),(330,'2015_01_24_080433_create_permission_role_table',1),(331,'2015_12_04_003040_add_special_role_column',1),(332,'2017_10_17_170735_create_permission_user_table',1),(333,'2019_01_19_133845_create_departments_table',1),(334,'2019_01_19_133930_create_municipalities_table',1),(335,'2019_01_19_134046_create_mayors_table',1),(336,'2019_01_24_125423_create_deputies_table',1),(337,'2019_01_29_113551_create_nationals_table',2),(338,'2019_01_29_122523_create_centrals_table',3),(339,'2019_01_29_145555_add_nominated_and_signed_to_mayors_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `municipalities`
--

DROP TABLE IF EXISTS `municipalities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `municipalities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `prime` tinyint(1) NOT NULL DEFAULT '0',
  `legal` tinyint(1) NOT NULL DEFAULT '0',
  `department_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `municipalities_department_id_foreign` (`department_id`),
  CONSTRAINT `municipalities_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `municipalities`
--

LOCK TABLES `municipalities` WRITE;
/*!40000 ALTER TABLE `municipalities` DISABLE KEYS */;
INSERT INTO `municipalities` VALUES (1,'Cahabón',0,0,1),(2,'Chahal',0,0,1),(3,'Chisec',0,0,1),(4,'Cobán',0,1,1),(5,'Fray Bartolomé de las Casas',0,0,1),(6,'Lanquín',0,0,1),(7,'Panzós',0,0,1),(8,'Raxruhá',0,0,1),(9,'San Cristóbal Verapaz',0,1,1),(10,'San Juan Chamelco',0,1,1),(11,'San Pedro Carchá',0,0,1),(12,'Santa Catalina La Tinta',0,0,1),(13,'Santa Cruz Verapaz',0,0,1),(14,'Senahú',0,0,1),(15,'Tactic',0,0,1),(16,'Tamahú',0,1,1),(17,'Tucurú',0,1,1),(18,'Cubulco',0,0,2),(19,'El Chol',0,0,2),(20,'Granados',0,1,2),(21,'Purulhá',0,0,2),(22,'Rabinal',0,1,2),(23,'Salamá',0,1,2),(24,'San Jerónimo',0,1,2),(25,'San Miguel Chicaj',0,1,2),(26,'Acatenango',0,0,3),(27,'Chimaltenango',0,0,3),(28,'Comalapa',0,0,3),(29,'El Tejar',0,0,3),(30,'Parramos',0,0,3),(31,'Patzicía',0,0,3),(32,'Patzún',0,0,3),(33,'Pochuta',0,0,3),(34,'San Andrés Itzapa',0,0,3),(35,'San José Poaquil',0,0,3),(36,'San Martín Jilotepeque',0,0,3),(37,'Santa Apolonia',0,0,3),(38,'Santa Cruz Balanyá',0,0,3),(39,'Tecpán Guatemala',0,0,3),(40,'Yepocapa',0,0,3),(41,'Zaragoza',0,0,3),(42,'Camotán',0,0,4),(43,'Chiquimula',0,0,4),(44,'Concepción Las Minas',0,0,4),(45,'Esquipulas',0,0,4),(46,'Ipala',0,0,4),(47,'Jocotán',0,0,4),(48,'Olopa',0,0,4),(49,'Quetzaltepeque',0,0,4),(50,'San Jacinto',0,0,4),(51,'San José La Arada',0,0,4),(52,'San Juan La Ermita',0,0,4),(53,'El Jícaro',0,0,5),(54,'Guastatoya',0,0,5),(55,'Morazán',0,0,5),(56,'San Agustín Acasaguastlán',0,0,5),(57,'San Antonio La Paz',0,0,5),(58,'San Cristóbal Acasaguastlán',0,0,5),(59,'Sanarate',0,0,5),(60,'Sansare',0,0,5),(61,'Escuintla',0,0,6),(62,'Guanagazapa',0,1,6),(63,'Iztapa',0,0,6),(64,'La Democracia',0,0,6),(65,'La Gomera',0,1,6),(66,'Masagua',0,1,6),(67,'Nueva Concepción',0,1,6),(68,'Palín',0,0,6),(69,'San José',0,0,6),(70,'San Vicente Pacaya',0,1,6),(71,'Santa Lucía Cotzumalguapa',0,0,6),(72,'Siquinalá',0,1,6),(73,'Tiquisate',0,0,6),(74,'Sipacate',0,0,6),(75,'Amatitlán',0,1,7),(76,'Chinautla',0,1,7),(77,'Chuarrancho',0,0,7),(78,'Fraijanes',0,0,7),(79,'Guatemala',0,0,7),(80,'Mixco',0,1,7),(81,'Palencia',0,0,7),(82,'Petapa',0,0,7),(83,'San José del Golfo',0,0,7),(84,'San José Pinula',0,0,7),(85,'San Juan Sacatepéquez',0,0,7),(86,'San Pedro Ayampuc',0,0,7),(87,'San Pedro Sacatepéquez',0,0,7),(88,'San Raymundo',0,0,7),(89,'Santa Catarina Pinula',0,1,7),(90,'Villa Canales',0,1,7),(91,'Villa Nueva',0,0,7),(92,'Aguacatán',0,0,8),(93,'Chiantla',0,0,8),(94,'Colotenango',0,0,8),(95,'Concepción Huista',0,0,8),(96,'Cuilco',0,0,8),(97,'Huehuetenango',0,1,8),(98,'Ixtahuacán',0,1,8),(99,'Jacaltenango',0,0,8),(100,'La Democracia',0,0,8),(101,'La Libertad',0,0,8),(102,'Malacatancito',0,0,8),(103,'Nentón',0,0,8),(104,'San Antonio Huista',0,0,8),(105,'San Gaspar Ixchil',0,0,8),(106,'San Juan Atitlán',0,0,8),(107,'San Juan Ixcoy',0,0,8),(108,'San Mateo Ixtatán',0,0,8),(109,'San Miguel Acatán',0,0,8),(110,'San Pedro Necta',0,0,8),(111,'San Rafael La Independencia',0,0,8),(112,'San Rafael Petzal',0,1,8),(113,'San Sebastián Coatán',0,0,8),(114,'San Sebastián Huehuetenango',0,0,8),(115,'Santa Ana Huista',0,0,8),(116,'Santa Bárbara',0,0,8),(117,'Santa Cruz Barillas',0,0,8),(118,'Santa Eulalia',0,0,8),(119,'Santiago Chimaltenango',0,0,8),(120,'Soloma',0,0,8),(121,'Tectitán',0,0,8),(122,'Todos Santos Cuchumatán',0,0,8),(123,'Union Cantinil',0,1,8),(124,'Petatán',0,0,8),(125,'El Estor',0,1,9),(126,'Livingston',0,1,9),(127,'Los Amates',0,1,9),(128,'Morales',0,1,9),(129,'Puerto Barrios',0,1,9),(130,'Jalapa',0,1,10),(131,'Mataquescuintla',0,1,10),(132,'Monjas',0,1,10),(133,'San Carlos Alzatate',0,1,10),(134,'San Luis Jilotepeque',0,0,10),(135,'San Manuel Chaparrón',0,0,10),(136,'San Pedro Pinula',0,1,10),(137,'Agua Blanca',0,1,11),(138,'Asunción Mita',0,0,11),(139,'Atescatempa',0,0,11),(140,'Comapa',0,0,11),(141,'Conguaco',0,0,11),(142,'El Adelanto',0,0,11),(143,'El Progreso',0,0,11),(144,'Jalpatagua',0,0,11),(145,'Jerez',0,0,11),(146,'Jutiapa',0,1,11),(147,'Moyuta',0,1,11),(148,'Pasaco',0,1,11),(149,'Quesada',0,1,11),(150,'San José Acatempa',0,0,11),(151,'Santa Catarina Mita',0,0,11),(152,'Yupiltepeque',0,0,11),(153,'Zapotitlán',0,0,11),(154,'Dolores',0,0,12),(155,'El Chal',0,0,12),(156,'Flores',0,0,12),(157,'La Libertad',0,0,12),(158,'Las Cruces',0,0,12),(159,'Melchor de Mencos',0,0,12),(160,'Poptún',0,0,12),(161,'San Andrés',0,0,12),(162,'San Benito',0,0,12),(163,'San Francisco',0,0,12),(164,'San José',0,0,12),(165,'San Luis',0,0,12),(166,'Santa Ana',0,0,12),(167,'Sayaxché',0,0,12),(168,'Almolonga',0,0,13),(169,'Cabricán',0,0,13),(170,'Cajolá',0,0,13),(171,'Cantel',0,0,13),(172,'Coatepeque',0,0,13),(173,'Colomba',0,0,13),(174,'Concepción Chiquirichapa',0,0,13),(175,'El Palmar',0,0,13),(176,'Flores Costa Cuca',0,0,13),(177,'Génova',0,0,13),(178,'Huitán',0,0,13),(179,'La Esperanza',0,0,13),(180,'Olintepeque',0,0,13),(181,'Ostuncalco',0,0,13),(182,'Palestina de los Altos',0,0,13),(183,'Quetzaltenango',0,0,13),(184,'Salcajá',0,0,13),(185,'San Carlos Sija',0,0,13),(186,'San Francisco La Unión',0,0,13),(187,'San Martín Sacatepéquez',0,0,13),(188,'San Mateo',0,0,13),(189,'San Miguel Sigüila',0,0,13),(190,'Sibilia',0,0,13),(191,'Zunil',0,0,13),(192,'Canillá',0,0,14),(193,'Chajul',0,0,14),(194,'Chicamán',0,0,14),(195,'Chichicastenango',0,0,14),(196,'Chinique',0,0,14),(197,'Cunén',0,0,14),(198,'Joyabaj',0,0,14),(199,'Nebaj',0,0,14),(200,'Pachulum',0,0,14),(201,'Patzité',0,0,14),(202,'Quiché',0,0,14),(203,'Sacapulas',0,0,14),(204,'San Andrés Sajcabajá',0,0,14),(205,'San Antonio Ilotenango',0,0,14),(206,'San Bartolomé Jocotenango',0,0,14),(207,'San Juan Cotzal',0,0,14),(208,'San Luis Ixcán',0,0,14),(209,'San Pedro Jocopilas',0,0,14),(210,'Santa Cruz del Quiché',0,0,14),(211,'Uspantán',0,0,14),(212,'Zacualpa',0,0,14),(213,'Champerico',0,1,15),(214,'El Asintal',0,0,15),(215,'Nuevo San Carlos',0,1,15),(216,'Retalhuleu',0,1,15),(217,'San Andrés Villa Seca',0,1,15),(218,'San Felipe',0,0,15),(219,'San Martín Zapotitlán',0,0,15),(220,'San Sebastián',0,0,15),(221,'Santa Cruz Muluá',0,0,15),(222,'Alotenango',0,1,16),(223,'Antigua Guatemala',0,0,16),(224,'Ciudad Vieja',0,1,16),(225,'Jocotenango',0,1,16),(226,'Magdalena Milpas Altas',0,0,16),(227,'Pastores',0,0,16),(228,'San Antonio Aguas Calientes',0,0,16),(229,'San Bartolomé Milpas Altas',0,0,16),(230,'San Lucas Sacatepéquez',0,0,16),(231,'San Miguel Dueñas',0,1,16),(232,'Santa Catarina Barahona',0,0,16),(233,'Santa Lucía Milpas Altas',0,1,16),(234,'Santa María de Jesús',0,0,16),(235,'Santiago Sacatepéquez',0,0,16),(236,'Santo Domingo Xenacoj',0,0,16),(237,'Sumpango',0,0,16),(238,'Ayutla',0,0,17),(239,'Catarina',0,0,17),(240,'Comitancillo',0,1,17),(241,'Concepción Tutuapa',0,0,17),(242,'El Quetzal',0,0,17),(243,'El Rodeo',0,0,17),(244,'El Tumbador',0,0,17),(245,'Esquipulas Palo Gordo',0,0,17),(246,'Ixchiguán',0,0,17),(247,'La Blanca',0,0,17),(248,'La Reforma',0,0,17),(249,'Malacatán',0,0,17),(250,'Nuevo Progreso',0,0,17),(251,'Ocós',0,0,17),(252,'Pajapita',0,0,17),(253,'Río Blanco',0,0,17),(254,'San Antonio Sacatepéquez',0,0,17),(255,'San Cristóbal Cucho',0,1,17),(256,'San José Ojetenam',0,0,17),(257,'San Lorenzo',0,0,17),(258,'San Marcos',0,0,17),(259,'San Miguel Ixtahuacán',0,0,17),(260,'San Pablo',0,0,17),(261,'San Pedro Sacatepéquez',0,1,17),(262,'San Rafael Pie de La Cuesta',0,1,17),(263,'Sibinal',0,0,17),(264,'Sipacapa',0,0,17),(265,'Tacaná',0,0,17),(266,'Tajumulco',0,0,17),(267,'Tejutla',0,0,17),(268,'Barberena',0,0,18),(269,'Casillas',0,0,18),(270,'Chiquimulilla',0,1,18),(271,'Cuilapa',0,1,18),(272,'Guazacapán',0,1,18),(273,'Nueva Santa Rosa',0,0,18),(274,'Oratorio',0,1,18),(275,'Pueblo Nuevo Viñas',0,0,18),(276,'San Juan Tecuaco',0,0,18),(277,'San Rafael Las Flores',0,0,18),(278,'Santa Cruz Naranjo',0,0,18),(279,'Santa María Ixhuatán',0,1,18),(280,'Santa Rosa de Lima',0,0,18),(281,'Taxisco',0,0,18),(282,'Concepción',0,0,19),(283,'Nahualá',0,0,19),(284,'Panajachel',0,0,19),(285,'San Andrés Semetabaj',0,0,19),(286,'San Antonio Palopó',0,0,19),(287,'San José Chacayá',0,0,19),(288,'San Juan La Laguna',0,0,19),(289,'San Lucas Tolimán',0,0,19),(290,'San Marcos La Laguna',0,0,19),(291,'San Pablo La Laguna',0,0,19),(292,'San Pedro La Laguna',0,0,19),(293,'Santa Catarina Ixtahuacán',0,0,19),(294,'Santa Catarina Palopó',0,0,19),(295,'Santa Clara La Laguna',0,0,19),(296,'Santa Cruz La Laguna',0,0,19),(297,'Santa Lucía Utatlán',0,0,19),(298,'Santa María Visitación',0,0,19),(299,'Santiago Atitlán',0,0,19),(300,'Sololá',0,0,19),(301,'Chicacao',0,0,20),(302,'Cuyotenango',0,0,20),(303,'Mazatenango',0,0,20),(304,'Patulul',0,0,20),(305,'Pueblo Nuevo',0,0,20),(306,'Río Bravo',0,0,20),(307,'Samayac',0,0,20),(308,'San Antonio Suchitepéquez',0,0,20),(309,'San Bernardino',0,0,20),(310,'San Francisco Zapotitlán',0,0,20),(311,'San Gabriel',0,0,20),(312,'San José El Ídolo',0,0,20),(313,'San José La Maquina',0,0,20),(314,'San Juan Bautista',0,0,20),(315,'San Lorenzo',0,0,20),(316,'San Miguel Panán',0,0,20),(317,'San Pablo Jocopilas',0,0,20),(318,'Santa Bárbara',0,0,20),(319,'Santo Domingo Suchitepéquez',0,0,20),(320,'Santo Tomás la Unión',0,0,20),(321,'Zunilito',0,0,20),(322,'Momostenango',0,0,21),(323,'San Andrés Xecul',0,0,21),(324,'San Bartolo',0,0,21),(325,'San Cristóbal Totonicapán',0,0,21),(326,'San Francisco El Alto',0,0,21),(327,'Santa Lucía La Reforma',0,0,21),(328,'Santa María Chiquimula',0,0,21),(329,'Totonicapán',0,0,21),(330,'Cabañas',0,0,22),(331,'Estanzuela',0,0,22),(332,'Gualán',0,1,22),(333,'Huité',0,0,22),(334,'La Unión',0,1,22),(335,'Río Hondo',0,0,22),(336,'San Diego',0,0,22),(337,'San Jorge',0,0,22),(338,'Teculután',0,0,22),(339,'Usumatlán',0,1,22),(340,'Zacapa',0,1,22);
/*!40000 ALTER TABLE `municipalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nationals`
--

DROP TABLE IF EXISTS `nationals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nationals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nationals`
--

LOCK TABLES `nationals` WRITE;
/*!40000 ALTER TABLE `nationals` DISABLE KEYS */;
INSERT INTO `nationals` VALUES (1,'Alvaro Arzu Escobar','2019-01-29 17:44:19','2019-01-29 17:44:19'),(2,'Hugo Enrique Peña Medina','2019-01-29 17:44:19','2019-01-29 17:44:19'),(3,'José Alejandro Martinez Contreras','2019-01-29 17:44:19','2019-01-29 17:44:19'),(4,'Kevin Anibal Cabrera Orellana','2019-01-29 17:44:19','2019-01-29 17:44:19'),(5,'Javier Alejandro Cifuentes Gándara','2019-01-29 17:44:19','2019-01-29 17:44:19'),(6,'Mariela Mishel Girón Guerra','2019-01-29 17:44:19','2019-01-29 17:44:19'),(7,'Miriam Edith Cardenas Castellon','2019-01-29 17:44:19','2019-01-29 17:44:19'),(8,'Milton Alexander Palencia Rangel','2019-01-29 17:44:19','2019-01-29 17:44:19'),(9,'Rodolfo Estuardo Santizo Asturias','2019-01-29 17:44:19','2019-01-29 17:44:19'),(10,'Luis Stuardo Monroy Guillen ','2019-01-29 17:44:19','2019-01-29 17:44:19'),(11,'Karla Mishelle Pineda Guerrero','2019-01-29 17:44:19','2019-01-29 17:44:19'),(12,'José Emmanuel Camey Morales','2019-01-29 17:44:19','2019-01-29 17:44:19'),(13,'Gladis Noemi Ibañez López','2019-01-29 17:44:19','2019-01-29 17:44:19'),(14,'Carlos Gerardo Jeronimo Mérida','2019-01-29 17:44:19','2019-01-29 17:44:19'),(15,'Luis Fernando Roldán Caballeros','2019-01-29 17:44:19','2019-01-29 17:44:19'),(16,'Mónica Lorena Miller Aragón ','2019-01-29 17:44:19','2019-01-29 17:44:19'),(17,'Marco Tulio Estrada','2019-01-29 17:44:19','2019-01-29 17:44:19'),(18,'Orifiel Alejandro Castañon Dueñas','2019-01-29 17:44:19','2019-01-29 17:44:19'),(19,'Hermes Francisco Lara Bernardino ','2019-01-29 17:44:19','2019-01-29 17:44:19'),(20,'Claudia Elizabeth Arévalo Gomez De Cifuentes','2019-01-29 17:44:19','2019-01-29 17:44:19'),(21,'Miguel Angel Lázaro Lemus','2019-01-29 17:44:19','2019-01-29 17:44:19'),(22,'Victor Hugo Lix Martinez','2019-01-29 17:44:19','2019-01-29 17:44:19'),(23,'Erick Fernando Monroy Navas','2019-01-29 17:44:19','2019-01-29 17:44:19'),(24,'Pablo Fernando Santos Samayoa','2019-01-29 17:44:19','2019-01-29 17:44:19'),(25,'Jans Ronaldo Cifuentes López','2019-01-29 17:44:19','2019-01-29 17:44:19'),(26,'Sergio Emilio Garcia Oxlaj','2019-01-29 17:44:19','2019-01-29 17:44:19');
/*!40000 ALTER TABLE `nationals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_user_permission_id_index` (`permission_id`),
  KEY `permission_user_user_id_index` (`user_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_user`
--

LOCK TABLES `permission_user` WRITE;
/*!40000 ALTER TABLE `permission_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` text COLLATE utf8mb4_spanish_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'Listar Usuarios','users.index','Permite listar todos los usuarios del sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(2,'Crear Usuarios','users.create','Permite crear usuarios en el sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(3,'Ver Usuario','users.show','Permite ver la información de un usuario','2019-01-25 23:39:36','2019-01-25 23:39:36'),(4,'Editar Usuario','users.edit','Permite editar usuarios en el sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(5,'Eliminar Usuario','users.destroy','Permite eliminar usuarios en el sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(6,'Listar Roles','roles.index','Permite listar todos los roles del sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(7,'Crear Roles','roles.create','Permite crear roles en el sistema','2019-01-25 23:39:36','2019-01-25 23:39:36'),(8,'Ver Rol','roles.show','Permite ver la información de un usuario','2019-01-25 23:39:36','2019-01-25 23:39:36'),(9,'Editar Rol','roles.edit','Permite editar roles en el sistema','2019-01-25 23:39:37','2019-01-25 23:39:37'),(10,'Eliminar Rol','roles.destroy','Permite eliminar roles en el sistema','2019-01-25 23:39:37','2019-01-25 23:39:37');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1,1,'2019-01-25 23:39:36','2019-01-25 23:39:36');
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `description` text COLLATE utf8mb4_spanish_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador del sistema','admin','Usuario administrador','2019-01-25 23:39:36','2019-01-25 23:39:36','all-access');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Gerardo','Mérida','cgemerida@gmail.com','gmerida','$2y$10$12mJ74exkeuQCWgMWp98VuW585ihQJOqkhicTprv9F.4UA9C1Usb2','pdKsWA250i4pIbZ64sg2zzOeyjiPj3z9o0MDAzyfVIUpmTtDoRm3A9eIxY1p','2019-01-25 23:39:36','2019-01-25 23:39:36',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-29 19:15:40
