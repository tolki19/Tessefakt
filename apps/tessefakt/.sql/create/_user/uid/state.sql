DROP TABLE IF EXISTS `_user-uid-state`;
CREATE TABLE `_user-uid-state` (
	`id` int(10) unsigned not null auto_increment,
	`_user-uid` int(10) unsigned not null,
	`state` enum('waiting','pending','copied','cancelled'),
	`timestamp` datetime not null,
	`remark` text null,
	`key` varchar(64),
	primary key(`id`),
	key(`_user-uid`)
);
