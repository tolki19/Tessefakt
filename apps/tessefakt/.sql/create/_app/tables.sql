drop table if exists `_app-tables`;
create table `_app-tables` (
  `id` int(10) unsigned not null auto_increment,
  `_app` int(10) unsigned NOT NULL,
  `table` varchar(128) not null,
  `state` enum("active","inactive") not null,
  `version` int(10) unsigned not null,
  primary key(`id`),
  key(`table`)
);
