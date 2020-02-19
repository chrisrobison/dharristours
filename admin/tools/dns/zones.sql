# MySQL dump 8.14
#
# Host: localhost    Database: dns
#--------------------------------------------------------
# Server version	3.23.49

#
# Table structure for table 'zones'
#

CREATE TABLE zones (
  zoneID int(8) NOT NULL auto_increment,
  domain varchar(100) NOT NULL default '',
  tablename varchar(100) NOT NULL default '',
  client varchar(100) NOT NULL default '',
  created datetime default NULL,
  modified timestamp(14) NOT NULL,
  updated int(1) default '0',
  active int(1) default '1',
  viewID int(8) NOT NULL default '0',
  dbhost varchar(100) NOT NULL default '',
  dbdb varchar(75) NOT NULL default '',
  dbuser varchar(75) NOT NULL default '',
  dbpass varchar(75) NOT NULL default '',
  PRIMARY KEY  (zoneID)
) TYPE=MyISAM;

