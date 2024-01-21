drop table if exists `_apps-tpl_touches`;
create table `_apps-tpl_touches` (
	`id` int(10) UNSIGNED NOT NULL auto_increment,
	`_app` int(10) unsigned NOT NULL,
	`__user` int(10) UNSIGNED NULL,
	`timestamp` datetime not null,
	`touch` enum("create","read","update","delete"),
	`tpl` varchar(64) not null,
	`div` varchar(64) null,
	`remark` text null,
	primary key(`id`),
	key(`_app`),
	key(`__user`),
	key(`timestamp`),
	key(`tpl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci comment="tessefakt_13.0-tessefakt_13.0";
