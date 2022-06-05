DROP TABLE IF EXISTS `dietmeal`;
CREATE TABLE `dietmeal` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iddiet` int unsigned NOT NULL,
  `iddietrecipe` int unsigned NOT NULL,
  `journumber` int unsigned NOT NULL,
  `mealtype` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inddiet` (`iddiettemplate`),
  KEY `inddiettrecipe` (`idrecipe`),
  KEY `inddiettuserstudent` (`iduserstudent`),
  UNIQUE KEY `inddietunique` (`idrecipe`,`iduserstudent`,`iddiettemplate`,`datestart`) USING BTREE
) ENGINE=InnoDB COMMENT='Diets meals' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO dietmeal(id,idusercoach,iduserstudent,iddiettemplate,datestart,elemstate,timestamp) VALUES 
(1,1,1,1,20220520,0,0),
(2,1,2,1,20220520,0,0),
(3,2,1,2,20220520,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE