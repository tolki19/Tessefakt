DROP TABLE IF EXISTS `practices-cds`;
CREATE TABLE `practices-cds` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`practice` int(10) unsigned not NULL,
	`cd` int(10) unsigned not NULL,
	`sort` int(10) unsigned not NULL,
	`date` varchar(255) NOT NULL,
	`from` date NULL,
	`till` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`practice`),
	key(`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
