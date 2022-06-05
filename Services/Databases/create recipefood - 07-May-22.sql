DROP TABLE IF EXISTS `recipeingredient`;
DROP TABLE IF EXISTS `recipefood`;
CREATE TABLE `recipefood` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idrecipe` int(10) unsigned NOT NULL,
  `idfood` int(10) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL,
  `idweighttype` int(10) unsigned NOT NULL,
  `calorie` int(10) unsigned NOT NULL,
  `proetin` int(10) unsigned NOT NULL,
  `glucide` int(10) unsigned NOT NULL,
  `lipid` int(10) unsigned NOT NULL,
  `elemstate` tinyint(3) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indrecipefoodunique` (`idrecipe`,`idfood`) USING BTREE,
  KEY `indrecipe` (`idrecipe`),
  KEY `indfood` (`idfood`),
  KEY `indrecipefood` (`idrecipe`,`idfood`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Recipes food';

INSERT INTO recipefood(id,idrecipe,idfood,weight,idweighttype,calorie,proetin,glucide,lipid,elemstate,timestamp) VALUES 
(1,1,1,100,2,20,30,40,50,0,0),
(2,1,2,800,2,10,20,30,40,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE