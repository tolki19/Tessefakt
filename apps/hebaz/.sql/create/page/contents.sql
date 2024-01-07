DROP TABLE IF EXISTS `page-contents`;
CREATE TABLE `page-contents` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`page` int(10) unsigned NOT NULL,
	`sort` int(10) unsigned NOT NULL,
	`from` date NULL,
	`till` date NULL,
	`content` text NOT NULL,
	`internal-caption` varchar(255) NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`page`),
	key(`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
