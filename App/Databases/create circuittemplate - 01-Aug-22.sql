DROP TABLE IF EXISTS `circuittemplate`;
CREATE TABLE `circuittemplate` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(150) NOT NULL,
  `duration` int unsigned NOT NULL,
  `tags` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcircuittemplate` (`idusercoach`),
  UNIQUE KEY `indcircuitunique` (`idusercoach`,`name`,`duration`) USING BTREE
) ENGINE=InnoDB COMMENT='Circuit Template' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO circuittemplate(id,idusercoach,name,description,duration,tags,elemstate,timestamp) VALUES 
(1,1,'Circuit 1','Desc Circuit 1',7,'Débutant,confirmé',0,0),
(2,1,'Circuit 2','Desc Circuit 2',14,'Sèche,PDM',0,0),
(3,1,'Circuit 3','Desc Circuit 3',21,'Débutant,confirmé',0,0),
(4,1,'Circuit 4','Desc Circuit 4',28,'Débutant,confirmé',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE