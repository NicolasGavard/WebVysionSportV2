DROP TABLE IF EXISTS `weighttypename`;
CREATE TABLE `weighttypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idweighttype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indweighttype` (`idweighttype`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indweighttypenameunique` (`idweighttype`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Weight Type Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO weighttypename(id,idweighttype,idlanguage,name,description,abbreviation,elemstate,timestamp) VALUES 
(1,1,1,'Kilogramme','Kilogramme','kg',0,0),
(2,2,1,'Gramme','Gramme','g',0,0),
(3,3,1,'Miligramme','Miligramme','mg',0,0),
(4,4,1,'Microgramme','Microgramme','μg',0,0),
(5,5,1,'Pound','Pound - libra','lb',0,0),
(6,6,1,'Ounce','Ounce - onza','oz',0,0),
(7,7,1,'Mililitre','Mililitre','ml',0,0),
(8,8,1,'Centilitre','Centilitre','cl',0,0),
(9,9,1,'Décilitre','Décilitre','dl',0,0),
(10,10,1,'Décalitre','Décalitre','dal',0,0),
(11,11,1,'Hectolitre','Hectolitre','hl',0,0),
(12,12,1,'Litre','Litre','l',0,0),
(13,13,1,'Kilocalorie','Kilocalorie','kcal',0,0),
(14,14,1,'Calorie','Calorie','calorie',0,0);

-- 1 kilogramme 	(kg) 	        = 1 000 g
-- 1 gramme 	(g) 	            = 1 g
-- 1 lb 	(pound) (libra)       = 453.59 g
-- 1 oz 	(ounce) (onza) 	      = 28.35g
-- un centième (1/100) de litre = un centilitre (cl)
-- un dixième (1/10) de litre   = un décilitre (dl)
-- dix (10) litres              = un décalitre ( dal)
-- cent (100) litres            = un hectolitre (hl)
-- mille (1000) litres          = un kilolitre (kl)

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE