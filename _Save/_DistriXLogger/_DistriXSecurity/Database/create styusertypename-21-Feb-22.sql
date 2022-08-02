DROP TABLE IF EXISTS `styusertypename`;
CREATE TABLE `styusertypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyusertype` int unsigned NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indstyusertypecode` (`idstyusertype`,`idcountry`,`idlanguage`,`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Sty User Type Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO `styusertypename` VALUES ('1', '1', '77', '1', 'INTERNAL', 'Interne', '0', '0');
INSERT INTO `styusertypename` VALUES ('2', '1', '77', '2', 'INTERNAL', 'Internal', '0', '0');
INSERT INTO `styusertypename` VALUES ('3', '2', '77', '1', 'EXTERNAL', 'Externe', '0', '0');
INSERT INTO `styusertypename` VALUES ('4', '2', '77', '2', 'EXTERNAL', 'external', '0', '0');


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE