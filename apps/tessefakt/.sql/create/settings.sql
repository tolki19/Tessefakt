DROP TABLE IF EXISTS `_settings`;
CREATE TABLE `_settings` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_app` int(10) unsigned NULL,
	`_group` int(10) UNSIGNED NULL,
	`_user` int(10) UNSIGNED NULL,
	`key` varchar(64) NOT NULL,
	`caption` varchar(64) NOT NULL,
	`keywords` text NULL,
	`value` varchar(16) NOT NULL,
	`remark` text NULL,
	primary key(`id`),
	key(`_app`),
	key(`caption`),
	key(`keywords`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";