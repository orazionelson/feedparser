DROP TABLE IF EXISTS `cms_feedreader_config`; 
DROP TABLE IF EXISTS `cms_feedreader_sources`; 

#
# TABLE STRUCTURE FOR: cms_feedreader_sources
#

CREATE TABLE `cms_feedreader_sources` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(256) DEFAULT NULL,
  `_created_at` timestamp NULL DEFAULT NULL,
  `_updated_at` timestamp NULL DEFAULT NULL,
  `_created_by` int(20) DEFAULT NULL,
  `_updated_by` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `cms_feedreader_sources` (`id`, `url`, `_created_at`, `_updated_at`, `_created_by`, `_updated_by`) VALUES ('1', 'http://news.nationalgeographic.com/rss/index.rss', NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: cms_feedreader_config
#

CREATE TABLE `cms_feedreader_config` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `flimit` int(5) DEFAULT NULL,
  `cache_dir` varchar(256) DEFAULT NULL,
  `cache_time` int(11) DEFAULT NULL,
  `date_format` varchar(256) DEFAULT NULL,
  `_created_at` timestamp NULL DEFAULT NULL,
  `_updated_at` timestamp NULL DEFAULT NULL,
  `_created_by` int(20) DEFAULT NULL,
  `_updated_by` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `cms_feedreader_config` (`id`, `flimit`, `cache_dir`, `cache_time`, `date_format`, `_created_at`, `_updated_at`, `_created_by`, `_updated_by`) VALUES ('1', '5', 'modules/feedreader/feedcache', '3600', 'd/m/y', '2016-02-24 00:03:22', NULL, NULL, NULL);


