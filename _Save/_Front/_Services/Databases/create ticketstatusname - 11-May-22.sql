DROP TABLE IF EXISTS `ticketstatusname`;
CREATE TABLE `ticketstatusname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idticketstatus` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidticketstatus` (`idticketstatus`),
  KEY `indidlanguage` (`idlanguage`),
  UNIQUE KEY `indticketstatusunique` (`idticketstatus`, `idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket status name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ticketstatusname(id,idticketstatus,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Nouveau',0,0),
(2,2,1,'En cours',0,0),
(3,3,1,'En attente',0,0),
(4,4,1,'Résolu',0,0),
(5,5,1,'Fermé',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE