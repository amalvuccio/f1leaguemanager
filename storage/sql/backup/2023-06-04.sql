-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: f1leaguemanager_test
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.27-MariaDB

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
-- Table structure for table `championship_drivers`
--

DROP TABLE IF EXISTS `championship_drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `championship_drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `season_id` int(11) unsigned NOT NULL,
  `driver_id` int(11) unsigned NOT NULL,
  `race_id` int(11) unsigned NOT NULL,
  `points` int(11) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seasonId_idx` (`season_id`),
  KEY `driverId_idx` (`driver_id`),
  KEY `raceId_idx` (`race_id`),
  KEY `cs_drivers_leagueID_idx` (`league_id`),
  CONSTRAINT `cs_drivers_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_drivers_leagueID` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_drivers_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_drivers_season` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `championship_drivers`
--

LOCK TABLES `championship_drivers` WRITE;
/*!40000 ALTER TABLE `championship_drivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `championship_drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `championship_teams`
--

DROP TABLE IF EXISTS `championship_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `championship_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `points` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cs_teams_season_idx` (`season_id`),
  KEY `cs_teams_race_idx` (`race_id`),
  KEY `cs_teams_team_idx` (`constructor_id`),
  KEY `cs_teams_league_idx` (`league_id`),
  CONSTRAINT `cs_teams_league` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_teams_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_teams_season` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `cs_teams_team` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `championship_teams`
--

LOCK TABLES `championship_teams` WRITE;
/*!40000 ALTER TABLE `championship_teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `championship_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `competitions`
--

DROP TABLE IF EXISTS `competitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `competitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `competitions`
--

LOCK TABLES `competitions` WRITE;
/*!40000 ALTER TABLE `competitions` DISABLE KEYS */;
INSERT INTO `competitions` VALUES (1,1,'Keller Racing League Season 1',NULL,NULL,NULL),(2,1,'Split A','2023-06-01 15:18:29','2023-06-01 15:18:29',NULL),(3,1,'Split B','2023-06-01 15:18:29','2023-06-01 15:18:29',NULL);
/*!40000 ALTER TABLE `competitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `constructors`
--

DROP TABLE IF EXISTS `constructors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `constructors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `name_game` varchar(45) DEFAULT NULL,
  `name_ocr` varchar(45) DEFAULT NULL,
  `allowed_drivers` int(2) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `constructors`
--

LOCK TABLES `constructors` WRITE;
/*!40000 ALTER TABLE `constructors` DISABLE KEYS */;
INSERT INTO `constructors` VALUES (1,'Mercedes-AMG Petronas','Mercedes-AMG Petronas','Mercedes-AMGPetronas',2,NULL,NULL,NULL),(2,'Ferrari','Ferrari','Ferrari',2,NULL,NULL,NULL),(3,'Red Bull','Red Bull','RedBull',2,NULL,NULL,NULL),(4,'Alpine','Alpine','Alpine',2,NULL,NULL,NULL),(5,'McLaren','McLaren','McLaren',2,NULL,NULL,NULL),(6,'Aston Martin','Aston Martin','AstonMartin',2,NULL,NULL,NULL),(7,'AlphaTauri','AlphaTauri','AlphaTauri',2,NULL,NULL,NULL),(8,'Alfa Romeo ORLEN','Alfa Romeo ORLEN','AlfaRomeoORLEN',2,NULL,NULL,NULL),(9,'Williams Racing','Williams Racing','WilliamsRacing',2,NULL,NULL,NULL),(10,'Haas','Haas','Haas',2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `constructors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `principal_id` int(10) unsigned NOT NULL,
  `length` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `league_id_idx` (`league_id`),
  KEY `season_id_idx` (`season_id`),
  KEY `driver_id_idx` (`driver_id`),
  KEY `constructor_id_idx` (`constructor_id`),
  CONSTRAINT `constructor_id` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `driver_id` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `league_id` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `season_id` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,1,1,13,3,0,1,'2023-06-01 16:09:20','2023-06-01 16:09:20',NULL),(2,1,1,14,3,0,1,'2023-06-01 16:13:12','2023-06-01 16:13:12',NULL),(3,1,1,29,1,0,1,'2023-06-01 23:21:01','2023-06-01 23:21:01',NULL),(4,1,1,30,1,0,1,'2023-06-01 23:21:08','2023-06-01 23:21:08',NULL),(5,1,1,20,2,0,1,'2023-06-01 23:21:21','2023-06-01 23:21:21',NULL),(6,1,1,19,2,0,1,'2023-06-01 23:21:26','2023-06-01 23:21:26',NULL),(7,1,1,27,4,0,1,'2023-06-01 23:21:36','2023-06-01 23:21:36',NULL),(8,1,1,28,4,0,1,'2023-06-01 23:21:42','2023-06-01 23:21:42',NULL),(9,1,1,26,5,0,1,'2023-06-01 23:21:54','2023-06-01 23:21:54',NULL),(10,1,1,25,5,0,1,'2023-06-01 23:21:57','2023-06-01 23:21:57',NULL),(11,1,1,32,6,0,1,'2023-06-01 23:22:18','2023-06-01 23:22:18',NULL),(12,1,1,31,6,0,1,'2023-06-01 23:22:20','2023-06-01 23:22:20',NULL),(13,1,1,24,7,0,1,'2023-06-01 23:22:39','2023-06-01 23:22:39',NULL),(14,1,1,15,8,0,1,'2023-06-01 23:22:52','2023-06-01 23:22:52',NULL),(15,1,1,16,8,0,1,'2023-06-01 23:22:54','2023-06-01 23:22:54',NULL),(16,1,1,17,9,0,1,'2023-06-01 23:23:09','2023-06-01 23:23:09',NULL),(17,1,1,18,9,0,1,'2023-06-01 23:23:11','2023-06-01 23:23:11',NULL),(18,1,1,21,10,0,1,'2023-06-01 23:23:24','2023-06-01 23:23:24',NULL),(19,1,1,22,10,0,1,'2023-06-01 23:23:26','2023-06-01 23:23:26',NULL);
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `competition_id` int(10) unsigned NOT NULL,
  `name_discord` varchar(45) NOT NULL,
  `name_psn` varchar(45) DEFAULT 'null',
  `name_ingame` varchar(45) DEFAULT 'null',
  `platform` varchar(45) DEFAULT 'null',
  `name` varchar(45) DEFAULT 'null',
  `age` int(10) unsigned DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driver_league` (`competition_id`),
  KEY `dleague_idx` (`competition_id`),
  KEY `dleague` (`competition_id`),
  KEY `driver_league_idx` (`league_id`),
  CONSTRAINT `driver_competition` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `driver_leagueID` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (13,1,1,'Clemente1804','Clemente1804','Clemente1804','psn','Julian',NULL,'2023-03-03 12:59:05','2023-03-03 12:59:05',NULL),(14,1,1,'Basti1997-TJ','Basti1997-TJ','Basti1997-TJ','psn','Basti',NULL,'2023-03-03 13:02:32','2023-03-03 13:02:32',NULL),(15,1,1,'ToniTempo','ToniTempo','ToniTempo','psn','Roman',NULL,'2023-03-03 13:02:57','2023-03-03 13:02:57',NULL),(16,1,1,'Julianus33','Julianus33','Julianus33','psn','Clemens',NULL,'2023-03-03 13:03:13','2023-03-03 13:03:13',NULL),(17,1,1,'willi87_94','willi87_94','willi87_94','psn','willi',NULL,'2023-03-03 13:04:05','2023-03-03 13:04:05',NULL),(18,1,1,'ObNöKhEsLeZ','ObNöKhEsLeZ','ObNöKhEsLeZ','psn','Kevin',NULL,'2023-03-03 13:04:39','2023-03-03 13:04:39',NULL),(19,1,1,'Mathador1887','Mathador1887','Mathador1887','psn','Christian',NULL,'2023-03-03 13:05:10','2023-03-03 13:05:10',NULL),(20,1,1,'xbatchris','xbatchris','xbatchris','psn','Chris',NULL,'2023-03-03 13:05:21','2023-03-03 13:05:21',NULL),(21,1,1,'prefy_','prefy_','prefy_','EA',NULL,NULL,'2023-03-03 13:06:01','2023-03-03 13:06:01',NULL),(22,1,1,'DMK160988','DMK160988','DMK160988','psn',NULL,NULL,'2023-03-03 13:06:18','2023-03-03 13:06:18',NULL),(23,1,1,'Cuyahoga89','Cuyahoga89','Cuyahoga89','psn','Marco',NULL,'2023-03-03 13:06:46','2023-03-03 13:06:46',NULL),(24,1,1,'HamburgerJung84','HamburgerJung84','HamburgerJung84','psn','Marcel',NULL,'2023-03-03 13:07:14','2023-03-03 13:07:14',NULL),(25,1,1,'Ronlu222','Ronlu222','Ronlu222','psn','Ronny',NULL,'2023-03-03 13:07:55','2023-03-03 13:07:55',NULL),(26,1,1,'SBBela','SBBela','SBBela','psn','Sören',NULL,'2023-03-03 13:08:08','2023-03-03 13:08:08',NULL),(27,1,1,'Dezin','Dezin','Dezin','steam','Lorenzo',NULL,'2023-03-03 13:08:26','2023-03-03 13:08:26',NULL),(28,1,1,'Tizian','Tizian','tiz_haa','steam','Tizian',NULL,'2023-03-03 13:08:44','2023-03-03 13:08:44',NULL),(29,1,1,'LSjOM7','LSjOM7','LSjOM7','psn','Alessio',NULL,'2023-03-03 13:09:13','2023-03-03 13:09:13',NULL),(30,1,1,'Maxinator0904','Maxinator0904','Maxinator0904','psn','Max',NULL,'2023-03-03 13:09:41','2023-03-03 13:09:41',NULL),(31,1,1,'Nobbler1975','Nobbler1975','Nobbler1975','EA','Nobby',NULL,'2023-03-03 13:10:22','2023-03-03 13:10:22',NULL),(32,1,1,'Janosch077','Janosch077','Janosch077','EA','Swen',NULL,'2023-03-03 13:10:43','2023-03-03 13:10:43',NULL),(33,1,1,'Mlody_35','mlody_35','mlody_35','psn','Kuba',NULL,'2023-06-02 14:01:11','2023-06-02 14:01:11',NULL),(34,1,1,'xPhilippFCB','xPhilippFCB','xPhilippFCB','psn','Philipp',22,'2023-06-03 12:05:41','2023-06-03 12:05:41',NULL),(35,1,1,'xy_Ramrod_yx','xy_Ramrod_yx','xy_Ramrod_yx','psn','Sebastian',38,'2023-06-03 12:06:10','2023-06-03 12:06:10',NULL),(36,1,1,'ag_323_ha','ag_323_ha','ag_323_ha','psn','Adrian',32,'2023-06-03 12:06:26','2023-06-03 12:06:26',NULL),(37,1,1,'SDC_Beesel','SDC_Beesel','SDC_Beesel','psn','Tony',34,'2023-06-03 12:06:39','2023-06-03 12:06:39',NULL),(38,1,1,'Riccihsv201','Riccihsv201','Riccihsv201','psn','Ricci',NULL,'2023-06-03 21:20:20','2023-06-03 21:20:20',NULL),(39,1,1,'Ghost_Ali_13','Ghost_Ali_13','Ghost_Ali_13','psn',NULL,NULL,'2023-06-03 21:46:53','2023-06-03 21:46:53',NULL),(40,1,1,'aka_scharfi_82','aka_scharfi_82','aka_scharfi_82','psn',NULL,NULL,'2023-06-03 21:47:10','2023-06-03 21:47:10',NULL),(41,1,1,'STREAM_SOLO','STREAM_SOLO','STREAM_SOLO','psn',NULL,NULL,'2023-06-03 22:06:17','2023-06-03 22:06:17',NULL),(42,1,1,'CRL_Bayernfreaky','CRL_Bayernfreaky','CRL_Bayernfreaky','psn',NULL,NULL,'2023-06-03 22:16:20','2023-06-03 22:16:20',NULL),(43,1,1,'DschoAkim','DschoAkim','DschoAkim','psn',NULL,NULL,'2023-06-03 22:41:46','2023-06-03 22:41:46',NULL);
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leagues`
--

DROP TABLE IF EXISTS `leagues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leagues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leagues`
--

LOCK TABLES `leagues` WRITE;
/*!40000 ALTER TABLE `leagues` DISABLE KEYS */;
INSERT INTO `leagues` VALUES (1,'Keller Racing League',NULL,NULL,NULL);
/*!40000 ALTER TABLE `leagues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penalties_drivers`
--

DROP TABLE IF EXISTS `penalties_drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penalties_drivers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `pen_points` int(10) unsigned DEFAULT NULL,
  `pen_grid` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pen_race_idx` (`race_id`),
  KEY `pen_driver_idx` (`driver_id`),
  KEY `pen_leagueId` (`league_id`),
  CONSTRAINT `pen_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pen_leagueId` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pen_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penalties_drivers`
--

LOCK TABLES `penalties_drivers` WRITE;
/*!40000 ALTER TABLE `penalties_drivers` DISABLE KEYS */;
/*!40000 ALTER TABLE `penalties_drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penalties_teams`
--

DROP TABLE IF EXISTS `penalties_teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penalties_teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `pen_points` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pen_race_idx` (`race_id`),
  KEY `penalty_team_idx` (`constructor_id`),
  KEY `penalty_league_idx` (`league_id`),
  CONSTRAINT `penalty_league` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `penalty_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `penalty_team` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penalties_teams`
--

LOCK TABLES `penalties_teams` WRITE;
/*!40000 ALTER TABLE `penalties_teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `penalties_teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_lineup`
--

DROP TABLE IF EXISTS `race_lineup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `race_lineup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `race_id` int(10) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lineup_race_idx` (`race_id`),
  KEY `lineup_team_data_idx` (`constructor_id`),
  KEY `lineup_driver_idx` (`driver_id`),
  KEY `raceLineup_leagueID_idx` (`league_id`),
  CONSTRAINT `lineup_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lineup_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `lineup_team_data` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `raceLineup_leagueID` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_lineup`
--

LOCK TABLES `race_lineup` WRITE;
/*!40000 ALTER TABLE `race_lineup` DISABLE KEYS */;
/*!40000 ALTER TABLE `race_lineup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `race_results`
--

DROP TABLE IF EXISTS `race_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `race_results` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `race_id` int(11) unsigned NOT NULL,
  `driver_id` int(11) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `pos_quali` char(3) NOT NULL,
  `pos_grid` int(2) NOT NULL,
  `pos_race` char(3) NOT NULL,
  `personal_best_lap` varchar(45) DEFAULT NULL,
  `time_pen` int(2) DEFAULT NULL,
  `fastest_lap` tinyint(1) DEFAULT NULL,
  `dnf` tinyint(1) DEFAULT NULL,
  `dsq` tinyint(1) DEFAULT NULL,
  `race_time` varchar(45) DEFAULT NULL,
  `pit_stops` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `result_race_idx` (`race_id`),
  KEY `resullt_driver_idx` (`driver_id`),
  KEY `result_team_idx` (`constructor_id`),
  KEY `result_leagueId_idx` (`league_id`),
  CONSTRAINT `resullt_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `result_leagueId` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `result_race` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `result_team` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=937 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `race_results`
--

LOCK TABLES `race_results` WRITE;
/*!40000 ALTER TABLE `race_results` DISABLE KEYS */;
INSERT INTO `race_results` VALUES (628,1,1,33,8,'2',2,'1','1:10.842',3,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(629,1,1,25,5,'3',3,'2','1:10.394',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(630,1,1,14,3,'11',11,'3','1:10.154',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(631,1,1,20,2,'5',5,'4','1:11.124',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(632,1,1,13,3,'1',1,'5','1:10.736',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(633,1,1,28,4,'4',4,'6','1:11.124',3,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(634,1,1,27,4,'13',13,'7','1:10.876',3,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(635,1,1,26,5,'6',6,'8','1:10.549',3,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(636,1,1,30,10,'9',9,'9','1:11.403',6,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(637,1,1,34,7,'10',10,'10','1:11.202',8,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(638,1,1,18,9,'15',15,'11','1:11.334',5,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(639,1,1,19,2,'8',8,'12','1:10.510',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(640,1,1,32,6,'17',17,'13','1:11.002',5,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(641,1,1,21,10,'7',7,'14','1:10.452',0,0,0,0,'null',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(642,1,1,35,1,'12',12,'15','1:11.163',8,0,0,0,'null',2,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(643,1,1,31,6,'18',18,'16','1:11.128',0,0,0,0,'null',2,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(644,1,1,15,8,'16',16,'17','1:10.797',0,0,0,0,'null',2,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(645,1,1,23,7,'14',14,'18','1:10.143',1,0,0,0,'+1Runde',3,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(646,1,1,36,9,'20',20,'19','1:13.361',11,0,0,0,'+1Runde',1,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(647,1,1,37,1,'19',19,'20','1:11.351',5,0,1,0,'DNF',2,'2023-06-03 16:22:43','2023-06-03 16:22:43',NULL),(648,1,2,14,3,'4',4,'1','1:42.845',3,0,0,0,'60:25.321',1,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(649,1,2,29,1,'3',3,'2','1:42.989',0,0,0,0,'+1.314',1,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(650,1,2,27,4,'9',9,'3','1:43.689',0,0,0,0,'+1.842',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(651,1,2,30,1,'19',19,'4','1:43.943',0,0,0,0,'+4.353',1,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(652,1,2,33,9,'1',1,'5','1:41.234',0,0,0,0,'+4.945',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(653,1,2,22,10,'11',11,'6','1:43.664',3,0,0,0,'+8.556',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(654,1,2,28,4,'12',12,'7','1:42.833',9,0,0,0,'+11.564',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(655,1,2,13,3,'5',5,'8','1:43.097',0,0,0,0,'+14.007',4,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(656,1,2,32,6,'7',7,'9','1:43.033',0,0,0,0,'+17.521',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(657,1,2,24,7,'20',20,'10','1:44.141',0,0,0,0,'+36.536',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(658,1,2,26,5,'6',6,'11','1:43.815',0,0,0,0,'+50.454',4,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(659,1,2,18,9,'10',10,'12','1:44.013',3,0,0,0,'+55.897',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(660,1,2,16,8,'15',15,'13','1:44.678',6,0,0,0,'+55.901',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(661,1,2,34,2,'13',13,'14','1:43.998',3,0,0,0,'+1:04.743',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(662,1,2,15,8,'16',16,'15','1:44.819',3,0,0,0,'+1:04.915',3,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(663,1,2,25,5,'2',2,'16','1:42.985',10,0,0,0,'+1Runde',5,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(664,1,2,23,7,'14',14,'17','1:42.946',1,0,0,0,'+1Runde',5,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(665,1,2,31,6,'17',17,'18','1:43.609',0,0,1,0,'DNF',1,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(666,1,2,19,2,'18',18,'19','1:44.061',0,0,1,0,'DNF',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(667,1,2,21,10,'8',8,'20','1:44.943',0,0,1,0,'DNF',2,'2023-06-03 18:14:48','2023-06-03 18:14:48',NULL),(668,1,3,20,2,'1',1,'1','1:14.281',0,0,0,0,'48:52.864',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(669,1,3,32,6,'4',4,'2','1:14.051',0,0,0,0,'+1.634',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(670,1,3,29,1,'3',3,'3','1:14.007',0,0,0,0,'+3.293',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(671,1,3,26,5,'5',5,'4','1:14.301',0,0,0,0,'+5.132',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(672,1,3,31,6,'14',14,'5','1:14.347',3,0,0,0,'+6.565',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(673,1,3,17,9,'7',7,'6','1:14.401',3,0,0,0,'+7.174',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(674,1,3,25,5,'8',8,'7','1:14.289',0,0,0,0,'+8.709',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(675,1,3,13,3,'10',10,'8','1:14.094',3,0,0,0,'+11.186',2,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(676,1,3,15,8,'15',15,'9','1:15.139',3,0,0,0,'+13.158',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(677,1,3,21,10,'2',2,'10','1:14.594',3,0,0,0,'+13.519',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(678,1,3,14,3,'12',12,'11','1:14.443',9,0,0,0,'+17.822',2,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(679,1,3,18,9,'9',9,'12','1:14.366',9,0,0,0,'+18.009',2,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(680,1,3,23,7,'11',11,'13','1:14.950',6,0,0,0,'+18.220',3,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(681,1,3,22,10,'13',13,'14','1:14.204',9,0,0,0,'+20.135﻿',3,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(682,1,3,16,8,'17',17,'15','1:15.012',9,0,0,0,'+21.680',1,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(683,1,3,36,4,'18',18,'16','1:17.262',1,0,0,0,'+1Runde',2,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(684,1,3,33,7,'6',6,'17','1:12.477',3,0,1,0,'DNF',4,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(685,1,3,27,4,'16',16,'18','1:14.626',0,0,1,0,'DNF',0,'2023-06-03 18:25:52','2023-06-03 18:25:52',NULL),(686,1,4,28,4,'4',4,'1','1:31.158',0,0,0,0,'40:29.541',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(687,1,4,20,2,'8',8,'2','1:31.093',0,0,0,0,'+0.645',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(688,1,4,13,3,'2',2,'3','1:30.317',0,0,0,0,'+1.448',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(689,1,4,27,4,'1',1,'4','1:31.175',5,0,0,0,'+2.121',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(690,1,4,26,5,'6',6,'5','1:31.080',5,0,0,0,'+2.734',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(691,1,4,32,6,'3',3,'6','1:31.299',6,0,0,0,'+5.093',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(692,1,4,29,1,'9',9,'7','1:30.198',0,0,0,0,'+6.000',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(693,1,4,18,9,'7',7,'8','1:31.260',0,0,0,0,'+6.270',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(694,1,4,25,5,'20',20,'9','1:30.614',0,0,0,0,'+11.757',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(695,1,4,31,6,'17',17,'10','1:30.712',0,0,0,0,'+12.126',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(696,1,4,17,9,'12',12,'11','1:31.514',0,0,0,0,'+17.094',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(697,1,4,21,10,'16',16,'12','1:31.074',0,0,0,0,'+17.169',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(698,1,4,24,7,'10',10,'13','1:32.700',0,0,0,0,'+38.149',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(699,1,4,19,2,'19',19,'14','1:31.405',0,0,0,0,'+39.864',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(700,1,4,14,3,'15',15,'15','1:32.192',3,0,0,0,'+40.081',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(701,1,4,15,8,'11',11,'16','1:31.741',3,0,0,0,'+41.441',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(702,1,4,16,8,'14',14,'17','1:31.519',3,0,0,0,'+42.195',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(703,1,4,22,10,'18',18,'18','1:31.358',9,0,0,0,'+46.461',1,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(704,1,4,30,1,'5',5,'19','1:29.558',9,0,0,0,'+1:25.206',2,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(705,1,4,23,7,'13',13,'20','1:31.030',9,0,0,0,'+1Runde',2,'2023-06-03 18:53:34','2023-06-03 18:53:34',NULL),(706,1,5,13,3,'3',3,'1','1:32.490',3,0,0,0,'40:59.655',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(707,1,5,33,7,'1',1,'2','1:32.189',0,0,0,0,'+5.501',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(708,1,5,26,5,'7',7,'3','1:32.413',0,0,0,0,'+18.394',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(709,1,5,20,2,'5',5,'4','1:32.758',0,0,0,0,'+21.309',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(710,1,5,32,6,'9',9,'5','1:32.671',0,0,0,0,'+22.096',2,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(711,1,5,27,4,'10',10,'6','1:32.758',3,0,0,0,'+22.873',2,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(712,1,5,28,4,'8',8,'7','1:32.132',0,0,0,0,'+22.952',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(713,1,5,14,3,'2',2,'8','1:32.235',3,0,0,0,'+25.743',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(714,1,5,18,9,'17',17,'9','1:33.253',0,0,0,0,'+32.761',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(715,1,5,25,5,'6',6,'10','1:32.705',0,0,0,0,'+35.587',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(716,1,5,15,8,'14',14,'11','1:34.086',0,0,0,0,'+47.445',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(717,1,5,30,1,'12',12,'12','1:31.433',0,0,0,0,'+53.119',2,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(718,1,5,24,7,'13',13,'13','1:33.403',0,0,0,0,'+1:00.360',2,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(719,1,5,31,6,'16',16,'14','1:32.675',6,0,0,0,'+1:07.270',3,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(720,1,5,36,10,'15',15,'15','1:37.410',1,0,0,0,'+1Runde',1,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(721,1,5,16,8,'11',11,'16','1:36.405',0,0,1,0,'DNF',2,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(722,1,5,29,1,'4',4,'17','1:34.073',0,0,1,0,'DNF',0,'2023-06-03 19:00:32','2023-06-03 19:00:32',NULL),(723,1,6,30,1,'11',11,'1','1:23.660',3,0,0,0,'45:16.396',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(724,1,6,26,5,'4',4,'2','1:23.661',0,0,0,0,'+0.886',4,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(725,1,6,21,10,'10',10,'3','1:22.686',0,0,0,0,'+0.945',1,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(726,1,6,33,10,'1',1,'4','1:22.857',0,0,0,0,'+1.050',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(727,1,6,25,5,'5',5,'5','1:22.724',3,0,0,0,'+1.373',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(728,1,6,24,7,'20',20,'6','1:23.710',0,0,0,0,'+1.580',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(729,1,6,32,6,'8',8,'7','1:22.941',5,0,0,0,'+7.732',1,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(730,1,6,15,8,'18',18,'8','1:24.295',0,0,0,0,'+8.067',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(731,1,6,37,9,'15',15,'9','1:24.283',0,0,0,0,'+10.408',1,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(732,1,6,19,2,'13',13,'10','1:23.724',5,0,0,0,'+16.329',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(733,1,6,28,4,'3',3,'11','1:23.396',3,0,0,0,'+16.881',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(734,1,6,13,3,'2',2,'12','1:23.208',0,0,0,0,'+18.186',5,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(735,1,6,36,4,'19',19,'13','1:24.125',0,0,0,0,'+36.585',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(736,1,6,14,3,'9',9,'14','1:23.209',0,0,0,0,'+50.620',2,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(737,1,6,16,8,'17',17,'15','1:24.001',3,0,0,0,'+55.740',3,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(738,1,6,20,2,'6',6,'16','1:23.627',0,0,1,0,'DNF',1,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(739,1,6,29,1,'12',12,'17','1:24.172',0,0,1,0,'DNF',1,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(740,1,6,31,6,'7',7,'18','1:23.985',0,0,1,0,'DNF',0,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(741,1,6,18,9,'16',16,'19','1:48.517',0,0,1,0,'DNF',0,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(742,1,6,23,7,'14',14,'20','null',0,0,1,0,'DNF',0,'2023-06-03 21:11:34','2023-06-03 21:11:34',NULL),(743,1,7,33,9,'1',1,'1','1:22.160',0,0,0,0,'46:18.681',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(744,1,7,25,5,'3',3,'2','1:22.749',0,0,0,0,'+3.200',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(745,1,7,13,3,'2',2,'3','1:22.684',0,0,0,0,'+6.819',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(746,1,7,31,6,'9',9,'4','1:22.654',0,0,0,0,'+7.719',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(747,1,7,20,2,'5',5,'5','1:22.625',5,0,0,0,'+7.810',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(748,1,7,22,10,'8',8,'6','1:22.494',0,0,0,0,'+10.899',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(749,1,7,28,4,'7',7,'7','1:22.511',0,0,0,0,'+13.536',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(750,1,7,32,6,'14',14,'8','1:22.580',6,0,0,0,'+15.231',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(751,1,7,29,1,'13',13,'9','1:23.223',3,0,0,0,'+15.349',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(752,1,7,27,4,'20',20,'10','1:21.800',3,0,0,0,'+15.408',3,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(753,1,7,15,8,'17',17,'11','1:21.789',0,0,0,0,'+15.582',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(754,1,7,18,9,'6',6,'12','1:22.700',3,0,0,0,'+15.982',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(755,1,7,21,10,'11',11,'13','1:22.448',3,0,0,0,'+17.238',3,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(756,1,7,30,1,'10',10,'14','1:22.928',0,0,0,0,'+46.178',2,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(757,1,7,38,2,'18',18,'15','1:23.341',0,0,0,0,'+50.184',4,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(758,1,7,16,8,'16',16,'16','1:23.956',3,0,0,0,'+50.877',3,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(759,1,7,26,5,'12',12,'17','1:22.442',0,0,1,0,'DNF',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(760,1,7,14,3,'4',4,'18','1:22.365',3,0,1,0,'DNF',0,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(761,1,7,24,7,'15',15,'19','1:23.857',0,0,1,0,'DNF',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(762,1,7,23,7,'19',19,'20','1:28.538',0,0,1,0,'DNF',1,'2023-06-03 21:21:29','2023-06-03 21:21:29',NULL),(763,1,8,25,5,'5',5,'1','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(764,1,8,33,10,'2',2,'2','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(765,1,8,14,3,'7',7,'3','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(766,1,8,29,1,'4',4,'4','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(767,1,8,26,5,'9',9,'5','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(768,1,8,30,1,'8',8,'6','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(769,1,8,13,3,'15',15,'7','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(770,1,8,27,4,'16',16,'8','null',0,0,0,0,'null',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(771,1,8,28,4,'18',18,'9','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(772,1,8,24,7,'17',17,'10','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(773,1,8,32,6,'19',19,'11','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(774,1,8,36,9,'12',12,'12','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(775,1,8,23,7,'11',11,'13','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(776,1,8,15,8,'1',1,'14','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(777,1,8,19,2,'3',3,'15','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(778,1,8,16,8,'13',13,'16','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(779,1,8,31,6,'6',6,'17','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(780,1,8,18,9,'14',14,'18','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(781,1,8,20,2,'10',10,'19','null',0,0,1,0,'DNF',0,'2023-06-03 21:40:22','2023-06-03 21:40:22',NULL),(782,1,9,39,9,'1',1,'1','1:19.825',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(783,1,9,33,7,'2',2,'2','1:19.275',9,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(784,1,9,19,2,'10',10,'3','1:19.718',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(785,1,9,25,5,'6',6,'4','1:20.184',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(786,1,9,31,6,'7',7,'5','1:20.100',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(787,1,9,30,1,'9',9,'6','1:20.417',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(788,1,9,13,3,'5',5,'7','1:19.375',6,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(789,1,9,22,10,'13',13,'8','1:20.422',5,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(790,1,9,32,6,'8',8,'9','1:20.222',9,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(791,1,9,14,3,'4',4,'10','1:19.852',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(792,1,9,18,9,'14',14,'11','1:20.665',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(793,1,9,40,1,'3',3,'12','1:19.653',3,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(794,1,9,26,5,'11',11,'13','1:19.657',3,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(795,1,9,36,2,'17',17,'14','1:21.544',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(796,1,9,15,8,'15',15,'15','null',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(797,1,9,16,8,'12',12,'16','null',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(798,1,9,24,7,'16',16,'17','null',0,0,0,0,'null',0,'2023-06-03 21:50:52','2023-06-03 21:50:52',NULL),(799,1,10,14,3,'8',8,'1','1:27.494',0,0,0,0,'46:42.141',1,'2023-06-03 22:06:25','2023-06-03 22:06:25',NULL),(800,1,10,13,3,'3',3,'2','1:27.642',0,0,0,0,'+0.411',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(801,1,10,33,7,'2',2,'3','1:27.345',3,0,0,0,'+2.411',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(802,1,10,25,5,'5',5,'4','1:27.064',0,0,0,0,'+9.295',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(803,1,10,30,1,'11',11,'5','1:28.662',0,0,0,0,'+12.573',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(804,1,10,20,2,'10',10,'6','1:28.593',0,0,0,0,'+13.931',3,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(805,1,10,28,4,'4',4,'7','1:26.984',0,0,0,0,'+14.530',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(806,1,10,32,6,'7',7,'8','1:26.675',0,0,0,0,'+14.848',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(807,1,10,26,5,'14',14,'9','1:28.058',0,0,0,0,'+22.554',2,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(808,1,10,27,4,'13',13,'10','1:26.910',0,0,0,0,'+24.177',2,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(809,1,10,29,1,'16',16,'11','1:27.321',0,0,0,0,'+24.695',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(810,1,10,31,6,'15',15,'12','1:27.497',0,0,0,0,'+27.052',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(811,1,10,19,2,'9',9,'13','1:26.569',0,0,0,0,'+30.052',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(812,1,10,15,8,'17',17,'14','1:28.180',0,0,0,0,'+37.165',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(813,1,10,18,9,'19',19,'15','1:26.341',0,0,0,0,'+37.617',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(814,1,10,40,7,'1',1,'16','1:27.955',0,0,1,0,'DNF',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(815,1,10,41,9,'20',20,'17','1:32.263',0,0,1,0,'DNF',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(816,1,10,22,10,'6',6,'18','1:27.928',0,0,1,0,'DNF',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(817,1,10,39,10,'12',12,'19','1:27.347',0,0,1,0,'DNF',1,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(818,1,10,16,8,'18',18,'20','1:43.722',0,0,1,0,'DNF',0,'2023-06-03 22:06:26','2023-06-03 22:06:26',NULL),(819,1,11,33,7,'5',5,'1','1:19.445',3,0,0,0,'52:10.505',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(820,1,11,21,10,'8',8,'2','1:19.112',3,0,0,0,'+5.010',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(821,1,11,29,1,'1',1,'3','1:19.987',0,0,0,0,'+5.510',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(822,1,11,26,5,'9',9,'4','1:19.203',3,0,0,0,'+9.742',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(823,1,11,27,4,'6',6,'5','1:20.200',0,0,0,0,'+12.540',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(824,1,11,22,10,'11',11,'6','1:20.580',0,0,0,0,'+17.731',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(825,1,11,30,1,'7',7,'7','1:20.135',6,0,0,0,'+19.115',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(826,1,11,18,9,'13',13,'8','1:20.105',3,0,0,0,'+21.634',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(827,1,11,41,2,'14',14,'9','1:19.880',8,0,0,0,'+22.583',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(828,1,11,32,6,'10',10,'10','1:19.605',6,0,0,0,'+24.986',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(829,1,11,31,6,'12',12,'11','1:20.267',5,0,0,0,'+33.042',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(830,1,11,16,8,'15',15,'12','1:19.167',17,0,0,0,'+39.807',2,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(831,1,11,17,9,'20',20,'13','1:20.563',3,0,0,0,'+41.403',3,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(832,1,11,28,4,'17',17,'14','1:20.058',3,0,0,0,'+41.924',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(833,1,11,15,8,'16',16,'15','1:20.870',6,0,0,0,'+45.737',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(834,1,11,24,7,'18',18,'16','1:23.642',1,0,0,0,'+1Runde',1,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(835,1,11,42,5,'2',2,'17','1:20.809',0,0,1,0,'DNF',0,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(836,1,11,13,3,'4',4,'18','1:21.096',0,0,1,0,'DNF',0,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(837,1,11,14,3,'3',3,'19','1:20.671',0,0,1,0,'DNF',0,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(838,1,11,36,2,'19',19,'20','null',0,0,1,0,'DNF',0,'2023-06-03 22:18:15','2023-06-03 22:18:15',NULL),(839,1,12,14,3,'2',2,'1','1:32.139',0,0,0,0,'45:13.422',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(840,1,12,13,3,'1',1,'2','1:30.955',0,0,0,0,'+7.446',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(841,1,12,25,5,'5',5,'3','1:31.487',0,0,0,0,'+8.553',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(842,1,12,27,4,'3',3,'4','1:30.093',5,0,0,0,'+20.000',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(843,1,12,21,10,'6',6,'5','1:31.677',0,0,0,0,'+34.031',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(844,1,12,18,9,'14',14,'6','1:31.502',0,0,0,0,'+35.586',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(845,1,12,31,6,'13',13,'7','1:32.276',0,0,0,0,'+40.596',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(846,1,12,41,2,'4',4,'8','1:32.636',0,0,0,0,'+46.389',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(847,1,12,32,6,'15',15,'9','1:30.138',0,0,0,0,'+49.020',2,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(848,1,12,17,9,'16',16,'10','1:30.834',3,0,0,0,'+50.020',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(849,1,12,36,10,'18',18,'11','1:32.527',0,0,0,0,'+1:03.690',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(850,1,12,30,1,'9',9,'12','1:31.974',3,0,0,0,'+1:04.690',2,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(851,1,12,19,2,'7',7,'13','1:31.075',5,0,0,0,'+1:06.690',3,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(852,1,12,26,5,'10',10,'14','1:31.554',0,0,0,0,'+1:22.628',2,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(853,1,12,16,8,'12',12,'15','1:32.258',0,0,0,0,'+1Runde',2,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(854,1,12,15,8,'8',8,'16','1:32.646',0,0,0,0,'+1Runde',2,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(855,1,12,24,7,'17',17,'17','1:36.473',0,0,0,0,'+1Runde',1,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(856,1,12,29,1,'11',11,'18','1:32.002',0,0,0,0,'+1Runde',4,'2023-06-03 22:25:26','2023-06-03 22:25:26',NULL),(857,1,13,14,3,'3',3,'1','1:46.347',0,0,0,0,'45:19.833',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(858,1,13,40,1,'2',2,'2','1:46.961',3,0,0,0,'+2.592',1,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(859,1,13,33,7,'1',1,'3','1:45.711',3,0,0,0,'+5.836',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(860,1,13,27,4,'11',11,'4','1:47.448',0,0,0,0,'+6.046',1,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(861,1,13,29,1,'13',13,'5','1:48.061',0,0,0,0,'+10.271',1,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(862,1,13,28,4,'12',12,'6','1:48.290',0,0,0,0,'+11.858',1,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(863,1,13,26,5,'7',7,'7','1:47.921',0,0,0,0,'+12.275',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(864,1,13,13,3,'6',6,'8','1:48.015',0,0,0,0,'+14.013',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(865,1,13,31,6,'9',9,'9','1:48.405',3,0,0,0,'+14.112',1,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(866,1,13,25,5,'4',4,'10','1:48.347',0,0,0,0,'+19.997',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(867,1,13,18,9,'17',17,'11','1:48.763',6,0,0,0,'+20.528',2,'2023-06-03 22:34:16','2023-06-03 22:34:16',NULL),(868,1,13,32,6,'5',5,'12','1:47.628',8,0,0,0,'+20.615',2,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(869,1,13,16,8,'20',20,'13','1:49.107',0,0,0,0,'+21.198',2,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(870,1,13,34,2,'16',16,'14','1:49.143',3,0,0,0,'+24.929',3,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(871,1,13,22,10,'15',15,'15','1:48.133',10,0,0,0,'+25.767',3,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(872,1,13,15,8,'14',14,'16','1:48.624',3,0,0,0,'+26.328',1,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(873,1,13,24,7,'19',19,'17','1:56.203',1,0,0,0,'+1Runde',1,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(874,1,13,21,10,'10',10,'18','1:55.847',2,0,0,0,'+2Runden',2,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(875,1,13,17,9,'8',8,'19','1:47.468',0,0,1,0,'DNF',1,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(876,1,13,36,2,'18',18,'20','null',0,0,1,0,'DNF',0,'2023-06-03 22:34:17','2023-06-03 22:34:17',NULL),(877,1,14,14,3,'1',1,'1','1:14.138',0,0,0,0,'48:36.863',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(878,1,14,13,3,'6',6,'2','1:14.008',0,0,0,0,'+1.601',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(879,1,14,29,1,'3',3,'3','1:14.194',0,0,0,0,'+3.720',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(880,1,14,25,5,'2',2,'4','1:14.099',0,0,0,0,'+4.484',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(881,1,14,30,1,'7',7,'5','1:14.052',0,0,0,0,'+5.631',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(882,1,14,26,5,'4',4,'6','1:14.245',0,0,0,0,'+6.082',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(883,1,14,32,6,'18',18,'7','1:14.222',0,0,0,0,'+6.330',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(884,1,14,28,4,'8',8,'8','1:14.463',0,0,0,0,'+11.353',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(885,1,14,27,4,'10',10,'9','1:13.844',0,0,0,0,'+20.314',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(886,1,14,37,10,'14',14,'10','1:14.593',0,0,0,0,'+22.255',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(887,1,14,18,9,'16',16,'11','1:15.037',0,0,0,0,'+31.938',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(888,1,14,17,9,'13',13,'12','1:13.792',0,0,0,0,'+32.848',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(889,1,14,31,6,'11',11,'13','1:14.375',0,0,0,0,'+33.556',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(890,1,14,42,2,'20',20,'14','1:13.182',0,0,0,0,'+39.803',4,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(891,1,14,33,7,'5',5,'15','1:13.086',0,0,0,0,'+43.646',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(892,1,14,36,7,'17',17,'16','1:14.389',0,0,0,0,'+45.560',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(893,1,14,15,8,'15',15,'17','1:14.218',0,0,0,0,'+48.573',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(894,1,14,16,8,'12',12,'18','1:13.986',0,0,0,0,'+1:04.392',3,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(895,1,14,19,2,'9',9,'19','1:13.563',0,0,1,0,'DNF',2,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(896,1,14,43,10,'19',19,'20','1:39.070',0,0,1,0,'DNF',1,'2023-06-03 22:42:06','2023-06-03 22:42:06',NULL),(897,1,15,27,4,'4',4,'1','1:07.510',3,0,0,0,'41:30.323',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(898,1,15,14,3,'2',2,'2','1:07.986',0,0,0,0,'+1.242',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(899,1,15,29,1,'5',5,'3','1:07.823',0,0,0,0,'+10.275',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(900,1,15,13,3,'1',1,'4','1:07.869',0,0,0,0,'+11.285',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(901,1,15,30,1,'3',3,'5','1:07.833',0,0,0,0,'+15.778',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(902,1,15,18,9,'9',9,'6','1:08.406',0,0,0,0,'+24.117',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(903,1,15,26,5,'10',10,'7','﻿1:07.473',3,0,0,0,'+31.532',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(904,1,15,28,4,'11',11,'8','1:07.863',9,0,0,0,'+33.599',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(905,1,15,16,8,'16',16,'9','1:07.780',3,0,0,0,'+34.938',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(906,1,15,19,2,'14',14,'10','1:07.674',3,0,0,0,'+35,406',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(907,1,15,22,10,'7',7,'11','1:07.934',3,0,0,0,'+36.128',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(908,1,15,25,5,'6',6,'12','1:07:416',6,0,0,0,'+43.070',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(909,1,15,31,6,'15',15,'13','1:08.320',6,0,0,0,'+48.168',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(910,1,15,37,7,'20',20,'14','1:08.112',0,0,0,0,'+1:11.807',4,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(911,1,15,20,2,'8',8,'15','1:07.196',0,0,0,0,'+1Runde',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(912,1,15,15,8,'18',18,'16','1:06.805',0,0,0,0,'+1Runde',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(913,1,15,34,6,'17',17,'17','1:07.035',0,0,0,0,'+1Runde',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(914,1,15,21,10,'12',12,'18','1:08.314',0,0,1,0,'DNF',3,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(915,1,15,36,7,'19',19,'19','1:09.490',0,0,1,0,'DNF',2,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(916,1,15,17,9,'13',13,'20','null',0,0,1,0,'DNF',1,'2023-06-03 22:57:52','2023-06-03 22:57:52',NULL),(917,1,16,27,4,'1',1,'1','1:14.374',3,0,0,0,'50:59.363',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(918,1,16,42,5,'3',3,'2','1:14.387',3,0,0,0,'+3.412',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(919,1,16,25,5,'7',7,'3','1:14.065',0,0,0,0,'+7.621',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(920,1,16,28,4,'5',5,'4','1:14.418',0,0,0,0,'+13.707',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(921,1,16,14,3,'8',8,'5','1:15.048',0,0,0,0,'+32.322',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(922,1,16,17,9,'9',9,'6','1:14.757',0,0,0,0,'+32.718',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(923,1,16,13,3,'12',12,'7','1:14.828',3,0,0,0,'+36.291',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(924,1,16,33,7,'6',6,'8','1:13.602',6,0,0,0,'+1:03.592',2,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(925,1,16,40,7,'2',2,'9','1:12.303',3,0,0,0,'+1:05.835',3,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(926,1,16,31,6,'10',10,'10','1:15.878',0,0,0,0,'+1:13.938',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(927,1,16,29,1,'4',4,'11','1:13.526',1,0,0,0,'+1Runde',3,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(928,1,16,20,2,'11',11,'12','1:14.213',3,0,0,0,'+1Runde',3,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(929,1,16,18,9,'18',18,'13','1:15.943',3,0,0,0,'+1Runde',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(930,1,16,30,1,'14',14,'14','1:14.906',0,0,0,0,'+2Runden',2,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(931,1,16,21,10,'20',20,'15','1:19.322',2,0,0,0,'+2Runden',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(932,1,16,38,2,'13',13,'16','1:19.885',3,0,0,0,'+3Runden',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(933,1,16,15,8,'19',19,'17','1:17.630',3,0,0,0,'+3Runden',1,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(934,1,16,22,10,'16',16,'18','1:16.114',3,0,1,0,'DNF',3,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(935,1,16,16,8,'17',17,'19','1:16.791',0,0,1,0,'DNF',2,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL),(936,1,16,34,6,'15',15,'20','1:25.033',0,0,1,0,'DNF',0,'2023-06-03 23:13:49','2023-06-03 23:13:49',NULL);
/*!40000 ALTER TABLE `race_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `races`
--

DROP TABLE IF EXISTS `races`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `races` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `track_id` int(10) unsigned NOT NULL,
  `calender_pos` int(10) unsigned NOT NULL,
  `planned_at` datetime DEFAULT NULL,
  `raced_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `season_id_idx` (`season_id`),
  KEY `track_id_idx` (`track_id`),
  KEY `leagueId_idx` (`league_id`),
  CONSTRAINT `leagueId` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `seasonId` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `trackId` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `races`
--

LOCK TABLES `races` WRITE;
/*!40000 ALTER TABLE `races` DISABLE KEYS */;
INSERT INTO `races` VALUES (1,1,1,24,1,NULL,NULL,'2023-06-02 00:06:39','2023-06-02 00:06:39',NULL),(2,1,1,17,2,NULL,NULL,'2023-06-02 00:07:32','2023-06-02 00:07:32',NULL),(3,1,1,9,3,NULL,NULL,'2023-06-02 00:07:51','2023-06-02 00:07:51',NULL),(4,1,1,10,4,NULL,NULL,'2023-06-02 00:08:00','2023-06-02 00:08:00',NULL),(5,1,1,2,5,NULL,NULL,'2023-06-02 00:08:06','2023-06-02 00:08:06',NULL),(6,1,1,16,6,NULL,NULL,'2023-06-02 00:08:13','2023-06-02 00:08:13',NULL),(7,1,1,3,7,NULL,NULL,'2023-06-02 00:08:20','2023-06-02 00:08:20',NULL),(8,1,1,8,8,NULL,NULL,'2023-06-02 00:08:28','2023-06-02 00:08:28',NULL),(9,1,1,4,9,NULL,NULL,'2023-06-02 00:08:34','2023-06-02 00:08:34',NULL),(10,1,1,21,10,NULL,NULL,'2023-06-02 00:08:40','2023-06-02 00:08:40',NULL),(11,1,1,20,11,NULL,NULL,'2023-06-02 00:09:02','2023-06-02 00:09:02',NULL),(12,1,1,5,12,NULL,NULL,'2023-06-02 00:09:13','2023-06-02 00:09:13',NULL),(13,1,1,14,13,NULL,NULL,'2023-06-02 00:09:22','2023-06-02 00:09:22',NULL),(14,1,1,15,14,NULL,NULL,'2023-06-02 00:09:37','2023-06-02 00:09:37',NULL),(15,1,1,11,15,NULL,NULL,'2023-06-02 00:09:44','2023-06-02 00:09:44',NULL),(16,1,1,7,16,NULL,NULL,'2023-06-02 00:09:54','2023-06-02 00:09:54',NULL);
/*!40000 ALTER TABLE `races` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seasons`
--

DROP TABLE IF EXISTS `seasons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `competition_id` int(11) unsigned NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `planned_races` int(2) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `season_competition_idx` (`competition_id`),
  KEY `seasons_league_idx` (`league_id`),
  CONSTRAINT `season_competition` FOREIGN KEY (`competition_id`) REFERENCES `competitions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `season_league` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seasons`
--

LOCK TABLES `seasons` WRITE;
/*!40000 ALTER TABLE `seasons` DISABLE KEYS */;
INSERT INTO `seasons` VALUES (1,1,1,'Season 1',16,NULL,NULL,'2023-03-03 15:18:29','2023-03-03 15:18:29',NULL),(2,1,2,'Season 2',12,NULL,NULL,'2023-06-01 15:18:29','2023-06-01 15:18:29',NULL),(3,1,3,'Season 2',12,NULL,NULL,'2023-06-01 15:18:29','2023-06-01 15:18:29',NULL);
/*!40000 ALTER TABLE `seasons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teams` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `league_id` int(10) unsigned NOT NULL,
  `season_id` int(10) unsigned NOT NULL,
  `constructor_id` int(10) unsigned NOT NULL,
  `driver_id` int(10) unsigned NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `driverTeams_season_idx` (`season_id`),
  KEY `driverTeams_team_idx` (`constructor_id`),
  KEY `driverTeams_drivers_idx` (`driver_id`),
  KEY `driverTeams_leagueId_idx` (`league_id`),
  CONSTRAINT `driverTeams_drivers` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `driverTeams_leagueId` FOREIGN KEY (`league_id`) REFERENCES `leagues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `driverTeams_season` FOREIGN KEY (`season_id`) REFERENCES `seasons` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `driverTeams_teamData` FOREIGN KEY (`constructor_id`) REFERENCES `constructors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (11,1,1,3,13,'2023-03-03 22:52:15','2023-03-03 22:52:15',NULL),(12,1,1,3,14,'2023-03-03 22:52:31','2023-03-03 22:52:31',NULL),(14,1,1,8,15,'2023-03-03 23:04:54','2023-03-03 23:04:54',NULL),(15,1,1,8,16,'2023-03-03 23:04:59','2023-03-03 23:04:59',NULL),(16,1,1,9,17,'2023-03-03 23:05:11','2023-03-03 23:05:11',NULL),(17,1,1,9,18,'2023-03-03 23:05:14','2023-03-03 23:05:14',NULL),(18,1,1,2,19,'2023-03-03 23:05:51','2023-03-03 23:05:51',NULL),(19,1,1,2,20,'2023-03-03 23:05:54','2023-03-03 23:05:54',NULL),(20,1,1,10,21,'2023-03-03 23:06:03','2023-03-03 23:06:03',NULL),(21,1,1,10,22,'2023-03-03 23:06:06','2023-03-03 23:06:06',NULL),(22,1,1,7,23,'2023-03-03 23:06:20','2023-03-03 23:06:20',NULL),(23,1,1,7,24,'2023-03-03 23:06:27','2023-03-03 23:06:27',NULL),(24,1,1,5,25,'2023-03-03 23:06:40','2023-03-03 23:06:40',NULL),(25,1,1,5,26,'2023-03-03 23:06:43','2023-03-03 23:06:43',NULL),(26,1,1,4,27,'2023-03-03 23:06:48','2023-03-03 23:06:48',NULL),(27,1,1,4,28,'2023-03-03 23:06:49','2023-03-03 23:06:49',NULL),(28,1,1,1,29,'2023-03-03 23:06:55','2023-03-03 23:06:55',NULL),(29,1,1,1,30,'2023-03-03 23:06:58','2023-03-03 23:06:58',NULL),(30,1,1,6,31,'2023-03-03 23:07:07','2023-03-03 23:07:07',NULL),(31,1,1,6,32,'2023-03-03 23:07:08','2023-03-03 23:07:08',NULL);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tracks`
--

DROP TABLE IF EXISTS `tracks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tracks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tracks`
--

LOCK TABLES `tracks` WRITE;
/*!40000 ALTER TABLE `tracks` DISABLE KEYS */;
INSERT INTO `tracks` VALUES (1,NULL,NULL,'Bahrain',NULL,NULL,NULL),(2,NULL,NULL,'Saudi Arabien',NULL,NULL,NULL),(3,NULL,NULL,'Australien',NULL,NULL,NULL),(4,NULL,'Imola','Italiien',NULL,NULL,NULL),(5,NULL,'Miami','USA',NULL,NULL,NULL),(6,NULL,NULL,'Spanien',NULL,NULL,NULL),(7,NULL,NULL,'Monaco',NULL,NULL,NULL),(8,NULL,NULL,'Aserbaidschan',NULL,NULL,NULL),(9,NULL,NULL,'Kanada',NULL,NULL,NULL),(10,NULL,NULL,'Großbritanien',NULL,NULL,NULL),(11,NULL,NULL,'Österreich',NULL,NULL,NULL),(12,NULL,NULL,'Frankreich',NULL,NULL,NULL),(13,NULL,NULL,'Ungarn',NULL,NULL,NULL),(14,NULL,NULL,'Belgien',NULL,NULL,NULL),(15,NULL,NULL,'Niederlande',NULL,NULL,NULL),(16,NULL,'Monza','Italien',NULL,NULL,NULL),(17,NULL,NULL,'Singapur',NULL,NULL,NULL),(18,NULL,NULL,'Japan',NULL,NULL,NULL),(19,NULL,'Austin','USA',NULL,NULL,NULL),(20,NULL,NULL,'Mexico',NULL,NULL,NULL),(21,NULL,NULL,'Abu Dhabi',NULL,NULL,NULL),(22,NULL,NULL,'China',NULL,NULL,NULL),(23,NULL,NULL,'Portugal',NULL,NULL,NULL),(24,NULL,'Sao Paulo','Brasilien',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tracks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-04  1:15:11
