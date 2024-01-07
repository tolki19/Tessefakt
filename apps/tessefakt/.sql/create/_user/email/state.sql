DROP TABLE IF EXISTS `_user-email-state`;
CREATE TABLE `_user-email-state` (
	`id` int(10) unsigned not null auto_increment,
	`_user-email` int(10) unsigned not null,
	`state` enum('waiting''pending','copied','cancelled'),
	`timestamp` datetime not null,
	`remark` text null,
	`key` varchar(64),
	primary key(`id`),
	key(`_user-email`)
);
