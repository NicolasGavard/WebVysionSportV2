DROP TABLE IF EXISTS `recipeuser`;
CREATE TABLE `recipeuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idstyuser` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indrecipe` (`idrecipe`),
  KEY `induser` (`idstyuser`),
  KEY `indrecipeuser` (`idrecipe`,`idstyuser`),
  UNIQUE KEY `indrecipeuserunique` (`idrecipe`,`idstyuser`) USING BTREE
) ENGINE=InnoDB COMMENT='Recipes User' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE