DROP TABLE IF EXISTS `recipeingredient`;
CREATE TABLE `recipeingredient` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int unsigned NOT NULL,
  `idingredient` int unsigned NOT NULL,
  `weight` int unsigned NOT NULL,
  `calorie` int unsigned NOT NULL,
  `proetin` int unsigned NOT NULL,
  `glucide` int unsigned NOT NULL,
  `lipid` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indrecipe` (`idrecipe`),
  KEY `indingredient` (`idingredient`),
  KEY `indrecipeingredient` (`idrecipe`,`idingredient`),
  UNIQUE KEY `indrecipeingredientunique` (`idrecipe`,`idingredient`) USING BTREE
) ENGINE=InnoDB COMMENT='Recipes Ingredients' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE