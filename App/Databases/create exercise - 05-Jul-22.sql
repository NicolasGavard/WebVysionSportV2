DROP TABLE IF EXISTS `exercise`;
CREATE TABLE `exercise` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `idusercoach` int unsigned NOT NULL,
  `code` varchar(80) NOT NULL,
  `name` varchar(200) NOT NULL,
  `idexercisetype` int unsigned NOT NULL,
  `linktopictureinternalposter` varchar(50) NOT NULL,
  `linktopictureinternal` varchar(150) NOT NULL,
  `linktopictureexternaltype` varchar(20) NOT NULL,
  `linktopictureexternalid` varchar(20) NOT NULL,
  `linktopictureexternal` varchar(150) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(150) NOT NULL,
  `description` varchar(150) NOT NULL,
  `elemstate` tinyint unsigned NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indcodeunique` (`idusercoach`,`code`) USING BTREE
) ENGINE=InnoDB COMMENT='Exercise' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO exercise(id,idusercoach,code,name,idexercisetype,linktopictureinternalposter,linktopictureinternal,linktopictureexternaltype,linktopictureexternalid,linktopictureexternal,size,type,description,elemstate,timestamp) VALUES 
(1,1,'EXO1','Exercise 1',1,'videoExercice.png','videoExercice.mp4','','','',0,'','Desc Exo. 1',0,0),
(2,1,'EXO2','Exercise 2',2,'','','youtube','bTqVqk7FSmY','',0,'','Desc Exo. 2',0,0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE