DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Category' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO category(id,code,statut,timestamp) VALUES 
(1,'WATERS',0,0),
(2,'SOURCE WATERS',0,0),
(3,'MINERAL WATERS',0,0),
(4,'SNACKS',0,0),
(5,'SWEET SNACKS',0,0),
(6,'COOKIES_CAKE',0,0),
(7,'BISCUITS',0,0),
(8,'CHOCOLATE_COOKIES',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE