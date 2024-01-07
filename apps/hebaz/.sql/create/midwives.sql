DROP TABLE IF EXISTS `midwives`;
CREATE TABLE `midwives` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
