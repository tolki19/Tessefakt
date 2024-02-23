DROP TABLE IF EXISTS `midwives-cds-states`;
CREATE TABLE `midwives-cds-states` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`midwife-cd` int(10) unsigned not NULL,
	`state` enum("public","internal","management","secret") not null,
	`from` date NULL,
	`till` date NULL,
	`internal-remark` text null,
	primary key(`id`),
	key(`midwife-cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
