DROP TABLE IF EXISTS `_app-tpl_right`;
CREATE TABLE `_app-tpl_right` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app-tpl_right` int(10) unsigned NOT NULL,
  `_group` int(10) UNSIGNED NOT NULL,
  `_user` int(10) UNSIGNED NOT NULL,
  `_app` int(10) unsigned NOT NULL,
  `right_display` tinyint(1) NOT NULL,
  `right_iput` tinyint(1) NOT NULL,
  primary key(`id`),
  key(`_app-tpl_right`),
  key(`_group`),
  key(`_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;