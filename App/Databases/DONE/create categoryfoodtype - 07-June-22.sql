DROP TABLE IF EXISTS `categoryfoodtype`;
CREATE TABLE `categoryfoodtype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Category Food types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO categoryfoodtype(id,code,name,elemstate,timestamp) VALUES 
(1,'WATERS','EAUX',0,0),
(2,'SOURCE WATERS','EAUX DE SOURCES',0,0),
(3,'MINERAL WATERS','EAUX MINERALES',0,0),
(4,'SNACKS','GATEAUX',0,0),
(5,'SWEET SNACKS','BISCUITS SUCRES',0,0),
(6,'COOKIES_CAKE','GATEAUX AUX BISCUITS',0,0),
(7,'BISCUITS','BISCUITS',0,0),
(8,'CHOCOLATE_COOKIES','GATEAUX AUX CHOCOLATS',0,0);


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE