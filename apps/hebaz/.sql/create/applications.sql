DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
	`id` int(10) unsigned NOT NULL auto_increment,
	`first_name` varchar(255) NOT NULL,
	`last_name` varchar(255) NOT NULL,
	`birthdate` date NOT NULL,
	`deliverydate` date NULL,
	`public-remark` text NULL,
	`agreement-gtoc` date NOT NULL,
	`agreement-gdpr` date NOT NULL,
	`agreement-email` date NULL,
	`withdrawal-gtoc` date NULL,
	`withdrawal-gdpr` date NULL,
	`withdrawal-email` date NULL,
	`public-remark` text NULL,
	`internal-remark` text NULL,
	primary key(`id`),
	key(`keystring`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4-unicode-ci comment="tessefakt_13.0-hebaz_5.0";
