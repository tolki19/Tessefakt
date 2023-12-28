DROP TABLE IF EXISTS `_app-cm_rights`;
CREATE TABLE `_app-cm_rights` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `controller` varchar(64) not null,
  `method` varchar(64) null,
  primary key(`id`),
  key(`_app`),
  key(`controller`),
  key(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
