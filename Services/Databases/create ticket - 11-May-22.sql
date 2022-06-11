DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercreate` int unsigned NOT NULL,
  `iduserassign` int unsigned NOT NULL,
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

INSERT INTO ticket(id,idusercreate,iduserassign,idticketstatus,title,descmessage,date,time,elemstate,timestamp) VALUES 
(1,1,1,1,'Premier tcket','Desc Premier tcket',20220611,90600,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE