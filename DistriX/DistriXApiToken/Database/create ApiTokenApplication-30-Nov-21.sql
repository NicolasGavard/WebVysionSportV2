DROP TABLE IF EXISTS `apitokenapplication`;
CREATE TABLE `apitokenapplication` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenenterprise` int unsigned NOT NULL DEFAULT 0,
  `code` varchar(40) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `statut` tinyint unsigned NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indcode` (`code`),
  KEY `idapitokenenterprise` (`idapitokenenterprise`)
) ENGINE=InnoDB COMMENT='Api Token Enterprise Applications' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  : 
-- VALIDATION  : 
-- VERIFICATION: 
-- INTEGRATION : 
-- DEV    : DONE
-- DEV Nico    : DONE
