drop table if exists `_apps`;
create table `_apps` (
  `id` int(10) unsigned not null auto_increment,
  `key` varchar(64) not null,
  `name` varchar(64) not null,
  `major` varchar(8) not null,
  `minor` varchar(8) not null,
  `build` varchar(8) not null,
  `caption` varchar(8) not null,
  primary key(`id`),
  key(`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
