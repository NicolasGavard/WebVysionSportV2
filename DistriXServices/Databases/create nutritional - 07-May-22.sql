DROP TABLE IF EXISTS `nutritional`;
CREATE TABLE `nutritional` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Nutritional' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO nutritional(id,code,elemstate,timestamp) VALUES 
(1,'ENERGIE',0,0),
(2,'MATIERES_GRASSES',0,0),
(3,'GLUCIDES',0,0),
(4,'FIBRES_ALIMENTAIRES',0,0),
(5,'PROTEINES',0,0),
(6,'SEL',0,0),
(7,'ALCOOL',0,0),
(8,'BIOTINE',0,0),
(9,'SILICE',0,0),
(10,'BICARBONATE',0,0),
(11,'POTASSIUM',0,0),
(12,'CHLORURE',0,0),
(13,'CALCIUM',0,0),
(14,'MAGNESIUM',0,0),
(15,'FLUORURE',0,0),
(16,'CAFEINE',0,0),
(17,'FRUITS_LEGUMES_NOIX',0,0),
(18,'NITRATE',0,0),
(19,'SULFATE',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE