DROP TABLE IF EXISTS `events-dates`;
CREATE TABLE `events-dates` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`event` int(10) unsigned not NULL,
	`from` datetime NULL,
	`till` datetime NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
