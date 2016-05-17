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
CREATE DATABASE IF NOT EXISTS `gamerstation` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gamerstation`;


-- Dumping structure for table gamerstation.blocked_users
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
CREATE TABLE IF NOT EXISTS `categories_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `categories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products2` (`product_id`),
  KEY `FK__categories2` (`categories_id`),
  CONSTRAINT `FK__categories2` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK__products2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.categories_products: ~32 rows (approximately)
DELETE FROM `categories_products`;
/*!40000 ALTER TABLE `categories_products` DISABLE KEYS */;
INSERT INTO `categories_products` (`id`, `product_id`, `categories_id`) VALUES
	(53, 34, 1),
	(54, 34, 10),
	(55, 35, 1),
	(56, 35, 2),
	(57, 35, 7),
	(58, 36, 1),
	(59, 36, 2),
	(60, 36, 7),
	(66, 42, 1),
	(67, 42, 2),
	(68, 42, 3),
	(69, 42, 4),
	(70, 42, 7),
	(79, 44, 1),
	(80, 44, 2),
	(81, 44, 3),
	(82, 44, 5),
	(83, 44, 7),
	(84, 44, 8),
	(85, 43, 1),
	(86, 43, 2),
	(87, 43, 7),
	(88, 43, 10),
	(89, 45, 2),
	(90, 45, 7),
	(91, 45, 10),
	(92, 46, 3),
	(93, 46, 5),
	(94, 46, 7),
	(95, 46, 10),
	(96, 47, 1),
	(97, 47, 2);
/*!40000 ALTER TABLE `categories_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.ci_sessions
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.ci_sessions: ~0 rows (approximately)
DELETE FROM `ci_sessions`;
/*!40000 ALTER TABLE `ci_sessions` DISABLE KEYS */;
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
	('25f6d10d06a6c08ba40fea047a361a39b13296fc', '::1', 1463529004, _binary 0x5F5F63695F6C6173745F726567656E65726174657C693A313436333532383738313B757365725F69647C733A313A2231223B757365726E616D657C733A353A2241646D696E223B6C6F676765645F696E7C623A313B7374617475737C733A353A2261646D696E223B636172745F636F6E74656E74737C613A343A7B733A31303A22636172745F746F74616C223B643A37392E3938303030303030303030303030343B733A31313A22746F74616C5F6974656D73223B643A323B733A33323A226439643466343935653837356132653037356131613461366531623937373066223B613A363A7B733A323A226964223B733A323A223436223B733A333A22717479223B643A313B733A353A227072696365223B643A32392E3938393939393939393939393939383B733A343A226E616D65223B733A31353A22506F6B656D6F6E2046697265526564223B733A353A22726F776964223B733A33323A226439643466343935653837356132653037356131613461366531623937373066223B733A383A22737562746F74616C223B643A32392E3938393939393939393939393939383B7D733A33323A223637633661316537636535366433643666613734386162366439616633666437223B613A363A7B733A323A226964223B733A323A223437223B733A333A22717479223B643A313B733A353A227072696365223B643A34392E3939303030303030303030303030323B733A343A226E616D65223B733A31363A22417373617373696E6073204372656564223B733A353A22726F776964223B733A33323A223637633661316537636535366433643666613734386162366439616633666437223B733A383A22737562746F74616C223B643A34392E3939303030303030303030303030323B7D7D);
/*!40000 ALTER TABLE `ci_sessions` ENABLE KEYS */;


-- Dumping structure for table gamerstation.comments
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
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `text` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.feedback: ~1 rows (approximately)
DELETE FROM `feedback`;
/*!40000 ALTER TABLE `feedback` DISABLE KEYS */;
INSERT INTO `feedback` (`id`, `name`, `contact`, `text`) VALUES
	(1, 'Student101', 'student@gmail.com', 'I would like it if you added x feature to the website. Gratz on the work done so far!');
/*!40000 ALTER TABLE `feedback` ENABLE KEYS */;


-- Dumping structure for table gamerstation.first_products
CREATE TABLE IF NOT EXISTS `first_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`),
  CONSTRAINT `FK__products11` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.first_products: ~3 rows (approximately)
DELETE FROM `first_products`;
/*!40000 ALTER TABLE `first_products` DISABLE KEYS */;
INSERT INTO `first_products` (`id`, `product_id`) VALUES
	(12, 35),
	(15, 42),
	(14, 47);
/*!40000 ALTER TABLE `first_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.mods
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
  CONSTRAINT `FK__products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION,
  CONSTRAINT `FK__users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.orders: ~0 rows (approximately)
DELETE FROM `orders`;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `product_id`, `user_id`, `transaction_id`, `qty`, `price`, `adress`, `adress2`, `city`, `state`, `zipcode`) VALUES
	(6, 47, 1, '16Y52455DY212741D', 5, 234.00, 'Adresa1', 'Adresa2', 'Albania', 'Tirane', '1001');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Dumping structure for table gamerstation.platform
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
CREATE TABLE IF NOT EXISTS `platform_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__products3` (`product_id`),
  KEY `FK__platform3` (`platform_id`),
  CONSTRAINT `FK__platform3` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__products3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.platform_products: ~22 rows (approximately)
DELETE FROM `platform_products`;
/*!40000 ALTER TABLE `platform_products` DISABLE KEYS */;
INSERT INTO `platform_products` (`id`, `product_id`, `platform_id`) VALUES
	(33, 34, 1),
	(34, 35, 1),
	(35, 35, 2),
	(36, 35, 3),
	(37, 36, 1),
	(38, 36, 2),
	(39, 36, 3),
	(43, 42, 1),
	(44, 42, 2),
	(45, 42, 3),
	(52, 44, 1),
	(53, 44, 2),
	(54, 44, 3),
	(55, 43, 1),
	(56, 43, 2),
	(57, 43, 3),
	(58, 45, 4),
	(59, 46, 1),
	(60, 46, 4),
	(61, 47, 1),
	(62, 47, 2),
	(63, 47, 3);
/*!40000 ALTER TABLE `platform_products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `trailer_video` varchar(200) DEFAULT NULL,
  `gameImagePath` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.products: ~9 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `title`, `description`, `price`, `trailer_video`, `gameImagePath`, `created_at`) VALUES
	(34, 'Civilization 5', 'The Flagship Turn-Based Strategy Game Returns \r\n\r\nBecome Ruler of the World by establishing and leading a civilization from the dawn of man into the space age: Wage war, conduct diplomacy, discover new technologies, go head-to-head with some of history&rs', 29.99, 'https://www.youtube.com/watch?v=l-y99pkS_Vs', 'assets/images/game34.jpg', '2016-05-17 22:40:33'),
	(35, 'The Elder Scrolls V: Skyrim', 'EPIC FANTASY REBORN \r\nThe next chapter in the highly anticipated Elder Scrolls saga arrives from the makers of the 2006 and 2008 Games of the Year, Bethesda Game Studios. Skyrim reimagines and revolutionizes the open-world fantasy epic, bringing to life a', 14.99, 'http://cdn.akamai.steamstatic.com/steam/apps/81281/movie480.webm?t=1447355016', 'assets/images/game35.jpg', '2016-05-17 22:45:57'),
	(36, 'The Witcher&reg; 3: Wild Hunt', 'The Witcher: Wild Hunt is a story-driven, next-generation open world role-playing game set in a visually stunning fantasy universe full of meaningful choices and impactful consequences. In The Witcher you play as the professional monster hunter, Geralt of', 24.99, 'http://cdn.akamai.steamstatic.com/steam/apps/256658589/movie480.webm?t=1448465648', 'assets/images/game36.jpg', '2016-05-17 22:50:05'),
	(42, 'No Man`s Sky', 'Inspired by the adventure and imagination that we love from classic science-fiction, No Man`s Sky presents you with a galaxy to explore, filled with unique planets and lifeforms, and constant danger and action. \r\n\r\nIn No Man`s Sky, every star is the light of a distant sun, each orbited by planets filled with life, and you can go to any of them you choose. Fly smoothly from deep space to planetary surfaces, with no loading screens, and no limits. In this infinite procedurally generated universe,', 59.99, 'http://cdn.akamai.steamstatic.com/steam/apps/2040146/movie480.webm?t=1447376591', 'assets/images/game42.jpg', '2016-05-17 23:33:35'),
	(43, 'Dark Souls III', '- Winner of gamescom award 2015 &amp;quot;Best RPG&amp;quot; and over 35 E3 2015 Awards and Nominations -\r\n\r\nDARK SOULS&amp;trade; III continues to push the boundaries with the latest, ambitious chapter in the critically-acclaimed and genre-defining series. \r\n\r\nAs fires fade and the world falls into ruin, journey into a universe filled with more colossal enemies and environments. Players will be immersed into a world of epic atmosphere and darkness through faster gameplay and amplified combat intensity. Fan', 59.99, 'http://cdn.akamai.steamstatic.com/steam/apps/256663133/movie480.webm?t=1461062929', 'assets/images/game43.jpg', '2016-05-17 23:38:28'),
	(44, 'GTA V', 'When a young street hustler, a retired bank robber and a terrifying psychopath find themselves entangled with some of the most frightening and deranged elements of the criminal underworld, the U.S. government and the entertainment industry, they must pull off a series of dangerous heists to survive in a ruthless city in which they can trust nobody, least of all each other.\r\n\r\nGrand Theft Auto V for PC offers players the option to explore the award-winning world of Los Santos and Blaine County in resolutions of up to 4k and beyond, as well as the chance to experience the game running at 60 frames per second. \r\n\r\nThe game offers players a huge range of PC-specific customization options, including over 25 separate configurable settings for texture quality, shaders, tessellation, anti-aliasing and more, as well as support and extensive customization for mouse and keyboard controls. Additional options include a population density slider to control car and pedestrian traffic, as well as dual', 79.99, 'http://cdn.akamai.steamstatic.com/steam/apps/256659110/movie480.webm?t=1450306606', 'assets/images/game44.jpg', '2016-05-17 23:41:05'),
	(45, 'Fire Emblem Fates', 'Nintendo\'s latest revolutionary strategy game!\r\n\r\nPlay your favourite character, kill your enemies, conquer the world to secure peace or for the glory of battle. Make your choice in this brave new adventure!', 15.99, 'https://www.youtube.com/watch?v=94CCxVMltQY', 'assets/images/game45.jpg', '2016-05-18 00:31:13'),
	(46, 'Pokemon FireRed', 'I wanna be the very best, like no one ever was..... To catch em all is my real test, to train them is my cause...', 29.99, 'https://www.youtube.com/watch?v=J9Z1LWbI-Ok', 'assets/images/game46.jpg', '2016-05-18 00:37:29'),
	(47, 'Assassin`s Creed', 'Explore a world full of deadly assassins, secret organizations, mystery, quests and gold.', 49.99, 'https://www.youtube.com/watch?v=xzCEdSKMkdU', 'assets/images/game47.jpg', '2016-05-18 00:40:17');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table gamerstation.reviews
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.reviews: ~3 rows (approximately)
DELETE FROM `reviews`;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `text`) VALUES
	(7, 47, 1, 'Really enjoyed the game, it was a very pleasant experience.\r\nControls were smooth, game ran fine on my PC, despite it being quite old. Loved the characters, way better than the last one.\r\nAll in all, fantastic job Ubisoft devs! Looking forward to future releases!'),
	(8, 47, 2, 'Was quite sloopy to be honest, didn\'t enjoy it all. Looks like a cash-waster boys. IMO not worth spending $50 on it.'),
	(9, 46, 2, 'Loved it! Amazing game. It\'s so much fun.');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;


-- Dumping structure for table gamerstation.threads
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.threads: ~1 rows (approximately)
DELETE FROM `threads`;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` (`id`, `user_id`, `product_id`, `title`, `desc`, `created_at`) VALUES
	(12, 1, 47, 'Loved the main character!', 'So well planned and customized!', '2016-05-18 00:58:19');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;


-- Dumping structure for table gamerstation.thread_reports
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

-- Dumping data for table gamerstation.thread_reports: ~0 rows (approximately)
DELETE FROM `thread_reports`;
/*!40000 ALTER TABLE `thread_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `thread_reports` ENABLE KEYS */;


-- Dumping structure for table gamerstation.users
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table gamerstation.user_ratings: ~12 rows (approximately)
DELETE FROM `user_ratings`;
/*!40000 ALTER TABLE `user_ratings` DISABLE KEYS */;
INSERT INTO `user_ratings` (`id`, `fk_product_id`, `fk_user_id`, `rating`) VALUES
	(10, 47, 1, 5.00),
	(11, 47, 2, 2.00),
	(12, 46, 2, 5.00),
	(13, 45, 2, 1.00),
	(14, 44, 2, 3.00),
	(15, 42, 2, 4.00),
	(16, 36, 2, 3.00),
	(17, 35, 2, 2.00),
	(18, 46, 1, 4.00),
	(19, 45, 1, 4.00),
	(20, 44, 1, 5.00),
	(21, 42, 1, 3.00);
/*!40000 ALTER TABLE `user_ratings` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
