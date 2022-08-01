DROP TABLE IF EXISTS `styenterpisewhitemarking`;
CREATE TABLE `styenterpisewhitemarking` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `identerprise` int unsigned NOT NULL,
  `idsubscriptionpackage` int unsigned NOT NULL,
  `date_start` int unsigned NOT NULL,
  `date_end` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indenterprise` (`identerprise`),
  KEY `indsubscriptionpackage` (`idsubscriptionpackage`),
  UNIQUE KEY `indstyenterpisewhitemarkingunique` (`identerprise`, `idsubscriptionpackage`) USING BTREE
) ENGINE=InnoDB COMMENT='Security Enterpise white Marking' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styenterpisewhitemarking(id,identerprise,idsubscriptionpackage,date_start,date_end,elemstate,timestamp) VALUES 
(1,1,3,20220101,20230101,0,0),
(2,2,3,20220101,20230101,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE