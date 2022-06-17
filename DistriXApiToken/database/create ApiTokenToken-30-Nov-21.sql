DROP TABLE IF EXISTS `apitokentoken`;
CREATE TABLE `apitokentoken` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenclient` int unsigned NOT NULL,
  `token` varchar(80) NOT NULL,
  `tokendate` int unsigned NOT NULL,
  `tokentime` int unsigned NOT NULL,
  `keyused` varchar(80) NOT NULL,
  `tokennbuse` tinyint NOT NULL DEFAULT 0,
  `timestamp` int unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`,`timestamp`),
  UNIQUE KEY `idapitokenclient` (`idapitokenclient`, `token`)
) ENGINE=InnoDB COMMENT='Api Token Client Tokens' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV    : DONE
-- DEV Nico    : 
