DROP TABLE IF EXISTS `diettemplate`;
CREATE TABLE `diettemplate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `duration` int unsigned NOT NULL,
  `tags` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inddiettemplate` (`idusercoach`),
  UNIQUE KEY `inddietunique` (`idusercoach`,`name`,`duration`) USING BTREE
) ENGINE=InnoDB COMMENT='Diet Template' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO diettemplate(id,idusercoach,name,duration,tags,elemstate,timestamp) VALUES 
(1,1,'Diète 1','7','Débutant,confirmé',0,0),
(2,1,'Diète 2','14','Sèche,PDM',0,0),
(3,1,'Diète 3','21','Débutant,confirmé',0,0),
(4,1,'Diète 4','28','Débutant,confirmé',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE