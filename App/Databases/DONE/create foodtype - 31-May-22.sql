DROP TABLE IF EXISTS `foodtype`;
CREATE TABLE `foodtype` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Food Types' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO foodtype(id,code,name,elemstate,timestamp) VALUES 
(1,'FEC','Féculents',0,0),
(2,'LEGU','Légumes',0,0),
(3,'VIANDE','Viande',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE