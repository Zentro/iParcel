-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for iparcel_dev
CREATE DATABASE IF NOT EXISTS `iparcel_dev` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `iparcel_dev`;

-- Dumping structure for table iparcel_dev.parcels
CREATE TABLE IF NOT EXISTS `parcels` (
  `parcel_id` varchar(225) NOT NULL DEFAULT '',
  `status` int DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `shipping_method` int DEFAULT NULL,
  `parcel_sender_id` varchar(225) DEFAULT NULL,
  `parcel_recipient_id` varchar(225) DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`parcel_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcels: ~1 rows (approximately)
INSERT INTO `parcels` (`parcel_id`, `status`, `weight`, `code`, `shipping_method`, `parcel_sender_id`, `parcel_recipient_id`, `user_id`) VALUES
	('09859d39-7b09-4345-95c5-07c30f7f7b02', 0, 21, '1qHmDSD0h6', 0, '5b324bba-b500-495c-b217-624142bdb329', '7b0064df-563c-4ee2-8fea-9e936ab7d8f3', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4');

-- Dumping structure for table iparcel_dev.parcel_log
CREATE TABLE IF NOT EXISTS `parcel_log` (
  `parcel_log_id` int NOT NULL AUTO_INCREMENT,
  `from_addr` int DEFAULT NULL,
  `to_addr` int DEFAULT NULL,
  `created_on` int DEFAULT NULL,
  PRIMARY KEY (`parcel_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcel_log: ~0 rows (approximately)

-- Dumping structure for table iparcel_dev.parcel_method
CREATE TABLE IF NOT EXISTS `parcel_method` (
  `parcel_method_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`parcel_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcel_method: ~0 rows (approximately)

-- Dumping structure for table iparcel_dev.parcel_recipient
CREATE TABLE IF NOT EXISTS `parcel_recipient` (
  `parcel_recipient_id` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `city` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `state` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `zip` int NOT NULL DEFAULT '0',
  `country` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'United States',
  `company` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`parcel_recipient_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table iparcel_dev.parcel_recipient: ~0 rows (approximately)
INSERT INTO `parcel_recipient` (`parcel_recipient_id`, `name`, `address`, `city`, `state`, `zip`, `country`, `company`) VALUES
	('7b0064df-563c-4ee2-8fea-9e936ab7d8f3', 'random', 'random', 'random', 'Texas', 2313123, 'United States', 'random');

-- Dumping structure for table iparcel_dev.parcel_sender
CREATE TABLE IF NOT EXISTS `parcel_sender` (
  `parcel_sender_id` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `name` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `city` varchar(225) NOT NULL,
  `state` varchar(225) NOT NULL,
  `zip` int NOT NULL DEFAULT '0',
  `country` varchar(225) NOT NULL DEFAULT 'United States',
  `company` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`parcel_sender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcel_sender: ~0 rows (approximately)
INSERT INTO `parcel_sender` (`parcel_sender_id`, `name`, `address`, `city`, `state`, `zip`, `country`, `company`) VALUES
	('5b324bba-b500-495c-b217-624142bdb329', 'random', 'random', 'random', 'California', 2313, 'United States', 'random'),
	('75079d05-6fd2-4c20-804b-e467406c5fd1', 'random', 'random', 'random', 'California', 2313, 'United States', 'random'),
	('f2df1383-13ac-4abf-9326-63494c212580', 'random', 'random', 'random', 'California', 2313, 'United States', 'random');

-- Dumping structure for table iparcel_dev.payment_log
CREATE TABLE IF NOT EXISTS `payment_log` (
  `payment_id` int NOT NULL,
  `total` float DEFAULT NULL,
  `method` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `paid_on` int DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.payment_log: ~0 rows (approximately)

-- Dumping structure for table iparcel_dev.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` varchar(225) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(225) DEFAULT NULL,
  `email` varchar(225) NOT NULL DEFAULT '0',
  `phone` varchar(13) DEFAULT NULL,
  `user_group_role_id` int NOT NULL DEFAULT '0',
  `user_group_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `email_confirmed` int DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.users: ~1 rows (approximately)
INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `phone`, `user_group_role_id`, `user_group_id`, `created_at`, `deleted_at`, `email_confirmed`) VALUES
	('185739fe-e4a0-4147-a3fd-6ab0a80e34b4', 'Demo Demo2', '$2y$10$Ojg1NlwI4XVIwIXQOnwabO0pNvNmhTIe6rx9FzsnbaZE1x0Gx6PQa', 'demo@demo.com', '28182731762', 0, 0, '2023-04-06 01:37:30', NULL, 0);

-- Dumping structure for table iparcel_dev.user_groups
CREATE TABLE IF NOT EXISTS `user_groups` (
  `user_group_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.user_groups: ~2 rows (approximately)
INSERT INTO `user_groups` (`user_group_id`, `name`, `description`) VALUES
	(1, 'Guests', 'The default user group.'),
	(2, 'Employees', 'The user group for employees.');

-- Dumping structure for table iparcel_dev.user_group_owners
CREATE TABLE IF NOT EXISTS `user_group_owners` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_group_id` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.user_group_owners: ~0 rows (approximately)
INSERT INTO `user_group_owners` (`user_id`, `user_group_id`) VALUES
	(2, 2);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
