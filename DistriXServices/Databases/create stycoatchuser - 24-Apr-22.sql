DROP TABLE IF EXISTS `coachuser`;
CREATE TABLE `coachuser` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `styidusercoach` int unsigned NOT NULL,
  `styiduser` int unsigned NOT NULL,
  `datestart` int unsigned NOT NULL,
  `dateend` int unsigned NOT NULL,
  `statut` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `indusercoach` (`styIdUserCoach`),
  KEY `induser` (`styiduser`),
  UNIQUE KEY `indcoachuserunique` (`styidusercoach`,`styiduser`,`statut`) USING BTREE
) ENGINE=InnoDB COMMENT='All user assigned User coach' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO coachuser(id,styidusercoach,styiduser,datestart,dateend,statut,timestamp) VALUES 
(1,1,2,20220101,20221231,0,0),
(2,1,3,20220101,20221231,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE