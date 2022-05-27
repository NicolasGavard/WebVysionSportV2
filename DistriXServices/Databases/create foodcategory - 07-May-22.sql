DROP TABLE IF EXISTS `foodcategory`;
CREATE TABLE `foodcategory` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idcategory` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indfood` (`idfood`),
  KEY `indcategory` (`idcategory`),
  UNIQUE KEY `indfoodcategoryunique` (`idfood`,`idcategory`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Category' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodcategory(id,idfood,idcategory,elemstate,timestamp) VALUES 
(1,1,1,0,0),
(2,1,2,0,0),
(3,1,3,0,0),
(4,2,4,0,0),
(5,2,5,0,0),
(6,2,6,0,0),
(7,2,7,0,0),
(8,2,8,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE