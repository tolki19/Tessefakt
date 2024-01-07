DROP TABLE IF EXISTS `_app-db_rights`;
CREATE TABLE `_app-db_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(64) NOT NULL,
  `set` int(11) unsigned NULL,
  `field` varchar(64) NULL,
  primary key(`id`),
  key(`_app`),
  key(`table`),
  key(`set`),
  key(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
