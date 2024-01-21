DROP TABLE IF EXISTS `midwives-occupancies-midwives`;
CREATE TABLE `midwives-occupancies-midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`midwives-occupancy` int(10) unsigned not NULL,
	`midwife` int(10) unsigned not NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`midwives-occupancy`),
	key(`midwife`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
