CREATE DATABASE  IF NOT EXISTS `KFBCL` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `KFBCL`;
-- MySQL dump 10.13  Distrib 8.0.45, for Linux (x86_64)
--
-- Host: localhost    Database: KFBCL
-- ------------------------------------------------------
-- Server version	8.0.45-0ubuntu0.24.04.1

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
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `appointments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `appointment_date` datetime NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priority` enum('High','Normal','Low','Critical') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Normal',
  `status` enum('Pending','Confirmed','Cancelled','Completed','Rescheduled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appointments_appointment_id_unique` (`appointment_id`),
  KEY `appointments_appointment_date_index` (`appointment_date`),
  KEY `appointments_status_index` (`status`),
  KEY `appointments_priority_index` (`priority`),
  KEY `appointments_created_by_index` (`created_by`),
  CONSTRAINT `appointments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (2,'APT-2026-102','Jane','Doe','janedoe@mail.com','+254785002002','Document Review','2026-02-14 15:30:00','THIWASCO','High','Confirmed',11,'2026-01-27 08:47:50','2026-02-14 09:17:04'),(10,'APT-2026-109','Tester','One','testerone@mail.com','+254785001001','Document Review','2026-01-30 14:00:00','BAT','Normal','Confirmed',11,'2026-01-31 05:07:35','2026-01-31 05:07:53');
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_bonus_types`
--

DROP TABLE IF EXISTS `member_bonus_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_bonus_types` (
  `bonusId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `bonus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `calculation_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `author` bigint unsigned NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`bonusId`),
  UNIQUE KEY `unique_bonus_name` (`bonus_name`),
  KEY `member_bonus_types_author_foreign` (`author`),
  CONSTRAINT `member_bonus_types_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_bonus_types`
--

LOCK TABLES `member_bonus_types` WRITE;
/*!40000 ALTER TABLE `member_bonus_types` DISABLE KEYS */;
INSERT INTO `member_bonus_types` VALUES (1001,'Performance','percentage','percentage',7.80,11,'2026-02-10 08:53:37','2026-02-13 12:41:09','Active');
/*!40000 ALTER TABLE `member_bonus_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_bonuses`
--

DROP TABLE IF EXISTS `member_bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_bonuses` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionBonus` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Approved','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_bonuses_memberid_foreign` (`memberId`),
  KEY `member_bonuses_transactionbonus_foreign` (`transactionBonus`),
  KEY `member_bonuses_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_bonuses_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_bonuses_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`),
  CONSTRAINT `member_bonuses_transactionbonus_foreign` FOREIGN KEY (`transactionBonus`) REFERENCES `member_bonus_types` (`bonusId`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_bonuses`
--

LOCK TABLES `member_bonuses` WRITE;
/*!40000 ALTER TABLE `member_bonuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_contributions`
--

DROP TABLE IF EXISTS `member_contributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_contributions` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Confirmed','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionType` enum('Paid-In','Paid-Out') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_contributions_memberid_foreign` (`memberId`),
  KEY `member_contributions_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_contributions_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_contributions_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_contributions`
--

LOCK TABLES `member_contributions` WRITE;
/*!40000 ALTER TABLE `member_contributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_contributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_fine_types`
--

DROP TABLE IF EXISTS `member_fine_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_fine_types` (
  `fineId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `fine_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `is_percentage` tinyint(1) NOT NULL DEFAULT '0',
  `author` bigint unsigned NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`fineId`),
  UNIQUE KEY `unique_fine_name` (`fine_name`),
  KEY `member_fine_types_author_foreign` (`author`),
  CONSTRAINT `member_fine_types_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1002 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_fine_types`
--

LOCK TABLES `member_fine_types` WRITE;
/*!40000 ALTER TABLE `member_fine_types` DISABLE KEYS */;
INSERT INTO `member_fine_types` VALUES (1001,'Indiscipline','Things here, one two something, comments anything',9.50,1,11,'2026-02-10 08:54:14','2026-02-13 12:52:38','Active');
/*!40000 ALTER TABLE `member_fine_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_fines`
--

DROP TABLE IF EXISTS `member_fines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_fines` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionFine` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Approved','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_fines_memberid_foreign` (`memberId`),
  KEY `member_fines_transactionfine_foreign` (`transactionFine`),
  KEY `member_fines_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_fines_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_fines_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`),
  CONSTRAINT `member_fines_transactionfine_foreign` FOREIGN KEY (`transactionFine`) REFERENCES `member_fine_types` (`fineId`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_fines`
--

LOCK TABLES `member_fines` WRITE;
/*!40000 ALTER TABLE `member_fines` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_fines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_identifications`
--

DROP TABLE IF EXISTS `member_identifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_identifications` (
  `identification_code` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member_id` bigint unsigned NOT NULL,
  `national_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driving_license_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ntsa_compliance` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `national_id_front_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id_back_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author` bigint unsigned NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identification_code`),
  UNIQUE KEY `member_identifications_member_id_unique` (`member_id`),
  UNIQUE KEY `member_identifications_national_id_unique` (`national_id`),
  UNIQUE KEY `member_identifications_driver_license_unique` (`driver_license`),
  KEY `member_identifications_author_foreign` (`author`),
  CONSTRAINT `member_identifications_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `member_identifications_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`memberId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_identifications`
--

LOCK TABLES `member_identifications` WRITE;
/*!40000 ALTER TABLE `member_identifications` DISABLE KEYS */;
INSERT INTO `member_identifications` VALUES (1,101,'10223302','AD145236DL','Category A','Approved','database/etc/configs/dumps/raw/101/front.png','database/etc/configs/dumps/raw/101/back.png',11,'Approved','2026-02-11 05:41:11','2026-02-14 04:45:59'),(2,102,'123456790','Awert34467','Category A','Pending','database/etc/configs/dumps/raw/102/front.png','database/etc/configs/dumps/raw/102/back.png',11,'Pending','2026-02-14 09:22:42','2026-02-14 09:22:42');
/*!40000 ALTER TABLE `member_identifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_kin`
--

DROP TABLE IF EXISTS `member_kin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_kin` (
  `kin_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member` bigint unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Pending',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`kin_id`),
  KEY `member_kin_member_foreign` (`member`),
  CONSTRAINT `member_kin_member_foreign` FOREIGN KEY (`member`) REFERENCES `members` (`memberId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_kin`
--

LOCK TABLES `member_kin` WRITE;
/*!40000 ALTER TABLE `member_kin` DISABLE KEYS */;
INSERT INTO `member_kin` VALUES (101,101,'John','Doe','johndoe@gmail.com','254701002002','Cousin','Pending','2026-02-11 05:41:11','2026-02-14 05:46:06'),(102,102,'Jane','Doe','jane@mai.com','254719002003','Brother','Pending','2026-02-14 09:22:42','2026-02-14 09:22:42');
/*!40000 ALTER TABLE `member_kin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_loan_types`
--

DROP TABLE IF EXISTS `member_loan_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_loan_types` (
  `loanId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `loan_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_rate` decimal(10,2) NOT NULL,
  `max_amount` decimal(10,2) NOT NULL,
  `repayment_period_months` int NOT NULL,
  `author` bigint unsigned NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`loanId`),
  UNIQUE KEY `unique_loan_type_name` (`loan_type_name`),
  KEY `member_loan_types_author_foreign` (`author`),
  CONSTRAINT `member_loan_types_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1004 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_loan_types`
--

LOCK TABLES `member_loan_types` WRITE;
/*!40000 ALTER TABLE `member_loan_types` DISABLE KEYS */;
INSERT INTO `member_loan_types` VALUES (1002,'Emergency Loan',10.60,500000.00,60,11,'2026-02-13 06:52:25','2026-02-14 09:26:13','Active');
/*!40000 ALTER TABLE `member_loan_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_loans`
--

DROP TABLE IF EXISTS `member_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_loans` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionLoan` bigint unsigned NOT NULL,
  `transactionLoanAmount` decimal(15,2) NOT NULL,
  `transactionLoanPeriod` int NOT NULL,
  `transactionLoanStartDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionLoanRepaymentMode` int NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionLoanStatus` enum('Active','Stopped','Repaid','Defaulted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionStatus` enum('Approved','Under Review','Cancelled') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_loans_memberid_foreign` (`memberId`),
  KEY `member_loans_transactionloan_foreign` (`transactionLoan`),
  KEY `member_loans_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_loans_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_loans_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`),
  CONSTRAINT `member_loans_transactionloan_foreign` FOREIGN KEY (`transactionLoan`) REFERENCES `member_loan_types` (`loanId`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_loans`
--

LOCK TABLES `member_loans` WRITE;
/*!40000 ALTER TABLE `member_loans` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_loans_transactions`
--

DROP TABLE IF EXISTS `member_loans_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_loans_transactions` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionLoan` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Confirmed','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_loans_transactions_memberid_foreign` (`memberId`),
  KEY `member_loans_transactions_transactionloan_foreign` (`transactionLoan`),
  KEY `member_loans_transactions_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_loans_transactions_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_loans_transactions_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`),
  CONSTRAINT `member_loans_transactions_transactionloan_foreign` FOREIGN KEY (`transactionLoan`) REFERENCES `member_loans` (`transactionId`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_loans_transactions`
--

LOCK TABLES `member_loans_transactions` WRITE;
/*!40000 ALTER TABLE `member_loans_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_loans_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_reg_fees`
--

DROP TABLE IF EXISTS `member_reg_fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_reg_fees` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Confirmed','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_reg_fees_memberid_foreign` (`memberId`),
  KEY `member_reg_fees_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_reg_fees_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_reg_fees_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_reg_fees`
--

LOCK TABLES `member_reg_fees` WRITE;
/*!40000 ALTER TABLE `member_reg_fees` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_reg_fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_savings`
--

DROP TABLE IF EXISTS `member_savings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_savings` (
  `transactionId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `memberId` bigint unsigned NOT NULL,
  `transactionCode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAmount` decimal(10,2) NOT NULL,
  `transactionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `transactionMode` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionType` enum('Paid-In','Paid-Out') COLLATE utf8mb4_unicode_ci NOT NULL,
  `transactionAuthor` bigint unsigned NOT NULL,
  `transactionUpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transactionStatus` enum('Confirmed','Pending','Cancelled','Reversed') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`transactionId`),
  KEY `member_savings_memberid_foreign` (`memberId`),
  KEY `member_savings_transactionauthor_foreign` (`transactionAuthor`),
  CONSTRAINT `member_savings_memberid_foreign` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`),
  CONSTRAINT `member_savings_transactionauthor_foreign` FOREIGN KEY (`transactionAuthor`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=202601 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_savings`
--

LOCK TABLES `member_savings` WRITE;
/*!40000 ALTER TABLE `member_savings` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_savings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_transactions`
--

DROP TABLE IF EXISTS `member_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_transactions` (
  `transactionCode` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member` bigint unsigned NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_amount` decimal(15,2) NOT NULL,
  `transactionMethod` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` bigint unsigned NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`transactionCode`),
  KEY `member_transactions_member_foreign` (`member`),
  KEY `member_transactions_author_foreign` (`author`),
  CONSTRAINT `member_transactions_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`),
  CONSTRAINT `member_transactions_member_foreign` FOREIGN KEY (`member`) REFERENCES `members` (`memberId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_transactions`
--

LOCK TABLES `member_transactions` WRITE;
/*!40000 ALTER TABLE `member_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `memberId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `author` bigint unsigned NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `membership` enum('Member','Non-Member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non-Member',
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'Active',
  PRIMARY KEY (`memberId`),
  UNIQUE KEY `members_email_unique` (`email`),
  UNIQUE KEY `members_phone1_unique` (`phone1`),
  KEY `members_author_foreign` (`author`),
  CONSTRAINT `members_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (101,'Tim','Tom','timtim@mail.com','254785222333','254785210200','Male','1990-10-02',11,'2026-02-11 05:41:11','2026-02-14 09:48:31','Member','Active'),(102,'John','Doe','joe@mail.com','254709090100','254712000000','Male','1930-02-02',11,'2026-02-14 09:22:42','2026-02-14 09:22:42','Member','Active');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_vehicles`
--

DROP TABLE IF EXISTS `members_vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members_vehicles` (
  `vehicleId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `member` bigint unsigned NOT NULL,
  `plate_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yom` year DEFAULT NULL,
  `CC` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NTSA_compliant` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `insurance` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Third Party',
  PRIMARY KEY (`vehicleId`),
  UNIQUE KEY `members_vehicles_plate_number_unique` (`plate_number`),
  KEY `members_vehicles_member_foreign` (`member`),
  CONSTRAINT `members_vehicles_member_foreign` FOREIGN KEY (`member`) REFERENCES `members` (`memberId`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_vehicles`
--

LOCK TABLES `members_vehicles` WRITE;
/*!40000 ALTER TABLE `members_vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `members_vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_01_22_095750_create_users_table',2),(5,'2026_01_22_095802_create_users_logins_table',2),(6,'2026_01_27_114202_create_appointments_table',3),(7,'2026_01_29_070412_create_user_roles_table',4),(8,'2026_02_02_061017_create_members_table',5),(9,'2026_02_02_061018_create_member_kin_table',5),(10,'2026_02_02_061019_create_member_vehicles_table',5),(13,'2026_02_02_061020_create_stages_table',6),(14,'2026_02_03_111613_create_member_bonus_types_table',7),(15,'2026_02_03_111613_create_member_loan_types_table',7),(16,'2026_02_03_111614_create_member_fine_types_table',7),(17,'2026_02_03_111615_create_member_transactions_table',7),(18,'2026_02_05_175931_create_member_contributions_table',8),(19,'2026_02_05_175931_create_member_reg_fees_table',8),(20,'2026_02_05_175932_create_member_loans_table',8),(21,'2026_02_05_175932_create_member_savings_table',8),(22,'2026_02_05_175933_create_member_bonuses_table',8),(23,'2026_02_05_175933_create_member_loan_transactions_table',8),(24,'2026_02_05_175934_create_member_fines_table',8),(25,'2026_02_11_071618_create_member_identifications_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('kSTPcbKu994R22JRaEj5xhDtG6TM9dOPVJe4msUw',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoidVFTV0lGMlh2RFZnMTlsdUp1U0w4WHdMWFR6eWplWFVxU0FuVHpnRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1769141318);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stages` (
  `stageId` bigint unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `established` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `manager` bigint unsigned DEFAULT NULL,
  `author` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`stageId`),
  UNIQUE KEY `stages_location_unique` (`location`),
  KEY `stages_manager_foreign` (`manager`),
  KEY `stages_author_foreign` (`author`),
  CONSTRAINT `stages_author_foreign` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stages_manager_foreign` FOREIGN KEY (`manager`) REFERENCES `members` (`memberId`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stages`
--

LOCK TABLES `stages` WRITE;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` VALUES (105,'BAT','2026-02-14 09:23:38',NULL,11,'Active','2026-02-14 12:23:38','2026-02-14 12:23:57');
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_logins`
--

DROP TABLE IF EXISTS `user_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_logins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Suspended','Removed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logged_in_at` timestamp NULL DEFAULT NULL,
  `logged_out_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_logins_email_unique` (`email`),
  KEY `users_logins_user_id_foreign` (`user_id`),
  CONSTRAINT `users_logins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_logins`
--

LOCK TABLES `user_logins` WRITE;
/*!40000 ALTER TABLE `user_logins` DISABLE KEYS */;
INSERT INTO `user_logins` VALUES (1001,10,'navicorpdesigns@gmail.com','$2y$12$s3XWvoaHW3G3rXzfnP6ht.RRotBwTUjEh86vFfRSDNgGbiQVZLZw2','Active','IT','vVyoEf2DUt8QamfqlyptTpaHquksfuSoFl4idK33','bnQAXFRRsckc8fP3Shn5rH9NOe29VaJOqHRv0Jno','2026-01-26 15:14:27',NULL,'2026-01-23 01:08:34','2026-01-26 15:14:27'),(1002,11,'finebizkameima@gmail.com','$2y$12$jZGjvno0z6xGVhTV2TVucuADeyj/PsfSnREsZNv8cBlQSkCCtynFG','Active','Treasurer','5nuRwZGPV7mLjKcXDusgPjaBjZ92zVOQnQV7bN6m','C1QayfttKg82tqWLQvS9i7v6PcyYJAgfjPtumesv','2026-02-14 09:15:11',NULL,'2026-01-26 04:21:14','2026-02-14 09:15:11');
/*!40000 ALTER TABLE `user_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `user_role_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_role` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role_status` enum('Active','Pending','Suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `user_role_creator` bigint unsigned DEFAULT NULL,
  `user_role_created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_role_updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_role_bodaboda_create` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_bodaboda_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_bodaboda_update` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_bodaboda_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_loans_create` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_loans_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_loans_update` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_loans_delete` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_lands_create` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_lands_read` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_lands_update` tinyint(1) NOT NULL DEFAULT '0',
  `user_role_lands_delete` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_role_id`),
  UNIQUE KEY `user_roles_user_role_unique` (`user_role`),
  KEY `user_roles_user_role_creator_foreign` (`user_role_creator`),
  CONSTRAINT `user_roles_user_role_creator_foreign` FOREIGN KEY (`user_role_creator`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1001,'Chairman','Active',11,'2026-01-29 10:23:26','2026-01-29 14:12:38',1,1,0,0,1,1,0,0,1,1,1,0),(1002,'Secretary General','Active',11,'2026-01-29 10:27:50',NULL,1,1,1,0,1,1,0,0,1,1,0,0),(1003,'Treasurer','Active',11,'2026-01-29 10:57:47','2026-01-30 08:52:45',1,1,1,1,1,1,1,0,1,1,1,1),(1005,'IT','Active',11,'2026-01-30 08:50:23',NULL,1,1,1,1,1,1,1,0,1,1,1,0);
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `county` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Male',
  `national_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Suspended','Removed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  UNIQUE KEY `users_national_id_unique` (`national_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (10,'Ivan','Kush','navicorpdesigns@gmail.com','254785300200',NULL,NULL,NULL,NULL,'Male','27588659','1989-05-05','IT','Active','2026-01-23 01:08:33','2026-01-23 01:08:33',NULL),(11,'Isaac','Mbogo','finebizkameima@gmail.com','+254727041651',NULL,NULL,NULL,NULL,'Male','24575565','1980-01-01','Treasurer','Active','2026-01-26 04:21:13','2026-02-02 00:49:07',NULL);
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

-- Dump completed on 2026-02-16  9:35:15
