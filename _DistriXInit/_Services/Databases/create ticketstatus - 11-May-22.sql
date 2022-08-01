DROP TABLE IF EXISTS `ticketstatus`;
CREATE TABLE `ticketstatus` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket status' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ticketstatus(id,code,name,elemstate,timestamp) VALUES 
(1,'NEW','New',0,0),
(2,'IN_PROGRESS','In progress',0,0),
(3,'ON_HOLD','On hol',0,0),
(4,'RESOLVED','Resolved',0,0),
(5,'CLOSED','closed',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE