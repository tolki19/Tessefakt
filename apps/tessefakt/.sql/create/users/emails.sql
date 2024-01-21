DROP TABLE IF EXISTS `_users-emails`;
CREATE TABLE `_users-emails` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_user` int(10) UNSIGNED not NULL,
	`email` varchar(255) NOT NULL,
	`sort` int(10) not null,
	`valid_from` date not null,
	`valid_till` date null,
	primary key(`id`),
	key(`_user`),
	key(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";