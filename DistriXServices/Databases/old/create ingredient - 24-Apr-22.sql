DROP TABLE IF EXISTS `ingredient`;
CREATE TABLE `ingredient` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idingredienttype` int unsigned NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indingredienttype` (`idingredienttype`),
  KEY `indcode` (`code`),
  KEY `indingredientcode` (`idingredienttype`,`code`),
  UNIQUE KEY `indingredientcodeunique` (`idingredienttype`,`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredient(id,idingredienttype,code,description,linktopicture,size,type,statut,timestamp) VALUES
(1,1,'CHOUX_ROUGE','Chou rouge','',0,'',0,0),
(2,1,'CHOUX_BRUXELLES','Choux de Bruxelles','',0,'',0,0),
(3,1,'CHOUX_KALE','Chou Kale','',0,'',0,0),
(4,1,'CHOUX_FLEUR','Chou-fleur','',0,'',0,0),

(5,2,'SALADE','Salade','',0,'',0,0),
(6,2,'FENOUIL','Fenouil','',0,'',0,0),
(7,2,'EPINARD','Épinard','',0,'',0,0),
(8,2,'CELERI_BRANCHE','Céleri-branche','',0,'',0,0),

(9,3,'CHAMPIGNON_DE_PARIS','Champignon de paris','',0,'',0,0),
(10,3,'CHAMPIGNONS_CULTIVES','Champignons cultivés','',0,'',0,0),
(11,3,'MORILLE','Morille','',0,'',0,0),
(12,3,'CEPE','Cèpe','',0,'',0,0),

(13,4,'HERBES_AROMATIQUE_FRAICHES','Herbes aromatiques fraîches','',0,'',0,0),
(14,4,'PERSIL','Persil','',0,'',0,0),
(15,4,'OSEILLE','Oseille','',0,'',0,0),

(16,5,'OIGNON_PRIMEUR','Oignon Primeur','',0,'',0,0),
(17,5,'CAROTTE_PRIMEUR','Carotte primeur','',0,'',0,0),
(18,5,'RUTABAGA','Rutabaga','',0,'',0,0),
(19,1,'TOPINAMBOUR','Topinambour','',0,'',0,0),

(20,6,'COURGES_ET_POTIRONS','Courges et potirons','',0,'',0,0),
(21,6,'POTIRON','Potiron','',0,'',0,0),
(22,6,'COURGETTE','Courgette','',0,'',0,0),

(23,7,'POURPIER','Pourpier','',0,'',0,0),
(24,7,'MACHE','Mâche','',0,'',0,0),
(25,7,'LAITUE','Laitue','',0,'',0,0),
(26,7,'ENDIVE','Endive','',0,'',0,0),

(27,8,'PATATE_DOUCE','Patate douce','',0,'',0,0),

(28,9,'POIS_GOURMAND','Pois gourmand','',0,'',0,0),
(29,9,'PETIT_POIS','Petit pois','',0,'',0,0),
(30,9,'LENTILLE','Lentille','',0,'',0,0),
(31,9,'HARICOT_VERT','Haricot vert','',0,'',0,0),

(32,10,'PASTEQUE','Pastèque','',0,'',0,0),
(33,10,'TOMATE','Tomate','',0,'',0,0),
(34,10,'POIVRON','Poivron','',0,'',0,0),
(35,10,'CONCOMBRE','Concombre','',0,'',0,0),

(36,11,'AVOCAT','Avocat','',0,'',0,0),
(37,11,'SAPOTILLE','Sapotille','',0,'',0,0),
(38,11,'PITAYA','Pitaya','',0,'',0,0),
(39,11,'PHYSALIE','Physalis','',0,'',0,0),

(40,12,'MYRTILLE','Myrtille','',0,'',0,0),
(41,12,'MURE','Mûre','',0,'',0,0),
(42,12,'GROSEILLE','Groseille','',0,'',0,0),
(43,12,'FRAMBOISE','Framboise','',0,'',0,0),

(44,13,'NOISETTE','Noisette','',0,'',0,0),
(45,13,'FIGUE','Figue','',0,'',0,0),

(46,14,'RAISON','Raisin','',0,'',0,0),
(47,14,'KIWI','kiwi','',0,'',0,0),

(48,15,'POMME','Pomme','',0,'',0,0),
(49,15,'POIRE','Poire','',0,'',0,0),
(50,15,'COING','Coing','',0,'',0,0),

(51,16,'PRUNE','Prune','',0,'',0,0),
(52,16,'PECHE','Pêche','',0,'',0,0),
(53,16,'NECTARINE','Nectarine','',0,'',0,0),
(54,16,'MIRABELLE','Mirabelle','',0,'',0,0),
(55,16,'CERISE','Cerise','',0,'',0,0),

(56,17,'PIGNON_DE_PIN','Pignon de pin','',0,'',0,0),
(57,17,'NOIX_DE_COCO','Noix de coco','',0,'',0,0),
(58,17,'NOIX','Noix','',0,'',0,0),
(59,17,'CHATAIGNE','Châtaigne','',0,'',0,0),

(60,18,'RHUBARBE','Rhubarbe','',0,'',0,0),

(62,19,'POMELO','Pomelo','',0,'',0,0),
(63,19,'ORANGE','Orange','',0,'',0,0),
(64,19,'CLEMENTINE','Clémentine','',0,'',0,0),
(65,19,'MANDARINE','Mandarine','',0,'',0,0),
(66,19,'CITRON','Citron','',0,'',0,0),
(67,19,'CITRON_VERT','Citron vert','',0,'',0,0),

(61,20,'FLEURS_COMESTIBLES','Fleurs comestibles','',0,'',0,0);



-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE