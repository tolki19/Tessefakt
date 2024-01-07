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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
