# ************************************************************
# Sequel Ace SQL dump
# Version 20044
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 8.0.33)
# Database: products
# Generation Time: 2023-07-11 16:00:39 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `info`;

CREATE TABLE `info` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sizemb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heightcm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `widthcm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lengthcm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weightkg` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `switcher` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `info` WRITE;
/*!40000 ALTER TABLE `info` DISABLE KEYS */;

INSERT INTO `info` (`id`, `sku`, `name`, `price`, `sizemb`, `heightcm`, `widthcm`, `lengthcm`, `weightkg`, `switcher`)
VALUES
	(15,'123','123','123','123','','','','','dvd');

/*!40000 ALTER TABLE `info` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
