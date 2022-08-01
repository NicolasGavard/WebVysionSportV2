DROP TABLE IF EXISTS `apitokenapplicationname`;
CREATE TABLE `apitokenapplicationname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idapitokenapplication` int unsigned NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `statut` tinyint unsigned NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indapplicationname` (`idapitokenapplication`,`idcountry`,`idlanguage`)
) ENGINE=InnoDB COMMENT='Api Token Application Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  : 
-- VALIDATION  : 
-- VERIFICATION: 
-- INTEGRATION : 
-- DEV    : DONE
-- DEV Nico    : DONE
