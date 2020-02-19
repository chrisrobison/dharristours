# MySQL dump 8.14
#
# Host: localhost    Database: stats
#--------------------------------------------------------
# Server version	3.23.39

#
# Table structure for table 'qcond'
#

CREATE TABLE qcond (
  qcondID int(11) unsigned NOT NULL auto_increment,
  queryID int(11) NOT NULL default '0',
  field varchar(100) NOT NULL default '',
  condition varchar(25) NOT NULL default '',
  value varchar(100) NOT NULL default '',
  PRIMARY KEY  (qcondID),
  KEY query (queryID)
) TYPE=MyISAM;

#
# Dumping data for table 'qcond'
#


#
# Table structure for table 'query'
#

CREATE TABLE query (
  queryID int(11) unsigned NOT NULL auto_increment,
  query varchar(100) NOT NULL default '',
  description varchar(255) NOT NULL default '',
  base_table varchar(100) NOT NULL default '',
  joins varchar(100) NOT NULL default '',
  logic varchar(10) NOT NULL default '',
  user varchar(50) NOT NULL default '',
  active tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (queryID)
) TYPE=MyISAM;

#
# Dumping data for table 'query'
#


#
# Table structure for table 'report'
#

CREATE TABLE report (
  reportID int(11) unsigned NOT NULL auto_increment,
  report varchar(100) NOT NULL default '',
  description varchar(250) NOT NULL default '',
  base_table varchar(100) NOT NULL default '',
  base_key varchar(50) NOT NULL default '',
  function_type varchar(25) NOT NULL default '',
  user varchar(25) NOT NULL default '',
  active tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (reportID)
) TYPE=MyISAM;

#
# Dumping data for table 'report'
#


