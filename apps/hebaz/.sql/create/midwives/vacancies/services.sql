DROP TABLE IF EXISTS `midwives-vacancies-services`;
CREATE TABLE `midwives-vacancies-services` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`midwives-vacancy` int(10) unsigned not NULL,
	`service` int(10) unsigned not NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`midwives-vacancy`),
	key(`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
