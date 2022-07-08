DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int unsigned NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idexercisetype` int unsigned NOT NULL,
  `isaudio` int unsigned NOT NULL,
  `isvideo` int unsigned NOT NULL,
  `playertype` varchar(20),
  `playerid` varchar(20),
  `linktopictureposter` varchar(150),
  `linktopicture` varchar(150),
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`idusercoach`,`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Exercise' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO exercise(id,idusercoach,code,name,idexercisetype,isaudio,isvideo,playertype,playerid,linktopictureposter,linktopicture,size,type,description,elemstate,timestamp) VALUES 
(1,1,'EXO1','Exercise 1',1,0,1,'','','videoExercice.png','videoExercice.mp4',13,'video/mp4','Desc Exo. 1',0,0),
(2,1,'EXO2','Exercise 2',2,0,1,'youtube','bTqVqk7FSmY','','',0,'','Desc Exo. 2',0,0),
(3,1,'EXO3','Exercise 3',3,0,1,'vimeo','143418951','','',0,'','Desc Exo. 3',0,0),
(4,1,'EXO4','Exercise 4',3,1,0,'','','','videoExercice.mp3',14,'audio/mp3','Desc Exo. 4',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE