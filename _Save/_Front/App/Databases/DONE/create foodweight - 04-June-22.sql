DROP TABLE IF EXISTS `foodweight`;
CREATE TABLE `foodweight` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idfood` int unsigned NOT NULL,
  `idweighttype` int unsigned NOT NULL,
  `weight` float(6,2) unsigned NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indweighttype` (`idweighttype`),
  UNIQUE KEY `indfoodweightunique` (`idfood`,`idweighttype`,`weight`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Weight' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodweight(id,idfood,idweighttype,weight,linktopicture,size,type,elemstate,timestamp) VALUES 
(1,1,12,1,'',0,'',0,0),
(2,1,12,1.5,'',0,'',0,0),
(3,2,2,300,'',0,'',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE