CREATE DATABASE IF NOT EXISTS ZODIAC;
USE ZODIAC;

DROP TABLE IF EXISTS  USERS;
create table USERS
(
    ID            int auto_increment primary key,
    USER_ID       varchar(100)                          not null,
    USER_EMAIL    varchar(250)                          not null,
    USER_PASSWORD varchar(250)                          not null,
    USER_LEVEL    int(1)                                not null,
    DATE          timestamp default current_timestamp() not null on update current_timestamp()
);

DROP TABLE IF EXISTS  USER_PROFILE;
create table USER_PROFILE
(
    ID                  int auto_increment primary key,
    USER_ID             varchar(100) not null,
    USER_FIRSTNAME      varchar(100) not null,
    USER_LASTNAME       varchar(100) not null,
    USER_AVATAR         varchar(250) not null,
    USER_GENDER         varchar(250) not null,
    USER_BIRTHDATE          varchar(50)  not null
);
DROP TABLE IF EXISTS  SUB_PERSONS;
create table SUB_PERSONS
(
    ID                             int auto_increment primary key,
    USER_ID                     varchar(100) not null,
    PERSONS_ID                     varchar(100) not null,
    PERSONS_FIRSTNAME              varchar(100) not null,
    PERSONS_LASTNAME               varchar(100) not null,
    PERSONS_AVATAR                 varchar(250) not null,
    PERSONS_GENDER                 varchar(250) not null,
    PERSONS_BIRTH_DAY               varchar(2)  not null,
    PERSONS_BIRTH_MONTH            varchar(2)  not null,
    PERSONS_BIRTH_YEAR            varchar(4)  not null,
    PERSONS_BIRTH_HOUR             varchar(50)  null,
    PERSONS_BIRTH_PLACE             varchar(250) null
);
DROP TABLE IF EXISTS  PERSON_WORLDS;
create table PERSON_WORLDS
(
    ID                             int auto_increment primary key,
    USER_ID                     varchar(100) not null,
    PERSON_ID                     varchar(100) not null,
    PERSON_ACTION                varchar(50)  not null,
    PERSON_FUN                  varchar(50)  not null,
    PERSON_SEEK                  varchar(50)  not null,
    PERSON_MATTER                  varchar(50)  not null,
    PERSON_USABILITY                  varchar(50)  not null,
    PERSON_CAREER                  varchar(50)  not null,
    PERSON_INFORMATION                  varchar(50)  not null,
    PERSON_RELATIONS                  varchar(50)  not null,
    PERSON_FUTURE                  varchar(50)  not null,
    PERSON_FEELING                  varchar(50)  not null,
    PERSON_DESIRE                  varchar(50)  not null,
    PERSON_SPIRITUAL                  varchar(50)  not null,
    PERSON_WALLPAPER                varchar(20)     not null,
    DATE          timestamp default current_timestamp() not null on update current_timestamp()
);

create table USER_SECURITY
(
    ID              int auto_increment primary key,
    USER_ID         varchar(100)           not null,
    USER_EMAIL      varchar(250)           not null,
    USER_STATUS     int(1)                 not null,
    ACCOUNT_STATUS  int(1)                 not null,
    USER_RECOVERY   varchar(250)           null,
    USER_IP         varchar(50)            not null,
    USER_COUNTRY    varchar(50)            not null
);


create table USER_PLAN(
   ID                           int auto_increment primary key,
   USER_ID                      varchar(100)           not null,
   USER_PACKET_PRICE            varchar(50)            not null,
   USER_PACKET_OPTION           int(1)                 not null,
   USER_PACKET_START_DATE       varchar(40)            not null,
   USER_PACKET_END_DATE         varchar(40)            not null,
   DATE          timestamp default current_timestamp() not null on update current_timestamp()
);

DROP TABLE PLANS;
create table PLANS(
    ID                               int auto_increment primary key,
    PLAN_TITLE                       varchar(250)            not null,
    PLAN_DESCRIPTION                 varchar(400)            not null,
    PLAN_PRICE                       varchar(10)             not null,
    PLAN_TYPE                        int(1)                  not null,
    DATE          timestamp default current_timestamp() not null on update current_timestamp()
);

