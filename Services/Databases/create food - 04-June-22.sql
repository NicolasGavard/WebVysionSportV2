DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbrand` int unsigned NOT NULL,
  `code` varchar(100) NOT NULL,
  `qrcode` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idscorenutri` int unsigned NOT NULL,
  `idscorenova` int unsigned NOT NULL,
  `idscoreeco` int unsigned NOT NULL,
  `description` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indbrand` (`idbrand`),
  KEY `indscorenutri` (`idscorenutri`),
  KEY `indscorenova` (`idscorenova`),
  KEY `indscoreeco` (`idscoreeco`),
  KEY `indcode` (`code`),
  KEY `indqrcode` (`qrcode`),
  UNIQUE KEY `indfoodunique` (`idbrand`, `code`) USING BTREE
) ENGINE=InnoDB COMMENT='Food' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO food(id,idbrand,idscorenutri,idscorenova,idscoreeco,code,qrcode,name,description,elemstate,timestamp) VALUES 
(1,1,2,2,2,'SPRING_WATER','112233445566778899','Spring water','Spring water',0,0),
(2,2,5,5,6,'PRINCE CHOCOLATE','998877665544332211','Prince Chocolate','Prince Chocolate',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE