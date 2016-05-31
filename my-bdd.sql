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
  `sexe` varchar(1) DEFAULT NULL,
  `gains` int(11) DEFAULT NULL,
  `origine` varchar(100) DEFAULT NULL,
  `quality` int(11) DEFAULT NULL,
  `quality_production` int(11) DEFAULT NULL,
  `evaluation_price` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `is_qualified` int(11) DEFAULT NULL,
  `is_system` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `horses` */

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `horses_caracteristique` */

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

insert  into `race_group`(`id`,`group_name`) values (1,'Groupe I'),(2,'Groupe II'),(3,'Groupe III'),(4,'Standard'),(5,'2 ans'),(6,'Driver/Jockey');

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

insert  into `race_type`(`id`,`code`,`title`,`group_ids`) values (1,'m','Trot MontÃ©','1,2,4'),(2,'a','Trot AttelÃ©','1,2,3,4,5,6'),(3,'m','Galop Plat','1,2,3,4,5');

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
  `race_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `races` */

insert  into `races`(`id`,`category_id`,`name`,`lenght`,`type_id`,`hippodrome_id`,`piste_id`,`group_id`,`corde`,`price`,`recul_gain`,`recul_meter`,`max_gain`,`age_min`,`age_max`,`victory_price`,`status`,`created_at`,`race_date`) values (1,1,'Prix d\'antilles 45',2400,2,3,1,6,'G',1000,0,0,10000,3,3,'',1,'2016-05-31 13:21:30','2016-05-31 13:21:30'),(3,4,'prix de test 3 ',2000,1,1,1,3,'D',200,0,0,2000,4,4,'0',1,'2016-05-31 15:13:33','2016-06-01 14:30:00'),(4,4,'prix de test2',2800,3,3,2,1,'G',2300,40000,25,80000,5,6,'0',1,'2016-05-31 15:20:46','2016-06-01 15:30:00');

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
  `banque` int(11) DEFAULT NULL,
  `gold` int(11) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `stables` */

insert  into `stables`(`id`,`name`,`firstname`,`lastname`,`last_activity`,`country`,`continent`,`level`,`banque`,`gold`,`email`,`password`) values (1,'Turfoland des 2/3 ans ','Benjamin','Gates','2016-05-31 06:10:10',NULL,NULL,3,300000,5,'gates.benjamin@turfoland.com','d41d8cd98f00b204e9800998ecf8427e'),(2,'Turfoland des 4/5/6 ans','Isaac','Iblou','2016-05-31 06:12:30',NULL,NULL,3,300000,5,'iblou.isaac@turfoland.com','d41d8cd98f00b204e9800998ecf8427e'),(3,'Turfoland des 7/8/9 ans','Alexandre','Dupont','2016-05-31 06:16:23',NULL,NULL,3,300000,5,'alex.dupont@turfoland.com','d41d8cd98f00b204e9800998ecf8427e'),(4,'Turfoland des 10 ans','Pascal','Vozier','2016-05-31 06:17:17',NULL,NULL,3,300000,5,'pascal.vozier@turfoland.com','d41d8cd98f00b204e9800998ecf8427e'),(5,'Turfoland des Inactifs','Violette','Madison','2016-05-31 06:22:48',NULL,NULL,3,300000,5,'madison.violette@turfoland.com','d41d8cd98f00b204e9800998ecf8427e');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
