DROP TABLE IF EXISTS `cds`;
CREATE TABLE `cds` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`sort` int(10) unsigned NOT NULL,
	`name` varchar(255) NOT NULL,
	`keystring` varchar(255) NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	index(`keystring`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
/* street, zip, region, land, mobile, email, www */