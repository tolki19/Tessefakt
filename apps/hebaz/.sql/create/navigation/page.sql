DROP TABLE IF EXISTS `navigation-page`;
CREATE TABLE `navigation-page` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`navigation` int(10) unsigned NOT NULL,
	`sort` int(10) unsigned NOT NULL,
	`type` enum('homepage','page','midwives','events','caption') NOT NULL,
	`page` int(10) unsigned not NULL,
	`auto-speaking-url` tinyint(1) NOT NULL,
	`speaking-url` varchar(255) NULL,
	`auto-home` tinyint(1) NOT NULL,
	`public-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`navigation`),
	key(`sort`),
	key(`speaking-url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
