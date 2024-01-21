DROP TABLE IF EXISTS `events-states`;
CREATE TABLE `events-states` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`event` int(10) unsigned not NULL,
	`state` enum("public","internal","secret") not null,
	`from` date NULL,
	`till` date NULL,
	`internal-remark` text null,
	primary key(`id`),
	key(`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
