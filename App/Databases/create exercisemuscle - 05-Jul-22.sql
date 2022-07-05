DROP TABLE IF EXISTS `exercisemuscle`;
CREATE TABLE `exercisemuscle` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idexercise` int unsigned NOT NULL,
  `idbodymuscle` int unsigned NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indidexerciseidbodymuscle` (`idexercise`,`idbodymuscle`) USING BTREE
) ENGINE=InnoDB COMMENT='Exercise Muscles' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO exercisemuscle(id,idexercise,idbodymuscle,elemstate,timestamp) VALUES 
(1,1,1,0,0),
(2,1,2,0,0),
(3,1,3,0,0),
(4,1,4,0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE