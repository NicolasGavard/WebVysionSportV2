DROP TABLE IF EXISTS `stymodule`;
CREATE TABLE `stymodule` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyapplication` int unsigned NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB COMMENT='Security Modules' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO stymodule(id,idstyapplication,code,description,statut,timestamp)
 VALUES(1,1,'DRINK','Drink',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE