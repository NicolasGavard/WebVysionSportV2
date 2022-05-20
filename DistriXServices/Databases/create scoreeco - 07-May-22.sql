DROP TABLE IF EXISTS `scoreeco`;
CREATE TABLE `scoreeco` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `letter` varchar(2) NOT NULL,
  `color` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indletter` (`letter`),
  UNIQUE KEY `indletterunique` (`letter`) USING BTREE
) ENGINE=InnoDB COMMENT='Eco scores' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO scoreeco(id,letter,color,description,linktopicture,size,type,statut,timestamp) VALUES 
(1,'?','B3B3B3','?','',0,'',0,0),
(2,'A','208E51','A','',0,'',0,0),
(3,'B','5FAE31','B','',0,'',0,0),
(4,'C','E7B40B','C','',0,'',0,0),
(5,'D','E47323','D','',0,'',0,0),
(6,'E','EF131F','E','',0,'',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE