DROP TABLE IF EXISTS `circuittypename`;
CREATE TABLE `circuittypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcircuittype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indcircuittypeunique` (`idcircuittype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Circuit Type Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO circuittypename(id,idcircuittype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Biset',0,0),
(2,2,1,'Triset',0,0),
(3,3,1,'Tabata',0,0),
(4,1,2,'Biset',0,0),
(5,2,2,'Triset',0,0),
(6,3,2,'Tabata',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE