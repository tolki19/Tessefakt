SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


drop table if exists `_apps`;
create table `_apps` (
  `id` int(10) unsigned not null auto_increment,
  `key` varchar(64) not null,
  `name` varchar(64) not null,
  `major` varchar(8) not null,
  `minor` varchar(8) not null,
  `build` varchar(8) not null,
  `caption` varchar(8) not null,
  primary key(`id`),
  index(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_groups`;
CREATE TABLE `_groups` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `caption` varchar(255) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_users`;
CREATE TABLE `_users` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_user-_group`;
CREATE TABLE `_user-_group` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `_group` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `validfrom` date not null,
  `validtill` date default null,
  primary key(`id`),
  key(`_user`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-errors`;
CREATE TABLE `_app-errors` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) UNSIGNED DEFAULT NULL,
  `__user` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` datetime not null,
  `error` text not null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  index(`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `_user-uids`;
CREATE TABLE `_user-uids` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `validfrom` date not null,
  `validtill` date default null,
  primary key(`id`),
  key(`_user`),
  index(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-emails`;
CREATE TABLE `_user-emails` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `order` int(10) not null default 0,
  `validfrom` date not null,
  `validtill` date default null,
  primary key(`id`),
  key(`_user`),
  index(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-hashes`;
CREATE TABLE `_user-hashes` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED not NULL,
  `type` varchar(255) NOT NULL,
  `hash` varchar(255) not NULL,
  `validfrom` date not null,
  `validtill` date default null,
  primary key(`id`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


drop table if exists `_app-db-touches`;
create table `_app-db-touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("create","read","update","delete"),
  `table` varchar(64) not null,
  `set` int(10) unsigned default null,
  `field` varchar(64) default null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  index(`timestamp`),
  index(`table`),
  index(`set`),
  index(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table if exists `_app-tpl-touches`;
create table `_app-tpl-touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("create","read","update","delete"),
  `tpl` varchar(64) not null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  index(`timestamp`),
  index(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table if exists `_app-controller-method-touches`;
create table `_app-controller-method-touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("call"),
  `controller` varchar(64) not null,
  `method` varchar(64) not null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  index(`timestamp`),
  index(`controller`),
  index(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-tpl-rights`;
CREATE TABLE `_app-tpl-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `div` varchar(255) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_app`),
  index(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group-_app-tpl-rights`;
CREATE TABLE `_group-_app-tpl-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `div` varchar(255) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_app`),
  index(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-_app-tpl-rights`;
CREATE TABLE `_user-_app-tpl-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `div` varchar(255) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_app`),
  index(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-db-rights`;
CREATE TABLE `_app-db-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `field` varchar(64) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_app`),
  index(`table`),
  index(`set`),
  index(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group-_app-db-rights`;
CREATE TABLE `_group-_app-db-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `field` varchar(64) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_app`),
  index(`table`),
  index(`set`),
  index(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-_app-db-rights`;
CREATE TABLE `_user-_app-db-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `field` varchar(64) DEFAULT NULL,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_app`),
  index(`table`),
  index(`set`),
  index(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-controller-method-rights`;
CREATE TABLE `_app-controller-method-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `controller` varchar(64) not null,
  `method` varchar(64) not null,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_app`),
  index(`controller`),
  index(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group-_app-controller-method-rights`;
CREATE TABLE `_group-_app-controller-method-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `controller` varchar(64) not null,
  `method` varchar(64) not null,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_app`),
  index(`controller`),
  index(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-_app-controller-method-rights`;
CREATE TABLE `_user-_app-controller-method-rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `controller` varchar(64) not null,
  `method` varchar(64) not null,
  `right` tinyint(4) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_app`),
  index(`controller`),
  index(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-settings`;
CREATE TABLE `_app-settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `setting` varchar(64) NOT NULL,
  `value` varchar(16) NOT NULL,
  primary key(`id`),
  key(`_app`),
  index(`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_group-_app-settings`;
CREATE TABLE `_group-_app-settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `setting` varchar(64) NOT NULL,
  `value` varchar(16) NOT NULL,
  primary key(`id`),
  key(`_group`),
  key(`_app`),
  index(`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-_app-settings`;
CREATE TABLE `_user-_app-settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `setting` varchar(64) NOT NULL,
  `value` varchar(16) NOT NULL,
  primary key(`id`),
  key(`_user`),
  key(`_app`),
  index(`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_user-email-state`;
CREATE TABLE `_user-email-state` (
  `id` int(10) unsigned not null auto_increment,
  `_user-email` int(10) unsigned not null,
  `state` enum('pending','copied','cancelled'),
  `timestamp` datetime not null,
  `remark` text null,
  `key` varchar(64),
  primary key(`id`),
  key(`_user-email`)
);

DROP TABLE IF EXISTS `_user-uid-state`;
CREATE TABLE `_user-uid-state` (
  `id` int(10) unsigned not null auto_increment,
  `_user-uid` int(10) unsigned not null,
  `state` enum('pending','copied','cancelled'),
  `timestamp` datetime not null,
  `remark` text null,
  `key` varchar(64),
  primary key(`id`),
  key(`_user-uid`)
);

DROP TABLE IF EXISTS `_user-hash-state`;
CREATE TABLE `_user-hash-state` (
  `id` int(10) unsigned not null auto_increment,
  `_user-hash` int(10) unsigned not null,
  `state` enum('pending','copied','cancelled'),
  `timestamp` datetime not null,
  `remark` text null,
  `key` varchar(64),
  primary key(`id`),
  key(`_user-hash`)
);
