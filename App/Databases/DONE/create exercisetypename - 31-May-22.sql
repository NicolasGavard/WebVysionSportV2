DROP TABLE IF EXISTS `exercisetypename`;
CREATE TABLE `exercisetypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idexercisetype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indexercisetypeunique` (`idexercisetype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Exercise Type Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO exercisetypename(id,idexercisetype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,"Exercice cardiovasculaire",0,0),
(2,2,1,"Exercice de musculation",0,0),
(3,3,1,"Exercice d'Endurance",0,0),
(4,4,1,"Exercice d'équilibre",0,0),
(5,5,1,"Exercice d'étirement",0,0),
(6,6,1,"Exercice mentale",0,0),
(7,1,2,"Cardiovascular exercise",0,0),
(8,2,2,"Strength Training Exercise",0,0),
(9,3,2,"Endurance exercise",0,0),
(10,4,2,"Balance exercise",0,0),
(11,5,2,"Stretching Exercise",0,0),
(12,6,2,"Mental Exercise",0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE