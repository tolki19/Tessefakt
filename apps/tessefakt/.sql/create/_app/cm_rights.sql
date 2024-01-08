DROP TABLE IF EXISTS `_app-cm_rights`;
CREATE TABLE `_app-cm_rights` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_app` int(10) unsigned NOT NULL,
	`_group` int(10) UNSIGNED NULL,
	`_user` int(10) UNSIGNED NULL,
	`controller` varchar(64) not null,
	`method` varchar(64) null,
	`right_execute` tinyint(1) NULL,
	primary key(`id`),
	key(`_app`),
	key(`_group`),
	key(`_user`),
	key(`controller`),
	key(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
