DROP TABLE IF EXISTS `_users-_groups`;
CREATE TABLE `_users-_groups` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_user` int(10) UNSIGNED NULL,
	`_group` int(10) UNSIGNED NULL,
	`valid_from` date not null,
	`valid_till` date null,
	primary key(`id`),
	key(`_user`),
	key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
