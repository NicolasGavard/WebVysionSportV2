DROP TABLE IF EXISTS `foodlabel`;
CREATE TABLE `foodlabel` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idlabel` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indfood` (`idfood`),
  KEY `indlabel` (`idlabel`),
  UNIQUE KEY `indfoodlabelunique` (`idfood`,`idlabel`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Label' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodlabel(id,idfood,idlabel,statut,timestamp) VALUES 
(1,1,1,0,0),
(2,1,2,0,0),
(3,1,3,0,0),
(4,1,4,0,0),
(5,1,5,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE