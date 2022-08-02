DROP TABLE IF EXISTS `nutritional`;
CREATE TABLE `nutritional` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Nutritional' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO nutritional(id,code,name,elemstate,timestamp) VALUES 
(1,'ENERGIE','Énergie',0,0),
(2,'MATIERES_GRASSES','Matières grasses',0,0),
(3,'GLUCIDES','Glucides',0,0),
(4,'FIBRES_ALIMENTAIRES','Fibres alimentaires',0,0),
(5,'PROTEINES','Protéines',0,0),
(6,'SEL','Sel',0,0),
(7,'ALCOOL','Alcool',0,0),
(8,'BIOTINE','Biotine - Vitamine B8',0,0),
(9,'SILICE','Silice',0,0),
(10,'BICARBONATE','Bicarbonate',0,0),
(11,'POTASSIUM','Potassium',0,0),
(12,'CHLORURE','Chlorure',0,0),
(13,'CALCIUM','Calcium',0,0),
(14,'MAGNESIUM','Magnésium',0,0),
(15,'FLUORURE','Fluorure',0,0),
(16,'CAFEINE','Caféine',0,0),
(17,'FRUITS_LEGUMES_NOIX','Fruits‚ légumes‚ noix et huiles de colza‚ noix et olive',0,0),
(18,'NITRATE','Nitrate',0,0),
(19,'SULFATE','Sulfate',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE