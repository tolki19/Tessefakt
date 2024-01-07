DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`from` date NULL,
	`till` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	`free-place` int(11) NULL,
	primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
