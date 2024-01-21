DROP TABLE IF EXISTS `events-rights`;
CREATE TABLE `events-rights` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`event` int(10) unsigned not NULL,
	`_group` int(10) unsigned NULL,
	`_user` int(10) unsigned NULL,
	`from` date NULL,
	`till` date NULL,
	`internal-remark` text NULL,
	`right_create` tinyint(1) NULL,
	`right_read` tinyint(1) NULL,
	`right_update` tinyint(1) NULL,
	`right_delete` tinyint(1) NULL,
	primary key(`id`),
	key(`event`),
	key(`_group`),
	key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
