DROP TABLE IF EXISTS `_users-hashes`;
CREATE TABLE `_users-hashes` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_user` int(10) UNSIGNED not NULL,
	`type` varchar(255) NOT NULL,
	`hash` varchar(255) not NULL,
	`valid_from` date not null,
	`valid_till` date null,
	primary key(`id`),
	key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
