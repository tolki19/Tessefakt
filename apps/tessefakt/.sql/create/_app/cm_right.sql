DROP TABLE IF EXISTS `_app-cm_right`;
CREATE TABLE `_app-cm_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-cm_right` int(10) unsigned NOT NULL,
  `_group` int(10) UNSIGNED NULL,
  `_user` int(10) UNSIGNED NULL,
  `right_execute` tinyint(1) NULL,
  primary key(`id`),
  key(`_app-cm_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
