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
(1,'HEAD','Head',0,0),
(2,'NECK','Neck',0,0),
(3,'BACK','Back',0,0),
(4,'TRUNK','Trunk',0,0),
(5,'SHOULDER','Shoulder',0,0),
(6,'ARM','Arm',0,0),
(7,'FOREARM','Forearm',0,0),
(8,'HAND','Hand',0,0),
(9,'HIP','Hip',0,0),
(10,'THIGH','Thigh',0,0),
(11,'CALF','Calf',0,0),
(12,'FOOT','Foot',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE