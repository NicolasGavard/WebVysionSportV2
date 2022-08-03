DROP TABLE IF EXISTS enterprisepos;
CREATE TABLE `enterprisepos` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `identerprise` int unsigned NOT NULL,
  `idpos` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`, `timestamp`) USING BTREE,
  UNIQUE KEY `indenterprisepos` (`identerprise`,`idpos`) USING BTREE,
  UNIQUE KEY `indposenterprise` (`idpos`,`identerprise`) USING BTREE
) ENGINE=InnoDB COMMENT='Enterprise POS' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


INSERT INTO `enterprisepos` (`id`, `identerprise`, `idpos`, `statut`, `timestamp`) 
VALUES ('1', '1', '1', '0', '0');

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE