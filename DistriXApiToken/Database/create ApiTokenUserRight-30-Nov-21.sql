DROP TABLE IF EXISTS `apitokenuserright`;
CREATE TABLE `apitokenuserright` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idapitokenuser` int unsigned NOT NULL,
  `idapitokenapplication` int unsigned NOT NULL,
  `idapitokenmodule` int unsigned NOT NULL,
  `idapitokenfunctionality` int unsigned NOT NULL,
  `sumofrights` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `induser` (`idapitokenuser`),
  KEY `induserapp` (`idapitokenuser`,`idapitokenapplication`),
  KEY `induserappmodule` (`idapitokenuser`,`idapitokenapplication`,`idapitokenmodule`),
  KEY `induserappmodulefunc` (`idapitokenuser`,`idapitokenapplication`,`idapitokenmodule`,`idapitokenfunctionality`)
) ENGINE=InnoDB COMMENT='Api Token User Rights' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV Dev2    : DONE
-- DEV Nico    : DONE