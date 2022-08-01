DROP TABLE IF EXISTS `recipe`;
CREATE TABLE `recipe` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int(10) unsigned NOT NULL,
  `code` varchar(40) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `rating` int(10) unsigned NOT NULL,
  `elemstate` tinyint(3) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  KEY `indidusercoach` (`idusercoach`),
  UNIQUE KEY `indrcodeidusercoach` (`code`,`idusercoach`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Recipes';

INSERT INTO recipe(id,idusercoach,code,name,description,linktopicture,size,type,rating,elemstate,timestamp) VALUES 
(1,1,'RECIPE1','Recette 1','Recette numéro 1','',0,'',4,0,0),
(2,1,'RECIPE2','Recette 2','Recette numéro 2','',0,'',3,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE