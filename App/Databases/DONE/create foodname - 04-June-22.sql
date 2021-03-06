DROP TABLE IF EXISTS `foodname`;
CREATE TABLE `foodname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indfoodunique` (`idfood`, `idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodname(id,idfood,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Eaux de sources',0,0),
(2,2,1,'Prince Chocolat',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE