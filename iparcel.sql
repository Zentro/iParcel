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

-- Dumping structure for table iparcel_dev.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_ssn` int NOT NULL,
  `user_id` varchar(225) NOT NULL DEFAULT '',
  `employee_dep_id` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`employee_ssn`),
  KEY `user_id` (`user_id`),
  KEY `employee_dep_id` (`employee_dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employees: ~1 rows (approximately)
INSERT INTO `employees` (`employee_ssn`, `user_id`, `employee_dep_id`) VALUES
	(1234567890, '3f46422d-55cd-4743-9379-f80cca2b981a', '3');

-- Dumping structure for table iparcel_dev.employee_departments
CREATE TABLE IF NOT EXISTS `employee_departments` (
  `employee_dep_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employee_dep_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employee_departments: ~2 rows (approximately)
INSERT INTO `employee_departments` (`employee_dep_id`, `name`, `description`) VALUES
	(1, 'Fulfillment', 'Manage parcels'),
	(2, 'Accounting', 'Manage company finances and billing'),
	(3, 'HR', 'Manage employees');

-- Dumping structure for table iparcel_dev.employee_dep_managers
CREATE TABLE IF NOT EXISTS `employee_dep_managers` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_group_id` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employee_dep_managers: ~0 rows (approximately)
INSERT INTO `employee_dep_managers` (`user_id`, `user_group_id`) VALUES
	(2, 2);

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

-- Dumping data for table iparcel_dev.parcels: ~0 rows (approximately)
INSERT INTO `parcels` (`parcel_id`, `status`, `weight`, `code`, `shipping_method`, `parcel_sender_id`, `parcel_recipient_id`, `user_id`) VALUES
	('09859d39-7b09-4345-95c5-07c30f7f7b02', 0, 21, '1qHmDSD0h6', 0, '5b324bba-b500-495c-b217-624142bdb329', '7b0064df-563c-4ee2-8fea-9e936ab7d8f3', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4'),
	('0dce2092-085f-4f56-b0a5-bcdae0c3539d', 0, 21, 'Xxj0YrcsB3', 1, 'd93e5fab-6fe3-4abf-a709-8a1eb0e11cdf', 'be08351f-f584-40a1-8e35-811d75789565', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4'),
	('c680fb64-4e9e-4827-a929-7c164aaed2af', 0, 21, 'aA0uWGybTT', 1, '1d94c5ee-494d-45ad-807a-386f58afaec0', 'f5698753-fb17-45a6-b107-f3c6078c5e28', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4'),
	('cf7ac5c0-eb1f-497c-82cd-a0f1231a1eb1', 0, 21, 'DKsO65pzPT', 1, '097cbf16-1c86-4959-99b5-e41a77666eec', 'afa29b9f-01d0-4ac3-9652-45c72741fcf5', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4'),
	('e799ce84-238d-48f1-a6a3-49683417a4ec', 0, 21, '0LXB1YK37G', 1, '3343ceb5-9a2a-4ac0-b458-4f300ac2cccd', '90699c5b-4f4f-4652-924f-3c4af7f07122', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4');

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
  `description` varchar(225) DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`parcel_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcel_method: ~2 rows (approximately)
INSERT INTO `parcel_method` (`parcel_method_id`, `name`, `description`, `price`) VALUES
	(1, 'Standard', 'Standard Mail with tracking and delivery within 6-7 business days.', 7.25),
	(2, 'Priority', 'Priority Mail with tracking and delivery in 1-3 business days.', 12);

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
	('7b0064df-563c-4ee2-8fea-9e936ab7d8f3', 'random', 'random', 'random', 'Texas', 2313123, 'United States', 'random'),
	('90699c5b-4f4f-4652-924f-3c4af7f07122', 'dwada', '2312', '233122', 'California', 2313, 'United States', 'dswad'),
	('afa29b9f-01d0-4ac3-9652-45c72741fcf5', 'dwada', '2312', '233122', 'California', 2313, 'United States', 'dswad'),
	('be08351f-f584-40a1-8e35-811d75789565', 'dwada', '2312', '233122', 'California', 2313, 'United States', 'dswad'),
	('f5698753-fb17-45a6-b107-f3c6078c5e28', 'dwada', '2312', '233122', 'California', 2313, 'United States', 'dswad');

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

-- Dumping data for table iparcel_dev.parcel_sender: ~2 rows (approximately)
INSERT INTO `parcel_sender` (`parcel_sender_id`, `name`, `address`, `city`, `state`, `zip`, `country`, `company`) VALUES
	('097cbf16-1c86-4959-99b5-e41a77666eec', 'John Smith', 'dwadwd', 'dwad', 'California', 2313123, 'United States', 'ACME Co.'),
	('1d94c5ee-494d-45ad-807a-386f58afaec0', 'John Smith', 'dwadwd', 'dwad', 'California', 2313123, 'United States', 'ACME Co.'),
	('3343ceb5-9a2a-4ac0-b458-4f300ac2cccd', 'John Smith', 'dwadwd', 'dwad', 'California', 2313123, 'United States', 'ACME Co.'),
	('5b324bba-b500-495c-b217-624142bdb329', 'random', 'random', 'random', 'California', 2313, 'United States', 'random'),
	('75079d05-6fd2-4c20-804b-e467406c5fd1', 'random', 'random', 'random', 'California', 2313, 'United States', 'random'),
	('d93e5fab-6fe3-4abf-a709-8a1eb0e11cdf', 'John Smith', 'dwadwd', 'dwad', 'California', 2313123, 'United States', 'ACME Co.'),
	('f2df1383-13ac-4abf-9326-63494c212580', 'random', 'random', 'random', 'California', 2313, 'United States', 'random');

-- Dumping structure for table iparcel_dev.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` varchar(225) NOT NULL DEFAULT '',
  `total` float DEFAULT NULL,
  `status` int DEFAULT NULL,
  `paid_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `cc_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cc_number` int DEFAULT NULL,
  `cc_exp` int DEFAULT NULL,
  `cc_cvv` int DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.transactions: ~0 rows (approximately)
INSERT INTO `transactions` (`transaction_id`, `total`, `status`, `paid_on`, `cc_name`, `cc_number`, `cc_exp`, `cc_cvv`, `user_id`) VALUES
	('b5a8e8ea-41c9-42b2-8009-4989ad20cb87', 12, 1, NULL, 'john smith', 32123, 3213, 213, '185739fe-e4a0-4147-a3fd-6ab0a80e34b4');

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
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.users: ~2 rows (approximately)
INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `phone`, `user_group_role_id`, `user_group_id`, `created_at`, `deleted_at`, `email_confirmed`) VALUES
	('185739fe-e4a0-4147-a3fd-6ab0a80e34b4', 'Demo Demo2', '$2y$10$Ojg1NlwI4XVIwIXQOnwabO0pNvNmhTIe6rx9FzsnbaZE1x0Gx6PQa', 'demo@demo.com', '28182731762', 0, 0, '2023-04-06 01:37:30', NULL, 0),
	('3f46422d-55cd-4743-9379-f80cca2b981a', 'Jane Smith', '$2y$10$WRjCbBrhKQ56dc01ImjoyeSAWP9d3zDElee8kjAB2U4/zFSqSYIgC', 'jane.smith@iparcel.com', '2812129182', 0, 0, '2023-04-07 02:12:23', NULL, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
