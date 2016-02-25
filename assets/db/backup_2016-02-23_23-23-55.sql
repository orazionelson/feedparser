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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

