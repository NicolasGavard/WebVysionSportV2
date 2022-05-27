DROP TABLE IF EXISTS `weighttype`;
CREATE TABLE `weighttype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `issolid` tinyint unsigned NOT NULL,
  `isliquid` tinyint unsigned NOT NULL,
  `isother` tinyint unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Weight Type' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO weighttype(id,code,name,issolid,isliquid,isother,elemstate,timestamp) VALUES 
(1,'KG','Kilogramme',1,0,0,0,0),
(2,'G','Gramme',1,0,0,0,0),
(3,'MG','Miligramme',1,0,0,0,0),
(4,'UG','Microgramme',1,0,0,0,0),
(5,'LIBRA','Pound',1,0,0,0,0),
(6,'ONZA','Ounce',1,0,0,0,0),
(7,'ML','Mililitre',0,1,0,0,0),
(8,'CL','Centilitre',0,1,0,0,0),
(9,'DL','Décilitre',0,1,0,0,0),
(10,'DAL','Décalitre',0,1,0,0,0),
(11,'HL','Hectolitre',0,1,0,0,0),
(12,'L','Litre',0,1,0,0,0),
(13,'KCAL','Kilocalorie',0,0,1,0,0),
(14,'CAL','Calorie',0,0,1,0,0);

-- 1 kilogramme 	(kg) 	=1 000 g
-- 1 gramme 	(g) 	=1 g
-- 1 lb 	(pound) (libra) 	=453.59 g
-- 1 oz 	(ounce) (onza) 	=28.35g
-- un centième (1/100) de litre = un centilitre (cl) ;
-- un dixième (1/10) de litre = un décilitre (dl) ;
-- dix (10) litres = un décalitre ( dal) ;
-- cent (100) litres = un hectolitre (hl) ;
-- mille (1000) litres = un kilolitre (kl).

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE