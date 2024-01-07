DROP TABLE IF EXISTS `midwife-occupancy-midwives`;
CREATE TABLE `midwife-occupancy-midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`midwife-occupancy` int(10) unsigned not NULL,
	`midwife` int(10) unsigned not NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`midwife-occupancy`),
	key(`midwife`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
