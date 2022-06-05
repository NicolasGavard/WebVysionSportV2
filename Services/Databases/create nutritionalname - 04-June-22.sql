DROP TABLE IF EXISTS `nutritionalname`;
CREATE TABLE `nutritionalname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idnutritional` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indnutritionalunique` (`idnutritional`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Nutritional Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO nutritionalname(id,idnutritional,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Énergie',0,0),
(2,2,1,'Matières grasses',0,0),
(3,3,1,'Glucides',0,0),
(4,4,1,'Fibres alimentaires',0,0),
(5,5,1,'Protéines',0,0),
(6,6,1,'Sel',0,0),
(7,7,1,'Alcool',0,0),
(8,8,1,'Biotine - Vitamine B8',0,0),
(9,9,1,'Silice',0,0),
(10,10,1,'Bicarbonate',0,0),
(11,11,1,'Potassium',0,0),
(12,12,1,'Chlorure',0,0),
(13,13,1,'Calcium',0,0),
(14,14,1,'Magnésium',0,0),
(15,15,1,'Fluorure',0,0),
(16,16,1,'Caféine',0,0),
(17,17,1,'Fruits‚ légumes‚ noix et huiles de colza‚ noix et olive',0,0),
(18,18,1,'Nitrate',0,0),
(19,19,1,'Sulfate',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE