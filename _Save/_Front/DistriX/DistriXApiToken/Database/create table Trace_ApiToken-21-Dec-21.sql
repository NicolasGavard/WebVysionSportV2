DROP TABLE IF EXISTS trace_apitoken;
CREATE TABLE `trace_apitoken` (
`id` bigint unsigned NOT NULL AUTO_INCREMENT,
`iduser` int unsigned NOT NULL,
`databaseschema` varchar(20) NOT NULL,
`operationtable` varchar(80) NOT NULL,
`operationid` bigint NOT NULL,
`operationcode` varchar(20) NOT NULL,
`operationdate` int NOT NULL,
`operationtime` int NOT NULL,
`operationdata` longtext NOT NULL,
PRIMARY KEY (`id`),
KEY `indcode` (`operationcode`) USING BTREE,
KEY `indtablecode` (`operationtable`,`operationcode`) USING BTREE,
KEY `induser` (`iduser`,`operationdate`,`operationtime`) USING BTREE,
KEY `indusertable` (`iduser`,`operationtable`,`operationdate`,`operationtime`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Data Traces'


-- PRODUCTION  :
-- VALIDATION  :
-- VERIFICATION:
-- INTEGRATION :
-- DEV    : DONE
-- DEV Nico    : DONE