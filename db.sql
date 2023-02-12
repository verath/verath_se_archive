--
-- Databas: `verath_db`
--
CREATE DATABASE `verath_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `verath_db`;


-- --------------------------------------------------------

--
-- Struktur för tabell `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `Name` varchar(30) NOT NULL,
  `Input` varchar(1000) NOT NULL,
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;


-- --------------------------------------------------------

--
-- Struktur för tabell `chatbotans`
--

CREATE TABLE IF NOT EXISTS `chatbotans` (
  `Question` text NOT NULL,
  `Reply` text NOT NULL,
  `QuestionVariable` varchar(100) NOT NULL,
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=39 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `chatbotmemory`
--

CREATE TABLE IF NOT EXISTS `chatbotmemory` (
  `Question` text NOT NULL,
  `Answear` text NOT NULL,
  `Ip` varchar(30) NOT NULL,
  `Id` int(12) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `Menu_left` text,
  `Content` text,
  `Id` int(11) NOT NULL auto_increment,
  `Page` varchar(50) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `forum`
--

CREATE TABLE IF NOT EXISTS `forum` (
  `Title` varchar(50) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `CategoryDesc` text NOT NULL,
  `InCategory` varchar(30) NOT NULL,
  `InCategoryId` varchar(30) NOT NULL,
  `Locked` varchar(5) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `Time` datetime default NULL,
  `Name` varchar(30) default NULL,
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=169 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `Name` varchar(30) NOT NULL,
  `Content` text,
  `TitleId` int(11) NOT NULL,
  `Time` datetime NOT NULL,
  `Deleted` int(11) NOT NULL,
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=370 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `Name` varchar(30) NOT NULL,
  `Content` text NOT NULL,
  `Time` datetime NOT NULL,
  `Id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;


-- --------------------------------------------------------

--
-- Struktur för tabell `hacking`
--

CREATE TABLE IF NOT EXISTS `hacking` (
  `Name` varchar(30) NOT NULL,
  `Level` varchar(11) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Struktur för tabell `highscore`
--

CREATE TABLE IF NOT EXISTS `highscore` (
  `UserName` varchar(15) NOT NULL default '',
  `Score` int(5) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Struktur för tabell `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `ViewsTot` int(11) default NULL,
  `Info` text NOT NULL,
  `LogedinInfo` text NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `Name` varchar(50) NOT NULL,
  `Location` varchar(120) NOT NULL,
  `Gdesc` varchar(500) default NULL,
  `Id` int(11) NOT NULL auto_increment,
  `Tag` varchar(15) NOT NULL,
  `AddedBy` varchar(30) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

-- --------------------------------------------------------

--
-- Struktur för tabell `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `SentFrom` varchar(30) NOT NULL default '',
  `SentTo` varchar(30) NOT NULL default '',
  `Content` text NOT NULL,
  `Head` varchar(100) NOT NULL default '',
  `Sent` varchar(14) NOT NULL default '',
  `Read` char(1) NOT NULL default '',
  `InboxDelete` varchar(3) NOT NULL,
  `OutboxDelete` varchar(3) NOT NULL,
  `id` int(11) NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=179 ;


--
-- Struktur för tabell `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `Question` varchar(100) NOT NULL,
  `Answer` varchar(30) default NULL,
  `Name` varchar(30) NOT NULL,
  `Id` int(11) NOT NULL auto_increment,
  `Okey` int(11) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Struktur för tabell `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserName` varchar(15) NOT NULL default '',
  `Password` varchar(40) default NULL,
  `FirstName` varchar(15) NOT NULL default '',
  `LastName` varchar(15) NOT NULL default '',
  `Email` varchar(30) NOT NULL default '',
  `Msn` varchar(50) NOT NULL,
  `msgEmail` varchar(3) NOT NULL,
  `Born` date NOT NULL,
  `twitter` text NOT NULL,
  `Lan` varchar(40) NOT NULL,
  `Created` datetime NOT NULL default '0000-00-00 00:00:00',
  `LastOnline` datetime NOT NULL default '0000-00-00 00:00:00',
  `UserVisit` varchar(4) NOT NULL default '',
  `Info` text NOT NULL,
  `Online` varchar(30) default NULL,
  `Color` varchar(6) NOT NULL,
  `Background` varchar(6) NOT NULL,
  `Viewed` int(11) default '0',
  `Id` int(11) NOT NULL auto_increment,
  `ForumLevel` int(11) default '0',
  `ForumPosts` int(11) default '0',
  PRIMARY KEY  (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;
