DROP TABLE IF EXISTS `_users-uids`;
CREATE TABLE `_users-uids` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_user` int(10) UNSIGNED NULL,
	`uid` varchar(255) NOT NULL,
	`valid_from` date not null,
	`valid_till` date null,
	primary key(`id`),
	key(`_user`),
	key(`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";