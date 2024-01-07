DROP TABLE IF EXISTS `application-states`;
CREATE TABLE `application-states` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`application` int(10) unsigned not NULL,
	`state` enum("public","internal","secret") not null,
	`from` date NULL,
	`till` date NULL,
	primary key(`id`),
	key(`application`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";