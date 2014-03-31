DROP DATABASE languify;
CREATE DATABASE `languify` DEFAULT CHARSET utf8;
USE `languify`;

CREATE TABLE `chapter` (
   `id` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `ordering` decimal(16,6) not null default '0.000000',
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `chapter` (`id`, `title`, `ordering`) VALUES
('1', 'Humble Beginnings', '100000'),
('2', 'Happy Endings',     '200000');

CREATE TABLE `paragraph` (
   `id` int(11) not null auto_increment,
   `chapter_id` int(11) not null,
   `ordering` decimal(19,9) not null default '0.000000000',
   `content` text,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`chapter_id`,`ordering`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

INSERT INTO `paragraph` (`id`, `chapter_id`, `ordering`, `content`) VALUES
('1', '1', '100000',
   'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima.'),
('2', '2', '100000',
   'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima.');

CREATE TABLE `contribution` (
   `id` int(11) not null auto_increment,
   `paragraph_id` int(11) not null,
   `email` int(11) not null,
   `status` int(11) not null,
   `description` text,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   `snapshot` text,
   `contype` varchar(255),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `part` (
   `id` int(11) not null auto_increment,
   `contribution_id` int(11) not null,
   `insdel` tinyint(4) not null default '0',
   `content` text,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `setting` (
   `id` int(11) not null auto_increment,
   `key` varchar(255) not null,
   `value` text,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`),
   UNIQUE KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=2;

INSERT INTO `setting` (`key`, `value`) VALUES 
('admin_email',         'cheongwillie@gmail.com'),
('admin_alias',         'williecheong'),
('collaborators',       ''),
('story_logo',          ''),
('story_favicon',       ''),
('story_title',         'Doing it All Over'),
('story_description',   ''),
('story_synopsis',      'Have you ever wished you could go back to your teens and re-live your life, knowing what you know now? Bill Stevens, a burned-out, 31 year old paramedic, made such a wish one night. Only his came true. Doing It All Over, first published online in 1999, is the story of a 32 year old paramedic, who wakes up one morning to find himself back as a 15 year old in 1982, with a chance to redo the crucial years of his life.'),
('font_style',          ''),
('font_colour',         ''),
('background',          '');

CREATE TABLE `feedback` (
   `id` int(11) not null auto_increment,
   `email` varchar(255),
   `message` text,
   `ip_address` varchar(255),
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE `status` (
   `status` int(11) not null auto_increment,
   `title` varchar(255) not null,
   `description` text,
   `last_updated` timestamp default current_timestamp on update current_timestamp,
   PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=4;

INSERT INTO `status` (`status`, `title`, `description`) VALUES 
('1', 'Pending', 'This contribution is undecided upon and has not been merged into the paragraph yet.'),
('2', 'Merged', 'This contribution has been merged into the paragraph.'),
('3', 'Retired', 'This contribution will not be merged into the paragraph.');