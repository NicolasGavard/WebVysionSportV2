DROP TABLE IF EXISTS `ticketcomment`;
CREATE TABLE `ticketcomment` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idticket` int unsigned NOT NULL,
  `iduser` int unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `descmessage` text NOT NULL,
  `date` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidticket` (`idticket`),
  KEY `indiduser` (`iduser`),
  UNIQUE KEY `indticketunique` (`idticket`, `iduser`,`date`, `time`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ticketcomment(id,idticket,iduser,title,descmessage,date,time,elemstate,timestamp) VALUES 
(1,1,1,'Premier message du ticket','Desc du premier message du ticket',20220611,100600,0,0),
(2,1,2,'Deuxième message du ticket','Desc du deuxième message du ticket',20220611,100600,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE