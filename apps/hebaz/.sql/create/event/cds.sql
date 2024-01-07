DROP TABLE IF EXISTS `event-cds`;
CREATE TABLE `event-cds` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`event` int(10) unsigned not NULL,
	`cd` int(10) unsigned not NULL,
	`date` varchar(255) NOT NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`event`),
	key(`cd`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
