DROP TABLE IF EXISTS `page-statics`;
CREATE TABLE `page-statics` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`page` int(10) unsigned NOT NULL,
	`static` int(10) unsigned NOT NULL,
	`sort` int(10) unsigned NOT NULL,
	`from` date NULL,
	`till` date NULL,
	`internal-caption` varchar(255) NOT NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`page`),
	key(`static`),
	key(`sort`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-hebaz_5.0";
