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
  `employee_ssn` varchar(50) NOT NULL DEFAULT '',
  `user_id` varchar(225) NOT NULL DEFAULT '',
  `employee_dep_id` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`employee_ssn`),
  KEY `user_id` (`user_id`),
  KEY `employee_dep_id` (`employee_dep_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employees: ~3 rows (approximately)
INSERT INTO `employees` (`employee_ssn`, `user_id`, `employee_dep_id`) VALUES
	('1234567890', '3f46422d-55cd-4743-9379-f80cca2b981a', '3'),
	('3719963212', '9f8499ae-3b9c-4aa3-8169-0f519bff2c63', '1');

-- Dumping structure for table iparcel_dev.employee_departments
CREATE TABLE IF NOT EXISTS `employee_departments` (
  `employee_dep_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`employee_dep_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employee_departments: ~3 rows (approximately)
INSERT INTO `employee_departments` (`employee_dep_id`, `name`, `description`) VALUES
	(1, 'Fulfillment', 'Manage parcels'),
	(2, 'Accounting', 'Manage company finances and billing'),
	(3, 'Human Resources', 'Manage employees');

-- Dumping structure for table iparcel_dev.employee_dep_managers
CREATE TABLE IF NOT EXISTS `employee_dep_managers` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `employee_dep_id` int DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.employee_dep_managers: ~1 rows (approximately)
INSERT INTO `employee_dep_managers` (`user_id`, `employee_dep_id`) VALUES
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
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  `expected_delivery_at` datetime DEFAULT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`parcel_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.parcels: ~1 rows (approximately)
INSERT INTO `parcels` (`parcel_id`, `status`, `weight`, `code`, `shipping_method`, `parcel_sender_id`, `parcel_recipient_id`, `user_id`, `created_at`, `deleted_at`, `expected_delivery_at`, `type`) VALUES
	('90d047f3-eabb-4fa5-9b51-d66831de14dd', 0, 12, 'gmqnHDAxk9', 2, '764dda54-a904-444b-8ecb-975803af287a', '36a5f9e2-024a-42d9-b16d-f0d6f02df911', '185739fe-e4a0-4147-a3fd-6ab0a80e34b4', NULL, NULL, NULL, NULL);

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

-- Dumping data for table iparcel_dev.parcel_recipient: ~1 rows (approximately)
INSERT INTO `parcel_recipient` (`parcel_recipient_id`, `name`, `address`, `city`, `state`, `zip`, `country`, `company`) VALUES
	('36a5f9e2-024a-42d9-b16d-f0d6f02df911', 'John Smith', '1234 Main St', 'Houston', 'Texas', 77449, 'United States', 'Globex Inc.');

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

-- Dumping data for table iparcel_dev.parcel_sender: ~1 rows (approximately)
INSERT INTO `parcel_sender` (`parcel_sender_id`, `name`, `address`, `city`, `state`, `zip`, `country`, `company`) VALUES
	('764dda54-a904-444b-8ecb-975803af287a', 'Jane Smith', '1234 Main St', 'Los Angeles', 'California', 90001, 'United States', 'ACME Co.');

-- Dumping structure for table iparcel_dev.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` varchar(225) NOT NULL DEFAULT '',
  `total` float DEFAULT NULL,
  `status` int DEFAULT NULL,
  `paid_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `cc_name` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `cc_exp` varchar(50) DEFAULT NULL,
  `cc_cvv` int DEFAULT NULL,
  `user_id` varchar(225) DEFAULT NULL,
  `cc_number` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`transaction_id`) USING BTREE,
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table iparcel_dev.transactions: ~1 rows (approximately)
INSERT INTO `transactions` (`transaction_id`, `total`, `status`, `paid_on`, `cc_name`, `cc_exp`, `cc_cvv`, `user_id`, `cc_number`) VALUES
	('e571e33b-f288-4506-be6d-709ad4a518e3', 12, 1, '2023-04-11 21:16:45', 'Jane Smith', '8/29', 558, '185739fe-e4a0-4147-a3fd-6ab0a80e34b4', '4929052552221153');

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

-- Dumping data for table iparcel_dev.users: ~4 rows (approximately)
INSERT INTO `users` (`user_id`, `name`, `password`, `email`, `phone`, `user_group_role_id`, `user_group_id`, `created_at`, `deleted_at`, `email_confirmed`) VALUES
	('185739fe-e4a0-4147-a3fd-6ab0a80e34b4', 'Demo Demo3', '$2y$10$Ojg1NlwI4XVIwIXQOnwabO0pNvNmhTIe6rx9FzsnbaZE1x0Gx6PQa', 'demo@demo.com', '28182731762', 0, 0, '2023-04-06 01:37:30', '2023-04-12 02:40:45', 0),
	('1cc786f8-0447-4ba9-ab20-f3ae63bbae47', 'Demo Demo4', '$2y$10$p751u0piZ3b7np7j/UlEWOi88bM6de404vz/J/leIT9l8kAqSnGnu', 'demo3@demo.com', '123', 0, 0, '2023-04-12 02:38:10', NULL, 0),
	('3f46422d-55cd-4743-9379-f80cca2b981a', 'Jane Smith', '$2y$10$WRjCbBrhKQ56dc01ImjoyeSAWP9d3zDElee8kjAB2U4/zFSqSYIgC', 'jane.smith@iparcel.com', '2812129182', 0, 0, '2023-04-07 02:12:23', NULL, 1),
	('9f8499ae-3b9c-4aa3-8169-0f519bff2c63', 'Demo Demo2', '$2y$10$bK7bynhrSSvGOEB0VNCJVeFlbWxTmBPy11hehx4sCdlWKQjSEBvhy', 'demo2@demo.com', '911', 0, 0, '2023-04-09 02:25:45', NULL, 0);

-- Dumping structure for trigger iparcel_dev.parcels_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `parcels_before_insert` BEFORE INSERT ON `parcels` FOR EACH ROW BEGIN
    IF NEW.weight < 10 THEN 
        SET NEW.type = 0;
    ELSE
        SET NEW.type =1;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger iparcel_dev.parcels_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `parcels_before_update` BEFORE UPDATE ON `parcels` FOR EACH ROW BEGIN
    IF NEW.expected_delivery_at > OLD.expected_delivery_at THEN
        SET NEW.status = 4;
    END IF;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
