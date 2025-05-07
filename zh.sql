CREATE DATABASE `aruhaz`
CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `aruhaz`;

CREATE TABLE `rendeles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `email` varchar(45) NOT NULL,
  `nev` varchar(45) NOT NULL,
  `nap` varchar(20) NOT NULL,
  `darab` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
)
ENGINE = InnoDB
CHARACTER SET utf8 COLLATE utf8_hungarian_ci;

