DROP TABLE IF EXISTS `ingredienttypefamilyname`;
CREATE TABLE `ingredienttypefamilyname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idingredienttypefamily` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indingredienttypefamily` (`idingredienttypefamily`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indingredienttypefamilylanguage` (`idingredienttypefamily`,`idlanguage`),
  UNIQUE KEY `indingredienttypefamilylanguageunique` (`idingredienttypefamily`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Types Families Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredienttypefamilyname(id,idingredienttypefamily,idlanguage,name,statut,timestamp) VALUES
(1,1,1,'Légumes',0,0),
(2,2,1,'Légumes fruits',0,0),
(3,3,1,'Fruits',0,0),
(4,4,1,'Fleurs comestibles',0,0),
(5,5,1,'Viandes',0,0),
(6,6,1,'Poissons',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE