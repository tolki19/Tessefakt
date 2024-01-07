DROP TABLE IF EXISTS `practice-midwives`;
CREATE TABLE `practice-midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`practice` int(10) unsigned not NULL,
	`midwife` int(10) unsigned not NULL,
	`from` date NULL,
	`till` date NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`practice`),
	key(`midwife`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
