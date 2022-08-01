DROP TABLE IF EXISTS `ingredientname`;
CREATE TABLE `ingredientname` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idingredient` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indingredient` (`idingredient`),
  KEY `indlanguage` (`idlanguage`),
  KEY `indingredientlanguage` (`idingredient`,`idlanguage`),
  UNIQUE KEY `indingredientlanguageunique` (`idingredient`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredientname(idingredient,idlanguage,name,elemstate,timestamp) VALUES
(1,1,'Chou rouge',0,0),
(2,1,'Choux de Bruxelles',0,0),
(3,1,'Chou Kale',0,0),
(4,1,'Chou-fleur',0,0),

(5,1,'Salade',0,0),
(6,1,'Fenouil',0,0),
(7,1,'Épinard',0,0),
(8,1,'Céleri-branche',0,0),

(9,1,'Champignon de paris',0,0),
(10,1,'Champignons cultivés',0,0),
(11,1,'Morille',0,0),
(12,1,'Cèpe',0,0),

(13,1,'Herbes aromatiques fraîches',0,0),
(14,1,'Persil',0,0),
(15,1,'Oseille',0,0),

(16,1,'Oignon Primeur',0,0),
(17,1,'Carotte primeur',0,0),
(18,1,'Rutabaga',0,0),
(19,1,'Topinambour',0,0),

(20,1,'Courges et potirons',0,0),
(21,1,'Potiron',0,0),
(22,1,'Courgette',0,0),

(23,1,'Pourpier',0,0),
(24,1,'Mâche',0,0),
(25,1,'Laitue',0,0),
(26,1,'Endive',0,0),

(27,1,'Patate douce',0,0),

(28,1,'Pois gourmand',0,0),
(29,1,'Petit pois',0,0),
(30,1,'Lentille',0,0),
(31,1,'Haricot vert',0,0),

(32,1,'Pastèque',0,0),
(33,1,'Tomate',0,0),
(34,1,'Poivron',0,0),
(35,1,'Concombre',0,0),

(36,1,'Avocat',0,0),
(37,1,'Sapotille',0,0),
(38,1,'Pitaya',0,0),
(39,1,'Physalis',0,0),

(40,1,'Myrtille',0,0),
(41,1,'Mûre',0,0),
(42,1,'Groseille',0,0),
(43,1,'Framboise',0,0),

(44,1,'Noisette',0,0),
(45,1,'Figue',0,0),

(46,1,'Raisin',0,0),
(47,1,'kiwi',0,0),

(48,1,'Pomme',0,0),
(49,1,'Poire',0,0),
(50,1,'Coing',0,0),

(51,1,'Prune',0,0),
(52,1,'Pêche',0,0),
(53,1,'Nectarine',0,0),
(54,1,'Mirabelle',0,0),
(55,1,'Cerise',0,0),

(56,1,'Pignon de pin',0,0),
(57,1,'Noix de coco',0,0),
(58,1,'Noix',0,0),
(59,1,'Châtaigne',0,0),

(60,1,'Rhubarbe',0,0),

(62,1,'Pomelo',0,0),
(63,1,'Orange',0,0),
(64,1,'Clémentine',0,0),
(65,1,'Mandarine',0,0),
(66,1,'Citron',0,0),
(67,1,'Citron vert',0,0),

(68,1,'Fleurs comestibles',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE