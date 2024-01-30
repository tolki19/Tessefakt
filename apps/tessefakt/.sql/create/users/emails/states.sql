DROP TABLE IF EXISTS `_users-emails-state`;
CREATE TABLE `_users-emails-state` (
	`id` int(10) unsigned not null auto_increment,
	`_users-email` int(10) unsigned not null,
	`state` enum('queued','pending','ok','cancelled'),
	`timestamp` datetime not null,
	`remark` text null,
	`key` varchar(64),
	primary key(`id`),
	key(`_users-email`)
);
