DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`language` int(10) unsigned NOT NULL,
	`sort` int(10) unsigned NOT NULL,
	`name` varchar(255) NOT NULL,
	`keywords` text NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
