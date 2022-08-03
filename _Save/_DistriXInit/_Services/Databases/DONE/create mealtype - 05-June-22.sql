DROP TABLE IF EXISTS `mealtype`;
CREATE TABLE `mealtype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Meals types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO mealtype(id,code,name,elemstate,timestamp) VALUES 
(1,'PETIT_DEJEUNER','Petit-déjeuner',0,0),
(2,'DEJEUNER','Déjeuner',0,0),
(3,'COLLATION','Collations',0,0),
(4,'DINER','Dîner',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE