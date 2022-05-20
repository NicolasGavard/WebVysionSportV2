DROP TABLE IF EXISTS `subscriptionpackagename`;
CREATE TABLE `subscriptionpackagename` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idsubscriptionpackage` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indsubscriptionpackage` (`idsubscriptionpackage`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indsubscriptionpackageunique` (`idsubscriptionpackage`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Subscription Package Name' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO subscriptionpackagename(id,idsubscriptionpackage,idlanguage,name,statut,timestamp) VALUES 
(1,1,1,'Gratuit',0,0),
(2,2,1,'Formule limitée',0,0),
(3,3,1,'Formule en marque blanche',0,0);