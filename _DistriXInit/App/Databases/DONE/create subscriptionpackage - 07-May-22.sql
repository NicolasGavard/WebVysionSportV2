DROP TABLE IF EXISTS `subscriptionpackage`;
CREATE TABLE `subscriptionpackage` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(150) NOT NULL,
  `price` float(4) unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Subscription Package' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO subscriptionpackage(id,code,price,elemstate,timestamp) VALUES 
(1,'FREE',0,0,0),
(2,'LIGHT',4.90,0,0),
(3,'WHITE_MARKING',9.9,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE