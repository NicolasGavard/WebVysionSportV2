DROP TABLE IF EXISTS `ingredienttype`;
CREATE TABLE `ingredienttype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idingredienttypefamily` int unsigned NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(150) NOT NULL,
  `linktopicture` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indcode` (`code`),
  KEY `indingredienttypefamily` (`idingredienttypefamily`),
  UNIQUE KEY `indindingredienttypefamilycode` (`idingredienttypefamily`,`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Ingredients Types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO ingredienttype(id,idingredienttypefamily,code,description,linktopicture,size,type,elemstate,timestamp) VALUES
(1,1,'CHOUX', 'Choux','',0,'',0,0),
(2,1,'LEGUMES_FEUILLES', 'Légumes feuilles','',0,'',0,0),
(3,1,'CHAMPIGNONS', 'Champignons','',0,'',0,0),
(4,1,'AROMATIQUES', 'Aromatiques fraîches','',0,'',0,0),
(5,1,'LEGUMES_RACINE', 'Légumes racines, tubercules et tiges','',0,'',0,0),
(6,1,'COURGES', 'Courges','',0,'',0,0),
(7,1,'SALADES', 'Salades','',0,'',0,0),
(8,1,'LEGUMES_EXOTIQUES', 'Légumes exotiques','',0,'',0,0),
(9,1,'HARICOTS_POIS', 'Haricots, pois, légumes secs, graines germées','',0,'',0,0),
(10,2,'LEGUMES_FRUITS', 'Légumes fruits','',0,'',0,0),
(11,3,'FRUITS_EXOTIQUE', 'Fruits exotiques et tropicaux','',0,'',0,0),
(12,3,'FRUITS_ROUGES', 'Petits fruits et fruits rouges','',0,'',0,0),
(13,3,'FRUITS_SAUVAGES', 'Fruits sauvages','',0,'',0,0),
(14,3,'FRUITS_GRIMPANT', 'Fruits de plantes grimpantes','',0,'',0,0),
(15,3,'FRUITS_PEPINS', 'Fruits à pépins','',0,'',0,0),
(16,3,'FRUITS_NOYAUX', 'Fruits à noyaux','',0,'',0,0),
(17,3,'FRUITS_COQUE', 'Fruits à coque','',0,'',0,0),
(18,3,'AUTRE_FRUITS', 'Autres fruits','',0,'',0,0),
(19,3,'FRUITS_AGRUME', 'Agrume','',0,'',0,0),
(20,4,'FLEURS', 'Fleurs comestibles','',0,'',0,0),
(21,5,'VIANDE_ROUGE', 'Viandes rouges','',0,'',0,0),
(22,5,'VIANDE_BLANCHE', 'Viandes blanches','',0,'',0,0),
(23,5,'VIANDE_NOIRE', 'Viandes noires','',0,'',0,0),
(24,5,'VIANDE_SECHEE', 'Viandes séchée','',0,'',0,0),
(25,5,'VIANDE_BROUSSE', 'Viandes de brousse','',0,'',0,0);


-- viandes rouges (ou viande de boucherie) : bœuf, veau (bovin de moins de 6 mois d'âge), cheval, porc, mouton, agneau, chèvre, etc. ;
-- viandes blanches : volailles ;
-- viandes noires : gibier ;
-- viande séchée ;
-- viande de brousse.

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE