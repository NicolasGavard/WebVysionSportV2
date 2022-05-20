DROP TABLE IF EXISTS `sociallink`;
CREATE TABLE `sociallink` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `color` varchar(255) NOT NULL,
  `colorbg` varchar(255) NOT NULL,
  `iconfa` varchar(255) NOT NULL,
  `linksocial` varchar(255) NOT NULL,
  `linktopicture` varchar(255) NOT NULL,
  `size` int unsigned NOT NULL,
  `type` varchar(255) NOT NULL,
  `timestamp` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `indiconfa` (`iconfa`)
) ENGINE=InnoDB COMMENT='Social Link' DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

INSERT INTO `sociallink` (`id`, `color`, `colorbg`, `iconfa`,`linksocial`,`linktopicture`,`size`,`type`,`timestamp`) VALUES
(1, '#ffffff', '#3b5998', 'fa-facebook','www.facebook.fr','',0,'',0),
(2, '#ffffff', '#1da1f2', 'fa-twitter','www.twitter.fr','',0,'',0),
(3, '#ffffff', '#007bb5', 'fa-linkedin','www.linkedin.fr','',0,'',0),
(4, '#ffffff', '#f46f30', 'fa-instagram','www.instagram.fr','',0,'',0),
(5, '#ffffff', '#c32361', 'fa-dribbble','www.dribbble.fr','',0,'',0),
(6, '#ffffff', '#3d464d', 'fa-dropbox','www.dropbox.fr','',0,'',0),
(7, '#ffffff', '#db4437', 'fa-google','www.google.fr','',0,'',0),
(8, '#ffffff', '#bd081c', 'fa-pinterest','www.pinterest.fr','',0,'',0),
(9, '#ffffff', '#00aff0', 'fa-skype','www.skype.fr','',0,'',0),
(10, '#ffffff', '#00b489', 'fa-vine','www.vine.fr','',0,'',0);

-- PRODUCTION   : 
-- VALIDATION   : 
-- VERIFICATION : 
-- INTEGRATION  : 
-- DEVELOPMENT  : DONE