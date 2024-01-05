DROP TABLE IF EXISTS `_app-tpl_rights`;
CREATE TABLE `_app-tpl_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `tpl` varchar(255) NOT NULL,
  `div` varchar(255) DEFAULT NULL,
  primary key(`id`),
  key(`_app`),
  key(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
