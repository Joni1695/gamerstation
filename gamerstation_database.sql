-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17-log - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for gamerstation
DROP DATABASE IF EXISTS `gamerstation`;
CREATE DATABASE IF NOT EXISTS `gamerstation` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gamerstation`;


-- Dumping structure for table gamerstation.blocked_users
DROP TABLE IF EXISTS `blocked_users`;
CREATE TABLE IF NOT EXISTS `blocked_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `reason` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__users10` (`user_id`),
  KEY `FK__products10` (`product_id`),
  CONSTRAINT `FK__products10` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users10` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.blocked_users: ~0 rows (approximately)
DELETE FROM `blocked_users`;
/*!40000 ALTER TABLE `blocked_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `blocked_users` ENABLE KEYS */;


-- Dumping structure for table gamerstation.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.categories: ~8 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(1, 'Action'),
	(2, 'Adventure'),
	(3, 'Casual'),
	(4, 'Indie'),
	(5, 'Massively Multiplayer'),
	(6, 'Racing'),
	(7, 'RPG'),
	(8, 'Simulation'),
	(9, 'Sports'),
	(10, 'Strategy');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table gamerstation.categories_products
DROP TABLE IF EXISTS `categories_products`;
CREATE TABLE IF NOT EXISTS `categories_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products2` (`product_id`),
  KEY `FK__categories2` (`categories_id`),
  CONSTRAINT `FK__categories2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK__products2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.categories_products: ~15 rows (approximately)
DELETE FROM `categories_products`;
/*!40000 ALTER TABLE `categories_products` DISABLE KEYS */;
INSERT INTO `categories_products` (`id`, `product_id`, `categories_id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(39, 16, 2),
	(40, 16, 3),
	(41, 16, 1),
	(42, 23, 1),
	(43, 22, 1),
	(44, 24, 1),
	(45, 18, 1),
	(47, 21, 1),
	(48, 17, 1),
	(49, 6, 1),
	(50, 6, 2),
	(51, 25, 1),
	(52, 25, 10);
/*!40000 ALTER TABLE `categories_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `thread_id` int(11) NOT NULL,
  `desc` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__users6` (`user_id`),
  KEY `FK__threads6` (`thread_id`),
  CONSTRAINT `FK__threads6` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users6` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.comments: ~0 rows (approximately)
DELETE FROM `comments`;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


-- Dumping structure for table gamerstation.feedback
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.feedback: ~0 rows (approximately)
DELETE FROM `feedback`;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;


-- Dumping structure for table gamerstation.first_products
DROP TABLE IF EXISTS `first_products`;
CREATE TABLE IF NOT EXISTS `first_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`),
  CONSTRAINT `FK__products11` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.first_products: ~3 rows (approximately)
DELETE FROM `first_products`;
/*!40000 ALTER TABLE `first_products` DISABLE KEYS */;
INSERT INTO `first_products` (`id`, `product_id`) VALUES
	(4, 16),
	(7, 17),
	(10, 25);
/*!40000 ALTER TABLE `first_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.mods
DROP TABLE IF EXISTS `mods`;
CREATE TABLE IF NOT EXISTS `mods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__users9` (`user_id`),
  KEY `FK__products9` (`product_id`),
  CONSTRAINT `FK__products9` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users9` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.mods: ~0 rows (approximately)
DELETE FROM `mods`;
/*!40000 ALTER TABLE `mods` DISABLE KEYS */;
/*!40000 ALTER TABLE `mods` ENABLE KEYS */;


-- Dumping structure for table gamerstation.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `adress2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zipcode` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products1` (`product_id`),
  KEY `FK__users1` (`user_id`),
  CONSTRAINT `FK__products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK__users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.orders: ~2 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `product_id`, `user_id`, `transaction_id`, `qty`, `price`, `adress`, `adress2`, `city`, `state`, `zipcode`) VALUES
	(6, 25, 1, '16Y52455DY212741D', 5, 234.00, 'Adresa1', 'Adresa2', 'Albania', 'Tirane', '1001'),
	(7, 18, 1, '16Y52455DY212741D', 3, 234.00, 'Adresa1', 'Adresa2', 'Albania', 'Tirane', '1001');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Dumping structure for table gamerstation.platform
DROP TABLE IF EXISTS `platform`;
CREATE TABLE IF NOT EXISTS `platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.platform: ~4 rows (approximately)
DELETE FROM `platform`;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` (`id`, `name`) VALUES
	(1, 'PC'),
	(2, 'Xbox One'),
	(3, 'PS4'),
	(4, 'Nintendo DS');
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;


-- Dumping structure for table gamerstation.platform_products
DROP TABLE IF EXISTS `platform_products`;
CREATE TABLE IF NOT EXISTS `platform_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products3` (`product_id`),
  KEY `FK__platform3` (`platform_id`),
  CONSTRAINT `FK__platform3` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__products3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.platform_products: ~13 rows (approximately)
DELETE FROM `platform_products`;
/*!40000 ALTER TABLE `platform_products` DISABLE KEYS */;
INSERT INTO `platform_products` (`id`, `product_id`, `platform_id`) VALUES
	(1, 1, 1),
	(3, 1, 3),
	(4, 1, 2),
	(20, 16, 1),
	(23, 23, 1),
	(24, 22, 1),
	(25, 24, 1),
	(26, 18, 1),
	(27, 21, 1),
	(28, 17, 1),
	(29, 6, 1),
	(30, 6, 2),
	(31, 6, 3),
	(32, 25, 1);
/*!40000 ALTER TABLE `platform_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `trailer_video` varchar(200) DEFAULT NULL,
  `gameImagePath` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.products: ~11 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `title`, `description`, `price`, `trailer_video`, `gameImagePath`, `created_at`) VALUES
	(1, 'Assassin\'s Creed Black Flag', 'Bunch of ol\' pirates fucking shit up.', 39.99, 'https://www.youtube.com/watch?v=32U_KOUuQ74', 'assets/images/banner.jpg', '2016-04-29 03:10:14'),
	(6, 'Far Cry 3', 'Have I ever told you the definition of insanity?', 23.66, 'https://www.youtube.com/watch?v=J6gnOVJsCsM', 'assets/images/game6.jpg', '2016-04-29 03:10:14'),
	(16, 'Jobfind', 'asfn ask kfash fjhask fhasj jkash fhasj jfash flhas', 78.00, 'www.jigjjirjoek.com', 'assets/images/banner1.jpg', '2016-05-07 10:31:12'),
	(17, 'Jobfind3', 'asfn ask kfash fjhask fhasj jkash fhasj jfash flhas', 78.00, 'www.jigjjirjoek.com', 'assets/images/banner2.jpg', '2016-05-07 10:31:12'),
	(18, 'Jobfind3', 'asfn ask kfash fjhask fhasj jkash fhasj jfash flhas', 78.00, 'www.jigjjirjoek.com', 'assets/images/banner2.jpg', '2016-05-07 10:31:12'),
	(19, 'Jobfind3', 'asfn ask kfash fjhask fhasj jkash fhasj jfash flhas', 78.00, 'www.jigjjirjoek.com', 'assets/images/banner2.jpg', '2016-05-07 10:31:12'),
	(21, 'Jobfind3', 'asfn ask kfash fjhask fhasj jkash fhasj jfash flhas', 78.00, 'www.jigjjirjoek.com', 'assets/images/banner2.jpg', '2016-05-07 10:31:12'),
	(22, 'Assassin\'s Creed Black Flag', 'Bunch of ol\' pirates fucking shit up.', 39.99, 'https://www.youtube.com/watch?v=32U_KOUuQ74', 'assets/images/banner.jpg', '2016-04-29 03:10:14'),
	(23, 'A\'s Creed Black Flag', 'Bunc', 39.99, 'httpoutube.com/watch?v=32U_KOUuQ74', 'assets/images/banner1.jpg', '2016-04-29 03:10:14'),
	(24, 'Assassin\'s Creed Black Flag', 'Bunch of ol\' pirates fucking shit up.', 39.99, 'https://www.youtube.com/watch?v=32U_KOUuQ74', 'assets/images/banner.jpg', '2016-04-29 03:10:14'),
	(25, 'Civilization 5', 'Play your favourite nation to conquer them all!', 59.99, 'https://www.youtube.com/watch?v=MRoYEBfM_3A', 'assets/images/game25.jpg', '2016-05-16 12:01:11');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.reviews
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products4` (`product_id`),
  KEY `FK__users4` (`user_id`),
  CONSTRAINT `FK__products4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.reviews: ~3 rows (approximately)
DELETE FROM `reviews`;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `text`) VALUES
	(1, 6, 1, 'qija robte'),
	(2, 6, 2, 'kololol'),
	(4, 6, 3, 'mos ja fut kot'),
	(5, 18, 1, 'super loje me nona'),
	(6, 21, 1, 'Super loje, me pelqeu shume.');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;


-- Dumping structure for table gamerstation.threads
DROP TABLE IF EXISTS `threads`;
CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK__users5` (`user_id`),
  KEY `FK__products5` (`product_id`),
  CONSTRAINT `FK__products5` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users5` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.threads: ~4 rows (approximately)
DELETE FROM `threads`;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` (`id`, `user_id`, `product_id`, `title`, `desc`, `created_at`) VALUES
	(3, 1, 23, 'Shume loje koti', 'Nuk ja vlente loja', '2013-05-12 22:30:23'),
	(5, 1, 22, 'Shume loje koti\r\n', 'Nuk ja vlente loja', '2016-05-12 20:30:23'),
	(6, 1, 24, 'Shume loje koti', 'Nuk ja vlente loja5', '2016-05-11 20:30:23'),
	(7, 1, 16, 'Shume loje koti\r\n', 'Nuk ja vlente loja', '2016-03-11 20:30:23');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;


-- Dumping structure for table gamerstation.thread_reports
DROP TABLE IF EXISTS `thread_reports`;
CREATE TABLE IF NOT EXISTS `thread_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thread_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__threads` (`thread_id`),
  KEY `FK_thread_reports_users` (`user_id`),
  CONSTRAINT `FK_thread_reports_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__threads` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.thread_reports: ~1 rows (approximately)
DELETE FROM `thread_reports`;
/*!40000 ALTER TABLE `thread_reports` DISABLE KEYS */;
INSERT INTO `thread_reports` (`id`, `thread_id`, `user_id`) VALUES
	(4, 5, 3);
/*!40000 ALTER TABLE `thread_reports` ENABLE KEYS */;


-- Dumping structure for table gamerstation.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('admin','user') NOT NULL DEFAULT 'user',
  `banned` enum('Y','N') NOT NULL DEFAULT 'N',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `status`, `banned`, `join_date`) VALUES
	(1, 'Joni', 'Seraj', 'Admin', 'joniseraj@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin', 'N', '2016-04-29 03:13:07'),
	(2, 'Jurgen', 'Serbo', 'Jurgens37', 'jurgenserbo@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'N', '2016-05-09 04:01:54'),
	(3, 'Agim', 'Kolo', 'Sunshine', 'sunshine@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user', 'Y', '2016-05-12 02:58:39');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table gamerstation.user_ratings
DROP TABLE IF EXISTS `user_ratings`;
CREATE TABLE IF NOT EXISTS `user_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_product_id` int(11) NOT NULL DEFAULT '0',
  `fk_user_id` int(11) NOT NULL DEFAULT '0',
  `rating` decimal(10,2) NOT NULL DEFAULT '3.00',
  PRIMARY KEY (`id`),
  KEY `FK__products` (`fk_product_id`),
  KEY `FK__users` (`fk_user_id`),
  CONSTRAINT `FK__products` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__users` FOREIGN KEY (`fk_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.user_ratings: ~7 rows (approximately)
DELETE FROM `user_ratings`;
/*!40000 ALTER TABLE `user_ratings` DISABLE KEYS */;
INSERT INTO `user_ratings` (`id`, `fk_product_id`, `fk_user_id`, `rating`) VALUES
	(3, 18, 1, 4.00),
	(4, 6, 1, 4.00),
	(5, 6, 2, 1.00),
	(6, 6, 3, 3.00),
	(7, 21, 1, 4.00),
	(8, 19, 1, 3.00),
	(9, 17, 1, 3.00);
/*!40000 ALTER TABLE `user_ratings` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
