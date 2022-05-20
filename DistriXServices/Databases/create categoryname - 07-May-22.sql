DROP TABLE IF EXISTS `categoryname`;
CREATE TABLE `categoryname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcategory` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcategory` (`idcategory`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indcategorylanguage` (`idcategory`, `idlanguage`),
  UNIQUE KEY `indcategoryunique` (`idcategory`) USING BTREE
) ENGINE=InnoDB COMMENT='Category Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO categoryname(id,idcategory,idlanguage,name,statut,timestamp) VALUES 
(1,1,1,'Eaux',0,0),
(2,2,1,'Eaux de sources',0,0),
(3,3,1,'Eaux minérales',0,0),
(4,4,1,'Snacks',0,0),
(5,5,1,'Snacks sucrés',0,0),
(6,6,1,'Biscuits et gâteaux',0,0),
(7,7,1,'Biscuits',0,0),
(8,8,1,'Biscuits au chocolat',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE