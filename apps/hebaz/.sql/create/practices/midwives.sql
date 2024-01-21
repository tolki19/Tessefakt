DROP TABLE IF EXISTS `practices-midwives`;
CREATE TABLE `practices-midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`practice` int(10) unsigned not NULL,
	`midwife` int(10) unsigned not NULL,
	`from` date NULL,
	`till` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`practice`),
	key(`midwife`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";