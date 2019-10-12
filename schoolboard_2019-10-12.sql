# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.25)
# Database: schoolboard
# Generation Time: 2019-10-12 21:44:30 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table board
# ------------------------------------------------------------

DROP TABLE IF EXISTS `board`;

CREATE TABLE `board` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `which` varchar(11) DEFAULT NULL,
  `return_type` enum('xml','json') NOT NULL DEFAULT 'json',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `board` WRITE;
/*!40000 ALTER TABLE `board` DISABLE KEYS */;

INSERT INTO `board` (`id`, `which`, `return_type`)
VALUES
	(1,'CSM','json'),
	(2,'CSMB','xml');

/*!40000 ALTER TABLE `board` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table grades
# ------------------------------------------------------------

DROP TABLE IF EXISTS `grades`;

CREATE TABLE `grades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` int(11) DEFAULT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  `subject_name` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;

INSERT INTO `grades` (`id`, `student_id`, `grade`, `subject_name`)
VALUES
	(1,2,8,'Matematika'),
	(2,2,7,'Engleski'),
	(3,2,5,'Biologija'),
	(4,2,8,'Sociologija'),
	(5,1,8,'Sociologija'),
	(6,1,8,'Matematika'),
	(7,1,5,'Biologija');

/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table student
# ------------------------------------------------------------

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `surname` varchar(256) DEFAULT NULL,
  `board_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;

INSERT INTO `student` (`id`, `name`, `surname`, `board_id`)
VALUES
	(1,'Nikola','Nikolic',1),
	(2,'Pera','Peric',2),
	(3,'Milan','Milanovic',2),
	(4,'Dušanka','Dusankic',2),
	(5,'Jelena','Jelenic',2);

/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
