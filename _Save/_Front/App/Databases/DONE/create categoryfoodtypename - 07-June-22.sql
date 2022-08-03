DROP TABLE IF EXISTS `categoryfoodtypename`;
CREATE TABLE `categoryfoodtypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcategoryfoodtype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcategoryfoodtype` (`idcategoryfoodtype`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indcategoryfoodtypeunique` (`idcategoryfoodtype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Category Food types Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO categoryfoodtypename(id,idcategoryfoodtype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Eaux',0,0),
(2,2,1,'Eaux de sources',0,0),
(3,3,1,'Eaux minérales',0,0),
(4,4,1,'Gâteaux',0,0),
(5,5,1,'Biscuits sucrés',0,0),
(6,6,1,'Gâteaux aux biscuits',0,0),
(7,7,1,'Biscuits',0,0),
(8,8,1,'Gâteaux aux chocolats',0,0);


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE