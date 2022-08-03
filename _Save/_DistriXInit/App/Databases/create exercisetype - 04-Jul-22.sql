DROP TABLE IF EXISTS `exercisetype`;
CREATE TABLE `exercisetype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Exercise Types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO exercisetype(id,code,name,elemstate,timestamp) VALUES 
(1,'CARDIO','Cardiovascular exercise',0,0),
(2,'STRENGTH','Strength Training Exercise',0,0),
(3,'ENDURANCE','Endurance exercise',0,0),
(4,'BALANCE','Balance exercise',0,0),
(5,'STRETCHING','Stretching exercise',0,0),
(6,'MENTAL','Mental exercise',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE