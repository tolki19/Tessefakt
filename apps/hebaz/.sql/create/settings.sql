DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`keystring` varchar(255) NOT NULL,
	`date` varchar(255) NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`keystring`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
