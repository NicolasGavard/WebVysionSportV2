DROP TABLE IF EXISTS `ingredientpackagingbrand`;
CREATE TABLE `ingredientpackagingbrand` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `name` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Packaging Brand' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredientpackagingbrand(id,code,name,linktopicture,size,type,elemstate,timestamp) VALUES
(1,1,'Ferrero','Ferrero','',0,'',0,0);



-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE