DROP TABLE IF EXISTS `mealtypename`;
CREATE TABLE `mealtypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idmealtype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indmealtype` (`idmealtype`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indmealtypeunique` (`idmealtype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Meals types Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO mealtypename(id,idmealtype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Petit-déjeuner',0,0),
(2,2,1,'Déjeuner',0,0),
(3,3,1,'Collation',0,0),
(4,4,1,'Dîner',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE