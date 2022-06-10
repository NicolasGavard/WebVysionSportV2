DROP TABLE IF EXISTS `apitokenfunctionality`;
CREATE TABLE `apitokenfunctionality` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenmodule` int unsigned NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `statut` tinyint unsigned NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indmodulecode` (`idapitokenmodule`,`code`)
) ENGINE=InnoDB COMMENT='Api Token Module Functionalities' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV Yvan    : DONE
-- DEV Nico    : DONE
