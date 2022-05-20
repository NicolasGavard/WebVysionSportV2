DROP TABLE IF EXISTS `recipename`;
CREATE TABLE `recipename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indrecipe` (`idrecipe`),
  KEY `indrecipelanguage` (`idrecipe`,`idlanguage`),
  UNIQUE KEY `indrecipelanguageunique` (`idrecipe`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Recipes Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE