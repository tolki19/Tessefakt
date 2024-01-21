DROP TABLE IF EXISTS `_apps-db_rights`;
CREATE TABLE `_apps-db_rights` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_app` int(10) unsigned NOT NULL,
	`_group` int(10) UNSIGNED NULL,
	`_user` int(10) UNSIGNED NULL,
	`table` varchar(64) NOT NULL,
	`set` int(11) unsigned NULL,
	`field` varchar(64) NULL,
	`right_create` tinyint(1) NULL,
	`right_read` tinyint(1) NULL,
	`right_update` tinyint(1) NULL,
	`right_delete` tinyint(1) NULL,	primary key(`id`),
	`remark` text null,
	key(`_app`),
	key(`_group`),
	key(`_user`),
	key(`table`),
	key(`set`),
	key(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
