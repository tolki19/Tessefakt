DROP TABLE IF EXISTS `_user-emails`;
CREATE TABLE `_user-emails` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_user` int(10) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `order` int(10) not null default 0,
  `valid_from` date not null,
  `valid_till` date default null,
  primary key(`id`),
  key(`_user`),
  key(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;