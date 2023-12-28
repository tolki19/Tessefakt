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
  key(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_groups`;
CREATE TABLE `_groups` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
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
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_errors`;
CREATE TABLE `_errors` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `__user` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` datetime not null,
  `error` text not null,
  `remark` text null,
  primary key(`id`),
  key(`__user`),
  key(`timestamp`),
  key(`error`),
  key(`remark`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `_user-uids`;
CREATE TABLE `_user-uids` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `uid` varchar(255) NOT NULL,
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`),
  key(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-emails`;
CREATE TABLE `_user-emails` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `order` int(10) not null default 0,
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`),
  key(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_user-hashes`;
CREATE TABLE `_user-hashes` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED not NULL,
  `type` varchar(255) NOT NULL,
  `hash` varchar(255) not NULL,
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


drop table if exists `_app-tables`;
create table `_app-tables` (
  `id` int(10) unsigned not null auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(128) not null,
  `state` enum("active","inactive") not null,
  `version` int(10) unsigned not null,
  primary key(`id`),
  key(`table`)
);

drop table if exists `_app-db_touches`;
create table `_app-db_touches` (
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
  key(`timestamp`),
  key(`table`),
  key(`set`),
  key(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table if exists `_app-tpl_touches`;
create table `_app-tpl_touches` (
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
  key(`timestamp`),
  key(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

drop table if exists `_app-cm_touches`;
create table `_app-cm_touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("call"),
  `controller` varchar(64) not null,
  `method` varchar(64) null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  key(`timestamp`),
  key(`controller`),
  key(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-tpl_rights`;
CREATE TABLE `_app-tpl_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `div` varchar(255) DEFAULT NULL,
  primary key(`id`),
  key(`_app`),
  key(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_app-tpl_right`;
CREATE TABLE `_app-tpl_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-tpl_right` int(10) unsigned NOT NULL,
  `_group` int(10) UNSIGNED NOT NULL,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `right_display` tinyint(1) NOT NULL,
  `right_iput` tinyint(1) NOT NULL,
  primary key(`id`),
  key(`_app-tpl_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-db_rights`;
CREATE TABLE `_app-db_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `set` int(11) DEFAULT NULL,
  `field` varchar(64) DEFAULT NULL,
  primary key(`id`),
  key(`_app`),
  key(`table`),
  key(`set`),
  key(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_app-db_right`;
CREATE TABLE `_app-db_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-db_right` int(10) unsigned not null,
  `_group` int(10) UNSIGNED NOT NULL,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `right_create` tinyint(1) NOT NULL,
  `right_read` tinyint(1) NOT NULL,
  `right_update` tinyint(1) NOT NULL,
  `right_delete` tinyint(1) NOT NULL,
  primary key(`id`),
  key(`_app-db_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_app-cm_rights`;
CREATE TABLE `_app-cm_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `controller` varchar(64) not null,
  `method` varchar(64) null,
  primary key(`id`),
  key(`_app`),
  key(`controller`),
  key(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_app-cm_right`;
CREATE TABLE `_app-cm_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-cm_right` int(10) unsigned NOT NULL,
  `_group` int(10) UNSIGNED NOT NULL,
  `_user` int(10) UNSIGNED NOT NULL,
  `right_execute` tinyint(1) NULL,
  primary key(`id`),
  key(`_app-cm_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_settings`;
CREATE TABLE `_settings` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NULL,
  `key` varchar(64) NOT NULL,
  `caption` varchar(64) NOT NULL,
  `keywords` text NULL,
  `remark` text NULL,
  primary key(`id`),
  key(`_app`),
  key(`caption`),
  key(`keywords`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `_setting`;
CREATE TABLE `_setting` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_group` int(10) UNSIGNED NULL,
  `_user` int(10) UNSIGNED NULL,
  `_setting` int(10) unsigned NOT NULL,
  `value` varchar(16) NOT NULL,
  `remark` text NULL,
  primary key(`id`),
  key(`_group`),
  key(`_user`),
  key(`_setting`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `_user-email-state`;
CREATE TABLE `_user-email-state` (
  `id` int(10) unsigned not null auto_increment,
  `_user-email` int(10) unsigned not null,
  `state` enum('waiting''pending','copied','cancelled'),
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
  `state` enum('waiting','pending','copied','cancelled'),
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
  `state` enum('waiting','pending','copied','cancelled'),
  `timestamp` datetime not null,
  `remark` text null,
  `key` varchar(64),
  primary key(`id`),
  key(`_user-hash`)
);
