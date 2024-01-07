DROP TABLE IF EXISTS `cds`;
CREATE TABLE `cds` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`sort` int(10) unsigned NOT NULL,
	`name` varchar(255) NOT NULL,
	`public-caption` varchar(255) NULL,
	`public-remark` text NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
/* street, zip, region, land, mobile, email, www */