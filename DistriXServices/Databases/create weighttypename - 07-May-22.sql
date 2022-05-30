DROP TABLE IF EXISTS `weighttypename`;
CREATE TABLE `weighttypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idweighttype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indweighttype` (`idweighttype`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indweighttypenameunique` (`idweighttype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Weight Type Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO weighttypename(id,idweighttype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Kilogramme',0,0),
(2,2,1,'Gramme',0,0),
(3,3,1,'Miligramme',0,0),
(4,4,1,'Microgramme',0,0),
(5,5,1,'Pound',0,0),
(6,6,1,'Ounce',0,0),
(7,7,1,'Mililitre',0,0),
(8,8,1,'Centilitre',0,0),
(9,9,1,'Décilitre',0,0),
(10,10,1,'Décalitre',0,0),
(11,11,1,'Hectolitre',0,0),
(12,12,1,'Litre',0,0),
(13,13,1,'Kilocalorie',0,0),
(14,14,1,'Calorie',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE