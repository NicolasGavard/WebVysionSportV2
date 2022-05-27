DROP TABLE IF EXISTS `recipe`;
CREATE TABLE `recipe` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `rating` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB COMMENT='Recipes' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE