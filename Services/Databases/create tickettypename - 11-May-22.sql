DROP TABLE IF EXISTS `tickettypename`;
CREATE TABLE `tickettypename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idtickettype` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indidtickettype` (`idtickettype`),
  KEY `indidlanguage` (`idlanguage`),
  UNIQUE KEY `indtickettypeunique` (`idtickettype`, `idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Ticket type name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO tickettypename(id,idtickettype,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,1,'Bugs',0,0),
(2,2,1,'Défauts',0,0),
(3,3,1,'Améliorations',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE