DROP TABLE IF EXISTS `event-dates`;
CREATE TABLE `event-dates` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`event` int(10) unsigned not NULL,
	`datetime` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
