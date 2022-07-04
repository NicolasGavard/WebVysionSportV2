DROP TABLE IF EXISTS `bodymuscle`;
CREATE TABLE `bodymuscle` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbodymember` int unsigned NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO bodymuscle(id,idbodymember,code,name,elemstate,timestamp) VALUES 
(1,1,'MESSETER','Masséter',0,0),
(2,1,'ZYGOMATIQUE','Zygomatique',0,0),
(3,1,'OCCIPITO','Occipito des lèvres',0,0),
(4,1,'CORUGATOR','Corugator',0,0),
(5,2,'TRAPEZE','Trapèze',0,0),
(6,3,'GRAND_DORSAL','Grand dorsal',0,0),
(7,3,'INTERCOSTAUX','Muscles intercostaux',0,0),
(8,3,'LOMBES','Muscle carré des lombes',0,0),
(9,3,'ERECTEURS_RACHIS','Muscles érecteurs du rachis',0,0),
(10,4,'GRAND_PECTORAL','Le grand pectoral',0,0),
(11,4,'DELTOIDES','Deltoïdes',0,0),
(12,4,'BICEPS','Biceps',0,0),
(13,4,'TRICEPS','Triceps',0,0),
(14,6,'BICEPS_BRACHIAL','Biceps brachial',0,0),
(15,6,'_BRACHIAL_ANTERIEUR','Brachial antérieur',0,0),
(16,6,'TRICEPS_BRACHIAL','Triceps brachial',0,0),
(17,7,'SOUPINATEUR','Long soupinateur',0,0),
(18,7,'GRAND_PALMAIRE','Grand palmaire',0,0),
(19,7,'CUBITAL_ANTERIEUR','Cubital antérieur',0,0),
(20,8,'THENARIEN','Muscle thénarien',0,0),
(21,8,'MUSCLE_DOIGTS','Muscles des doigts',0,0),
(22,9,'FESSIERS','Les fessiers',0,0),
(23,9,'ABDUCTEURS','Les abducteurs',0,0),
(24,9,'ADDUCTEURS','Les adducteurs',0,0),
(25,10,'MUSCLES_ANTERIEUR','Muscles antérieurs',0,0),
(26,10,'MOYENS_ADDUCTEUR','Moyens adducteur',0,0),
(27,10,'QUADRICEPS','Quadriceps',0,0),
(28,10,'ISCHIO_JAMBIERS','Ischio-jambiers',0,0),
(29,11,'JAMBIER_ANTERIEUR','Jambier antérieur',0,0),
(30,11,'JUMEAUX_EXTERNE','Jumeaux externe',0,0),
(31,11,'JUMEAUX_INTERNE','Jumeaux interne',0,0),
(32,11,'SOLEAIRE','Soléaire',0,0),
(33,12,'MUSCLES_PIEDS','Muscles des pieds',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE