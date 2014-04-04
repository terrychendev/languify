DROP DATABASE languify;
CREATE DATABASE `languify` DEFAULT CHARSET utf8;
USE `languify`;

CREATE TABLE `language` (
   `id` int(11) not null auto_increment,
   `code` varchar(255) not null,
   `name` varchar(255) not null,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `word` (
   `id` int(11) not null auto_increment,
   `tag` varchar(255) not null,
   `word` text not null,
   `category` varchar(255),
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `translation` (
   `id` int(11) not null auto_increment,
   `language_id` int(11) not null,
   `word_id` int(11) not null,
   `translation` text not null,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`language_id`, `word_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;



INSERT INTO `language` (`id`, `code`, `name`) VALUES
('1', 'en',       'english'),
('2', 'zh-tw',    'chinese traditional'),
('3', 'zh-cn',    'chinese simplified'),
('4', 'fr',       'french'),
('5', 'es',       'spanish');


INSERT INTO `word` (`id`, `tag`, `word`) VALUES
('1',    'like',        'like'),
('2',    'home',        'home'),
('3',    'about',       'about'),
('4',    'search',      'search'),
('5',    'privacy',     'privacy'),
('6',    'copyright',   'copyright'),
('7',    'disclaimer',  'disclaimer'),
('8',    'firefox',     'firefox'),
('9',    'google',      'google'),
('10',   'content',     'content'),
('11',   'add',         'add'),
('12',   'delete',      'delete'),
('13',   'bookmark',    'bookmark'),
('14',   'browse',      'browse'),
('15',   'chat',        'chat'),
('16',   'click',       'click'),
('17',   'mail',        'mail'),
('18',   'music',       'music'),
('19',   'picture',     'picture'),
('20',   'address',     'address'),
('21',   'buy',         'buy'),
('22',   'sell',        'sell');


INSERT INTO `translation` (`language_id`, `word_id`, `translation`) VALUES
('2',    '1',     '喜歡'),
('3',    '1',     '喜欢'),
('4',    '1',     'aimer'),
('5',    '1',     'gusta');


