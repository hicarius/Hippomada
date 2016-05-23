/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  22/05/2016 21:46:05                      */
/*==============================================================*/


drop table if exists HORSES;

drop table if exists JOCKEYS;

drop table if exists PROPOSITION_JOCKEY_RACE;

drop table if exists RACES;

drop table if exists RACE_CATEGORY;

drop table if exists RACE_HYPPODROME;

drop table if exists RACE_PARTICIPANT;

drop table if exists RACE_PISTE;

drop table if exists RACE_TYPE;

drop table if exists SAILLIES;

drop table if exists STABLES;

/*==============================================================*/
/* Table : HORSES                                               */
/*==============================================================*/
create table HORSES
(
   HORSE_ID             int not null,
   NAME                 varchar(100),
   PROPRIO_ID           int,
   TRAINER_ID           int,
   ELEVEUR_ID           int,
   FATHER_ID            int,
   MOTHER_ID            int,
   AGE                  int,
   SEXE                 varchar(1),
   GAINS                int,
   ORIGINE              varchar(100),
   QUALITY              int,
   QUALITY_PRODUCTION   int,
   EVALUATION_PRICE     int,
   STATUS               int,
   IS_SYSTEM            int,
   primary key (HORSE_ID)
);

/*==============================================================*/
/* Table : JOCKEYS                                              */
/*==============================================================*/
create table JOCKEYS
(
   JOCKEY_ID            int not null,
   STABLE_ID            int,
   LEVEL                int,
   PRICE                int,
   PROGRESSION          decimal(4,2),
   primary key (JOCKEY_ID)
);

/*==============================================================*/
/* Table : PROPOSITION_JOCKEY_RACE                              */
/*==============================================================*/
create table PROPOSITION_JOCKEY_RACE
(
   ID                   int not null,
   RACE_ID              int,
   JOCKEY_ID            int,
   STATUS               int,
   CREATED_AT           datetime,
   primary key (ID)
);

/*==============================================================*/
/* Table : RACES                                                */
/*==============================================================*/
create table RACES
(
   RACE_ID              int not null,
   CATEGORY_ID          int,
   NAME                 varchar(100),
   LENGHT               int,
   TYPE_ID              int,
   HYPPODROME_ID        int,
   PISTE_ID             int,
   CORDE                int,
   PRICE                int,
   RECUL_GAIN           int,
   RECUL_METER          int,
   MAX_GAIN             int,
   AGE_MIN              int,
   AGE_MAX              int,
   VICTORY_PRICE        int,
   STATUS               int,
   CREATED_AT           datetime,
   primary key (RACE_ID)
);

/*==============================================================*/
/* Table : RACE_CATEGORY                                        */
/*==============================================================*/
create table RACE_CATEGORY
(
   ID                   int not null,
   TITLE                varchar(20),
   primary key (ID)
);

/*==============================================================*/
/* Table : RACE_HYPPODROME                                      */
/*==============================================================*/
create table RACE_HYPPODROME
(
   ID                   int not null,
   TITLE                varchar(50),
   primary key (ID)
);

/*==============================================================*/
/* Table : RACE_PARTICIPANT                                     */
/*==============================================================*/
create table RACE_PARTICIPANT
(
   ID                   int not null,
   RACE_ID              int,
   HORSE_ID             int,
   JOCKEY_ID            int,
   NUMERO               int,
   IS_RECUL             int,
   COTE                 int,
   RANG                 int,
   GAIN                 int,
   STATUS               int,
   primary key (ID)
);

/*==============================================================*/
/* Table : RACE_PISTE                                           */
/*==============================================================*/
create table RACE_PISTE
(
   ID                   int not null,
   CODE                 varchar(1),
   TITLE                varchar(10),
   primary key (ID)
);

/*==============================================================*/
/* Table : RACE_TYPE                                            */
/*==============================================================*/
create table RACE_TYPE
(
   ID                   int not null,
   TITLE                varchar(20),
   primary key (ID)
);

/*==============================================================*/
/* Table : SAILLIES                                             */
/*==============================================================*/
create table SAILLIES
(
   ID                   int not null,
   STABLE_ID            int,
   HORSE_ID             int,
   MOTHER_ID            int,
   STATUS               int,
   primary key (ID)
);

/*==============================================================*/
/* Table : STABLES                                              */
/*==============================================================*/
create table STABLES
(
   STABLE_ID            int not null,
   NAME                 varchar(50),
   FIRSTNAME            varchar(50),
   LASTNAME             varchar(50),
   LAST_ACTIVITY        datetime,
   COUNTRY              varchar(100),
   CONTINENT            varchar(100),
   LEVEL                int,
   BANQUE               int,
   GOLD                 int,
   primary key (STABLE_ID)
);

