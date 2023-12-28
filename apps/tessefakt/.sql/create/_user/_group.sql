DROP TABLE IF EXISTS `_user-_group`;
CREATE TABLE `_user-_group` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `_group` int(10) UNSIGNED DEFAULT NULL,
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`),
  key(`_group`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
