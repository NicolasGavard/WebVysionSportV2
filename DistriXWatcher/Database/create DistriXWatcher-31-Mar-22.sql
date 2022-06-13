DROP TABLE IF EXISTS `distrixwatcher`;
CREATE TABLE `distrixwatcher` (
  `id` int NOT NULL AUTO_INCREMENT,
  `identerprise` int unsigned NOT NULL,
  `service` varchar(120) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `watchdate` int unsigned NOT NULL,
  `watchtime` int unsigned NOT NULL,
  `responsetime` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indservice` (`identerprise`,`service`,`watchdate`,`watchtime`)
) ENGINE=InnoDB COMMENT='DistriX Watcher' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;


-- PRODUCTION  : 
-- VALIDATION  : 
-- VERIFICATION: 
-- INTEGRATION : 
-- DEV Dev2    : DONE
-- DEV Nico    : DONE
