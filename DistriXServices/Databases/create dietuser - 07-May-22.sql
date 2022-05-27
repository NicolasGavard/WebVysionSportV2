DROP TABLE IF EXISTS `dietstudent`;
CREATE TABLE `dietstudent` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iddiet` int unsigned NOT NULL,
  `iduser` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inddiet` (`iddiet`),
  KEY `induser` (`iduser`),
  UNIQUE KEY `inddietunique` (`iddiet`,`iduser`) USING BTREE
) ENGINE=InnoDB COMMENT='Diets Students' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO dietstudent(id,iddiet,iduser,elemstate,timestamp) VALUES 
(1,1,1,0,0),
(2,1,2,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE