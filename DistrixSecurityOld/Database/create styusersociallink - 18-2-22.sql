DROP TABLE IF EXISTS `styusersociallink`;
CREATE TABLE `styusersociallink` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyuser` int unsigned NOT NULL,
  `idsociallink` int unsigned NOT NULL,
  `sociallink` varchar(255) NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indstyuser` (`idstyuser`),
  KEY `indsociallink` (`idsociallink`),
  UNIQUE KEY `indroleuser` (`idstyuser`,`idsociallink`)
) ENGINE=InnoDB COMMENT='Security User Roles' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO `styusersociallink` (`id`, `idstyuser`, `idsociallink`, `sociallink`,`timestamp`) VALUES
(1, 1, 1, 'http://www.socialnetwork1.fr', 0),
(2, 1, 2, 'http://www.socialnetwork2.fr', 0),
(3, 1, 3, 'http://www.socialnetwork3.fr', 0),
(4, 1, 4, 'http://www.socialnetwork4.fr', 0),
(5, 1, 5, 'http://www.socialnetwork5.fr', 0),
(6, 1, 6, 'http://www.socialnetwork6.fr', 0),
(7, 1, 7, 'http://www.socialnetwork7.fr', 0),
(8, 1, 8, 'http://www.socialnetwork8.fr', 0),
(9, 1, 9, 'http://www.socialnetwork9.fr', 0),
(10, 1, 10, 'http://www.socialnetwork10.fr', 0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE