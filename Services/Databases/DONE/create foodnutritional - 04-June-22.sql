DROP TABLE IF EXISTS `foodnutritional`;
CREATE TABLE `foodnutritional` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idnutritional` int unsigned NOT NULL,
  `idweighttype` int unsigned NOT NULL,
  `idweighttypebase` int unsigned NOT NULL,
  `nutritional` float(4) unsigned NOT NULL,
  `weighttypebase` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indnutritional` (`idnutritional`),
  -- UNIQUE KEY `indfoodnutritionalunique` (`idfood`,`idnutritional`,`nutritional`,`idweighttypebase`) USING BTREE    A valider avec Nico. Dev2 04-June-22
  UNIQUE KEY `indfoodnutritionalunique` (`idfood`,`idnutritional`,`idweighttypebase`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Nutritional' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodnutritional(id,idfood,idnutritional,nutritional,idweighttype,weighttypebase,idweighttypebase,elemstate,timestamp) VALUES 
(1,1,6,0.021,2,100,7,0,0),
(2,1,8,100,4,100,7,0,0),
(3,1,9,2.6,3,100,7,0,0),
(4,1,10,3.3,3,100,7,0,0),
(5,1,11,1.9,3,100,7,0,0),
(6,1,12,2.2,3,100,7,0,0),
(7,1,13,2.6,3,100,7,0,0),
(8,1,14,2.6,3,100,7,0,0),
(9,1,15,0.1,3,100,7,0,0),
(10,1,16,1.9,3,100,7,0,0),
(11,1,18,2,3,100,7,0,0),
(12,1,19,6,3,100,7,0,0),
(13,2,1,1962,13,100,2,0,0),
(14,2,2,17.6,2,100,2,0,0),
(15,2,3,69,2,100,2,0,0),
(16,2,20,32.6,2,100,2,0,0),
(17,2,4,6,2,100,2,0,0),
(18,2,6.3,6,2,100,2,0,0),
(19,2,0,49,2,100,2,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE