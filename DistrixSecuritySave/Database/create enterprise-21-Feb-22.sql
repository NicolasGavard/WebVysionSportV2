DROP TABLE IF EXISTS `enterprise`;
CREATE TABLE `enterprise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `co` varchar(80) NOT NULL,
  `street` varchar(80) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `city` varchar(60) NOT NULL,
  `logoimage` longblob NOT NULL,
  `logoimagehtmlname` varchar(180) NOT NULL,
  `logoimagename` varchar(180) NOT NULL,
  `logosize` int unsigned NOT NULL,
  `logotype` varchar(255) NOT NULL DEFAULT '',
  `idregion` int unsigned NOT NULL,
  `idcountry` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `idusermanager` int unsigned NOT NULL,
  `identerpriseparent` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indupdate` (`id`, `timestamp`) USING BTREE,
  UNIQUE KEY `indcode` (`code`) USING BTREE,
  KEY `indname` (`name`) USING BTREE
) ENGINE=InnoDB COMMENT='Enterprises' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


INSERT INTO `enterprise` (`id`, `code`, `name`, `email`, `phone`, `mobile`, `co`, `street`, `zipcode`, `city`, 
`logoimage`, `logoimagehtmlname`, `logoimagename`, `logosize`, `logotype`, `idregion`, `idcountry`, 
`idlanguage`, `idusermanager`, `identerpriseparent`, `statut`, `timestamp`) 
VALUES ('1', 'DISTRIX', 'DISTRIX', 'hello@distrix.org', '1', '1', '', '7 Distrix Street', '77777', 'DistriX City',
 '', '', '', '0', ' ', '1', '77', 
 '1', '0', '0', '0', '0');

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE