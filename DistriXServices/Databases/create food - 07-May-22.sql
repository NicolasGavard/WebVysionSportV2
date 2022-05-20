DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbrand` int unsigned NOT NULL,
  `idscorenutri` int unsigned NOT NULL,
  `idscorenova` int unsigned NOT NULL,
  `idscoreeco` int unsigned NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indbrand` (`idbrand`),
  KEY `indscorenutri` (`idscorenutri`),
  KEY `indscorenova` (`idscorenova`),
  KEY `indscoreeco` (`idscoreeco`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indfoodunique` (`idbrand`, `code`) USING BTREE
) ENGINE=InnoDB COMMENT='Food' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO food(id,idbrand,idscorenutri,idscorenova,idscoreeco,code,name,description,statut,timestamp) VALUES 
(1,1,2,2,2,'SPRING_WATER','Spring water','Spring water',0,0),
(2,2,5,5,6,'PRINCE CHOCOLATE','Prince Chocolate','Prince Chocolate',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE