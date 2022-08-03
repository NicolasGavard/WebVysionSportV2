DROP TABLE IF EXISTS `weighttype`;
CREATE TABLE `weighttype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `abbreviation` varchar(20) NOT NULL,
  `issolid` tinyint unsigned NOT NULL,
  `isliquid` tinyint unsigned NOT NULL,
  `isother` tinyint unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Weight Type' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO weighttype(id,code,name,abbreviation,issolid,isliquid,isother,elemstate,timestamp) VALUES 
(1,'KG','Kilogramme','kg',1,0,0,0,0),
(2,'G','Gramme','g',1,0,0,0,0),
(3,'MG','Miligramme','mg',1,0,0,0,0),
(4,'UG','Microgramme','μg',1,0,0,0,0),
(5,'LIBRA','Pound','lb',1,0,0,0,0),
(6,'ONZA','Ounce','oz',1,0,0,0,0),
(7,'ML','Mililitre','ml',0,1,0,0,0),
(8,'CL','Centilitre','cl',0,1,0,0,0),
(9,'DL','Décilitre','dl',0,1,0,0,0),
(10,'DAL','Décalitre','dal',0,1,0,0,0),
(11,'HL','Hectolitre','hl',0,1,0,0,0),
(12,'L','Litre','l',0,1,0,0,0),
(13,'KCAL','Kilocalorie','kcal',0,0,1,0,0),
(14,'CAL','Calorie','calorie',0,0,1,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE