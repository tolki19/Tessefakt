DROP TABLE IF EXISTS `applications-midwives`;
CREATE TABLE `applications-midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`application` int(10) unsigned not NULL,
	`midwife` int(10) unsigned not NULL,
	`bid-date` date not NULL,
	`award-date` date not NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`application`),
	key(`midwife`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
