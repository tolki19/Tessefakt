DROP TABLE IF EXISTS `navigations`;
CREATE TABLE `navigations` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`keystring` varchar(255) NOT NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
