DROP TABLE IF EXISTS `foodtypename`;
CREATE TABLE `foodtypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfoodtype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indfoodtypeunique` (`idfoodtype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Type Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodtypename(id,idfoodtype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Féculents',0,0),
(2,2,1,'Légumes',0,0),
(3,3,1,'Viande',0,0),
(4,1,2,'Starches',0,0),
(5,2,2,'Vegetables',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE