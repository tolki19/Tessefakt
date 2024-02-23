DROP TABLE IF EXISTS `_users-hashes-state`;
CREATE TABLE `_users-hashes-state` (
	`id` int(10) unsigned not null auto_increment,
	`_users-hash` int(10) unsigned not null,
	`state` enum('queued','pending','ok','cancelled','test'),
	`timestamp` datetime not null,
	`remark` text null,
	`key` varchar(64),
	primary key(`id`),
	key(`_users-hash`)
);
