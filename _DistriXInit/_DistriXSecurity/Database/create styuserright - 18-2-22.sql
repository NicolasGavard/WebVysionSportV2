DROP TABLE IF EXISTS `styuserright`;
CREATE TABLE `styuserright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int UNSIGNED NOT NULL,
  `idstyapplication` int UNSIGNED NOT NULL,
  `idstymodule` int UNSIGNED NOT NULL,
  `idstyfunctionality` int UNSIGNED NOT NULL,
  `sumofrights` int UNSIGNED NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `induser` (`idstyuser`),
  KEY `induserapp` (`idstyuser`,`idstyapplication`),
  KEY `induserappmodule` (`idstyuser`,`idstyapplication`,`idstymodule`),
  KEY `induserappmodulefunc` (`idstyuser`,`idstyapplication`,`idstymodule`,`idstyfunctionality`)
) ENGINE=InnoDB COMMENT='Security User Rights' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO `styuserright` (`id`, `idstyuser`, `idstyapplication`, `idstymodule`, `idstyfunctionality`, `sumofrights`,`timestamp`) VALUES
(1, 1, 1, 1, 0, 2147483648, 0),
(2, 1, 1, 2, 0, 2147483648, 0),
(3, 1, 1, 2, 2, 8192, 0),
(4, 2, 1, 1, 0, 2147483648, 0),
(5, 2, 1, 2, 0, 2147483648, 0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE