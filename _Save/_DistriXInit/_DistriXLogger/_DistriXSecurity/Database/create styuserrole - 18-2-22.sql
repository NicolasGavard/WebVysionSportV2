DROP TABLE IF EXISTS `styuserrole`;
CREATE TABLE `styuserrole` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int unsigned NOT NULL,
  `idstyrole` int unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `induserrole` (`idstyuser`,`idstyrole`),
  UNIQUE KEY `indroleuser` (`idstyrole`,`idstyuser`)
) ENGINE=InnoDB COMMENT='Security User Roles' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE