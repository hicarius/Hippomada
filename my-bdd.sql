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

/*Table structure for table `horses` */

DROP TABLE IF EXISTS `horses`;

CREATE TABLE `horses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `PROPRIO_ID` int(11) DEFAULT NULL,
  `TRAINER_ID` int(11) DEFAULT NULL,
  `ELEVEUR_ID` int(11) DEFAULT NULL,
  `FATHER_ID` int(11) DEFAULT NULL,
  `MOTHER_ID` int(11) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `SEXE` varchar(1) DEFAULT NULL,
  `GAINS` int(11) DEFAULT NULL,
  `ORIGINE` varchar(100) DEFAULT NULL,
  `QUALITY` int(11) DEFAULT NULL,
  `QUALITY_PRODUCTION` int(11) DEFAULT NULL,
  `EVALUATION_PRICE` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `IS_SYSTEM` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `horses` */

/*Table structure for table `jockeys` */

DROP TABLE IF EXISTS `jockeys`;

CREATE TABLE `jockeys` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `STABLE_ID` int(11) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `PROGRESSION` decimal(4,2) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jockeys` */

/*Table structure for table `proposition_jockey_race` */

DROP TABLE IF EXISTS `proposition_jockey_race`;

CREATE TABLE `proposition_jockey_race` (
  `ID` int(11) NOT NULL,
  `RACE_ID` int(11) DEFAULT NULL,
  `JOCKEY_ID` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `proposition_jockey_race` */

/*Table structure for table `race_category` */

DROP TABLE IF EXISTS `race_category`;

CREATE TABLE `race_category` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_category` */

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
  `ID` int(11) NOT NULL,
  `RACE_ID` int(11) DEFAULT NULL,
  `HORSE_ID` int(11) DEFAULT NULL,
  `JOCKEY_ID` int(11) DEFAULT NULL,
  `NUMERO` int(11) DEFAULT NULL,
  `IS_RECUL` int(11) DEFAULT NULL,
  `COTE` int(11) DEFAULT NULL,
  `RANG` int(11) DEFAULT NULL,
  `GAIN` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_participant` */

/*Table structure for table `race_piste` */

DROP TABLE IF EXISTS `race_piste`;

CREATE TABLE `race_piste` (
  `ID` int(11) NOT NULL,
  `CODE` varchar(1) DEFAULT NULL,
  `TITLE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_piste` */

/*Table structure for table `race_type` */

DROP TABLE IF EXISTS `race_type`;

CREATE TABLE `race_type` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `race_type` */

/*Table structure for table `races` */

DROP TABLE IF EXISTS `races`;

CREATE TABLE `races` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `LENGHT` int(11) DEFAULT NULL,
  `TYPE_ID` int(11) DEFAULT NULL,
  `HYPPODROME_ID` int(11) DEFAULT NULL,
  `PISTE_ID` int(11) DEFAULT NULL,
  `CORDE` int(11) DEFAULT NULL,
  `PRICE` int(11) DEFAULT NULL,
  `RECUL_GAIN` int(11) DEFAULT NULL,
  `RECUL_METER` int(11) DEFAULT NULL,
  `MAX_GAIN` int(11) DEFAULT NULL,
  `AGE_MIN` int(11) DEFAULT NULL,
  `AGE_MAX` int(11) DEFAULT NULL,
  `VICTORY_PRICE` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  `CREATED_AT` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `races` */

/*Table structure for table `saillies` */

DROP TABLE IF EXISTS `saillies`;

CREATE TABLE `saillies` (
  `ID` int(11) NOT NULL,
  `STABLE_ID` int(11) DEFAULT NULL,
  `HORSE_ID` int(11) DEFAULT NULL,
  `MOTHER_ID` int(11) DEFAULT NULL,
  `STATUS` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `saillies` */

/*Table structure for table `stables` */

DROP TABLE IF EXISTS `stables`;

CREATE TABLE `stables` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(50) DEFAULT NULL,
  `FIRSTNAME` varchar(50) DEFAULT NULL,
  `LASTNAME` varchar(50) DEFAULT NULL,
  `LAST_ACTIVITY` datetime DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `CONTINENT` varchar(100) DEFAULT NULL,
  `LEVEL` int(11) DEFAULT NULL,
  `BANQUE` int(11) DEFAULT NULL,
  `GOLD` int(11) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `stables` */

insert  into `stables`(`ID`,`NAME`,`FIRSTNAME`,`LASTNAME`,`LAST_ACTIVITY`,`COUNTRY`,`CONTINENT`,`LEVEL`,`BANQUE`,`GOLD`,`EMAIL`,`PASSWORD`) values (11,'EC 01','WS Rest','Rakoto','2016-05-23 03:10:10','','',1,300000,5,'admin@sovaly.loc','f3a8db5313ae336dc556ba98980a4610');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
