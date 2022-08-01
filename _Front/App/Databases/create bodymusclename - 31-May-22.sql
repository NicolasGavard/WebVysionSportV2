DROP TABLE IF EXISTS `bodymusclename`;
CREATE TABLE `bodymusclename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbodymuscle` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indbodymuscleunique` (`idbodymuscle`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Body Muscles Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO bodymusclename(id,idbodymuscle,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Masséter',0,0),
(2,2,1,'Zygomatique',0,0),
(3,3,1,'Occipito des lèvres',0,0),
(4,4,1,'Corugator',0,0),
(5,5,1,'Trapèze',0,0),
(6,6,1,'Grand dorsal',0,0),
(7,7,1,'Muscles intercostaux',0,0),
(8,8,1,'Muscle carré des lombes',0,0),
(9,9,1,'Muscles érecteurs du rachis',0,0),
(10,10,1,'Le grand pectoral',0,0),
(11,11,1,'Deltoïdes',0,0),
(12,12,1,'Biceps',0,0),
(13,13,1,'Triceps',0,0),
(14,14,1,'Biceps brachial',0,0),
(15,15,1,'Brachial antérieur',0,0),
(16,16,1,'Triceps brachial',0,0),
(17,17,1,'Long soupinateur',0,0),
(18,18,1,'Grand palmaire',0,0),
(19,19,1,'Cubital antérieur',0,0),
(20,20,1,'Muscle thénarien',0,0),
(21,21,1,'Muscles des doigts',0,0),
(22,22,1,'Les fessiers',0,0),
(23,23,1,'Les abducteurs',0,0),
(24,24,1,'Les adducteurs',0,0),
(25,25,1,'Muscles antérieurs',0,0),
(26,26,1,'Moyens adducteur',0,0),
(27,27,1,'Quadriceps',0,0),
(28,28,1,'Ischio-jambiers',0,0),
(29,29,1,'Jambier antérieur',0,0),
(30,30,1,'Jumeaux externe',0,0),
(31,31,1,'Jumeaux interne',0,0),
(32,32,1,'Soléaire',0,0),
(33,33,1,'Muscles des pieds',0,0);


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE