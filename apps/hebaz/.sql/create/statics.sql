DROP TABLE IF EXISTS `statics`;
CREATE TABLE `statics` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`content` text NOT NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`keystring`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
