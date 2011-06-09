--
-- Table structure for table `urls`, this holds all the shortened urls and associated metadata.
--
CREATE TABLE `urls` (
  `id` int(11) NOT NULL auto_increment,
  `url` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `creationDate` int(11) default NULL,
  `ip` varchar(15) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  `title` varchar(255) character set utf8 collate utf8_unicode_ci NULL default '',
  `visits` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
);
-- --------------------------------------------------------
--
-- Table structure for table `google_safe_browsing`, this holds data for the google safe browsing API. 
-- It's used to find malacious links.
--
CREATE TABLE `google_safe_browsing` (
  `hash` varchar(32) character set utf8 collate utf8_unicode_ci NOT NULL default '',
  PRIMARY KEY  (`hash`)
);
