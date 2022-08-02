DROP TABLE IF EXISTS `dietmeal`;
CREATE TABLE `dietmeal` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iddiet` int unsigned NOT NULL,
  `iddietrecipe` int unsigned NOT NULL,
  `daynumber` int unsigned NOT NULL,
  `idmealtype` int unsigned NOT NULL,
  `weight` int unsigned NOT NULL,
  `idweighttype` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inddiet` (`iddiet`),
  KEY `inddiettrecipe` (`iddietrecipe`),
  KEY `indidmealtype` (`idmealtype`),
  UNIQUE KEY `inddietunique` (`iddiet`,`iddietrecipe`,`daynumber`,`idmealtype`) USING BTREE
) ENGINE=InnoDB COMMENT='Diets meals' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO dietmeal(id,iddiet,iddietrecipe,daynumber,idmealtype,weight,idweighttype,elemstate,timestamp) VALUES 
(1,1,1,1,1,100,2,0,0),
(2,1,1,1,2,100,2,0,0),
(3,1,1,1,3,100,2,0,0),
(4,1,1,1,4,100,2,0,0),
(5,1,1,2,1,100,2,0,0),
(6,1,1,2,2,100,2,0,0),
(7,1,1,2,3,100,2,0,0),
(8,1,1,2,4,100,2,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE