DROP TABLE IF EXISTS `_app-db_right`;
CREATE TABLE `_app-db_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-db_right` int(10) unsigned not null,
  `_group` int(10) UNSIGNED NOT NULL,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `right_create` tinyint(1) NOT NULL,
  `right_read` tinyint(1) NOT NULL,
  `right_update` tinyint(1) NOT NULL,
  `right_delete` tinyint(1) NOT NULL,
  primary key(`id`),
  key(`_app-db_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
