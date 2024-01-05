DROP TABLE IF EXISTS `_errors`;
CREATE TABLE `_errors` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `__user` int(10) UNSIGNED DEFAULT NULL,
  `timestamp` datetime not null,
  `error` text not null,
  `remark` text null,
  primary key(`id`),
  key(`__user`),
  key(`timestamp`),
  key(`error`),
  key(`remark`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
