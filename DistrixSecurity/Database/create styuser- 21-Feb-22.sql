DROP TABLE IF EXISTS `styuser`;
CREATE TABLE `styuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyusertype` tinyint unsigned NOT NULL,
  `login` varchar(50) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `name` varchar(80) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `emailbackup` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `initpass` tinyint unsigned,
  `idlanguage` int unsigned,
  `idstyenterprise` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indlogin` (`login`),
  KEY `indenterpise` (`idstyenterprise`)
) ENGINE=InnoDB COMMENT='Security Users' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styuser VALUES
 (1,1,'One','One','User1','',0,'','one','one.user1@distrix.org','','','',0,1,1,0,0),
 (2,2,'Two','Two','User2','',0,'','two','two.user2@distrix.org','','','',0,1,1,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE