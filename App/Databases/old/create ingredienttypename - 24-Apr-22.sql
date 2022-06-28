DROP TABLE IF EXISTS `ingredienttypename`;
CREATE TABLE `ingredienttypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idingredienttype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indingredienttype` (`idingredienttype`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indingredienttypelanguage` (`idingredienttype`,`idlanguage`),
  UNIQUE KEY `indingredienttypelanguageunique` (`idingredienttype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Types Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredienttypename(id,idingredienttype,idlanguage,name,elemstate,timestamp) VALUES
(1,1,1,'Choux',0,0),
(2,2,1,'Légumes feuilles',0,0),
(3,3,1,'Champignons',0,0),
(4,4,1,'Aromatiques fraîches',0,0),
(5,5,1,'Légumes racines, tubercules et tiges',0,0),
(6,6,1,'Courges',0,0),
(7,7,1,'Salades',0,0),
(8,8,1,'Légumes exotiques',0,0),
(9,9,1,'Haricots, pois, légumes secs, graines germées',0,0),
(10,10,1,'Légumes fruits',0,0),
(11,11,1,'Fruits exotiques et tropicaux',0,0),
(12,12,1,'Petits fruits et fruits rouges',0,0),
(13,13,1,'Fruits sauvages',0,0),
(14,14,1,'Fruits de plantes grimpantes',0,0),
(15,15,1,'Fruits à pépins',0,0),
(16,16,1,'Fruits à noyaux',0,0),
(17,17,1,'Fruits à coque',0,0),
(18,18,1,'Autres fruits',0,0),
(19,19,1,'Agrume',0,0),
(20,20,1,'Fleurs comestibles',0,0),
(21,21,1,'Viandes rouges',0,0),
(22,22,1,'Viandes blanches',0,0),
(23,23,1,'Viandes noires',0,0),
(24,24,1,'Viandes séchée',0,0),
(25,25,1,'Viandes de brousse',0,0),
(26,26,1,"Poissons d'eau douce",0,0),
(27,27,1,'Poissons de la mer',0,0),
(28,28,1,'Crustacés',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE