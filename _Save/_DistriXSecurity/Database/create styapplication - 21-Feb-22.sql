DROP TABLE IF EXISTS `styapplication`;
CREATE TABLE `styapplication` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB COMMENT='Security Applications' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styapplication(id,code,description,statut,timestamp)
 VALUES(1,'FIRST_APP','First Application for testing purposes',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE