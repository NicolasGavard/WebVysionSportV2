DROP TABLE IF EXISTS `styenterpisewhitemarking`;
CREATE TABLE `styenterpisewhitemarking` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idstyenterprise` int unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `logo1` varchar(100) NOT NULL,
  `logo2` varchar(100) NOT NULL,
  `color1` varchar(10) NOT NULL,
  `color2` varchar(10) NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indenterprise` (`idstyenterprise`),
  UNIQUE KEY `indidstyenterpriseunique` (`idstyenterprise`) USING BTREE
) ENGINE=InnoDB COMMENT='Security Enterpise white Marking' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO styenterpisewhitemarking (id,idstyenterprise,name,url,logo1,logo2,color1,color2,statut,timestamp) VALUES 
('1','1','WebVysion Sport Fr','http://localhost/WebVysionSportV2','','','#9bc8db','#69a7c5','0','0'),
('2','2','WebVysion Sport En','http://localhost/WebVysionSportV2','','','#198754','#ffc107','0','0');


-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE