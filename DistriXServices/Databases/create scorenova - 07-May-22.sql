DROP TABLE IF EXISTS `scorenova`;
CREATE TABLE `scorenova` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indnumber` (`number`),
  UNIQUE KEY `indnumberunique` (`number`) USING BTREE
) ENGINE=InnoDB COMMENT='Nova scores' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO scorenova(id,number,color,description,linktopicture,size,type,statut,timestamp) VALUES 
(1,'?','B3B3B3','?','',0,'',0,0),
(2,'1','00A501','1','',0,'',0,0),
(3,'2','F7C600','2','',0,'',0,0),
(4,'3','F76300','3','',0,'',0,0),
(5,'4','F60000','4','',0,'',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE