DROP TABLE IF EXISTS `tickettype`;
CREATE TABLE `tickettype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket type' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO tickettype(id,code,name,elemstate,timestamp) VALUES 
(1,'BUGS','Bugs',0,0),
(2,'DEFECTS','Défauts',0,0),
(3,'IMPROVEMENTS','Améliorations',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE