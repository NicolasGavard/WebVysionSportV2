DROP TABLE IF EXISTS `stytemporarycode`;
CREATE TABLE `stytemporarycode` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuserpazzi` int unsigned NOT NULL,
  `idstyapplication` int unsigned NOT NULL,
  `code` varchar(40) NOT NULL,
  `validitydate` int unsigned NOT NULL,
  `validitytime` int unsigned NOT NULL,
  `used` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `induser` (`idstyuserpazzi`),
  KEY `induserapp` (`idstyuserpazzi`,`idstyapplication`)
) ENGINE=InnoDB COMMENT='Security Forget Password Temporary Code' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE