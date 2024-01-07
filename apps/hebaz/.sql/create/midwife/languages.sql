DROP TABLE IF EXISTS `midwife-languages`;
CREATE TABLE `midwife-languages` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`midwife` int(10) unsigned not NULL,
	`language` int(10) unsigned not NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`midwife`),
	key(`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
