drop table if exists `_app-db_touches`;
create table `_app-db_touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("create","read","update","delete"),
  `table` varchar(64) not null,
  `set` int(10) unsigned default null,
  `field` varchar(64) default null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  key(`timestamp`),
  key(`table`),
  key(`set`),
  key(`field`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
