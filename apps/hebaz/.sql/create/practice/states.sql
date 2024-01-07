DROP TABLE IF EXISTS `practice-states`;
CREATE TABLE `practice-states` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`practice` int(10) unsigned not NULL,
	`state` enum("public","internal","secret") not null,
	`from` date NULL,
	`till` date NULL,
	primary key(`id`),
	key(`practice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
