DROP TABLE IF EXISTS `ticketpicture`;
CREATE TABLE `ticketpicture` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idticket` int unsigned NOT NULL,
  `idticketcomment` int unsigned NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `date` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidticket` (`idticket`),
  KEY `indidticketcomment` (`idticketcomment`),
  UNIQUE KEY `indticketunique` (`idticket`,`idticketcomment`,`date`,`time`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket picture' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE