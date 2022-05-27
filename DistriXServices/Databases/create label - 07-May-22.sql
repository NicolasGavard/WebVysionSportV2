DROP TABLE IF EXISTS `label`;
CREATE TABLE `label` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Labels' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO label(id,code,name,linktopicture,size,type,elemstate,timestamp) VALUES 
(1,'BIO','Bio','',0,'',0,0),
(2,'ECOCERT','Ecocert','',0,'',0,0),
(3,'BIO_EUROPEEN','Bio européen','',0,'',0,0),
(4,'FR-BIO-01','FR-BIO-01','',0,'',0,0),
(5,'MADE_IN_FRANCE','Fabriqué en France','',0,'',0,0),
(6,'AB_AGRI_BIO','AB Agriculture Biologique','',0,'',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE