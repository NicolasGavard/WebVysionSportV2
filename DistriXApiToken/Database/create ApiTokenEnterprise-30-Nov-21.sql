DROP TABLE IF EXISTS `apitokenenterprise`;
CREATE TABLE `apitokenenterprise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `co` varchar(80) NOT NULL,
  `street` varchar(80) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(60) NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indcode` (`code`),
  KEY `indname` (`name`)
) ENGINE=InnoDB COMMENT='API Token Enterprises' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV Dev2    : DONE
-- DEV Nico    : DONE
