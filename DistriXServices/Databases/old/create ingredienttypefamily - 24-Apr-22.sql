DROP TABLE IF EXISTS `ingredienttypefamily`;
CREATE TABLE `ingredienttypefamily` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(40) NOT NULL,
  `color` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Types Family' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredienttypefamily(id,code,color,description,statut,timestamp) VALUES
(1,'LEGUMES', '00561B','Légumes',0,0),
(2,'LEGUMES_FRUITS', 'F35D8B','Légumes fruits',0,0),
(3,'FRUITS', 'EA6652','Fruits',0,0),
(4,'FLEURS', '7A238A','Fleurs comestibles',0,0),
(5,'VIANDES', 'BB0B0B','Viandes',0,0),
(6,'POISSONS', '0080FF','Poissons',0,0);

-- Les féculents. ...
-- Les fruits et légumes. ...
-- Les produits laitiers. ...
-- Les viandes, volailles, poissons, œufs, légumineuses, alternatives végétales. ...
-- Les matières grasses. ...
-- Les produits sucrés. ...
-- L'eau.

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE