DROP TABLE IF EXISTS `styroleright`;
CREATE TABLE `styroleright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyrole` int unsigned NOT NULL,
  `idstyapplication` int unsigned NOT NULL,
  `idstymodule` int unsigned NOT NULL,
  `idstyfunctionality` int unsigned NOT NULL,
  `sumofrights` int unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indrole` (`idstyrole`),
  KEY `indroleapp` (`idstyrole`,`idstyapplication`),
  KEY `indroleappmodule` (`idstyrole`,`idstyapplication`,`idstymodule`),
  KEY `indroleappmodulefunc` (`idstyrole`,`idstyapplication`,`idstymodule`,`idstyfunctionality`)
) ENGINE=InnoDB COMMENT='Security Role Rights' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styroleright
(id,idstyrole,idstyapplication,idstymodule,idstyfunctionality,sumofrights,timestamp) 
VALUES(1,1,1,0,0,1073741824,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE