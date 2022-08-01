DROP TABLE IF EXISTS `styright`;
CREATE TABLE `styright` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` int unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`)
) ENGINE=InnoDB COMMENT='Security Rights' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styright(id,code,name,description,statut,timestamp) VALUES
 ( 1,   1,'View','',0,0),     ( 2,   2,'Change','',0,0),
 ( 3,   4,'Add','',0,0),      ( 4,   8,'Remove','',0,0),
 ( 5,  16,'Delete','',0,0),   ( 6,  32,'Print','',0,0),
 ( 7,  64,'List','',0,0),     ( 8, 128,'Follow','',0,0),
 ( 9, 256,'Security','',0,0), (10, 512,'Publish','',0,0),
 (11,1024,'Restore','',0,0),  (12,2048,'Duplicate','',0,0),
 (13,4096,'Agenda','',0,0),   (14,2147483648,'Manage','',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE