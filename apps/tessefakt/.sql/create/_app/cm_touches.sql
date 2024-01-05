drop table if exists `_app-cm_touches`;
create table `_app-cm_touches` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `__user` int(10) UNSIGNED NULL,
  `timestamp` datetime not null,
  `touch` enum("call"),
  `controller` varchar(64) not null,
  `method` varchar(64) null,
  `remark` text null,
  primary key(`id`),
  key(`_app`),
  key(`__user`),
  key(`timestamp`),
  key(`controller`),
  key(`method`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
