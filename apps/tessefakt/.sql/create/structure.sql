SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


DROP TABLE IF EXISTS `_group`;
CREATE TABLE `_group` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `caption` varchar(255) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_users`;
CREATE TABLE `_users` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_user__group`;
CREATE TABLE `_user__group` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `_group` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hashdate` date DEFAULT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_uids`;
CREATE TABLE `_user_uids` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  primary key(`id`),
  key(`_user`),
  index(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_emails`;
CREATE TABLE `_user_emails` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `main` tinyint(1) not null default 0,
  primary key(`id`),
  key(`_user`),
  index(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_hashes`;
CREATE TABLE `_user_hashes` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hashdate` date DEFAULT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


drop if exists `_group_status`;
create table `_group_status` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED NOT NULL,
  `__timestamp` datetime not null,
  `__status` enum("create","change","delete"),
  `__remark` text null,
  primary key(`id`),
  key(`_group`),
  key(`__user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop if exists `_user_status`;
create table `_user_status` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED NOT NULL,
  `__timestamp` datetime not null,
  `__status` enum("create","change","delete"),
  `__remark` text null,
  primary key(`id`),
  key(`_user`),
  key(`__user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_uid_status`;
CREATE TABLE `_user_uid_status` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user_uid` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED NOT NULL,
  `__timestamp` datetime not null,
  `__status` enum("create","inform","verify","delete"),
  `__remark` text null,
  primary key(`id`),
  key(`_user_uid`),  
  key(`__user`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_email_status`;
CREATE TABLE `_user_email_status` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user_email` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED NOT NULL,
  `__timestamp` datetime not null,
  `__status` enum("create","change","inform","verify","delete"),
  `__remark` text null,
  primary key(`id`),
  key(`_user_email`),  
  key(`__user`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_hash_status`;
CREATE TABLE `_user_hash_status` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user_hash` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED NOT NULL,
  `__timestamp` datetime not null,
  `__status` enum("create","inform","verify","delete"),
  `__remark` text null,
  primary key(`id`),
  key(`_user_hash`),  
  key(`__user`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_rights`;
CREATE TABLE `_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `table` varchar(255) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group_rights`;
CREATE TABLE `_group_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `table` varchar(255) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_rights`;
CREATE TABLE `_user_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `table` varchar(255) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_settings`;
CREATE TABLE `_settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `setting` varchar(255) NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group_settings`;
CREATE TABLE `_group_settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_setting` int(10) UNSIGNED NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_settings`;
CREATE TABLE `_user_settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_setting` int(10) UNSIGNED NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_policies`;
CREATE TABLE `_policies` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `policy` varchar(255) NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group_policies`;
CREATE TABLE `_group_policies` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_policy` int(10) unsigned NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_policy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user_policies`;
CREATE TABLE `_user_policies` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_policy` int(10) unsigned NOT NULL,
  `value` varchar(64) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_policy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
