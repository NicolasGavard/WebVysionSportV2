DROP TABLE IF EXISTS `apitokenclient`;
CREATE TABLE `apitokenclient` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenenterprise` int unsigned NOT NULL,
  `idapitokenuser` int unsigned NOT NULL,
  `idapitokenapplication` int unsigned NOT NULL,
  `clientid` varchar(40) NOT NULL,
  `secretkey` varchar(80) NOT NULL,
  `publickey` varchar(80) NOT NULL,
  `testkey` varchar(80) NOT NULL,
  `tokendurationsecond` tinyint unsigned NOT NULL,
  `tokendurationnbcallmax` tinyint unsigned NOT NULL DEFAULT 0,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indenterpriseuserapp` (`idapitokenenterprise`,`idapitokenuser`,`idapitokenapplication`)
) ENGINE=InnoDB COMMENT='Api Token Clients' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV Yvan    : DONE
-- DEV Nico    : DONE
