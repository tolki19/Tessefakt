DROP TABLE IF EXISTS `_groups`;
CREATE TABLE `_groups` (
  `id` int(10) UNSIGNED NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  primary key(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
