/*
SQLyog Community Edition- MySQL GUI v7.02 
MySQL - 5.5.5-10.1.13-MariaDB : Database - sovaly
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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `gain_race_horse` */

insert  into `gain_race_horse`(`id`,`horse_id`,`carrer_race`,`carrer_win`,`carrer_placed`,`carrer_gain`,`year_race`,`year_win`,`year_placed`,`year_gain`,`mounth_race`,`mounth_win`,`mounth_placed`,`mounth_gain`) values (1,1,0,0,0,0,0,0,0,0,0,0,0,0),(2,2,0,0,0,0,0,0,0,0,0,0,0,0),(3,3,0,0,0,0,0,0,0,0,0,0,0,0),(4,4,0,0,0,0,0,0,0,0,0,0,0,0),(5,5,0,0,0,0,0,0,0,0,0,0,0,0),(6,6,0,0,0,0,0,0,0,0,0,0,0,0),(7,7,0,0,0,0,0,0,0,0,0,0,0,0),(8,8,0,0,0,0,0,0,0,0,0,0,0,0),(9,9,0,0,0,0,0,0,0,0,0,0,0,0),(10,10,0,0,0,0,0,0,0,0,0,0,0,0),(11,11,0,0,0,0,0,0,0,0,0,0,0,0),(12,12,0,0,0,0,0,0,0,0,0,0,0,0),(13,13,0,0,0,0,0,0,0,0,0,0,0,0),(14,14,0,0,0,0,0,0,0,0,0,0,0,0),(15,15,0,0,0,0,0,0,0,0,0,0,0,0),(16,16,0,0,0,0,0,0,0,0,0,0,0,0),(17,17,0,0,0,0,0,0,0,0,0,0,0,0),(18,18,0,0,0,0,0,0,0,0,0,0,0,0),(19,19,0,0,0,0,0,0,0,0,0,0,0,0),(20,20,0,0,0,0,0,0,0,0,0,0,0,0),(21,21,0,0,0,0,0,0,0,0,0,0,0,0),(22,22,0,0,0,0,0,0,0,0,0,0,0,0);

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

insert  into `gain_race_stable`(`id`,`stable_id`,`carrer_race`,`carrer_win`,`carrer_placed`,`carrer_gain`,`year_race`,`year_win`,`year_placed`,`year_gain`,`mounth_race`,`mounth_win`,`mounth_placed`,`mounth_gain`) values (1,1,0,0,0,0,0,0,0,0,0,0,0,0),(2,2,0,0,0,0,0,0,0,0,0,0,0,0),(3,3,0,0,0,0,0,0,0,0,0,0,0,0),(4,4,0,0,0,0,0,0,0,0,0,0,0,0),(5,5,0,0,0,0,0,0,0,0,0,0,0,0),(6,6,0,0,0,0,0,0,0,0,0,0,0,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `horses` */

insert  into `horses`(`id`,`name`,`proprio_id`,`trainer_id`,`eleveur_id`,`father_id`,`mother_id`,`age`,`robe`,`sexe`,`specialization`,`corde`,`gains`,`origine`,`quality`,`quality_production`,`production_price`,`evaluation_price`,`price`,`status`,`type`,`is_qualified`,`is_system`) values (1,'General de poummeau',5,5,5,0,0,15,'blanc','M','T','D',3500000,'France/Europe',10,5,125000,0,125000,0,2,1,1),(2,'Cocktail jet',5,5,5,0,0,12,'azelan','M','T','G',1200000,'France/Europe',8,3,50000,0,50000,0,2,1,1),(3,'Insert gÃ©dÃ©',5,5,5,0,0,15,'azelan','M','T','G',2575000,'France/Europe',7,2,25000,0,25000,0,2,1,1),(4,'Quitus de mexique',5,5,5,0,0,22,'noir','M','T','D',3256000,'France/Europe',7,5,125000,0,125000,0,2,1,1),(5,'Aleged',5,5,5,0,0,17,'noir','M','G','G',1745000,'France/Europe',8,3,50000,0,50000,0,2,1,1),(6,'Dolce vita',3,3,3,2,0,7,'blanc','F','T','D',574000,'France/Europe',3,3,50000,0,50000,0,3,1,1),(7,'Belle Diva',3,3,3,4,0,9,'azelan','F','T','G',125000,'France/Europe',3,5,125000,0,125000,0,3,1,1),(8,'La FranÃ§aise',5,5,5,3,0,12,'azelan','F','T','D',85740,'France/Europe',6,2,25000,0,25000,0,3,1,1),(9,'Itiqu Vita',3,3,3,5,0,9,'noir','F','G','D',75000,'France/Europe',6,3,50000,0,50000,0,3,1,1),(10,'Ksar',5,5,5,0,0,23,'azelan','M','G','D',3967410,'France/Europe',9,5,125000,0,125000,0,2,1,1),(11,'NoName36178',1,1,1,10,9,2,'azelan','F','G','D',0,'France/Europe',6,5,0,35000,35000,1,0,0,0),(12,'NoName18919',3,3,3,1,6,7,'blanc','F','T','G',0,'France/Europe',8,5,0,100000,100000,1,0,0,0),(13,'NoName33312',1,1,1,2,7,3,'azelan','F','T','G',0,'France/Europe',4,3,0,10000,10000,1,0,0,0),(14,'NoName51418',4,4,4,2,8,10,'azelan','M','T','G',0,'France/Europe',4,0,0,10000,10000,1,0,0,0),(15,'NoName49074',3,3,3,1,7,9,'azelan','F','T','D',0,'France/Europe',4,5,0,10000,10000,1,0,0,0),(16,'NoName72473',2,2,2,1,7,4,'blanc','M','T','D',0,'France/Europe',6,0,0,35000,35000,1,0,0,0),(17,'NoName65372',2,2,2,1,7,4,'noir','F','T','G',0,'France/Europe',5,5,0,15000,15000,1,0,0,0),(18,'NoName19660',2,2,2,1,7,6,'azelan','F','T','D',0,'France/Europe',9,5,0,250000,250000,1,0,0,0),(19,'NoName5953',3,3,3,4,6,8,'noir','M','T','G',0,'France/Europe',4,0,0,10000,10000,1,0,0,0),(20,'NoName6718',2,2,2,4,6,6,'blanc','M','T','G',0,'France/Europe',5,0,0,15000,15000,1,0,0,0),(21,'NoName86250',1,1,1,4,6,2,'noir','F','T','D',0,'France/Europe',7,5,0,75000,75000,1,0,0,0),(22,'NoName63235',3,3,3,4,6,9,'blanc','M','T','G',0,'France/Europe',3,0,0,5000,5000,1,0,0,0);

/*Table structure for table `horses_caracteristique` */

DROP TABLE IF EXISTS `horses_caracteristique`;

CREATE TABLE `horses_caracteristique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `itr` int(11) DEFAULT NULL,
  `itr_year` int(11) DEFAULT NULL,
  `btr` int(11) DEFAULT NULL,
  `trot_base` int(11) DEFAULT NULL,
  `trot_current` int(11) DEFAULT NULL,
  `trot_gene` int(11) DEFAULT NULL,
  `galop_base` int(11) DEFAULT NULL,
  `galop_current` int(11) DEFAULT NULL,
  `galop_gene` int(11) DEFAULT NULL,
  `endurance_base` int(11) DEFAULT NULL,
  `endurance_current` int(11) DEFAULT NULL,
  `endurance_gene` int(11) DEFAULT NULL,
  `vitesse_base` int(11) DEFAULT NULL,
  `vitesse_current` int(11) DEFAULT NULL,
  `vitesse_gene` int(11) DEFAULT NULL,
  `physique` int(11) DEFAULT NULL,
  `fatigue` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `horses_caracteristique` */

insert  into `horses_caracteristique`(`id`,`horse_id`,`itr`,`itr_year`,`btr`,`trot_base`,`trot_current`,`trot_gene`,`galop_base`,`galop_current`,`galop_gene`,`endurance_base`,`endurance_current`,`endurance_gene`,`vitesse_base`,`vitesse_current`,`vitesse_gene`,`physique`,`fatigue`) values (1,1,177,NULL,100,60,253,100,0,295,100,60,263,100,60,264,100,100,0),(2,2,162,NULL,60,49,0,73,0,0,0,52,0,87,43,0,81,100,0),(3,3,156,NULL,75,42,153,100,0,241,0,46,103,100,36,141,100,100,0),(4,4,172,NULL,66,43,0,84,0,0,0,53,0,97,37,0,81,100,0),(5,5,163,NULL,56,0,0,0,51,296,87,42,185,57,48,410,78,100,0),(6,6,162,NULL,62,24,0,85,0,0,0,19,0,75,28,0,88,100,0),(7,7,172,NULL,39,15,0,44,0,0,0,29,0,67,21,0,46,100,0),(8,8,156,NULL,56,32,0,73,0,0,0,41,0,86,34,0,65,100,0),(9,9,163,NULL,67,0,0,0,30,0,90,41,0,85,36,0,92,100,0),(10,10,171,NULL,65,0,0,0,50,0,85,56,0,92,51,0,83,100,0),(11,11,171,NULL,83,0,0,0,38,83,87,37,82,78,37,82,84,100,0),(12,12,177,NULL,88,21,321,86,0,0,33,60,360,87,60,360,90,100,0),(13,13,162,NULL,73,25,105,67,0,0,0,31,111,84,24,104,69,100,0),(14,14,1,NULL,85,25,385,82,0,0,0,29,389,91,23,383,82,100,0),(15,15,177,NULL,80,26,346,76,0,0,33,30,350,88,25,345,76,100,0),(16,16,1,NULL,80,37,172,76,0,0,33,41,176,88,36,171,76,100,0),(17,17,177,NULL,80,30,150,76,0,0,33,34,154,88,29,149,76,100,0),(18,18,177,NULL,80,52,327,76,0,0,33,56,331,88,51,326,76,100,0),(19,19,1,NULL,83,27,307,81,0,0,0,32,312,86,26,306,83,100,0),(20,20,1,NULL,83,31,231,81,0,0,0,36,236,86,30,230,83,100,0),(21,21,172,NULL,83,41,86,81,0,0,0,46,91,86,40,85,83,100,0),(22,22,1,NULL,83,21,261,81,0,0,0,26,266,86,20,260,83,100,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `horses_training` */

insert  into `horses_training`(`id`,`horse_id`,`training_trot`,`training_galop`,`training_endurance`,`training_vitesse`,`training_physique`,`training_fatigue`) values (1,1,0,0,0,0,0,0),(2,2,0,0,0,0,0,0),(3,3,0,0,0,0,0,0),(4,4,0,0,0,0,0,0),(5,5,0,0,0,0,0,0),(6,6,0,0,0,0,0,0),(7,7,0,0,0,0,0,0),(8,8,0,0,0,0,0,0),(9,9,0,0,0,0,0,0),(10,10,0,0,0,0,0,0),(11,11,0,2,2,2,2,0),(12,12,2,0,2,2,2,0),(13,13,2,0,2,2,2,0),(14,14,2,0,2,2,2,0),(15,15,2,0,2,2,2,0),(16,16,2,0,2,2,2,0),(17,17,2,0,2,2,0,0),(18,18,2,0,2,2,2,0),(19,19,2,0,2,2,2,0),(20,20,2,0,2,2,2,0),(21,21,2,0,2,2,2,0),(22,22,2,0,2,2,2,0);

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
  `gain` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_participant` */

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_participant_tmp` */

insert  into `race_participant_tmp`(`id`,`race_tmp_id`,`horse_id`,`jockey_id`,`is_recul`,`status`) values (1,5,17,NULL,NULL,1),(3,3,16,NULL,NULL,1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `races` */

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `races_tmp` */

insert  into `races_tmp`(`id`,`meeting`,`category_id`,`name`,`lenght`,`type_id`,`hippodrome_id`,`piste_id`,`group_id`,`corde`,`price`,`recul_gain`,`recul_meter`,`max_gain`,`age_min`,`age_max`,`sexe`,`victory_price`,`status`,`created_at`,`race_date`) values (1,1,3,'Qualifications',2000,2,1,1,5,'D',0,0,0,'-1',3,10,'M,F','',1,'2016-06-09 21:00:40','2016-06-09 12:00:00'),(2,1,4,'Qualifications Jockey/Driver',2000,2,1,2,5,'G',0,0,0,'-1',3,10,'M,F','',1,'2016-06-09 21:01:48','2016-06-09 12:30:00'),(3,2,1,'Prix de Zeus',2400,1,3,3,4,'D',100,0,0,'0',4,4,'M,F','18000|5000|3500|2000|1250|500',1,'2016-06-09 21:04:46','2016-06-09 12:00:00'),(4,2,1,'Prix d\'HadÃ¨s',2150,2,3,2,4,'G',10,0,0,'0',3,3,'M,F','18000|5000|3500|2000|1250|500',1,'2016-06-09 21:20:41','2016-06-09 12:00:00'),(5,1,1,'Prix Jean Jacques',2100,2,1,1,5,'G',500,0,0,'50000',4,4,'M,F','25000|9000|7000|5000|2500|1500',1,'2016-06-10 14:22:49','2016-06-14 00:00:00');

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

insert  into `stables`(`id`,`name`,`firstname`,`lastname`,`last_activity`,`country`,`continent`,`level`,`capital`,`banque`,`gold`,`email`,`password`) values (1,'Turfoland des 2/3 ans ','Benjamin','Gates','2016-06-08 08:10:51','France','Europe',3,300000,300000,5,'gates.benjamin@turfoland.com','e5672d625c2064615e69d21846cbda74'),(2,'Turfoland des 4/5/6 ans','Isaac','Iblou','2016-06-09 06:29:38','France','Europe',3,300000,299400,5,'iblou.isaac@turfoland.com','ff7824370af348209ad8474d488d6fc7'),(3,'Turfoland des 7/8/9 ans','Alexandre','Dupont','2016-06-08 09:06:52','France','Europe',3,300000,300000,5,'alex.dupont@turfoland.com','d43db12b94c641f769f66dbd62207492'),(4,'Turfoland des 10 ans','Pascal','Vozier','2016-06-08 09:06:46','France','Europe',3,300000,300000,5,'pascal.vozier@turfoland.com','bea14bb1a152167c9cdf0b4b580c7736'),(5,'Turfoland des Inactifs','Violette','Madison','2016-06-08 09:00:53','France','Europe',3,300000,300000,5,'madison.violette@turfoland.com','306fbc4f26ae3159c4f2292d30930eb4'),(6,'Maison Laffite','Alex','DuprÃ¨s','2016-06-08 08:10:43','France','Europe',0,300000,300000,5,'alex.dupres@turfoland.com','10a632cbbf80df92fb6b66671d6ac69d');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
