drop table if exists `_apps-tables`;
create table `_apps-tables` (
	`id` int(10) unsigned not null auto_increment,
	`_app` int(10) unsigned NOT NULL,
	`table` varchar(128) not null,
	`state` enum("active","inactive") not null,
	`version` int(10) unsigned not null,
	primary key(`id`),
	key(`table`)
);
