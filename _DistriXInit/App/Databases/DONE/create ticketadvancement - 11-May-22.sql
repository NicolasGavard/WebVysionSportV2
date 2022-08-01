DROP TABLE IF EXISTS `ticketadvancement`;
CREATE TABLE `ticketadvancement` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idticket` int unsigned NOT NULL,
  `idticketstatus` int unsigned NOT NULL,
  `date` int unsigned NOT NULL,
  `time` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidticket` (`idticket`),
  KEY `indidticketstatus` (`idticketstatus`),
  UNIQUE KEY `indticketunique` (`idticket`, `idticketstatus`,`date`, `time`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket Comment' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ticketadvancement(id,idticket,idticketstatus,date,time,elemstate,timestamp) VALUES 
(1,1,1,20220611,90600,0,0),
(2,1,2,20220611,100600,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE