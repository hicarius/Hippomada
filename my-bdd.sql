/*
SQLyog Community Edition- MySQL GUI v7.02 
MySQL - 5.5.5-10.1.9-MariaDB : Database - sovaly
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`sovaly` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sovaly`;

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `config_key` varchar(100) DEFAULT NULL,
  `config_value` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `config` */

insert  into `config`(`id`,`config_key`,`config_value`) values (1,'current_mounth','5'),(2,'current_year','2016'),(3,'next_race_date','2016-06-09');

/*Table structure for table `gain_race_horse` */

DROP TABLE IF EXISTS `gain_race_horse`;

CREATE TABLE `gain_race_horse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `carrer_race` int(11) DEFAULT '0',
  `carrer_win` int(11) DEFAULT '0',
  `carrer_placed` int(11) DEFAULT '0',
  `carrer_gain` int(11) DEFAULT '0',
  `year_race` int(11) DEFAULT '0',
  `year_win` int(11) DEFAULT '0',
  `year_placed` int(11) DEFAULT '0',
  `year_gain` int(11) DEFAULT '0',
  `mounth_race` int(11) DEFAULT '0',
  `mounth_win` int(11) DEFAULT '0',
  `mounth_placed` int(11) DEFAULT '0',
  `mounth_gain` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `gain_race_horse` */

insert  into `gain_race_horse`(`id`,`horse_id`,`carrer_race`,`carrer_win`,`carrer_placed`,`carrer_gain`,`year_race`,`year_win`,`year_placed`,`year_gain`,`mounth_race`,`mounth_win`,`mounth_placed`,`mounth_gain`) values (1,1,0,0,0,0,0,0,0,0,0,0,0,0),(2,2,0,0,0,0,0,0,0,0,0,0,0,0),(3,3,0,0,0,0,0,0,0,0,0,0,0,0),(4,4,0,0,0,0,0,0,0,0,0,0,0,0),(5,5,0,0,0,0,0,0,0,0,0,0,0,0),(6,6,0,0,0,0,0,0,0,0,0,0,0,0),(7,7,0,0,0,0,0,0,0,0,0,0,0,0),(8,8,0,0,0,0,0,0,0,0,0,0,0,0),(9,9,0,0,0,0,0,0,0,0,0,0,0,0),(10,10,0,0,0,0,0,0,0,0,0,0,0,0),(11,11,0,0,0,0,0,0,0,0,0,0,0,0),(12,12,0,0,0,0,0,0,0,0,0,0,0,0),(13,13,1,1,1,2000,1,1,1,2000,1,1,1,2000),(14,14,1,0,1,1500,1,0,1,1500,1,0,1,1500),(15,15,1,0,1,1000,1,0,1,1000,1,0,1,1000),(16,16,1,1,0,25000,1,1,0,25000,1,1,0,25000),(17,17,3,0,2,10000,3,0,2,10000,3,0,2,10000),(18,18,3,1,2,11000,3,1,2,11000,3,1,2,11000),(19,19,0,0,0,0,0,0,0,0,0,0,0,0),(20,20,3,2,2,13000,3,2,2,13000,3,2,2,13000),(21,21,0,0,0,0,0,0,0,0,0,0,0,0),(22,22,0,0,0,0,0,0,0,0,0,0,0,0),(23,23,0,0,0,0,0,0,0,0,0,0,0,0),(24,24,0,0,0,0,0,0,0,0,0,0,0,0),(25,25,0,0,0,0,0,0,0,0,0,0,0,0),(26,26,0,0,0,0,0,0,0,0,0,0,0,0),(27,27,0,0,0,0,0,0,0,0,0,0,0,0),(28,28,0,0,0,0,0,0,0,0,0,0,0,0),(29,29,0,0,0,0,0,0,0,0,0,0,0,0),(30,30,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `gain_race_stable` */

DROP TABLE IF EXISTS `gain_race_stable`;

CREATE TABLE `gain_race_stable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stable_id` int(11) DEFAULT NULL,
  `carrer_race` int(11) DEFAULT '0',
  `carrer_win` int(11) DEFAULT '0',
  `carrer_placed` int(11) DEFAULT '0',
  `carrer_gain` int(11) DEFAULT '0',
  `year_race` int(11) DEFAULT '0',
  `year_win` int(11) DEFAULT '0',
  `year_placed` int(11) DEFAULT '0',
  `year_gain` int(11) DEFAULT '0',
  `mounth_race` int(11) DEFAULT '0',
  `mounth_win` int(11) DEFAULT '0',
  `mounth_placed` int(11) DEFAULT '0',
  `mounth_gain` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `gain_race_stable` */

insert  into `gain_race_stable`(`id`,`stable_id`,`carrer_race`,`carrer_win`,`carrer_placed`,`carrer_gain`,`year_race`,`year_win`,`year_placed`,`year_gain`,`mounth_race`,`mounth_win`,`mounth_placed`,`mounth_gain`) values (1,1,1,1,1,2000,1,1,1,2000,1,1,1,2000),(2,2,10,4,6,59000,10,4,6,59000,10,4,6,59000),(3,3,1,0,1,1000,1,0,1,1000,1,0,1,1000),(4,4,1,0,1,1500,1,0,1,1500,1,0,1,1500),(5,5,0,0,0,0,0,0,0,0,0,0,0,0),(6,6,0,0,0,0,0,0,0,0,0,0,0,0);

/*Table structure for table `horses` */

DROP TABLE IF EXISTS `horses`;

CREATE TABLE `horses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `proprio_id` int(11) DEFAULT NULL,
  `trainer_id` int(11) DEFAULT NULL,
  `eleveur_id` int(11) DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `robe` varchar(10) DEFAULT NULL,
  `sexe` varchar(1) DEFAULT NULL,
  `specialization` varchar(1) DEFAULT NULL,
  `corde` varchar(1) DEFAULT NULL,
  `gains` int(11) DEFAULT NULL,
  `origine` varchar(100) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `quality_production` int(11) DEFAULT NULL,
  `production_price` int(11) DEFAULT NULL,
  `evaluation_price` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `is_qualified` int(11) DEFAULT NULL,
  `is_system` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `horses` */

insert  into `horses`(`id`,`name`,`proprio_id`,`trainer_id`,`eleveur_id`,`father_id`,`mother_id`,`age`,`robe`,`sexe`,`specialization`,`corde`,`gains`,`origine`,`quality`,`quality_production`,`production_price`,`evaluation_price`,`price`,`status`,`type`,`is_qualified`,`is_system`) values (1,'General de poummeau',5,5,5,0,0,15,'blanc','M','T','D',3500000,'France/Europe',10,5,125000,0,125000,0,2,1,1),(2,'Cocktail jet',5,5,5,0,0,12,'azelan','M','T','G',1200000,'France/Europe',8,3,50000,0,50000,0,2,1,1),(3,'Insert gÃ©dÃ©',5,5,5,0,0,15,'azelan','M','T','G',2575000,'France/Europe',7,2,25000,0,25000,0,2,1,1),(4,'Quitus de mexique',5,5,5,0,0,22,'noir','M','T','D',3256000,'France/Europe',7,5,125000,0,125000,0,2,1,1),(5,'Aleged',5,5,5,0,0,17,'noir','M','G','G',1745000,'France/Europe',8,3,50000,0,50000,0,2,1,1),(6,'Dolce vita',3,3,3,2,0,7,'blanc','F','T','D',574000,'France/Europe',3,3,50000,0,50000,0,3,1,1),(7,'Belle Diva',3,3,3,4,0,9,'azelan','F','T','G',125000,'France/Europe',3,5,125000,0,125000,0,3,1,1),(8,'La FranÃ§aise',5,5,5,3,0,12,'azelan','F','T','D',85740,'France/Europe',6,2,25000,0,25000,0,3,1,1),(9,'Itiqu Vita',3,3,3,5,0,9,'noir','F','G','D',75000,'France/Europe',6,3,50000,0,50000,0,3,1,1),(10,'Ksar',5,5,5,0,0,23,'azelan','M','G','D',3967410,'France/Europe',9,5,125000,0,125000,0,2,1,1),(11,'NoName36178',1,1,1,10,9,2,'azelan','F','G','D',0,'France/Europe',6,5,0,35000,35000,1,0,0,0),(12,'NoName18919',3,3,3,1,6,7,'blanc','F','T','G',0,'France/Europe',8,5,0,100000,100000,1,0,1,0),(13,'NoName33312',1,1,1,2,7,3,'azelan','F','T','G',2000,'France/Europe',4,3,0,10000,10000,1,0,0,0),(14,'NoName51418',4,4,4,2,8,10,'azelan','M','T','G',1500,'France/Europe',4,0,0,10000,10000,1,0,0,0),(15,'NoName49074',3,3,3,1,7,9,'azelan','F','T','D',1000,'France/Europe',4,5,0,10000,10000,1,0,1,0),(16,'NoName72473',2,2,2,1,7,4,'blanc','M','T','D',25000,'France/Europe',6,0,0,35000,35000,1,0,1,0),(17,'NoName65372',2,2,2,1,7,4,'noir','F','T','G',10000,'France/Europe',5,5,0,15000,15000,1,0,1,0),(18,'NoName19660',2,2,2,1,7,6,'azelan','F','T','D',11000,'France/Europe',9,5,0,250000,250000,1,0,1,0),(19,'NoName5953',3,3,3,4,6,8,'noir','M','T','G',0,'France/Europe',4,0,0,10000,10000,1,0,1,0),(20,'NoName6718',2,2,2,4,6,6,'blanc','M','T','G',13000,'France/Europe',5,0,0,15000,15000,1,0,1,0),(21,'NoName86250',1,1,1,4,6,2,'noir','F','T','D',0,'France/Europe',7,5,0,75000,75000,1,0,0,0),(22,'NoName63235',3,3,3,4,6,9,'blanc','M','T','G',0,'France/Europe',3,0,0,5000,5000,1,0,1,0),(23,'NoName44278',1,1,1,1,6,2,'blanc','M','T','D',0,'France/Europe',5,0,0,15000,15000,1,0,0,0),(24,'NoName7459',2,2,2,1,6,5,'blanc','M','T','D',0,'France/Europe',6,0,0,35000,35000,1,0,0,0),(25,'NoName12474',2,2,2,1,6,4,'blanc','F','T','D',0,'France/Europe',7,5,0,75000,75000,1,0,0,0),(26,'NoName51263',3,3,3,1,6,8,'azelan','F','T','D',0,'France/Europe',6,5,0,35000,35000,1,0,0,0),(27,'NoName71893',3,3,3,1,6,9,'azelan','M','T','G',0,'France/Europe',4,0,0,10000,10000,1,0,0,0),(28,'NoName53830',3,3,3,1,6,7,'blanc','F','T','D',0,'France/Europe',5,5,0,15000,15000,1,0,0,0),(29,'NoName74680',4,4,4,1,6,10,'azelan','F','T','D',0,'France/Europe',5,5,0,15000,15000,1,0,0,0),(30,'NoName62787',3,3,3,1,6,8,'blanc','F','T','G',0,'France/Europe',2,5,0,2500,2500,1,0,0,0);

/*Table structure for table `horses_caracteristique` */

DROP TABLE IF EXISTS `horses_caracteristique`;

CREATE TABLE `horses_caracteristique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `itr` int(11) DEFAULT NULL,
  `itr_year` int(11) DEFAULT NULL,
  `btr` int(11) DEFAULT NULL,
  `trot_base` float(6,2) DEFAULT NULL,
  `trot_current` float(6,2) DEFAULT NULL,
  `trot_gene` int(11) DEFAULT NULL,
  `galop_base` float(6,2) DEFAULT NULL,
  `galop_current` float(6,2) DEFAULT NULL,
  `galop_gene` int(11) DEFAULT NULL,
  `endurance_base` float(6,2) DEFAULT NULL,
  `endurance_current` float(6,2) DEFAULT NULL,
  `endurance_gene` int(11) DEFAULT NULL,
  `vitesse_base` float(6,2) DEFAULT NULL,
  `vitesse_current` float(6,2) DEFAULT NULL,
  `vitesse_gene` int(11) DEFAULT NULL,
  `physique` int(11) DEFAULT NULL,
  `fatigue` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `horses_caracteristique` */

insert  into `horses_caracteristique`(`id`,`horse_id`,`itr`,`itr_year`,`btr`,`trot_base`,`trot_current`,`trot_gene`,`galop_base`,`galop_current`,`galop_gene`,`endurance_base`,`endurance_current`,`endurance_gene`,`vitesse_base`,`vitesse_current`,`vitesse_gene`,`physique`,`fatigue`) values (1,1,177,NULL,100,30.00,99.99,100,0.00,99.99,100,30.00,99.99,100,45.00,99.99,100,100,0),(2,2,162,NULL,60,25.00,0.00,73,0.00,0.00,0,25.00,0.00,87,43.00,0.00,81,100,0),(3,3,156,NULL,75,42.00,99.99,100,0.00,99.99,0,46.00,99.99,100,36.00,99.99,100,100,0),(4,4,172,NULL,66,43.00,0.00,84,0.00,0.00,0,53.00,0.00,97,37.00,0.00,81,100,0),(5,5,163,NULL,56,0.00,0.00,0,51.00,99.99,87,42.00,99.99,57,48.00,99.99,78,100,0),(6,6,162,NULL,62,24.00,0.00,85,0.00,0.00,0,19.00,0.00,75,28.00,0.00,88,100,0),(7,7,172,NULL,39,15.00,0.00,44,0.00,0.00,0,29.00,0.00,67,21.00,0.00,46,100,0),(8,8,156,NULL,56,32.00,0.00,73,0.00,0.00,0,41.00,0.00,86,34.00,0.00,65,100,0),(9,9,163,NULL,67,0.00,0.00,0,30.00,0.00,90,41.00,0.00,85,36.00,0.00,92,100,0),(10,10,171,NULL,65,0.00,0.00,0,50.00,0.00,85,56.00,0.00,92,51.00,0.00,83,100,0),(11,11,171,NULL,83,0.00,0.00,0,38.00,83.00,87,37.00,82.00,78,37.00,82.00,84,100,0),(12,12,177,NULL,88,21.00,99.99,86,0.00,0.00,33,60.00,99.99,87,60.00,100.49,90,80,20),(13,13,162,NULL,73,25.00,99.99,67,0.00,0.00,0,31.00,99.99,84,24.00,100.15,69,80,20),(14,14,1,NULL,85,25.00,100.49,82,0.00,0.00,0,29.00,99.99,91,23.00,99.99,82,80,20),(15,15,177,NULL,80,26.00,99.99,76,0.00,0.00,33,30.00,100.99,88,25.00,99.99,76,100,20),(16,16,1,NULL,80,37.00,99.99,76,0.00,0.00,33,41.00,100.31,88,36.00,99.99,76,100,20),(17,17,177,NULL,80,30.00,99.99,76,0.00,0.00,33,34.00,100.15,88,29.00,100.47,76,100,20),(18,18,177,NULL,80,52.00,99.99,76,0.00,0.00,33,56.00,101.99,88,51.00,99.99,76,100,20),(19,19,1,NULL,83,27.00,99.99,81,0.00,0.00,0,32.00,100.49,86,26.00,99.99,83,80,20),(20,20,1,NULL,83,31.00,100.49,81,0.00,0.00,0,36.00,100.49,86,30.00,100.99,83,100,20),(21,21,172,NULL,83,41.00,86.00,81,0.00,0.00,0,46.00,91.00,86,40.00,85.00,83,100,0),(22,22,1,NULL,83,21.00,99.99,81,0.00,0.00,0,26.00,100.49,86,20.00,99.99,83,80,20),(23,23,1,NULL,88,15.27,29.00,86,0.00,0.00,33,20.08,28.00,87,40.00,45.21,90,100,0),(24,24,1,NULL,88,22.92,42.92,86,0.00,0.00,33,19.08,39.08,87,41.34,41.00,90,100,0),(25,25,177,NULL,88,21.92,36.92,86,0.00,0.00,33,22.42,37.42,87,42.00,45.00,90,100,0),(26,26,177,NULL,88,21.92,44.67,86,0.00,0.00,33,17.42,40.17,87,41.00,45.55,90,100,0),(27,27,1,NULL,88,12.27,36.27,86,0.00,0.00,33,21.08,45.08,87,39.00,43.80,90,100,0),(28,28,177,NULL,88,22.92,21.00,86,0.00,0.00,33,15.42,45.42,87,40.00,46.00,90,100,0),(29,29,177,NULL,88,18.92,43.67,86,0.00,0.00,33,17.42,42.17,87,40.00,44.95,90,100,0),(30,30,177,NULL,88,16.92,39.67,86,0.00,0.00,33,9.42,32.17,87,37.00,41.55,90,100,0);

/*Table structure for table `horses_training` */

DROP TABLE IF EXISTS `horses_training`;

CREATE TABLE `horses_training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `training_trot` int(11) DEFAULT '0',
  `training_galop` int(11) DEFAULT '0',
  `training_endurance` int(11) DEFAULT '0',
  `training_vitesse` int(11) DEFAULT '0',
  `training_physique` int(11) DEFAULT '0',
  `training_fatigue` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Data for the table `horses_training` */

insert  into `horses_training`(`id`,`horse_id`,`training_trot`,`training_galop`,`training_endurance`,`training_vitesse`,`training_physique`,`training_fatigue`) values (1,1,0,0,0,0,0,0),(2,2,0,0,0,0,0,0),(3,3,0,0,0,0,0,0),(4,4,0,0,0,0,0,0),(5,5,0,0,0,0,0,0),(6,6,0,0,0,0,0,0),(7,7,0,0,0,0,0,0),(8,8,0,0,0,0,0,0),(9,9,0,0,0,0,0,0),(10,10,0,0,0,0,0,0),(11,11,0,2,2,2,2,0),(12,12,2,0,2,2,2,0),(13,13,2,0,2,2,2,0),(14,14,2,0,2,2,2,0),(15,15,2,0,2,2,2,0),(16,16,2,0,2,2,2,0),(17,17,2,0,2,2,0,0),(18,18,2,0,2,2,2,0),(19,19,2,0,2,2,2,0),(20,20,2,0,2,2,2,0),(21,21,2,0,2,2,2,0),(22,22,2,0,2,2,2,0),(23,23,2,0,2,2,2,0),(24,24,2,0,2,2,2,0),(25,25,2,0,2,2,2,0),(26,26,2,0,2,2,2,0),(27,27,2,0,2,2,2,0),(28,28,2,0,2,2,2,0),(29,29,2,0,2,2,2,0),(30,30,2,0,2,2,2,0);

/*Table structure for table `jockeys` */

DROP TABLE IF EXISTS `jockeys`;

CREATE TABLE `jockeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stable_id` int(11) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `progression` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jockeys` */

/*Table structure for table `proposition_jockey_race` */

DROP TABLE IF EXISTS `proposition_jockey_race`;

CREATE TABLE `proposition_jockey_race` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id` int(11) DEFAULT NULL,
  `jockey_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proposition_jockey_race` */

/*Table structure for table `race_category` */

DROP TABLE IF EXISTS `race_category`;

CREATE TABLE `race_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) DEFAULT NULL,
  `group_ids` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `race_category` */

insert  into `race_category`(`id`,`title`,`group_ids`) values (1,'A conditions','1,2,3,4,5'),(2,'A rÃ©clamer','5'),(3,'Qualif.','5'),(4,'Qualif. Jockey','5');

/*Table structure for table `race_group` */

DROP TABLE IF EXISTS `race_group`;

CREATE TABLE `race_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `race_group` */

insert  into `race_group`(`id`,`group_name`) values (1,'Groupe I'),(2,'Groupe II'),(3,'Groupe III'),(4,'Amateur'),(5,'Standard');

/*Table structure for table `race_hippodrome` */

DROP TABLE IF EXISTS `race_hippodrome`;

CREATE TABLE `race_hippodrome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `race_hippodrome` */

insert  into `race_hippodrome`(`id`,`title`,`code`) values (1,'Vincennes','a,m'),(2,'Caen','a,m'),(3,'Cagnes-sur-Mer','a,m'),(4,'Enghien','a,m'),(5,'Vichy','a,m'),(6,'Longchamp','p'),(7,'Chantilly','p'),(8,'Deauville','p'),(9,'Auteil','p');

/*Table structure for table `race_participant` */

DROP TABLE IF EXISTS `race_participant`;

CREATE TABLE `race_participant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `jockey_id` int(11) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `is_recul` int(11) DEFAULT NULL,
  `cote` int(11) DEFAULT NULL,
  `rang` int(11) DEFAULT NULL,
  `temps` varchar(50) DEFAULT NULL,
  `gain` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `resultat_string` text,
  `rk` varchar(50) DEFAULT NULL,
  `chrono` varchar(50) DEFAULT NULL,
  `race_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `race_participant` */

insert  into `race_participant`(`id`,`race_id`,`horse_id`,`jockey_id`,`numero`,`is_recul`,`cote`,`rang`,`temps`,`gain`,`status`,`resultat_string`,`rk`,`chrono`,`race_time`) values (1,1,17,NULL,1,NULL,NULL,2,NULL,1500,1,NULL,'0\'34.9','1\'09.8','69.828609557209'),(2,1,16,NULL,2,NULL,NULL,1,NULL,NULL,1,NULL,NULL,NULL,NULL),(3,1,20,NULL,3,NULL,NULL,1,NULL,2000,1,NULL,'0\'34.8','1\'09.7','69.693426361151'),(4,2,18,NULL,1,NULL,NULL,3,NULL,1000,1,NULL,'0\'35.1','1\'10.2','70.182552617419'),(5,2,12,NULL,2,NULL,NULL,3,NULL,NULL,1,NULL,NULL,NULL,NULL),(6,2,19,NULL,3,NULL,NULL,1,NULL,NULL,1,NULL,NULL,NULL,NULL),(7,3,22,NULL,1,NULL,NULL,2,NULL,NULL,1,NULL,NULL,NULL,NULL),(8,3,15,NULL,2,NULL,NULL,3,NULL,1000,1,NULL,'0\'35.0','1\'10.0','70.045996871279'),(9,4,17,NULL,1,NULL,NULL,2,NULL,1500,1,NULL,'0\'34.9','1\'09.8','69.828609557209'),(10,4,20,NULL,2,NULL,NULL,1,NULL,2000,1,NULL,'0\'34.8','1\'09.7','69.693426361151'),(11,4,16,NULL,3,NULL,NULL,1,NULL,9000,1,NULL,NULL,NULL,NULL),(12,5,18,NULL,1,NULL,NULL,3,NULL,1000,1,NULL,'0\'35.1','1\'10.2','70.182552617419'),(13,6,17,NULL,1,NULL,NULL,2,NULL,1500,1,'|100,3.4927854575937|200,6.9855709151874|300,10.478356372781|400,13.971141830375|500,17.463927287969|600,20.956712745562|700,24.449498203156|800,27.94228366075|900,31.435069118343|1000,34.927854575937|1100,38.420640033531|1200,41.913425491124|1300,45.406210948718|1400,48.898996406312|1500,52.391781863906|1600,55.884567321499|1700,59.377352779093|1800,62.870138236687|1900,66.36292369428|2000,69.855709151874','0\'34.9','1\' 09.9','69.855709151874'),(14,6,20,NULL,2,NULL,NULL,1,NULL,2000,1,'|100,3.4914304778605|200,6.9828609557209|300,10.474291433581|400,13.965721911442|500,17.457152389302|600,20.948582867163|700,24.440013345023|800,27.931443822884|900,31.422874300744|1000,34.914304778605|1100,38.405735256465|1200,41.897165734325|1300,45.388596212186|1400,48.880026690046|1500,52.371457167907|1600,55.862887645767|1700,59.354318123628|1800,62.845748601488|1900,66.337179079349|2000,69.828609557209','0\'34.9','1\' 09.8','69.828609557209'),(15,6,18,NULL,3,NULL,NULL,3,NULL,1000,1,'|100,3.5159820919312|200,7.0319641838624|300,10.547946275794|400,14.063928367725|500,17.579910459656|600,21.095892551587|700,24.611874643518|800,28.12785673545|900,31.643838827381|1000,35.159820919312|1100,38.675803011243|1200,42.191785103175|1300,45.707767195106|1400,49.223749287037|1500,52.739731378968|1600,56.255713470899|1700,59.771695562831|1800,63.287677654762|1900,66.803659746693|2000,70.319641838624','0\'35.2','1\' 10.3','70.319641838624');

/*Table structure for table `race_participant_tmp` */

DROP TABLE IF EXISTS `race_participant_tmp`;

CREATE TABLE `race_participant_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `race_tmp_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `jockey_id` int(11) DEFAULT NULL,
  `is_recul` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_participant_tmp` */

/*Table structure for table `race_piste` */

DROP TABLE IF EXISTS `race_piste`;

CREATE TABLE `race_piste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_piste` */

insert  into `race_piste`(`id`,`code`,`title`,`type`) values (1,'S','Sable','a,m,p'),(2,'C','CendrÃ©e','a'),(3,'H','Herbe','m,p');

/*Table structure for table `race_type` */

DROP TABLE IF EXISTS `race_type`;

CREATE TABLE `race_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_type` */

insert  into `race_type`(`id`,`code`,`title`) values (1,'m','MontÃ©'),(2,'a','AttelÃ©'),(3,'p','Plat');

/*Table structure for table `races` */

DROP TABLE IF EXISTS `races`;

CREATE TABLE `races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lenght` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `hippodrome_id` int(11) DEFAULT NULL,
  `piste_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `corde` varchar(2) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `recul_gain` int(11) DEFAULT NULL,
  `recul_meter` int(11) DEFAULT NULL,
  `max_gain` int(11) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `sexe` varchar(5) DEFAULT 'M,F',
  `victory_price` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `meeting` int(11) DEFAULT NULL,
  `race_number` int(11) DEFAULT NULL,
  `race_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `races` */

insert  into `races`(`id`,`category_id`,`name`,`lenght`,`type_id`,`hippodrome_id`,`piste_id`,`group_id`,`corde`,`price`,`recul_gain`,`recul_meter`,`max_gain`,`age_min`,`age_max`,`sexe`,`victory_price`,`status`,`created_at`,`meeting`,`race_number`,`race_date`) values (1,3,'Qualification A ',2000,1,1,1,5,'D',0,0,0,0,3,10,'M,F','',0,'2016-06-17 08:55:38',1,1,'2016-06-17 12:00:00'),(2,3,'Qualification B ',2000,1,1,1,5,'D',0,0,0,0,3,10,'M,F','',0,'2016-06-17 08:55:38',1,2,'2016-06-17 12:30:00'),(3,3,'Qualification C ',2000,1,1,1,5,'D',0,0,0,0,3,10,'M,F','',0,'2016-06-17 08:55:39',1,3,'2016-06-17 13:00:00'),(4,1,'Prix des Amoureux A ',2400,2,5,2,4,'G',250,0,0,0,4,6,'M,F','25000|9000|7000|5000|2500|1500',0,'2016-06-17 10:13:58',2,1,'2016-06-17 13:30:00'),(5,1,'Prix des Amoureux B ',2400,2,5,2,4,'G',250,0,0,0,4,6,'M,F','25000|9000|7000|5000|2500|1500',0,'2016-06-17 10:13:58',2,2,'2016-06-17 14:00:00'),(6,1,'Prix d\'Aztec',2400,2,2,1,5,'D',200,0,0,10000,3,6,'M,F','5000|2000|1500|1000|750|250',0,'2016-06-18 21:55:00',1,1,'2016-06-18 12:00:00');

/*Table structure for table `races_tmp` */

DROP TABLE IF EXISTS `races_tmp`;

CREATE TABLE `races_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meeting` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lenght` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `hippodrome_id` int(11) DEFAULT NULL,
  `piste_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `corde` varchar(2) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `recul_gain` int(11) DEFAULT NULL,
  `recul_meter` int(11) DEFAULT NULL,
  `max_gain` varchar(50) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `sexe` varchar(5) DEFAULT 'M,F',
  `victory_price` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `race_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `races_tmp` */

/*Table structure for table `saillies` */

DROP TABLE IF EXISTS `saillies`;

CREATE TABLE `saillies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stable_id` int(11) DEFAULT NULL,
  `horse_id` int(11) DEFAULT NULL,
  `mother_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `saillies` */

/*Table structure for table `stables` */

DROP TABLE IF EXISTS `stables`;

CREATE TABLE `stables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `country` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `continent` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `capital` int(11) DEFAULT NULL,
  `banque` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `stables` */

insert  into `stables`(`id`,`name`,`firstname`,`lastname`,`last_activity`,`country`,`continent`,`level`,`capital`,`banque`,`gold`,`email`,`password`) values (1,'Turfoland des 2/3 ans ','Benjamin','Gates','2016-06-17 11:07:09','France','Europe',3,300000,302000,5,'gates.benjamin@turfoland.com','e5672d625c2064615e69d21846cbda74'),(2,'Turfoland des 4/5/6 ans','Isaac','Iblou','2016-06-18 09:47:02','France','Europe',3,300000,357400,5,'iblou.isaac@turfoland.com','ff7824370af348209ad8474d488d6fc7'),(3,'Turfoland des 7/8/9 ans','Alexandre','Dupont','2016-06-17 02:00:03','France','Europe',3,300000,300620,5,'alex.dupont@turfoland.com','d43db12b94c641f769f66dbd62207492'),(4,'Turfoland des 10 ans','Pascal','Vozier','2016-06-08 09:06:46','France','Europe',3,300000,301500,5,'pascal.vozier@turfoland.com','bea14bb1a152167c9cdf0b4b580c7736'),(5,'Turfoland des Inactifs','Violette','Madison','2016-06-17 02:09:45','France','Europe',3,300000,300000,5,'madison.violette@turfoland.com','306fbc4f26ae3159c4f2292d30930eb4'),(6,'Maison Laffite','Alex','DuprÃ¨s','2016-06-17 08:48:40','France','Europe',0,300000,300000,5,'alex.dupres@turfoland.com','10a632cbbf80df92fb6b66671d6ac69d');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
