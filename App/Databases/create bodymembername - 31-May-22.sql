DROP TABLE IF EXISTS `bodymembername`;
CREATE TABLE `bodymembername` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idbodymember` int unsigned NOT NULL,
  `idlanguage` int unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indlanguage` (`idlanguage`),
  UNIQUE KEY `indbodymemberunique` (`idbodymember`,`idlanguage`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Type Names' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO bodymembername(id,idbodymember,idlanguage,name,elemstate,timestamp) VALUES 
(1,1,2,'Head',0,0),
(2,2,2,'Neck',0,0),
(3,3,2,'Back',0,0),
(4,4,2,'Trunk',0,0),
(5,5,2,'Shoulder',0,0),
(6,6,2,'Arm',0,0),
(7,7,2,'Forearm',0,0),
(8,8,2,'Hand',0,0),
(9,9,2,'Hip',0,0),
(10,10,2,'Thigh',0,0),
(11,11,2,'Calf',0,0),
(12,12,2,'Foot',0,0),
(13,1,1,'Tête',0,0),
(14,2,1,'Cou',0,0),
(15,3,1,'Dos',0,0),
(16,4,1,'Tronc',0,0),
(17,5,1,'Epaule',0,0),
(18,6,1,'Bras',0,0),
(19,7,1,'Avant-Bras',0,0),
(20,8,1,'Main',0,0),
(21,9,1,'Hanche',0,0),
(22,10,1,'Cuisse',0,0),
(23,11,1,'Mollet',0,0),
(24,12,1,'Pied',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE