DROP TABLE IF EXISTS `scorenutri`;
CREATE TABLE `scorenutri` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `letter` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indletterunique` (`letter`) USING BTREE
) ENGINE=InnoDB COMMENT='Nutri scores' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO scorenutri(id,letter,color,description,linktopicture,size,type,elemstate,timestamp) VALUES 
(1,'?','B3B3B3','?','',0,'',0,0),
(2,'A','0A8E45','A','',0,'',0,0),
(3,'B','7AC547','B','',0,'',0,0),
(4,'C','FFC734','C','',0,'',0,0),
(5,'D','FF7D24','D','',0,'',0,0),
(6,'E','FF421A','E','',0,'',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE