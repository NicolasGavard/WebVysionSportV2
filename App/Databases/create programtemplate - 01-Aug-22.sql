DROP TABLE IF EXISTS `programtemplate`;
CREATE TABLE `programtemplate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `duration` int unsigned NOT NULL,
  `tags` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indprogramtemplate` (`idusercoach`),
  UNIQUE KEY `indprogramunique` (`idusercoach`,`name`,`duration`) USING BTREE
) ENGINE=InnoDB COMMENT='Programs Template' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO programtemplate(id,idusercoach,name,description,duration,tags,elemstate,timestamp) VALUES 
(1,1,'Program 1','Desc Program 1',7,'Débutant,confirmé',0,0),
(2,1,'Program 2','Desc Program 2',14,'Sèche,PDM',0,0),
(3,1,'Program 3','Desc Program 3',21,'Débutant,confirmé',0,0),
(4,1,'Program 4','Desc Program 4',28,'Débutant,confirmé',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE