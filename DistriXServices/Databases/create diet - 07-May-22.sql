DROP TABLE IF EXISTS `diet`;
CREATE TABLE `diet` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `iduser` int unsigned NOT NULL,
  `iddiettemplate` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inddiettemplate` (`iddiettemplate`),
  KEY `inddiettemplateuser` (`iduser`),
  UNIQUE KEY `inddietunique` (`iduser`,`iddiettemplate`,`datestart`) USING BTREE
) ENGINE=InnoDB COMMENT='Diets' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO diet(id,iduser,iddiettemplate,datestart,statut,timestamp) VALUES 
(1,1,1,20220520,0,0),
(2,1,2,20220520,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE