DROP TABLE IF EXISTS `_user-hash-state`;
CREATE TABLE `_user-hash-state` (
  `id` int(10) unsigned not null auto_increment,
  `_user-hash` int(10) unsigned not null,
  `state` enum('waiting','pending','copied','cancelled'),
  `timestamp` datetime not null,
  `remark` text null,
  `key` varchar(64),
  primary key(`id`),
  key(`_user-hash`)
);
