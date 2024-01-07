DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`title` varchar(64) NOT NULL,
	`internal-caption` varchar(255) NOT NULL,
	`internal-remark` text NULL,
	primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
