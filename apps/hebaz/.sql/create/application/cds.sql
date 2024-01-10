DROP TABLE IF EXISTS `application-cds`;
CREATE TABLE `application-cds` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`application` int(10) unsigned not NULL,
	`cd` int(10) unsigned not NULL,
	`sort` int(10) unsigned not NULL,
	`date` varchar(255) NOT NULL,
	`from` date NULL,
	`till` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`application`),
	key(`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
