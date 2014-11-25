CREATE TABLE `users` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) NOT NULL DEFAULT '',
  `password` varchar(128) NOT NULL DEFAULT '',
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci'

CREATE TABLE `contents` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` varchar(128) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `target_date` date NOT NULL,
  `cnt_fact` varchar(100) DEFAULT NULL,
  `cnt_discover` varchar(100) DEFAULT NULL,
  `cnt_lesson` varchar(100) DEFAULT NULL,
  `cnt_declaration` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

insert into users values
	(1,'yuya','a6013766ad4760644885ce107ad62128b56086b082a93225f1cdc1257e9c8229','2014-11-26 00:43:06')
;

