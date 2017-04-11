CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`username` varchar(25) NOT NULL,
`user_email` varchar(50) NOT NULL,
`user_role` varchar(50) NOT NULL,`user_status` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;