/*
SQLyog Community Edition- MySQL GUI v7.02 
MySQL - 5.5.32 : Database - sovaly
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `config` */

insert  into `config`(`id`,`config_key`,`config_value`) values (1,'current_mounth','5'),(2,'current_year','2016');

/*Table structure for table `gain_race_horse` */

DROP TABLE IF EXISTS `gain_race_horse`;

CREATE TABLE `gain_race_horse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `horse_id` int(11) DEFAULT NULL,
  `carrer_race` int(11) DEFAULT NULL,
  `carrer_win` int(11) DEFAULT NULL,
  `carrer_placed` int(11) DEFAULT NULL,
  `carrer_gain` int(11) DEFAULT NULL,
  `year_race` int(11) DEFAULT NULL,
  `year_win` int(11) DEFAULT NULL,
  `year_placed` int(11) DEFAULT NULL,
  `year_gain` int(11) DEFAULT NULL,
  `mounth_race` int(11) DEFAULT NULL,
  `mounth_win` int(11) DEFAULT NULL,
  `mounth_placed` int(11) DEFAULT NULL,
  `mounth_gain` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gain_race_horse` */

/*Table structure for table `gain_race_stable` */

DROP TABLE IF EXISTS `gain_race_stable`;

CREATE TABLE `gain_race_stable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stable_id` int(11) DEFAULT NULL,
  `carrer_race` int(11) DEFAULT NULL,
  `carrer_win` int(11) DEFAULT NULL,
  `carrer_placed` int(11) DEFAULT NULL,
  `carrer_gain` int(11) DEFAULT NULL,
  `year_race` int(11) DEFAULT NULL,
  `year_win` int(11) DEFAULT NULL,
  `year_placed` int(11) DEFAULT NULL,
  `year_gain` int(11) DEFAULT NULL,
  `mounth_race` int(11) DEFAULT NULL,
  `mounth_win` int(11) DEFAULT NULL,
  `mounth_placed` int(11) DEFAULT NULL,
  `mounth_gain` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `gain_race_stable` */

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
  `robe` varchar(1) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `horses` */

insert  into `horses`(`id`,`name`,`proprio_id`,`trainer_id`,`eleveur_id`,`father_id`,`mother_id`,`age`,`robe`,`sexe`,`specialization`,`corde`,`gains`,`origine`,`quality`,`quality_production`,`production_price`,`evaluation_price`,`price`,`status`,`type`,`is_qualified`,`is_system`) values (1,'General de poummeau',5,5,5,0,0,12,NULL,'M','T',NULL,3750000,'France/Europe',10,5,125000,0,125000,0,2,1,1),(25,'Coktail Jet',5,5,5,0,0,19,NULL,'M','T','D',3654000,'France/Europe',6,3,50000,0,50000,0,2,1,1),(26,'Insert gÃ©dÃ©',5,5,5,0,0,21,NULL,'M','T','G',278000,'France/Europe',9,1,5000,0,5000,0,2,1,1),(27,'Poule 1',4,4,4,1,0,10,NULL,'F','T','G',278000,'France/Europe',6,5,125000,0,125000,0,3,1,1),(36,'Poule 2',3,3,3,25,0,7,NULL,'F','T','G',0,'France/Europe',4,3,50000,0,50000,0,3,0,1),(40,'NoName29248',2,2,2,26,27,5,NULL,'F','T','D',0,'France/Europe',6,1,0,35000,35000,1,0,0,0),(41,'NoName4130',2,2,2,26,27,5,NULL,'F','T','G',0,'France/Europe',8,1,0,100000,100000,1,0,0,0),(42,'NoName26608',3,3,3,26,27,9,NULL,'M','T','G',0,'France/Europe',6,0,0,35000,35000,1,0,0,0),(43,'NoName92167',2,2,2,26,27,5,NULL,'M','T','G',0,'France/Europe',10,0,0,500000,500000,1,0,0,0),(44,'NoName33513',3,3,3,26,27,7,NULL,'F','T','G',0,'France/Europe',6,1,0,35000,35000,1,0,0,0),(45,'NoName58260',3,3,3,26,27,9,NULL,'M','T','D',0,'France/Europe',9,0,0,250000,250000,1,0,0,0),(46,'NoName50556',3,3,3,26,27,7,NULL,'F','T','G',0,'France/Europe',6,1,0,35000,35000,1,0,0,0),(47,'NoName36400',3,3,3,26,27,9,NULL,'F','T','G',0,'France/Europe',9,1,0,250000,250000,1,0,0,0),(48,'NoName3356',3,3,3,1,27,8,NULL,'F','T','D',0,'France/Europe',8,5,0,100000,100000,1,0,0,0),(49,'NoName30391',1,1,1,1,27,3,NULL,'M','T','D',0,'France/Europe',10,0,0,500000,500000,1,0,0,0),(50,'NoName67625',1,1,1,1,27,2,NULL,'M','T','D',0,'France/Europe',7,0,0,75000,75000,1,0,0,0),(51,'NoName22459',4,4,4,1,27,10,NULL,'M','T','D',0,'France/Europe',5,0,0,15000,15000,1,0,0,0),(52,'NoName20791',3,3,3,1,27,9,NULL,'F','T','G',0,'France/Europe',5,5,0,15000,15000,1,0,0,0),(53,'NoName50184',3,3,3,1,27,9,NULL,'F','T','D',0,'France/Europe',9,5,0,250000,250000,1,0,0,0),(54,'NoName51174',4,4,4,1,27,10,NULL,'F','T','D',0,'France/Europe',7,5,0,75000,75000,1,0,0,0),(55,'NoName74872',2,2,2,26,36,6,NULL,'F','T','G',0,'France/Europe',7,1,0,75000,75000,1,0,0,0),(56,'NoName71156',3,3,3,26,36,7,NULL,'M','T','D',0,'France/Europe',3,0,0,5000,5000,1,0,0,0),(57,'NoName75476',3,3,3,26,36,9,NULL,'M','T','G',0,'France/Europe',7,0,0,75000,75000,1,0,0,0),(58,'NoName45540',3,3,3,26,36,8,NULL,'F','T','G',0,'France/Europe',4,1,0,10000,10000,1,0,0,0),(59,'NoName48492',3,3,3,26,36,9,'','M','T','G',0,'France/Europe',3,0,0,5000,5000,1,0,0,0),(60,'NoName84390',2,2,2,26,36,5,'','F','T','G',0,'France/Europe',5,1,0,15000,15000,1,0,0,0);

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
  `fatigue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `horses_caracteristique` */

insert  into `horses_caracteristique`(`id`,`horse_id`,`itr`,`itr_year`,`btr`,`trot_base`,`trot_current`,`trot_gene`,`galop_base`,`galop_current`,`galop_gene`,`endurance_base`,`endurance_current`,`endurance_gene`,`vitesse_base`,`vitesse_current`,`vitesse_gene`,`physique`,`fatigue`) values (1,1,177,NULL,100,60,0,100,0,0,100,60,0,100,60,0,100,100,100),(18,25,161,NULL,50,57,0,80,0,0,80,53,0,80,56,0,100,100,100),(19,26,142,NULL,80,43,0,73,0,0,76,45,0,74,50,0,78,100,NULL),(20,27,100,NULL,NULL,65,0,100,0,0,100,60,0,100,53,0,100,100,NULL),(29,36,161,NULL,NULL,69,0,100,0,0,100,26,0,100,33,0,100,100,NULL),(31,40,142,NULL,92,40,220,91,0,0,92,40,220,91,40,220,93,100,NULL),(32,41,142,NULL,92,46,246,91,0,0,92,46,246,91,46,246,93,100,NULL),(33,42,1,NULL,92,39,399,91,0,0,92,39,399,91,39,399,93,100,NULL),(34,43,1,NULL,92,56,296,91,0,0,92,56,296,91,56,296,93,100,NULL),(35,44,142,NULL,92,36,306,91,0,0,92,36,306,91,36,306,93,100,NULL),(36,45,1,NULL,92,51,491,91,0,0,92,51,491,91,51,491,93,100,NULL),(37,46,142,NULL,92,36,306,91,0,0,92,36,306,91,36,306,93,100,NULL),(38,47,142,NULL,92,55,495,91,0,0,92,55,495,91,55,495,93,100,NULL),(39,48,177,NULL,100,49,399,100,0,0,100,48,398,100,47,397,100,100,NULL),(40,49,1,NULL,100,59,179,100,0,0,100,58,178,100,57,177,100,100,NULL),(41,50,1,NULL,100,43,88,100,0,0,100,42,87,100,41,86,100,100,NULL),(42,51,1,NULL,100,34,394,100,0,0,100,33,393,100,32,392,100,100,NULL),(43,52,177,NULL,100,36,356,100,0,0,100,35,355,100,34,354,100,100,NULL),(44,53,177,NULL,100,53,493,100,0,0,100,52,492,100,51,491,100,100,NULL),(45,54,177,NULL,100,44,449,100,0,0,100,43,448,100,42,447,100,100,NULL),(46,55,142,NULL,87,44,269,84,0,0,85,40,265,85,44,269,93,100,NULL),(47,56,1,NULL,87,23,203,84,0,0,85,19,199,85,23,203,93,100,NULL),(48,57,1,NULL,87,42,402,84,0,0,85,38,398,85,42,402,93,100,NULL),(49,58,142,NULL,87,31,311,84,0,0,85,27,307,85,31,311,93,100,NULL),(50,59,1,NULL,87,25,265,84,0,0,85,21,261,85,25,265,93,100,NULL),(51,60,142,NULL,87,35,195,84,0,0,85,31,191,85,35,195,93,100,NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `race_category` */

insert  into `race_category`(`id`,`title`,`group_ids`) values (1,'Qualification','5,6'),(3,'Amateur','4'),(4,'Nationale','1,2,3,4'),(5,'Internationale','4'),(6,'A reclamer','4');

/*Table structure for table `race_group` */

DROP TABLE IF EXISTS `race_group`;

CREATE TABLE `race_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `race_group` */

insert  into `race_group`(`id`,`group_name`) values (1,'Groupe I'),(2,'Groupe II'),(3,'Groupe III'),(4,'Standard'),(5,'Course'),(6,'Driver/Jockey');

/*Table structure for table `race_hippodrome` */

DROP TABLE IF EXISTS `race_hippodrome`;

CREATE TABLE `race_hippodrome` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `group_ids` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_hippodrome` */

insert  into `race_hippodrome`(`id`,`title`,`group_ids`) values (1,'Vincennes','1,2,3,4,5,6'),(2,'Languedoc','4'),(3,'Vichy','5,6');

/*Table structure for table `race_hyppodrome` */

DROP TABLE IF EXISTS `race_hyppodrome`;

CREATE TABLE `race_hyppodrome` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_hyppodrome` */

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `race_participant` */

insert  into `race_participant`(`id`,`race_id`,`horse_id`,`jockey_id`,`numero`,`is_recul`,`cote`,`rang`,`gain`,`status`) values (1,1,49,1,15,NULL,12,3,750,1),(2,3,49,1,2,NULL,14,9,0,1),(3,4,49,1,6,NULL,5,14,0,0),(4,5,43,NULL,1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `race_piste` */

DROP TABLE IF EXISTS `race_piste`;

CREATE TABLE `race_piste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_piste` */

insert  into `race_piste`(`id`,`code`,`title`) values (1,'S','Sable'),(2,'C','CendrÃ©e'),(3,'H','Herbe');

/*Table structure for table `race_type` */

DROP TABLE IF EXISTS `race_type`;

CREATE TABLE `race_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(3) DEFAULT NULL,
  `title` varchar(20) DEFAULT NULL,
  `group_ids` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `race_type` */

insert  into `race_type`(`id`,`code`,`title`,`group_ids`) values (1,'m','MontÃ©','1,2,4'),(2,'a','AttelÃ©','1,2,3,4,5,6'),(3,'p','Plat','1,2,3,4,5');

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
  `victory_price` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `meeting` int(11) DEFAULT NULL,
  `race_number` int(11) DEFAULT NULL,
  `race_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `races` */

insert  into `races`(`id`,`category_id`,`name`,`lenght`,`type_id`,`hippodrome_id`,`piste_id`,`group_id`,`corde`,`price`,`recul_gain`,`recul_meter`,`max_gain`,`age_min`,`age_max`,`victory_price`,`status`,`created_at`,`meeting`,`race_number`,`race_date`) values (1,1,'Prix d\'antilles 45',2400,2,3,1,6,'G',1000,0,0,10000,3,3,'',1,'2016-05-31 13:21:30',NULL,NULL,'2016-05-31 13:21:30'),(3,4,'prix de test 3 ',2000,1,1,1,3,'D',200,0,0,2000,4,4,'0',1,'2016-05-31 15:13:33',NULL,NULL,'2016-06-01 14:30:00'),(4,4,'prix de test2',2800,3,3,2,1,'G',2300,40000,25,80000,5,6,'0',1,'2016-05-31 15:20:46',NULL,NULL,'2016-06-01 15:30:00'),(5,4,'Prix de vichy I',2200,2,3,1,4,'D',200,0,0,10000,3,3,'',1,'2016-06-05 20:03:41',1,1,'2016-06-06 12:00:00'),(6,4,'Prix de vichy 2',2750,2,3,1,4,'D',200,0,0,5000,5,6,'23000|10000|6000|4000|2000|1000',1,'2016-06-05 20:07:54',1,2,'2016-06-06 12:30:00'),(7,6,'Prix de vichy 3',2400,2,3,3,4,'G',100,0,0,0,3,3,'',1,'2016-06-05 20:09:34',1,3,'2016-06-06 13:00:00'),(8,4,'Prix de vichy 4',2850,1,3,3,1,'D',1000,0,0,50000,6,0,'',0,'2016-06-05 20:10:42',2,1,'2016-06-06 13:30:00'),(9,1,'Prix de Vincennes Q1',2000,2,1,1,5,'D',0,0,0,0,2,2,'',1,'2016-06-05 20:11:45',3,1,'2016-06-06 14:30:00'),(10,1,'Prix de Vincennes Q2',2000,2,1,3,4,'G',0,0,0,0,3,3,'',1,'2016-06-05 20:13:06',3,2,'2016-06-06 15:00:00');

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

insert  into `stables`(`id`,`name`,`firstname`,`lastname`,`last_activity`,`country`,`continent`,`level`,`capital`,`banque`,`gold`,`email`,`password`) values (1,'Turfoland des 2/3 ans ','Benjamin','Gates','2016-06-05 12:48:42','France','Europe',3,300000,300000,5,'gates.benjamin@turfoland.com','e5672d625c2064615e69d21846cbda74'),(2,'Turfoland des 4/5/6 ans','Isaac','Iblou','2016-06-05 03:34:50','France','Europe',3,300000,300000,5,'iblou.isaac@turfoland.com','ff7824370af348209ad8474d488d6fc7'),(3,'Turfoland des 7/8/9 ans','Alexandre','Dupont','2016-05-31 06:16:23','France','Europe',3,300000,300000,5,'alex.dupont@turfoland.com','d43db12b94c641f769f66dbd62207492'),(4,'Turfoland des 10 ans','Pascal','Vozier','2016-05-31 06:17:17','France','Europe',3,300000,300000,5,'pascal.vozier@turfoland.com','bea14bb1a152167c9cdf0b4b580c7736'),(5,'Turfoland des Inactifs','Violette','Madison','2016-05-31 06:22:48','France','Europe',3,300000,300000,5,'madison.violette@turfoland.com','306fbc4f26ae3159c4f2292d30930eb4'),(6,'Maison Laffite','Alex','DuprÃ¨s','2016-06-01 06:25:47','France','Europe',0,300000,300000,5,'alex.dupres@turfoland.com','10a632cbbf80df92fb6b66671d6ac69d');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
