DROP TABLE IF EXISTS styenterprisepos;
CREATE TABLE `styenterprisepos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `styidenterprise` int unsigned NOT NULL,
  `idpos` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`, `timestamp`) USING BTREE,
  UNIQUE KEY `indenterprisepos` (`styidenterprise`,`idpos`) USING BTREE,
  UNIQUE KEY `indposenterprise` (`idpos`,`styidenterprise`) USING BTREE
) ENGINE=InnoDB COMMENT='StyEnterprise POS' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


INSERT INTO `styenterprisepos` (`id`, `styidenterprise`, `idpos`, `statut`, `timestamp`) 
VALUES ('1', '1', '1', '0', '0');

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE