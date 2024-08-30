-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.33 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for glee
CREATE DATABASE IF NOT EXISTS `glee` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `glee`;

-- Dumping structure for table glee.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `vcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.admin: ~5 rows (approximately)
INSERT INTO `admin` (`fname`, `lname`, `email`, `vcode`) VALUES
	('chathuri', 'wasundara', 'chathuriw222@gmail.com', '6665b96e1f4ba'),
	('udeshi', 'hewage', 'kudeshihewage00@gmail.com', NULL),
	('sandali', 'darshika', 'sachiworkonly@gmailcom', NULL),
	('ganga', 'samarasekara', 'samarasekaraganga4@gmail.com', '6663ca59a94c0'),
	('tharaka ', 'jayaweera', 'tharakajayaweera2003@gmailcom', NULL);

-- Dumping structure for table glee.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.cart: ~12 rows (approximately)
INSERT INTO `cart` (`cart_id`, `qty`, `user_email`, `product_id`) VALUES
	(1, 1, 'samarasekaraganga4@gmailcom', 6),
	(2, 1, 'samarasekaraganga4@gmailcom', 5),
	(3, 1, 'samarasekaraganga4@gmailcom', 4),
	(6, 1, 'chathuriw222@gmail.com', 1),
	(7, 1, 'chathuriw222@gmail.com', 2),
	(8, 2, 'oshadiudapitiya@gmail.com', 4),
	(10, 1, 'oshadiudapitiya@gmail.com', 5),
	(12, 1, 'oshadiudapitiya@gmail.com', 10),
	(13, 1, 'oshadiudapitiya@gmail.com', 15),
	(14, 1, 'oshadiudapitiya@gmail.com', 20),
	(15, 1, 'oshadiudapitiya@gmail.com', 2),
	(16, 2, 'chathuriw222@gmail.com', 29);

-- Dumping structure for table glee.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.category: ~5 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'watches'),
	(2, 'ringes'),
	(3, 'neckless'),
	(4, 'braslets'),
	(5, 'earrings');

-- Dumping structure for table glee.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `chat_id` int NOT NULL AUTO_INCREMENT,
  `content` text,
  `date_time` datetime DEFAULT NULL,
  `status` int DEFAULT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `fk_chat_user1_idx` (`from`),
  KEY `fk_chat_user2_idx` (`to`),
  CONSTRAINT `fk_chat_user1` FOREIGN KEY (`from`) REFERENCES `user` (`email`),
  CONSTRAINT `fk_chat_user2` FOREIGN KEY (`to`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.chat: ~4 rows (approximately)
INSERT INTO `chat` (`chat_id`, `content`, `date_time`, `status`, `from`, `to`) VALUES
	(1, 'hi', '2024-06-07 21:10:14', 0, 'oshadiudapitiya@gmail.com', 'chathuriw222@gmail.com'),
	(2, 'good morning', '2024-06-07 21:20:58', 0, 'oshadiudapitiya@gmail.com', 'chathuriw222@gmail.com'),
	(3, 'hi', '2024-06-08 08:54:19', 0, 'oshadiudapitiya@gmail.com', 'chathuriw222@gmail.com'),
	(4, 'hi', '2024-06-08 08:54:49', 0, 'chathuriw222@gmail.com', 'chathuriw222@gmail.com');

-- Dumping structure for table glee.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.city: ~8 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Colombo', 4),
	(2, 'Sri Jawardanapura', 4),
	(3, 'Negombo', 5),
	(4, 'Wattala', 5),
	(5, 'Panadura', 6),
	(6, 'Beruwala', 6),
	(7, 'Pilimathalawa', 1),
	(8, 'Peradeniya', 1);

-- Dumping structure for table glee.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.color: ~6 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(1, 'Silver'),
	(2, 'Gold'),
	(3, 'Black'),
	(4, 'Rose-Gold'),
	(5, 'Pink'),
	(6, 'Green'),
	(7, 'white'),
	(8, 'other');

-- Dumping structure for table glee.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.condition: ~2 rows (approximately)
INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
	(1, 'hand made'),
	(2, 'import');

-- Dumping structure for table glee.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.district: ~5 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Kandy', 1),
	(2, 'Nuwara Elliya', 1),
	(3, 'Mathale', 1),
	(4, 'colombo', 9),
	(5, 'Gampaha', 9),
	(6, 'Kaluthara', 9);

-- Dumping structure for table glee.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `feed` varchar(250) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.feedback: ~0 rows (approximately)

-- Dumping structure for table glee.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.gender: ~2 rows (approximately)
INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table glee.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.invoice: ~6 rows (approximately)
INSERT INTO `invoice` (`invoice_id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(1, '666316ce194a0', '2024-06-01 19:49:51', 950, 1, 4, 6, 'chathuriw222@gmail.com'),
	(2, '66632ffc9bad5', '2024-06-07 21:38:56', 8450, 11, 4, 6, 'chathuriw222@gmail.com'),
	(3, '66635ad7baf66', '2024-06-08 00:40:28', 3400, 1, 1, 5, 'oshadiudapitiya@gmail.com'),
	(4, '666384bfa411f', '2024-06-08 03:38:58', 1200, 1, 0, 10, 'oshadiudapitiya@gmail.com'),
	(5, '6663d3c966400', '2024-06-08 09:16:04', 950, 1, 0, 6, 'chathuriw222@gmail.com'),
	(6, '6663d7d0abb28', '2024-06-08 09:32:59', 2200, 2, 0, 1, 'chathuriw222@gmail.com');

-- Dumping structure for table glee.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `condition_condition_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_condition1_idx` (`condition_condition_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.product: ~31 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `condition_condition_id`, `status_status_id`, `user_email`) VALUES
	(1, 1000, 8, 'Original Branded SK Shengke K0106 Ladies Watch with Warranty for Best Price', 'SK Shengk,Watch|Women', '2024-06-07 11:44:35', 100, 200, 1, 1, 2, 'chathuriw222@gmail.com'),
	(2, 1750, 5, 'Luxury Watches for women LuminousbRetro Female watch ladies Belt Black Light Leather strap Quartz wristwatches Montre Femme ', 'LuminousbRetro Female watch', '2024-06-07 11:45:49', 100, 200, 1, 1, 1, 'chathuriw222@gmail.com'),
	(3, 2400, 20, 'LuminousbRetro Female watch', 'White Leather Quartz,Watch|Women', '2024-06-07 11:46:43', 100, 200, 1, 1, 1, 'chathuriw222@gmail.com'),
	(4, 1525, 18, 'High Quality Women Watch Leather Strap Quartz Watches Ladies Casual Wristwatches Clock Gift Reloj Mujer', 'Leather Strap Quartz ,Watch|Women', '2024-06-07 11:47:27', 100, 200, 1, 1, 1, 'chathuriw222@gmail.com'),
	(5, 3200, 11, 'Leather Strap Quartz ,Watch|Women', 'Casual Quartz,Watch|Women', '2024-06-07 11:48:29', 100, 200, 1, 1, 1, 'chathuriw222@gmail.com'),
	(6, 750, -1, 'Original Branded SK Shengke K0106 Ladies Watch with Warranty for Best Price', 'Round Ladies Womens Watches', '2024-06-07 11:49:23', 100, 200, 1, 2, 1, 'chathuriw222@gmail.com'),
	(7, 800, 5, 'Huitan Exquisite Silver Color Ring with White Cubic Zirconia Fashion Versatile Accessories for Women High Quality New Jewelry', 'ilver Color HUITAN Ring with White Cubic |Women', '2024-06-07 12:00:58', 100, 200, 2, 2, 1, 'samarasekaraganga4@gmailcom'),
	(8, 2500, 4, 'Huitan Newest Fresh Two Tone X Shape Cross Ring for Women Wedding Trendy Jewelry Dazzling CZ Stone Large Modern Rings Anillos', 'Two Tone X Shape Cross Ring |Women', '2024-06-07 12:01:36', 100, 200, 2, 2, 1, 'samarasekaraganga4@gmailcom'),
	(9, 5200, 15, 'Viking Celtic Knot Rune Rings For Men Rotating Stainless Steel Anti Stress Anxiety Relife Spinning Ring Anillo Antiestres', 'Viking Celtic Knot Rune Ring|Men', '2024-06-07 12:02:18', 100, 200, 2, 2, 1, 'samarasekaraganga4@gmailcom'),
	(10, 1000, 7, 'Trendy 925 Sterling Silver Ring For Men Jewelry Black Rectangle Retro Dragon Pattern Ring Male Infex Finger Accessories Open', 'Sterling Silver Ring|Men', '2024-06-07 12:03:25', 100, 200, 2, 2, 1, 'samarasekaraganga4@gmailcom'),
	(11, 1500, 20, 'Huitan 2020 NEW Fashion Wedding Ring For Women Micro Paved Cubiz Zircon Finger Rings Female Engagement Jewelry Accessories', 'Cubiz Zircon Finger Wedding Ring|Women', '2024-06-07 12:05:01', 100, 200, 2, 2, 1, 'samarasekaraganga4@gmailcom'),
	(13, 800, 10, 'Lats New Shiny Butterfly Necklace Exquisite Double Layer Clavicle Chain Jewelry For Ladies Gift', 'Double Layer Butterfly Necklace|Women', '2024-06-07 12:07:56', 100, 200, 3, 2, 1, 'chathuriw222@gmail.com'),
	(14, 2500, 12, '2022 Classic Fashion Ladies Love Clover Pendant Necklace Exquisite Micro-Inlaid Lucky Jewelry Girls Anniversary Wedding Gift', 'Gold color Pendant Necklace|Women', '2024-06-07 12:08:38', 100, 200, 3, 2, 1, 'chathuriw222@gmail.com'),
	(15, 3500, 5, 'XIYANIKE 316L Stainless Steel Gold Color Love Heart Necklaces For Women Chokers 2021Trend Fashion Festival Party Gift Jewelry', 'Stainless Steel Gold Color Love Heart Necklaces|women', '2024-06-07 12:09:28', 100, 200, 3, 2, 1, 'chathuriw222@gmail.com'),
	(16, 2450, 15, 'Fashion Personality Military Tag Glossy Rectangle Stainless Steel Pendant Necklaces for Men Trend Punk Simplicity Jewelry', 'Military Tag Glossy Rectangle Stainless Steel Pendant Necklace|Men', '2024-06-07 12:10:07', 100, 200, 3, 2, 1, 'chathuriw222@gmail.com'),
	(17, 2000, 2, 'Never Fade Tatinium 5mm Figaro Chain For Men Women Girl Hip Hop Stainless Steel Jewelry Street Cool Necklace', 'Figaro Chain|men', '2024-06-07 12:10:44', 100, 200, 3, 2, 1, 'chathuriw222@gmail.com'),
	(18, 900, 9, 'Fashion Butterfly Drop Earrings For Women Trendy Shiny Small Fresh Dangle Earring Korean Exquisite Jewelry Party Girlfriend Gift', 'White Butterfly Drop Earring|Women', '2024-06-07 12:12:12', 100, 200, 5, 2, 1, 'chathuriw222@gmail.com'),
	(19, 7500, 42, 'Fashion Butterfly Drop Earrings For Women Trendy Shiny Small Fresh Dangle Earring Korean Exquisite Jewelry Party Girlfriend Gift', 'Red Butterfly Drop Earring|Women', '2024-06-07 12:12:51', 100, 200, 5, 2, 1, 'chathuriw222@gmail.com'),
	(20, 900, 20, 'Fashion Butterfly Drop Earrings For Women Trendy Shiny Small Fresh Dangle Earring Korean Exquisite Jewelry Party Girlfriend Gift', 'Pink Butterfly Drop Earring|Women', '2024-06-07 12:13:42', 100, 200, 5, 2, 1, 'chathuriw222@gmail.com'),
	(21, 1000, 20, '1~10piar Fashion Cross Stud Earrings For Women Girls Korean Style Elegant Crystal Jewelry Ear Rings Fishtail Lady Earrings Gift', 'Cross Stud Earring|Women', '2024-06-07 12:14:15', 100, 200, 5, 2, 1, 'chathuriw222@gmail.com'),
	(22, 500, 12, '2023 New Fashion Trend Zircon Crystal Black Leaf Pendant Earrings for Women Unique Design Temperament Cool Girls Party Jewelry', 'Trend Zircon Crystal Black Leaf Pendant Earring|Women', '2024-06-07 12:14:48', 100, 200, 5, 1, 1, 'chathuriw222@gmail.com'),
	(23, 1500, 20, 'Adjustable New Design Gold Plated Stainless Steel 316L Plant Flower Bracelet With Five Leaf Petals Women\'s Luxury Gifts Clover', 'Black Plant Flower Bracelet|Women', '2024-06-07 12:16:22', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(24, 800, 5, 'Adjustable New Design Gold Plated Stainless Steel 316L Plant Flower Bracelet With Five Leaf Petals Women\'s Luxury Gifts Clover', 'Greeen Plant Flower Bracelet|Women', '2024-06-07 12:16:53', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(25, 1000, 33, 'Adjustable New Design Gold Plated Stainless Steel 316L Plant Flower Bracelet With Five Leaf Petals Women\'s Luxury Gifts Clover', 'White Plant Flower Bracelet|Women', '2024-06-07 12:17:31', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(26, 2000, 25, 'Fashion Stainless Steel Men Curb Cuban Chain Bracelet Women Bracelet On Hand For Couple Unisex Wrist Hand Jewelry Gift Party', 'Stainless Steel Men Curb Cuban Chain Bracelet', '2024-06-07 12:18:01', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(27, 900, 10, 'ZAKOL Fashion Zirconia Leaf Adjustable Bracelets For Women Pulseras Mujer Wedding Crystal Bracelet Charm Party Jewelry BP1009', 'Zirconia Leaf Adjustable Bracelet|Women', '2024-06-07 12:18:43', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(28, 5200, 42, 'Adjustable New Design Gold Plated Stainless Steel 316L Plant Flower Bracelet With Five Leaf Petals Women\'s Luxury Gifts Clover', 'Gold Plated Stainless Steel 316L Plant Flower Bracelet', '2024-06-07 12:19:26', 100, 200, 4, 1, 1, 'chathuriw222@gmail.com'),
	(29, 1211, 7, 'Luxury Watches for women LuminousbRetro Female watch ladies Belt Black Light Leather strap Quartz wristwatches Montre Femme ', 'Casual Quartz,Watch|Women', '2024-06-07 13:20:18', 100, 200, 1, 1, 1, 'samarasekaraganga4@gmailcom'),
	(30, 900, 10, 'Huitan Exquisite Silver Color Ring with White Cubic Zirconia Fashion Versatile Accessories for Women High Quality New Jewelry', 'Two Tone X Shape Cross Ring |Women', '2024-06-08 09:04:18', 100, 200, 5, 2, 1, 'chathuriw222@gmail.com'),
	(31, 1200, 13, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aa', '2024-06-09 19:44:50', 100, 200, 1, 1, 1, 'chathuriw222@gmail.com'),
	(32, 1000, 14, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aa', '2024-06-09 19:48:36', 100, 200, 2, 1, 1, 'chathuriw222@gmail.com');

-- Dumping structure for table glee.product_has_color
CREATE TABLE IF NOT EXISTS `product_has_color` (
  `color_clr_id` int NOT NULL,
  `product_id` int NOT NULL,
  KEY `fk_color_has_product1_product1_idx` (`product_id`),
  KEY `fk_color_has_product1_color1_idx` (`color_clr_id`),
  CONSTRAINT `fk_color_has_product1_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_color_has_product1_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.product_has_color: ~29 rows (approximately)
INSERT INTO `product_has_color` (`color_clr_id`, `product_id`) VALUES
	(7, 1),
	(7, 2),
	(6, 3),
	(5, 4),
	(7, 5),
	(1, 7),
	(3, 6),
	(1, 8),
	(1, 10),
	(1, 11),
	(1, 14),
	(1, 15),
	(1, 16),
	(1, 17),
	(1, 18),
	(1, 19),
	(1, 20),
	(1, 21),
	(1, 22),
	(1, 24),
	(1, 25),
	(1, 26),
	(1, 27),
	(1, 28),
	(1, 29),
	(1, 13),
	(1, 1),
	(1, 1),
	(1, 1);

-- Dumping structure for table glee.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT '',
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`img_path`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.product_img: ~93 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('resource//images//1_0_6662a54bc8a1f.jpeg', 1),
	('resource//images//1_1_6662a54bcd7da.jpeg', 1),
	('resource//images//1_2_6662a54bd3796.jpeg', 1),
	('resource//images//2_0_6662a59580b3a.jpeg', 2),
	('resource//images//2_1_6662a595b416b.jpeg', 2),
	('resource//images//2_2_6662a595d47ee.jpeg', 2),
	('resource//images//3_0_6662a5cc00ee3.jpeg', 3),
	('resource//images//3_1_6662a5cc08496.jpeg', 3),
	('resource//images//3_2_6662a5cc13a3b.jpeg', 3),
	('resource//images//4_0_6662a5f8149e1.jpeg', 4),
	('resource//images//4_1_6662a5f81f608.jpeg', 4),
	('resource//images//4_2_6662a5f824377.jpeg', 4),
	('resource//images//5_0_6662a6361b18a.jpeg', 5),
	('resource//images//5_1_6662a636234b2.jpeg', 5),
	('resource//images//5_2_6662a6362dcb4.jpeg', 5),
	('resource/images/6_0_6662a6bcba954.jpeg', 6),
	('resource/images/6_1_6662a6bcc0d04.jpeg', 6),
	('resource/images/6_2_6662a6bccb80c.jpeg', 6),
	('resource//images//1_0_6662a922bf641.png', 7),
	('resource//images//1_1_6662a922c447b.png', 7),
	('resource//images//1_2_6662a922cf1cd.png', 7),
	('resource//images//2_0_6662a948f0eb4.png', 8),
	('resource//images//2_1_6662a9490ff13.png', 8),
	('resource//images//2_2_6662a949330d9.png', 8),
	('resource//images//3_0_6662a972ee4a1.png', 9),
	('resource//images//3_1_6662a9730512c.png', 9),
	('resource//images//3_2_6662a9736bd0a.png', 9),
	('resource//images//4_0_6662a9b56e94e.png', 10),
	('resource//images//4_1_6662a9b57c01d.png', 10),
	('resource//images//4_2_6662a9b5899c8.png', 10),
	('resource/images/5_0_6662b2b660a45.png', 11),
	('resource/images/5_1_6662b2b691e8d.png', 11),
	('resource/images/5_2_6662b2b6ab540.png', 11),
	('resource//images//1_0_6662aac4e13f0.png', 13),
	('resource//images//1_1_6662aac4e9cc5.png', 13),
	('resource//images//1_2_6662aac50e637.png', 13),
	('resource//images//2_0_6662aaeec43fa.png', 14),
	('resource//images//2_1_6662aaeed6dd6.png', 14),
	('resource//images//2_2_6662aaeee1c89.png', 14),
	('resource//images//3_0_6662ab20536dc.png', 15),
	('resource//images//3_1_6662ab20585b4.png', 15),
	('resource//images//3_2_6662ab20663eb.png', 15),
	('resource//images//4_0_6662ab478c37c.png', 16),
	('resource//images//4_1_6662ab47942e4.png', 16),
	('resource//images//4_2_6662ab47a1ca5.png', 16),
	('resource//images//5_0_6662ab6c6d038.png', 17),
	('resource//images//5_1_6662ab6c7598e.png', 17),
	('resource//images//5_2_6662ab6c85a26.png', 17),
	('resource/images/1_0_6662b2e0e2f69.png', 18),
	('resource/images/1_1_6662b2e0eb814.png', 18),
	('resource/images/1_2_6662b2e1046b2.png', 18),
	('resource//images//2_0_6662abebde08f.png', 19),
	('resource//images//2_1_6662abec0a560.png', 19),
	('resource//images//2_2_6662abec2acd0.png', 19),
	('resource//images//3_0_6662ac1e8fa06.png', 20),
	('resource//images//3_1_6662ac1e97586.png', 20),
	('resource//images//3_2_6662ac1ea53b6.png', 20),
	('resource//images//4_0_6662ac3feb84e.png', 21),
	('resource//images//4_1_6662ac40023ed.png', 21),
	('resource//images//4_2_6662ac40124fd.png', 21),
	('resource//images//5_0_6662ac60a4caf.png', 22),
	('resource//images//5_1_6662ac60aa922.png', 22),
	('resource//images//5_2_6662ac60b9473.png', 22),
	('resource//images//1_0_6662acbee5165.png', 23),
	('resource//images//1_1_6662acbef00d8.png', 23),
	('resource//images//1_2_6662acbf37474.png', 23),
	('resource//images//2_0_6662acdde6f58.png', 24),
	('resource//images//2_1_6662acddf1e0f.png', 24),
	('resource//images//2_2_6662acde0ddc2.png', 24),
	('resource//images//3_0_6662ad03df41b.png', 25),
	('resource//images//3_1_6662ad03e5315.png', 25),
	('resource//images//3_2_6662ad03f2941.png', 25),
	('resource//images//3_0_6662ad2206953.png', 26),
	('resource//images//3_1_6662ad220b8cd.png', 26),
	('resource//images//3_2_6662ad221198b.png', 26),
	('resource//images//4_0_6662ad4b76285.png', 27),
	('resource//images//4_1_6662ad4b811b0.png', 27),
	('resource//images//4_2_6662ad4b860b5.png', 27),
	('resource//images//5_0_6662ad76e9a80.png', 28),
	('resource//images//5_1_6662ad77002ab.png', 28),
	('resource//images//5_2_6662ad770dcc4.png', 28),
	('resource//images//aa_0_6662bbbaa8aff.jpeg', 29),
	('resource//images//aa_1_6662bbbac275f.jpeg', 29),
	('resource//images//aa_2_6662bbbad5631.jpeg', 29),
	('resource//images//Two Tone X Shape Cross Ring |Women_0_6663d13a94864.png', 30),
	('resource//images//Two Tone X Shape Cross Ring |Women_1_6663d13aaf725.png', 30),
	('resource//images//Two Tone X Shape Cross Ring |Women_2_6663d13aba821.png', 30),
	('resource//images//aa_0_6665b8db255a3.jpeg', 31),
	('resource//images//aa_1_6665b8db50b4b.jpeg', 31),
	('resource//images//aa_2_6665b8db5d6cc.jpeg', 31),
	('resource//images//aa_0_6665b9bd1095d.png', 32),
	('resource//images//aa_1_6665b9bd65332.png', 32),
	('resource//images//aa_2_6665b9bd9877a.png', 32);

-- Dumping structure for table glee.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.profile_img: ~5 rows (approximately)
INSERT INTO `profile_img` (`path`, `user_email`) VALUES
	('resource//profile_images//chathuri _6663d829f0b32.jpeg', 'chathuriw222@gmail.com'),
	('resource//profile_images//lasantha_6662aecb8bbdf.png', 'lasanthapradeep@gmail.com'),
	('resource//profile_images//oshadi_6663cdeb5df1c.png', 'oshadiudapitiya@gmail.com'),
	('resource//profile_images//rashmi_6662b09f17491.png', 'rashminiru@gmail.com'),
	('resource//profile_images//sahan_6662b000df3d0.png', 'sahan@gmailcom');

-- Dumping structure for table glee.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.province: ~9 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Central Province'),
	(2, 'Eastern Province'),
	(3, 'Northern Province'),
	(4, 'North Central Province'),
	(5, 'North Western Province'),
	(6, 'Sabaragamuwa Province'),
	(7, 'Southern Province'),
	(8, 'Uva Province'),
	(9, 'Western Province');

-- Dumping structure for table glee.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.recent: ~11 rows (approximately)
INSERT INTO `recent` (`r_id`, `product_id`, `user_email`) VALUES
	(1, 3, 'chathuriw222@gmail.com'),
	(2, 3, 'chathuriw222@gmail.com'),
	(3, 5, 'chathuriw222@gmail.com'),
	(4, 2, 'chathuriw222@gmail.com'),
	(5, 29, 'chathuriw222@gmail.com'),
	(6, 5, 'chathuriw222@gmail.com'),
	(7, 6, 'chathuriw222@gmail.com'),
	(8, 29, 'chathuriw222@gmail.com'),
	(9, 28, 'oshadiudapitiya@gmail.com'),
	(10, 4, 'oshadiudapitiya@gmail.com'),
	(11, 13, 'oshadiudapitiya@gmail.com');

-- Dumping structure for table glee.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Inactive');

-- Dumping structure for table glee.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `power` varchar(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '1',
  `gender_gender_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  KEY `gender_gender_id` (`gender_gender_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_gender_id`) REFERENCES `gender` (`gender_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.user: ~13 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `power`, `gender_gender_id`, `status_status_id`) VALUES
	('chathuri ', 'wasundara', 'chathuriw222@gmail.com', 'CHATHURI123', '0719283302', '2024-06-07 04:49:27', '6663d6e58aae7', '0', 2, 1),
	('JAYAMINI', 'RAJAPAKSHA', 'JAYAMINI@GMAIL.COM', 'JAYAMINI123', '0719856330', '2024-06-08 09:27:25', NULL, '1', 2, 1),
	('udeshi', 'hewage', 'kudeshihewage00@gmail.com', 'udeshi123', '0786662356', '2024-06-07 04:57:21', NULL, '0', 2, 1),
	('lasantha', 'pradeep', 'lasanthapradeep@gmail.com', 'lasantha123', '0719863333', '2024-06-07 12:23:41', NULL, '1', 1, 2),
	('malika', 'daias', 'malikadias@gmail.com', 'malika123', '0713586645', '2024-06-07 16:34:20', NULL, '1', 2, 1),
	('oshadi', 'udapitiya', 'oshadiudapitiya@gmail.com', 'oshadi123', '0715550023', '2024-06-07 12:33:57', '6662ee4d30133', '1', 2, 1),
	('ransi', 'udapitiya', 'ransi@gmail.com', 'ransi123', '0715552365', '2024-06-08 08:42:42', '6663cc8b7dd38', '1', 2, 1),
	('rashmi', 'nirukshi', 'rashminiru@gmail.com', 'rashmi123', '0773529988', '2024-06-07 12:31:15', NULL, '1', 2, 1),
	('sandali', 'darshika', 'sachiwarkonly@gmail.com', 'sachi123', '0719568822', '2024-06-07 04:51:33', NULL, '0', 2, 1),
	('sahan', 'perera', 'sahan@gmailcom', 'sahan123', '0719853304', '2024-06-07 12:21:09', NULL, '1', 1, 1),
	('ganga', 'nilmini', 'samarasekaraganga4@gmail.com', 'ganga123', '0745855502', '2024-06-07 13:40:00', NULL, '0', 1, 1),
	('nuwanya', 'sekara', 'samarasekaraganga4@gmailcom', 'ganga123', '0772356644', '2024-06-07 04:52:52', NULL, '0', 2, 1),
	('tharaka', 'jayaweera', 'tharakajayaweera2003@gmailcom', 'tharaka123', '0219283342', '2024-06-07 04:57:39', NULL, '0', 2, 1);

-- Dumping structure for table glee.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_city1_idx` (`city_city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.user_has_address: ~9 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_city_id`, `address_id`, `line1`, `line2`, `postal_code`) VALUES
	('chathuriw222@gmail.com', 1, 1, 'malgammana', 'pilimathalawa', ''),
	('samarasekaraganga4@gmailcom', 1, 2, 'peradeniya', 'kandy', NULL),
	('sachiwarkonly@gmail.com', 3, 3, 'peradeniya', 'mulgampala', NULL),
	('tharakajayaweera2003@gmailcom', 2, 4, 'jayawardanapura', 'cotte', NULL),
	('kudeshihewage00@gmail.com', 4, 5, 'pitiyegedara', 'waththegama', NULL),
	('lasanthapradeep@gmail.com', 3, 6, 'rabukkana', 'kurunagala', ''),
	('sahan@gmailcom', 7, 7, 'gadaladeniya', 'danthure', ''),
	('rashminiru@gmail.com', 7, 8, 'urapola', 'kadugannawa', ''),
	('oshadiudapitiya@gmail.com', 7, 9, '24A', 'giragama', '');

-- Dumping structure for table glee.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`w_id`) USING BTREE,
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table glee.watchlist: ~8 rows (approximately)
INSERT INTO `watchlist` (`w_id`, `user_email`, `product_id`) VALUES
	(37, 'chathuriw222@gmail.com', 5),
	(38, 'chathuriw222@gmail.com', 6),
	(39, 'chathuriw222@gmail.com', 29),
	(40, 'chathuriw222@gmail.com', 2),
	(41, 'oshadiudapitiya@gmail.com', 5),
	(42, 'oshadiudapitiya@gmail.com', 9),
	(43, 'oshadiudapitiya@gmail.com', 26),
	(47, 'oshadiudapitiya@gmail.com', 16);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
