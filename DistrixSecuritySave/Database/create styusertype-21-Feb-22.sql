DROP TABLE IF EXISTS `styusertype`;
CREATE TABLE `styusertype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `statut` tinyint unsigned NOT NULL DEFAULT '0',
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcode` (`code`),
  UNIQUE KEY `indname` (`name`)
) ENGINE=InnoDB COMMENT='Security User Types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO `styusertype` VALUES ('1', 'INTERNAL', 'Internal', '0', '0');
INSERT INTO `styusertype` VALUES ('2', 'EXTERNAL', 'External', '0', '0');

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE