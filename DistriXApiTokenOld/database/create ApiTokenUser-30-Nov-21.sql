DROP TABLE IF EXISTS `apitokenuser`;
CREATE TABLE `apitokenuser` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `pass` varchar(20) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `emailbackup` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(20) NOT NULL DEFAULT '',
  `mobile` varchar(20) NOT NULL DEFAULT '',
  `initpass` tinyint unsigned NOT NULL DEFAULT 1,
  `idlanguage` int unsigned NOT NULL DEFAULT 1,
  `idapitokenenterprise` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `indlogin` (`login`),
  KEY `idapienterprise` (`idapitokenenterprise`)
) ENGINE=InnoDB COMMENT='Api Token Users' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV Yvan    : DONE
-- DEV Nico    : DONE
