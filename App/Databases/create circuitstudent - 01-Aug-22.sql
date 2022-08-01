DROP TABLE IF EXISTS `circuitstudent`;
CREATE TABLE `circuitstudent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iduserstudent` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcircuitstudent` (`iduserstudent`,`datestart`) USING BTREE
) ENGINE=InnoDB COMMENT='Circuit Exercises' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO circuitstudent(id,iduserstudent,datestart,elemstate,timestamp) VALUES 
(1,'1',20220805,0,0),
(2,'2',20220805,0,0),
(3,'3',20220805,0,0),
(4,'4',20220805,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE