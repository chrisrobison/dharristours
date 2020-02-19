# MySQL dump 8.14
#
# Host: localhost    Database: dns
#--------------------------------------------------------
# Server version	3.23.49

#
# Table structure for table 'interactivate_com'
#

CREATE TABLE zonedata (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) NOT NULL default '',
  TTL int(11) NOT NULL default '28800',
  RDTYPE varchar(50) NOT NULL default '',
  RDATA varchar(200) NOT NULL default '',
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY NAME (NAME),
  KEY RDTYPE (RDTYPE),
  KEY RDATA (RDATA),
  KEY NAME_2 (NAME,RDTYPE,RDATA)
) TYPE=MyISAM;

