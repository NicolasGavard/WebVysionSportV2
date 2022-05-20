DROP TABLE IF EXISTS `weighttype`;
CREATE TABLE `weighttype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `issolid` tinyint unsigned NOT NULL,
  `isliquid` tinyint unsigned NOT NULL,
  `isother` tinyint unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Weight Type' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO weighttype(id,code,issolid,isliquid,isother,statut,timestamp) VALUES 
(1,'KG',1,0,0,0,0),
(2,'G',1,0,0,0,0),
(3,'MG',1,0,0,0,0),
(4,'UG',1,0,0,0,0),
(5,'LIBRA',1,0,0,0,0),
(6,'ONZA',1,0,0,0,0),
(7,'ML',0,1,0,0,0),
(8,'CL',0,1,0,0,0),
(9,'DL',0,1,0,0,0),
(10,'DAL',0,1,0,0,0),
(11,'HL',0,1,0,0,0),
(12,'L',0,1,0,0,0),
(13,'KCAL',0,0,1,0,0),
(14,'CAL',0,0,1,0,0);

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