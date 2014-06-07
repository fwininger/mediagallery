CREATE TABLE IF NOT EXISTS `photos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `description` varchar(128) NOT NULL,
  `repertoire` varchar(64) NOT NULL,
  `repertoire_min` varchar(64) NOT NULL,
  `repertoire_diapo` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `photos_user` (`id`, `login`, `pass`, `description`, `repertoire`, `repertoire_min`, `repertoire_diapo`) VALUES
(1, 'user', 'password', 'Username', 'User/', 'User_mini/', 'User_diaporama/');

CREATE TABLE IF NOT EXISTS `photos_partage` (
  `id_partage` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_user_prop` int(11) NOT NULL,
  `ressource` varchar(256) NOT NULL,
  PRIMARY KEY (`id_partage`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;