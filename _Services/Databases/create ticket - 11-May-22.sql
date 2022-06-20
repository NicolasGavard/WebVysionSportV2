DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercreate` int unsigned NOT NULL,
  `iduserassign` int unsigned NOT NULL,
  `idtickettype` int unsigned NOT NULL,
  `idticketstatus` int unsigned NOT NULL,
  `title` varchar(150) NOT NULL,
  `descmessage` text NOT NULL,
  `date` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidusercreate` (`idusercreate`),
  KEY `indiduserassign` (`iduserassign`),
  UNIQUE KEY `indticketunique` (`idusercreate`,`iduserassign`,`date`,`time`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ticket(id,idusercreate,iduserassign,idtickettype,idticketstatus,title,descmessage,date,time,elemstate,timestamp) VALUES 
(1,1,1,1,1,'Premier ticket','Desc Premier ticket',20220611,90600,0,0),
(2,1,1,1,1,'Deuxième ticket','Desc Deuxième ticket',20220611,100600,1,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE