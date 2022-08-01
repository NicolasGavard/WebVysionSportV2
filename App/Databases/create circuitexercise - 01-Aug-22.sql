DROP TABLE IF EXISTS `circuitexercise`;
CREATE TABLE `circuitexercise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idcircuittemplate` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`idcircuittemplate`) USING BTREE
) ENGINE=InnoDB COMMENT='Circuit Exercises' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO circuitexercise(id,idcircuittemplate,elemstate,timestamp) VALUES 
(1,'1',0,0),
(2,'2',0,0),
(3,'3',0,0),
(4,'4',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE