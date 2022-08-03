DROP TABLE IF EXISTS `apitokenmodule`;
CREATE TABLE `apitokenmodule` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenapplication` int unsigned NOT NULL,
  `code` varchar(60) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `statut` tinyint unsigned NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indappcode` (`idapitokenapplication`,`code`)
) ENGINE=InnoDB COMMENT='Api Token Application Modules' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV    : DONE
-- DEV Nico    : DONE
