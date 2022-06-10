DROP TABLE IF EXISTS `styfunctionality`;
CREATE TABLE `styfunctionality` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstymodule` int unsigned NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB COMMENT='Security Module Functionalities' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styfunctionality(id,idstymodule,code,description,statut,timestamp)
 VALUES(1,1,'Function 1','Function 1',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE