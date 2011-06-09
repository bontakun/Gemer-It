--
-- Table structure for table `urls`
--
CREATE TABLE `urls` (
  `id` int(11) NOT NULL auto_increment,
  `url` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `creationDate` int(11) default NULL,
  `ip` varchar(15) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `visits` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8941 ;
-- --------------------------------------------------------
--
-- Table structure for table `google_safe_browsing`
--
CREATE TABLE `google_safe_browsing` (
  `hash` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
