-- MySQL dump 8.22
--
-- Host: localhost    Database: dns
---------------------------------------------------------
-- Server version	3.23.53-log

--
-- Table structure for table '133_212_65_in_addr_arpa'
--

CREATE TABLE 133_212_65_in_addr_arpa (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '133_212_65_in_addr_arpa'
--


INSERT INTO 133_212_65_in_addr_arpa VALUES (1,'133.212.65.in-addr.arpa',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002010205 14400 3600 604800 28800',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (2,'133.212.65.in-addr.arpa',28800,'NS','dns.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (3,'133.212.65.in-addr.arpa',28800,'NS','icg.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (4,'161.133.212.65.in-addr.arpa',28800,'PTR','router.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (5,'162.133.212.65.in-addr.arpa',28800,'PTR','heimdall.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (6,'163.133.212.65.in-addr.arpa',28800,'PTR','market.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (7,'164.133.212.65.in-addr.arpa',28800,'PTR','admin.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (8,'165.133.212.65.in-addr.arpa',28800,'PTR','client-services.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (9,'166.133.212.65.in-addr.arpa',28800,'PTR','dmi.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (10,'167.133.212.65.in-addr.arpa',28800,'PTR','orwell.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (11,'168.133.212.65.in-addr.arpa',28800,'PTR','mail.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (12,'169.133.212.65.in-addr.arpa',28800,'PTR','team.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (13,'170.133.212.65.in-addr.arpa',28800,'PTR','cerebus.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (14,'171.133.212.65.in-addr.arpa',28800,'PTR','bofh.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (15,'172.133.212.65.in-addr.arpa',28800,'PTR','pfy.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (16,'173.133.212.65.in-addr.arpa',28800,'PTR','ns3.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (17,'174.133.212.65.in-addr.arpa',28800,'PTR','lappie.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (18,'175.133.212.65.in-addr.arpa',28800,'PTR','conf.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (19,'176.133.212.65.in-addr.arpa',28800,'PTR','dead-pool.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (20,'177.133.212.65.in-addr.arpa',28800,'PTR','uller.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (21,'178.133.212.65.in-addr.arpa',28800,'PTR','slacker.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (22,'179.133.212.65.in-addr.arpa',28800,'PTR','sales.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (23,'180.133.212.65.in-addr.arpa',28800,'PTR','finance.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (24,'181.133.212.65.in-addr.arpa',28800,'PTR','veepn.interactivate.com.',20030504130411);
INSERT INTO 133_212_65_in_addr_arpa VALUES (25,'localhost.133.212.65.in-addr.arpa',28800,'A','127.0.0.1',20030504130411);

--
-- Table structure for table '1_to_1mail_cc'
--

CREATE TABLE 1_to_1mail_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '1_to_1mail_cc'
--


INSERT INTO 1_to_1mail_cc VALUES (1,'1-to-1mail.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123232);
INSERT INTO 1_to_1mail_cc VALUES (2,'1-to-1mail.cc',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO 1_to_1mail_cc VALUES (3,'1-to-1mail.cc',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 1_to_1mail_cc VALUES (4,'localhost.1-to-1mail.cc',28800,'A','127.0.0.1',20030504123232);
INSERT INTO 1_to_1mail_cc VALUES (5,'localhost.1-to-1mail.cc',28800,'A','207.110.56.101',20030504123232);
INSERT INTO 1_to_1mail_cc VALUES (6,'www.1-to-1mail.cc',28800,'A','207.110.56.101',20030504123232);

--
-- Table structure for table '1to1mail_cc'
--

CREATE TABLE 1to1mail_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '1to1mail_cc'
--


INSERT INTO 1to1mail_cc VALUES (1,'1to1mail.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123232);
INSERT INTO 1to1mail_cc VALUES (2,'1to1mail.cc',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO 1to1mail_cc VALUES (3,'1to1mail.cc',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 1to1mail_cc VALUES (4,'localhost.1to1mail.cc',28800,'A','127.0.0.1',20030504123232);
INSERT INTO 1to1mail_cc VALUES (5,'localhost.1to1mail.cc',28800,'A','207.110.56.101',20030504123232);
INSERT INTO 1to1mail_cc VALUES (6,'www.1to1mail.cc',28800,'A','207.110.56.101',20030504123232);

--
-- Table structure for table '26_59_120'
--

CREATE TABLE 26_59_120 (
  ID int(12) NOT NULL auto_increment,
  NAME text,
  TTL int(11) default NULL,
  RDTYPE text,
  RDATA text,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

--
-- Dumping data for table '26_59_120'
--


INSERT INTO 26_59_120 VALUES (1,'26-59.120',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002102305 14400 3600 604800 28800',20030504123232);
INSERT INTO 26_59_120 VALUES (2,'26-59.120',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (3,'26-59.120',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (4,'225.26-59.120',28800,'PTR','gateway.26-59.120.',20030504123232);
INSERT INTO 26_59_120 VALUES (5,'226.26-59.120',28800,'PTR','icg.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (6,'227.26-59.120',28800,'PTR','216-120-59-227.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (7,'228.26-59.120',28800,'PTR','icg1.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (8,'229.26-59.120',28800,'PTR','amail.activatemail.com.26-59.120.',20030504123232);
INSERT INTO 26_59_120 VALUES (9,'230.26-59.120',28800,'PTR','www.workforce.org.',20030504123232);
INSERT INTO 26_59_120 VALUES (10,'231.26-59.120',28800,'PTR','amail.activatemail.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (11,'232.26-59.120',28800,'PTR','www.eworkforcesolutions.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (12,'233.26-59.120',28800,'PTR','216-120-59-233.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (13,'234.26-59.120',28800,'PTR','www.iid.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (14,'235.26-59.120',28800,'PTR','www.ranchocarrillo.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (15,'236.26-59.120',28800,'PTR','www.calpacifichomes.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (16,'237.26-59.120',28800,'PTR','www.euroamprop.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (17,'238.26-59.120',28800,'PTR','www.sirenaapparel.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (18,'239.26-59.120',28800,'PTR','www.santaluz.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (19,'240.26-59.120',28800,'PTR','www.elmonterey.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (20,'241.26-59.120',28800,'PTR','www.floerandplant.org.',20030504123232);
INSERT INTO 26_59_120 VALUES (21,'242.26-59.120',28800,'PTR','216-120-59-242.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (22,'243.26-59.120',28800,'PTR','www.marketingsantaluz.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (23,'244.26-59.120',28800,'PTR','www.laderaranch.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (24,'245.26-59.120',28800,'PTR','www.thejobmarket.org.',20030504123232);
INSERT INTO 26_59_120 VALUES (25,'246.26-59.120',28800,'PTR','www.simplesalad.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (26,'247.26-59.120',28800,'PTR','www.readypacproduce.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (27,'248.26-59.120',28800,'PTR','www.lyonhomes.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (28,'249.26-59.120',28800,'PTR','www.nachools.org.',20030504123232);
INSERT INTO 26_59_120 VALUES (29,'250.26-59.120',28800,'PTR','www.atomicwebdesign.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (30,'251.26-59.120',28800,'PTR','www.pfpresents.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (31,'252.26-59.120',28800,'PTR','www.cinch5.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (32,'253.26-59.120',28800,'PTR','pgsql.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (33,'254.26-59.120',28800,'PTR','mysql.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (34,'255.26-59.120',28800,'PTR','broadcast.interactivate.com.',20030504123232);
INSERT INTO 26_59_120 VALUES (35,'localhost.26-59.120',28800,'A','127.0.0.1',20030504123232);

--
-- Table structure for table '26_60_120_216'
--

CREATE TABLE 26_60_120_216 (
  ID int(12) NOT NULL auto_increment,
  NAME text,
  TTL int(11) default NULL,
  RDTYPE text,
  RDATA text,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

--
-- Dumping data for table '26_60_120_216'
--


INSERT INTO 26_60_120_216 VALUES (1,'26-60-120.216',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001112604 14400 3600 604800 28800',20030504123232);
INSERT INTO 26_60_120_216 VALUES (2,'26-60-120.216',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (3,'26-60-120.216',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (4,'1.26-60-120.216',28800,'PTR','router.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (5,'10.26-60-120.216',28800,'PTR','dev1.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (6,'11.26-60-120.216',28800,'PTR','staging.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (7,'12.26-60-120.216',28800,'PTR','creatie.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (8,'13.26-60-120.216',28800,'PTR','www.livingwreath.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (9,'14.26-60-120.216',28800,'PTR','www.provenwinners.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (10,'15.26-60-120.216',28800,'PTR','www.osbornedevelopment.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (11,'16.26-60-120.216',28800,'PTR','www.scdesigninc.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (12,'17.26-60-120.216',28800,'PTR','www.la-quinta-homes.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (13,'18.26-60-120.216',28800,'PTR','sunkist.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (14,'19.26-60-120.216',28800,'PTR','216-120-60-19.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (15,'2.26-60-120.216',28800,'PTR','www.iscapes.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (16,'20.26-60-120.216',28800,'PTR','dropbox.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (17,'3.26-60-120.216',28800,'PTR','www.seacountryhomes.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (18,'4.26-60-120.216',28800,'PTR','Cwww.robertcroemansalon.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (19,'5.26-60-120.216',28800,'PTR','www.jackabbottjr.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (20,'6.26-60-120.216',28800,'PTR','216-120-60-6.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (21,'7.26-60-120.216',28800,'PTR','www.sushidelitoo.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (22,'8.26-60-120.216',28800,'PTR','216-120-60-8.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (23,'9.26-60-120.216',28800,'PTR','dev.interactivate.com.',20030504123232);
INSERT INTO 26_60_120_216 VALUES (24,'localhost.26-60-120.216',28800,'A','127.0.0.1',20030504123232);

--
-- Table structure for table '27_133_212'
--

CREATE TABLE 27_133_212 (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '27_133_212'
--


INSERT INTO 27_133_212 VALUES (1,'27-133.212',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002010205 14400 3600 604800 28800',20030504123232);
INSERT INTO 27_133_212 VALUES (2,'27-133.212',28800,'NS','dns.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (3,'27-133.212',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (4,'161.27-133.212',28800,'PTR','router.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (5,'162.27-133.212',28800,'PTR','heimdall.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (6,'163.27-133.212',28800,'PTR','market.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (7,'164.27-133.212',28800,'PTR','admin.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (8,'165.27-133.212',28800,'PTR','client-services.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (9,'166.27-133.212',28800,'PTR','dmi.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (10,'167.27-133.212',28800,'PTR','orwell.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (11,'168.27-133.212',28800,'PTR','mail.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (12,'169.27-133.212',28800,'PTR','team.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (13,'170.27-133.212',28800,'PTR','cerebus.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (14,'171.27-133.212',28800,'PTR','bofh.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (15,'172.27-133.212',28800,'PTR','pfy.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (16,'173.27-133.212',28800,'PTR','ns3.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (17,'174.27-133.212',28800,'PTR','lappie.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (18,'175.27-133.212',28800,'PTR','conf.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (19,'176.27-133.212',28800,'PTR','dead-pool.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (20,'177.27-133.212',28800,'PTR','uller.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (21,'178.27-133.212',28800,'PTR','slacker.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (22,'179.27-133.212',28800,'PTR','sales.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (23,'180.27-133.212',28800,'PTR','finance.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (24,'181.27-133.212',28800,'PTR','veepn.interactivate.com.',20030504123232);
INSERT INTO 27_133_212 VALUES (25,'localhost.27-133.212',28800,'A','127.0.0.1',20030504123232);

--
-- Table structure for table '59_120_216_in_addr_arpa'
--

CREATE TABLE 59_120_216_in_addr_arpa (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '59_120_216_in_addr_arpa'
--


INSERT INTO 59_120_216_in_addr_arpa VALUES (1,'59.120.216.in-addr.arpa',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002102305 14400 3600 604800 28800',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (2,'59.120.216.in-addr.arpa',28800,'NS','ns.connectnet.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (3,'59.120.216.in-addr.arpa',28800,'NS','icg.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (4,'225.59.120.216.in-addr.arpa',28800,'PTR','gateway.59.120.216.in-addr.arpa.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (5,'226.59.120.216.in-addr.arpa',28800,'PTR','icg.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (6,'227.59.120.216.in-addr.arpa',28800,'PTR','216-120-59-227.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (7,'228.59.120.216.in-addr.arpa',28800,'PTR','icg1.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (8,'229.59.120.216.in-addr.arpa',28800,'PTR','amail.activatemail.com.59.120.216.in-addr.arpa.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (9,'230.59.120.216.in-addr.arpa',28800,'PTR','www.workforce.org.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (10,'231.59.120.216.in-addr.arpa',28800,'PTR','amail.activatemail.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (11,'232.59.120.216.in-addr.arpa',28800,'PTR','www.eworkforcesolutions.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (12,'233.59.120.216.in-addr.arpa',28800,'PTR','216-120-59-233.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (13,'234.59.120.216.in-addr.arpa',28800,'PTR','www.iid.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (14,'235.59.120.216.in-addr.arpa',28800,'PTR','www.ranchocarrillo.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (15,'236.59.120.216.in-addr.arpa',28800,'PTR','www.calpacifichomes.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (16,'237.59.120.216.in-addr.arpa',28800,'PTR','www.euroamprop.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (17,'238.59.120.216.in-addr.arpa',28800,'PTR','www.sirenaapparel.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (18,'239.59.120.216.in-addr.arpa',28800,'PTR','www.santaluz.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (19,'240.59.120.216.in-addr.arpa',28800,'PTR','www.elmonterey.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (20,'241.59.120.216.in-addr.arpa',28800,'PTR','www.floerandplant.org.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (21,'242.59.120.216.in-addr.arpa',28800,'PTR','216-120-59-242.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (22,'243.59.120.216.in-addr.arpa',28800,'PTR','www.marketingsantaluz.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (23,'244.59.120.216.in-addr.arpa',28800,'PTR','www.laderaranch.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (24,'245.59.120.216.in-addr.arpa',28800,'PTR','www.thejobmarket.org.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (25,'246.59.120.216.in-addr.arpa',28800,'PTR','www.simplesalad.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (26,'247.59.120.216.in-addr.arpa',28800,'PTR','www.readypacproduce.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (27,'248.59.120.216.in-addr.arpa',28800,'PTR','www.lyonhomes.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (28,'249.59.120.216.in-addr.arpa',28800,'PTR','www.nachools.org.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (29,'250.59.120.216.in-addr.arpa',28800,'PTR','www.atomicwebdesign.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (30,'251.59.120.216.in-addr.arpa',28800,'PTR','www.pfpresents.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (31,'252.59.120.216.in-addr.arpa',28800,'PTR','www.cinch5.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (32,'253.59.120.216.in-addr.arpa',28800,'PTR','pgsql.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (33,'254.59.120.216.in-addr.arpa',28800,'PTR','mysql.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (34,'255.59.120.216.in-addr.arpa',28800,'PTR','broadcast.interactivate.com.',20030504125632);
INSERT INTO 59_120_216_in_addr_arpa VALUES (35,'localhost.59.120.216.in-addr.arpa',28800,'A','127.0.0.1',20030504125632);

--
-- Table structure for table '60_120_216_in_addr_arpa'
--

CREATE TABLE 60_120_216_in_addr_arpa (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table '60_120_216_in_addr_arpa'
--


INSERT INTO 60_120_216_in_addr_arpa VALUES (1,'60.120.216.in-addr.arpa',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001112604 14400 3600 604800 28800',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (2,'60.120.216.in-addr.arpa',28800,'NS','ns.connectnet.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (3,'60.120.216.in-addr.arpa',28800,'NS','icg.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (4,'1.60.120.216.in-addr.arpa',28800,'PTR','router.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (5,'10.60.120.216.in-addr.arpa',28800,'PTR','dev1.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (6,'11.60.120.216.in-addr.arpa',28800,'PTR','staging.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (7,'12.60.120.216.in-addr.arpa',28800,'PTR','creatie.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (8,'13.60.120.216.in-addr.arpa',28800,'PTR','www.livingwreath.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (9,'14.60.120.216.in-addr.arpa',28800,'PTR','www.provenwinners.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (10,'15.60.120.216.in-addr.arpa',28800,'PTR','www.osbornedevelopment.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (11,'16.60.120.216.in-addr.arpa',28800,'PTR','www.scdesigninc.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (12,'17.60.120.216.in-addr.arpa',28800,'PTR','www.la-quinta-homes.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (13,'18.60.120.216.in-addr.arpa',28800,'PTR','sunkist.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (14,'19.60.120.216.in-addr.arpa',28800,'PTR','216-120-60-19.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (15,'2.60.120.216.in-addr.arpa',28800,'PTR','www.iscapes.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (16,'20.60.120.216.in-addr.arpa',28800,'PTR','dropbox.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (17,'3.60.120.216.in-addr.arpa',28800,'PTR','www.seacountryhomes.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (18,'4.60.120.216.in-addr.arpa',28800,'PTR','Cwww.robertcroemansalon.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (19,'5.60.120.216.in-addr.arpa',28800,'PTR','www.jackabbottjr.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (20,'6.60.120.216.in-addr.arpa',28800,'PTR','216-120-60-6.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (21,'7.60.120.216.in-addr.arpa',28800,'PTR','www.sushidelitoo.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (22,'8.60.120.216.in-addr.arpa',28800,'PTR','216-120-60-8.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (23,'9.60.120.216.in-addr.arpa',28800,'PTR','dev.interactivate.com.',20030504125748);
INSERT INTO 60_120_216_in_addr_arpa VALUES (24,'localhost.60.120.216.in-addr.arpa',28800,'A','127.0.0.1',20030504125748);

--
-- Table structure for table '63_141'
--

CREATE TABLE 63_141 (
  ID int(12) NOT NULL auto_increment,
  NAME text,
  TTL int(11) default NULL,
  RDTYPE text,
  RDATA text,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

--
-- Dumping data for table '63_141'
--


INSERT INTO 63_141 VALUES (1,'63.141',28800,'SOA','interactivate.com. hostmaster.interactivate.com. 2201051505 14400 1800 604800 28800',20030504123232);
INSERT INTO 63_141 VALUES (2,'63.141',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO 63_141 VALUES (3,'63.141',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (4,'1.63.141',28800,'PTR','router.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (5,'10.63.141',28800,'PTR','bofh.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (6,'11.63.141',28800,'PTR','pci.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (7,'12.63.141',28800,'PTR','it.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (8,'13.63.141',28800,'PTR','bd.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (9,'14.63.141',28800,'PTR','orwell.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (10,'15.63.141',28800,'PTR','mail.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (11,'16.63.141',28800,'PTR','63-141-73-16.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (12,'17.63.141',28800,'PTR','63-141-73-17.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (13,'18.63.141',28800,'PTR','63-141-73-19.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (14,'19.63.141',28800,'PTR','63-141-73-20.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (15,'2.63.141',28800,'PTR','market.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (16,'20.63.141',28800,'PTR','63-141-73-21.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (17,'21.63.141',28800,'PTR','63-141-73-22.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (18,'22.63.141',28800,'PTR','63-141-73-23.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (19,'23.63.141',28800,'PTR','63-141-73-24.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (20,'24.63.141',28800,'PTR','63-141-73-25.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (21,'25.63.141',28800,'PTR','63-141-73-26.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (22,'26.63.141',28800,'PTR','63-141-73-27.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (23,'27.63.141',28800,'PTR','63-141-73-28.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (24,'28.63.141',28800,'PTR','63-141-73-29.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (25,'29.63.141',28800,'PTR','63-141-73-30.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (26,'3.63.141',28800,'PTR','heimdall.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (27,'30.63.141',28800,'PTR','63-141-73-31.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (28,'31.63.141',28800,'PTR','63-141-73-16.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (29,'4.63.141',28800,'PTR','pm.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (30,'5.63.141',28800,'PTR','vpn.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (31,'6.63.141',28800,'PTR','63-141-73-6.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (32,'7.63.141',28800,'PTR','dmi.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (33,'8.63.141',28800,'PTR','adm.interactivate.com.',20030504123232);
INSERT INTO 63_141 VALUES (34,'9.63.141',28800,'PTR','63-141-73-9.interactivate.com.',20030504123232);

--
-- Table structure for table '773_27_141'
--

CREATE TABLE 773_27_141 (
  ID int(12) NOT NULL auto_increment,
  NAME text,
  TTL int(11) default NULL,
  RDTYPE text,
  RDATA text,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

--
-- Dumping data for table '773_27_141'
--



--
-- Table structure for table 'aballparkforsandiego_com'
--

CREATE TABLE aballparkforsandiego_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'aballparkforsandiego_com'
--


INSERT INTO aballparkforsandiego_com VALUES (1,'aballparkforsandiego.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 200108102 14400 3600 604800 28800',20030504123232);
INSERT INTO aballparkforsandiego_com VALUES (2,'aballparkforsandiego.com',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO aballparkforsandiego_com VALUES (3,'aballparkforsandiego.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO aballparkforsandiego_com VALUES (4,'localhost.aballparkforsandiego.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO aballparkforsandiego_com VALUES (5,'localhost.aballparkforsandiego.com',28800,'A','204.216.128.162',20030504123232);
INSERT INTO aballparkforsandiego_com VALUES (6,'www.aballparkforsandiego.com',28800,'A','204.216.128.162',20030504123232);

--
-- Table structure for table 'aballparkforsandiego_net'
--

CREATE TABLE aballparkforsandiego_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'aballparkforsandiego_net'
--


INSERT INTO aballparkforsandiego_net VALUES (1,'aballparkforsandiego.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 200108102 14400 3600 604800 28800',20030504123232);
INSERT INTO aballparkforsandiego_net VALUES (2,'aballparkforsandiego.net',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO aballparkforsandiego_net VALUES (3,'aballparkforsandiego.net',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO aballparkforsandiego_net VALUES (4,'localhost.aballparkforsandiego.net',28800,'A','127.0.0.1',20030504123232);
INSERT INTO aballparkforsandiego_net VALUES (5,'localhost.aballparkforsandiego.net',28800,'A','204.216.128.162',20030504123232);
INSERT INTO aballparkforsandiego_net VALUES (6,'www.aballparkforsandiego.net',28800,'A','204.216.128.162',20030504123232);

--
-- Table structure for table 'aballparkforsandiego_org'
--

CREATE TABLE aballparkforsandiego_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'aballparkforsandiego_org'
--


INSERT INTO aballparkforsandiego_org VALUES (1,'aballparkforsandiego.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 200108102 14400 3600 604800 28800',20030504123232);
INSERT INTO aballparkforsandiego_org VALUES (2,'aballparkforsandiego.org',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO aballparkforsandiego_org VALUES (3,'aballparkforsandiego.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO aballparkforsandiego_org VALUES (4,'localhost.aballparkforsandiego.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO aballparkforsandiego_org VALUES (5,'localhost.aballparkforsandiego.org',28800,'A','204.216.128.162',20030504123232);
INSERT INTO aballparkforsandiego_org VALUES (6,'www.aballparkforsandiego.org',28800,'A','204.216.128.162',20030504123232);

--
-- Table structure for table 'activatemail_cc'
--

CREATE TABLE activatemail_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'activatemail_cc'
--


INSERT INTO activatemail_cc VALUES (1,'activatemail.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007112604 14400 3600 604800 28800',20030504123232);
INSERT INTO activatemail_cc VALUES (2,'activatemail.cc',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (3,'activatemail.cc',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (4,'activatemail.cc',28800,'MX','10 mail.activatemail.cc.',20030504123232);
INSERT INTO activatemail_cc VALUES (5,'activatemail.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO activatemail_cc VALUES (6,'adm.activatemail.cc',28800,'A','63.141.73.8',20030504123232);
INSERT INTO activatemail_cc VALUES (7,'anais.activatemail.cc',28800,'A','216.120.60.17',20030621132157);
INSERT INTO activatemail_cc VALUES (8,'bart.activatemail.cc',28800,'A','209.242.137.182',20030504123232);
INSERT INTO activatemail_cc VALUES (9,'bd.activatemail.cc',28800,'A','63.141.73.13',20030504123232);
INSERT INTO activatemail_cc VALUES (10,'bofh.activatemail.cc',28800,'A','63.141.73.10',20030504123232);
INSERT INTO activatemail_cc VALUES (11,'cam-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (12,'cam-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (13,'cap-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (14,'cap-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (15,'cerebus.activatemail.cc',28800,'A','63.141.73.5',20030504123232);
INSERT INTO activatemail_cc VALUES (16,'con-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (17,'con-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (18,'creative.activatemail.cc',28800,'A','216.120.60.12',20030621132157);
INSERT INTO activatemail_cc VALUES (19,'cybermail.activatemail.cc',28800,'MX','10 mail.interactivate.unitymail.net.',20030504123232);
INSERT INTO activatemail_cc VALUES (20,'demo.activatemail.cc',28800,'CNAME','creative.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (21,'www.demo.activatemail.cc',28800,'A','216.120.60.3',20030621132157);
INSERT INTO activatemail_cc VALUES (23,'dev.activatemail.cc',28800,'A','216.120.60.9',20030621132157);
INSERT INTO activatemail_cc VALUES (24,'dev1.activatemail.cc',28800,'A','216.120.60.10',20030621132157);
INSERT INTO activatemail_cc VALUES (25,'dmi.activatemail.cc',28800,'A','63.141.73.7',20030504123232);
INSERT INTO activatemail_cc VALUES (26,'eur-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (27,'eur-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (28,'ewatch.activatemail.cc',28800,'MX','10 interactivate.unitymail.net.',20030504123232);
INSERT INTO activatemail_cc VALUES (29,'ews-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (30,'ews-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (31,'firewall.activatemail.cc',28800,'CNAME','heimdall.activatemail.cc.',20030504123232);
INSERT INTO activatemail_cc VALUES (32,'ftp.activatemail.cc',28800,'A','216.120.60.12',20030621132157);
INSERT INTO activatemail_cc VALUES (33,'heimdall.activatemail.cc',28800,'A','63.141.73.3',20030504123232);
INSERT INTO activatemail_cc VALUES (34,'hum-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (35,'hum-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (36,'iai-release.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (37,'icg.activatemail.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO activatemail_cc VALUES (38,'iid-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (39,'iid-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (40,'info.activatemail.cc',28800,'MX','10 interactivate.unitymail.net.',20030504123232);
INSERT INTO activatemail_cc VALUES (41,'isc-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (42,'isc-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (43,'it.activatemail.cc',28800,'A','63.141.73.12',20030504123232);
INSERT INTO activatemail_cc VALUES (44,'lad-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (45,'lad-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (46,'ladera.activatemail.cc',28800,'A','207.110.61.34',20030504123232);
INSERT INTO activatemail_cc VALUES (47,'localhost.activatemail.cc',28800,'A','127.0.0.1',20030504123232);
INSERT INTO activatemail_cc VALUES (48,'loghost.activatemail.cc',28800,'CNAME','www.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (49,'lyo-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (50,'lyo-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (51,'lyon.activatemail.cc',28800,'A','207.110.61.52',20030504123232);
INSERT INTO activatemail_cc VALUES (52,'mail.activatemail.cc',28800,'A','63.141.73.15',20030504123232);
INSERT INTO activatemail_cc VALUES (53,'market.activatemail.cc',28800,'A','63.141.73.2',20030504123232);
INSERT INTO activatemail_cc VALUES (54,'mysql.activatemail.cc',28800,'A','216.120.59.254',20030621132157);
INSERT INTO activatemail_cc VALUES (55,'nas.activatemail.cc',28800,'A','207.110.61.53',20030504123232);
INSERT INTO activatemail_cc VALUES (56,'nas-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (57,'nas-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (58,'new.activatemail.cc',28800,'A','207.110.61.51',20030504123232);
INSERT INTO activatemail_cc VALUES (59,'ns1.activatemail.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO activatemail_cc VALUES (60,'ns2.activatemail.cc',28800,'A','207.110.0.60',20030504123232);
INSERT INTO activatemail_cc VALUES (61,'ns3.activatemail.cc',28800,'A','63.141.73.6',20030504123232);
INSERT INTO activatemail_cc VALUES (62,'orwell.activatemail.cc',28800,'A','63.141.73.14',20030504123232);
INSERT INTO activatemail_cc VALUES (63,'osb-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (64,'osb-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (65,'padres.activatemail.cc',28800,'A','207.110.41.208',20030504123232);
INSERT INTO activatemail_cc VALUES (66,'pci.activatemail.cc',28800,'A','63.141.73.11',20030504123232);
INSERT INTO activatemail_cc VALUES (67,'pgsql.activatemail.cc',28800,'A','216.120.59.253',20030621132157);
INSERT INTO activatemail_cc VALUES (68,'pm.activatemail.cc',28800,'A','63.141.73.4',20030504123232);
INSERT INTO activatemail_cc VALUES (69,'pro-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (70,'pro-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (71,'proven.activatemail.cc',28800,'A','216.120.60.14',20030621132157);
INSERT INTO activatemail_cc VALUES (72,'rea-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (73,'rea-salad-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (74,'rea-salad-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (75,'rea-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (76,'rjt-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (77,'rjt-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (78,'router.activatemail.cc',28800,'A','63.141.73.1',20030504123232);
INSERT INTO activatemail_cc VALUES (79,'rt.activatemail.cc',28800,'A','63.141.73.17',20030504123232);
INSERT INTO activatemail_cc VALUES (80,'rui-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (81,'rui-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (82,'scd-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (83,'scd-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (84,'sdc-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (85,'sdc-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (86,'sea-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (87,'sea-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (88,'staging.activatemail.cc',28800,'A','216.120.60.11',20030621132157);
INSERT INTO activatemail_cc VALUES (89,'sunkist.activatemail.cc',28800,'A','216.120.60.18',20030621132157);
INSERT INTO activatemail_cc VALUES (90,'sus-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (91,'sus-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (92,'tay-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (93,'tay-mluz-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (94,'tay-mluz-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (95,'tay-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (96,'team.activatemail.cc',28800,'A','63.141.73.20',20030504123232);
INSERT INTO activatemail_cc VALUES (97,'vpn.activatemail.cc',28800,'CNAME','cerebus.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (98,'webcam.activatemail.cc',28800,'A','63.141.73.5',20030504123232);
INSERT INTO activatemail_cc VALUES (99,'webmail.activatemail.cc',28800,'A','216.120.59.229',20030621132157);
INSERT INTO activatemail_cc VALUES (100,'wor-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (101,'wor-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (102,'wreath-develop.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (103,'wreath-staging.activatemail.cc',28800,'CNAME','dev.interactivate.com.',20030504123232);
INSERT INTO activatemail_cc VALUES (104,'www.activatemail.cc',28800,'A','216.120.59.226',20030621132157);

--
-- Table structure for table 'activatemail_com'
--

CREATE TABLE activatemail_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'activatemail_com'
--


INSERT INTO activatemail_com VALUES (1,'activatemail.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007112610 14400 3600 604800 28800',20030504123232);
INSERT INTO activatemail_com VALUES (2,'activatemail.com',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO activatemail_com VALUES (3,'activatemail.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO activatemail_com VALUES (4,'activatemail.com',28800,'MX','10 mail.activatemail.com.',20030504123232);
INSERT INTO activatemail_com VALUES (5,'activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (6,'admin.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (7,'amail.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (8,'cvsweb.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (9,'dev.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (10,'devadmin.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (11,'localhost.activatemail.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO activatemail_com VALUES (12,'mail.activatemail.com',28800,'A','216.120.59.231',20030621132157);
INSERT INTO activatemail_com VALUES (13,'www.activatemail.com',28800,'A','216.120.59.231',20030621132157);

--
-- Table structure for table 'aguacate_info'
--

CREATE TABLE aguacate_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'aguacate_info'
--


INSERT INTO aguacate_info VALUES (1,'aguacate.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_info VALUES (2,'aguacate.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO aguacate_info VALUES (3,'aguacate.info',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO aguacate_info VALUES (4,'aguacate.info',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO aguacate_info VALUES (5,'aguacate.info',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO aguacate_info VALUES (6,'aguacate.info',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO aguacate_info VALUES (7,'aguacate.info',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO aguacate_info VALUES (8,'amric.aguacate.info',28800,'A','216.120.104.20',20030621132157);
INSERT INTO aguacate_info VALUES (9,'avoinfomx.aguacate.info',28800,'A','207.71.116.229',20030504123232);
INSERT INTO aguacate_info VALUES (10,'cac.aguacate.info',28800,'A','206.40.222.178',20030504123232);
INSERT INTO aguacate_info VALUES (11,'cac1.aguacate.info',28800,'A','209.170.17.65',20030504123232);
INSERT INTO aguacate_info VALUES (12,'crisis.aguacate.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_info VALUES (13,'dev.aguacate.info',28800,'A','216.120.104.21',20030621132157);
INSERT INTO aguacate_info VALUES (14,'extra.aguacate.info',28800,'A','216.120.59.233',20030621132157);
INSERT INTO aguacate_info VALUES (15,'handler.aguacate.info',28800,'A','207.110.32.98',20030504123232);
INSERT INTO aguacate_info VALUES (16,'localhost.aguacate.info',28800,'A','127.0.0.1',20030504123232);
INSERT INTO aguacate_info VALUES (17,'mail.aguacate.info',28800,'A','209.170.17.66',20030504123232);
INSERT INTO aguacate_info VALUES (18,'old.aguacate.info',28800,'A','216.120.104.19',20030621132157);
INSERT INTO aguacate_info VALUES (19,'owa.aguacate.info',28800,'A','209.170.17.67',20030504123232);
INSERT INTO aguacate_info VALUES (20,'updates.aguacate.info',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO aguacate_info VALUES (21,'www.aguacate.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_info VALUES (22,'xtra.aguacate.info',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'aguacate_org'
--

CREATE TABLE aguacate_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'aguacate_org'
--


INSERT INTO aguacate_org VALUES (1,'aguacate.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_org VALUES (2,'aguacate.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO aguacate_org VALUES (3,'aguacate.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO aguacate_org VALUES (4,'aguacate.org',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO aguacate_org VALUES (5,'aguacate.org',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO aguacate_org VALUES (6,'aguacate.org',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO aguacate_org VALUES (7,'aguacate.org',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO aguacate_org VALUES (8,'amric.aguacate.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO aguacate_org VALUES (9,'avoinfomx.aguacate.org',28800,'A','207.71.116.229',20030504123232);
INSERT INTO aguacate_org VALUES (10,'cac.aguacate.org',28800,'A','206.40.222.178',20030504123232);
INSERT INTO aguacate_org VALUES (11,'cac1.aguacate.org',28800,'A','209.170.17.65',20030504123232);
INSERT INTO aguacate_org VALUES (12,'crisis.aguacate.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_org VALUES (13,'dev.aguacate.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO aguacate_org VALUES (14,'extra.aguacate.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO aguacate_org VALUES (15,'handler.aguacate.org',28800,'A','207.110.32.98',20030504123232);
INSERT INTO aguacate_org VALUES (16,'localhost.aguacate.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO aguacate_org VALUES (17,'mail.aguacate.org',28800,'A','209.170.17.66',20030504123232);
INSERT INTO aguacate_org VALUES (18,'old.aguacate.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO aguacate_org VALUES (19,'owa.aguacate.org',28800,'A','209.170.17.67',20030504123232);
INSERT INTO aguacate_org VALUES (20,'updates.aguacate.org',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO aguacate_org VALUES (21,'www.aguacate.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO aguacate_org VALUES (22,'xtra.aguacate.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'atomicwebdesign_com'
--

CREATE TABLE atomicwebdesign_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'atomicwebdesign_com'
--


INSERT INTO atomicwebdesign_com VALUES (1,'atomicwebdesign.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001101704 14400 3600 604800 28800',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (2,'atomicwebdesign.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (3,'atomicwebdesign.com',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (4,'atomicwebdesign.com',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (5,'dev.atomicwebdesign.com',28800,'A','65.212.133.190',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (6,'localhost.atomicwebdesign.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (7,'mail.atomicwebdesign.com',28800,'A','65.212.133.168',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (8,'staging.atomicwebdesign.com',28800,'A','65.212.133.190',20030504123232);
INSERT INTO atomicwebdesign_com VALUES (9,'www.atomicwebdesign.com',28800,'A','216.120.59.250',20030621132157);
INSERT INTO atomicwebdesign_com VALUES (11,'www2.atomicwebdesign.com',28800,'A','216.120.59.227',20030803190120);

--
-- Table structure for table 'avocado_org'
--

CREATE TABLE avocado_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'avocado_org'
--


INSERT INTO avocado_org VALUES (1,'avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocado_org VALUES (2,'avocado.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003042502 14400 3600 604800 28800',20030721115022);
INSERT INTO avocado_org VALUES (3,'avocado.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO avocado_org VALUES (4,'avocado.org',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO avocado_org VALUES (5,'avocado.org',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO avocado_org VALUES (6,'avocado.org',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO avocado_org VALUES (7,'avocado.org',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO avocado_org VALUES (8,'amric.avocado.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO avocado_org VALUES (9,'avoinfomx.avocado.org',28800,'A','207.71.116.229',20030504123232);
INSERT INTO avocado_org VALUES (10,'cac.avocado.org',28800,'A','206.40.222.178',20030504123232);
INSERT INTO avocado_org VALUES (11,'cac1.avocado.org',28800,'A','209.170.17.65',20030504123232);
INSERT INTO avocado_org VALUES (12,'crisis.avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocado_org VALUES (13,'dev.avocado.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO avocado_org VALUES (14,'extra.avocado.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO avocado_org VALUES (15,'handler.avocado.org',28800,'A','207.110.32.98',20030504123232);
INSERT INTO avocado_org VALUES (16,'localhost.avocado.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO avocado_org VALUES (17,'mail.avocado.org',28800,'A','66.210.55.138',20030504123232);
INSERT INTO avocado_org VALUES (18,'old.avocado.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO avocado_org VALUES (19,'owa.avocado.org',28800,'A','209.170.17.67',20030504123232);
INSERT INTO avocado_org VALUES (20,'updates.avocado.org',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO avocado_org VALUES (21,'www.avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocado_org VALUES (22,'xtra.avocado.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO avocado_org VALUES (23,'gw.avocado.org',28800,'A','66.210.55.138',20030721115022);
INSERT INTO avocado_org VALUES (25,'www2.avocado.org',28800,'A','216.120.59.227',20030803190121);

--
-- Table structure for table 'avocados_org'
--

CREATE TABLE avocados_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'avocados_org'
--


INSERT INTO avocados_org VALUES (1,'avocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocados_org VALUES (2,'avocados.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO avocados_org VALUES (3,'avocados.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO avocados_org VALUES (4,'avocados.org',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO avocados_org VALUES (5,'avocados.org',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO avocados_org VALUES (6,'avocados.org',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO avocados_org VALUES (7,'avocados.org',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO avocados_org VALUES (8,'amric.avocados.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO avocados_org VALUES (9,'avoinfomx.avocados.org',28800,'A','207.71.116.229',20030504123232);
INSERT INTO avocados_org VALUES (10,'cac.avocados.org',28800,'A','206.40.222.178',20030504123232);
INSERT INTO avocados_org VALUES (11,'cac1.avocados.org',28800,'A','209.170.17.65',20030504123232);
INSERT INTO avocados_org VALUES (12,'crisis.avocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocados_org VALUES (13,'dev.avocados.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO avocados_org VALUES (14,'extra.avocados.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO avocados_org VALUES (15,'handler.avocados.org',28800,'A','207.110.32.98',20030504123232);
INSERT INTO avocados_org VALUES (16,'localhost.avocados.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO avocados_org VALUES (17,'mail.avocados.org',28800,'A','209.170.17.66',20030504123232);
INSERT INTO avocados_org VALUES (18,'old.avocados.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO avocados_org VALUES (19,'owa.avocados.org',28800,'A','209.170.17.67',20030504123232);
INSERT INTO avocados_org VALUES (20,'updates.avocados.org',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO avocados_org VALUES (21,'www.avocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avocados_org VALUES (22,'xtra.avocados.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'avoinfo_com'
--

CREATE TABLE avoinfo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'avoinfo_com'
--


INSERT INTO avoinfo_com VALUES (1,'avoinfo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avoinfo_com VALUES (2,'avoinfo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO avoinfo_com VALUES (3,'avoinfo.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO avoinfo_com VALUES (4,'avoinfo.com',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO avoinfo_com VALUES (5,'avoinfo.com',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO avoinfo_com VALUES (6,'avoinfo.com',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO avoinfo_com VALUES (7,'avoinfo.com',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO avoinfo_com VALUES (8,'amric.avoinfo.com',28800,'A','216.120.104.20',20030621132157);
INSERT INTO avoinfo_com VALUES (9,'avoinfomx.avoinfo.com',28800,'A','207.71.116.229',20030504123232);
INSERT INTO avoinfo_com VALUES (10,'cac.avoinfo.com',28800,'A','206.40.222.178',20030504123232);
INSERT INTO avoinfo_com VALUES (11,'cac1.avoinfo.com',28800,'A','209.170.17.65',20030504123232);
INSERT INTO avoinfo_com VALUES (12,'crisis.avoinfo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avoinfo_com VALUES (13,'dev.avoinfo.com',28800,'A','216.120.104.21',20030621132157);
INSERT INTO avoinfo_com VALUES (14,'extra.avoinfo.com',28800,'A','216.120.59.233',20030621132157);
INSERT INTO avoinfo_com VALUES (15,'handler.avoinfo.com',28800,'A','207.110.32.98',20030504123232);
INSERT INTO avoinfo_com VALUES (16,'localhost.avoinfo.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO avoinfo_com VALUES (17,'mail.avoinfo.com',28800,'A','209.170.17.66',20030504123232);
INSERT INTO avoinfo_com VALUES (18,'old.avoinfo.com',28800,'A','216.120.104.19',20030621132157);
INSERT INTO avoinfo_com VALUES (19,'owa.avoinfo.com',28800,'A','209.170.17.67',20030504123232);
INSERT INTO avoinfo_com VALUES (20,'updates.avoinfo.com',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO avoinfo_com VALUES (21,'www.avoinfo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO avoinfo_com VALUES (22,'xtra.avoinfo.com',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'billmageeblues_com'
--

CREATE TABLE billmageeblues_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'billmageeblues_com'
--


INSERT INTO billmageeblues_com VALUES (1,'billmageeblues.com',28800,'A','216.120.59.240',20030621132157);
INSERT INTO billmageeblues_com VALUES (2,'billmageeblues.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002042903 14400 3600 604800 28800',20030504123232);
INSERT INTO billmageeblues_com VALUES (3,'billmageeblues.com',28800,'NS','ns.connectnet.com.',20030504123232);
INSERT INTO billmageeblues_com VALUES (4,'billmageeblues.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO billmageeblues_com VALUES (5,'localhost.billmageeblues.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO billmageeblues_com VALUES (6,'www.billmageeblues.com',28800,'A','216.120.59.240',20030621132157);
INSERT INTO billmageeblues_com VALUES (8,'www2.billmageeblues.com',28800,'A','216.120.59.227',20030803190121);

--
-- Table structure for table 'bringcannyhome_com'
--

CREATE TABLE bringcannyhome_com (
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

--
-- Dumping data for table 'bringcannyhome_com'
--


INSERT INTO bringcannyhome_com VALUES (1,'bringcannyhome.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003061605 14400 3600 604800 28800',20030717001913);
INSERT INTO bringcannyhome_com VALUES (2,'bringcannyhome.com',28800,'NS','icg.interactivate.com.',20030616195826);
INSERT INTO bringcannyhome_com VALUES (3,'bringcannyhome.com',28800,'NS','ns2.interactivate.com.',20030616195826);
INSERT INTO bringcannyhome_com VALUES (4,'bringcannyhome.com',28800,'NS','ns3.interactivate.com.',20030616195826);
INSERT INTO bringcannyhome_com VALUES (5,'bringcannyhome.com',28800,'A','216.120.60.12',20030621132157);
INSERT INTO bringcannyhome_com VALUES (6,'www.bringcannyhome.com',28800,'A','216.120.60.12',20030621132157);
INSERT INTO bringcannyhome_com VALUES (7,'bringcannyhome.com',28800,'MX','10 mail.interactivate.com.',20030717001913);
INSERT INTO bringcannyhome_com VALUES (9,'www2.bringcannyhome.com',28800,'A','216.120.59.227',20030803190159);

--
-- Table structure for table 'bringourcannyhome_org'
--

CREATE TABLE bringourcannyhome_org (
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

--
-- Dumping data for table 'bringourcannyhome_org'
--


INSERT INTO bringourcannyhome_org VALUES (1,'bringourcannyhome.org',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003062507 14400 3600 604800 28800',20030625163447);
INSERT INTO bringourcannyhome_org VALUES (2,'bringourcannyhome.org',28800,'NS','icg.interactivate.com.',20030625162837);
INSERT INTO bringourcannyhome_org VALUES (3,'bringourcannyhome.org',28800,'NS','ns2.interactivate.com.',20030625162837);
INSERT INTO bringourcannyhome_org VALUES (4,'bringourcannyhome.org',28800,'NS','ns3.interactivate.com.',20030625162837);
INSERT INTO bringourcannyhome_org VALUES (5,'bringourcannyhome.org',28800,'A','216.120.59.228',20030625163422);
INSERT INTO bringourcannyhome_org VALUES (6,'www.bringourcannyhome.org',28800,'A','216.120.59.228',20030625163447);

--
-- Table structure for table 'calflowers_com'
--

CREATE TABLE calflowers_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'calflowers_com'
--


INSERT INTO calflowers_com VALUES (1,'calflowers.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123232);
INSERT INTO calflowers_com VALUES (2,'calflowers.com',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO calflowers_com VALUES (3,'calflowers.com',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO calflowers_com VALUES (4,'localhost.calflowers.com',28800,'A','127.0.0.1',20030504123232);
INSERT INTO calflowers_com VALUES (5,'www.calflowers.com',28800,'A','207.110.56.101',20030504123232);

--
-- Table structure for table 'calflowers_net'
--

CREATE TABLE calflowers_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'calflowers_net'
--


INSERT INTO calflowers_net VALUES (1,'calflowers.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123232);
INSERT INTO calflowers_net VALUES (2,'calflowers.net',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO calflowers_net VALUES (3,'calflowers.net',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO calflowers_net VALUES (4,'localhost.calflowers.net',28800,'A','127.0.0.1',20030504123232);
INSERT INTO calflowers_net VALUES (5,'www.calflowers.net',28800,'A','207.110.56.101',20030504123232);

--
-- Table structure for table 'calflowers_org'
--

CREATE TABLE calflowers_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'calflowers_org'
--


INSERT INTO calflowers_org VALUES (1,'calflowers.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123232);
INSERT INTO calflowers_org VALUES (2,'calflowers.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO calflowers_org VALUES (3,'calflowers.org',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO calflowers_org VALUES (4,'localhost.calflowers.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO calflowers_org VALUES (5,'www.calflowers.org',28800,'A','207.110.56.101',20030504123232);

--
-- Table structure for table 'california_avocado_org'
--

CREATE TABLE california_avocado_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'california_avocado_org'
--


INSERT INTO california_avocado_org VALUES (1,'california-avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO california_avocado_org VALUES (2,'california-avocado.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO california_avocado_org VALUES (3,'california-avocado.org',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO california_avocado_org VALUES (4,'california-avocado.org',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO california_avocado_org VALUES (5,'california-avocado.org',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO california_avocado_org VALUES (6,'california-avocado.org',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO california_avocado_org VALUES (7,'california-avocado.org',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO california_avocado_org VALUES (8,'amric.california-avocado.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO california_avocado_org VALUES (9,'avoinfomx.california-avocado.org',28800,'A','207.71.116.229',20030504123232);
INSERT INTO california_avocado_org VALUES (10,'cac.california-avocado.org',28800,'A','206.40.222.178',20030504123232);
INSERT INTO california_avocado_org VALUES (11,'cac1.california-avocado.org',28800,'A','209.170.17.65',20030504123232);
INSERT INTO california_avocado_org VALUES (12,'crisis.california-avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO california_avocado_org VALUES (13,'dev.california-avocado.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO california_avocado_org VALUES (14,'extra.california-avocado.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO california_avocado_org VALUES (15,'handler.california-avocado.org',28800,'A','207.110.32.98',20030504123232);
INSERT INTO california_avocado_org VALUES (16,'localhost.california-avocado.org',28800,'A','127.0.0.1',20030504123232);
INSERT INTO california_avocado_org VALUES (17,'mail.california-avocado.org',28800,'A','209.170.17.66',20030504123232);
INSERT INTO california_avocado_org VALUES (18,'old.california-avocado.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO california_avocado_org VALUES (19,'owa.california-avocado.org',28800,'A','209.170.17.67',20030504123232);
INSERT INTO california_avocado_org VALUES (20,'updates.california-avocado.org',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO california_avocado_org VALUES (21,'www.california-avocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO california_avocado_org VALUES (22,'xtra.california-avocado.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'californiaavocado_info'
--

CREATE TABLE californiaavocado_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'californiaavocado_info'
--


INSERT INTO californiaavocado_info VALUES (1,'californiaavocado.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_info VALUES (2,'californiaavocado.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123232);
INSERT INTO californiaavocado_info VALUES (3,'californiaavocado.info',28800,'NS','icg.interactivate.com.',20030504123232);
INSERT INTO californiaavocado_info VALUES (4,'californiaavocado.info',28800,'NS','ns2.interactivate.com.',20030504123232);
INSERT INTO californiaavocado_info VALUES (5,'californiaavocado.info',28800,'NS','ns3.interactivate.com.',20030504123232);
INSERT INTO californiaavocado_info VALUES (6,'californiaavocado.info',28800,'MX','10 mail.avocado.org.',20030504123232);
INSERT INTO californiaavocado_info VALUES (7,'californiaavocado.info',28800,'MX','20 relay1.eni.net.',20030504123232);
INSERT INTO californiaavocado_info VALUES (8,'amric.californiaavocado.info',28800,'A','216.120.104.20',20030621132157);
INSERT INTO californiaavocado_info VALUES (9,'avoinfomx.californiaavocado.info',28800,'A','207.71.116.229',20030504123232);
INSERT INTO californiaavocado_info VALUES (10,'cac.californiaavocado.info',28800,'A','206.40.222.178',20030504123232);
INSERT INTO californiaavocado_info VALUES (11,'cac1.californiaavocado.info',28800,'A','209.170.17.65',20030504123232);
INSERT INTO californiaavocado_info VALUES (12,'crisis.californiaavocado.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_info VALUES (13,'dev.californiaavocado.info',28800,'A','216.120.104.21',20030621132157);
INSERT INTO californiaavocado_info VALUES (14,'extra.californiaavocado.info',28800,'A','216.120.59.233',20030621132157);
INSERT INTO californiaavocado_info VALUES (15,'handler.californiaavocado.info',28800,'A','207.110.32.98',20030504123232);
INSERT INTO californiaavocado_info VALUES (16,'localhost.californiaavocado.info',28800,'A','127.0.0.1',20030504123232);
INSERT INTO californiaavocado_info VALUES (17,'mail.californiaavocado.info',28800,'A','209.170.17.66',20030504123232);
INSERT INTO californiaavocado_info VALUES (18,'old.californiaavocado.info',28800,'A','216.120.104.19',20030621132157);
INSERT INTO californiaavocado_info VALUES (19,'owa.californiaavocado.info',28800,'A','209.170.17.67',20030504123232);
INSERT INTO californiaavocado_info VALUES (20,'updates.californiaavocado.info',28800,'MX','10 mail.interactivate.com.',20030504123232);
INSERT INTO californiaavocado_info VALUES (21,'www.californiaavocado.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_info VALUES (22,'xtra.californiaavocado.info',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'californiaavocado_org'
--

CREATE TABLE californiaavocado_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'californiaavocado_org'
--


INSERT INTO californiaavocado_org VALUES (1,'californiaavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_org VALUES (2,'californiaavocado.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123233);
INSERT INTO californiaavocado_org VALUES (3,'californiaavocado.org',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO californiaavocado_org VALUES (4,'californiaavocado.org',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO californiaavocado_org VALUES (5,'californiaavocado.org',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO californiaavocado_org VALUES (6,'californiaavocado.org',28800,'MX','10 mail.avocado.org.',20030504123233);
INSERT INTO californiaavocado_org VALUES (7,'californiaavocado.org',28800,'MX','20 relay1.eni.net.',20030504123233);
INSERT INTO californiaavocado_org VALUES (8,'amric.californiaavocado.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO californiaavocado_org VALUES (9,'avoinfomx.californiaavocado.org',28800,'A','207.71.116.229',20030504123233);
INSERT INTO californiaavocado_org VALUES (10,'cac.californiaavocado.org',28800,'A','206.40.222.178',20030504123233);
INSERT INTO californiaavocado_org VALUES (11,'cac1.californiaavocado.org',28800,'A','209.170.17.65',20030504123233);
INSERT INTO californiaavocado_org VALUES (12,'crisis.californiaavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_org VALUES (13,'dev.californiaavocado.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO californiaavocado_org VALUES (14,'extra.californiaavocado.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO californiaavocado_org VALUES (15,'handler.californiaavocado.org',28800,'A','207.110.32.98',20030504123233);
INSERT INTO californiaavocado_org VALUES (16,'localhost.californiaavocado.org',28800,'A','127.0.0.1',20030504123233);
INSERT INTO californiaavocado_org VALUES (17,'mail.californiaavocado.org',28800,'A','209.170.17.66',20030504123233);
INSERT INTO californiaavocado_org VALUES (18,'old.californiaavocado.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO californiaavocado_org VALUES (19,'owa.californiaavocado.org',28800,'A','209.170.17.67',20030504123233);
INSERT INTO californiaavocado_org VALUES (20,'updates.californiaavocado.org',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO californiaavocado_org VALUES (21,'www.californiaavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocado_org VALUES (22,'xtra.californiaavocado.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'californiaavocados_info'
--

CREATE TABLE californiaavocados_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'californiaavocados_info'
--


INSERT INTO californiaavocados_info VALUES (1,'californiaavocados.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_info VALUES (2,'californiaavocados.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123233);
INSERT INTO californiaavocados_info VALUES (3,'californiaavocados.info',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_info VALUES (4,'californiaavocados.info',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_info VALUES (5,'californiaavocados.info',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_info VALUES (6,'californiaavocados.info',28800,'MX','10 mail.avocado.org.',20030504123233);
INSERT INTO californiaavocados_info VALUES (7,'californiaavocados.info',28800,'MX','20 relay1.eni.net.',20030504123233);
INSERT INTO californiaavocados_info VALUES (8,'amric.californiaavocados.info',28800,'A','216.120.104.20',20030621132157);
INSERT INTO californiaavocados_info VALUES (9,'avoinfomx.californiaavocados.info',28800,'A','207.71.116.229',20030504123233);
INSERT INTO californiaavocados_info VALUES (10,'cac.californiaavocados.info',28800,'A','206.40.222.178',20030504123233);
INSERT INTO californiaavocados_info VALUES (11,'cac1.californiaavocados.info',28800,'A','209.170.17.65',20030504123233);
INSERT INTO californiaavocados_info VALUES (12,'crisis.californiaavocados.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_info VALUES (13,'dev.californiaavocados.info',28800,'A','216.120.104.21',20030621132157);
INSERT INTO californiaavocados_info VALUES (14,'extra.californiaavocados.info',28800,'A','216.120.59.233',20030621132157);
INSERT INTO californiaavocados_info VALUES (15,'handler.californiaavocados.info',28800,'A','207.110.32.98',20030504123233);
INSERT INTO californiaavocados_info VALUES (16,'localhost.californiaavocados.info',28800,'A','127.0.0.1',20030504123233);
INSERT INTO californiaavocados_info VALUES (17,'mail.californiaavocados.info',28800,'A','209.170.17.66',20030504123233);
INSERT INTO californiaavocados_info VALUES (18,'old.californiaavocados.info',28800,'A','216.120.104.19',20030621132157);
INSERT INTO californiaavocados_info VALUES (19,'owa.californiaavocados.info',28800,'A','209.170.17.67',20030504123233);
INSERT INTO californiaavocados_info VALUES (20,'updates.californiaavocados.info',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_info VALUES (21,'www.californiaavocados.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_info VALUES (22,'xtra.californiaavocados.info',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'californiaavocados_org'
--

CREATE TABLE californiaavocados_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'californiaavocados_org'
--


INSERT INTO californiaavocados_org VALUES (1,'californiaavocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_org VALUES (2,'californiaavocados.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123233);
INSERT INTO californiaavocados_org VALUES (3,'californiaavocados.org',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_org VALUES (4,'californiaavocados.org',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_org VALUES (5,'californiaavocados.org',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_org VALUES (6,'californiaavocados.org',28800,'MX','10 mail.avocado.org.',20030504123233);
INSERT INTO californiaavocados_org VALUES (7,'californiaavocados.org',28800,'MX','20 relay1.eni.net.',20030504123233);
INSERT INTO californiaavocados_org VALUES (8,'amric.californiaavocados.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO californiaavocados_org VALUES (9,'avoinfomx.californiaavocados.org',28800,'A','207.71.116.229',20030504123233);
INSERT INTO californiaavocados_org VALUES (10,'cac.californiaavocados.org',28800,'A','206.40.222.178',20030504123233);
INSERT INTO californiaavocados_org VALUES (11,'cac1.californiaavocados.org',28800,'A','209.170.17.65',20030504123233);
INSERT INTO californiaavocados_org VALUES (12,'crisis.californiaavocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_org VALUES (13,'dev.californiaavocados.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO californiaavocados_org VALUES (14,'extra.californiaavocados.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO californiaavocados_org VALUES (15,'handler.californiaavocados.org',28800,'A','207.110.32.98',20030504123233);
INSERT INTO californiaavocados_org VALUES (16,'localhost.californiaavocados.org',28800,'A','127.0.0.1',20030504123233);
INSERT INTO californiaavocados_org VALUES (17,'mail.californiaavocados.org',28800,'A','209.170.17.66',20030504123233);
INSERT INTO californiaavocados_org VALUES (18,'old.californiaavocados.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO californiaavocados_org VALUES (19,'owa.californiaavocados.org',28800,'A','209.170.17.67',20030504123233);
INSERT INTO californiaavocados_org VALUES (20,'updates.californiaavocados.org',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO californiaavocados_org VALUES (21,'www.californiaavocados.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO californiaavocados_org VALUES (22,'xtra.californiaavocados.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'californiapacifichomes_com'
--

CREATE TABLE californiapacifichomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'californiapacifichomes_com'
--


INSERT INTO californiapacifichomes_com VALUES (1,'californiapacifichomes.com',28800,'A','216.120.59.236',20030621132157);
INSERT INTO californiapacifichomes_com VALUES (2,'californiapacifichomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003040703 14400 3600 604800 28800',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (3,'californiapacifichomes.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (4,'californiapacifichomes.com',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (5,'californiapacifichomes.com',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (6,'californiapacifichomes.com',28800,'MX','10 mail.calpacifichomes.com.',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (7,'mail.californiapacifichomes.com',28800,'A','64.173.247.171',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (8,'updates.californiapacifichomes.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO californiapacifichomes_com VALUES (9,'updates.californiapacifichomes.com',28800,'A','216.120.59.236',20030621132157);
INSERT INTO californiapacifichomes_com VALUES (10,'www.californiapacifichomes.com',28800,'A','216.120.59.236',20030621132157);

--
-- Table structure for table 'caliskids_com'
--

CREATE TABLE caliskids_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'caliskids_com'
--


INSERT INTO caliskids_com VALUES (1,'caliskids.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO caliskids_com VALUES (2,'caliskids.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123233);
INSERT INTO caliskids_com VALUES (3,'caliskids.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO caliskids_com VALUES (4,'caliskids.com',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO caliskids_com VALUES (5,'caliskids.com',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO caliskids_com VALUES (6,'caliskids.com',28800,'MX','10 mail.avocado.org.',20030504123233);
INSERT INTO caliskids_com VALUES (7,'caliskids.com',28800,'MX','20 relay1.eni.net.',20030504123233);
INSERT INTO caliskids_com VALUES (8,'amric.caliskids.com',28800,'A','216.120.104.20',20030621132157);
INSERT INTO caliskids_com VALUES (9,'avoinfomx.caliskids.com',28800,'A','207.71.116.229',20030504123233);
INSERT INTO caliskids_com VALUES (10,'cac.caliskids.com',28800,'A','206.40.222.178',20030504123233);
INSERT INTO caliskids_com VALUES (11,'cac1.caliskids.com',28800,'A','209.170.17.65',20030504123233);
INSERT INTO caliskids_com VALUES (12,'crisis.caliskids.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO caliskids_com VALUES (13,'dev.caliskids.com',28800,'A','216.120.104.21',20030621132157);
INSERT INTO caliskids_com VALUES (14,'extra.caliskids.com',28800,'A','216.120.59.233',20030621132157);
INSERT INTO caliskids_com VALUES (15,'handler.caliskids.com',28800,'A','207.110.32.98',20030504123233);
INSERT INTO caliskids_com VALUES (16,'localhost.caliskids.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO caliskids_com VALUES (17,'mail.caliskids.com',28800,'A','209.170.17.66',20030504123233);
INSERT INTO caliskids_com VALUES (18,'old.caliskids.com',28800,'A','216.120.104.19',20030621132157);
INSERT INTO caliskids_com VALUES (19,'owa.caliskids.com',28800,'A','209.170.17.67',20030504123233);
INSERT INTO caliskids_com VALUES (20,'updates.caliskids.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO caliskids_com VALUES (21,'www.caliskids.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO caliskids_com VALUES (22,'xtra.caliskids.com',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'calpacifichomes_com'
--

CREATE TABLE calpacifichomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'calpacifichomes_com'
--


INSERT INTO calpacifichomes_com VALUES (1,'calpacifichomes.com',28800,'A','216.120.59.236',20030621132157);
INSERT INTO calpacifichomes_com VALUES (2,'calpacifichomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003040703 14400 3600 604800 28800',20030504123233);
INSERT INTO calpacifichomes_com VALUES (3,'calpacifichomes.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO calpacifichomes_com VALUES (4,'calpacifichomes.com',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO calpacifichomes_com VALUES (5,'calpacifichomes.com',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO calpacifichomes_com VALUES (6,'calpacifichomes.com',28800,'MX','10 mail.calpacifichomes.com.',20030504123233);
INSERT INTO calpacifichomes_com VALUES (7,'mail.calpacifichomes.com',28800,'A','64.173.247.171',20030504123233);
INSERT INTO calpacifichomes_com VALUES (8,'updates.calpacifichomes.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO calpacifichomes_com VALUES (9,'updates.calpacifichomes.com',28800,'A','216.120.59.236',20030621132157);
INSERT INTO calpacifichomes_com VALUES (10,'www.calpacifichomes.com',28800,'A','216.120.59.236',20030621132157);
INSERT INTO calpacifichomes_com VALUES (12,'www2.calpacifichomes.com',28800,'A','216.120.59.227',20030803190123);

--
-- Table structure for table 'centexsouthcoast_com'
--

CREATE TABLE centexsouthcoast_com (
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

--
-- Dumping data for table 'centexsouthcoast_com'
--


INSERT INTO centexsouthcoast_com VALUES (1,'centexsouthcoast.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003072103 14400 3600 604800 28800',20030721181346);
INSERT INTO centexsouthcoast_com VALUES (2,'centexsouthcoast.com',28800,'NS','icg.interactivate.com.',20030721181322);
INSERT INTO centexsouthcoast_com VALUES (3,'centexsouthcoast.com',28800,'NS','ns2.interactivate.com.',20030721181322);
INSERT INTO centexsouthcoast_com VALUES (4,'centexsouthcoast.com',28800,'NS','ns3.interactivate.com.',20030721181322);
INSERT INTO centexsouthcoast_com VALUES (5,'centexsouthcoast.com',28800,'A','216.120.59.228',20030721181334);
INSERT INTO centexsouthcoast_com VALUES (6,'www.centexsouthcoast.com',28800,'A','216.120.59.228',20030721181346);
INSERT INTO centexsouthcoast_com VALUES (8,'www2.centexsouthcoast.com',28800,'A','216.120.59.227',20030803190203);

--
-- Table structure for table 'changeage_com'
--

CREATE TABLE changeage_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'changeage_com'
--


INSERT INTO changeage_com VALUES (1,'changeage.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO changeage_com VALUES (2,'changeage.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002053103 14400 3600 604800 28800',20030504123233);
INSERT INTO changeage_com VALUES (3,'changeage.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO changeage_com VALUES (4,'changeage.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO changeage_com VALUES (5,'changeage.com',28800,'MX','10 mail.changeage.com.',20030504123233);
INSERT INTO changeage_com VALUES (6,'localhost.changeage.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO changeage_com VALUES (7,'mail.changeage.com',28800,'CNAME','mail.interactivate.com.',20030504123233);
INSERT INTO changeage_com VALUES (8,'www.changeage.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO changeage_com VALUES (10,'www2.changeage.com',28800,'A','216.120.59.227',20030803190123);

--
-- Table structure for table 'changeage_net'
--

CREATE TABLE changeage_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'changeage_net'
--


INSERT INTO changeage_net VALUES (1,'changeage.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123233);
INSERT INTO changeage_net VALUES (2,'changeage.net',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO changeage_net VALUES (3,'changeage.net',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO changeage_net VALUES (4,'localhost.changeage.net',28800,'A','127.0.0.1',20030504123233);

--
-- Table structure for table 'changeage_org'
--

CREATE TABLE changeage_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'changeage_org'
--


INSERT INTO changeage_org VALUES (1,'changeage.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123233);
INSERT INTO changeage_org VALUES (2,'changeage.org',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO changeage_org VALUES (3,'changeage.org',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO changeage_org VALUES (4,'localhost.changeage.org',28800,'A','127.0.0.1',20030504123233);

--
-- Table structure for table 'cinch5_com'
--

CREATE TABLE cinch5_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'cinch5_com'
--


INSERT INTO cinch5_com VALUES (1,'cinch5.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123233);
INSERT INTO cinch5_com VALUES (2,'cinch5.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO cinch5_com VALUES (3,'cinch5.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO cinch5_com VALUES (4,'localhost.cinch5.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO cinch5_com VALUES (5,'www.cinch5.com',28800,'A','216.120.59.252',20030621132157);
INSERT INTO cinch5_com VALUES (8,'www2.cinch5.com',28800,'A','216.120.59.227',20030803190124);

--
-- Table structure for table 'davidsoncommunities_com'
--

CREATE TABLE davidsoncommunities_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'davidsoncommunities_com'
--


INSERT INTO davidsoncommunities_com VALUES (1,'davidsoncommunities.com',28800,'A','216.120.59.253',20030621132157);
INSERT INTO davidsoncommunities_com VALUES (2,'davidsoncommunities.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002121603 14400 3600 604800 28800',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (3,'davidsoncommunities.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (4,'davidsoncommunities.com',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (5,'davidsoncommunities.com',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (6,'localhost.davidsoncommunities.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (7,'updates.davidsoncommunities.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO davidsoncommunities_com VALUES (8,'www.davidsoncommunities.com',28800,'A','216.120.59.253',20030621132157);
INSERT INTO davidsoncommunities_com VALUES (10,'www2.davidsoncommunities.com',28800,'A','216.120.59.227',20030803190124);

--
-- Table structure for table 'delmarinteractive_com'
--

CREATE TABLE delmarinteractive_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'delmarinteractive_com'
--


INSERT INTO delmarinteractive_com VALUES (1,'delmarinteractive.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_com VALUES (2,'delmarinteractive.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123233);
INSERT INTO delmarinteractive_com VALUES (3,'delmarinteractive.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (4,'delmarinteractive.com',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (5,'delmarinteractive.com',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (6,'delmarinteractive.com',28800,'MX','10 maila.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (7,'delmarinteractive.com',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (8,'delmarinteractive.com',28800,'MX','100 oasis.netoasis.net.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (9,'admin.delmarinteractive.com',28800,'A','65.212.133.164',20030504123233);
INSERT INTO delmarinteractive_com VALUES (10,'avo-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (11,'bart.delmarinteractive.com',28800,'A','209.242.137.182',20030504123233);
INSERT INTO delmarinteractive_com VALUES (12,'benoit.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (13,'bil-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (14,'bil-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (15,'bofh.delmarinteractive.com',28800,'A','65.212.133.171',20030504123233);
INSERT INTO delmarinteractive_com VALUES (16,'bsmart.delmarinteractive.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_com VALUES (17,'bug.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (18,'bugs.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (19,'cam-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (20,'cam-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (21,'cap-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (22,'cap-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (23,'caph-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (24,'caph-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (25,'cdr.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (26,'cdr-pro.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (27,'client-services.delmarinteractive.com',28800,'A','65.212.133.165',20030504123233);
INSERT INTO delmarinteractive_com VALUES (28,'cmc-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (29,'cmc-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (30,'cmc-live.delmarinteractive.com',28800,'A','216.120.60.22',20030621132157);
INSERT INTO delmarinteractive_com VALUES (31,'cmc-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (32,'con-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (33,'con-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (34,'conf.delmarinteractive.com',28800,'A','65.212.133.175',20030504123233);
INSERT INTO delmarinteractive_com VALUES (35,'creative.delmarinteractive.com',28800,'A','65.212.133.188',20030504123233);
INSERT INTO delmarinteractive_com VALUES (36,'dav-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (37,'dav-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (38,'dead-pool.delmarinteractive.com',28800,'A','65.212.133.176',20030504123233);
INSERT INTO delmarinteractive_com VALUES (39,'demo.delmarinteractive.com',28800,'CNAME','creative.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (40,'dev.delmarinteractive.com',28800,'A','65.212.133.190',20030504123233);
INSERT INTO delmarinteractive_com VALUES (41,'dev1.delmarinteractive.com',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_com VALUES (42,'dmi.delmarinteractive.com',28800,'A','65.212.133.166',20030504123233);
INSERT INTO delmarinteractive_com VALUES (43,'dns.delmarinteractive.com',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_com VALUES (44,'dubois-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (45,'dubois-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (46,'eartha.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (47,'esc-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (48,'esc-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (49,'eur-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (50,'eur-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (51,'euro-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (52,'euro-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (53,'ews-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (54,'ews-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (55,'ferret.delmarinteractive.com',28800,'A','65.212.133.183',20030504123233);
INSERT INTO delmarinteractive_com VALUES (56,'finance.delmarinteractive.com',28800,'A','65.212.133.180',20030504123233);
INSERT INTO delmarinteractive_com VALUES (57,'firewall.delmarinteractive.com',28800,'CNAME','heimdall.delmarinteractive.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (58,'flo-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (59,'flo-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (60,'flo-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (61,'ftp.delmarinteractive.com',28800,'A','65.212.133.187',20030504123233);
INSERT INTO delmarinteractive_com VALUES (62,'fwl-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (63,'fwl-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (64,'gas-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (65,'gas-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (66,'gcc-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (67,'gcc-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (68,'gw.delmarinteractive.com',28800,'A','68.15.28.85',20030504123233);
INSERT INTO delmarinteractive_com VALUES (69,'gw2.delmarinteractive.com',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_com VALUES (70,'handler-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (71,'heimdall.delmarinteractive.com',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_com VALUES (72,'hom-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (73,'hom-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (74,'hum-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (75,'hum-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (76,'iai-release.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (77,'icg.delmarinteractive.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_com VALUES (78,'iid-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (79,'iid-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (80,'imap.delmarinteractive.com',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_com VALUES (81,'irv-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (82,'isc-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (83,'isc-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (84,'john.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (85,'josh.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (86,'katz-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (87,'kau-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (88,'kau-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (89,'lad-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (90,'lad-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (91,'ladera.delmarinteractive.com',28800,'A','216.120.60.29',20030621132157);
INSERT INTO delmarinteractive_com VALUES (92,'lappie.delmarinteractive.com',28800,'A','65.212.133.174',20030504123233);
INSERT INTO delmarinteractive_com VALUES (93,'localhost.delmarinteractive.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO delmarinteractive_com VALUES (94,'loghost.delmarinteractive.com',28800,'CNAME','www.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (95,'luz-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (96,'luz-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (97,'lyo-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (98,'lyo-dux-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (99,'lyo-dux-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (100,'lyo-golf-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (101,'lyo-golf-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (102,'lyo-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (103,'lyon-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (104,'lyon-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (105,'lyonnt-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (106,'lyonpr-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (107,'mag-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (108,'mag-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (109,'magee-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (110,'magee-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (111,'mail.delmarinteractive.com',28800,'A','65.212.133.168',20030504123233);
INSERT INTO delmarinteractive_com VALUES (112,'mail2.delmarinteractive.com',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_com VALUES (113,'maila.delmarinteractive.com',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_com VALUES (114,'mailia.delmarinteractive.com',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_com VALUES (115,'market.delmarinteractive.com',28800,'A','65.212.133.163',20030504123233);
INSERT INTO delmarinteractive_com VALUES (116,'monitor.delmarinteractive.com',28800,'CNAME','slacker.delmarinteractive.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (117,'mysql.delmarinteractive.com',28800,'A','216.120.59.254',20030621132157);
INSERT INTO delmarinteractive_com VALUES (118,'nas-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (119,'nas-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (120,'ns.delmarinteractive.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_com VALUES (121,'ns1.delmarinteractive.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_com VALUES (122,'ns2.delmarinteractive.com',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_com VALUES (123,'ns3.delmarinteractive.com',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_com VALUES (124,'nt-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (125,'orwell.delmarinteractive.com',28800,'A','65.212.133.167',20030504123233);
INSERT INTO delmarinteractive_com VALUES (126,'osb-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (127,'osb-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (128,'pad-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (129,'pad-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (130,'padres.delmarinteractive.com',28800,'A','207.110.41.208',20030504123233);
INSERT INTO delmarinteractive_com VALUES (131,'pfp-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (132,'pfy.delmarinteractive.com',28800,'A','65.212.133.172',20030504123233);
INSERT INTO delmarinteractive_com VALUES (133,'pgsql.delmarinteractive.com',28800,'A','216.120.59.253',20030621132157);
INSERT INTO delmarinteractive_com VALUES (134,'pin-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (135,'pin-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (136,'pine-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (137,'pine-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (138,'pinehills.delmarinteractive.com',28800,'A','216.120.60.9',20030621132157);
INSERT INTO delmarinteractive_com VALUES (139,'pop.delmarinteractive.com',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_com VALUES (140,'pro-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (141,'pro-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (142,'prov-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (143,'prov-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (144,'proven.delmarinteractive.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO delmarinteractive_com VALUES (145,'rai-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (146,'rai-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (147,'rai-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (148,'raisins.delmarinteractive.com',28800,'A','216.120.59.230',20030621132157);
INSERT INTO delmarinteractive_com VALUES (149,'rea-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (150,'rea-salad-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (151,'rea-salad-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (152,'rea-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (153,'read-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (154,'read-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (155,'recipe.delmarinteractive.com',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_com VALUES (156,'rjt-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (157,'rjt-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (158,'rmv-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (159,'rmv-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (160,'rod-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (161,'rod-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (162,'router.delmarinteractive.com',28800,'A','65.212.133.161',20030504123233);
INSERT INTO delmarinteractive_com VALUES (163,'rt.delmarinteractive.com',28800,'A','63.141.73.17',20030504123233);
INSERT INTO delmarinteractive_com VALUES (164,'rui-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (165,'rui-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (166,'rui2-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (167,'rui2-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (168,'sales.delmarinteractive.com',28800,'A','65.212.133.179',20030504123233);
INSERT INTO delmarinteractive_com VALUES (169,'scd-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (170,'scd-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (171,'scott.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (172,'sdaw.delmarinteractive.com',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_com VALUES (173,'sdc-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (174,'sdc-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (175,'sdy-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (176,'sdy-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (177,'sdyouth.delmarinteractive.com',28800,'A','216.51.113.26',20030504123233);
INSERT INTO delmarinteractive_com VALUES (178,'sea-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (179,'sea-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (180,'seac-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (181,'sgi-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (182,'sgi-dev2.delmarinteractive.com',28800,'A','192.168.1.99',20030504123233);
INSERT INTO delmarinteractive_com VALUES (183,'sgifs-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (184,'sil-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (185,'sil-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (186,'slacker.delmarinteractive.com',28800,'A','65.212.133.178',20030504123233);
INSERT INTO delmarinteractive_com VALUES (187,'smartix.delmarinteractive.com',28800,'A','216.120.60.28',20030621132157);
INSERT INTO delmarinteractive_com VALUES (188,'solanocisrs.delmarinteractive.com',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_com VALUES (189,'staff.delmarinteractive.com',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_com VALUES (190,'staging.delmarinteractive.com',28800,'A','65.212.133.189',20030504123233);
INSERT INTO delmarinteractive_com VALUES (191,'sunkist.delmarinteractive.com',28800,'A','216.120.60.18',20030621132157);
INSERT INTO delmarinteractive_com VALUES (192,'sunkistfs.delmarinteractive.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_com VALUES (193,'sus-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (194,'sus-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (195,'tal-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (196,'tal-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (197,'talega.delmarinteractive.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_com VALUES (198,'tay-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (199,'tay-mluz-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (200,'tay-mluz-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (201,'tay-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (202,'team.delmarinteractive.com',28800,'A','65.212.133.169',20030504123233);
INSERT INTO delmarinteractive_com VALUES (203,'train-cisrs.delmarinteractive.com',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_com VALUES (204,'twc-dev.delmarinteractive.com',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (205,'uller.delmarinteractive.com',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_com VALUES (206,'updates.delmarinteractive.com',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (207,'vpn.delmarinteractive.com',28800,'A','65.212.133.170',20030504123233);
INSERT INTO delmarinteractive_com VALUES (208,'webmail.delmarinteractive.com',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_com VALUES (209,'wor-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (210,'wor-staging.delmarinteractive.com',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_com VALUES (211,'wreath-develop.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (212,'wreath-staging.delmarinteractive.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_com VALUES (213,'www.delmarinteractive.com',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'delmarinteractive_net'
--

CREATE TABLE delmarinteractive_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'delmarinteractive_net'
--


INSERT INTO delmarinteractive_net VALUES (1,'delmarinteractive.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_net VALUES (2,'delmarinteractive.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123233);
INSERT INTO delmarinteractive_net VALUES (3,'delmarinteractive.net',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (4,'delmarinteractive.net',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (5,'delmarinteractive.net',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (6,'delmarinteractive.net',28800,'MX','10 maila.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (7,'delmarinteractive.net',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (8,'delmarinteractive.net',28800,'MX','100 oasis.netoasis.net.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (9,'admin.delmarinteractive.net',28800,'A','65.212.133.164',20030504123233);
INSERT INTO delmarinteractive_net VALUES (10,'avo-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (11,'bart.delmarinteractive.net',28800,'A','209.242.137.182',20030504123233);
INSERT INTO delmarinteractive_net VALUES (12,'benoit.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (13,'bil-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (14,'bil-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (15,'bofh.delmarinteractive.net',28800,'A','65.212.133.171',20030504123233);
INSERT INTO delmarinteractive_net VALUES (16,'bsmart.delmarinteractive.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_net VALUES (17,'bug.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (18,'bugs.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (19,'cam-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (20,'cam-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (21,'cap-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (22,'cap-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (23,'caph-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (24,'caph-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (25,'cdr.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (26,'cdr-pro.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (27,'client-services.delmarinteractive.net',28800,'A','65.212.133.165',20030504123233);
INSERT INTO delmarinteractive_net VALUES (28,'cmc-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (29,'cmc-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (30,'cmc-live.delmarinteractive.net',28800,'A','216.120.60.22',20030621132157);
INSERT INTO delmarinteractive_net VALUES (31,'cmc-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (32,'con-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (33,'con-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (34,'conf.delmarinteractive.net',28800,'A','65.212.133.175',20030504123233);
INSERT INTO delmarinteractive_net VALUES (35,'creative.delmarinteractive.net',28800,'A','65.212.133.188',20030504123233);
INSERT INTO delmarinteractive_net VALUES (36,'dav-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (37,'dav-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (38,'dead-pool.delmarinteractive.net',28800,'A','65.212.133.176',20030504123233);
INSERT INTO delmarinteractive_net VALUES (39,'demo.delmarinteractive.net',28800,'CNAME','creative.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (40,'dev.delmarinteractive.net',28800,'A','65.212.133.190',20030504123233);
INSERT INTO delmarinteractive_net VALUES (41,'dev1.delmarinteractive.net',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_net VALUES (42,'dmi.delmarinteractive.net',28800,'A','65.212.133.166',20030504123233);
INSERT INTO delmarinteractive_net VALUES (43,'dns.delmarinteractive.net',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_net VALUES (44,'dubois-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (45,'dubois-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (46,'eartha.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (47,'esc-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (48,'esc-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (49,'eur-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (50,'eur-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (51,'euro-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (52,'euro-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (53,'ews-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (54,'ews-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (55,'ferret.delmarinteractive.net',28800,'A','65.212.133.183',20030504123233);
INSERT INTO delmarinteractive_net VALUES (56,'finance.delmarinteractive.net',28800,'A','65.212.133.180',20030504123233);
INSERT INTO delmarinteractive_net VALUES (57,'firewall.delmarinteractive.net',28800,'CNAME','heimdall.delmarinteractive.net.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (58,'flo-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (59,'flo-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (60,'flo-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (61,'ftp.delmarinteractive.net',28800,'A','65.212.133.187',20030504123233);
INSERT INTO delmarinteractive_net VALUES (62,'fwl-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (63,'fwl-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (64,'gas-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (65,'gas-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (66,'gcc-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (67,'gcc-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (68,'gw.delmarinteractive.net',28800,'A','68.15.28.85',20030504123233);
INSERT INTO delmarinteractive_net VALUES (69,'gw2.delmarinteractive.net',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_net VALUES (70,'handler-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (71,'heimdall.delmarinteractive.net',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_net VALUES (72,'hom-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (73,'hom-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (74,'hum-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (75,'hum-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (76,'iai-release.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (77,'icg.delmarinteractive.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_net VALUES (78,'iid-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (79,'iid-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (80,'imap.delmarinteractive.net',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_net VALUES (81,'irv-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (82,'isc-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (83,'isc-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (84,'john.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (85,'josh.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (86,'katz-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (87,'kau-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (88,'kau-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (89,'lad-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (90,'lad-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (91,'ladera.delmarinteractive.net',28800,'A','216.120.60.29',20030621132157);
INSERT INTO delmarinteractive_net VALUES (92,'lappie.delmarinteractive.net',28800,'A','65.212.133.174',20030504123233);
INSERT INTO delmarinteractive_net VALUES (93,'localhost.delmarinteractive.net',28800,'A','127.0.0.1',20030504123233);
INSERT INTO delmarinteractive_net VALUES (94,'loghost.delmarinteractive.net',28800,'CNAME','www.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (95,'luz-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (96,'luz-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (97,'lyo-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (98,'lyo-dux-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (99,'lyo-dux-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (100,'lyo-golf-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (101,'lyo-golf-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (102,'lyo-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (103,'lyon-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (104,'lyon-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (105,'lyonnt-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (106,'lyonpr-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (107,'mag-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (108,'mag-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (109,'magee-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (110,'magee-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (111,'mail.delmarinteractive.net',28800,'A','65.212.133.168',20030504123233);
INSERT INTO delmarinteractive_net VALUES (112,'mail2.delmarinteractive.net',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_net VALUES (113,'maila.delmarinteractive.net',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_net VALUES (114,'mailia.delmarinteractive.net',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_net VALUES (115,'market.delmarinteractive.net',28800,'A','65.212.133.163',20030504123233);
INSERT INTO delmarinteractive_net VALUES (116,'monitor.delmarinteractive.net',28800,'CNAME','slacker.delmarinteractive.net.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (117,'mysql.delmarinteractive.net',28800,'A','216.120.59.254',20030621132157);
INSERT INTO delmarinteractive_net VALUES (118,'nas-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (119,'nas-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (120,'ns.delmarinteractive.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_net VALUES (121,'ns1.delmarinteractive.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_net VALUES (122,'ns2.delmarinteractive.net',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_net VALUES (123,'ns3.delmarinteractive.net',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_net VALUES (124,'nt-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (125,'orwell.delmarinteractive.net',28800,'A','65.212.133.167',20030504123233);
INSERT INTO delmarinteractive_net VALUES (126,'osb-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (127,'osb-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (128,'pad-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (129,'pad-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (130,'padres.delmarinteractive.net',28800,'A','207.110.41.208',20030504123233);
INSERT INTO delmarinteractive_net VALUES (131,'pfp-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (132,'pfy.delmarinteractive.net',28800,'A','65.212.133.172',20030504123233);
INSERT INTO delmarinteractive_net VALUES (133,'pgsql.delmarinteractive.net',28800,'A','216.120.59.253',20030621132157);
INSERT INTO delmarinteractive_net VALUES (134,'pin-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (135,'pin-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (136,'pine-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (137,'pine-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (138,'pinehills.delmarinteractive.net',28800,'A','216.120.60.9',20030621132157);
INSERT INTO delmarinteractive_net VALUES (139,'pop.delmarinteractive.net',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_net VALUES (140,'pro-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (141,'pro-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (142,'prov-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (143,'prov-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (144,'proven.delmarinteractive.net',28800,'A','216.120.60.14',20030621132157);
INSERT INTO delmarinteractive_net VALUES (145,'rai-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (146,'rai-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (147,'rai-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (148,'raisins.delmarinteractive.net',28800,'A','216.120.59.230',20030621132157);
INSERT INTO delmarinteractive_net VALUES (149,'rea-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (150,'rea-salad-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (151,'rea-salad-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (152,'rea-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (153,'read-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (154,'read-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (155,'recipe.delmarinteractive.net',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_net VALUES (156,'rjt-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (157,'rjt-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (158,'rmv-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (159,'rmv-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (160,'rod-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (161,'rod-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (162,'router.delmarinteractive.net',28800,'A','65.212.133.161',20030504123233);
INSERT INTO delmarinteractive_net VALUES (163,'rt.delmarinteractive.net',28800,'A','63.141.73.17',20030504123233);
INSERT INTO delmarinteractive_net VALUES (164,'rui-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (165,'rui-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (166,'rui2-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (167,'rui2-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (168,'sales.delmarinteractive.net',28800,'A','65.212.133.179',20030504123233);
INSERT INTO delmarinteractive_net VALUES (169,'scd-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (170,'scd-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (171,'scott.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (172,'sdaw.delmarinteractive.net',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_net VALUES (173,'sdc-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (174,'sdc-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (175,'sdy-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (176,'sdy-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (177,'sdyouth.delmarinteractive.net',28800,'A','216.51.113.26',20030504123233);
INSERT INTO delmarinteractive_net VALUES (178,'sea-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (179,'sea-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (180,'seac-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (181,'sgi-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (182,'sgi-dev2.delmarinteractive.net',28800,'A','192.168.1.99',20030504123233);
INSERT INTO delmarinteractive_net VALUES (183,'sgifs-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (184,'sil-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (185,'sil-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (186,'slacker.delmarinteractive.net',28800,'A','65.212.133.178',20030504123233);
INSERT INTO delmarinteractive_net VALUES (187,'smartix.delmarinteractive.net',28800,'A','216.120.60.28',20030621132157);
INSERT INTO delmarinteractive_net VALUES (188,'solanocisrs.delmarinteractive.net',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_net VALUES (189,'staff.delmarinteractive.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_net VALUES (190,'staging.delmarinteractive.net',28800,'A','65.212.133.189',20030504123233);
INSERT INTO delmarinteractive_net VALUES (191,'sunkist.delmarinteractive.net',28800,'A','216.120.60.18',20030621132157);
INSERT INTO delmarinteractive_net VALUES (192,'sunkistfs.delmarinteractive.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_net VALUES (193,'sus-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (194,'sus-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (195,'tal-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (196,'tal-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (197,'talega.delmarinteractive.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_net VALUES (198,'tay-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (199,'tay-mluz-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (200,'tay-mluz-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (201,'tay-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (202,'team.delmarinteractive.net',28800,'A','65.212.133.169',20030504123233);
INSERT INTO delmarinteractive_net VALUES (203,'train-cisrs.delmarinteractive.net',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_net VALUES (204,'twc-dev.delmarinteractive.net',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (205,'uller.delmarinteractive.net',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_net VALUES (206,'updates.delmarinteractive.net',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (207,'vpn.delmarinteractive.net',28800,'A','65.212.133.170',20030504123233);
INSERT INTO delmarinteractive_net VALUES (208,'webmail.delmarinteractive.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_net VALUES (209,'wor-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (210,'wor-staging.delmarinteractive.net',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_net VALUES (211,'wreath-develop.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (212,'wreath-staging.delmarinteractive.net',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_net VALUES (213,'www.delmarinteractive.net',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'delmarinteractive_org'
--

CREATE TABLE delmarinteractive_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'delmarinteractive_org'
--


INSERT INTO delmarinteractive_org VALUES (1,'delmarinteractive.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_org VALUES (2,'delmarinteractive.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123233);
INSERT INTO delmarinteractive_org VALUES (3,'delmarinteractive.org',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (4,'delmarinteractive.org',28800,'NS','ns2.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (5,'delmarinteractive.org',28800,'NS','ns3.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (6,'delmarinteractive.org',28800,'MX','10 maila.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (7,'delmarinteractive.org',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (8,'delmarinteractive.org',28800,'MX','100 oasis.netoasis.net.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (9,'admin.delmarinteractive.org',28800,'A','65.212.133.164',20030504123233);
INSERT INTO delmarinteractive_org VALUES (10,'avo-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (11,'bart.delmarinteractive.org',28800,'A','209.242.137.182',20030504123233);
INSERT INTO delmarinteractive_org VALUES (12,'benoit.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (13,'bil-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (14,'bil-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (15,'bofh.delmarinteractive.org',28800,'A','65.212.133.171',20030504123233);
INSERT INTO delmarinteractive_org VALUES (16,'bsmart.delmarinteractive.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_org VALUES (17,'bug.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (18,'bugs.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (19,'cam-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (20,'cam-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (21,'cap-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (22,'cap-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (23,'caph-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (24,'caph-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (25,'cdr.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (26,'cdr-pro.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (27,'client-services.delmarinteractive.org',28800,'A','65.212.133.165',20030504123233);
INSERT INTO delmarinteractive_org VALUES (28,'cmc-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (29,'cmc-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (30,'cmc-live.delmarinteractive.org',28800,'A','216.120.60.22',20030621132157);
INSERT INTO delmarinteractive_org VALUES (31,'cmc-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (32,'con-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (33,'con-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (34,'conf.delmarinteractive.org',28800,'A','65.212.133.175',20030504123233);
INSERT INTO delmarinteractive_org VALUES (35,'creative.delmarinteractive.org',28800,'A','65.212.133.188',20030504123233);
INSERT INTO delmarinteractive_org VALUES (36,'dav-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (37,'dav-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (38,'dead-pool.delmarinteractive.org',28800,'A','65.212.133.176',20030504123233);
INSERT INTO delmarinteractive_org VALUES (39,'demo.delmarinteractive.org',28800,'CNAME','creative.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (40,'dev.delmarinteractive.org',28800,'A','65.212.133.190',20030504123233);
INSERT INTO delmarinteractive_org VALUES (41,'dev1.delmarinteractive.org',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_org VALUES (42,'dmi.delmarinteractive.org',28800,'A','65.212.133.166',20030504123233);
INSERT INTO delmarinteractive_org VALUES (43,'dns.delmarinteractive.org',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_org VALUES (44,'dubois-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (45,'dubois-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (46,'eartha.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (47,'esc-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (48,'esc-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (49,'eur-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (50,'eur-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (51,'euro-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (52,'euro-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (53,'ews-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (54,'ews-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (55,'ferret.delmarinteractive.org',28800,'A','65.212.133.183',20030504123233);
INSERT INTO delmarinteractive_org VALUES (56,'finance.delmarinteractive.org',28800,'A','65.212.133.180',20030504123233);
INSERT INTO delmarinteractive_org VALUES (57,'firewall.delmarinteractive.org',28800,'CNAME','heimdall.delmarinteractive.org.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (58,'flo-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (59,'flo-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (60,'flo-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (61,'ftp.delmarinteractive.org',28800,'A','65.212.133.187',20030504123233);
INSERT INTO delmarinteractive_org VALUES (62,'fwl-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (63,'fwl-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (64,'gas-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (65,'gas-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (66,'gcc-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (67,'gcc-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (68,'gw.delmarinteractive.org',28800,'A','68.15.28.85',20030504123233);
INSERT INTO delmarinteractive_org VALUES (69,'gw2.delmarinteractive.org',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_org VALUES (70,'handler-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (71,'heimdall.delmarinteractive.org',28800,'A','65.212.133.162',20030504123233);
INSERT INTO delmarinteractive_org VALUES (72,'hom-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (73,'hom-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (74,'hum-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (75,'hum-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (76,'iai-release.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (77,'icg.delmarinteractive.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_org VALUES (78,'iid-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (79,'iid-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (80,'imap.delmarinteractive.org',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_org VALUES (81,'irv-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (82,'isc-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (83,'isc-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (84,'john.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (85,'josh.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (86,'katz-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (87,'kau-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (88,'kau-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (89,'lad-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (90,'lad-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (91,'ladera.delmarinteractive.org',28800,'A','216.120.60.29',20030621132157);
INSERT INTO delmarinteractive_org VALUES (92,'lappie.delmarinteractive.org',28800,'A','65.212.133.174',20030504123233);
INSERT INTO delmarinteractive_org VALUES (93,'localhost.delmarinteractive.org',28800,'A','127.0.0.1',20030504123233);
INSERT INTO delmarinteractive_org VALUES (94,'loghost.delmarinteractive.org',28800,'CNAME','www.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (95,'luz-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (96,'luz-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (97,'lyo-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (98,'lyo-dux-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (99,'lyo-dux-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (100,'lyo-golf-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (101,'lyo-golf-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (102,'lyo-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (103,'lyon-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (104,'lyon-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (105,'lyonnt-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (106,'lyonpr-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (107,'mag-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (108,'mag-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (109,'magee-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (110,'magee-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (111,'mail.delmarinteractive.org',28800,'A','65.212.133.168',20030504123233);
INSERT INTO delmarinteractive_org VALUES (112,'mail2.delmarinteractive.org',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_org VALUES (113,'maila.delmarinteractive.org',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_org VALUES (114,'mailia.delmarinteractive.org',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_org VALUES (115,'market.delmarinteractive.org',28800,'A','65.212.133.163',20030504123233);
INSERT INTO delmarinteractive_org VALUES (116,'monitor.delmarinteractive.org',28800,'CNAME','slacker.delmarinteractive.org.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (117,'mysql.delmarinteractive.org',28800,'A','216.120.59.254',20030621132157);
INSERT INTO delmarinteractive_org VALUES (118,'nas-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (119,'nas-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (120,'ns.delmarinteractive.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_org VALUES (121,'ns1.delmarinteractive.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarinteractive_org VALUES (122,'ns2.delmarinteractive.org',28800,'A','65.212.133.182',20030504123233);
INSERT INTO delmarinteractive_org VALUES (123,'ns3.delmarinteractive.org',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_org VALUES (124,'nt-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (125,'orwell.delmarinteractive.org',28800,'A','65.212.133.167',20030504123233);
INSERT INTO delmarinteractive_org VALUES (126,'osb-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (127,'osb-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (128,'pad-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (129,'pad-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (130,'padres.delmarinteractive.org',28800,'A','207.110.41.208',20030504123233);
INSERT INTO delmarinteractive_org VALUES (131,'pfp-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (132,'pfy.delmarinteractive.org',28800,'A','65.212.133.172',20030504123233);
INSERT INTO delmarinteractive_org VALUES (133,'pgsql.delmarinteractive.org',28800,'A','216.120.59.253',20030621132157);
INSERT INTO delmarinteractive_org VALUES (134,'pin-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (135,'pin-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (136,'pine-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (137,'pine-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (138,'pinehills.delmarinteractive.org',28800,'A','216.120.60.9',20030621132157);
INSERT INTO delmarinteractive_org VALUES (139,'pop.delmarinteractive.org',28800,'A','65.212.133.173',20030504123233);
INSERT INTO delmarinteractive_org VALUES (140,'pro-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (141,'pro-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (142,'prov-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (143,'prov-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (144,'proven.delmarinteractive.org',28800,'A','216.120.60.14',20030621132157);
INSERT INTO delmarinteractive_org VALUES (145,'rai-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (146,'rai-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (147,'rai-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (148,'raisins.delmarinteractive.org',28800,'A','216.120.59.230',20030621132157);
INSERT INTO delmarinteractive_org VALUES (149,'rea-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (150,'rea-salad-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (151,'rea-salad-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (152,'rea-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (153,'read-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (154,'read-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (155,'recipe.delmarinteractive.org',28800,'A','65.212.133.186',20030504123233);
INSERT INTO delmarinteractive_org VALUES (156,'rjt-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (157,'rjt-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (158,'rmv-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (159,'rmv-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (160,'rod-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (161,'rod-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (162,'router.delmarinteractive.org',28800,'A','65.212.133.161',20030504123233);
INSERT INTO delmarinteractive_org VALUES (163,'rt.delmarinteractive.org',28800,'A','63.141.73.17',20030504123233);
INSERT INTO delmarinteractive_org VALUES (164,'rui-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (165,'rui-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (166,'rui2-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (167,'rui2-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (168,'sales.delmarinteractive.org',28800,'A','65.212.133.179',20030504123233);
INSERT INTO delmarinteractive_org VALUES (169,'scd-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (170,'scd-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (171,'scott.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (172,'sdaw.delmarinteractive.org',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_org VALUES (173,'sdc-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (174,'sdc-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (175,'sdy-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (176,'sdy-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (177,'sdyouth.delmarinteractive.org',28800,'A','216.51.113.26',20030504123233);
INSERT INTO delmarinteractive_org VALUES (178,'sea-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (179,'sea-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (180,'seac-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (181,'sgi-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (182,'sgi-dev2.delmarinteractive.org',28800,'A','192.168.1.99',20030504123233);
INSERT INTO delmarinteractive_org VALUES (183,'sgifs-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (184,'sil-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (185,'sil-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (186,'slacker.delmarinteractive.org',28800,'A','65.212.133.178',20030504123233);
INSERT INTO delmarinteractive_org VALUES (187,'smartix.delmarinteractive.org',28800,'A','216.120.60.28',20030621132157);
INSERT INTO delmarinteractive_org VALUES (188,'solanocisrs.delmarinteractive.org',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_org VALUES (189,'staff.delmarinteractive.org',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_org VALUES (190,'staging.delmarinteractive.org',28800,'A','65.212.133.189',20030504123233);
INSERT INTO delmarinteractive_org VALUES (191,'sunkist.delmarinteractive.org',28800,'A','216.120.60.18',20030621132157);
INSERT INTO delmarinteractive_org VALUES (192,'sunkistfs.delmarinteractive.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_org VALUES (193,'sus-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (194,'sus-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (195,'tal-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (196,'tal-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (197,'talega.delmarinteractive.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO delmarinteractive_org VALUES (198,'tay-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (199,'tay-mluz-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (200,'tay-mluz-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (201,'tay-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (202,'team.delmarinteractive.org',28800,'A','65.212.133.169',20030504123233);
INSERT INTO delmarinteractive_org VALUES (203,'train-cisrs.delmarinteractive.org',28800,'A','65.212.133.181',20030504123233);
INSERT INTO delmarinteractive_org VALUES (204,'twc-dev.delmarinteractive.org',28800,'CNAME','dev1.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (205,'uller.delmarinteractive.org',28800,'A','65.212.133.177',20030504123233);
INSERT INTO delmarinteractive_org VALUES (206,'updates.delmarinteractive.org',28800,'MX','20 mail.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (207,'vpn.delmarinteractive.org',28800,'A','65.212.133.170',20030504123233);
INSERT INTO delmarinteractive_org VALUES (208,'webmail.delmarinteractive.org',28800,'A','216.120.59.242',20030621132157);
INSERT INTO delmarinteractive_org VALUES (209,'wor-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (210,'wor-staging.delmarinteractive.org',28800,'A','216.51.113.21',20030504123233);
INSERT INTO delmarinteractive_org VALUES (211,'wreath-develop.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (212,'wreath-staging.delmarinteractive.org',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarinteractive_org VALUES (213,'www.delmarinteractive.org',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'delmarwebdesign_com'
--

CREATE TABLE delmarwebdesign_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'delmarwebdesign_com'
--


INSERT INTO delmarwebdesign_com VALUES (1,'delmarwebdesign.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007112604 14400 3600 604800 28800',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (2,'delmarwebdesign.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (3,'delmarwebdesign.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (4,'delmarwebdesign.com',28800,'MX','10 mail.delmarwebdesign.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (5,'delmarwebdesign.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (6,'adm.delmarwebdesign.com',28800,'A','63.141.73.8',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (7,'anais.delmarwebdesign.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (8,'bart.delmarwebdesign.com',28800,'A','209.242.137.182',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (9,'bd.delmarwebdesign.com',28800,'A','63.141.73.13',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (10,'bofh.delmarwebdesign.com',28800,'A','63.141.73.10',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (11,'cam-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (12,'cam-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (13,'cap-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (14,'cap-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (15,'cerebus.delmarwebdesign.com',28800,'A','63.141.73.5',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (16,'con-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (17,'con-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (18,'creative.delmarwebdesign.com',28800,'A','216.120.60.12',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (19,'cybermail.delmarwebdesign.com',28800,'MX','10 mail.interactivate.unitymail.net.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (20,'demo.delmarwebdesign.com',28800,'CNAME','creative.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (21,'www.demo.delmarwebdesign.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (23,'dev.delmarwebdesign.com',28800,'A','216.120.60.9',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (24,'dev1.delmarwebdesign.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (25,'dmi.delmarwebdesign.com',28800,'A','63.141.73.7',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (26,'eur-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (27,'eur-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (28,'ewatch.delmarwebdesign.com',28800,'MX','10 interactivate.unitymail.net.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (29,'ews-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (30,'ews-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (31,'firewall.delmarwebdesign.com',28800,'CNAME','heimdall.delmarwebdesign.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (32,'ftp.delmarwebdesign.com',28800,'A','216.120.60.12',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (33,'heimdall.delmarwebdesign.com',28800,'A','63.141.73.3',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (34,'hum-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (35,'hum-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (36,'iai-release.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (37,'icg.delmarwebdesign.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (38,'iid-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (39,'iid-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (40,'info.delmarwebdesign.com',28800,'MX','10 interactivate.unitymail.net.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (41,'isc-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (42,'isc-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (43,'it.delmarwebdesign.com',28800,'A','63.141.73.12',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (44,'lad-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (45,'lad-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (46,'ladera.delmarwebdesign.com',28800,'A','207.110.61.34',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (47,'localhost.delmarwebdesign.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (48,'loghost.delmarwebdesign.com',28800,'CNAME','www.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (49,'lyo-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (50,'lyo-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (51,'lyon.delmarwebdesign.com',28800,'A','207.110.61.52',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (52,'mail.delmarwebdesign.com',28800,'A','63.141.73.15',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (53,'market.delmarwebdesign.com',28800,'A','63.141.73.2',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (54,'mysql.delmarwebdesign.com',28800,'A','216.120.59.254',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (55,'nas.delmarwebdesign.com',28800,'A','207.110.61.53',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (56,'nas-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (57,'nas-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (58,'new.delmarwebdesign.com',28800,'A','207.110.61.51',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (59,'ns1.delmarwebdesign.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (60,'ns2.delmarwebdesign.com',28800,'A','207.110.0.60',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (61,'ns3.delmarwebdesign.com',28800,'A','63.141.73.6',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (62,'orwell.delmarwebdesign.com',28800,'A','63.141.73.14',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (63,'osb-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (64,'osb-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (65,'padres.delmarwebdesign.com',28800,'A','207.110.41.208',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (66,'pci.delmarwebdesign.com',28800,'A','63.141.73.11',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (67,'pgsql.delmarwebdesign.com',28800,'A','216.120.59.253',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (68,'pm.delmarwebdesign.com',28800,'A','63.141.73.4',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (69,'pro-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (70,'pro-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (71,'proven.delmarwebdesign.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (72,'rea-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (73,'rea-salad-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (74,'rea-salad-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (75,'rea-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (76,'rjt-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (77,'rjt-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (78,'router.delmarwebdesign.com',28800,'A','63.141.73.1',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (79,'rt.delmarwebdesign.com',28800,'A','63.141.73.17',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (80,'rui-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (81,'rui-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (82,'scd-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (83,'scd-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (84,'sdc-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (85,'sdc-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (86,'sea-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (87,'sea-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (88,'staging.delmarwebdesign.com',28800,'A','216.120.60.11',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (89,'sunkist.delmarwebdesign.com',28800,'A','216.120.60.18',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (90,'sus-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (91,'sus-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (92,'tay-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (93,'tay-mluz-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (94,'tay-mluz-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (95,'tay-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (96,'team.delmarwebdesign.com',28800,'A','63.141.73.20',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (97,'vpn.delmarwebdesign.com',28800,'CNAME','cerebus.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (98,'webcam.delmarwebdesign.com',28800,'A','63.141.73.5',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (99,'webmail.delmarwebdesign.com',28800,'A','216.120.59.229',20030621132157);
INSERT INTO delmarwebdesign_com VALUES (100,'wor-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (101,'wor-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (102,'wreath-develop.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (103,'wreath-staging.delmarwebdesign.com',28800,'CNAME','dev.interactivate.com.',20030504123233);
INSERT INTO delmarwebdesign_com VALUES (104,'www.delmarwebdesign.com',28800,'A','216.120.59.226',20030621132157);

--
-- Table structure for table 'distinctive_home_com'
--

CREATE TABLE distinctive_home_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'distinctive_home_com'
--


INSERT INTO distinctive_home_com VALUES (1,'distinctive-home.com',28800,'A','216.120.59.249',20030621132157);
INSERT INTO distinctive_home_com VALUES (2,'distinctive-home.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002062604 14400 3600 604800 28800',20030504123233);
INSERT INTO distinctive_home_com VALUES (3,'distinctive-home.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO distinctive_home_com VALUES (4,'distinctive-home.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO distinctive_home_com VALUES (5,'distinctive-home.com',28800,'MX','10 mail.scdesigninc.com.',20030504123233);
INSERT INTO distinctive_home_com VALUES (6,'localhost.distinctive-home.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO distinctive_home_com VALUES (7,'mail.distinctive-home.com',28800,'A','67.116.205.35',20030504123233);
INSERT INTO distinctive_home_com VALUES (8,'www.distinctive-home.com',28800,'A','216.120.59.249',20030621132157);
INSERT INTO distinctive_home_com VALUES (10,'www2.distinctive-home.com',28800,'A','216.120.59.227',20030803190125);

--
-- Table structure for table 'distinctivehomes_net'
--

CREATE TABLE distinctivehomes_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'distinctivehomes_net'
--


INSERT INTO distinctivehomes_net VALUES (1,'distinctivehomes.net',28800,'A','216.120.59.249',20030621132157);
INSERT INTO distinctivehomes_net VALUES (2,'distinctivehomes.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002062606 14400 3600 604800 28800',20030504123233);
INSERT INTO distinctivehomes_net VALUES (3,'distinctivehomes.net',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO distinctivehomes_net VALUES (4,'distinctivehomes.net',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO distinctivehomes_net VALUES (5,'distinctivehomes.net',28800,'MX','10 mail1.scdesigninc.com.',20030504123233);
INSERT INTO distinctivehomes_net VALUES (6,'localhost.distinctivehomes.net',28800,'A','127.0.0.1',20030504123233);
INSERT INTO distinctivehomes_net VALUES (7,'mail.distinctivehomes.net',28800,'A','67.116.205.35',20030504123233);
INSERT INTO distinctivehomes_net VALUES (8,'mail1.distinctivehomes.net',28800,'A','216.70.243.131',20030504123233);
INSERT INTO distinctivehomes_net VALUES (9,'www.distinctivehomes.net',28800,'A','216.120.59.249',20030621132157);
INSERT INTO distinctivehomes_net VALUES (11,'www2.distinctivehomes.net',28800,'A','216.120.59.227',20030803190126);

--
-- Table structure for table 'duxford_com'
--

CREATE TABLE duxford_com (
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

--
-- Dumping data for table 'duxford_com'
--


INSERT INTO duxford_com VALUES (1,'duxford.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003072905 14400 3600 604800 28800',20030804145807);
INSERT INTO duxford_com VALUES (2,'duxford.com',28800,'NS','icg.interactivate.com.',20030729170320);
INSERT INTO duxford_com VALUES (3,'duxford.com',28800,'NS','ns2.interactivate.com.',20030729170320);
INSERT INTO duxford_com VALUES (4,'duxford.com',28800,'NS','ns3.interactivate.com.',20030729170320);
INSERT INTO duxford_com VALUES (5,'www.duxford.com',28800,'A','216.120.60.26',20030729170414);
INSERT INTO duxford_com VALUES (6,'duxford.com',28800,'A','216.120.60.26',20030729170422);
INSERT INTO duxford_com VALUES (7,'duxford.com',28800,'MX','10 mail.lyonhomes.com.',20030804145807);

--
-- Table structure for table 'duxfordfinancial_com'
--

CREATE TABLE duxfordfinancial_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'duxfordfinancial_com'
--


INSERT INTO duxfordfinancial_com VALUES (1,'duxfordfinancial.com',28800,'A','216.120.60.26',20030621132157);
INSERT INTO duxfordfinancial_com VALUES (2,'duxfordfinancial.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002022603 14400 3600 604800 28800',20030504123233);
INSERT INTO duxfordfinancial_com VALUES (3,'duxfordfinancial.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO duxfordfinancial_com VALUES (4,'duxfordfinancial.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO duxfordfinancial_com VALUES (5,'duxfordfinancial.com',28800,'MX','10 gwbmail.genesis2000.com.',20030504123233);
INSERT INTO duxfordfinancial_com VALUES (6,'localhost.duxfordfinancial.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO duxfordfinancial_com VALUES (7,'www.duxfordfinancial.com',28800,'A','216.120.60.26',20030621132157);
INSERT INTO duxfordfinancial_com VALUES (9,'www2.duxfordfinancial.com',28800,'A','216.120.59.227',20030803190126);

--
-- Table structure for table 'escala_homes_com'
--

CREATE TABLE escala_homes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escala_homes_com'
--


INSERT INTO escala_homes_com VALUES (1,'escala-homes.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escala_homes_com VALUES (2,'escala-homes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002071803 14400 3600 604800 28800',20030504123233);
INSERT INTO escala_homes_com VALUES (3,'escala-homes.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO escala_homes_com VALUES (4,'escala-homes.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO escala_homes_com VALUES (5,'escala-homes.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escala_homes_com VALUES (6,'localhost.escala-homes.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO escala_homes_com VALUES (7,'www.escala-homes.com',28800,'A','216.120.60.10',20030621132157);

--
-- Table structure for table 'escalahomes_com'
--

CREATE TABLE escalahomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escalahomes_com'
--


INSERT INTO escalahomes_com VALUES (1,'escalahomes.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalahomes_com VALUES (2,'escalahomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002071803 14400 3600 604800 28800',20030504123233);
INSERT INTO escalahomes_com VALUES (3,'escalahomes.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO escalahomes_com VALUES (4,'escalahomes.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO escalahomes_com VALUES (5,'escalahomes.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalahomes_com VALUES (6,'localhost.escalahomes.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO escalahomes_com VALUES (7,'www.escalahomes.com',28800,'A','216.120.60.10',20030621132157);

--
-- Table structure for table 'escalaliving_com'
--

CREATE TABLE escalaliving_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escalaliving_com'
--


INSERT INTO escalaliving_com VALUES (1,'escalaliving.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalaliving_com VALUES (2,'escalaliving.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002091003 14400 3600 604800 28800',20030504123233);
INSERT INTO escalaliving_com VALUES (3,'escalaliving.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO escalaliving_com VALUES (4,'escalaliving.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO escalaliving_com VALUES (5,'escalaliving.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalaliving_com VALUES (6,'amail.escalaliving.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalaliving_com VALUES (7,'localhost.escalaliving.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO escalaliving_com VALUES (8,'updates.escalaliving.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalaliving_com VALUES (9,'www.escalaliving.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalaliving_com VALUES (11,'www2.escalaliving.com',28800,'A','216.120.59.227',20030803190127);

--
-- Table structure for table 'escalamissionvalley_com'
--

CREATE TABLE escalamissionvalley_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escalamissionvalley_com'
--


INSERT INTO escalamissionvalley_com VALUES (1,'escalamissionvalley.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalamissionvalley_com VALUES (2,'escalamissionvalley.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002071803 14400 3600 604800 28800',20030504123233);
INSERT INTO escalamissionvalley_com VALUES (3,'escalamissionvalley.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO escalamissionvalley_com VALUES (4,'escalamissionvalley.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO escalamissionvalley_com VALUES (5,'escalamissionvalley.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalamissionvalley_com VALUES (6,'localhost.escalamissionvalley.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO escalamissionvalley_com VALUES (7,'www.escalamissionvalley.com',28800,'A','216.120.60.10',20030621132157);

--
-- Table structure for table 'escalasandiego_com'
--

CREATE TABLE escalasandiego_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escalasandiego_com'
--


INSERT INTO escalasandiego_com VALUES (1,'escalasandiego.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalasandiego_com VALUES (2,'escalasandiego.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002071803 14400 3600 604800 28800',20030504123233);
INSERT INTO escalasandiego_com VALUES (3,'escalasandiego.com',28800,'NS','ns.connectnet.com.',20030504123233);
INSERT INTO escalasandiego_com VALUES (4,'escalasandiego.com',28800,'NS','icg.interactivate.com.',20030504123233);
INSERT INTO escalasandiego_com VALUES (5,'escalasandiego.com',28800,'MX','10 mail.interactivate.com.',20030504123233);
INSERT INTO escalasandiego_com VALUES (6,'localhost.escalasandiego.com',28800,'A','127.0.0.1',20030504123233);
INSERT INTO escalasandiego_com VALUES (7,'www.escalasandiego.com',28800,'A','216.120.60.10',20030621132157);

--
-- Table structure for table 'escalasd_com'
--

CREATE TABLE escalasd_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'escalasd_com'
--


INSERT INTO escalasd_com VALUES (1,'escalasd.com',28800,'A','216.120.60.10',20030621132157);
INSERT INTO escalasd_com VALUES (2,'escalasd.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002071803 14400 3600 604800 28800',20030504123234);
INSERT INTO escalasd_com VALUES (3,'escalasd.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO escalasd_com VALUES (4,'escalasd.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO escalasd_com VALUES (5,'escalasd.com',28800,'MX','10 mail.interactivate.com.',20030504123234);
INSERT INTO escalasd_com VALUES (6,'localhost.escalasd.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO escalasd_com VALUES (7,'www.escalasd.com',28800,'A','216.120.60.10',20030621132157);

--
-- Table structure for table 'euroamprop_com'
--

CREATE TABLE euroamprop_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'euroamprop_com'
--


INSERT INTO euroamprop_com VALUES (1,'euroamprop.com',300,'A','216.120.59.237',20030621132157);
INSERT INTO euroamprop_com VALUES (2,'euroamprop.com',300,'SOA','icg.interactivate.com. dns.interactivate.com. 2002022804 14400 3600 604800 28800',20030504123234);
INSERT INTO euroamprop_com VALUES (3,'euroamprop.com',300,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO euroamprop_com VALUES (4,'euroamprop.com',300,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO euroamprop_com VALUES (5,'euroamprop.com',300,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO euroamprop_com VALUES (6,'euroamprop.com',300,'MX','10 mail.euroamprop.com.',20030504123234);
INSERT INTO euroamprop_com VALUES (7,'euroamprop.com',300,'MX','20 inbound.electric.net.',20030504123234);
INSERT INTO euroamprop_com VALUES (8,'imap.euroamprop.com',300,'A','209.17.184.70',20030504123234);
INSERT INTO euroamprop_com VALUES (9,'mail.euroamprop.com',300,'A','216.20.230.146',20030504123234);
INSERT INTO euroamprop_com VALUES (10,'pop3.euroamprop.com',300,'A','209.17.184.70',20030504123234);
INSERT INTO euroamprop_com VALUES (11,'smtp.euroamprop.com',300,'A','209.129.90.46',20030504123234);
INSERT INTO euroamprop_com VALUES (12,'smtp.euroamprop.com',300,'A','216.120.59.237',20030621132157);
INSERT INTO euroamprop_com VALUES (13,'smtp-in.euroamprop.com',300,'A','209.17.184.46',20030504123234);
INSERT INTO euroamprop_com VALUES (14,'www.euroamprop.com',300,'A','216.120.59.237',20030621132157);
INSERT INTO euroamprop_com VALUES (16,'www2.euroamprop.com',28800,'A','216.120.59.227',20030803190127);

--
-- Table structure for table 'eurogardens_com'
--

CREATE TABLE eurogardens_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'eurogardens_com'
--


INSERT INTO eurogardens_com VALUES (1,'eurogardens.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000030203 14400 3600 604800 28800',20030504123234);
INSERT INTO eurogardens_com VALUES (2,'eurogardens.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO eurogardens_com VALUES (3,'eurogardens.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO eurogardens_com VALUES (4,'localhost.eurogardens.com',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'europeangardens_com'
--

CREATE TABLE europeangardens_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'europeangardens_com'
--


INSERT INTO europeangardens_com VALUES (1,'europeangardens.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001012904 14400 3600 604800 28800',20030504123234);
INSERT INTO europeangardens_com VALUES (2,'europeangardens.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO europeangardens_com VALUES (3,'europeangardens.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO europeangardens_com VALUES (4,'localhost.europeangardens.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO europeangardens_com VALUES (5,'localhost.europeangardens.com',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'executiveflowers_cc'
--

CREATE TABLE executiveflowers_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'executiveflowers_cc'
--


INSERT INTO executiveflowers_cc VALUES (1,'executiveflowers.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001021604 14400 3600 604800 28800',20030504123234);
INSERT INTO executiveflowers_cc VALUES (2,'executiveflowers.cc',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO executiveflowers_cc VALUES (3,'executiveflowers.cc',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO executiveflowers_cc VALUES (4,'localhost.executiveflowers.cc',28800,'A','127.0.0.1',20030504123234);
INSERT INTO executiveflowers_cc VALUES (5,'localhost.executiveflowers.cc',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'executiveflowers_com'
--

CREATE TABLE executiveflowers_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'executiveflowers_com'
--


INSERT INTO executiveflowers_com VALUES (1,'executiveflowers.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001021604 14400 3600 604800 28800',20030504123234);
INSERT INTO executiveflowers_com VALUES (2,'executiveflowers.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO executiveflowers_com VALUES (3,'executiveflowers.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO executiveflowers_com VALUES (4,'localhost.executiveflowers.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO executiveflowers_com VALUES (5,'localhost.executiveflowers.com',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'executiveflowers_net'
--

CREATE TABLE executiveflowers_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'executiveflowers_net'
--


INSERT INTO executiveflowers_net VALUES (1,'executiveflowers.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001021605 14400 3600 604800 28800',20030504123234);
INSERT INTO executiveflowers_net VALUES (2,'executiveflowers.net',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO executiveflowers_net VALUES (3,'executiveflowers.net',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO executiveflowers_net VALUES (4,'localhost.executiveflowers.net',28800,'A','127.0.0.1',20030504123234);
INSERT INTO executiveflowers_net VALUES (5,'localhost.executiveflowers.net',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'executiveflowers_org'
--

CREATE TABLE executiveflowers_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'executiveflowers_org'
--


INSERT INTO executiveflowers_org VALUES (1,'executiveflowers.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001021605 14400 3600 604800 28800',20030504123234);
INSERT INTO executiveflowers_org VALUES (2,'executiveflowers.org',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO executiveflowers_org VALUES (3,'executiveflowers.org',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO executiveflowers_org VALUES (4,'localhost.executiveflowers.org',28800,'A','127.0.0.1',20030504123234);
INSERT INTO executiveflowers_org VALUES (5,'localhost.executiveflowers.org',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'executivewatch_com'
--

CREATE TABLE executivewatch_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'executivewatch_com'
--


INSERT INTO executivewatch_com VALUES (1,'executivewatch.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123234);
INSERT INTO executivewatch_com VALUES (2,'executivewatch.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO executivewatch_com VALUES (3,'executivewatch.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO executivewatch_com VALUES (4,'localhost.executivewatch.com',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'fallmagic_biz'
--

CREATE TABLE fallmagic_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'fallmagic_biz'
--


INSERT INTO fallmagic_biz VALUES (1,'fallmagic.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO fallmagic_biz VALUES (2,'fallmagic.biz',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO fallmagic_biz VALUES (3,'fallmagic.biz',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO fallmagic_biz VALUES (4,'fallmagic.biz',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO fallmagic_biz VALUES (5,'fallmagic.biz',28800,'A','216.120.60.14',20030621132157);
INSERT INTO fallmagic_biz VALUES (6,'www.fallmagic.biz',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'fallmagic_com'
--

CREATE TABLE fallmagic_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'fallmagic_com'
--


INSERT INTO fallmagic_com VALUES (1,'fallmagic.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO fallmagic_com VALUES (2,'fallmagic.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO fallmagic_com VALUES (3,'fallmagic.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO fallmagic_com VALUES (4,'fallmagic.com',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO fallmagic_com VALUES (5,'fallmagic.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO fallmagic_com VALUES (6,'www.fallmagic.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO fallmagic_com VALUES (8,'www2.fallmagic.com',28800,'A','216.120.59.227',20030803190129);

--
-- Table structure for table 'fallmagic_info'
--

CREATE TABLE fallmagic_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'fallmagic_info'
--


INSERT INTO fallmagic_info VALUES (1,'fallmagic.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO fallmagic_info VALUES (2,'fallmagic.info',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO fallmagic_info VALUES (3,'fallmagic.info',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO fallmagic_info VALUES (4,'fallmagic.info',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO fallmagic_info VALUES (5,'fallmagic.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO fallmagic_info VALUES (6,'www.fallmagic.info',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'fashionweekla_com'
--

CREATE TABLE fashionweekla_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'fashionweekla_com'
--


INSERT INTO fashionweekla_com VALUES (1,'fashionweekla.com',28800,'SOA','ns.interactivate.com. dns.interactivate.com. 200302132 14400 3600 604800 86400',20030504123234);
INSERT INTO fashionweekla_com VALUES (2,'fashionweekla.com',28800,'NS','ns.interactivate.com.',20030504123234);
INSERT INTO fashionweekla_com VALUES (3,'fashionweekla.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO fashionweekla_com VALUES (4,'fashionweekla.com',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO fashionweekla_com VALUES (5,'fashionweekla.com',28800,'MX','10 mail.californiamart.com.',20030504123234);
INSERT INTO fashionweekla_com VALUES (6,'fashionweekla.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO fashionweekla_com VALUES (7,'www.fashionweekla.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO fashionweekla_com VALUES (9,'www2.fashionweekla.com',28800,'A','216.120.59.227',20030803190129);

--
-- Table structure for table 'flowerandplant_com'
--

CREATE TABLE flowerandplant_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'flowerandplant_com'
--


INSERT INTO flowerandplant_com VALUES (1,'flowerandplant.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007070804 14400 3600 604800 28800',20030504123234);
INSERT INTO flowerandplant_com VALUES (2,'flowerandplant.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO flowerandplant_com VALUES (3,'flowerandplant.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO flowerandplant_com VALUES (4,'localhost.flowerandplant.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO flowerandplant_com VALUES (5,'localhost.flowerandplant.com',28800,'A','216.120.59.241',20030621132157);
INSERT INTO flowerandplant_com VALUES (6,'www.flowerandplant.com',28800,'A','216.120.59.241',20030621132157);

--
-- Table structure for table 'flowerandplant_org'
--

CREATE TABLE flowerandplant_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'flowerandplant_org'
--


INSERT INTO flowerandplant_org VALUES (1,'flowerandplant.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007070804 14400 3600 604800 28800',20030504123234);
INSERT INTO flowerandplant_org VALUES (2,'flowerandplant.org',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO flowerandplant_org VALUES (3,'flowerandplant.org',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO flowerandplant_org VALUES (4,'localhost.flowerandplant.org',28800,'A','127.0.0.1',20030504123234);
INSERT INTO flowerandplant_org VALUES (5,'localhost.flowerandplant.org',28800,'A','216.120.59.241',20030621132157);
INSERT INTO flowerandplant_org VALUES (6,'www.flowerandplant.org',28800,'A','216.120.59.241',20030621132157);
INSERT INTO flowerandplant_org VALUES (9,'www2.flowerandplant.org',28800,'A','216.120.59.227',20030803190130);

--
-- Table structure for table 'freshanddirect_com'
--

CREATE TABLE freshanddirect_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'freshanddirect_com'
--


INSERT INTO freshanddirect_com VALUES (1,'freshanddirect.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123234);
INSERT INTO freshanddirect_com VALUES (2,'freshanddirect.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO freshanddirect_com VALUES (3,'freshanddirect.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO freshanddirect_com VALUES (4,'localhost.freshanddirect.com',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'freshanddirect_net'
--

CREATE TABLE freshanddirect_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'freshanddirect_net'
--


INSERT INTO freshanddirect_net VALUES (1,'freshanddirect.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123234);
INSERT INTO freshanddirect_net VALUES (2,'freshanddirect.net',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO freshanddirect_net VALUES (3,'freshanddirect.net',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO freshanddirect_net VALUES (4,'localhost.freshanddirect.net',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'freshisbest_com'
--

CREATE TABLE freshisbest_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'freshisbest_com'
--


INSERT INTO freshisbest_com VALUES (1,'freshisbest.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123234);
INSERT INTO freshisbest_com VALUES (2,'freshisbest.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO freshisbest_com VALUES (3,'freshisbest.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO freshisbest_com VALUES (4,'localhost.freshisbest.com',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'freshisbest_net'
--

CREATE TABLE freshisbest_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'freshisbest_net'
--


INSERT INTO freshisbest_net VALUES (1,'freshisbest.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123234);
INSERT INTO freshisbest_net VALUES (2,'freshisbest.net',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO freshisbest_net VALUES (3,'freshisbest.net',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO freshisbest_net VALUES (4,'localhost.freshisbest.net',28800,'A','127.0.0.1',20030504123234);

--
-- Table structure for table 'frozenzoo_com'
--

CREATE TABLE frozenzoo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'frozenzoo_com'
--


INSERT INTO frozenzoo_com VALUES (1,'frozenzoo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123234);
INSERT INTO frozenzoo_com VALUES (2,'frozenzoo.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_com VALUES (3,'frozenzoo.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_com VALUES (4,'frozenzoo.com',28800,'MX','100 bongo.sandiegozoo.org.',20030504123234);
INSERT INTO frozenzoo_com VALUES (5,'frozenzoo.com',28800,'A','216.120.88.242',20030621132157);
INSERT INTO frozenzoo_com VALUES (6,'al.frozenzoo.com',28800,'A','216.120.88.244',20030621132157);
INSERT INTO frozenzoo_com VALUES (7,'dev.frozenzoo.com',28800,'A','216.120.88.243',20030621132157);
INSERT INTO frozenzoo_com VALUES (8,'www.frozenzoo.com',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'frozenzoo_net'
--

CREATE TABLE frozenzoo_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'frozenzoo_net'
--


INSERT INTO frozenzoo_net VALUES (1,'frozenzoo.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123234);
INSERT INTO frozenzoo_net VALUES (2,'frozenzoo.net',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_net VALUES (3,'frozenzoo.net',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_net VALUES (4,'frozenzoo.net',28800,'MX','100 bongo.sandiegozoo.org.',20030504123234);
INSERT INTO frozenzoo_net VALUES (5,'frozenzoo.net',28800,'A','216.120.88.242',20030621132157);
INSERT INTO frozenzoo_net VALUES (6,'al.frozenzoo.net',28800,'A','216.120.88.244',20030621132157);
INSERT INTO frozenzoo_net VALUES (7,'dev.frozenzoo.net',28800,'A','216.120.88.243',20030621132157);
INSERT INTO frozenzoo_net VALUES (8,'www.frozenzoo.net',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'frozenzoo_org'
--

CREATE TABLE frozenzoo_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'frozenzoo_org'
--


INSERT INTO frozenzoo_org VALUES (1,'frozenzoo.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123234);
INSERT INTO frozenzoo_org VALUES (2,'frozenzoo.org',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_org VALUES (3,'frozenzoo.org',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO frozenzoo_org VALUES (4,'frozenzoo.org',28800,'MX','100 bongo.sandiegozoo.org.',20030504123234);
INSERT INTO frozenzoo_org VALUES (5,'frozenzoo.org',28800,'A','216.120.88.242',20030621132157);
INSERT INTO frozenzoo_org VALUES (6,'al.frozenzoo.org',28800,'A','216.120.88.244',20030621132157);
INSERT INTO frozenzoo_org VALUES (7,'dev.frozenzoo.org',28800,'A','216.120.88.243',20030621132157);
INSERT INTO frozenzoo_org VALUES (8,'www.frozenzoo.org',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'gardensofeurope_com'
--

CREATE TABLE gardensofeurope_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'gardensofeurope_com'
--


INSERT INTO gardensofeurope_com VALUES (1,'gardensofeurope.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001012904 14400 3600 604800 28800',20030504123234);
INSERT INTO gardensofeurope_com VALUES (2,'gardensofeurope.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO gardensofeurope_com VALUES (3,'gardensofeurope.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO gardensofeurope_com VALUES (4,'localhost.gardensofeurope.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO gardensofeurope_com VALUES (5,'localhost.gardensofeurope.com',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'greenleegrasses_com'
--

CREATE TABLE greenleegrasses_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'greenleegrasses_com'
--


INSERT INTO greenleegrasses_com VALUES (1,'greenleegrasses.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081404 14400 3600 604800 28800',20030504123234);
INSERT INTO greenleegrasses_com VALUES (2,'greenleegrasses.com',28800,'A','216.120.59.237',20030621132157);
INSERT INTO greenleegrasses_com VALUES (3,'greenleegrasses.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO greenleegrasses_com VALUES (4,'greenleegrasses.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO greenleegrasses_com VALUES (5,'greenleegrasses.com',28800,'MX','5 smtp.greenleegrasses.com.',20030504123234);
INSERT INTO greenleegrasses_com VALUES (6,'imap.greenleegrasses.com',28800,'A','209.17.184.70',20030504123234);
INSERT INTO greenleegrasses_com VALUES (7,'localhost.greenleegrasses.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO greenleegrasses_com VALUES (8,'loghost.greenleegrasses.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO greenleegrasses_com VALUES (9,'pop3.greenleegrasses.com',28800,'A','209.17.184.70',20030504123234);
INSERT INTO greenleegrasses_com VALUES (10,'smtp.greenleegrasses.com',28800,'A','209.17.184.46',20030504123234);
INSERT INTO greenleegrasses_com VALUES (11,'smtp-in.greenleegrasses.com',28800,'A','209.17.184.46',20030504123234);
INSERT INTO greenleegrasses_com VALUES (12,'www.greenleegrasses.com',28800,'A','216.120.59.237',20030621132157);
INSERT INTO greenleegrasses_com VALUES (13,'www.greenleegrasses.com',28800,'MX','10 euroamprop.com.',20030504123234);

--
-- Table structure for table 'greenmeadowgrowers_com'
--

CREATE TABLE greenmeadowgrowers_com (
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

--
-- Dumping data for table 'greenmeadowgrowers_com'
--


INSERT INTO greenmeadowgrowers_com VALUES (1,'greenmeadowgrowers.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003062306 14400 3600 604800 28800',20030623124257);
INSERT INTO greenmeadowgrowers_com VALUES (2,'greenmeadowgrowers.com',28800,'NS','icg.interactivate.com.',20030623123231);
INSERT INTO greenmeadowgrowers_com VALUES (3,'greenmeadowgrowers.com',28800,'NS','ns2.interactivate.com.',20030623123231);
INSERT INTO greenmeadowgrowers_com VALUES (4,'greenmeadowgrowers.com',28800,'NS','ns3.interactivate.com.',20030623123231);
INSERT INTO greenmeadowgrowers_com VALUES (5,'greenmeadowgrowers.com',28800,'A','216.20.230.146',20030623123247);
INSERT INTO greenmeadowgrowers_com VALUES (6,'www.greenmeadowgrowers.com',28800,'A','216.20.230.146',20030623123303);
INSERT INTO greenmeadowgrowers_com VALUES (7,'mail.greenmeadowgrowers.com',28800,'A','216.20.230.146',20030623123311);
INSERT INTO greenmeadowgrowers_com VALUES (8,'greenmeadowgrowers.com',28800,'MX','10 mail.greenmeadowgrowers.com.',20030623124257);

--
-- Table structure for table 'guacamole_info'
--

CREATE TABLE guacamole_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'guacamole_info'
--


INSERT INTO guacamole_info VALUES (1,'guacamole.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_info VALUES (2,'guacamole.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO guacamole_info VALUES (3,'guacamole.info',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO guacamole_info VALUES (4,'guacamole.info',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO guacamole_info VALUES (5,'guacamole.info',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO guacamole_info VALUES (6,'guacamole.info',28800,'MX','10 mail.avocado.org.',20030504123234);
INSERT INTO guacamole_info VALUES (7,'guacamole.info',28800,'MX','20 relay1.eni.net.',20030504123234);
INSERT INTO guacamole_info VALUES (8,'amric.guacamole.info',28800,'A','216.120.104.20',20030621132157);
INSERT INTO guacamole_info VALUES (9,'avoinfomx.guacamole.info',28800,'A','207.71.116.229',20030504123234);
INSERT INTO guacamole_info VALUES (10,'cac.guacamole.info',28800,'A','206.40.222.178',20030504123234);
INSERT INTO guacamole_info VALUES (11,'cac1.guacamole.info',28800,'A','209.170.17.65',20030504123234);
INSERT INTO guacamole_info VALUES (12,'crisis.guacamole.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_info VALUES (13,'dev.guacamole.info',28800,'A','216.120.104.21',20030621132157);
INSERT INTO guacamole_info VALUES (14,'extra.guacamole.info',28800,'A','216.120.59.233',20030621132157);
INSERT INTO guacamole_info VALUES (15,'handler.guacamole.info',28800,'A','207.110.32.98',20030504123234);
INSERT INTO guacamole_info VALUES (16,'localhost.guacamole.info',28800,'A','127.0.0.1',20030504123234);
INSERT INTO guacamole_info VALUES (17,'mail.guacamole.info',28800,'A','209.170.17.66',20030504123234);
INSERT INTO guacamole_info VALUES (18,'old.guacamole.info',28800,'A','216.120.104.19',20030621132157);
INSERT INTO guacamole_info VALUES (19,'owa.guacamole.info',28800,'A','209.170.17.67',20030504123234);
INSERT INTO guacamole_info VALUES (20,'updates.guacamole.info',28800,'MX','10 mail.interactivate.com.',20030504123234);
INSERT INTO guacamole_info VALUES (21,'www.guacamole.info',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_info VALUES (22,'xtra.guacamole.info',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'guacamole_org'
--

CREATE TABLE guacamole_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'guacamole_org'
--


INSERT INTO guacamole_org VALUES (1,'guacamole.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_org VALUES (2,'guacamole.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO guacamole_org VALUES (3,'guacamole.org',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO guacamole_org VALUES (4,'guacamole.org',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO guacamole_org VALUES (5,'guacamole.org',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO guacamole_org VALUES (6,'guacamole.org',28800,'MX','10 mail.avocado.org.',20030504123234);
INSERT INTO guacamole_org VALUES (7,'guacamole.org',28800,'MX','20 relay1.eni.net.',20030504123234);
INSERT INTO guacamole_org VALUES (8,'amric.guacamole.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO guacamole_org VALUES (9,'avoinfomx.guacamole.org',28800,'A','207.71.116.229',20030504123234);
INSERT INTO guacamole_org VALUES (10,'cac.guacamole.org',28800,'A','206.40.222.178',20030504123234);
INSERT INTO guacamole_org VALUES (11,'cac1.guacamole.org',28800,'A','209.170.17.65',20030504123234);
INSERT INTO guacamole_org VALUES (12,'crisis.guacamole.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_org VALUES (13,'dev.guacamole.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO guacamole_org VALUES (14,'extra.guacamole.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO guacamole_org VALUES (15,'handler.guacamole.org',28800,'A','207.110.32.98',20030504123234);
INSERT INTO guacamole_org VALUES (16,'localhost.guacamole.org',28800,'A','127.0.0.1',20030504123234);
INSERT INTO guacamole_org VALUES (17,'mail.guacamole.org',28800,'A','209.170.17.66',20030504123234);
INSERT INTO guacamole_org VALUES (18,'old.guacamole.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO guacamole_org VALUES (19,'owa.guacamole.org',28800,'A','209.170.17.67',20030504123234);
INSERT INTO guacamole_org VALUES (20,'updates.guacamole.org',28800,'MX','10 mail.interactivate.com.',20030504123234);
INSERT INTO guacamole_org VALUES (21,'www.guacamole.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO guacamole_org VALUES (22,'xtra.guacamole.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'haciendasantaluz_com'
--

CREATE TABLE haciendasantaluz_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'haciendasantaluz_com'
--


INSERT INTO haciendasantaluz_com VALUES (1,'haciendasantaluz.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123234);
INSERT INTO haciendasantaluz_com VALUES (2,'haciendasantaluz.com',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO haciendasantaluz_com VALUES (3,'haciendasantaluz.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO haciendasantaluz_com VALUES (4,'localhost.haciendasantaluz.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO haciendasantaluz_com VALUES (5,'localhost.haciendasantaluz.com',28800,'A','207.110.61.90',20030504123234);
INSERT INTO haciendasantaluz_com VALUES (6,'www.haciendasantaluz.com',28800,'A','207.110.61.90',20030504123234);

--
-- Table structure for table 'hapo_com'
--

CREATE TABLE hapo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'hapo_com'
--


INSERT INTO hapo_com VALUES (1,'hapo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO hapo_com VALUES (2,'hapo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123234);
INSERT INTO hapo_com VALUES (3,'hapo.com',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO hapo_com VALUES (4,'hapo.com',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO hapo_com VALUES (5,'hapo.com',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO hapo_com VALUES (6,'hapo.com',28800,'MX','10 mail.avocado.org.',20030504123234);
INSERT INTO hapo_com VALUES (7,'hapo.com',28800,'MX','20 relay1.eni.net.',20030504123234);
INSERT INTO hapo_com VALUES (8,'amric.hapo.com',28800,'A','216.120.104.20',20030621132157);
INSERT INTO hapo_com VALUES (9,'avoinfomx.hapo.com',28800,'A','207.71.116.229',20030504123234);
INSERT INTO hapo_com VALUES (10,'cac.hapo.com',28800,'A','206.40.222.178',20030504123234);
INSERT INTO hapo_com VALUES (11,'cac1.hapo.com',28800,'A','209.170.17.65',20030504123234);
INSERT INTO hapo_com VALUES (12,'crisis.hapo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO hapo_com VALUES (13,'dev.hapo.com',28800,'A','216.120.104.21',20030621132157);
INSERT INTO hapo_com VALUES (14,'extra.hapo.com',28800,'A','216.120.59.233',20030621132157);
INSERT INTO hapo_com VALUES (15,'handler.hapo.com',28800,'A','207.110.32.98',20030504123234);
INSERT INTO hapo_com VALUES (16,'localhost.hapo.com',28800,'A','127.0.0.1',20030504123234);
INSERT INTO hapo_com VALUES (17,'mail.hapo.com',28800,'A','209.170.17.66',20030504123234);
INSERT INTO hapo_com VALUES (18,'old.hapo.com',28800,'A','216.120.104.19',20030621132157);
INSERT INTO hapo_com VALUES (19,'owa.hapo.com',28800,'A','209.170.17.67',20030504123234);
INSERT INTO hapo_com VALUES (20,'updates.hapo.com',28800,'MX','10 mail.interactivate.com.',20030504123234);
INSERT INTO hapo_com VALUES (21,'www.hapo.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO hapo_com VALUES (22,'xtra.hapo.com',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'harborhousevillage_com'
--

CREATE TABLE harborhousevillage_com (
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

--
-- Dumping data for table 'harborhousevillage_com'
--


INSERT INTO harborhousevillage_com VALUES (1,'harborhousevillage.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102757);
INSERT INTO harborhousevillage_com VALUES (2,'harborhousevillage.com',28800,'NS','icg.interactivate.com.',20030708102757);
INSERT INTO harborhousevillage_com VALUES (3,'harborhousevillage.com',28800,'NS','ns2.interactivate.com.',20030708102757);
INSERT INTO harborhousevillage_com VALUES (4,'harborhousevillage.com',28800,'NS','ns3.interactivate.com.',20030708102757);
INSERT INTO harborhousevillage_com VALUES (5,'harborhousevillage.com',28800,'A','216.120.59.228',20030708102757);
INSERT INTO harborhousevillage_com VALUES (6,'www.harborhousevillage.com',28800,'A','216.120.59.228',20030708102757);
INSERT INTO harborhousevillage_com VALUES (8,'www2.harborhousevillage.com',28800,'A','216.120.59.227',20030803190201);

--
-- Table structure for table 'harborviewcottages_com'
--

CREATE TABLE harborviewcottages_com (
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

--
-- Dumping data for table 'harborviewcottages_com'
--


INSERT INTO harborviewcottages_com VALUES (1,'harborviewcottages.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102757);
INSERT INTO harborviewcottages_com VALUES (2,'harborviewcottages.com',28800,'NS','icg.interactivate.com.',20030708102757);
INSERT INTO harborviewcottages_com VALUES (3,'harborviewcottages.com',28800,'NS','ns2.interactivate.com.',20030708102757);
INSERT INTO harborviewcottages_com VALUES (4,'harborviewcottages.com',28800,'NS','ns3.interactivate.com.',20030708102757);
INSERT INTO harborviewcottages_com VALUES (5,'harborviewcottages.com',28800,'A','216.120.59.228',20030708102757);
INSERT INTO harborviewcottages_com VALUES (6,'www.harborviewcottages.com',28800,'A','216.120.59.228',20030708102757);
INSERT INTO harborviewcottages_com VALUES (8,'www2.harborviewcottages.com',28800,'A','216.120.59.227',20030803190202);

--
-- Table structure for table 'homeprequalify_com'
--

CREATE TABLE homeprequalify_com (
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

--
-- Dumping data for table 'homeprequalify_com'
--


INSERT INTO homeprequalify_com VALUES (1,'homeprequalify.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003081403 14400 3600 604800 28800',20030814105742);
INSERT INTO homeprequalify_com VALUES (2,'homeprequalify.com',28800,'NS','icg.interactivate.com.',20030814105732);
INSERT INTO homeprequalify_com VALUES (3,'homeprequalify.com',28800,'NS','ns2.interactivate.com.',20030814105732);
INSERT INTO homeprequalify_com VALUES (4,'homeprequalify.com',28800,'NS','ns3.interactivate.com.',20030814105732);
INSERT INTO homeprequalify_com VALUES (5,'homeprequalify.com',28800,'A','216.120.60.11',20030814105736);
INSERT INTO homeprequalify_com VALUES (6,'www.homeprequalify.com',28800,'A','216.120.60.11',20030814105742);

--
-- Table structure for table 'homequalifynow_com'
--

CREATE TABLE homequalifynow_com (
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

--
-- Dumping data for table 'homequalifynow_com'
--


INSERT INTO homequalifynow_com VALUES (1,'homequalifynow.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003081404 14400 3600 604800 28800',20030814105610);
INSERT INTO homequalifynow_com VALUES (2,'homequalifynow.com',28800,'NS','icg.interactivate.com.',20030814105531);
INSERT INTO homequalifynow_com VALUES (3,'homequalifynow.com',28800,'NS','ns2.interactivate.com.',20030814105531);
INSERT INTO homequalifynow_com VALUES (4,'homequalifynow.com',28800,'NS','ns3.interactivate.com.',20030814105531);
INSERT INTO homequalifynow_com VALUES (5,'homequalifynow.com',28800,'A','216.120.60.11',20030814105542);
INSERT INTO homequalifynow_com VALUES (6,'www.homequalifynow.com',28800,'A','216.120.60.11',20030814105550);
INSERT INTO homequalifynow_com VALUES (7,'www.homequalifynow.com',28800,'A','216.120.60.11',20030814105610);

--
-- Table structure for table 'icg_inc_net'
--

CREATE TABLE icg_inc_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'icg_inc_net'
--


INSERT INTO icg_inc_net VALUES (1,'icg-inc.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001051604 14400 3600 604800 28800',20030504123234);
INSERT INTO icg_inc_net VALUES (2,'icg-inc.net',28800,'NS','ns.connectnet.com.',20030504123234);
INSERT INTO icg_inc_net VALUES (3,'icg-inc.net',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO icg_inc_net VALUES (4,'icg-inc.net',28800,'MX','10 mail.icg-inc.net.',20030504123234);
INSERT INTO icg_inc_net VALUES (5,'icg-inc.net',28800,'A','207.110.56.101',20030504123234);
INSERT INTO icg_inc_net VALUES (6,'adm.icg-inc.net',28800,'A','63.141.73.8',20030504123234);
INSERT INTO icg_inc_net VALUES (7,'anais.icg-inc.net',28800,'A','207.110.61.55',20030504123234);
INSERT INTO icg_inc_net VALUES (8,'bart.icg-inc.net',28800,'A','209.242.137.182',20030504123234);
INSERT INTO icg_inc_net VALUES (9,'bd.icg-inc.net',28800,'A','63.141.73.13',20030504123234);
INSERT INTO icg_inc_net VALUES (10,'bofh.icg-inc.net',28800,'A','63.141.73.10',20030504123234);
INSERT INTO icg_inc_net VALUES (11,'cerebus.icg-inc.net',28800,'A','63.141.73.5',20030504123234);
INSERT INTO icg_inc_net VALUES (12,'cybermail.icg-inc.net',28800,'MX','10 mail.interactivate.unitymail.net.',20030504123234);
INSERT INTO icg_inc_net VALUES (13,'demo.icg-inc.net',28800,'A','207.110.56.97',20030504123234);
INSERT INTO icg_inc_net VALUES (14,'dmi.icg-inc.net',28800,'A','63.141.73.7',20030504123234);
INSERT INTO icg_inc_net VALUES (15,'ewatch.icg-inc.net',28800,'MX','10 interactivate.unitymail.net.',20030504123234);
INSERT INTO icg_inc_net VALUES (16,'firewall.icg-inc.net',28800,'CNAME','heimdall.icg-inc.net.',20030504123234);
INSERT INTO icg_inc_net VALUES (17,'ftp.icg-inc.net',28800,'A','207.110.42.216',20030504123234);
INSERT INTO icg_inc_net VALUES (18,'heimdall.icg-inc.net',28800,'A','63.141.73.3',20030504123234);
INSERT INTO icg_inc_net VALUES (19,'icg.icg-inc.net',28800,'A','207.110.42.216',20030504123234);
INSERT INTO icg_inc_net VALUES (20,'info.icg-inc.net',28800,'MX','10 interactivate.unitymail.net.',20030504123234);
INSERT INTO icg_inc_net VALUES (21,'it.icg-inc.net',28800,'A','63.141.73.12',20030504123234);
INSERT INTO icg_inc_net VALUES (22,'ladera.icg-inc.net',28800,'A','207.110.61.34',20030504123234);
INSERT INTO icg_inc_net VALUES (23,'localhost.icg-inc.net',28800,'A','127.0.0.1',20030504123234);
INSERT INTO icg_inc_net VALUES (24,'loghost.icg-inc.net',28800,'CNAME','www.interactivate.com.',20030504123234);
INSERT INTO icg_inc_net VALUES (25,'lyon.icg-inc.net',28800,'A','207.110.61.52',20030504123234);
INSERT INTO icg_inc_net VALUES (26,'mail.icg-inc.net',28800,'A','63.141.73.15',20030504123234);
INSERT INTO icg_inc_net VALUES (27,'market.icg-inc.net',28800,'A','63.141.73.2',20030504123234);
INSERT INTO icg_inc_net VALUES (28,'mysql.icg-inc.net',28800,'A','207.110.42.216',20030504123234);
INSERT INTO icg_inc_net VALUES (29,'nas.icg-inc.net',28800,'A','207.110.61.53',20030504123234);
INSERT INTO icg_inc_net VALUES (30,'new.icg-inc.net',28800,'A','207.110.61.51',20030504123234);
INSERT INTO icg_inc_net VALUES (31,'ns1.icg-inc.net',28800,'A','207.110.42.216',20030504123234);
INSERT INTO icg_inc_net VALUES (32,'ns2.icg-inc.net',28800,'A','207.110.0.60',20030504123234);
INSERT INTO icg_inc_net VALUES (33,'orwell.icg-inc.net',28800,'A','63.141.73.14',20030504123234);
INSERT INTO icg_inc_net VALUES (34,'padres.icg-inc.net',28800,'A','207.110.41.208',20030504123234);
INSERT INTO icg_inc_net VALUES (35,'pci.icg-inc.net',28800,'A','63.141.73.11',20030504123234);
INSERT INTO icg_inc_net VALUES (36,'pm.icg-inc.net',28800,'A','63.141.73.4',20030504123234);
INSERT INTO icg_inc_net VALUES (37,'router.icg-inc.net',28800,'A','63.141.73.1',20030504123234);
INSERT INTO icg_inc_net VALUES (38,'team.icg-inc.net',28800,'A','63.141.73.20',20030504123234);
INSERT INTO icg_inc_net VALUES (39,'vpn.icg-inc.net',28800,'CNAME','cerebus.interactivate.com.',20030504123234);
INSERT INTO icg_inc_net VALUES (40,'webcam.icg-inc.net',28800,'A','63.141.73.5',20030504123234);
INSERT INTO icg_inc_net VALUES (41,'webmail.icg-inc.net',28800,'A','207.110.56.96',20030504123234);
INSERT INTO icg_inc_net VALUES (42,'www.icg-inc.net',28800,'A','207.110.56.101',20030504123234);

--
-- Table structure for table 'interact8_biz'
--

CREATE TABLE interact8_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interact8_biz'
--


INSERT INTO interact8_biz VALUES (1,'interact8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_biz VALUES (2,'interact8.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123234);
INSERT INTO interact8_biz VALUES (3,'interact8.biz',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (4,'interact8.biz',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (5,'interact8.biz',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (6,'interact8.biz',28800,'MX','10 maila.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (7,'interact8.biz',28800,'MX','20 mail.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (8,'interact8.biz',28800,'MX','100 oasis.netoasis.net.',20030504123234);
INSERT INTO interact8_biz VALUES (9,'admin.interact8.biz',28800,'A','65.212.133.164',20030504123234);
INSERT INTO interact8_biz VALUES (10,'avo-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (11,'bart.interact8.biz',28800,'A','209.242.137.182',20030504123234);
INSERT INTO interact8_biz VALUES (12,'benoit.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (13,'bil-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (14,'bil-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (15,'bofh.interact8.biz',28800,'A','65.212.133.171',20030504123234);
INSERT INTO interact8_biz VALUES (16,'bsmart.interact8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_biz VALUES (17,'bug.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (18,'bugs.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (19,'cam-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (20,'cam-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (21,'cap-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (22,'cap-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (23,'caph-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (24,'caph-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (25,'cdr.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (26,'cdr-pro.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (27,'client-services.interact8.biz',28800,'A','65.212.133.165',20030504123234);
INSERT INTO interact8_biz VALUES (28,'cmc-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (29,'cmc-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (30,'cmc-live.interact8.biz',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interact8_biz VALUES (31,'cmc-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (32,'con-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (33,'con-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (34,'conf.interact8.biz',28800,'A','65.212.133.175',20030504123234);
INSERT INTO interact8_biz VALUES (35,'creative.interact8.biz',28800,'A','65.212.133.188',20030504123234);
INSERT INTO interact8_biz VALUES (36,'dav-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (37,'dav-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (38,'dead-pool.interact8.biz',28800,'A','65.212.133.176',20030504123234);
INSERT INTO interact8_biz VALUES (39,'demo.interact8.biz',28800,'CNAME','creative.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (40,'dev.interact8.biz',28800,'A','65.212.133.190',20030504123234);
INSERT INTO interact8_biz VALUES (41,'dev1.interact8.biz',28800,'A','65.212.133.186',20030504123234);
INSERT INTO interact8_biz VALUES (42,'dmi.interact8.biz',28800,'A','65.212.133.166',20030504123234);
INSERT INTO interact8_biz VALUES (43,'dns.interact8.biz',28800,'A','65.212.133.177',20030504123234);
INSERT INTO interact8_biz VALUES (44,'dubois-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (45,'dubois-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (46,'eartha.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (47,'esc-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (48,'esc-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (49,'eur-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (50,'eur-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (51,'euro-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (52,'euro-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (53,'ews-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (54,'ews-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (55,'ferret.interact8.biz',28800,'A','65.212.133.183',20030504123234);
INSERT INTO interact8_biz VALUES (56,'finance.interact8.biz',28800,'A','65.212.133.180',20030504123234);
INSERT INTO interact8_biz VALUES (57,'firewall.interact8.biz',28800,'CNAME','heimdall.interact8.biz.',20030504123234);
INSERT INTO interact8_biz VALUES (58,'flo-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (59,'flo-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (60,'flo-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (61,'ftp.interact8.biz',28800,'A','65.212.133.187',20030504123234);
INSERT INTO interact8_biz VALUES (62,'fwl-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (63,'fwl-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (64,'gas-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (65,'gas-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (66,'gcc-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (67,'gcc-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (68,'gw.interact8.biz',28800,'A','68.15.28.85',20030504123234);
INSERT INTO interact8_biz VALUES (69,'gw2.interact8.biz',28800,'A','65.212.133.162',20030504123234);
INSERT INTO interact8_biz VALUES (70,'handler-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (71,'heimdall.interact8.biz',28800,'A','65.212.133.162',20030504123234);
INSERT INTO interact8_biz VALUES (72,'hom-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (73,'hom-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (74,'hum-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (75,'hum-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (76,'iai-release.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (77,'icg.interact8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_biz VALUES (78,'iid-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (79,'iid-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (80,'imap.interact8.biz',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_biz VALUES (81,'irv-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (82,'isc-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (83,'isc-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (84,'john.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (85,'josh.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (86,'katz-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (87,'kau-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (88,'kau-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (89,'lad-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (90,'lad-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (91,'ladera.interact8.biz',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interact8_biz VALUES (92,'lappie.interact8.biz',28800,'A','65.212.133.174',20030504123234);
INSERT INTO interact8_biz VALUES (93,'localhost.interact8.biz',28800,'A','127.0.0.1',20030504123234);
INSERT INTO interact8_biz VALUES (94,'loghost.interact8.biz',28800,'CNAME','www.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (95,'luz-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (96,'luz-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (97,'lyo-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (98,'lyo-dux-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (99,'lyo-dux-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (100,'lyo-golf-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (101,'lyo-golf-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (102,'lyo-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (103,'lyon-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (104,'lyon-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (105,'lyonnt-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (106,'lyonpr-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (107,'mag-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (108,'mag-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (109,'magee-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (110,'magee-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (111,'mail.interact8.biz',28800,'A','65.212.133.168',20030504123234);
INSERT INTO interact8_biz VALUES (112,'mail2.interact8.biz',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_biz VALUES (113,'maila.interact8.biz',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_biz VALUES (114,'mailia.interact8.biz',28800,'A','65.212.133.182',20030504123234);
INSERT INTO interact8_biz VALUES (115,'market.interact8.biz',28800,'A','65.212.133.163',20030504123234);
INSERT INTO interact8_biz VALUES (116,'monitor.interact8.biz',28800,'CNAME','slacker.interact8.biz.',20030504123234);
INSERT INTO interact8_biz VALUES (117,'mysql.interact8.biz',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interact8_biz VALUES (118,'nas-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (119,'nas-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (120,'ns.interact8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_biz VALUES (121,'ns1.interact8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_biz VALUES (122,'ns2.interact8.biz',28800,'A','65.212.133.182',20030504123234);
INSERT INTO interact8_biz VALUES (123,'ns3.interact8.biz',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_biz VALUES (124,'nt-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (125,'orwell.interact8.biz',28800,'A','65.212.133.167',20030504123234);
INSERT INTO interact8_biz VALUES (126,'osb-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (127,'osb-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (128,'pad-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (129,'pad-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (130,'padres.interact8.biz',28800,'A','207.110.41.208',20030504123234);
INSERT INTO interact8_biz VALUES (131,'pfp-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (132,'pfy.interact8.biz',28800,'A','65.212.133.172',20030504123234);
INSERT INTO interact8_biz VALUES (133,'pgsql.interact8.biz',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interact8_biz VALUES (134,'pin-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (135,'pin-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (136,'pine-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (137,'pine-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (138,'pinehills.interact8.biz',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interact8_biz VALUES (139,'pop.interact8.biz',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_biz VALUES (140,'pro-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (141,'pro-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (142,'prov-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (143,'prov-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (144,'proven.interact8.biz',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interact8_biz VALUES (145,'rai-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (146,'rai-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (147,'rai-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (148,'raisins.interact8.biz',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interact8_biz VALUES (149,'rea-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (150,'rea-salad-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (151,'rea-salad-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (152,'rea-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (153,'read-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (154,'read-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (155,'recipe.interact8.biz',28800,'A','65.212.133.186',20030504123234);
INSERT INTO interact8_biz VALUES (156,'rjt-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (157,'rjt-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (158,'rmv-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (159,'rmv-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (160,'rod-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (161,'rod-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (162,'router.interact8.biz',28800,'A','65.212.133.161',20030504123234);
INSERT INTO interact8_biz VALUES (163,'rt.interact8.biz',28800,'A','63.141.73.17',20030504123234);
INSERT INTO interact8_biz VALUES (164,'rui-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (165,'rui-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (166,'rui2-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (167,'rui2-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (168,'sales.interact8.biz',28800,'A','65.212.133.179',20030504123234);
INSERT INTO interact8_biz VALUES (169,'scd-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (170,'scd-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (171,'scott.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (172,'sdaw.interact8.biz',28800,'A','216.51.113.21',20030504123234);
INSERT INTO interact8_biz VALUES (173,'sdc-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (174,'sdc-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (175,'sdy-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (176,'sdy-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (177,'sdyouth.interact8.biz',28800,'A','216.51.113.26',20030504123234);
INSERT INTO interact8_biz VALUES (178,'sea-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (179,'sea-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (180,'seac-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (181,'sgi-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (182,'sgi-dev2.interact8.biz',28800,'A','192.168.1.99',20030504123234);
INSERT INTO interact8_biz VALUES (183,'sgifs-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (184,'sil-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (185,'sil-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (186,'slacker.interact8.biz',28800,'A','65.212.133.178',20030504123234);
INSERT INTO interact8_biz VALUES (187,'smartix.interact8.biz',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interact8_biz VALUES (188,'solanocisrs.interact8.biz',28800,'A','65.212.133.181',20030504123234);
INSERT INTO interact8_biz VALUES (189,'staff.interact8.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interact8_biz VALUES (190,'staging.interact8.biz',28800,'A','65.212.133.189',20030504123234);
INSERT INTO interact8_biz VALUES (191,'sunkist.interact8.biz',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interact8_biz VALUES (192,'sunkistfs.interact8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_biz VALUES (193,'sus-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (194,'sus-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (195,'tal-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (196,'tal-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (197,'talega.interact8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_biz VALUES (198,'tay-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (199,'tay-mluz-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (200,'tay-mluz-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (201,'tay-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (202,'team.interact8.biz',28800,'A','65.212.133.169',20030504123234);
INSERT INTO interact8_biz VALUES (203,'train-cisrs.interact8.biz',28800,'A','65.212.133.181',20030504123234);
INSERT INTO interact8_biz VALUES (204,'twc-dev.interact8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (205,'uller.interact8.biz',28800,'A','65.212.133.177',20030504123234);
INSERT INTO interact8_biz VALUES (206,'updates.interact8.biz',28800,'MX','20 mail.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (207,'vpn.interact8.biz',28800,'A','65.212.133.170',20030504123234);
INSERT INTO interact8_biz VALUES (208,'webmail.interact8.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interact8_biz VALUES (209,'wor-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (210,'wor-staging.interact8.biz',28800,'A','216.51.113.21',20030504123234);
INSERT INTO interact8_biz VALUES (211,'wreath-develop.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (212,'wreath-staging.interact8.biz',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_biz VALUES (213,'www.interact8.biz',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interact8_info'
--

CREATE TABLE interact8_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interact8_info'
--


INSERT INTO interact8_info VALUES (1,'interact8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_info VALUES (2,'interact8.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123234);
INSERT INTO interact8_info VALUES (3,'interact8.info',28800,'NS','icg.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (4,'interact8.info',28800,'NS','ns2.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (5,'interact8.info',28800,'NS','ns3.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (6,'interact8.info',28800,'MX','10 maila.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (7,'interact8.info',28800,'MX','20 mail.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (8,'interact8.info',28800,'MX','100 oasis.netoasis.net.',20030504123234);
INSERT INTO interact8_info VALUES (9,'admin.interact8.info',28800,'A','65.212.133.164',20030504123234);
INSERT INTO interact8_info VALUES (10,'avo-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (11,'bart.interact8.info',28800,'A','209.242.137.182',20030504123234);
INSERT INTO interact8_info VALUES (12,'benoit.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (13,'bil-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (14,'bil-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (15,'bofh.interact8.info',28800,'A','65.212.133.171',20030504123234);
INSERT INTO interact8_info VALUES (16,'bsmart.interact8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_info VALUES (17,'bug.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (18,'bugs.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (19,'cam-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (20,'cam-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (21,'cap-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (22,'cap-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (23,'caph-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (24,'caph-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (25,'cdr.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (26,'cdr-pro.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (27,'client-services.interact8.info',28800,'A','65.212.133.165',20030504123234);
INSERT INTO interact8_info VALUES (28,'cmc-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (29,'cmc-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (30,'cmc-live.interact8.info',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interact8_info VALUES (31,'cmc-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (32,'con-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (33,'con-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (34,'conf.interact8.info',28800,'A','65.212.133.175',20030504123234);
INSERT INTO interact8_info VALUES (35,'creative.interact8.info',28800,'A','65.212.133.188',20030504123234);
INSERT INTO interact8_info VALUES (36,'dav-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (37,'dav-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (38,'dead-pool.interact8.info',28800,'A','65.212.133.176',20030504123234);
INSERT INTO interact8_info VALUES (39,'demo.interact8.info',28800,'CNAME','creative.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (40,'dev.interact8.info',28800,'A','65.212.133.190',20030504123234);
INSERT INTO interact8_info VALUES (41,'dev1.interact8.info',28800,'A','65.212.133.186',20030504123234);
INSERT INTO interact8_info VALUES (42,'dmi.interact8.info',28800,'A','65.212.133.166',20030504123234);
INSERT INTO interact8_info VALUES (43,'dns.interact8.info',28800,'A','65.212.133.177',20030504123234);
INSERT INTO interact8_info VALUES (44,'dubois-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (45,'dubois-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (46,'eartha.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (47,'esc-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (48,'esc-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (49,'eur-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (50,'eur-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (51,'euro-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (52,'euro-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (53,'ews-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (54,'ews-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (55,'ferret.interact8.info',28800,'A','65.212.133.183',20030504123234);
INSERT INTO interact8_info VALUES (56,'finance.interact8.info',28800,'A','65.212.133.180',20030504123234);
INSERT INTO interact8_info VALUES (57,'firewall.interact8.info',28800,'CNAME','heimdall.interact8.info.',20030504123234);
INSERT INTO interact8_info VALUES (58,'flo-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (59,'flo-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (60,'flo-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (61,'ftp.interact8.info',28800,'A','65.212.133.187',20030504123234);
INSERT INTO interact8_info VALUES (62,'fwl-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (63,'fwl-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (64,'gas-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (65,'gas-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (66,'gcc-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (67,'gcc-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (68,'gw.interact8.info',28800,'A','68.15.28.85',20030504123234);
INSERT INTO interact8_info VALUES (69,'gw2.interact8.info',28800,'A','65.212.133.162',20030504123234);
INSERT INTO interact8_info VALUES (70,'handler-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (71,'heimdall.interact8.info',28800,'A','65.212.133.162',20030504123234);
INSERT INTO interact8_info VALUES (72,'hom-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (73,'hom-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (74,'hum-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (75,'hum-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (76,'iai-release.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (77,'icg.interact8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_info VALUES (78,'iid-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (79,'iid-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (80,'imap.interact8.info',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_info VALUES (81,'irv-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (82,'isc-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (83,'isc-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (84,'john.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (85,'josh.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (86,'katz-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (87,'kau-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (88,'kau-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (89,'lad-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (90,'lad-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (91,'ladera.interact8.info',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interact8_info VALUES (92,'lappie.interact8.info',28800,'A','65.212.133.174',20030504123234);
INSERT INTO interact8_info VALUES (93,'localhost.interact8.info',28800,'A','127.0.0.1',20030504123234);
INSERT INTO interact8_info VALUES (94,'loghost.interact8.info',28800,'CNAME','www.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (95,'luz-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (96,'luz-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (97,'lyo-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (98,'lyo-dux-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (99,'lyo-dux-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (100,'lyo-golf-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (101,'lyo-golf-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (102,'lyo-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (103,'lyon-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (104,'lyon-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (105,'lyonnt-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (106,'lyonpr-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (107,'mag-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (108,'mag-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (109,'magee-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (110,'magee-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (111,'mail.interact8.info',28800,'A','65.212.133.168',20030504123234);
INSERT INTO interact8_info VALUES (112,'mail2.interact8.info',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_info VALUES (113,'maila.interact8.info',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_info VALUES (114,'mailia.interact8.info',28800,'A','65.212.133.182',20030504123234);
INSERT INTO interact8_info VALUES (115,'market.interact8.info',28800,'A','65.212.133.163',20030504123234);
INSERT INTO interact8_info VALUES (116,'monitor.interact8.info',28800,'CNAME','slacker.interact8.info.',20030504123234);
INSERT INTO interact8_info VALUES (117,'mysql.interact8.info',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interact8_info VALUES (118,'nas-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (119,'nas-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (120,'ns.interact8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_info VALUES (121,'ns1.interact8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interact8_info VALUES (122,'ns2.interact8.info',28800,'A','65.212.133.182',20030504123234);
INSERT INTO interact8_info VALUES (123,'ns3.interact8.info',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_info VALUES (124,'nt-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (125,'orwell.interact8.info',28800,'A','65.212.133.167',20030504123234);
INSERT INTO interact8_info VALUES (126,'osb-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (127,'osb-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (128,'pad-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (129,'pad-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (130,'padres.interact8.info',28800,'A','207.110.41.208',20030504123234);
INSERT INTO interact8_info VALUES (131,'pfp-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (132,'pfy.interact8.info',28800,'A','65.212.133.172',20030504123234);
INSERT INTO interact8_info VALUES (133,'pgsql.interact8.info',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interact8_info VALUES (134,'pin-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (135,'pin-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (136,'pine-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (137,'pine-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (138,'pinehills.interact8.info',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interact8_info VALUES (139,'pop.interact8.info',28800,'A','65.212.133.173',20030504123234);
INSERT INTO interact8_info VALUES (140,'pro-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (141,'pro-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (142,'prov-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (143,'prov-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (144,'proven.interact8.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interact8_info VALUES (145,'rai-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (146,'rai-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (147,'rai-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (148,'raisins.interact8.info',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interact8_info VALUES (149,'rea-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (150,'rea-salad-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (151,'rea-salad-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (152,'rea-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (153,'read-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (154,'read-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (155,'recipe.interact8.info',28800,'A','65.212.133.186',20030504123234);
INSERT INTO interact8_info VALUES (156,'rjt-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (157,'rjt-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (158,'rmv-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (159,'rmv-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (160,'rod-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (161,'rod-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (162,'router.interact8.info',28800,'A','65.212.133.161',20030504123234);
INSERT INTO interact8_info VALUES (163,'rt.interact8.info',28800,'A','63.141.73.17',20030504123234);
INSERT INTO interact8_info VALUES (164,'rui-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (165,'rui-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (166,'rui2-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (167,'rui2-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (168,'sales.interact8.info',28800,'A','65.212.133.179',20030504123234);
INSERT INTO interact8_info VALUES (169,'scd-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (170,'scd-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (171,'scott.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (172,'sdaw.interact8.info',28800,'A','216.51.113.21',20030504123234);
INSERT INTO interact8_info VALUES (173,'sdc-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (174,'sdc-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (175,'sdy-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (176,'sdy-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (177,'sdyouth.interact8.info',28800,'A','216.51.113.26',20030504123234);
INSERT INTO interact8_info VALUES (178,'sea-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (179,'sea-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (180,'seac-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (181,'sgi-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (182,'sgi-dev2.interact8.info',28800,'A','192.168.1.99',20030504123234);
INSERT INTO interact8_info VALUES (183,'sgifs-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (184,'sil-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (185,'sil-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (186,'slacker.interact8.info',28800,'A','65.212.133.178',20030504123234);
INSERT INTO interact8_info VALUES (187,'smartix.interact8.info',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interact8_info VALUES (188,'solanocisrs.interact8.info',28800,'A','65.212.133.181',20030504123234);
INSERT INTO interact8_info VALUES (189,'staff.interact8.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interact8_info VALUES (190,'staging.interact8.info',28800,'A','65.212.133.189',20030504123234);
INSERT INTO interact8_info VALUES (191,'sunkist.interact8.info',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interact8_info VALUES (192,'sunkistfs.interact8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_info VALUES (193,'sus-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (194,'sus-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (195,'tal-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (196,'tal-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (197,'talega.interact8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interact8_info VALUES (198,'tay-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (199,'tay-mluz-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (200,'tay-mluz-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (201,'tay-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (202,'team.interact8.info',28800,'A','65.212.133.169',20030504123234);
INSERT INTO interact8_info VALUES (203,'train-cisrs.interact8.info',28800,'A','65.212.133.181',20030504123234);
INSERT INTO interact8_info VALUES (204,'twc-dev.interact8.info',28800,'CNAME','dev1.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (205,'uller.interact8.info',28800,'A','65.212.133.177',20030504123234);
INSERT INTO interact8_info VALUES (206,'updates.interact8.info',28800,'MX','20 mail.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (207,'vpn.interact8.info',28800,'A','65.212.133.170',20030504123234);
INSERT INTO interact8_info VALUES (208,'webmail.interact8.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interact8_info VALUES (209,'wor-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (210,'wor-staging.interact8.info',28800,'A','216.51.113.21',20030504123234);
INSERT INTO interact8_info VALUES (211,'wreath-develop.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (212,'wreath-staging.interact8.info',28800,'CNAME','dev.interactivate.com.',20030504123234);
INSERT INTO interact8_info VALUES (213,'www.interact8.info',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactiv8_biz'
--

CREATE TABLE interactiv8_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactiv8_biz'
--


INSERT INTO interactiv8_biz VALUES (1,'interactiv8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_biz VALUES (2,'interactiv8.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactiv8_biz VALUES (3,'interactiv8.biz',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (4,'interactiv8.biz',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (5,'interactiv8.biz',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (6,'interactiv8.biz',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (7,'interactiv8.biz',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (8,'interactiv8.biz',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactiv8_biz VALUES (9,'admin.interactiv8.biz',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactiv8_biz VALUES (10,'avo-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (11,'bart.interactiv8.biz',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactiv8_biz VALUES (12,'benoit.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (13,'bil-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (14,'bil-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (15,'bofh.interactiv8.biz',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactiv8_biz VALUES (16,'bsmart.interactiv8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_biz VALUES (17,'bug.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (18,'bugs.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (19,'cam-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (20,'cam-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (21,'cap-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (22,'cap-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (23,'caph-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (24,'caph-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (25,'cdr.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (26,'cdr-pro.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (27,'client-services.interactiv8.biz',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactiv8_biz VALUES (28,'cmc-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (29,'cmc-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (30,'cmc-live.interactiv8.biz',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactiv8_biz VALUES (31,'cmc-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (32,'con-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (33,'con-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (34,'conf.interactiv8.biz',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactiv8_biz VALUES (35,'creative.interactiv8.biz',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactiv8_biz VALUES (36,'dav-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (37,'dav-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (38,'dead-pool.interactiv8.biz',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactiv8_biz VALUES (39,'demo.interactiv8.biz',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (40,'dev.interactiv8.biz',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactiv8_biz VALUES (41,'dev1.interactiv8.biz',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_biz VALUES (42,'dmi.interactiv8.biz',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactiv8_biz VALUES (43,'dns.interactiv8.biz',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_biz VALUES (44,'dubois-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (45,'dubois-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (46,'eartha.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (47,'esc-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (48,'esc-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (49,'eur-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (50,'eur-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (51,'euro-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (52,'euro-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (53,'ews-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (54,'ews-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (55,'ferret.interactiv8.biz',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactiv8_biz VALUES (56,'finance.interactiv8.biz',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactiv8_biz VALUES (57,'firewall.interactiv8.biz',28800,'CNAME','heimdall.interactiv8.biz.',20030504123235);
INSERT INTO interactiv8_biz VALUES (58,'flo-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (59,'flo-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (60,'flo-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (61,'ftp.interactiv8.biz',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactiv8_biz VALUES (62,'fwl-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (63,'fwl-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (64,'gas-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (65,'gas-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (66,'gcc-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (67,'gcc-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (68,'gw.interactiv8.biz',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactiv8_biz VALUES (69,'gw2.interactiv8.biz',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_biz VALUES (70,'handler-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (71,'heimdall.interactiv8.biz',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_biz VALUES (72,'hom-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (73,'hom-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (74,'hum-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (75,'hum-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (76,'iai-release.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (77,'icg.interactiv8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_biz VALUES (78,'iid-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (79,'iid-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (80,'imap.interactiv8.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_biz VALUES (81,'irv-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (82,'isc-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (83,'isc-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (84,'john.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (85,'josh.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (86,'katz-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (87,'kau-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (88,'kau-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (89,'lad-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (90,'lad-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (91,'ladera.interactiv8.biz',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactiv8_biz VALUES (92,'lappie.interactiv8.biz',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactiv8_biz VALUES (93,'localhost.interactiv8.biz',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactiv8_biz VALUES (94,'loghost.interactiv8.biz',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (95,'luz-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (96,'luz-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (97,'lyo-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (98,'lyo-dux-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (99,'lyo-dux-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (100,'lyo-golf-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (101,'lyo-golf-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (102,'lyo-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (103,'lyon-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (104,'lyon-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (105,'lyonnt-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (106,'lyonpr-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (107,'mag-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (108,'mag-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (109,'magee-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (110,'magee-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (111,'mail.interactiv8.biz',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactiv8_biz VALUES (112,'mail2.interactiv8.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_biz VALUES (113,'maila.interactiv8.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_biz VALUES (114,'mailia.interactiv8.biz',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_biz VALUES (115,'market.interactiv8.biz',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactiv8_biz VALUES (116,'monitor.interactiv8.biz',28800,'CNAME','slacker.interactiv8.biz.',20030504123235);
INSERT INTO interactiv8_biz VALUES (117,'mysql.interactiv8.biz',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactiv8_biz VALUES (118,'nas-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (119,'nas-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (120,'ns.interactiv8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_biz VALUES (121,'ns1.interactiv8.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_biz VALUES (122,'ns2.interactiv8.biz',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_biz VALUES (123,'ns3.interactiv8.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_biz VALUES (124,'nt-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (125,'orwell.interactiv8.biz',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactiv8_biz VALUES (126,'osb-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (127,'osb-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (128,'pad-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (129,'pad-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (130,'padres.interactiv8.biz',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactiv8_biz VALUES (131,'pfp-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (132,'pfy.interactiv8.biz',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactiv8_biz VALUES (133,'pgsql.interactiv8.biz',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactiv8_biz VALUES (134,'pin-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (135,'pin-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (136,'pine-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (137,'pine-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (138,'pinehills.interactiv8.biz',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactiv8_biz VALUES (139,'pop.interactiv8.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_biz VALUES (140,'pro-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (141,'pro-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (142,'prov-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (143,'prov-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (144,'proven.interactiv8.biz',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactiv8_biz VALUES (145,'rai-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (146,'rai-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (147,'rai-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (148,'raisins.interactiv8.biz',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactiv8_biz VALUES (149,'rea-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (150,'rea-salad-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (151,'rea-salad-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (152,'rea-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (153,'read-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (154,'read-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (155,'recipe.interactiv8.biz',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_biz VALUES (156,'rjt-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (157,'rjt-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (158,'rmv-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (159,'rmv-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (160,'rod-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (161,'rod-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (162,'router.interactiv8.biz',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactiv8_biz VALUES (163,'rt.interactiv8.biz',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactiv8_biz VALUES (164,'rui-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (165,'rui-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (166,'rui2-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (167,'rui2-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (168,'sales.interactiv8.biz',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactiv8_biz VALUES (169,'scd-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (170,'scd-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (171,'scott.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (172,'sdaw.interactiv8.biz',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_biz VALUES (173,'sdc-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (174,'sdc-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (175,'sdy-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (176,'sdy-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (177,'sdyouth.interactiv8.biz',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactiv8_biz VALUES (178,'sea-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (179,'sea-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (180,'seac-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (181,'sgi-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (182,'sgi-dev2.interactiv8.biz',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactiv8_biz VALUES (183,'sgifs-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (184,'sil-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (185,'sil-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (186,'slacker.interactiv8.biz',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactiv8_biz VALUES (187,'smartix.interactiv8.biz',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactiv8_biz VALUES (188,'solanocisrs.interactiv8.biz',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_biz VALUES (189,'staff.interactiv8.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_biz VALUES (190,'staging.interactiv8.biz',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactiv8_biz VALUES (191,'sunkist.interactiv8.biz',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactiv8_biz VALUES (192,'sunkistfs.interactiv8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_biz VALUES (193,'sus-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (194,'sus-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (195,'tal-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (196,'tal-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (197,'talega.interactiv8.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_biz VALUES (198,'tay-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (199,'tay-mluz-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (200,'tay-mluz-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (201,'tay-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (202,'team.interactiv8.biz',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactiv8_biz VALUES (203,'train-cisrs.interactiv8.biz',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_biz VALUES (204,'twc-dev.interactiv8.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (205,'uller.interactiv8.biz',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_biz VALUES (206,'updates.interactiv8.biz',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (207,'vpn.interactiv8.biz',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactiv8_biz VALUES (208,'webmail.interactiv8.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_biz VALUES (209,'wor-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (210,'wor-staging.interactiv8.biz',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_biz VALUES (211,'wreath-develop.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (212,'wreath-staging.interactiv8.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_biz VALUES (213,'www.interactiv8.biz',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactiv8_com'
--

CREATE TABLE interactiv8_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactiv8_com'
--


INSERT INTO interactiv8_com VALUES (1,'interactiv8.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_com VALUES (2,'interactiv8.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactiv8_com VALUES (3,'interactiv8.com',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (4,'interactiv8.com',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (5,'interactiv8.com',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (6,'interactiv8.com',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (7,'interactiv8.com',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (8,'interactiv8.com',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactiv8_com VALUES (9,'admin.interactiv8.com',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactiv8_com VALUES (10,'avo-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (11,'bart.interactiv8.com',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactiv8_com VALUES (12,'benoit.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (13,'bil-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (14,'bil-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (15,'bofh.interactiv8.com',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactiv8_com VALUES (16,'bsmart.interactiv8.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_com VALUES (17,'bug.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (18,'bugs.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (19,'cam-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (20,'cam-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (21,'cap-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (22,'cap-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (23,'caph-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (24,'caph-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (25,'cdr.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (26,'cdr-pro.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (27,'client-services.interactiv8.com',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactiv8_com VALUES (28,'cmc-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (29,'cmc-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (30,'cmc-live.interactiv8.com',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactiv8_com VALUES (31,'cmc-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (32,'con-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (33,'con-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (34,'conf.interactiv8.com',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactiv8_com VALUES (35,'creative.interactiv8.com',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactiv8_com VALUES (36,'dav-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (37,'dav-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (38,'dead-pool.interactiv8.com',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactiv8_com VALUES (39,'demo.interactiv8.com',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (40,'dev.interactiv8.com',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactiv8_com VALUES (41,'dev1.interactiv8.com',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_com VALUES (42,'dmi.interactiv8.com',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactiv8_com VALUES (43,'dns.interactiv8.com',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_com VALUES (44,'dubois-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (45,'dubois-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (46,'eartha.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (47,'esc-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (48,'esc-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (49,'eur-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (50,'eur-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (51,'euro-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (52,'euro-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (53,'ews-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (54,'ews-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (55,'ferret.interactiv8.com',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactiv8_com VALUES (56,'finance.interactiv8.com',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactiv8_com VALUES (57,'firewall.interactiv8.com',28800,'CNAME','heimdall.interactiv8.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (58,'flo-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (59,'flo-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (60,'flo-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (61,'ftp.interactiv8.com',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactiv8_com VALUES (62,'fwl-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (63,'fwl-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (64,'gas-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (65,'gas-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (66,'gcc-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (67,'gcc-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (68,'gw.interactiv8.com',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactiv8_com VALUES (69,'gw2.interactiv8.com',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_com VALUES (70,'handler-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (71,'heimdall.interactiv8.com',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_com VALUES (72,'hom-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (73,'hom-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (74,'hum-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (75,'hum-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (76,'iai-release.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (77,'icg.interactiv8.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_com VALUES (78,'iid-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (79,'iid-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (80,'imap.interactiv8.com',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_com VALUES (81,'irv-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (82,'isc-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (83,'isc-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (84,'john.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (85,'josh.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (86,'katz-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (87,'kau-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (88,'kau-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (89,'lad-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (90,'lad-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (91,'ladera.interactiv8.com',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactiv8_com VALUES (92,'lappie.interactiv8.com',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactiv8_com VALUES (93,'localhost.interactiv8.com',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactiv8_com VALUES (94,'loghost.interactiv8.com',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (95,'luz-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (96,'luz-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (97,'lyo-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (98,'lyo-dux-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (99,'lyo-dux-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (100,'lyo-golf-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (101,'lyo-golf-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (102,'lyo-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (103,'lyon-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (104,'lyon-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (105,'lyonnt-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (106,'lyonpr-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (107,'mag-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (108,'mag-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (109,'magee-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (110,'magee-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (111,'mail.interactiv8.com',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactiv8_com VALUES (112,'mail2.interactiv8.com',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_com VALUES (113,'maila.interactiv8.com',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_com VALUES (114,'mailia.interactiv8.com',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_com VALUES (115,'market.interactiv8.com',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactiv8_com VALUES (116,'monitor.interactiv8.com',28800,'CNAME','slacker.interactiv8.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (117,'mysql.interactiv8.com',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactiv8_com VALUES (118,'nas-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (119,'nas-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (120,'ns.interactiv8.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_com VALUES (121,'ns1.interactiv8.com',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_com VALUES (122,'ns2.interactiv8.com',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_com VALUES (123,'ns3.interactiv8.com',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_com VALUES (124,'nt-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (125,'orwell.interactiv8.com',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactiv8_com VALUES (126,'osb-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (127,'osb-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (128,'pad-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (129,'pad-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (130,'padres.interactiv8.com',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactiv8_com VALUES (131,'pfp-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (132,'pfy.interactiv8.com',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactiv8_com VALUES (133,'pgsql.interactiv8.com',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactiv8_com VALUES (134,'pin-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (135,'pin-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (136,'pine-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (137,'pine-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (138,'pinehills.interactiv8.com',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactiv8_com VALUES (139,'pop.interactiv8.com',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_com VALUES (140,'pro-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (141,'pro-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (142,'prov-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (143,'prov-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (144,'proven.interactiv8.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactiv8_com VALUES (145,'rai-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (146,'rai-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (147,'rai-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (148,'raisins.interactiv8.com',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactiv8_com VALUES (149,'rea-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (150,'rea-salad-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (151,'rea-salad-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (152,'rea-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (153,'read-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (154,'read-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (155,'recipe.interactiv8.com',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_com VALUES (156,'rjt-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (157,'rjt-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (158,'rmv-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (159,'rmv-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (160,'rod-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (161,'rod-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (162,'router.interactiv8.com',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactiv8_com VALUES (163,'rt.interactiv8.com',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactiv8_com VALUES (164,'rui-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (165,'rui-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (166,'rui2-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (167,'rui2-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (168,'sales.interactiv8.com',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactiv8_com VALUES (169,'scd-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (170,'scd-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (171,'scott.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (172,'sdaw.interactiv8.com',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_com VALUES (173,'sdc-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (174,'sdc-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (175,'sdy-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (176,'sdy-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (177,'sdyouth.interactiv8.com',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactiv8_com VALUES (178,'sea-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (179,'sea-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (180,'seac-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (181,'sgi-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (182,'sgi-dev2.interactiv8.com',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactiv8_com VALUES (183,'sgifs-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (184,'sil-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (185,'sil-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (186,'slacker.interactiv8.com',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactiv8_com VALUES (187,'smartix.interactiv8.com',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactiv8_com VALUES (188,'solanocisrs.interactiv8.com',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_com VALUES (189,'staff.interactiv8.com',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_com VALUES (190,'staging.interactiv8.com',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactiv8_com VALUES (191,'sunkist.interactiv8.com',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactiv8_com VALUES (192,'sunkistfs.interactiv8.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_com VALUES (193,'sus-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (194,'sus-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (195,'tal-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (196,'tal-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (197,'talega.interactiv8.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_com VALUES (198,'tay-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (199,'tay-mluz-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (200,'tay-mluz-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (201,'tay-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (202,'team.interactiv8.com',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactiv8_com VALUES (203,'train-cisrs.interactiv8.com',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_com VALUES (204,'twc-dev.interactiv8.com',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (205,'uller.interactiv8.com',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_com VALUES (206,'updates.interactiv8.com',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (207,'vpn.interactiv8.com',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactiv8_com VALUES (208,'webmail.interactiv8.com',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_com VALUES (209,'wor-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (210,'wor-staging.interactiv8.com',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_com VALUES (211,'wreath-develop.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (212,'wreath-staging.interactiv8.com',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_com VALUES (213,'www.interactiv8.com',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactiv8_info'
--

CREATE TABLE interactiv8_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactiv8_info'
--


INSERT INTO interactiv8_info VALUES (1,'interactiv8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_info VALUES (2,'interactiv8.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactiv8_info VALUES (3,'interactiv8.info',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (4,'interactiv8.info',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (5,'interactiv8.info',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (6,'interactiv8.info',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (7,'interactiv8.info',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (8,'interactiv8.info',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactiv8_info VALUES (9,'admin.interactiv8.info',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactiv8_info VALUES (10,'avo-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (11,'bart.interactiv8.info',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactiv8_info VALUES (12,'benoit.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (13,'bil-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (14,'bil-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (15,'bofh.interactiv8.info',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactiv8_info VALUES (16,'bsmart.interactiv8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_info VALUES (17,'bug.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (18,'bugs.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (19,'cam-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (20,'cam-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (21,'cap-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (22,'cap-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (23,'caph-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (24,'caph-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (25,'cdr.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (26,'cdr-pro.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (27,'client-services.interactiv8.info',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactiv8_info VALUES (28,'cmc-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (29,'cmc-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (30,'cmc-live.interactiv8.info',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactiv8_info VALUES (31,'cmc-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (32,'con-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (33,'con-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (34,'conf.interactiv8.info',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactiv8_info VALUES (35,'creative.interactiv8.info',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactiv8_info VALUES (36,'dav-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (37,'dav-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (38,'dead-pool.interactiv8.info',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactiv8_info VALUES (39,'demo.interactiv8.info',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (40,'dev.interactiv8.info',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactiv8_info VALUES (41,'dev1.interactiv8.info',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_info VALUES (42,'dmi.interactiv8.info',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactiv8_info VALUES (43,'dns.interactiv8.info',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_info VALUES (44,'dubois-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (45,'dubois-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (46,'eartha.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (47,'esc-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (48,'esc-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (49,'eur-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (50,'eur-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (51,'euro-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (52,'euro-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (53,'ews-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (54,'ews-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (55,'ferret.interactiv8.info',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactiv8_info VALUES (56,'finance.interactiv8.info',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactiv8_info VALUES (57,'firewall.interactiv8.info',28800,'CNAME','heimdall.interactiv8.info.',20030504123235);
INSERT INTO interactiv8_info VALUES (58,'flo-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (59,'flo-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (60,'flo-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (61,'ftp.interactiv8.info',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactiv8_info VALUES (62,'fwl-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (63,'fwl-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (64,'gas-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (65,'gas-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (66,'gcc-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (67,'gcc-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (68,'gw.interactiv8.info',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactiv8_info VALUES (69,'gw2.interactiv8.info',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_info VALUES (70,'handler-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (71,'heimdall.interactiv8.info',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_info VALUES (72,'hom-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (73,'hom-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (74,'hum-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (75,'hum-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (76,'iai-release.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (77,'icg.interactiv8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_info VALUES (78,'iid-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (79,'iid-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (80,'imap.interactiv8.info',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_info VALUES (81,'irv-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (82,'isc-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (83,'isc-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (84,'john.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (85,'josh.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (86,'katz-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (87,'kau-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (88,'kau-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (89,'lad-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (90,'lad-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (91,'ladera.interactiv8.info',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactiv8_info VALUES (92,'lappie.interactiv8.info',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactiv8_info VALUES (93,'localhost.interactiv8.info',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactiv8_info VALUES (94,'loghost.interactiv8.info',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (95,'luz-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (96,'luz-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (97,'lyo-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (98,'lyo-dux-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (99,'lyo-dux-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (100,'lyo-golf-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (101,'lyo-golf-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (102,'lyo-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (103,'lyon-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (104,'lyon-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (105,'lyonnt-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (106,'lyonpr-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (107,'mag-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (108,'mag-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (109,'magee-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (110,'magee-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (111,'mail.interactiv8.info',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactiv8_info VALUES (112,'mail2.interactiv8.info',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_info VALUES (113,'maila.interactiv8.info',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_info VALUES (114,'mailia.interactiv8.info',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_info VALUES (115,'market.interactiv8.info',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactiv8_info VALUES (116,'monitor.interactiv8.info',28800,'CNAME','slacker.interactiv8.info.',20030504123235);
INSERT INTO interactiv8_info VALUES (117,'mysql.interactiv8.info',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactiv8_info VALUES (118,'nas-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (119,'nas-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (120,'ns.interactiv8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_info VALUES (121,'ns1.interactiv8.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_info VALUES (122,'ns2.interactiv8.info',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_info VALUES (123,'ns3.interactiv8.info',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_info VALUES (124,'nt-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (125,'orwell.interactiv8.info',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactiv8_info VALUES (126,'osb-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (127,'osb-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (128,'pad-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (129,'pad-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (130,'padres.interactiv8.info',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactiv8_info VALUES (131,'pfp-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (132,'pfy.interactiv8.info',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactiv8_info VALUES (133,'pgsql.interactiv8.info',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactiv8_info VALUES (134,'pin-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (135,'pin-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (136,'pine-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (137,'pine-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (138,'pinehills.interactiv8.info',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactiv8_info VALUES (139,'pop.interactiv8.info',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_info VALUES (140,'pro-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (141,'pro-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (142,'prov-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (143,'prov-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (144,'proven.interactiv8.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactiv8_info VALUES (145,'rai-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (146,'rai-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (147,'rai-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (148,'raisins.interactiv8.info',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactiv8_info VALUES (149,'rea-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (150,'rea-salad-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (151,'rea-salad-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (152,'rea-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (153,'read-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (154,'read-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (155,'recipe.interactiv8.info',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_info VALUES (156,'rjt-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (157,'rjt-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (158,'rmv-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (159,'rmv-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (160,'rod-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (161,'rod-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (162,'router.interactiv8.info',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactiv8_info VALUES (163,'rt.interactiv8.info',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactiv8_info VALUES (164,'rui-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (165,'rui-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (166,'rui2-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (167,'rui2-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (168,'sales.interactiv8.info',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactiv8_info VALUES (169,'scd-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (170,'scd-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (171,'scott.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (172,'sdaw.interactiv8.info',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_info VALUES (173,'sdc-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (174,'sdc-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (175,'sdy-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (176,'sdy-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (177,'sdyouth.interactiv8.info',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactiv8_info VALUES (178,'sea-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (179,'sea-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (180,'seac-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (181,'sgi-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (182,'sgi-dev2.interactiv8.info',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactiv8_info VALUES (183,'sgifs-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (184,'sil-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (185,'sil-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (186,'slacker.interactiv8.info',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactiv8_info VALUES (187,'smartix.interactiv8.info',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactiv8_info VALUES (188,'solanocisrs.interactiv8.info',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_info VALUES (189,'staff.interactiv8.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_info VALUES (190,'staging.interactiv8.info',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactiv8_info VALUES (191,'sunkist.interactiv8.info',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactiv8_info VALUES (192,'sunkistfs.interactiv8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_info VALUES (193,'sus-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (194,'sus-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (195,'tal-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (196,'tal-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (197,'talega.interactiv8.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_info VALUES (198,'tay-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (199,'tay-mluz-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (200,'tay-mluz-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (201,'tay-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (202,'team.interactiv8.info',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactiv8_info VALUES (203,'train-cisrs.interactiv8.info',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_info VALUES (204,'twc-dev.interactiv8.info',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (205,'uller.interactiv8.info',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_info VALUES (206,'updates.interactiv8.info',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (207,'vpn.interactiv8.info',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactiv8_info VALUES (208,'webmail.interactiv8.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_info VALUES (209,'wor-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (210,'wor-staging.interactiv8.info',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_info VALUES (211,'wreath-develop.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (212,'wreath-staging.interactiv8.info',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_info VALUES (213,'www.interactiv8.info',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactiv8_net'
--

CREATE TABLE interactiv8_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactiv8_net'
--


INSERT INTO interactiv8_net VALUES (1,'interactiv8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_net VALUES (2,'interactiv8.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactiv8_net VALUES (3,'interactiv8.net',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (4,'interactiv8.net',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (5,'interactiv8.net',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (6,'interactiv8.net',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (7,'interactiv8.net',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (8,'interactiv8.net',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactiv8_net VALUES (9,'admin.interactiv8.net',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactiv8_net VALUES (10,'avo-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (11,'bart.interactiv8.net',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactiv8_net VALUES (12,'benoit.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (13,'bil-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (14,'bil-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (15,'bofh.interactiv8.net',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactiv8_net VALUES (16,'bsmart.interactiv8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_net VALUES (17,'bug.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (18,'bugs.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (19,'cam-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (20,'cam-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (21,'cap-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (22,'cap-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (23,'caph-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (24,'caph-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (25,'cdr.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (26,'cdr-pro.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (27,'client-services.interactiv8.net',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactiv8_net VALUES (28,'cmc-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (29,'cmc-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (30,'cmc-live.interactiv8.net',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactiv8_net VALUES (31,'cmc-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (32,'con-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (33,'con-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (34,'conf.interactiv8.net',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactiv8_net VALUES (35,'creative.interactiv8.net',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactiv8_net VALUES (36,'dav-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (37,'dav-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (38,'dead-pool.interactiv8.net',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactiv8_net VALUES (39,'demo.interactiv8.net',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (40,'dev.interactiv8.net',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactiv8_net VALUES (41,'dev1.interactiv8.net',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_net VALUES (42,'dmi.interactiv8.net',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactiv8_net VALUES (43,'dns.interactiv8.net',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_net VALUES (44,'dubois-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (45,'dubois-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (46,'eartha.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (47,'esc-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (48,'esc-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (49,'eur-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (50,'eur-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (51,'euro-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (52,'euro-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (53,'ews-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (54,'ews-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (55,'ferret.interactiv8.net',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactiv8_net VALUES (56,'finance.interactiv8.net',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactiv8_net VALUES (57,'firewall.interactiv8.net',28800,'CNAME','heimdall.interactiv8.net.',20030504123235);
INSERT INTO interactiv8_net VALUES (58,'flo-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (59,'flo-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (60,'flo-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (61,'ftp.interactiv8.net',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactiv8_net VALUES (62,'fwl-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (63,'fwl-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (64,'gas-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (65,'gas-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (66,'gcc-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (67,'gcc-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (68,'gw.interactiv8.net',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactiv8_net VALUES (69,'gw2.interactiv8.net',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_net VALUES (70,'handler-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (71,'heimdall.interactiv8.net',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactiv8_net VALUES (72,'hom-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (73,'hom-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (74,'hum-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (75,'hum-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (76,'iai-release.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (77,'icg.interactiv8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_net VALUES (78,'iid-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (79,'iid-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (80,'imap.interactiv8.net',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_net VALUES (81,'irv-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (82,'isc-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (83,'isc-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (84,'john.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (85,'josh.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (86,'katz-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (87,'kau-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (88,'kau-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (89,'lad-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (90,'lad-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (91,'ladera.interactiv8.net',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactiv8_net VALUES (92,'lappie.interactiv8.net',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactiv8_net VALUES (93,'localhost.interactiv8.net',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactiv8_net VALUES (94,'loghost.interactiv8.net',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (95,'luz-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (96,'luz-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (97,'lyo-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (98,'lyo-dux-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (99,'lyo-dux-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (100,'lyo-golf-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (101,'lyo-golf-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (102,'lyo-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (103,'lyon-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (104,'lyon-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (105,'lyonnt-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (106,'lyonpr-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (107,'mag-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (108,'mag-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (109,'magee-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (110,'magee-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (111,'mail.interactiv8.net',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactiv8_net VALUES (112,'mail2.interactiv8.net',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_net VALUES (113,'maila.interactiv8.net',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_net VALUES (114,'mailia.interactiv8.net',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_net VALUES (115,'market.interactiv8.net',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactiv8_net VALUES (116,'monitor.interactiv8.net',28800,'CNAME','slacker.interactiv8.net.',20030504123235);
INSERT INTO interactiv8_net VALUES (117,'mysql.interactiv8.net',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactiv8_net VALUES (118,'nas-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (119,'nas-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (120,'ns.interactiv8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_net VALUES (121,'ns1.interactiv8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactiv8_net VALUES (122,'ns2.interactiv8.net',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactiv8_net VALUES (123,'ns3.interactiv8.net',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_net VALUES (124,'nt-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (125,'orwell.interactiv8.net',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactiv8_net VALUES (126,'osb-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (127,'osb-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (128,'pad-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (129,'pad-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (130,'padres.interactiv8.net',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactiv8_net VALUES (131,'pfp-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (132,'pfy.interactiv8.net',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactiv8_net VALUES (133,'pgsql.interactiv8.net',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactiv8_net VALUES (134,'pin-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (135,'pin-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (136,'pine-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (137,'pine-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (138,'pinehills.interactiv8.net',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactiv8_net VALUES (139,'pop.interactiv8.net',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactiv8_net VALUES (140,'pro-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (141,'pro-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (142,'prov-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (143,'prov-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (144,'proven.interactiv8.net',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactiv8_net VALUES (145,'rai-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (146,'rai-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (147,'rai-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (148,'raisins.interactiv8.net',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactiv8_net VALUES (149,'rea-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (150,'rea-salad-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (151,'rea-salad-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (152,'rea-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (153,'read-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (154,'read-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (155,'recipe.interactiv8.net',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactiv8_net VALUES (156,'rjt-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (157,'rjt-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (158,'rmv-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (159,'rmv-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (160,'rod-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (161,'rod-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (162,'router.interactiv8.net',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactiv8_net VALUES (163,'rt.interactiv8.net',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactiv8_net VALUES (164,'rui-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (165,'rui-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (166,'rui2-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (167,'rui2-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (168,'sales.interactiv8.net',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactiv8_net VALUES (169,'scd-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (170,'scd-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (171,'scott.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (172,'sdaw.interactiv8.net',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_net VALUES (173,'sdc-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (174,'sdc-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (175,'sdy-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (176,'sdy-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (177,'sdyouth.interactiv8.net',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactiv8_net VALUES (178,'sea-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (179,'sea-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (180,'seac-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (181,'sgi-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (182,'sgi-dev2.interactiv8.net',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactiv8_net VALUES (183,'sgifs-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (184,'sil-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (185,'sil-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (186,'slacker.interactiv8.net',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactiv8_net VALUES (187,'smartix.interactiv8.net',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactiv8_net VALUES (188,'solanocisrs.interactiv8.net',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_net VALUES (189,'staff.interactiv8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_net VALUES (190,'staging.interactiv8.net',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactiv8_net VALUES (191,'sunkist.interactiv8.net',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactiv8_net VALUES (192,'sunkistfs.interactiv8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_net VALUES (193,'sus-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (194,'sus-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (195,'tal-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (196,'tal-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (197,'talega.interactiv8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactiv8_net VALUES (198,'tay-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (199,'tay-mluz-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (200,'tay-mluz-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (201,'tay-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (202,'team.interactiv8.net',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactiv8_net VALUES (203,'train-cisrs.interactiv8.net',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactiv8_net VALUES (204,'twc-dev.interactiv8.net',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (205,'uller.interactiv8.net',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactiv8_net VALUES (206,'updates.interactiv8.net',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (207,'vpn.interactiv8.net',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactiv8_net VALUES (208,'webmail.interactiv8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactiv8_net VALUES (209,'wor-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (210,'wor-staging.interactiv8.net',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactiv8_net VALUES (211,'wreath-develop.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (212,'wreath-staging.interactiv8.net',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactiv8_net VALUES (213,'www.interactiv8.net',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactivate8_net'
--

CREATE TABLE interactivate8_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate8_net'
--


INSERT INTO interactivate8_net VALUES (1,'interactivate8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate8_net VALUES (2,'interactivate8.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121085 14400 3600 604800 28800',20030504123236);
INSERT INTO interactivate8_net VALUES (3,'interactivate8.net',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (4,'interactivate8.net',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (5,'interactivate8.net',28800,'NS','ns3.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (6,'interactivate8.net',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (7,'admin.interactivate8.net',28800,'A','65.212.133.164',20030504123236);
INSERT INTO interactivate8_net VALUES (8,'avo-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (9,'bart.interactivate8.net',28800,'A','209.242.137.182',20030504123236);
INSERT INTO interactivate8_net VALUES (10,'benoit.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (11,'bil-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (12,'bil-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (13,'bofh.interactivate8.net',28800,'A','65.212.133.171',20030504123236);
INSERT INTO interactivate8_net VALUES (14,'bsmart.interactivate8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate8_net VALUES (15,'bug.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (16,'bugs.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (17,'cam-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (18,'cam-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (19,'cap-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (20,'cap-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (21,'caph-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (22,'caph-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (23,'cdr.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (24,'cdr-pro.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (25,'client-services.interactivate8.net',28800,'A','65.212.133.165',20030504123236);
INSERT INTO interactivate8_net VALUES (26,'cmc-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (27,'cmc-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (28,'cmc-live.interactivate8.net',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactivate8_net VALUES (29,'cmc-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (30,'con-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (31,'con-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (32,'conf.interactivate8.net',28800,'A','65.212.133.175',20030504123236);
INSERT INTO interactivate8_net VALUES (33,'creative.interactivate8.net',28800,'A','65.212.133.188',20030504123236);
INSERT INTO interactivate8_net VALUES (34,'dav-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (35,'dav-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (36,'dead-pool.interactivate8.net',28800,'A','65.212.133.176',20030504123236);
INSERT INTO interactivate8_net VALUES (37,'demo.interactivate8.net',28800,'CNAME','creative.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (38,'dev.interactivate8.net',28800,'A','65.212.133.190',20030504123236);
INSERT INTO interactivate8_net VALUES (39,'dev1.interactivate8.net',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate8_net VALUES (40,'dmi.interactivate8.net',28800,'A','65.212.133.166',20030504123236);
INSERT INTO interactivate8_net VALUES (41,'dns.interactivate8.net',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate8_net VALUES (42,'dubois-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (43,'dubois-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (44,'eartha.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (45,'esc-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (46,'esc-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (47,'eur-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (48,'eur-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (49,'euro-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (50,'euro-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (51,'ews-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (52,'ews-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (53,'ferret.interactivate8.net',28800,'A','65.212.133.183',20030504123236);
INSERT INTO interactivate8_net VALUES (54,'finance.interactivate8.net',28800,'A','65.212.133.180',20030504123236);
INSERT INTO interactivate8_net VALUES (55,'firewall.interactivate8.net',28800,'CNAME','heimdall.interactivate8.net.',20030504123236);
INSERT INTO interactivate8_net VALUES (56,'flo-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (57,'flo-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (58,'flo-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (59,'ftp.interactivate8.net',28800,'A','65.212.133.187',20030504123236);
INSERT INTO interactivate8_net VALUES (60,'fwl-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (61,'fwl-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (62,'gas-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (63,'gas-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (64,'gcc-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (65,'gcc-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (66,'gw.interactivate8.net',28800,'A','68.15.28.85',20030504123236);
INSERT INTO interactivate8_net VALUES (67,'gw2.interactivate8.net',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate8_net VALUES (68,'handler-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (69,'heimdall.interactivate8.net',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate8_net VALUES (70,'hom-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (71,'hom-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (72,'hum-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (73,'hum-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (74,'iai-release.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (75,'icg.interactivate8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate8_net VALUES (76,'iid-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (77,'iid-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (78,'irv-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (79,'isc-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (80,'isc-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (81,'john.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (82,'josh.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (83,'katz-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (84,'kau-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (85,'kau-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (86,'lad-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (87,'lad-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (88,'ladera.interactivate8.net',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactivate8_net VALUES (89,'lappie.interactivate8.net',28800,'A','65.212.133.174',20030504123236);
INSERT INTO interactivate8_net VALUES (90,'localhost.interactivate8.net',28800,'A','127.0.0.1',20030504123236);
INSERT INTO interactivate8_net VALUES (91,'loghost.interactivate8.net',28800,'CNAME','www.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (92,'luz-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (93,'luz-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (94,'lyo-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (95,'lyo-dux-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (96,'lyo-dux-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (97,'lyo-golf-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (98,'lyo-golf-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (99,'lyo-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (100,'lyon-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (101,'lyon-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (102,'lyonnt-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (103,'lyonpr-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (104,'mag-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (105,'mag-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (106,'magee-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (107,'magee-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (108,'mail.interactivate8.net',28800,'A','65.212.133.168',20030504123236);
INSERT INTO interactivate8_net VALUES (109,'mail2.interactivate8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate8_net VALUES (110,'maila.interactivate8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate8_net VALUES (111,'mailia.interactivate8.net',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate8_net VALUES (112,'market.interactivate8.net',28800,'A','65.212.133.163',20030504123236);
INSERT INTO interactivate8_net VALUES (113,'monitor.interactivate8.net',28800,'CNAME','slacker.interactivate8.net.',20030504123236);
INSERT INTO interactivate8_net VALUES (114,'mysql.interactivate8.net',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactivate8_net VALUES (115,'nas-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (116,'nas-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (117,'ns.interactivate8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate8_net VALUES (118,'ns1.interactivate8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate8_net VALUES (119,'ns2.interactivate8.net',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate8_net VALUES (120,'ns3.interactivate8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate8_net VALUES (121,'nt-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (122,'orwell.interactivate8.net',28800,'A','65.212.133.167',20030504123236);
INSERT INTO interactivate8_net VALUES (123,'osb-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (124,'osb-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (125,'pad-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (126,'pad-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (127,'padres.interactivate8.net',28800,'A','207.110.41.208',20030504123236);
INSERT INTO interactivate8_net VALUES (128,'pfp-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (129,'pfy.interactivate8.net',28800,'A','65.212.133.172',20030504123236);
INSERT INTO interactivate8_net VALUES (130,'pgsql.interactivate8.net',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactivate8_net VALUES (131,'pin-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (132,'pin-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (133,'pine-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (134,'pine-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (135,'pinehills.interactivate8.net',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactivate8_net VALUES (136,'pro-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (137,'pro-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (138,'prov-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (139,'prov-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (140,'proven.interactivate8.net',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactivate8_net VALUES (141,'rai-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (142,'rai-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (143,'rai-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (144,'raisins.interactivate8.net',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactivate8_net VALUES (145,'rea-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (146,'rea-salad-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (147,'rea-salad-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (148,'rea-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (149,'read-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (150,'read-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (151,'recipe.interactivate8.net',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate8_net VALUES (152,'rjt-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (153,'rjt-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (154,'rmv-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (155,'rmv-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (156,'router.interactivate8.net',28800,'A','65.212.133.161',20030504123236);
INSERT INTO interactivate8_net VALUES (157,'rt.interactivate8.net',28800,'A','63.141.73.17',20030504123236);
INSERT INTO interactivate8_net VALUES (158,'rui-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (159,'rui-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (160,'rui2-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (161,'rui2-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (162,'sales.interactivate8.net',28800,'A','65.212.133.179',20030504123236);
INSERT INTO interactivate8_net VALUES (163,'scd-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (164,'scd-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (165,'scott.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (166,'sdaw.interactivate8.net',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactivate8_net VALUES (167,'sdc-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (168,'sdc-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (169,'sdy-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (170,'sdy-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (171,'sdyouth.interactivate8.net',28800,'A','216.51.113.26',20030504123236);
INSERT INTO interactivate8_net VALUES (172,'sea-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (173,'sea-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (174,'seac-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (175,'sgi-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (176,'sgi-dev2.interactivate8.net',28800,'A','192.168.1.99',20030504123236);
INSERT INTO interactivate8_net VALUES (177,'sgifs-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (178,'sil-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (179,'sil-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (180,'slacker.interactivate8.net',28800,'A','65.212.133.178',20030504123236);
INSERT INTO interactivate8_net VALUES (181,'smartix.interactivate8.net',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactivate8_net VALUES (182,'solanocisrs.interactivate8.net',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate8_net VALUES (183,'staff.interactivate8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate8_net VALUES (184,'staging.interactivate8.net',28800,'A','65.212.133.189',20030504123236);
INSERT INTO interactivate8_net VALUES (185,'sunkist.interactivate8.net',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactivate8_net VALUES (186,'sunkistfs.interactivate8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate8_net VALUES (187,'sus-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (188,'sus-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (189,'tal-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (190,'tal-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (191,'talega.interactivate8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate8_net VALUES (192,'tay-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (193,'tay-mluz-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (194,'tay-mluz-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (195,'tay-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (196,'team.interactivate8.net',28800,'A','65.212.133.169',20030504123236);
INSERT INTO interactivate8_net VALUES (197,'train-cisrs.interactivate8.net',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate8_net VALUES (198,'twc-dev.interactivate8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (199,'uller.interactivate8.net',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate8_net VALUES (200,'updates.interactivate8.net',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (201,'updates.interactivate8.net',28800,'MX','20 oasis.netoasis.net.',20030504123236);
INSERT INTO interactivate8_net VALUES (202,'vpn.interactivate8.net',28800,'A','65.212.133.170',20030504123236);
INSERT INTO interactivate8_net VALUES (203,'webmail.interactivate8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate8_net VALUES (204,'wor-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (205,'wor-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (206,'wreath-develop.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (207,'wreath-staging.interactivate8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate8_net VALUES (208,'www.interactivate8.net',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactivate_biz'
--

CREATE TABLE interactivate_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate_biz'
--


INSERT INTO interactivate_biz VALUES (1,'interactivate.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_biz VALUES (2,'interactivate.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactivate_biz VALUES (3,'interactivate.biz',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (4,'interactivate.biz',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (5,'interactivate.biz',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (6,'interactivate.biz',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (7,'interactivate.biz',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (8,'interactivate.biz',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactivate_biz VALUES (9,'admin.interactivate.biz',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactivate_biz VALUES (10,'avo-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (11,'bart.interactivate.biz',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactivate_biz VALUES (12,'benoit.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (13,'bil-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (14,'bil-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (15,'bofh.interactivate.biz',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactivate_biz VALUES (16,'bsmart.interactivate.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_biz VALUES (17,'bug.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (18,'bugs.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (19,'cam-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (20,'cam-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (21,'cap-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (22,'cap-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (23,'caph-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (24,'caph-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (25,'cdr.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (26,'cdr-pro.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (27,'client-services.interactivate.biz',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactivate_biz VALUES (28,'cmc-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (29,'cmc-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (30,'cmc-live.interactivate.biz',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactivate_biz VALUES (31,'cmc-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (32,'con-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (33,'con-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (34,'conf.interactivate.biz',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactivate_biz VALUES (35,'creative.interactivate.biz',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactivate_biz VALUES (36,'dav-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (37,'dav-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (38,'dead-pool.interactivate.biz',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactivate_biz VALUES (39,'demo.interactivate.biz',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (40,'dev.interactivate.biz',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactivate_biz VALUES (41,'dev1.interactivate.biz',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactivate_biz VALUES (42,'dmi.interactivate.biz',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactivate_biz VALUES (43,'dns.interactivate.biz',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactivate_biz VALUES (44,'dubois-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (45,'dubois-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (46,'eartha.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (47,'esc-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (48,'esc-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (49,'eur-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (50,'eur-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (51,'euro-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (52,'euro-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (53,'ews-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (54,'ews-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (55,'ferret.interactivate.biz',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactivate_biz VALUES (56,'finance.interactivate.biz',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactivate_biz VALUES (57,'firewall.interactivate.biz',28800,'CNAME','heimdall.interactivate.biz.',20030504123235);
INSERT INTO interactivate_biz VALUES (58,'flo-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (59,'flo-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (60,'flo-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (61,'ftp.interactivate.biz',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactivate_biz VALUES (62,'fwl-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (63,'fwl-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (64,'gas-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (65,'gas-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (66,'gcc-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (67,'gcc-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (68,'gw.interactivate.biz',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactivate_biz VALUES (69,'gw2.interactivate.biz',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactivate_biz VALUES (70,'handler-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (71,'heimdall.interactivate.biz',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactivate_biz VALUES (72,'hom-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (73,'hom-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (74,'hum-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (75,'hum-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (76,'iai-release.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (77,'icg.interactivate.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_biz VALUES (78,'iid-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (79,'iid-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (80,'imap.interactivate.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_biz VALUES (81,'irv-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (82,'isc-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (83,'isc-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (84,'john.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (85,'josh.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (86,'katz-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (87,'kau-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (88,'kau-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (89,'lad-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (90,'lad-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (91,'ladera.interactivate.biz',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactivate_biz VALUES (92,'lappie.interactivate.biz',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactivate_biz VALUES (93,'localhost.interactivate.biz',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactivate_biz VALUES (94,'loghost.interactivate.biz',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (95,'luz-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (96,'luz-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (97,'lyo-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (98,'lyo-dux-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (99,'lyo-dux-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (100,'lyo-golf-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (101,'lyo-golf-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (102,'lyo-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (103,'lyon-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (104,'lyon-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (105,'lyonnt-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (106,'lyonpr-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (107,'mag-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (108,'mag-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (109,'magee-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (110,'magee-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (111,'mail.interactivate.biz',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactivate_biz VALUES (112,'mail2.interactivate.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_biz VALUES (113,'maila.interactivate.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_biz VALUES (114,'mailia.interactivate.biz',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactivate_biz VALUES (115,'market.interactivate.biz',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactivate_biz VALUES (116,'monitor.interactivate.biz',28800,'CNAME','slacker.interactivate.biz.',20030504123235);
INSERT INTO interactivate_biz VALUES (117,'mysql.interactivate.biz',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactivate_biz VALUES (118,'nas-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (119,'nas-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (120,'ns.interactivate.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_biz VALUES (121,'ns1.interactivate.biz',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_biz VALUES (122,'ns2.interactivate.biz',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactivate_biz VALUES (123,'ns3.interactivate.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_biz VALUES (124,'nt-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (125,'orwell.interactivate.biz',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactivate_biz VALUES (126,'osb-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (127,'osb-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (128,'pad-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (129,'pad-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (130,'padres.interactivate.biz',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactivate_biz VALUES (131,'pfp-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (132,'pfy.interactivate.biz',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactivate_biz VALUES (133,'pgsql.interactivate.biz',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactivate_biz VALUES (134,'pin-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (135,'pin-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (136,'pine-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (137,'pine-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (138,'pinehills.interactivate.biz',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactivate_biz VALUES (139,'pop.interactivate.biz',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_biz VALUES (140,'pro-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (141,'pro-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (142,'prov-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (143,'prov-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (144,'proven.interactivate.biz',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactivate_biz VALUES (145,'rai-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (146,'rai-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (147,'rai-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (148,'raisins.interactivate.biz',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactivate_biz VALUES (149,'rea-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (150,'rea-salad-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (151,'rea-salad-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (152,'rea-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (153,'read-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (154,'read-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (155,'recipe.interactivate.biz',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactivate_biz VALUES (156,'rjt-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (157,'rjt-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (158,'rmv-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (159,'rmv-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (160,'rod-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (161,'rod-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (162,'router.interactivate.biz',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactivate_biz VALUES (163,'rt.interactivate.biz',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactivate_biz VALUES (164,'rui-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (165,'rui-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (166,'rui2-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (167,'rui2-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (168,'sales.interactivate.biz',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactivate_biz VALUES (169,'scd-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (170,'scd-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (171,'scott.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (172,'sdaw.interactivate.biz',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactivate_biz VALUES (173,'sdc-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (174,'sdc-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (175,'sdy-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (176,'sdy-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (177,'sdyouth.interactivate.biz',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactivate_biz VALUES (178,'sea-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (179,'sea-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (180,'seac-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (181,'sgi-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (182,'sgi-dev2.interactivate.biz',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactivate_biz VALUES (183,'sgifs-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (184,'sil-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (185,'sil-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (186,'slacker.interactivate.biz',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactivate_biz VALUES (187,'smartix.interactivate.biz',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactivate_biz VALUES (188,'solanocisrs.interactivate.biz',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactivate_biz VALUES (189,'staff.interactivate.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_biz VALUES (190,'staging.interactivate.biz',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactivate_biz VALUES (191,'sunkist.interactivate.biz',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactivate_biz VALUES (192,'sunkistfs.interactivate.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_biz VALUES (193,'sus-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (194,'sus-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (195,'tal-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (196,'tal-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (197,'talega.interactivate.biz',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_biz VALUES (198,'tay-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (199,'tay-mluz-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (200,'tay-mluz-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (201,'tay-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (202,'team.interactivate.biz',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactivate_biz VALUES (203,'train-cisrs.interactivate.biz',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactivate_biz VALUES (204,'twc-dev.interactivate.biz',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (205,'uller.interactivate.biz',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactivate_biz VALUES (206,'updates.interactivate.biz',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (207,'vpn.interactivate.biz',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactivate_biz VALUES (208,'webmail.interactivate.biz',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_biz VALUES (209,'wor-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (210,'wor-staging.interactivate.biz',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactivate_biz VALUES (211,'wreath-develop.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (212,'wreath-staging.interactivate.biz',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_biz VALUES (213,'www.interactivate.biz',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactivate_cc'
--

CREATE TABLE interactivate_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate_cc'
--


INSERT INTO interactivate_cc VALUES (1,'interactivate.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_cc VALUES (2,'interactivate.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123235);
INSERT INTO interactivate_cc VALUES (3,'interactivate.cc',28800,'NS','icg.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (4,'interactivate.cc',28800,'NS','ns2.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (5,'interactivate.cc',28800,'NS','ns3.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (6,'interactivate.cc',28800,'MX','10 maila.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (7,'interactivate.cc',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (8,'interactivate.cc',28800,'MX','100 oasis.netoasis.net.',20030504123235);
INSERT INTO interactivate_cc VALUES (9,'admin.interactivate.cc',28800,'A','65.212.133.164',20030504123235);
INSERT INTO interactivate_cc VALUES (10,'avo-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (11,'bart.interactivate.cc',28800,'A','209.242.137.182',20030504123235);
INSERT INTO interactivate_cc VALUES (12,'benoit.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (13,'bil-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (14,'bil-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (15,'bofh.interactivate.cc',28800,'A','65.212.133.171',20030504123235);
INSERT INTO interactivate_cc VALUES (16,'bsmart.interactivate.cc',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_cc VALUES (17,'bug.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (18,'bugs.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (19,'cam-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (20,'cam-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (21,'cap-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (22,'cap-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (23,'caph-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (24,'caph-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (25,'cdr.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (26,'cdr-pro.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (27,'client-services.interactivate.cc',28800,'A','65.212.133.165',20030504123235);
INSERT INTO interactivate_cc VALUES (28,'cmc-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (29,'cmc-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (30,'cmc-live.interactivate.cc',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactivate_cc VALUES (31,'cmc-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (32,'con-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (33,'con-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (34,'conf.interactivate.cc',28800,'A','65.212.133.175',20030504123235);
INSERT INTO interactivate_cc VALUES (35,'creative.interactivate.cc',28800,'A','65.212.133.188',20030504123235);
INSERT INTO interactivate_cc VALUES (36,'dav-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (37,'dav-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (38,'dead-pool.interactivate.cc',28800,'A','65.212.133.176',20030504123235);
INSERT INTO interactivate_cc VALUES (39,'demo.interactivate.cc',28800,'CNAME','creative.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (40,'dev.interactivate.cc',28800,'A','65.212.133.190',20030504123235);
INSERT INTO interactivate_cc VALUES (41,'dev1.interactivate.cc',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactivate_cc VALUES (42,'dmi.interactivate.cc',28800,'A','65.212.133.166',20030504123235);
INSERT INTO interactivate_cc VALUES (43,'dns.interactivate.cc',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactivate_cc VALUES (44,'dubois-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (45,'dubois-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (46,'eartha.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (47,'esc-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (48,'esc-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (49,'eur-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (50,'eur-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (51,'euro-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (52,'euro-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (53,'ews-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (54,'ews-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (55,'ferret.interactivate.cc',28800,'A','65.212.133.183',20030504123235);
INSERT INTO interactivate_cc VALUES (56,'finance.interactivate.cc',28800,'A','65.212.133.180',20030504123235);
INSERT INTO interactivate_cc VALUES (57,'firewall.interactivate.cc',28800,'CNAME','heimdall.interactivate.cc.',20030504123235);
INSERT INTO interactivate_cc VALUES (58,'flo-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (59,'flo-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (60,'flo-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (61,'ftp.interactivate.cc',28800,'A','65.212.133.187',20030504123235);
INSERT INTO interactivate_cc VALUES (62,'fwl-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (63,'fwl-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (64,'gas-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (65,'gas-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (66,'gcc-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (67,'gcc-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (68,'gw.interactivate.cc',28800,'A','68.15.28.85',20030504123235);
INSERT INTO interactivate_cc VALUES (69,'gw2.interactivate.cc',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactivate_cc VALUES (70,'handler-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (71,'heimdall.interactivate.cc',28800,'A','65.212.133.162',20030504123235);
INSERT INTO interactivate_cc VALUES (72,'hom-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (73,'hom-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (74,'hum-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (75,'hum-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (76,'iai-release.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (77,'icg.interactivate.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_cc VALUES (78,'iid-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (79,'iid-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (80,'imap.interactivate.cc',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_cc VALUES (81,'irv-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (82,'isc-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (83,'isc-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (84,'john.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (85,'josh.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (86,'katz-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (87,'kau-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (88,'kau-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (89,'lad-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (90,'lad-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (91,'ladera.interactivate.cc',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactivate_cc VALUES (92,'lappie.interactivate.cc',28800,'A','65.212.133.174',20030504123235);
INSERT INTO interactivate_cc VALUES (93,'localhost.interactivate.cc',28800,'A','127.0.0.1',20030504123235);
INSERT INTO interactivate_cc VALUES (94,'loghost.interactivate.cc',28800,'CNAME','www.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (95,'luz-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (96,'luz-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (97,'lyo-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (98,'lyo-dux-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (99,'lyo-dux-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (100,'lyo-golf-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (101,'lyo-golf-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (102,'lyo-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (103,'lyon-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (104,'lyon-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (105,'lyonnt-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (106,'lyonpr-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (107,'mag-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (108,'mag-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (109,'magee-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (110,'magee-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (111,'mail.interactivate.cc',28800,'A','65.212.133.168',20030504123235);
INSERT INTO interactivate_cc VALUES (112,'mail2.interactivate.cc',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_cc VALUES (113,'maila.interactivate.cc',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_cc VALUES (114,'mailia.interactivate.cc',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactivate_cc VALUES (115,'market.interactivate.cc',28800,'A','65.212.133.163',20030504123235);
INSERT INTO interactivate_cc VALUES (116,'monitor.interactivate.cc',28800,'CNAME','slacker.interactivate.cc.',20030504123235);
INSERT INTO interactivate_cc VALUES (117,'mysql.interactivate.cc',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactivate_cc VALUES (118,'nas-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (119,'nas-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (120,'ns.interactivate.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_cc VALUES (121,'ns1.interactivate.cc',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_cc VALUES (122,'ns2.interactivate.cc',28800,'A','65.212.133.182',20030504123235);
INSERT INTO interactivate_cc VALUES (123,'ns3.interactivate.cc',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_cc VALUES (124,'nt-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (125,'orwell.interactivate.cc',28800,'A','65.212.133.167',20030504123235);
INSERT INTO interactivate_cc VALUES (126,'osb-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (127,'osb-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (128,'pad-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (129,'pad-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (130,'padres.interactivate.cc',28800,'A','207.110.41.208',20030504123235);
INSERT INTO interactivate_cc VALUES (131,'pfp-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (132,'pfy.interactivate.cc',28800,'A','65.212.133.172',20030504123235);
INSERT INTO interactivate_cc VALUES (133,'pgsql.interactivate.cc',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactivate_cc VALUES (134,'pin-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (135,'pin-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (136,'pine-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (137,'pine-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (138,'pinehills.interactivate.cc',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactivate_cc VALUES (139,'pop.interactivate.cc',28800,'A','65.212.133.173',20030504123235);
INSERT INTO interactivate_cc VALUES (140,'pro-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (141,'pro-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (142,'prov-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (143,'prov-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (144,'proven.interactivate.cc',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactivate_cc VALUES (145,'rai-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (146,'rai-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (147,'rai-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (148,'raisins.interactivate.cc',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactivate_cc VALUES (149,'rea-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (150,'rea-salad-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (151,'rea-salad-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (152,'rea-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (153,'read-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (154,'read-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (155,'recipe.interactivate.cc',28800,'A','65.212.133.186',20030504123235);
INSERT INTO interactivate_cc VALUES (156,'rjt-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (157,'rjt-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (158,'rmv-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (159,'rmv-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (160,'rod-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (161,'rod-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (162,'router.interactivate.cc',28800,'A','65.212.133.161',20030504123235);
INSERT INTO interactivate_cc VALUES (163,'rt.interactivate.cc',28800,'A','63.141.73.17',20030504123235);
INSERT INTO interactivate_cc VALUES (164,'rui-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (165,'rui-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (166,'rui2-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (167,'rui2-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (168,'sales.interactivate.cc',28800,'A','65.212.133.179',20030504123235);
INSERT INTO interactivate_cc VALUES (169,'scd-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (170,'scd-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (171,'scott.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (172,'sdaw.interactivate.cc',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactivate_cc VALUES (173,'sdc-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (174,'sdc-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (175,'sdy-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (176,'sdy-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (177,'sdyouth.interactivate.cc',28800,'A','216.51.113.26',20030504123235);
INSERT INTO interactivate_cc VALUES (178,'sea-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (179,'sea-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (180,'seac-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (181,'sgi-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (182,'sgi-dev2.interactivate.cc',28800,'A','192.168.1.99',20030504123235);
INSERT INTO interactivate_cc VALUES (183,'sgifs-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (184,'sil-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (185,'sil-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (186,'slacker.interactivate.cc',28800,'A','65.212.133.178',20030504123235);
INSERT INTO interactivate_cc VALUES (187,'smartix.interactivate.cc',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactivate_cc VALUES (188,'solanocisrs.interactivate.cc',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactivate_cc VALUES (189,'staff.interactivate.cc',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_cc VALUES (190,'staging.interactivate.cc',28800,'A','65.212.133.189',20030504123235);
INSERT INTO interactivate_cc VALUES (191,'sunkist.interactivate.cc',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactivate_cc VALUES (192,'sunkistfs.interactivate.cc',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_cc VALUES (193,'sus-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (194,'sus-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (195,'tal-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (196,'tal-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (197,'talega.interactivate.cc',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_cc VALUES (198,'tay-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (199,'tay-mluz-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (200,'tay-mluz-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (201,'tay-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (202,'team.interactivate.cc',28800,'A','65.212.133.169',20030504123235);
INSERT INTO interactivate_cc VALUES (203,'train-cisrs.interactivate.cc',28800,'A','65.212.133.181',20030504123235);
INSERT INTO interactivate_cc VALUES (204,'twc-dev.interactivate.cc',28800,'CNAME','dev1.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (205,'uller.interactivate.cc',28800,'A','65.212.133.177',20030504123235);
INSERT INTO interactivate_cc VALUES (206,'updates.interactivate.cc',28800,'MX','20 mail.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (207,'vpn.interactivate.cc',28800,'A','65.212.133.170',20030504123235);
INSERT INTO interactivate_cc VALUES (208,'webmail.interactivate.cc',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_cc VALUES (209,'wor-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (210,'wor-staging.interactivate.cc',28800,'A','216.51.113.21',20030504123235);
INSERT INTO interactivate_cc VALUES (211,'wreath-develop.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (212,'wreath-staging.interactivate.cc',28800,'CNAME','dev.interactivate.com.',20030504123235);
INSERT INTO interactivate_cc VALUES (213,'www.interactivate.cc',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactivate_com'
--

CREATE TABLE interactivate_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  OWNER varchar(50) default NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate_com'
--


INSERT INTO interactivate_com VALUES (5,'interactivate.com',28800,'NS','ns3.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (6,'interactivate.com',28800,'MX','10 maila.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (4,'interactivate.com',28800,'NS','ns2.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (3,'interactivate.com',28800,'NS','icg.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (2,'interactivate.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2007121512 14400 3600 604800 28800',20030814092424,NULL);
INSERT INTO interactivate_com VALUES (1,'interactivate.com',28800,'A','216.120.59.228',20030803195819,NULL);
INSERT INTO interactivate_com VALUES (364,'iai-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030528093548,'snorland');
INSERT INTO interactivate_com VALUES (10,'apollo.interactivate.com',28800,'A','216.51.113.19',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (11,'avo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (12,'bart.interactivate.com',28800,'A','209.242.137.182',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (13,'benoit.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (14,'bil-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (15,'bil-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (16,'bofh.interactivate.com',28800,'A','65.212.133.171',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (17,'bsmart.interactivate.com',28800,'A','216.120.59.228',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (18,'bug.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (19,'bugs.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (20,'cam-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (21,'cam-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (22,'cap-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (23,'cap-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (24,'caph-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (25,'caph-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (26,'cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (253,'eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030511011754,'eartha');
INSERT INTO interactivate_com VALUES (486,'sil-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030619144556,'snorland');
INSERT INTO interactivate_com VALUES (300,'lyon-tmalaher.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030520094159,'tmalaher');
INSERT INTO interactivate_com VALUES (30,'client-services.interactivate.com',28800,'A','65.212.133.165',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (31,'cmc.interactivate.com',28800,'A','216.120.59.228',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (32,'cmc-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (33,'cmc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (34,'cmc-live.interactivate.com',28800,'A','216.120.60.22',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (35,'cmc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (36,'con-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (37,'con-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (38,'conf.interactivate.com',28800,'A','65.212.133.175',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (39,'cpi-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (40,'creative.interactivate.com',28800,'A','65.212.133.190',20030508114841,NULL);
INSERT INTO interactivate_com VALUES (41,'dav-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (42,'dav-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (43,'dead-pool.interactivate.com',28800,'A','65.212.133.189',20030519090835,NULL);
INSERT INTO interactivate_com VALUES (44,'demo.interactivate.com',28800,'CNAME','creative.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (45,'dev.interactivate.com',28800,'A','65.212.133.190',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (46,'dev1.interactivate.com',28800,'A','65.212.133.186',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (47,'dmi.interactivate.com',28800,'A','65.212.133.166',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (48,'dns.interactivate.com',28800,'A','65.212.133.177',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (49,'dubois-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (50,'dubois-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (52,'eartha-pro.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030507103551,'eartha');
INSERT INTO interactivate_com VALUES (53,'ehaines-pro.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (54,'eoo-dev.interactivate.com',28800,'A','65.212.133.186',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (55,'esc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (56,'esc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (57,'eur-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (58,'eur-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (59,'euro-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (60,'euro-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (61,'ews-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (62,'ews-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (63,'ferret.interactivate.com',28800,'A','65.212.133.183',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (64,'finance.interactivate.com',28800,'A','65.212.133.180',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (65,'firewall.interactivate.com',28800,'CNAME','heimdall.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (66,'flo-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (67,'flo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (68,'flo-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (69,'ftp.interactivate.com',28800,'A','65.212.133.190',20030508114829,NULL);
INSERT INTO interactivate_com VALUES (70,'fwl-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (71,'fwl-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (72,'gas-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (73,'gas-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (74,'gcc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (75,'gcc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (76,'gw.interactivate.com',28800,'A','68.15.28.85',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (77,'gw2.interactivate.com',28800,'A','65.212.133.162',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (78,'handler-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (79,'heimdall.interactivate.com',28800,'A','65.212.133.162',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (80,'hercules.interactivate.com',28800,'A','216.51.113.21',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (81,'hom-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (82,'hom-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (83,'hum-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (84,'hum-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (85,'iai-release.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (86,'icg.interactivate.com',28800,'A','216.120.59.226',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (87,'iid-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (88,'iid-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (89,'imap.interactivate.com',28800,'A','65.212.133.173',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (90,'irv-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (91,'isc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (92,'isc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (326,'mag-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030523112738,'jettwein');
INSERT INTO interactivate_com VALUES (264,'john-sdy.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030515120616,'john');
INSERT INTO interactivate_com VALUES (428,'rea-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030609110942,'');
INSERT INTO interactivate_com VALUES (96,'katz-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (97,'kau-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (98,'kau-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (99,'lad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (100,'lad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (101,'ladera.interactivate.com',28800,'A','216.120.60.29',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (102,'lappie.interactivate.com',28800,'A','65.212.133.174',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (103,'loghost.interactivate.com',28800,'CNAME','www.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (104,'luz-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (105,'luz-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (106,'lyo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (107,'lyo-dux-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (108,'lyo-dux-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (109,'lyo-golf-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (110,'lyo-golf-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (111,'lyo-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (112,'lyon-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (113,'lyon-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (114,'lyonnt-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (115,'lyonpr-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (116,'mag-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (117,'mag-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (118,'magee-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (119,'magee-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (120,'mail.interactivate.com',28800,'A','65.212.133.182',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (121,'mail2.interactivate.com',28800,'A','65.212.133.173',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (122,'maila.interactivate.com',28800,'A','65.212.133.173',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (123,'mailia.interactivate.com',28800,'A','65.212.133.182',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (124,'market.interactivate.com',28800,'A','65.212.133.163',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (125,'monitor.interactivate.com',28800,'CNAME','slacker.interactivate.com.',20030504123235,NULL);
INSERT INTO interactivate_com VALUES (126,'mysql.interactivate.com',28800,'A','216.120.59.254',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (127,'nas-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (128,'nas-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (129,'ns.interactivate.com',28800,'A','216.120.59.226',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (130,'ns1.interactivate.com',28800,'A','216.120.59.226',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (131,'ns2.interactivate.com',28800,'A','65.212.133.182',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (132,'ns3.interactivate.com',28800,'A','65.212.133.173',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (133,'nt-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (134,'orwell.interactivate.com',28800,'A','65.212.133.167',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (135,'osb-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (136,'osb-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (137,'pad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (138,'pad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (139,'padres.interactivate.com',28800,'A','207.110.41.208',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (140,'pegasus.interactivate.com',28800,'A','216.51.113.22',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (141,'pfp-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (142,'pfy.interactivate.com',28800,'A','65.212.133.172',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (143,'pgsql.interactivate.com',28800,'A','216.120.59.253',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (144,'pin-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (145,'pin-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (146,'pine-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (147,'pine-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (148,'pinehills.interactivate.com',28800,'A','216.120.60.9',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (149,'pop.interactivate.com',28800,'A','65.212.133.173',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (150,'pro-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (151,'pro-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (152,'prov-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (153,'prov-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (154,'proven.interactivate.com',28800,'A','216.120.60.14',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (155,'rai-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (156,'rai-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (157,'rai-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (158,'raisins.interactivate.com',28800,'A','216.120.59.230',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (159,'rea-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (160,'rea-salad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (161,'rea-salad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (162,'rea-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (163,'read-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (164,'read-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (165,'recipe.interactivate.com',28800,'A','65.212.133.186',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (166,'rjt-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (167,'rjt-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (168,'rmv-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (169,'rmv-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (170,'rod-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (171,'rod-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (172,'router.interactivate.com',28800,'A','65.212.133.161',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (173,'rt.interactivate.com',28800,'A','63.141.73.17',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (174,'rui-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (175,'rui-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (176,'rui2-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (177,'rui2-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (178,'sales.interactivate.com',28800,'A','65.212.133.179',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (179,'scd-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (180,'scd-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (181,'scott.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (182,'sdaw.interactivate.com',28800,'A','216.51.113.21',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (183,'sdc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (184,'sdc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (504,'tal-tmalaher.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030626191837,'tmalaher');
INSERT INTO interactivate_com VALUES (186,'sdy-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (187,'sdyouth.interactivate.com',28800,'A','216.51.113.26',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (188,'sea-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (189,'sea-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (190,'seac-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (191,'sgi-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (192,'sgifs-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (193,'sil-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (194,'sil-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (195,'slacker.interactivate.com',28800,'A','65.212.133.178',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (196,'smartix.interactivate.com',28800,'A','216.120.60.28',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (197,'solanocisrs.interactivate.com',28800,'A','65.212.133.181',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (198,'staff.interactivate.com',28800,'A','216.120.59.242',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (199,'staging.interactivate.com',28800,'A','65.212.133.190',20030508114724,NULL);
INSERT INTO interactivate_com VALUES (200,'sunkist.interactivate.com',28800,'A','216.120.59.235',20030806191351,NULL);
INSERT INTO interactivate_com VALUES (201,'sunkist-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (202,'sunkistfs.interactivate.com',28800,'A','216.120.59.228',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (203,'sus-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (204,'sus-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (205,'tal-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (206,'tal-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (207,'talega.interactivate.com',28800,'A','216.120.59.228',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (208,'tay-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (209,'tay-mluz-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (210,'tay-mluz-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (211,'tay-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (212,'team.interactivate.com',28800,'A','65.212.133.169',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (213,'train-cisrs.interactivate.com',28800,'A','65.212.133.181',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (214,'twc-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (215,'uller.interactivate.com',28800,'A','65.212.133.177',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (216,'updates.interactivate.com',28800,'MX','20 mail.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (217,'venus.interactivate.com',28800,'A','216.51.113.20',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (218,'vpn.interactivate.com',28800,'A','65.212.133.170',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (219,'webmail.interactivate.com',28800,'A','216.120.59.242',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (220,'wor-cisrs.interactivate.com',28800,'A','216.51.113.23',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (221,'wor-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (222,'wor-staging.interactivate.com',28800,'A','216.51.113.21',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (223,'wreath-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (224,'wreath-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504123236,NULL);
INSERT INTO interactivate_com VALUES (225,'www.interactivate.com',28800,'A','216.120.59.228',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (226,'smtp.interactivate.com',28800,'A','65.212.133.173',20030504214452,NULL);
INSERT INTO interactivate_com VALUES (246,'cdr-lyo.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030508183012,'cdr');
INSERT INTO interactivate_com VALUES (256,'admin.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030512221717,'dev');
INSERT INTO interactivate_com VALUES (281,'staff-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030517202526,'cdr');
INSERT INTO interactivate_com VALUES (324,'casemgmt.interactivate.com',28800,'A','216.51.113.23',20030523100448,NULL);
INSERT INTO interactivate_com VALUES (265,'jettwein-changeage.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030515121813,'jettwein');
INSERT INTO interactivate_com VALUES (268,'sdy-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030515123152,'john');
INSERT INTO interactivate_com VALUES (269,'pro-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030515123201,'john');
INSERT INTO interactivate_com VALUES (439,'nova-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030610133044,'jettwein');
INSERT INTO interactivate_com VALUES (271,'seab-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030515210016,'dev');
INSERT INTO interactivate_com VALUES (275,'john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030516090011,'john');
INSERT INTO interactivate_com VALUES (289,'snorland-pro.interactivate.com.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030519135356,'snorland');
INSERT INTO interactivate_com VALUES (354,'mag-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030527152317,'eartha');
INSERT INTO interactivate_com VALUES (353,'tal-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030527152054,'john');
INSERT INTO interactivate_com VALUES (283,'eartha-esc.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030519104924,'eartha');
INSERT INTO interactivate_com VALUES (505,'mag-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030627155953,'john');
INSERT INTO interactivate_com VALUES (286,'sil-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030519121951,'jettwein');
INSERT INTO interactivate_com VALUES (287,'creative2.interactivate.com',28800,'A','65.212.133.173',20030519123941,NULL);
INSERT INTO interactivate_com VALUES (304,'brokers.interactivate.com',28800,'A','216.120.60.3',20030621132157,NULL);
INSERT INTO interactivate_com VALUES (307,'rmv.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030521101207,'dev');
INSERT INTO interactivate_com VALUES (506,'lyo-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030627161032,'snorland');
INSERT INTO interactivate_com VALUES (507,'pnet-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030630082422,'john');
INSERT INTO interactivate_com VALUES (508,'eur-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030630143456,'john');
INSERT INTO interactivate_com VALUES (385,'lad-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030602101109,'eartha');
INSERT INTO interactivate_com VALUES (371,'lyo-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030528172154,'john');
INSERT INTO interactivate_com VALUES (316,'sun2003-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030521175249,NULL);
INSERT INTO interactivate_com VALUES (317,'johnhome.interactivate.com',28800,'A','68.101.225.246',20030522130138,NULL);
INSERT INTO interactivate_com VALUES (288,'rmv-develop2.interactivate.com',28800,'A','65.212.133.173',20030519124340,NULL);
INSERT INTO interactivate_com VALUES (303,'eoo-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030520110918,'jettwein');
INSERT INTO interactivate_com VALUES (313,'mag-derek.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030521122249,'dstanley');
INSERT INTO interactivate_com VALUES (315,'derek.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030521123826,'dstanley');
INSERT INTO interactivate_com VALUES (323,'sil-dstanley.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030523083002,'dstanley');
INSERT INTO interactivate_com VALUES (380,'cap-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030529221624,'cdr');
INSERT INTO interactivate_com VALUES (544,'teh-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030730154607,'eartha');
INSERT INTO interactivate_com VALUES (542,'grove-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030730101134,'jettwein');
INSERT INTO interactivate_com VALUES (340,'jabber.interactivate.com',28800,'A','65.212.133.173',20030526140427,NULL);
INSERT INTO interactivate_com VALUES (341,'jud.interactivate.com',28800,'A','65.212.133.173',20030526144037,NULL);
INSERT INTO interactivate_com VALUES (342,'conference.interactivate.com',28800,'A','65.212.133.173',20030526144133,NULL);
INSERT INTO interactivate_com VALUES (343,'aim.interactivate.com',28800,'A','65.212.133.173',20030526204730,NULL);
INSERT INTO interactivate_com VALUES (344,'yahoo.interactivate.com',28800,'A','65.212.133.173',20030526204744,NULL);
INSERT INTO interactivate_com VALUES (345,'msn.interactivate.com',28800,'A','65.212.133.173',20030526220508,NULL);
INSERT INTO interactivate_com VALUES (346,'conference.msn.interactivate.com',28800,'A','65.212.133.173',20030526220530,NULL);
INSERT INTO interactivate_com VALUES (347,'icq.interactivate.com',28800,'A','65.212.133.173',20030526221727,NULL);
INSERT INTO interactivate_com VALUES (348,'ldap.interactivate.com',28800,'A','65.212.133.173',20030527093212,NULL);
INSERT INTO interactivate_com VALUES (356,'pin-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030527153806,'john');
INSERT INTO interactivate_com VALUES (350,'iid-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030527145316,'eartha');
INSERT INTO interactivate_com VALUES (543,'rmv-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030730150152,'snorland');
INSERT INTO interactivate_com VALUES (540,'webapps.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030729152819,'cdr');
INSERT INTO interactivate_com VALUES (538,'gopher.interactivate.com',28800,'A','65.212.133.177',20030725153753,NULL);
INSERT INTO interactivate_com VALUES (537,'codelib-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030724112936,'jettwein');
INSERT INTO interactivate_com VALUES (363,'pin-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030527165924,'jettwein');
INSERT INTO interactivate_com VALUES (536,'codelib.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030724112854,'dev');
INSERT INTO interactivate_com VALUES (445,'sea-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030612122431,'snorland');
INSERT INTO interactivate_com VALUES (365,'pin-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030528095447,'cdr');
INSERT INTO interactivate_com VALUES (366,'pla-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030528101352,NULL);
INSERT INTO interactivate_com VALUES (367,'rea-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030528135338,'john');
INSERT INTO interactivate_com VALUES (368,'rmv-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030528144131,'john');
INSERT INTO interactivate_com VALUES (535,'sil-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030724090507,'eartha');
INSERT INTO interactivate_com VALUES (534,'mon-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030723101257,'john');
INSERT INTO interactivate_com VALUES (533,'nova.interactivate.com',28800,'A','65.212.133.182',20030722115530,NULL);
INSERT INTO interactivate_com VALUES (478,'lad-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617105327,'jettwein');
INSERT INTO interactivate_com VALUES (374,'esc-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030529130624,'eartha');
INSERT INTO interactivate_com VALUES (454,'rea-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030612154531,'snorland');
INSERT INTO interactivate_com VALUES (485,'sil-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030619144528,'john');
INSERT INTO interactivate_com VALUES (532,'mon-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030722105258,'dev');
INSERT INTO interactivate_com VALUES (539,'cdrmail.interactivate.com',28800,'A','65.212.133.183',20030727000250,NULL);
INSERT INTO interactivate_com VALUES (531,'mon-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030722105228,'dev');
INSERT INTO interactivate_com VALUES (457,'cap-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030613101518,'eartha');
INSERT INTO interactivate_com VALUES (441,'lyo-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030611141017,'eartha');
INSERT INTO interactivate_com VALUES (498,'lad-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030624184959,'snorland');
INSERT INTO interactivate_com VALUES (527,'gary.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030719154401,'cdr');
INSERT INTO interactivate_com VALUES (528,'hamster.interactivate.com',28800,'A','216.120.59.227',20030803175911,NULL);
INSERT INTO interactivate_com VALUES (392,'sdy-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030603094025,'dev');
INSERT INTO interactivate_com VALUES (393,'eur-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030603100455,'eartha');
INSERT INTO interactivate_com VALUES (530,'clo-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030721164040,'jettwein');
INSERT INTO interactivate_com VALUES (529,'interactivate.com',28800,'MX','20 hamster.interactivate.com.',20030720040658,NULL);
INSERT INTO interactivate_com VALUES (520,'hom-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030714175059,'john');
INSERT INTO interactivate_com VALUES (411,'iai-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030604123514,'eartha');
INSERT INTO interactivate_com VALUES (524,'fwl-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030717155931,'cdr');
INSERT INTO interactivate_com VALUES (409,'wreath-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030604094215,'eartha');
INSERT INTO interactivate_com VALUES (522,'seab-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030715095515,'snorland');
INSERT INTO interactivate_com VALUES (414,'sdy-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030604143328,'jettwein');
INSERT INTO interactivate_com VALUES (521,'seab-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030715094035,'john');
INSERT INTO interactivate_com VALUES (518,'tal-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030714143645,'snorland');
INSERT INTO interactivate_com VALUES (519,'updates.tehama-realty.com',28800,'MX','10 mail.interactivate.com.',20030714164014,NULL);
INSERT INTO interactivate_com VALUES (449,'rmv-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030612144354,'eartha');
INSERT INTO interactivate_com VALUES (446,'age-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030612134830,'dev');
INSERT INTO interactivate_com VALUES (444,'changeage.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030612121636,'dev');
INSERT INTO interactivate_com VALUES (425,'playavista.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030605154618,'cdr');
INSERT INTO interactivate_com VALUES (517,'luz-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030711172330,'eartha');
INSERT INTO interactivate_com VALUES (526,'mag-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030719152806,'cdr');
INSERT INTO interactivate_com VALUES (436,'pro-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030610110313,'eartha');
INSERT INTO interactivate_com VALUES (435,'tal-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030609154842,'eartha');
INSERT INTO interactivate_com VALUES (516,'kau-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030710115831,'john');
INSERT INTO interactivate_com VALUES (459,'rea-salad-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030613102003,'snorland');
INSERT INTO interactivate_com VALUES (460,'sus-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030613103418,'snorland');
INSERT INTO interactivate_com VALUES (515,'sea-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030709121656,'eartha');
INSERT INTO interactivate_com VALUES (463,'bugzilla.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030613114053,'dev');
INSERT INTO interactivate_com VALUES (464,'cap-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030613154959,'john');
INSERT INTO interactivate_com VALUES (465,'pin-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030616113000,'snorland');
INSERT INTO interactivate_com VALUES (466,'canny.interactivate.com.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030616135702,'john');
INSERT INTO interactivate_com VALUES (467,'canny.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030616165446,'john');
INSERT INTO interactivate_com VALUES (468,'luz-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030616170804,'snorland');
INSERT INTO interactivate_com VALUES (469,'lad-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617085935,'john');
INSERT INTO interactivate_com VALUES (470,'ONG-DEVELOP.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617092215,'dev');
INSERT INTO interactivate_com VALUES (471,'ONG-STAGING.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617092242,'dev');
INSERT INTO interactivate_com VALUES (472,'ong-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617092319,'dev');
INSERT INTO interactivate_com VALUES (473,'ong-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617092346,'dev');
INSERT INTO interactivate_com VALUES (514,'coloringbook-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030708110716,'jettwein');
INSERT INTO interactivate_com VALUES (513,'pin-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030707150813,'eartha');
INSERT INTO interactivate_com VALUES (476,'ong-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617094236,'john');
INSERT INTO interactivate_com VALUES (477,'ong-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617100142,'eartha');
INSERT INTO interactivate_com VALUES (480,'pro-snorland.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030617142027,'snorland');
INSERT INTO interactivate_com VALUES (481,'nova-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030618120047,'cdr');
INSERT INTO interactivate_com VALUES (512,'teh-john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030701174313,'john');
INSERT INTO interactivate_com VALUES (483,'tal-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030618163439,'jettwein');
INSERT INTO interactivate_com VALUES (484,'beaver.interactivate.com',28800,'A','65.212.133.185',20030618191421,NULL);
INSERT INTO interactivate_com VALUES (511,'remoting-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030701142253,'jettwein');
INSERT INTO interactivate_com VALUES (489,'qa.interactivate.com',28800,'MX','10 mail.interactivate.com.',20030620000145,NULL);
INSERT INTO interactivate_com VALUES (494,'gateway-jettwein.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030620092238,'jettwein');
INSERT INTO interactivate_com VALUES (495,'pro-tmalaher.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030620143522,'tmalaher');
INSERT INTO interactivate_com VALUES (510,'teh-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030701122156,'dev');
INSERT INTO interactivate_com VALUES (497,'pro-cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030622211012,'cdr');
INSERT INTO interactivate_com VALUES (499,'pnet-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030625124211,'dev');
INSERT INTO interactivate_com VALUES (500,'pnet-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030625124255,'john');
INSERT INTO interactivate_com VALUES (509,'teh-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030701122129,'dev');
INSERT INTO interactivate_com VALUES (503,'rea-salad-eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030625173049,'eartha');
INSERT INTO interactivate_com VALUES (7,'interactivate.com',28800,'MX','50 mail.interactivate.com.',20030720040729,NULL);
INSERT INTO interactivate_com VALUES (523,'irv-tmalaher.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030717132908,'tmalaher');
INSERT INTO interactivate_com VALUES (546,'www2.interactivate.com',28800,'A','216.120.59.227',20030803190133,NULL);
INSERT INTO interactivate_com VALUES (547,'sunkist2.interactivate.com',28800,'A','216.120.60.18',20030803194213,NULL);
INSERT INTO interactivate_com VALUES (548,'onlineprequal.interactivate.com',28800,'A','216.120.59.227',20030803201913,NULL);
INSERT INTO interactivate_com VALUES (549,'pimp.interactivate.com',28800,'A','65.212.133.183',20030811215609,NULL);
INSERT INTO interactivate_com VALUES (550,'prequaltest.interactivate.com',28800,'A','65.212.133.177',20030814092424,NULL);

--
-- Table structure for table 'interactivate_info'
--

CREATE TABLE interactivate_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate_info'
--


INSERT INTO interactivate_info VALUES (1,'interactivate.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_info VALUES (2,'interactivate.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123236);
INSERT INTO interactivate_info VALUES (3,'interactivate.info',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (4,'interactivate.info',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (5,'interactivate.info',28800,'NS','ns3.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (6,'interactivate.info',28800,'MX','10 maila.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (7,'interactivate.info',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (8,'interactivate.info',28800,'MX','100 oasis.netoasis.net.',20030504123236);
INSERT INTO interactivate_info VALUES (9,'admin.interactivate.info',28800,'A','65.212.133.164',20030504123236);
INSERT INTO interactivate_info VALUES (10,'avo-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (11,'bart.interactivate.info',28800,'A','209.242.137.182',20030504123236);
INSERT INTO interactivate_info VALUES (12,'benoit.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (13,'bil-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (14,'bil-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (15,'bofh.interactivate.info',28800,'A','65.212.133.171',20030504123236);
INSERT INTO interactivate_info VALUES (16,'bsmart.interactivate.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_info VALUES (17,'bug.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (18,'bugs.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (19,'cam-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (20,'cam-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (21,'cap-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (22,'cap-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (23,'caph-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (24,'caph-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (25,'cdr.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (26,'cdr-pro.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (27,'client-services.interactivate.info',28800,'A','65.212.133.165',20030504123236);
INSERT INTO interactivate_info VALUES (28,'cmc-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (29,'cmc-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (30,'cmc-live.interactivate.info',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactivate_info VALUES (31,'cmc-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (32,'con-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (33,'con-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (34,'conf.interactivate.info',28800,'A','65.212.133.175',20030504123236);
INSERT INTO interactivate_info VALUES (35,'creative.interactivate.info',28800,'A','65.212.133.188',20030504123236);
INSERT INTO interactivate_info VALUES (36,'dav-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (37,'dav-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (38,'dead-pool.interactivate.info',28800,'A','65.212.133.176',20030504123236);
INSERT INTO interactivate_info VALUES (39,'demo.interactivate.info',28800,'CNAME','creative.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (40,'dev.interactivate.info',28800,'A','65.212.133.190',20030504123236);
INSERT INTO interactivate_info VALUES (41,'dev1.interactivate.info',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate_info VALUES (42,'dmi.interactivate.info',28800,'A','65.212.133.166',20030504123236);
INSERT INTO interactivate_info VALUES (43,'dns.interactivate.info',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate_info VALUES (44,'dubois-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (45,'dubois-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (46,'eartha.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (47,'esc-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (48,'esc-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (49,'eur-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (50,'eur-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (51,'euro-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (52,'euro-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (53,'ews-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (54,'ews-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (55,'ferret.interactivate.info',28800,'A','65.212.133.183',20030504123236);
INSERT INTO interactivate_info VALUES (56,'finance.interactivate.info',28800,'A','65.212.133.180',20030504123236);
INSERT INTO interactivate_info VALUES (57,'firewall.interactivate.info',28800,'CNAME','heimdall.interactivate.info.',20030504123236);
INSERT INTO interactivate_info VALUES (58,'flo-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (59,'flo-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (60,'flo-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (61,'ftp.interactivate.info',28800,'A','65.212.133.187',20030504123236);
INSERT INTO interactivate_info VALUES (62,'fwl-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (63,'fwl-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (64,'gas-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (65,'gas-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (66,'gcc-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (67,'gcc-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (68,'gw.interactivate.info',28800,'A','68.15.28.85',20030504123236);
INSERT INTO interactivate_info VALUES (69,'gw2.interactivate.info',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate_info VALUES (70,'handler-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (71,'heimdall.interactivate.info',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate_info VALUES (72,'hom-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (73,'hom-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (74,'hum-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (75,'hum-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (76,'iai-release.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (77,'icg.interactivate.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_info VALUES (78,'iid-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (79,'iid-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (80,'imap.interactivate.info',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_info VALUES (81,'irv-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (82,'isc-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (83,'isc-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (84,'john.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (85,'josh.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (86,'katz-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (87,'kau-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (88,'kau-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (89,'lad-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (90,'lad-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (91,'ladera.interactivate.info',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactivate_info VALUES (92,'lappie.interactivate.info',28800,'A','65.212.133.174',20030504123236);
INSERT INTO interactivate_info VALUES (93,'localhost.interactivate.info',28800,'A','127.0.0.1',20030504123236);
INSERT INTO interactivate_info VALUES (94,'loghost.interactivate.info',28800,'CNAME','www.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (95,'luz-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (96,'luz-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (97,'lyo-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (98,'lyo-dux-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (99,'lyo-dux-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (100,'lyo-golf-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (101,'lyo-golf-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (102,'lyo-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (103,'lyon-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (104,'lyon-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (105,'lyonnt-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (106,'lyonpr-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (107,'mag-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (108,'mag-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (109,'magee-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (110,'magee-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (111,'mail.interactivate.info',28800,'A','65.212.133.168',20030504123236);
INSERT INTO interactivate_info VALUES (112,'mail2.interactivate.info',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_info VALUES (113,'maila.interactivate.info',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_info VALUES (114,'mailia.interactivate.info',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate_info VALUES (115,'market.interactivate.info',28800,'A','65.212.133.163',20030504123236);
INSERT INTO interactivate_info VALUES (116,'monitor.interactivate.info',28800,'CNAME','slacker.interactivate.info.',20030504123236);
INSERT INTO interactivate_info VALUES (117,'mysql.interactivate.info',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactivate_info VALUES (118,'nas-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (119,'nas-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (120,'ns.interactivate.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_info VALUES (121,'ns1.interactivate.info',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_info VALUES (122,'ns2.interactivate.info',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate_info VALUES (123,'ns3.interactivate.info',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_info VALUES (124,'nt-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (125,'orwell.interactivate.info',28800,'A','65.212.133.167',20030504123236);
INSERT INTO interactivate_info VALUES (126,'osb-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (127,'osb-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (128,'pad-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (129,'pad-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (130,'padres.interactivate.info',28800,'A','207.110.41.208',20030504123236);
INSERT INTO interactivate_info VALUES (131,'pfp-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (132,'pfy.interactivate.info',28800,'A','65.212.133.172',20030504123236);
INSERT INTO interactivate_info VALUES (133,'pgsql.interactivate.info',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactivate_info VALUES (134,'pin-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (135,'pin-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (136,'pine-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (137,'pine-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (138,'pinehills.interactivate.info',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactivate_info VALUES (139,'pop.interactivate.info',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_info VALUES (140,'pro-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (141,'pro-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (142,'prov-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (143,'prov-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (144,'proven.interactivate.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactivate_info VALUES (145,'rai-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (146,'rai-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (147,'rai-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (148,'raisins.interactivate.info',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactivate_info VALUES (149,'rea-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (150,'rea-salad-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (151,'rea-salad-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (152,'rea-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (153,'read-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (154,'read-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (155,'recipe.interactivate.info',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate_info VALUES (156,'rjt-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (157,'rjt-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (158,'rmv-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (159,'rmv-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (160,'rod-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (161,'rod-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (162,'router.interactivate.info',28800,'A','65.212.133.161',20030504123236);
INSERT INTO interactivate_info VALUES (163,'rt.interactivate.info',28800,'A','63.141.73.17',20030504123236);
INSERT INTO interactivate_info VALUES (164,'rui-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (165,'rui-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (166,'rui2-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (167,'rui2-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (168,'sales.interactivate.info',28800,'A','65.212.133.179',20030504123236);
INSERT INTO interactivate_info VALUES (169,'scd-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (170,'scd-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (171,'scott.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (172,'sdaw.interactivate.info',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactivate_info VALUES (173,'sdc-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (174,'sdc-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (175,'sdy-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (176,'sdy-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (177,'sdyouth.interactivate.info',28800,'A','216.51.113.26',20030504123236);
INSERT INTO interactivate_info VALUES (178,'sea-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (179,'sea-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (180,'seac-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (181,'sgi-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (182,'sgi-dev2.interactivate.info',28800,'A','192.168.1.99',20030504123236);
INSERT INTO interactivate_info VALUES (183,'sgifs-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (184,'sil-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (185,'sil-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (186,'slacker.interactivate.info',28800,'A','65.212.133.178',20030504123236);
INSERT INTO interactivate_info VALUES (187,'smartix.interactivate.info',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactivate_info VALUES (188,'solanocisrs.interactivate.info',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate_info VALUES (189,'staff.interactivate.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_info VALUES (190,'staging.interactivate.info',28800,'A','65.212.133.189',20030504123236);
INSERT INTO interactivate_info VALUES (191,'sunkist.interactivate.info',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactivate_info VALUES (192,'sunkistfs.interactivate.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_info VALUES (193,'sus-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (194,'sus-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (195,'tal-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (196,'tal-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (197,'talega.interactivate.info',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_info VALUES (198,'tay-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (199,'tay-mluz-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (200,'tay-mluz-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (201,'tay-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (202,'team.interactivate.info',28800,'A','65.212.133.169',20030504123236);
INSERT INTO interactivate_info VALUES (203,'train-cisrs.interactivate.info',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate_info VALUES (204,'twc-dev.interactivate.info',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (205,'uller.interactivate.info',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate_info VALUES (206,'updates.interactivate.info',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (207,'vpn.interactivate.info',28800,'A','65.212.133.170',20030504123236);
INSERT INTO interactivate_info VALUES (208,'webmail.interactivate.info',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_info VALUES (209,'wor-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (210,'wor-staging.interactivate.info',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactivate_info VALUES (211,'wreath-develop.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (212,'wreath-staging.interactivate.info',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_info VALUES (213,'www.interactivate.info',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactivate_org'
--

CREATE TABLE interactivate_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactivate_org'
--


INSERT INTO interactivate_org VALUES (1,'interactivate.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_org VALUES (2,'interactivate.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121090 14400 3600 604800 28800',20030504123236);
INSERT INTO interactivate_org VALUES (3,'interactivate.org',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (4,'interactivate.org',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (5,'interactivate.org',28800,'NS','ns3.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (6,'interactivate.org',28800,'MX','10 maila.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (7,'interactivate.org',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (8,'interactivate.org',28800,'MX','100 oasis.netoasis.net.',20030504123236);
INSERT INTO interactivate_org VALUES (9,'admin.interactivate.org',28800,'A','65.212.133.164',20030504123236);
INSERT INTO interactivate_org VALUES (10,'avo-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (11,'bart.interactivate.org',28800,'A','209.242.137.182',20030504123236);
INSERT INTO interactivate_org VALUES (12,'benoit.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (13,'bil-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (14,'bil-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (15,'bofh.interactivate.org',28800,'A','65.212.133.171',20030504123236);
INSERT INTO interactivate_org VALUES (16,'bsmart.interactivate.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_org VALUES (17,'bug.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (18,'bugs.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (19,'cam-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (20,'cam-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (21,'cap-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (22,'cap-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (23,'caph-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (24,'caph-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (25,'cdr.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (26,'cdr-pro.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (27,'client-services.interactivate.org',28800,'A','65.212.133.165',20030504123236);
INSERT INTO interactivate_org VALUES (28,'cmc-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (29,'cmc-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (30,'cmc-live.interactivate.org',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactivate_org VALUES (31,'cmc-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (32,'con-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (33,'con-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (34,'conf.interactivate.org',28800,'A','65.212.133.175',20030504123236);
INSERT INTO interactivate_org VALUES (35,'creative.interactivate.org',28800,'A','65.212.133.188',20030504123236);
INSERT INTO interactivate_org VALUES (36,'dav-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (37,'dav-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (38,'dead-pool.interactivate.org',28800,'A','65.212.133.176',20030504123236);
INSERT INTO interactivate_org VALUES (39,'demo.interactivate.org',28800,'CNAME','creative.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (40,'dev.interactivate.org',28800,'A','65.212.133.190',20030504123236);
INSERT INTO interactivate_org VALUES (41,'dev1.interactivate.org',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate_org VALUES (42,'dmi.interactivate.org',28800,'A','65.212.133.166',20030504123236);
INSERT INTO interactivate_org VALUES (43,'dns.interactivate.org',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate_org VALUES (44,'dubois-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (45,'dubois-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (46,'eartha.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (47,'esc-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (48,'esc-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (49,'eur-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (50,'eur-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (51,'euro-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (52,'euro-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (53,'ews-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (54,'ews-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (55,'ferret.interactivate.org',28800,'A','65.212.133.183',20030504123236);
INSERT INTO interactivate_org VALUES (56,'finance.interactivate.org',28800,'A','65.212.133.180',20030504123236);
INSERT INTO interactivate_org VALUES (57,'firewall.interactivate.org',28800,'CNAME','heimdall.interactivate.org.',20030504123236);
INSERT INTO interactivate_org VALUES (58,'flo-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (59,'flo-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (60,'flo-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (61,'ftp.interactivate.org',28800,'A','65.212.133.187',20030504123236);
INSERT INTO interactivate_org VALUES (62,'fwl-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (63,'fwl-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (64,'gas-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (65,'gas-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (66,'gcc-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (67,'gcc-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (68,'gw.interactivate.org',28800,'A','68.15.28.85',20030504123236);
INSERT INTO interactivate_org VALUES (69,'gw2.interactivate.org',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate_org VALUES (70,'handler-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (71,'heimdall.interactivate.org',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactivate_org VALUES (72,'hom-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (73,'hom-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (74,'hum-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (75,'hum-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (76,'iai-release.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (77,'icg.interactivate.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_org VALUES (78,'iid-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (79,'iid-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (80,'imap.interactivate.org',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_org VALUES (81,'irv-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (82,'isc-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (83,'isc-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (84,'john.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (85,'josh.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (86,'katz-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (87,'kau-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (88,'kau-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (89,'lad-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (90,'lad-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (91,'ladera.interactivate.org',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactivate_org VALUES (92,'lappie.interactivate.org',28800,'A','65.212.133.174',20030504123236);
INSERT INTO interactivate_org VALUES (93,'localhost.interactivate.org',28800,'A','127.0.0.1',20030504123236);
INSERT INTO interactivate_org VALUES (94,'loghost.interactivate.org',28800,'CNAME','www.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (95,'luz-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (96,'luz-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (97,'lyo-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (98,'lyo-dux-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (99,'lyo-dux-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (100,'lyo-golf-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (101,'lyo-golf-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (102,'lyo-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (103,'lyon-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (104,'lyon-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (105,'lyonnt-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (106,'lyonpr-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (107,'mag-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (108,'mag-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (109,'magee-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (110,'magee-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (111,'mail.interactivate.org',28800,'A','65.212.133.168',20030504123236);
INSERT INTO interactivate_org VALUES (112,'mail2.interactivate.org',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_org VALUES (113,'maila.interactivate.org',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_org VALUES (114,'mailia.interactivate.org',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate_org VALUES (115,'market.interactivate.org',28800,'A','65.212.133.163',20030504123236);
INSERT INTO interactivate_org VALUES (116,'monitor.interactivate.org',28800,'CNAME','slacker.interactivate.org.',20030504123236);
INSERT INTO interactivate_org VALUES (117,'mysql.interactivate.org',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactivate_org VALUES (118,'nas-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (119,'nas-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (120,'ns.interactivate.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_org VALUES (121,'ns1.interactivate.org',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactivate_org VALUES (122,'ns2.interactivate.org',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactivate_org VALUES (123,'ns3.interactivate.org',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_org VALUES (124,'nt-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (125,'orwell.interactivate.org',28800,'A','65.212.133.167',20030504123236);
INSERT INTO interactivate_org VALUES (126,'osb-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (127,'osb-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (128,'pad-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (129,'pad-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (130,'padres.interactivate.org',28800,'A','207.110.41.208',20030504123236);
INSERT INTO interactivate_org VALUES (131,'pfp-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (132,'pfy.interactivate.org',28800,'A','65.212.133.172',20030504123236);
INSERT INTO interactivate_org VALUES (133,'pgsql.interactivate.org',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactivate_org VALUES (134,'pin-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (135,'pin-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (136,'pine-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (137,'pine-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (138,'pinehills.interactivate.org',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactivate_org VALUES (139,'pop.interactivate.org',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactivate_org VALUES (140,'pro-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (141,'pro-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (142,'prov-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (143,'prov-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (144,'proven.interactivate.org',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactivate_org VALUES (145,'rai-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (146,'rai-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (147,'rai-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (148,'raisins.interactivate.org',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactivate_org VALUES (149,'rea-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (150,'rea-salad-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (151,'rea-salad-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (152,'rea-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (153,'read-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (154,'read-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (155,'recipe.interactivate.org',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactivate_org VALUES (156,'rjt-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (157,'rjt-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (158,'rmv-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (159,'rmv-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (160,'rod-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (161,'rod-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (162,'router.interactivate.org',28800,'A','65.212.133.161',20030504123236);
INSERT INTO interactivate_org VALUES (163,'rt.interactivate.org',28800,'A','63.141.73.17',20030504123236);
INSERT INTO interactivate_org VALUES (164,'rui-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (165,'rui-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (166,'rui2-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (167,'rui2-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (168,'sales.interactivate.org',28800,'A','65.212.133.179',20030504123236);
INSERT INTO interactivate_org VALUES (169,'scd-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (170,'scd-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (171,'scott.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (172,'sdaw.interactivate.org',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactivate_org VALUES (173,'sdc-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (174,'sdc-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (175,'sdy-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (176,'sdy-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (177,'sdyouth.interactivate.org',28800,'A','216.51.113.26',20030504123236);
INSERT INTO interactivate_org VALUES (178,'sea-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (179,'sea-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (180,'seac-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (181,'sgi-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (182,'sgi-dev2.interactivate.org',28800,'A','192.168.1.99',20030504123236);
INSERT INTO interactivate_org VALUES (183,'sgifs-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (184,'sil-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (185,'sil-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (186,'slacker.interactivate.org',28800,'A','65.212.133.178',20030504123236);
INSERT INTO interactivate_org VALUES (187,'smartix.interactivate.org',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactivate_org VALUES (188,'solanocisrs.interactivate.org',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate_org VALUES (189,'staff.interactivate.org',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_org VALUES (190,'staging.interactivate.org',28800,'A','65.212.133.189',20030504123236);
INSERT INTO interactivate_org VALUES (191,'sunkist.interactivate.org',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactivate_org VALUES (192,'sunkistfs.interactivate.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_org VALUES (193,'sus-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (194,'sus-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (195,'tal-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (196,'tal-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (197,'talega.interactivate.org',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactivate_org VALUES (198,'tay-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (199,'tay-mluz-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (200,'tay-mluz-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (201,'tay-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (202,'team.interactivate.org',28800,'A','65.212.133.169',20030504123236);
INSERT INTO interactivate_org VALUES (203,'train-cisrs.interactivate.org',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactivate_org VALUES (204,'twc-dev.interactivate.org',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (205,'uller.interactivate.org',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactivate_org VALUES (206,'updates.interactivate.org',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (207,'vpn.interactivate.org',28800,'A','65.212.133.170',20030504123236);
INSERT INTO interactivate_org VALUES (208,'webmail.interactivate.org',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactivate_org VALUES (209,'wor-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (210,'wor-staging.interactivate.org',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactivate_org VALUES (211,'wreath-develop.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (212,'wreath-staging.interactivate.org',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactivate_org VALUES (213,'www.interactivate.org',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'interactive8_net'
--

CREATE TABLE interactive8_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'interactive8_net'
--


INSERT INTO interactive8_net VALUES (1,'interactive8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactive8_net VALUES (2,'interactive8.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2007121085 14400 3600 604800 28800',20030504123236);
INSERT INTO interactive8_net VALUES (3,'interactive8.net',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (4,'interactive8.net',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (5,'interactive8.net',28800,'NS','ns3.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (6,'interactive8.net',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (7,'admin.interactive8.net',28800,'A','65.212.133.164',20030504123236);
INSERT INTO interactive8_net VALUES (8,'avo-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (9,'bart.interactive8.net',28800,'A','209.242.137.182',20030504123236);
INSERT INTO interactive8_net VALUES (10,'benoit.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (11,'bil-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (12,'bil-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (13,'bofh.interactive8.net',28800,'A','65.212.133.171',20030504123236);
INSERT INTO interactive8_net VALUES (14,'bsmart.interactive8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactive8_net VALUES (15,'bug.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (16,'bugs.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (17,'cam-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (18,'cam-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (19,'cap-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (20,'cap-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (21,'caph-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (22,'caph-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (23,'cdr.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (24,'cdr-pro.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (25,'client-services.interactive8.net',28800,'A','65.212.133.165',20030504123236);
INSERT INTO interactive8_net VALUES (26,'cmc-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (27,'cmc-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (28,'cmc-live.interactive8.net',28800,'A','216.120.60.22',20030621132157);
INSERT INTO interactive8_net VALUES (29,'cmc-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (30,'con-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (31,'con-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (32,'conf.interactive8.net',28800,'A','65.212.133.175',20030504123236);
INSERT INTO interactive8_net VALUES (33,'creative.interactive8.net',28800,'A','65.212.133.188',20030504123236);
INSERT INTO interactive8_net VALUES (34,'dav-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (35,'dav-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (36,'dead-pool.interactive8.net',28800,'A','65.212.133.176',20030504123236);
INSERT INTO interactive8_net VALUES (37,'demo.interactive8.net',28800,'CNAME','creative.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (38,'dev.interactive8.net',28800,'A','65.212.133.190',20030504123236);
INSERT INTO interactive8_net VALUES (39,'dev1.interactive8.net',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactive8_net VALUES (40,'dmi.interactive8.net',28800,'A','65.212.133.166',20030504123236);
INSERT INTO interactive8_net VALUES (41,'dns.interactive8.net',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactive8_net VALUES (42,'dubois-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (43,'dubois-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (44,'eartha.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (45,'esc-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (46,'esc-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (47,'eur-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (48,'eur-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (49,'euro-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (50,'euro-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (51,'ews-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (52,'ews-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (53,'ferret.interactive8.net',28800,'A','65.212.133.183',20030504123236);
INSERT INTO interactive8_net VALUES (54,'finance.interactive8.net',28800,'A','65.212.133.180',20030504123236);
INSERT INTO interactive8_net VALUES (55,'firewall.interactive8.net',28800,'CNAME','heimdall.interactive8.net.',20030504123236);
INSERT INTO interactive8_net VALUES (56,'flo-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (57,'flo-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (58,'flo-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (59,'ftp.interactive8.net',28800,'A','65.212.133.187',20030504123236);
INSERT INTO interactive8_net VALUES (60,'fwl-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (61,'fwl-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (62,'gas-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (63,'gas-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (64,'gcc-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (65,'gcc-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (66,'gw.interactive8.net',28800,'A','68.15.28.85',20030504123236);
INSERT INTO interactive8_net VALUES (67,'gw2.interactive8.net',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactive8_net VALUES (68,'handler-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (69,'heimdall.interactive8.net',28800,'A','65.212.133.162',20030504123236);
INSERT INTO interactive8_net VALUES (70,'hom-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (71,'hom-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (72,'hum-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (73,'hum-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (74,'iai-release.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (75,'icg.interactive8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactive8_net VALUES (76,'iid-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (77,'iid-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (78,'irv-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (79,'isc-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (80,'isc-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (81,'john.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (82,'josh.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (83,'katz-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (84,'kau-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (85,'kau-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (86,'lad-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (87,'lad-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (88,'ladera.interactive8.net',28800,'A','216.120.60.29',20030621132157);
INSERT INTO interactive8_net VALUES (89,'lappie.interactive8.net',28800,'A','65.212.133.174',20030504123236);
INSERT INTO interactive8_net VALUES (90,'localhost.interactive8.net',28800,'A','127.0.0.1',20030504123236);
INSERT INTO interactive8_net VALUES (91,'loghost.interactive8.net',28800,'CNAME','www.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (92,'luz-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (93,'luz-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (94,'lyo-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (95,'lyo-dux-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (96,'lyo-dux-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (97,'lyo-golf-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (98,'lyo-golf-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (99,'lyo-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (100,'lyon-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (101,'lyon-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (102,'lyonnt-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (103,'lyonpr-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (104,'mag-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (105,'mag-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (106,'magee-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (107,'magee-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (108,'mail.interactive8.net',28800,'A','65.212.133.168',20030504123236);
INSERT INTO interactive8_net VALUES (109,'mail2.interactive8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactive8_net VALUES (110,'maila.interactive8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactive8_net VALUES (111,'mailia.interactive8.net',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactive8_net VALUES (112,'market.interactive8.net',28800,'A','65.212.133.163',20030504123236);
INSERT INTO interactive8_net VALUES (113,'monitor.interactive8.net',28800,'CNAME','slacker.interactive8.net.',20030504123236);
INSERT INTO interactive8_net VALUES (114,'mysql.interactive8.net',28800,'A','216.120.59.254',20030621132157);
INSERT INTO interactive8_net VALUES (115,'nas-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (116,'nas-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (117,'ns.interactive8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactive8_net VALUES (118,'ns1.interactive8.net',28800,'A','216.120.59.226',20030621132157);
INSERT INTO interactive8_net VALUES (119,'ns2.interactive8.net',28800,'A','65.212.133.182',20030504123236);
INSERT INTO interactive8_net VALUES (120,'ns3.interactive8.net',28800,'A','65.212.133.173',20030504123236);
INSERT INTO interactive8_net VALUES (121,'nt-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (122,'orwell.interactive8.net',28800,'A','65.212.133.167',20030504123236);
INSERT INTO interactive8_net VALUES (123,'osb-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (124,'osb-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (125,'pad-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (126,'pad-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (127,'padres.interactive8.net',28800,'A','207.110.41.208',20030504123236);
INSERT INTO interactive8_net VALUES (128,'pfp-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (129,'pfy.interactive8.net',28800,'A','65.212.133.172',20030504123236);
INSERT INTO interactive8_net VALUES (130,'pgsql.interactive8.net',28800,'A','216.120.59.253',20030621132157);
INSERT INTO interactive8_net VALUES (131,'pin-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (132,'pin-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (133,'pine-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (134,'pine-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (135,'pinehills.interactive8.net',28800,'A','216.120.60.9',20030621132157);
INSERT INTO interactive8_net VALUES (136,'pro-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (137,'pro-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (138,'prov-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (139,'prov-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (140,'proven.interactive8.net',28800,'A','216.120.60.14',20030621132157);
INSERT INTO interactive8_net VALUES (141,'rai-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (142,'rai-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (143,'rai-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (144,'raisins.interactive8.net',28800,'A','216.120.59.230',20030621132157);
INSERT INTO interactive8_net VALUES (145,'rea-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (146,'rea-salad-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (147,'rea-salad-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (148,'rea-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (149,'read-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (150,'read-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (151,'recipe.interactive8.net',28800,'A','65.212.133.186',20030504123236);
INSERT INTO interactive8_net VALUES (152,'rjt-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (153,'rjt-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (154,'rmv-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (155,'rmv-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (156,'router.interactive8.net',28800,'A','65.212.133.161',20030504123236);
INSERT INTO interactive8_net VALUES (157,'rt.interactive8.net',28800,'A','63.141.73.17',20030504123236);
INSERT INTO interactive8_net VALUES (158,'rui-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (159,'rui-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (160,'rui2-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (161,'rui2-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (162,'sales.interactive8.net',28800,'A','65.212.133.179',20030504123236);
INSERT INTO interactive8_net VALUES (163,'scd-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (164,'scd-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (165,'scott.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (166,'sdaw.interactive8.net',28800,'A','216.51.113.21',20030504123236);
INSERT INTO interactive8_net VALUES (167,'sdc-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (168,'sdc-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (169,'sdy-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (170,'sdy-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (171,'sdyouth.interactive8.net',28800,'A','216.51.113.26',20030504123236);
INSERT INTO interactive8_net VALUES (172,'sea-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (173,'sea-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (174,'seac-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (175,'sgi-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (176,'sgi-dev2.interactive8.net',28800,'A','192.168.1.99',20030504123236);
INSERT INTO interactive8_net VALUES (177,'sgifs-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (178,'sil-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (179,'sil-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (180,'slacker.interactive8.net',28800,'A','65.212.133.178',20030504123236);
INSERT INTO interactive8_net VALUES (181,'smartix.interactive8.net',28800,'A','216.120.60.28',20030621132157);
INSERT INTO interactive8_net VALUES (182,'solanocisrs.interactive8.net',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactive8_net VALUES (183,'staff.interactive8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactive8_net VALUES (184,'staging.interactive8.net',28800,'A','65.212.133.189',20030504123236);
INSERT INTO interactive8_net VALUES (185,'sunkist.interactive8.net',28800,'A','216.120.60.18',20030621132157);
INSERT INTO interactive8_net VALUES (186,'sunkistfs.interactive8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactive8_net VALUES (187,'sus-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (188,'sus-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (189,'tal-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (190,'tal-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (191,'talega.interactive8.net',28800,'A','216.120.59.228',20030621132157);
INSERT INTO interactive8_net VALUES (192,'tay-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (193,'tay-mluz-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (194,'tay-mluz-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (195,'tay-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (196,'team.interactive8.net',28800,'A','65.212.133.169',20030504123236);
INSERT INTO interactive8_net VALUES (197,'train-cisrs.interactive8.net',28800,'A','65.212.133.181',20030504123236);
INSERT INTO interactive8_net VALUES (198,'twc-dev.interactive8.net',28800,'CNAME','dev1.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (199,'uller.interactive8.net',28800,'A','65.212.133.177',20030504123236);
INSERT INTO interactive8_net VALUES (200,'updates.interactive8.net',28800,'MX','20 mail.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (201,'updates.interactive8.net',28800,'MX','20 oasis.netoasis.net.',20030504123236);
INSERT INTO interactive8_net VALUES (202,'vpn.interactive8.net',28800,'A','65.212.133.170',20030504123236);
INSERT INTO interactive8_net VALUES (203,'webmail.interactive8.net',28800,'A','216.120.59.242',20030621132157);
INSERT INTO interactive8_net VALUES (204,'wor-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (205,'wor-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (206,'wreath-develop.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (207,'wreath-staging.interactive8.net',28800,'CNAME','dev.interactivate.com.',20030504123236);
INSERT INTO interactive8_net VALUES (208,'www.interactive8.net',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'internal_interactivate_com'
--

CREATE TABLE internal_interactivate_com (
  ID int(12) NOT NULL auto_increment,
  NAME text,
  TTL int(11) default NULL,
  RDTYPE text,
  RDATA text,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

--
-- Dumping data for table 'internal_interactivate_com'
--


INSERT INTO internal_interactivate_com VALUES (1,'interactivate.com',28800,'SOA','cooper.interactivate.com. dns.interactivate.com. 2003032201 14400 3600 604800 28800',20030504101459);
INSERT INTO internal_interactivate_com VALUES (2,'interactivate.com',28800,'NS','gpc.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (3,'interactivate.com',28800,'NS','ns3.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (4,'interactivate.com',28800,'NS','cooper.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (5,'interactivate.com',28800,'MX','10 maila.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (6,'interactivate.com',28800,'MX','20 mail.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (7,'interactivate.com',28800,'MX','100 oasis.netoasis.net.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (8,'interactivate.com',28800,'A','216.120.59.226',20030504101459);
INSERT INTO internal_interactivate_com VALUES (9,'admin.interactivate.com',28800,'A','65.212.133.164',20030504101459);
INSERT INTO internal_interactivate_com VALUES (10,'avo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (11,'bart.interactivate.com',28800,'A','209.242.137.182',20030504101459);
INSERT INTO internal_interactivate_com VALUES (12,'benoit.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (13,'bil-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (14,'bil-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (15,'bnak.interactivate.com',28800,'A','192.168.1.68',20030504101459);
INSERT INTO internal_interactivate_com VALUES (16,'bncntr.interactivate.com',28800,'A','192.168.1.15',20030504101459);
INSERT INTO internal_interactivate_com VALUES (17,'bnctr.interactivate.com',28800,'A','192.168.1.15',20030504101459);
INSERT INTO internal_interactivate_com VALUES (18,'bofh.interactivate.com',28800,'A','65.212.133.171',20030504101459);
INSERT INTO internal_interactivate_com VALUES (19,'bsmart.interactivate.com',28800,'A','216.120.59.228',20030504101459);
INSERT INTO internal_interactivate_com VALUES (20,'bug.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (21,'bugs.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (22,'cam-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (23,'cam-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (24,'cap-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (25,'cap-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (26,'caph-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (27,'caph-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (28,'cdr.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (29,'cdr-pro.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (30,'cdr-sgi.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (31,'cerebus.interactivate.com',28800,'A','65.212.133.170',20030504101459);
INSERT INTO internal_interactivate_com VALUES (32,'chainsaw.interactivate.com',28800,'A','192.168.1.91',20030504101459);
INSERT INTO internal_interactivate_com VALUES (33,'client-services.interactivate.com',28800,'A','65.212.133.165',20030504101459);
INSERT INTO internal_interactivate_com VALUES (34,'cmc-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (35,'cmc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (36,'cmc-live.interactivate.com',28800,'A','216.120.60.22',20030504101459);
INSERT INTO internal_interactivate_com VALUES (37,'cmc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (38,'con-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (39,'con-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (40,'conf.interactivate.com',28800,'A','65.212.133.175',20030504101459);
INSERT INTO internal_interactivate_com VALUES (41,'cooper.interactivate.com',28800,'A','192.168.1.28',20030504101459);
INSERT INTO internal_interactivate_com VALUES (42,'creative.interactivate.com',28800,'A','65.212.133.188',20030504101459);
INSERT INTO internal_interactivate_com VALUES (43,'dav-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (44,'dav-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (45,'dead-pool.interactivate.com',28800,'A','65.212.133.176',20030504101459);
INSERT INTO internal_interactivate_com VALUES (46,'deltek.interactivate.com',28800,'A','192.168.1.15',20030504101459);
INSERT INTO internal_interactivate_com VALUES (47,'demo.interactivate.com',28800,'CNAME','creative.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (48,'dev.interactivate.com',28800,'A','65.212.133.190',20030504101459);
INSERT INTO internal_interactivate_com VALUES (49,'dev1.interactivate.com',28800,'A','192.168.1.99',20030504101459);
INSERT INTO internal_interactivate_com VALUES (50,'dev2.interactivate.com',28800,'A','192.168.1.99',20030504101459);
INSERT INTO internal_interactivate_com VALUES (51,'dmi.interactivate.com',28800,'A','65.212.133.166',20030504101459);
INSERT INTO internal_interactivate_com VALUES (52,'dns.interactivate.com',28800,'CNAME','uller.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (53,'dubois-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (54,'dubois-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (55,'eartha.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (56,'esc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (57,'esc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (58,'eur-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (59,'eur-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (60,'euro-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (61,'euro-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (62,'ews-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (63,'ews-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (64,'ferret.interactivate.com',28800,'A','192.168.1.212',20030504101459);
INSERT INTO internal_interactivate_com VALUES (65,'finance.interactivate.com',28800,'A','65.212.133.180',20030504101459);
INSERT INTO internal_interactivate_com VALUES (66,'firewall.interactivate.com',28800,'CNAME','heimdall.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (67,'flo-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (68,'flo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (69,'flo-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (70,'ftp.interactivate.com',28800,'A','65.212.133.187',20030504101459);
INSERT INTO internal_interactivate_com VALUES (71,'fwl-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (72,'fwl-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (73,'gas-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (74,'gas-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (75,'gcc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (76,'gcc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (77,'gpc.interactivate.com',28800,'A','192.168.1.91',20030504101459);
INSERT INTO internal_interactivate_com VALUES (78,'gw.interactivate.com',28800,'A','192.168.1.235',20030504101459);
INSERT INTO internal_interactivate_com VALUES (79,'handler-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (80,'heimdall.interactivate.com',28800,'A','65.212.133.162',20030504101459);
INSERT INTO internal_interactivate_com VALUES (81,'hom-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (82,'hom-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (83,'hum-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (84,'hum-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (85,'iai-release.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (86,'icg.interactivate.com',28800,'A','216.120.59.226',20030504101459);
INSERT INTO internal_interactivate_com VALUES (87,'iid-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (88,'iid-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (89,'im.interactivate.com',28800,'A','192.168.1.1',20030504101459);
INSERT INTO internal_interactivate_com VALUES (90,'imap.interactivate.com',28800,'A','192.168.1.67',20030504101459);
INSERT INTO internal_interactivate_com VALUES (91,'irv-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (92,'isc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (93,'isc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (94,'jen-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (95,'john.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (96,'josh.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (97,'jud.interactivate.com',28800,'A','192.168.1.1',20030504101459);
INSERT INTO internal_interactivate_com VALUES (98,'kat-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (99,'katz-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (100,'kau-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (101,'kau-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (102,'lad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (103,'lad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (104,'ladera.interactivate.com',28800,'A','216.120.60.29',20030504101459);
INSERT INTO internal_interactivate_com VALUES (105,'lappie.interactivate.com',28800,'A','65.212.133.174',20030504101459);
INSERT INTO internal_interactivate_com VALUES (106,'loghost.interactivate.com',28800,'CNAME','www.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (107,'luz-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (108,'luz-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (109,'lyo-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (110,'lyo-dux-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (111,'lyo-dux-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (112,'lyo-golf-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (113,'lyo-golf-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (114,'lyo-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (115,'lyon-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (116,'lyon-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (117,'lyonferret.interactivate.com',28800,'A','192.168.1.212',20030504101459);
INSERT INTO internal_interactivate_com VALUES (118,'lyonnt-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (119,'lyonpr-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (120,'mag-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (121,'mag-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (122,'magee-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (123,'magee-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (124,'mail.interactivate.com',28800,'A','192.168.1.66',20030504101459);
INSERT INTO internal_interactivate_com VALUES (125,'mail2.interactivate.com',28800,'A','192.168.1.67',20030504101459);
INSERT INTO internal_interactivate_com VALUES (126,'maila.interactivate.com',28800,'A','192.168.1.67',20030504101459);
INSERT INTO internal_interactivate_com VALUES (127,'mailia.interactivate.com',28800,'A','192.168.1.67',20030504101459);
INSERT INTO internal_interactivate_com VALUES (128,'market.interactivate.com',28800,'A','65.212.133.163',20030504101459);
INSERT INTO internal_interactivate_com VALUES (129,'maui.interactivate.com',28800,'A','192.168.1.166',20030504101459);
INSERT INTO internal_interactivate_com VALUES (130,'mysql.interactivate.com',28800,'A','216.120.59.254',20030504101459);
INSERT INTO internal_interactivate_com VALUES (131,'nas-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (132,'nas-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (133,'ns1.interactivate.com',28800,'A','216.120.59.226',20030504101459);
INSERT INTO internal_interactivate_com VALUES (134,'ns2.interactivate.com',28800,'A','65.212.133.173',20030504101459);
INSERT INTO internal_interactivate_com VALUES (135,'ns3.interactivate.com',28800,'A','65.212.133.173',20030504101459);
INSERT INTO internal_interactivate_com VALUES (136,'nt-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (137,'orwell.interactivate.com',28800,'A','65.212.133.167',20030504101459);
INSERT INTO internal_interactivate_com VALUES (138,'orwell.interactivate.com',28800,'A','192.168.1.23',20030504101459);
INSERT INTO internal_interactivate_com VALUES (139,'osb-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (140,'osb-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (141,'pad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (142,'pad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (143,'padres.interactivate.com',28800,'A','207.110.41.208',20030504101459);
INSERT INTO internal_interactivate_com VALUES (144,'pfp-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (145,'pfy.interactivate.com',28800,'A','65.212.133.172',20030504101459);
INSERT INTO internal_interactivate_com VALUES (146,'pgsql.interactivate.com',28800,'A','216.120.59.253',20030504101459);
INSERT INTO internal_interactivate_com VALUES (147,'pin-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (148,'pin-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (149,'pine-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (150,'pine-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (151,'pinehills.interactivate.com',28800,'A','216.120.60.9',20030504101459);
INSERT INTO internal_interactivate_com VALUES (152,'pinehills-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (153,'pop.interactivate.com',28800,'A','192.168.1.67',20030504101459);
INSERT INTO internal_interactivate_com VALUES (154,'pro-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (155,'pro-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (156,'prov-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (157,'prov-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (158,'proven.interactivate.com',28800,'A','216.120.60.14',20030504101459);
INSERT INTO internal_interactivate_com VALUES (159,'rai-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (160,'rai-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (161,'raisins.interactivate.com',28800,'A','216.120.59.230',20030504101459);
INSERT INTO internal_interactivate_com VALUES (162,'rea-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (163,'rea-salad-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (164,'rea-salad-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (165,'rea-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (166,'read-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (167,'read-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (168,'recipe.interactivate.com',28800,'A','65.212.133.186',20030504101459);
INSERT INTO internal_interactivate_com VALUES (169,'rjt-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (170,'rjt-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (171,'rmv-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (172,'rmv-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (173,'rod-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (174,'rod-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (175,'router.interactivate.com',28800,'A','65.212.133.161',20030504101459);
INSERT INTO internal_interactivate_com VALUES (176,'rt.interactivate.com',28800,'A','63.141.73.17',20030504101459);
INSERT INTO internal_interactivate_com VALUES (177,'rui-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (178,'rui-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (179,'rui2-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (180,'rui2-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (181,'sales.interactivate.com',28800,'A','65.212.133.179',20030504101459);
INSERT INTO internal_interactivate_com VALUES (182,'scd-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (183,'scd-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (184,'scott.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (185,'sdaw.interactivate.com',28800,'A','216.51.113.21',20030504101459);
INSERT INTO internal_interactivate_com VALUES (186,'sdc-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (187,'sdc-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (188,'sdy-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (189,'sdy-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (190,'sdyouth.interactivate.com',28800,'A','216.51.113.26',20030504101459);
INSERT INTO internal_interactivate_com VALUES (191,'sea-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (192,'sea-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (193,'seac-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (194,'sgi-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (195,'sgifs-dev.interactivate.com',28800,'CNAME','dev1.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (196,'sil-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (197,'sil-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (198,'skunk.interactivate.com',28800,'A','192.168.1.185',20030504101459);
INSERT INTO internal_interactivate_com VALUES (199,'slacker.interactivate.com',28800,'A','65.212.133.178',20030504101459);
INSERT INTO internal_interactivate_com VALUES (200,'smartix.interactivate.com',28800,'A','216.120.60.28',20030504101459);
INSERT INTO internal_interactivate_com VALUES (201,'solanocisrs.interactivate.com',28800,'A','192.168.1.233',20030504101459);
INSERT INTO internal_interactivate_com VALUES (202,'staff.interactivate.com',28800,'A','216.120.59.242',20030504101459);
INSERT INTO internal_interactivate_com VALUES (203,'staging.interactivate.com',28800,'A','65.212.133.189',20030504101459);
INSERT INTO internal_interactivate_com VALUES (204,'sunkist.interactivate.com',28800,'A','216.120.60.18',20030504101459);
INSERT INTO internal_interactivate_com VALUES (205,'sunkistfs.interactivate.com',28800,'A','216.120.59.228',20030504101459);
INSERT INTO internal_interactivate_com VALUES (206,'sus-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (207,'sus-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (208,'tal-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (209,'tal-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (210,'talega.interactivate.com',28800,'A','216.120.59.228',20030504101459);
INSERT INTO internal_interactivate_com VALUES (211,'tay-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (212,'tay-mluz-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (213,'tay-mluz-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (214,'tay-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (215,'team.interactivate.com',28800,'A','65.212.133.169',20030504101459);
INSERT INTO internal_interactivate_com VALUES (216,'thai.interactivate.com',28800,'A','192.168.1.187',20030504101459);
INSERT INTO internal_interactivate_com VALUES (217,'thaistick.interactivate.com',28800,'A','192.168.1.187',20030504101459);
INSERT INTO internal_interactivate_com VALUES (218,'train-cisrs.interactivate.com',28800,'A','192.168.1.233',20030504101459);
INSERT INTO internal_interactivate_com VALUES (219,'uller.interactivate.com',28800,'A','65.212.133.177',20030504101459);
INSERT INTO internal_interactivate_com VALUES (220,'uller.interactivate.com',28800,'A','192.168.1.56',20030504101459);
INSERT INTO internal_interactivate_com VALUES (221,'vpn.interactivate.com',28800,'A','192.168.1.60',20030504101459);
INSERT INTO internal_interactivate_com VALUES (222,'webmail.interactivate.com',28800,'A','216.120.59.242',20030504101459);
INSERT INTO internal_interactivate_com VALUES (223,'wolf.interactivate.com',28800,'A','192.168.1.6',20030504101459);
INSERT INTO internal_interactivate_com VALUES (224,'wor-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (225,'wor-staging.interactivate.com',28800,'A','216.51.113.21',20030504101459);
INSERT INTO internal_interactivate_com VALUES (226,'wreath-develop.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (227,'wreath-staging.interactivate.com',28800,'CNAME','dev.interactivate.com.',20030504101459);
INSERT INTO internal_interactivate_com VALUES (228,'www.interactivate.com',28800,'A','216.120.59.228',20030504101459);

--
-- Table structure for table 'iscapes_com'
--

CREATE TABLE iscapes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'iscapes_com'
--


INSERT INTO iscapes_com VALUES (1,'iscapes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001111605 14400 3600 604800 28800',20030504123236);
INSERT INTO iscapes_com VALUES (2,'iscapes.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO iscapes_com VALUES (3,'iscapes.com',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO iscapes_com VALUES (4,'iscapes.com',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO iscapes_com VALUES (5,'iscapes.com',28800,'A','216.120.60.2',20030621132157);
INSERT INTO iscapes_com VALUES (6,'localhost.iscapes.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO iscapes_com VALUES (7,'www.iscapes.com',28800,'A','216.120.60.2',20030621132157);
INSERT INTO iscapes_com VALUES (10,'www2.iscapes.com',28800,'A','216.120.59.227',20030803190134);

--
-- Table structure for table 'jackabbott_biz'
--

CREATE TABLE jackabbott_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'jackabbott_biz'
--


INSERT INTO jackabbott_biz VALUES (1,'jackabbott.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081003 14400 3600 604800 28800',20030504123236);
INSERT INTO jackabbott_biz VALUES (2,'jackabbott.biz',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO jackabbott_biz VALUES (3,'jackabbott.biz',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO jackabbott_biz VALUES (4,'localhost.jackabbott.biz',28800,'A','127.0.0.1',20030504123236);
INSERT INTO jackabbott_biz VALUES (5,'www.jackabbott.biz',28800,'A','216.120.60.5',20030621132157);

--
-- Table structure for table 'jackabbott_com'
--

CREATE TABLE jackabbott_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'jackabbott_com'
--


INSERT INTO jackabbott_com VALUES (1,'jackabbott.com',28800,'A','216.120.60.5',20030621132157);
INSERT INTO jackabbott_com VALUES (2,'jackabbott.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081005 14400 3600 604800 28800',20030504123236);
INSERT INTO jackabbott_com VALUES (3,'jackabbott.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO jackabbott_com VALUES (4,'jackabbott.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO jackabbott_com VALUES (5,'localhost.jackabbott.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO jackabbott_com VALUES (6,'www.jackabbott.com',28800,'A','216.120.60.5',20030621132157);

--
-- Table structure for table 'jackabbott_info'
--

CREATE TABLE jackabbott_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'jackabbott_info'
--


INSERT INTO jackabbott_info VALUES (1,'jackabbott.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081003 14400 3600 604800 28800',20030504123236);
INSERT INTO jackabbott_info VALUES (2,'jackabbott.info',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO jackabbott_info VALUES (3,'jackabbott.info',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO jackabbott_info VALUES (4,'localhost.jackabbott.info',28800,'A','127.0.0.1',20030504123236);
INSERT INTO jackabbott_info VALUES (5,'www.jackabbott.info',28800,'A','216.120.60.5',20030621132157);

--
-- Table structure for table 'jackabbottjr_com'
--

CREATE TABLE jackabbottjr_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'jackabbottjr_com'
--


INSERT INTO jackabbottjr_com VALUES (1,'jackabbottjr.com',28800,'A','216.120.60.5',20030621132157);
INSERT INTO jackabbottjr_com VALUES (2,'jackabbottjr.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081005 14400 3600 604800 28800',20030504123236);
INSERT INTO jackabbottjr_com VALUES (3,'jackabbottjr.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO jackabbottjr_com VALUES (4,'jackabbottjr.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO jackabbottjr_com VALUES (5,'localhost.jackabbottjr.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO jackabbottjr_com VALUES (6,'www.jackabbottjr.com',28800,'A','216.120.60.5',20030621132157);
INSERT INTO jackabbottjr_com VALUES (8,'www2.jackabbottjr.com',28800,'A','216.120.59.227',20030803190135);

--
-- Table structure for table 'la_quinta_homes_com'
--

CREATE TABLE la_quinta_homes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'la_quinta_homes_com'
--


INSERT INTO la_quinta_homes_com VALUES (1,'la-quinta-homes.com',28800,'A','206.142.208.21',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (2,'la-quinta-homes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (3,'la-quinta-homes.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (4,'la-quinta-homes.com',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (5,'la-quinta-homes.com',28800,'NS','ns3.interactivate.com.',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (6,'la-quinta-homes.com',28800,'MX','10 mail.la-quinta-homes.com.',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (7,'ftp.la-quinta-homes.com',28800,'A','208.16.94.35',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (8,'mail.la-quinta-homes.com',28800,'A','208.16.94.35',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (9,'pop.la-quinta-homes.com',28800,'A','208.16.94.35',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (10,'smtp.la-quinta-homes.com',28800,'A','208.16.94.35',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (11,'updates.la-quinta-homes.com',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO la_quinta_homes_com VALUES (12,'www.la-quinta-homes.com',28800,'A','206.142.208.21',20030504123236);

--
-- Table structure for table 'la_vina_com'
--

CREATE TABLE la_vina_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'la_vina_com'
--


INSERT INTO la_vina_com VALUES (1,'la-vina.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO la_vina_com VALUES (2,'la-vina.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002122503 14400 3600 604800 300',20030504123236);
INSERT INTO la_vina_com VALUES (3,'la-vina.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO la_vina_com VALUES (4,'la-vina.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO la_vina_com VALUES (5,'la-vina.com',28800,'MX','10 mail.la-vina.com.',20030504123236);
INSERT INTO la_vina_com VALUES (6,'ftp.la-vina.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO la_vina_com VALUES (7,'localhost.la-vina.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO la_vina_com VALUES (8,'localhost.la-vina.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO la_vina_com VALUES (9,'mail.la-vina.com',28800,'A','209.76.235.6',20030504123236);
INSERT INTO la_vina_com VALUES (10,'www.la-vina.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO la_vina_com VALUES (13,'www2.la-vina.com',28800,'A','216.120.59.227',20030803190135);

--
-- Table structure for table 'ladera_ranch_biz'
--

CREATE TABLE ladera_ranch_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) NOT NULL default '28800',
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY NAME (NAME),
  KEY RDTYPE (RDTYPE),
  KEY RDATA (RDATA),
  KEY NAME_2 (NAME,RDTYPE,RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ladera_ranch_biz'
--


INSERT INTO ladera_ranch_biz VALUES (1,'ladera-ranch.biz',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003050602 14400 3600 604800 28800',20030506115024);
INSERT INTO ladera_ranch_biz VALUES (2,'ladera-ranch.biz',28800,'NS','icg.interactivate.com.',20030506112534);
INSERT INTO ladera_ranch_biz VALUES (3,'ladera-ranch.biz',28800,'NS','ns2.interactivate.com.',20030506112534);
INSERT INTO ladera_ranch_biz VALUES (4,'ladera-ranch.biz',28800,'NS','ns3.interactivate.com.',20030506112534);
INSERT INTO ladera_ranch_biz VALUES (5,'ladera-ranch.biz',28800,'A','216.120.59.244',20030621132157);
INSERT INTO ladera_ranch_biz VALUES (6,'www.ladera-ranch.biz',28800,'A','216.120.59.244',20030621132157);

--
-- Table structure for table 'ladera_ranch_cc'
--

CREATE TABLE ladera_ranch_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) NOT NULL default '28800',
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY NAME (NAME),
  KEY RDTYPE (RDTYPE),
  KEY RDATA (RDATA),
  KEY NAME_2 (NAME,RDTYPE,RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ladera_ranch_cc'
--


INSERT INTO ladera_ranch_cc VALUES (1,'ladera-ranch.cc',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003050602 14400 3600 604800 28800',20030506114931);
INSERT INTO ladera_ranch_cc VALUES (2,'ladera-ranch.cc',28800,'NS','icg.interactivate.com.',20030506112658);
INSERT INTO ladera_ranch_cc VALUES (3,'ladera-ranch.cc',28800,'NS','ns2.interactivate.com.',20030506112658);
INSERT INTO ladera_ranch_cc VALUES (4,'ladera-ranch.cc',28800,'NS','ns3.interactivate.com.',20030506112658);
INSERT INTO ladera_ranch_cc VALUES (5,'ladera-ranch.cc',28800,'A','216.120.59.244',20030621132157);
INSERT INTO ladera_ranch_cc VALUES (6,'www.ladera-ranch.cc',28800,'A','216.120.59.244',20030621132157);

--
-- Table structure for table 'ladera_ranch_info'
--

CREATE TABLE ladera_ranch_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) NOT NULL default '28800',
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY NAME (NAME),
  KEY RDTYPE (RDTYPE),
  KEY RDATA (RDATA),
  KEY NAME_2 (NAME,RDTYPE,RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ladera_ranch_info'
--


INSERT INTO ladera_ranch_info VALUES (1,'ladera-ranch.info',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003050602 14400 3600 604800 28800',20030506115032);
INSERT INTO ladera_ranch_info VALUES (2,'ladera-ranch.info',28800,'NS','icg.interactivate.com.',20030506112622);
INSERT INTO ladera_ranch_info VALUES (3,'ladera-ranch.info',28800,'NS','ns2.interactivate.com.',20030506112622);
INSERT INTO ladera_ranch_info VALUES (4,'ladera-ranch.info',28800,'NS','ns3.interactivate.com.',20030506112622);
INSERT INTO ladera_ranch_info VALUES (5,'ladera-ranch.info',28800,'A','216.120.59.244',20030621132157);
INSERT INTO ladera_ranch_info VALUES (6,'www.ladera-ranch.info',28800,'A','216.120.59.244',20030621132157);

--
-- Table structure for table 'ladera_ranch_org'
--

CREATE TABLE ladera_ranch_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) NOT NULL default '28800',
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY NAME (NAME),
  KEY RDTYPE (RDTYPE),
  KEY RDATA (RDATA),
  KEY NAME_2 (NAME,RDTYPE,RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ladera_ranch_org'
--


INSERT INTO ladera_ranch_org VALUES (1,'ladera-ranch.org',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003050602 14400 3600 604800 28800',20030506115041);
INSERT INTO ladera_ranch_org VALUES (2,'ladera-ranch.org',28800,'NS','icg.interactivate.com.',20030506112439);
INSERT INTO ladera_ranch_org VALUES (3,'ladera-ranch.org',28800,'NS','ns2.interactivate.com.',20030506112439);
INSERT INTO ladera_ranch_org VALUES (4,'ladera-ranch.org',28800,'NS','ns3.interactivate.com.',20030506112439);
INSERT INTO ladera_ranch_org VALUES (5,'ladera-ranch.org',28800,'A','216.120.59.244',20030621132157);
INSERT INTO ladera_ranch_org VALUES (6,'www.ladera-ranch.org',28800,'A','216.120.59.244',20030621132157);

--
-- Table structure for table 'laderaranch_net'
--

CREATE TABLE laderaranch_net (
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

--
-- Dumping data for table 'laderaranch_net'
--


INSERT INTO laderaranch_net VALUES (1,'laderaranch.net',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070203 14400 3600 604800 28800',20030702112959);
INSERT INTO laderaranch_net VALUES (2,'laderaranch.net',28800,'NS','icg.interactivate.com.',20030702112927);
INSERT INTO laderaranch_net VALUES (3,'laderaranch.net',28800,'NS','ns2.interactivate.com.',20030702112928);
INSERT INTO laderaranch_net VALUES (4,'laderaranch.net',28800,'NS','ns3.interactivate.com.',20030702112928);
INSERT INTO laderaranch_net VALUES (5,'laderaranch.net',28800,'A','216.120.59.244',20030702112948);
INSERT INTO laderaranch_net VALUES (6,'www.laderaranch.net',28800,'A','216.120.59.244',20030702112959);

--
-- Table structure for table 'laderaranchrealty_com'
--

CREATE TABLE laderaranchrealty_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'laderaranchrealty_com'
--


INSERT INTO laderaranchrealty_com VALUES (1,'laderaranchrealty.com',28800,'SOA','ns.interactivate.com. dns.interactivate.com. 200302190 14400 3600 604800 86400',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (2,'laderaranchrealty.com',28800,'NS','ns.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (3,'laderaranchrealty.com',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (4,'laderaranchrealty.com',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (5,'laderaranchrealty.com',28800,'MX','20 mail2.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (6,'laderaranchrealty.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO laderaranchrealty_com VALUES (7,'ftp.laderaranchrealty.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO laderaranchrealty_com VALUES (8,'imap.laderaranchrealty.com',28800,'CNAME','imap.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (9,'mail.laderaranchrealty.com',28800,'CNAME','mail.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (10,'pop.laderaranchrealty.com',28800,'CNAME','pop.interactivate.com.',20030504123236);
INSERT INTO laderaranchrealty_com VALUES (11,'shell.laderaranchrealty.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO laderaranchrealty_com VALUES (12,'www.laderaranchrealty.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO laderaranchrealty_com VALUES (14,'www2.laderaranchrealty.com',28800,'A','216.120.59.227',20030803190135);

--
-- Table structure for table 'laderaranchrealty_org'
--

CREATE TABLE laderaranchrealty_org (
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

--
-- Dumping data for table 'laderaranchrealty_org'
--


INSERT INTO laderaranchrealty_org VALUES (1,'laderaranchrealty.org',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070204 14400 3600 604800 28800',20030702114426);
INSERT INTO laderaranchrealty_org VALUES (2,'laderaranchrealty.org',28800,'NS','icg.interactivate.com.',20030702113827);
INSERT INTO laderaranchrealty_org VALUES (3,'laderaranchrealty.org',28800,'NS','ns2.interactivate.com.',20030702113827);
INSERT INTO laderaranchrealty_org VALUES (4,'laderaranchrealty.org',28800,'NS','ns3.interactivate.com.',20030702113827);
INSERT INTO laderaranchrealty_org VALUES (5,'laderaranchrealty.org',28800,'A','216.120.59.228',20030702114056);
INSERT INTO laderaranchrealty_org VALUES (6,'www.laderaranchrealty.org',28800,'A','216.120.59.228',20030702114106);

--
-- Table structure for table 'livingwreath_com'
--

CREATE TABLE livingwreath_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'livingwreath_com'
--


INSERT INTO livingwreath_com VALUES (1,'livingwreath.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001092804 14400 3600 604800 28800',20030504123236);
INSERT INTO livingwreath_com VALUES (2,'livingwreath.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO livingwreath_com VALUES (3,'livingwreath.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO livingwreath_com VALUES (4,'livingwreath.com',28800,'A','216.120.60.13',20030621132157);
INSERT INTO livingwreath_com VALUES (5,'livingwreath.com',28800,'MX','10 mail.livingwreath.com.',20030504123236);
INSERT INTO livingwreath_com VALUES (6,'livingwreath.com',28800,'MX','30 mailqueue.netcomi.com.',20030504123236);
INSERT INTO livingwreath_com VALUES (7,'localhost.livingwreath.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO livingwreath_com VALUES (8,'mail.livingwreath.com',28800,'CNAME','mail.interactivate.com.',20030504123236);
INSERT INTO livingwreath_com VALUES (9,'www.livingwreath.com',28800,'A','216.120.60.13',20030621132157);
INSERT INTO livingwreath_com VALUES (12,'www2.livingwreath.com',28800,'A','216.120.59.227',20030803190136);

--
-- Table structure for table 'lizclaiborneswim_com'
--

CREATE TABLE lizclaiborneswim_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'lizclaiborneswim_com'
--


INSERT INTO lizclaiborneswim_com VALUES (1,'lizclaiborneswim.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123236);
INSERT INTO lizclaiborneswim_com VALUES (2,'lizclaiborneswim.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO lizclaiborneswim_com VALUES (3,'lizclaiborneswim.com',28800,'NS','ns2.interactivate.com.',20030504123236);
INSERT INTO lizclaiborneswim_com VALUES (4,'localhost.lizclaiborneswim.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO lizclaiborneswim_com VALUES (5,'www.lizclaiborneswim.com',28800,'A','207.110.42.223',20030504123236);

--
-- Table structure for table 'lyon_pride_com'
--

CREATE TABLE lyon_pride_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'lyon_pride_com'
--


INSERT INTO lyon_pride_com VALUES (1,'lyon-pride.com',28800,'A','216.120.60.22',20030621132157);
INSERT INTO lyon_pride_com VALUES (2,'lyon-pride.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123236);
INSERT INTO lyon_pride_com VALUES (3,'lyon-pride.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO lyon_pride_com VALUES (4,'lyon-pride.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO lyon_pride_com VALUES (5,'lyon-pride.com',28800,'MX','10 mail.lyon-pride.com.',20030504123236);
INSERT INTO lyon_pride_com VALUES (6,'localhost.lyon-pride.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO lyon_pride_com VALUES (7,'mail.lyon-pride.com',28800,'A','12.13.12.99',20030504123236);
INSERT INTO lyon_pride_com VALUES (8,'new.lyon-pride.com',28800,'A','216.120.60.22',20030621132157);
INSERT INTO lyon_pride_com VALUES (9,'www.lyon-pride.com',28800,'A','216.120.60.22',20030621132157);

--
-- Table structure for table 'lyonhomes_com'
--

CREATE TABLE lyonhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'lyonhomes_com'
--


INSERT INTO lyonhomes_com VALUES (1,'lyonhomes.com',28800,'A','216.120.59.248',20030621132157);
INSERT INTO lyonhomes_com VALUES (2,'lyonhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002091003 14400 3600 604800 28800',20030504123236);
INSERT INTO lyonhomes_com VALUES (3,'lyonhomes.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO lyonhomes_com VALUES (4,'lyonhomes.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO lyonhomes_com VALUES (5,'lyonhomes.com',28800,'MX','10 mail.lyonhomes.com.',20030504123236);
INSERT INTO lyonhomes_com VALUES (6,'amail.lyonhomes.com',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO lyonhomes_com VALUES (7,'localhost.lyonhomes.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO lyonhomes_com VALUES (8,'mail.lyonhomes.com',28800,'A','216.65.210.41',20030504123236);
INSERT INTO lyonhomes_com VALUES (9,'updates.lyonhomes.com',28800,'MX','10 mail.interactivate.com.',20030504123236);
INSERT INTO lyonhomes_com VALUES (10,'www.lyonhomes.com',28800,'A','216.120.59.248',20030621132157);
INSERT INTO lyonhomes_com VALUES (12,'www2.lyonhomes.com',28800,'A','216.120.59.227',20030803190136);

--
-- Table structure for table 'lyonhomeslv_com'
--

CREATE TABLE lyonhomeslv_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'lyonhomeslv_com'
--


INSERT INTO lyonhomeslv_com VALUES (1,'lyonhomeslv.com',28800,'A','216.120.59.248',20030621132157);
INSERT INTO lyonhomeslv_com VALUES (2,'lyonhomeslv.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002040403 14400 3600 604800 28800',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (3,'lyonhomeslv.com',28800,'NS','ns.connectnet.com.',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (4,'lyonhomeslv.com',28800,'NS','icg.interactivate.com.',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (5,'lyonhomeslv.com',28800,'MX','10 mail.lyonhomeslv.com.',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (6,'localhost.lyonhomeslv.com',28800,'A','127.0.0.1',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (7,'mail.lyonhomeslv.com',28800,'A','216.65.210.41',20030504123236);
INSERT INTO lyonhomeslv_com VALUES (8,'www.lyonhomeslv.com',28800,'A','216.120.59.248',20030621132157);

--
-- Table structure for table 'moiso_cc'
--

CREATE TABLE moiso_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'moiso_cc'
--


INSERT INTO moiso_cc VALUES (1,'moiso.cc',28800,'A','216.120.60.17',20030621132157);
INSERT INTO moiso_cc VALUES (2,'moiso.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123237);
INSERT INTO moiso_cc VALUES (3,'moiso.cc',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO moiso_cc VALUES (4,'moiso.cc',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO moiso_cc VALUES (5,'localhost.moiso.cc',28800,'A','127.0.0.1',20030504123237);
INSERT INTO moiso_cc VALUES (6,'www.moiso.cc',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'monterra_monterey_com'
--

CREATE TABLE monterra_monterey_com (
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

--
-- Dumping data for table 'monterra_monterey_com'
--


INSERT INTO monterra_monterey_com VALUES (1,'monterra-monterey.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003073103 14400 3600 604800 28800',20030731100931);
INSERT INTO monterra_monterey_com VALUES (2,'monterra-monterey.com',28800,'NS','icg.interactivate.com.',20030731100909);
INSERT INTO monterra_monterey_com VALUES (3,'monterra-monterey.com',28800,'NS','ns2.interactivate.com.',20030731100909);
INSERT INTO monterra_monterey_com VALUES (4,'monterra-monterey.com',28800,'NS','ns3.interactivate.com.',20030731100909);
INSERT INTO monterra_monterey_com VALUES (5,'monterra-monterey.com',28800,'A','216.120.59.228',20030731100923);
INSERT INTO monterra_monterey_com VALUES (6,'www.monterra-monterey.com',28800,'A','216.120.59.228',20030731100931);
INSERT INTO monterra_monterey_com VALUES (8,'www2.monterra-monterey.com',28800,'A','216.120.59.227',20030803190204);

--
-- Table structure for table 'myavocado_com'
--

CREATE TABLE myavocado_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'myavocado_com'
--


INSERT INTO myavocado_com VALUES (1,'myavocado.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_com VALUES (2,'myavocado.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO myavocado_com VALUES (3,'myavocado.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO myavocado_com VALUES (4,'myavocado.com',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO myavocado_com VALUES (5,'myavocado.com',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO myavocado_com VALUES (6,'myavocado.com',28800,'MX','10 mail.avocado.org.',20030504123237);
INSERT INTO myavocado_com VALUES (7,'myavocado.com',28800,'MX','20 relay1.eni.net.',20030504123237);
INSERT INTO myavocado_com VALUES (8,'amric.myavocado.com',28800,'A','216.120.104.20',20030621132157);
INSERT INTO myavocado_com VALUES (9,'avoinfomx.myavocado.com',28800,'A','207.71.116.229',20030504123237);
INSERT INTO myavocado_com VALUES (10,'cac.myavocado.com',28800,'A','206.40.222.178',20030504123237);
INSERT INTO myavocado_com VALUES (11,'cac1.myavocado.com',28800,'A','209.170.17.65',20030504123237);
INSERT INTO myavocado_com VALUES (12,'crisis.myavocado.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_com VALUES (13,'dev.myavocado.com',28800,'A','216.120.104.21',20030621132157);
INSERT INTO myavocado_com VALUES (14,'extra.myavocado.com',28800,'A','216.120.59.233',20030621132157);
INSERT INTO myavocado_com VALUES (15,'handler.myavocado.com',28800,'A','207.110.32.98',20030504123237);
INSERT INTO myavocado_com VALUES (16,'localhost.myavocado.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO myavocado_com VALUES (17,'mail.myavocado.com',28800,'A','209.170.17.66',20030504123237);
INSERT INTO myavocado_com VALUES (18,'old.myavocado.com',28800,'A','216.120.104.19',20030621132157);
INSERT INTO myavocado_com VALUES (19,'owa.myavocado.com',28800,'A','209.170.17.67',20030504123237);
INSERT INTO myavocado_com VALUES (20,'updates.myavocado.com',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO myavocado_com VALUES (21,'www.myavocado.com',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_com VALUES (22,'xtra.myavocado.com',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'myavocado_net'
--

CREATE TABLE myavocado_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'myavocado_net'
--


INSERT INTO myavocado_net VALUES (1,'myavocado.net',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_net VALUES (2,'myavocado.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO myavocado_net VALUES (3,'myavocado.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO myavocado_net VALUES (4,'myavocado.net',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO myavocado_net VALUES (5,'myavocado.net',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO myavocado_net VALUES (6,'myavocado.net',28800,'MX','10 mail.avocado.org.',20030504123237);
INSERT INTO myavocado_net VALUES (7,'myavocado.net',28800,'MX','20 relay1.eni.net.',20030504123237);
INSERT INTO myavocado_net VALUES (8,'amric.myavocado.net',28800,'A','216.120.104.20',20030621132157);
INSERT INTO myavocado_net VALUES (9,'avoinfomx.myavocado.net',28800,'A','207.71.116.229',20030504123237);
INSERT INTO myavocado_net VALUES (10,'cac.myavocado.net',28800,'A','206.40.222.178',20030504123237);
INSERT INTO myavocado_net VALUES (11,'cac1.myavocado.net',28800,'A','209.170.17.65',20030504123237);
INSERT INTO myavocado_net VALUES (12,'crisis.myavocado.net',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_net VALUES (13,'dev.myavocado.net',28800,'A','216.120.104.21',20030621132157);
INSERT INTO myavocado_net VALUES (14,'extra.myavocado.net',28800,'A','216.120.59.233',20030621132157);
INSERT INTO myavocado_net VALUES (15,'handler.myavocado.net',28800,'A','207.110.32.98',20030504123237);
INSERT INTO myavocado_net VALUES (16,'localhost.myavocado.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO myavocado_net VALUES (17,'mail.myavocado.net',28800,'A','209.170.17.66',20030504123237);
INSERT INTO myavocado_net VALUES (18,'old.myavocado.net',28800,'A','216.120.104.19',20030621132157);
INSERT INTO myavocado_net VALUES (19,'owa.myavocado.net',28800,'A','209.170.17.67',20030504123237);
INSERT INTO myavocado_net VALUES (20,'updates.myavocado.net',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO myavocado_net VALUES (21,'www.myavocado.net',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_net VALUES (22,'xtra.myavocado.net',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'myavocado_org'
--

CREATE TABLE myavocado_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'myavocado_org'
--


INSERT INTO myavocado_org VALUES (1,'myavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_org VALUES (2,'myavocado.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO myavocado_org VALUES (3,'myavocado.org',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO myavocado_org VALUES (4,'myavocado.org',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO myavocado_org VALUES (5,'myavocado.org',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO myavocado_org VALUES (6,'myavocado.org',28800,'MX','10 mail.avocado.org.',20030504123237);
INSERT INTO myavocado_org VALUES (7,'myavocado.org',28800,'MX','20 relay1.eni.net.',20030504123237);
INSERT INTO myavocado_org VALUES (8,'amric.myavocado.org',28800,'A','216.120.104.20',20030621132157);
INSERT INTO myavocado_org VALUES (9,'avoinfomx.myavocado.org',28800,'A','207.71.116.229',20030504123237);
INSERT INTO myavocado_org VALUES (10,'cac.myavocado.org',28800,'A','206.40.222.178',20030504123237);
INSERT INTO myavocado_org VALUES (11,'cac1.myavocado.org',28800,'A','209.170.17.65',20030504123237);
INSERT INTO myavocado_org VALUES (12,'crisis.myavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_org VALUES (13,'dev.myavocado.org',28800,'A','216.120.104.21',20030621132157);
INSERT INTO myavocado_org VALUES (14,'extra.myavocado.org',28800,'A','216.120.59.233',20030621132157);
INSERT INTO myavocado_org VALUES (15,'handler.myavocado.org',28800,'A','207.110.32.98',20030504123237);
INSERT INTO myavocado_org VALUES (16,'localhost.myavocado.org',28800,'A','127.0.0.1',20030504123237);
INSERT INTO myavocado_org VALUES (17,'mail.myavocado.org',28800,'A','209.170.17.66',20030504123237);
INSERT INTO myavocado_org VALUES (18,'old.myavocado.org',28800,'A','216.120.104.19',20030621132157);
INSERT INTO myavocado_org VALUES (19,'owa.myavocado.org',28800,'A','209.170.17.67',20030504123237);
INSERT INTO myavocado_org VALUES (20,'updates.myavocado.org',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO myavocado_org VALUES (21,'www.myavocado.org',28800,'A','216.120.104.18',20030621132157);
INSERT INTO myavocado_org VALUES (22,'xtra.myavocado.org',28800,'A','216.120.59.233',20030621132157);

--
-- Table structure for table 'mygrasses_com'
--

CREATE TABLE mygrasses_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'mygrasses_com'
--


INSERT INTO mygrasses_com VALUES (1,'mygrasses.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001081404 14400 3600 604800 28800',20030504123237);
INSERT INTO mygrasses_com VALUES (2,'mygrasses.com',28800,'A','216.120.59.237',20030621132157);
INSERT INTO mygrasses_com VALUES (3,'mygrasses.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO mygrasses_com VALUES (4,'mygrasses.com',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO mygrasses_com VALUES (5,'mygrasses.com',28800,'MX','5 smtp.mygrasses.com.',20030504123237);
INSERT INTO mygrasses_com VALUES (6,'imap.mygrasses.com',28800,'A','209.17.184.70',20030504123237);
INSERT INTO mygrasses_com VALUES (7,'localhost.mygrasses.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO mygrasses_com VALUES (8,'loghost.mygrasses.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO mygrasses_com VALUES (9,'pop3.mygrasses.com',28800,'A','209.17.184.70',20030504123237);
INSERT INTO mygrasses_com VALUES (10,'smtp.mygrasses.com',28800,'A','209.17.184.46',20030504123237);
INSERT INTO mygrasses_com VALUES (11,'smtp-in.mygrasses.com',28800,'A','209.17.184.46',20030504123237);
INSERT INTO mygrasses_com VALUES (12,'www.mygrasses.com',28800,'A','216.120.59.237',20030621132157);
INSERT INTO mygrasses_com VALUES (13,'www.mygrasses.com',28800,'MX','10 euroamprop.com.',20030504123237);

--
-- Table structure for table 'mypws_com'
--

CREATE TABLE mypws_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'mypws_com'
--


INSERT INTO mypws_com VALUES (1,'mypws.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000112004 14400 3600 604800 28800',20030504123237);
INSERT INTO mypws_com VALUES (2,'mypws.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO mypws_com VALUES (3,'mypws.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO mypws_com VALUES (4,'localhost.mypws.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO mypws_com VALUES (5,'www.mypws.com',28800,'A','207.110.46.3',20030504123237);

--
-- Table structure for table 'mysushi_com'
--

CREATE TABLE mysushi_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'mysushi_com'
--


INSERT INTO mysushi_com VALUES (1,'mysushi.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123237);
INSERT INTO mysushi_com VALUES (2,'mysushi.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO mysushi_com VALUES (3,'mysushi.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO mysushi_com VALUES (4,'localhost.mysushi.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO mysushi_com VALUES (5,'localhost.mysushi.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO mysushi_com VALUES (6,'www.mysushi.com',28800,'A','216.120.60.7',20030621132157);

--
-- Table structure for table 'mysushideli_com'
--

CREATE TABLE mysushideli_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'mysushideli_com'
--


INSERT INTO mysushideli_com VALUES (1,'mysushideli.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123237);
INSERT INTO mysushideli_com VALUES (2,'mysushideli.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO mysushideli_com VALUES (3,'mysushideli.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO mysushideli_com VALUES (4,'localhost.mysushideli.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO mysushideli_com VALUES (5,'localhost.mysushideli.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO mysushideli_com VALUES (6,'www.mysushideli.com',28800,'A','216.120.60.7',20030621132157);

--
-- Table structure for table 'nantucketboatbasin_com'
--

CREATE TABLE nantucketboatbasin_com (
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

--
-- Dumping data for table 'nantucketboatbasin_com'
--


INSERT INTO nantucketboatbasin_com VALUES (1,'nantucketboatbasin.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (2,'nantucketboatbasin.com',28800,'NS','icg.interactivate.com.',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (3,'nantucketboatbasin.com',28800,'NS','ns2.interactivate.com.',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (4,'nantucketboatbasin.com',28800,'NS','ns3.interactivate.com.',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (5,'nantucketboatbasin.com',28800,'A','216.120.59.228',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (6,'www.nantucketboatbasin.com',28800,'A','216.120.59.228',20030708102758);
INSERT INTO nantucketboatbasin_com VALUES (8,'www2.nantucketboatbasin.com',28800,'A','216.120.59.227',20030803190202);

--
-- Table structure for table 'nantucketislandresorts_com'
--

CREATE TABLE nantucketislandresorts_com (
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

--
-- Dumping data for table 'nantucketislandresorts_com'
--


INSERT INTO nantucketislandresorts_com VALUES (1,'nantucketislandresorts.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (2,'nantucketislandresorts.com',28800,'NS','icg.interactivate.com.',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (3,'nantucketislandresorts.com',28800,'NS','ns2.interactivate.com.',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (4,'nantucketislandresorts.com',28800,'NS','ns3.interactivate.com.',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (5,'nantucketislandresorts.com',28800,'A','216.120.59.228',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (6,'www.nantucketislandresorts.com',28800,'A','216.120.59.228',20030708102759);
INSERT INTO nantucketislandresorts_com VALUES (8,'www2.nantucketislandresorts.com',28800,'A','216.120.59.227',20030803190203);

--
-- Table structure for table 'ob_com'
--

CREATE TABLE ob_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ob_com'
--


INSERT INTO ob_com VALUES (1,'ob.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000030602 14400 3600 604800 28800',20030504123237);
INSERT INTO ob_com VALUES (2,'ob.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO ob_com VALUES (3,'ob.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ob_com VALUES (4,'ftp.ob.com',28800,'CNAME','www.osbornedevelopment.com.',20030504123237);
INSERT INTO ob_com VALUES (5,'localhost.ob.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ob_com VALUES (6,'localhost.ob.com',28800,'A','209.221.156.116',20030504123237);
INSERT INTO ob_com VALUES (7,'localhost.ob.com',28800,'MX','10 mail.ob.com.',20030504123237);
INSERT INTO ob_com VALUES (8,'mail.ob.com',28800,'A','209.221.156.71',20030504123237);
INSERT INTO ob_com VALUES (9,'www.ob.com',28800,'A','209.221.156.116',20030504123237);

--
-- Table structure for table 'one_line_marketing_com'
--

CREATE TABLE one_line_marketing_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'one_line_marketing_com'
--


INSERT INTO one_line_marketing_com VALUES (1,'one-line-marketing.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000103004 14400 3600 604800 28800',20030504123237);
INSERT INTO one_line_marketing_com VALUES (2,'one-line-marketing.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO one_line_marketing_com VALUES (3,'one-line-marketing.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO one_line_marketing_com VALUES (4,'localhost.one-line-marketing.com',28800,'A','127.0.0.1',20030504123237);

--
-- Table structure for table 'one_line_marketing_net'
--

CREATE TABLE one_line_marketing_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'one_line_marketing_net'
--


INSERT INTO one_line_marketing_net VALUES (1,'one-line-marketing.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000103004 14400 3600 604800 28800',20030504123237);
INSERT INTO one_line_marketing_net VALUES (2,'one-line-marketing.net',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO one_line_marketing_net VALUES (3,'one-line-marketing.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO one_line_marketing_net VALUES (4,'localhost.one-line-marketing.net',28800,'A','127.0.0.1',20030504123237);

--
-- Table structure for table 'one_line_marketing_org'
--

CREATE TABLE one_line_marketing_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'one_line_marketing_org'
--


INSERT INTO one_line_marketing_org VALUES (1,'one-line-marketing.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000103004 14400 3600 604800 28800',20030504123237);
INSERT INTO one_line_marketing_org VALUES (2,'one-line-marketing.org',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO one_line_marketing_org VALUES (3,'one-line-marketing.org',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO one_line_marketing_org VALUES (4,'localhost.one-line-marketing.org',28800,'A','127.0.0.1',20030504123237);

--
-- Table structure for table 'oneillandmoiso_com'
--

CREATE TABLE oneillandmoiso_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'oneillandmoiso_com'
--


INSERT INTO oneillandmoiso_com VALUES (1,'oneillandmoiso.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO oneillandmoiso_com VALUES (2,'oneillandmoiso.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123237);
INSERT INTO oneillandmoiso_com VALUES (3,'oneillandmoiso.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO oneillandmoiso_com VALUES (4,'oneillandmoiso.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO oneillandmoiso_com VALUES (5,'localhost.oneillandmoiso.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO oneillandmoiso_com VALUES (6,'www.oneillandmoiso.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'onelinemarketing_com'
--

CREATE TABLE onelinemarketing_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'onelinemarketing_com'
--


INSERT INTO onelinemarketing_com VALUES (1,'onelinemarketing.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000102504 14400 3600 604800 28800',20030504123237);
INSERT INTO onelinemarketing_com VALUES (2,'onelinemarketing.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO onelinemarketing_com VALUES (3,'onelinemarketing.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO onelinemarketing_com VALUES (4,'localhost.onelinemarketing.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO onelinemarketing_com VALUES (5,'www.onelinemarketing.com',28800,'A','207.110.42.216',20030504123237);

--
-- Table structure for table 'onelinemarketing_net'
--

CREATE TABLE onelinemarketing_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'onelinemarketing_net'
--


INSERT INTO onelinemarketing_net VALUES (1,'onelinemarketing.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000102504 14400 3600 604800 28800',20030504123237);
INSERT INTO onelinemarketing_net VALUES (2,'onelinemarketing.net',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO onelinemarketing_net VALUES (3,'onelinemarketing.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO onelinemarketing_net VALUES (4,'localhost.onelinemarketing.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO onelinemarketing_net VALUES (5,'www.onelinemarketing.net',28800,'A','207.110.42.216',20030504123237);

--
-- Table structure for table 'onelinemarketing_org'
--

CREATE TABLE onelinemarketing_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'onelinemarketing_org'
--


INSERT INTO onelinemarketing_org VALUES (1,'onelinemarketing.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000102504 14400 3600 604800 28800',20030504123237);
INSERT INTO onelinemarketing_org VALUES (2,'onelinemarketing.org',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO onelinemarketing_org VALUES (3,'onelinemarketing.org',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO onelinemarketing_org VALUES (4,'localhost.onelinemarketing.org',28800,'A','127.0.0.1',20030504123237);
INSERT INTO onelinemarketing_org VALUES (5,'www.onelinemarketing.org',28800,'A','207.110.42.216',20030504123237);

--
-- Table structure for table 'onlineprequal_com'
--

CREATE TABLE onlineprequal_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'onlineprequal_com'
--


INSERT INTO onlineprequal_com VALUES (1,'onlineprequal.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002121703 14400 3600 604800 28800',20030504123237);
INSERT INTO onlineprequal_com VALUES (2,'onlineprequal.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO onlineprequal_com VALUES (3,'onlineprequal.com',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO onlineprequal_com VALUES (4,'onlineprequal.com',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO onlineprequal_com VALUES (5,'onlineprequal.com',28800,'A','216.120.59.254',20030621132157);
INSERT INTO onlineprequal_com VALUES (6,'www.onlineprequal.com',28800,'A','216.120.59.254',20030621132157);
INSERT INTO onlineprequal_com VALUES (8,'www2.onlineprequal.com',28800,'A','216.120.59.227',20030803190139);

--
-- Table structure for table 'osbornedevelopment_com'
--

CREATE TABLE osbornedevelopment_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'osbornedevelopment_com'
--


INSERT INTO osbornedevelopment_com VALUES (1,'osbornedevelopment.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001092805 14400 3600 604800 28800',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (2,'osbornedevelopment.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (3,'osbornedevelopment.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (4,'osbornedevelopment.com',28800,'MX','10 mail.osbornedevelopment.com.',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (5,'osbornedevelopment.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO osbornedevelopment_com VALUES (6,'ftp.osbornedevelopment.com',28800,'CNAME','www.osbornedevelopment.com.',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (7,'localhost.osbornedevelopment.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (8,'mail.osbornedevelopment.com',28800,'A','209.10.110.64',20030504123237);
INSERT INTO osbornedevelopment_com VALUES (9,'www.osbornedevelopment.com',28800,'A','216.120.60.15',20030621132157);

--
-- Table structure for table 'personalmail_cc'
--

CREATE TABLE personalmail_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'personalmail_cc'
--


INSERT INTO personalmail_cc VALUES (1,'personalmail.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001060704 14400 3600 604800 28800',20030504123237);
INSERT INTO personalmail_cc VALUES (2,'personalmail.cc',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO personalmail_cc VALUES (3,'personalmail.cc',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO personalmail_cc VALUES (4,'localhost.personalmail.cc',28800,'A','127.0.0.1',20030504123237);
INSERT INTO personalmail_cc VALUES (5,'localhost.personalmail.cc',28800,'MX','10 63.141.73.15.personalmail.cc.',20030504123237);
INSERT INTO personalmail_cc VALUES (6,'mail.personalmail.cc',28800,'A','63.141.73.15',20030504123237);
INSERT INTO personalmail_cc VALUES (7,'www.personalmail.cc',28800,'A','207.110.56.101',20030504123237);

--
-- Table structure for table 'pfpresents_com'
--

CREATE TABLE pfpresents_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'pfpresents_com'
--


INSERT INTO pfpresents_com VALUES (1,'pfpresents.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123237);
INSERT INTO pfpresents_com VALUES (2,'pfpresents.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO pfpresents_com VALUES (3,'pfpresents.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO pfpresents_com VALUES (4,'localhost.pfpresents.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO pfpresents_com VALUES (5,'www.pfpresents.com',28800,'A','216.120.59.251',20030621132157);
INSERT INTO pfpresents_com VALUES (8,'www2.pfpresents.com',28800,'A','216.120.59.227',20030803190140);

--
-- Table structure for table 'pinehills_com'
--

CREATE TABLE pinehills_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'pinehills_com'
--


INSERT INTO pinehills_com VALUES (1,'pinehills.com',28800,'A','216.120.60.21',20030621132157);
INSERT INTO pinehills_com VALUES (2,'pinehills.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002092304 14400 3600 604800 28800',20030527100255);
INSERT INTO pinehills_com VALUES (3,'pinehills.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO pinehills_com VALUES (4,'pinehills.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO pinehills_com VALUES (5,'pinehills.com',28800,'MX','10 mail.pinehills.com.',20030504123237);
INSERT INTO pinehills_com VALUES (6,'amail.pinehills.com',28800,'MX','20 mail.interactivate.com.',20030504123237);
INSERT INTO pinehills_com VALUES (7,'localhost.pinehills.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO pinehills_com VALUES (8,'mail.pinehills.com',28800,'A','66.171.71.21',20030504123237);
INSERT INTO pinehills_com VALUES (9,'preview.pinehills.com',28800,'CNAME','dev.interactivate.com.',20030504123237);
INSERT INTO pinehills_com VALUES (10,'updates.pinehills.com',28800,'MX','20 mail.interactivate.com.',20030504123237);
INSERT INTO pinehills_com VALUES (11,'www.pinehills.com',28800,'A','216.120.60.21',20030621132157);
INSERT INTO pinehills_com VALUES (12,'members.pinehills.com',28800,'A','216.143.113.11',20030527100255);
INSERT INTO pinehills_com VALUES (14,'www2.pinehills.com',28800,'A','216.120.59.227',20030803190140);

--
-- Table structure for table 'pinehills_net'
--

CREATE TABLE pinehills_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'pinehills_net'
--


INSERT INTO pinehills_net VALUES (1,'pinehills.net',28800,'A','216.120.60.21',20030621132157);
INSERT INTO pinehills_net VALUES (2,'pinehills.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003042304 14400 3600 604800 28800',20030527100315);
INSERT INTO pinehills_net VALUES (3,'pinehills.net',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO pinehills_net VALUES (4,'pinehills.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO pinehills_net VALUES (5,'pinehills.net',28800,'MX','10 mail.pinehills.net.',20030504123237);
INSERT INTO pinehills_net VALUES (6,'localhost.pinehills.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO pinehills_net VALUES (7,'mail.pinehills.net',28800,'A','216.143.113.11',20030504123237);
INSERT INTO pinehills_net VALUES (8,'support.pinehills.net',28800,'A','216.143.113.11',20030504123237);
INSERT INTO pinehills_net VALUES (9,'www.pinehills.net',28800,'A','216.120.60.21',20030621132157);
INSERT INTO pinehills_net VALUES (10,'members.pinehills.net',28800,'A','216.143.113.11',20030527100315);

--
-- Table structure for table 'playavistaliving_com'
--

CREATE TABLE playavistaliving_com (
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

--
-- Dumping data for table 'playavistaliving_com'
--


INSERT INTO playavistaliving_com VALUES (1,'playavistaliving.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003050901 14400 3600 604800 28800',20030509163109);
INSERT INTO playavistaliving_com VALUES (2,'playavistaliving.com',28800,'NS','icg.interactivate.com.',20030509163109);
INSERT INTO playavistaliving_com VALUES (3,'playavistaliving.com',28800,'NS','ns2.interactivate.com.',20030509163109);
INSERT INTO playavistaliving_com VALUES (4,'playavistaliving.com',28800,'NS','ns3.interactivate.com.',20030509163109);
INSERT INTO playavistaliving_com VALUES (5,'playavistaliving.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO playavistaliving_com VALUES (6,'www.playavistaliving.com',28800,'A','216.120.59.228',20030621132157);

--
-- Table structure for table 'prequalnow_com'
--

CREATE TABLE prequalnow_com (
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

--
-- Dumping data for table 'prequalnow_com'
--


INSERT INTO prequalnow_com VALUES (1,'prequalnow.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003081403 14400 3600 604800 28800',20030814105404);
INSERT INTO prequalnow_com VALUES (2,'prequalnow.com',28800,'NS','icg.interactivate.com.',20030814105349);
INSERT INTO prequalnow_com VALUES (3,'prequalnow.com',28800,'NS','ns2.interactivate.com.',20030814105349);
INSERT INTO prequalnow_com VALUES (4,'prequalnow.com',28800,'NS','ns3.interactivate.com.',20030814105349);
INSERT INTO prequalnow_com VALUES (5,'prequalnow.com',28800,'A','216.120.60.11',20030814105356);
INSERT INTO prequalnow_com VALUES (6,'www.prequalnow.com',28800,'A','216.120.60.11',20030814105404);

--
-- Table structure for table 'prideoflyon_com'
--

CREATE TABLE prideoflyon_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'prideoflyon_com'
--


INSERT INTO prideoflyon_com VALUES (1,'prideoflyon.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123237);
INSERT INTO prideoflyon_com VALUES (2,'prideoflyon.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO prideoflyon_com VALUES (3,'prideoflyon.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO prideoflyon_com VALUES (4,'prideoflyon.com',28800,'MX','10 mail.prideoflyon.com.',20030504123237);
INSERT INTO prideoflyon_com VALUES (5,'localhost.prideoflyon.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO prideoflyon_com VALUES (6,'mail.prideoflyon.com',28800,'A','12.13.12.99',20030504123237);
INSERT INTO prideoflyon_com VALUES (7,'www.prideoflyon.com',28800,'A','216.120.60.22',20030621132157);

--
-- Table structure for table 'provenselections_biz'
--

CREATE TABLE provenselections_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenselections_biz'
--


INSERT INTO provenselections_biz VALUES (1,'provenselections.biz',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenselections_biz VALUES (2,'provenselections.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenselections_biz VALUES (3,'provenselections.biz',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenselections_biz VALUES (4,'provenselections.biz',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenselections_biz VALUES (5,'provenselections.biz',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenselections_biz VALUES (6,'localhost.provenselections.biz',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenselections_biz VALUES (7,'www.provenselections.biz',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenselections_com'
--

CREATE TABLE provenselections_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenselections_com'
--


INSERT INTO provenselections_com VALUES (1,'provenselections.com',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenselections_com VALUES (2,'provenselections.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenselections_com VALUES (3,'provenselections.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenselections_com VALUES (4,'provenselections.com',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenselections_com VALUES (5,'provenselections.com',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenselections_com VALUES (6,'localhost.provenselections.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenselections_com VALUES (7,'www.provenselections.com',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenselections_info'
--

CREATE TABLE provenselections_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenselections_info'
--


INSERT INTO provenselections_info VALUES (1,'provenselections.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenselections_info VALUES (2,'provenselections.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenselections_info VALUES (3,'provenselections.info',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenselections_info VALUES (4,'provenselections.info',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenselections_info VALUES (5,'provenselections.info',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenselections_info VALUES (6,'localhost.provenselections.info',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenselections_info VALUES (7,'www.provenselections.info',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenselections_net'
--

CREATE TABLE provenselections_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenselections_net'
--


INSERT INTO provenselections_net VALUES (1,'provenselections.net',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenselections_net VALUES (2,'provenselections.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenselections_net VALUES (3,'provenselections.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenselections_net VALUES (4,'provenselections.net',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenselections_net VALUES (5,'provenselections.net',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenselections_net VALUES (6,'localhost.provenselections.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenselections_net VALUES (7,'www.provenselections.net',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenselections_org'
--

CREATE TABLE provenselections_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenselections_org'
--


INSERT INTO provenselections_org VALUES (1,'provenselections.org',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenselections_org VALUES (2,'provenselections.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenselections_org VALUES (3,'provenselections.org',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenselections_org VALUES (4,'provenselections.org',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenselections_org VALUES (5,'provenselections.org',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenselections_org VALUES (6,'localhost.provenselections.org',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenselections_org VALUES (7,'www.provenselections.org',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenwinners_info'
--

CREATE TABLE provenwinners_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenwinners_info'
--


INSERT INTO provenwinners_info VALUES (1,'provenwinners.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenwinners_info VALUES (2,'provenwinners.info',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenwinners_info VALUES (3,'provenwinners.info',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO provenwinners_info VALUES (4,'provenwinners.info',28800,'NS','ns3.interactivate.com.',20030504123237);
INSERT INTO provenwinners_info VALUES (5,'provenwinners.info',28800,'A','216.120.60.14',20030621132157);
INSERT INTO provenwinners_info VALUES (6,'www.provenwinners.info',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenwinners_net'
--

CREATE TABLE provenwinners_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenwinners_net'
--


INSERT INTO provenwinners_net VALUES (1,'provenwinners.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002022603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenwinners_net VALUES (2,'provenwinners.net',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO provenwinners_net VALUES (3,'provenwinners.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenwinners_net VALUES (4,'localhost.provenwinners.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenwinners_net VALUES (5,'www.provenwinners.net',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'provenwinners_org'
--

CREATE TABLE provenwinners_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'provenwinners_org'
--


INSERT INTO provenwinners_org VALUES (1,'provenwinners.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002022603 14400 3600 604800 28800',20030504123237);
INSERT INTO provenwinners_org VALUES (2,'provenwinners.org',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO provenwinners_org VALUES (3,'provenwinners.org',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO provenwinners_org VALUES (4,'localhost.provenwinners.org',28800,'A','127.0.0.1',20030504123237);
INSERT INTO provenwinners_org VALUES (5,'www.provenwinners.org',28800,'A','216.120.60.14',20030621132157);

--
-- Table structure for table 'ranchocarillo_biz'
--

CREATE TABLE ranchocarillo_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchocarillo_biz'
--


INSERT INTO ranchocarillo_biz VALUES (1,'ranchocarillo.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (2,'ranchocarillo.biz',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (3,'ranchocarillo.biz',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (4,'ranchocarillo.biz',28800,'MX','100 relay1.hlc.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (5,'ranchocarillo.biz',28800,'MX','200 relay2.hlc.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (6,'ranchocarillo.biz',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarillo_biz VALUES (7,'localhost.ranchocarillo.biz',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (8,'mail.ranchocarillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (9,'news.ranchocarillo.biz',28800,'CNAME','news.eni.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (10,'pop.ranchocarillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (11,'smtp.ranchocarillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillo_biz VALUES (12,'www.ranchocarillo.biz',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'ranchocarillohomes_biz'
--

CREATE TABLE ranchocarillohomes_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchocarillohomes_biz'
--


INSERT INTO ranchocarillohomes_biz VALUES (1,'ranchocarillohomes.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (2,'ranchocarillohomes.biz',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (3,'ranchocarillohomes.biz',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (4,'ranchocarillohomes.biz',28800,'MX','100 relay1.hlc.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (5,'ranchocarillohomes.biz',28800,'MX','200 relay2.hlc.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (6,'ranchocarillohomes.biz',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarillohomes_biz VALUES (7,'localhost.ranchocarillohomes.biz',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (8,'mail.ranchocarillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (9,'news.ranchocarillohomes.biz',28800,'CNAME','news.eni.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (10,'pop.ranchocarillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (11,'smtp.ranchocarillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarillohomes_biz VALUES (12,'www.ranchocarillohomes.biz',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'ranchocarrillo_biz'
--

CREATE TABLE ranchocarrillo_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchocarrillo_biz'
--


INSERT INTO ranchocarrillo_biz VALUES (1,'ranchocarrillo.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (2,'ranchocarrillo.biz',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (3,'ranchocarrillo.biz',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (4,'ranchocarrillo.biz',28800,'MX','100 relay1.hlc.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (5,'ranchocarrillo.biz',28800,'MX','200 relay2.hlc.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (6,'ranchocarrillo.biz',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarrillo_biz VALUES (7,'localhost.ranchocarrillo.biz',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (8,'mail.ranchocarrillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (9,'news.ranchocarrillo.biz',28800,'CNAME','news.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (10,'pop.ranchocarrillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (11,'smtp.ranchocarrillo.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_biz VALUES (12,'www.ranchocarrillo.biz',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'ranchocarrillo_com'
--

CREATE TABLE ranchocarrillo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchocarrillo_com'
--


INSERT INTO ranchocarrillo_com VALUES (1,'ranchocarrillo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (2,'ranchocarrillo.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (3,'ranchocarrillo.com',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (4,'ranchocarrillo.com',28800,'MX','100 relay1.hlc.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (5,'ranchocarrillo.com',28800,'MX','200 relay2.hlc.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (6,'ranchocarrillo.com',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarrillo_com VALUES (7,'localhost.ranchocarrillo.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (8,'mail.ranchocarrillo.com',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (9,'news.ranchocarrillo.com',28800,'CNAME','news.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (10,'pop.ranchocarrillo.com',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (11,'smtp.ranchocarrillo.com',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillo_com VALUES (12,'www.ranchocarrillo.com',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarrillo_com VALUES (15,'www2.ranchocarrillo.com',28800,'A','216.120.59.227',20030803190142);

--
-- Table structure for table 'ranchocarrillohomes_biz'
--

CREATE TABLE ranchocarrillohomes_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchocarrillohomes_biz'
--


INSERT INTO ranchocarrillohomes_biz VALUES (1,'ranchocarrillohomes.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (2,'ranchocarrillohomes.biz',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (3,'ranchocarrillohomes.biz',28800,'NS','ns2.interactivate.com.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (4,'ranchocarrillohomes.biz',28800,'MX','100 relay1.hlc.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (5,'ranchocarrillohomes.biz',28800,'MX','200 relay2.hlc.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (6,'ranchocarrillohomes.biz',28800,'A','216.120.59.235',20030621132157);
INSERT INTO ranchocarrillohomes_biz VALUES (7,'localhost.ranchocarrillohomes.biz',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (8,'mail.ranchocarrillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (9,'news.ranchocarrillohomes.biz',28800,'CNAME','news.eni.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (10,'pop.ranchocarrillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (11,'smtp.ranchocarrillohomes.biz',28800,'CNAME','pop.eni.net.',20030504123237);
INSERT INTO ranchocarrillohomes_biz VALUES (12,'www.ranchocarrillohomes.biz',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'ranchomissionviejo_cc'
--

CREATE TABLE ranchomissionviejo_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejo_cc'
--


INSERT INTO ranchomissionviejo_cc VALUES (1,'ranchomissionviejo.cc',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejo_cc VALUES (2,'ranchomissionviejo.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002090303 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchomissionviejo_cc VALUES (3,'ranchomissionviejo.cc',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO ranchomissionviejo_cc VALUES (4,'ranchomissionviejo.cc',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_cc VALUES (5,'ranchomissionviejo.cc',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_cc VALUES (6,'localhost.ranchomissionviejo.cc',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchomissionviejo_cc VALUES (7,'www.ranchomissionviejo.cc',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejo_com'
--

CREATE TABLE ranchomissionviejo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejo_com'
--


INSERT INTO ranchomissionviejo_com VALUES (1,'ranchomissionviejo.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejo_com VALUES (2,'ranchomissionviejo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002091003 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (3,'ranchomissionviejo.com',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (4,'ranchomissionviejo.com',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (5,'ranchomissionviejo.com',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (6,'amail.ranchomissionviejo.com',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (7,'localhost.ranchomissionviejo.com',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (8,'updates.ranchomissionviejo.com',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_com VALUES (9,'www.ranchomissionviejo.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejo_com VALUES (11,'www2.ranchomissionviejo.com',28800,'A','216.120.59.227',20030803190143);

--
-- Table structure for table 'ranchomissionviejo_net'
--

CREATE TABLE ranchomissionviejo_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejo_net'
--


INSERT INTO ranchomissionviejo_net VALUES (1,'ranchomissionviejo.net',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejo_net VALUES (2,'ranchomissionviejo.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002090303 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchomissionviejo_net VALUES (3,'ranchomissionviejo.net',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO ranchomissionviejo_net VALUES (4,'ranchomissionviejo.net',28800,'NS','icg.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_net VALUES (5,'ranchomissionviejo.net',28800,'MX','10 mail.interactivate.com.',20030504123237);
INSERT INTO ranchomissionviejo_net VALUES (6,'localhost.ranchomissionviejo.net',28800,'A','127.0.0.1',20030504123237);
INSERT INTO ranchomissionviejo_net VALUES (7,'www.ranchomissionviejo.net',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejo_org'
--

CREATE TABLE ranchomissionviejo_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejo_org'
--


INSERT INTO ranchomissionviejo_org VALUES (1,'ranchomissionviejo.org',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejo_org VALUES (2,'ranchomissionviejo.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002090303 14400 3600 604800 28800',20030504123237);
INSERT INTO ranchomissionviejo_org VALUES (3,'ranchomissionviejo.org',28800,'NS','ns.connectnet.com.',20030504123237);
INSERT INTO ranchomissionviejo_org VALUES (4,'ranchomissionviejo.org',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejo_org VALUES (5,'ranchomissionviejo.org',28800,'MX','10 mail.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejo_org VALUES (6,'localhost.ranchomissionviejo.org',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchomissionviejo_org VALUES (7,'www.ranchomissionviejo.org',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejolandpreserve_com'
--

CREATE TABLE ranchomissionviejolandpreserve_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejolandpreserve_com'
--


INSERT INTO ranchomissionviejolandpreserve_com VALUES (1,'ranchomissionviejolandpreserve.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejolandpreserve_com VALUES (2,'ranchomissionviejolandpreserve.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO ranchomissionviejolandpreserve_com VALUES (3,'ranchomissionviejolandpreserve.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO ranchomissionviejolandpreserve_com VALUES (4,'ranchomissionviejolandpreserve.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejolandpreserve_com VALUES (5,'localhost.ranchomissionviejolandpreserve.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchomissionviejolandpreserve_com VALUES (6,'www.ranchomissionviejolandpreserve.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejolandtrust_cc'
--

CREATE TABLE ranchomissionviejolandtrust_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejolandtrust_cc'
--


INSERT INTO ranchomissionviejolandtrust_cc VALUES (1,'ranchomissionviejolandtrust.cc',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejolandtrust_cc VALUES (2,'ranchomissionviejolandtrust.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO ranchomissionviejolandtrust_cc VALUES (3,'ranchomissionviejolandtrust.cc',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_cc VALUES (4,'ranchomissionviejolandtrust.cc',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_cc VALUES (5,'localhost.ranchomissionviejolandtrust.cc',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchomissionviejolandtrust_cc VALUES (6,'www.ranchomissionviejolandtrust.cc',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejolandtrust_com'
--

CREATE TABLE ranchomissionviejolandtrust_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejolandtrust_com'
--


INSERT INTO ranchomissionviejolandtrust_com VALUES (1,'ranchomissionviejolandtrust.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejolandtrust_com VALUES (2,'ranchomissionviejolandtrust.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO ranchomissionviejolandtrust_com VALUES (3,'ranchomissionviejolandtrust.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_com VALUES (4,'ranchomissionviejolandtrust.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_com VALUES (5,'localhost.ranchomissionviejolandtrust.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchomissionviejolandtrust_com VALUES (6,'www.ranchomissionviejolandtrust.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchomissionviejolandtrust_net'
--

CREATE TABLE ranchomissionviejolandtrust_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchomissionviejolandtrust_net'
--


INSERT INTO ranchomissionviejolandtrust_net VALUES (1,'ranchomissionviejolandtrust.net',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchomissionviejolandtrust_net VALUES (2,'ranchomissionviejolandtrust.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO ranchomissionviejolandtrust_net VALUES (3,'ranchomissionviejolandtrust.net',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_net VALUES (4,'ranchomissionviejolandtrust.net',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchomissionviejolandtrust_net VALUES (5,'localhost.ranchomissionviejolandtrust.net',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchomissionviejolandtrust_net VALUES (6,'www.ranchomissionviejolandtrust.net',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'ranchopenspace_com'
--

CREATE TABLE ranchopenspace_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'ranchopenspace_com'
--


INSERT INTO ranchopenspace_com VALUES (1,'ranchopenspace.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO ranchopenspace_com VALUES (2,'ranchopenspace.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO ranchopenspace_com VALUES (3,'ranchopenspace.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO ranchopenspace_com VALUES (4,'ranchopenspace.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO ranchopenspace_com VALUES (5,'localhost.ranchopenspace.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO ranchopenspace_com VALUES (6,'www.ranchopenspace.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'readypac_biz'
--

CREATE TABLE readypac_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'readypac_biz'
--


INSERT INTO readypac_biz VALUES (1,'readypac.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123238);
INSERT INTO readypac_biz VALUES (2,'readypac.biz',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO readypac_biz VALUES (3,'readypac.biz',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO readypac_biz VALUES (4,'localhost.readypac.biz',28800,'A','127.0.0.1',20030504123238);
INSERT INTO readypac_biz VALUES (5,'localhost.readypac.biz',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypac_biz VALUES (6,'www.readypac.biz',28800,'A','216.120.59.247',20030621132157);

--
-- Table structure for table 'readypac_info'
--

CREATE TABLE readypac_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'readypac_info'
--


INSERT INTO readypac_info VALUES (1,'readypac.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123238);
INSERT INTO readypac_info VALUES (2,'readypac.info',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO readypac_info VALUES (3,'readypac.info',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO readypac_info VALUES (4,'localhost.readypac.info',28800,'A','127.0.0.1',20030504123238);
INSERT INTO readypac_info VALUES (5,'localhost.readypac.info',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypac_info VALUES (6,'www.readypac.info',28800,'A','216.120.59.247',20030621132157);

--
-- Table structure for table 'readypacproduce_biz'
--

CREATE TABLE readypacproduce_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'readypacproduce_biz'
--


INSERT INTO readypacproduce_biz VALUES (1,'readypacproduce.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123238);
INSERT INTO readypacproduce_biz VALUES (2,'readypacproduce.biz',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO readypacproduce_biz VALUES (3,'readypacproduce.biz',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO readypacproduce_biz VALUES (4,'localhost.readypacproduce.biz',28800,'A','127.0.0.1',20030504123238);
INSERT INTO readypacproduce_biz VALUES (5,'localhost.readypacproduce.biz',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypacproduce_biz VALUES (6,'www.readypacproduce.biz',28800,'A','216.120.59.247',20030621132157);

--
-- Table structure for table 'readypacproduce_com'
--

CREATE TABLE readypacproduce_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'readypacproduce_com'
--


INSERT INTO readypacproduce_com VALUES (1,'readypacproduce.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002111704 14400 3600 604800 28800',20030504123238);
INSERT INTO readypacproduce_com VALUES (2,'readypacproduce.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO readypacproduce_com VALUES (3,'readypacproduce.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO readypacproduce_com VALUES (4,'localhost.readypacproduce.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO readypacproduce_com VALUES (5,'localhost.readypacproduce.com',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypacproduce_com VALUES (6,'updates.readypacproduce.com',28800,'MX','10 mail.interactivate.com.',20030504123238);
INSERT INTO readypacproduce_com VALUES (7,'www.readypacproduce.com',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypacproduce_com VALUES (10,'www2.readypacproduce.com',28800,'A','216.120.59.227',20030803190144);

--
-- Table structure for table 'readypacproduce_info'
--

CREATE TABLE readypacproduce_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'readypacproduce_info'
--


INSERT INTO readypacproduce_info VALUES (1,'readypacproduce.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070803 14400 3600 604800 28800',20030504123238);
INSERT INTO readypacproduce_info VALUES (2,'readypacproduce.info',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO readypacproduce_info VALUES (3,'readypacproduce.info',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO readypacproduce_info VALUES (4,'localhost.readypacproduce.info',28800,'A','127.0.0.1',20030504123238);
INSERT INTO readypacproduce_info VALUES (5,'localhost.readypacproduce.info',28800,'A','216.120.59.247',20030621132157);
INSERT INTO readypacproduce_info VALUES (6,'www.readypacproduce.info',28800,'A','216.120.59.247',20030621132157);

--
-- Table structure for table 'rmv_cc'
--

CREATE TABLE rmv_cc (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'rmv_cc'
--


INSERT INTO rmv_cc VALUES (1,'rmv.cc',28800,'A','216.120.60.17',20030621132157);
INSERT INTO rmv_cc VALUES (2,'rmv.cc',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO rmv_cc VALUES (3,'rmv.cc',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO rmv_cc VALUES (4,'rmv.cc',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO rmv_cc VALUES (5,'localhost.rmv.cc',28800,'A','127.0.0.1',20030504123238);
INSERT INTO rmv_cc VALUES (6,'www.rmv.cc',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'rmvcmp_com'
--

CREATE TABLE rmvcmp_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'rmvcmp_com'
--


INSERT INTO rmvcmp_com VALUES (1,'rmvcmp.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO rmvcmp_com VALUES (2,'rmvcmp.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO rmvcmp_com VALUES (3,'rmvcmp.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO rmvcmp_com VALUES (4,'rmvcmp.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO rmvcmp_com VALUES (5,'localhost.rmvcmp.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO rmvcmp_com VALUES (6,'www.rmvcmp.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'rmvconservationmanagementplan_com'
--

CREATE TABLE rmvconservationmanagementplan_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'rmvconservationmanagementplan_com'
--


INSERT INTO rmvconservationmanagementplan_com VALUES (1,'rmvconservationmanagementplan.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO rmvconservationmanagementplan_com VALUES (2,'rmvconservationmanagementplan.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO rmvconservationmanagementplan_com VALUES (3,'rmvconservationmanagementplan.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO rmvconservationmanagementplan_com VALUES (4,'rmvconservationmanagementplan.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO rmvconservationmanagementplan_com VALUES (5,'localhost.rmvconservationmanagementplan.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO rmvconservationmanagementplan_com VALUES (6,'www.rmvconservationmanagementplan.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'rmvlandtrust_com'
--

CREATE TABLE rmvlandtrust_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'rmvlandtrust_com'
--


INSERT INTO rmvlandtrust_com VALUES (1,'rmvlandtrust.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO rmvlandtrust_com VALUES (2,'rmvlandtrust.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO rmvlandtrust_com VALUES (3,'rmvlandtrust.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO rmvlandtrust_com VALUES (4,'rmvlandtrust.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO rmvlandtrust_com VALUES (5,'localhost.rmvlandtrust.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO rmvlandtrust_com VALUES (6,'www.rmvlandtrust.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'rmvrodeo_com'
--

CREATE TABLE rmvrodeo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'rmvrodeo_com'
--


INSERT INTO rmvrodeo_com VALUES (1,'rmvrodeo.com',28800,'SOA','ns.interactivate.com. dns.interactivate.com. 200301170 14400 3600 604800 86400',20030504123238);
INSERT INTO rmvrodeo_com VALUES (2,'rmvrodeo.com',28800,'NS','ns.interactivate.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (3,'rmvrodeo.com',28800,'NS','ns2.interactivate.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (4,'rmvrodeo.com',28800,'MX','50 mail-fwd.dulles19-verio.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (5,'rmvrodeo.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO rmvrodeo_com VALUES (6,'ftp.rmvrodeo.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO rmvrodeo_com VALUES (7,'imap.rmvrodeo.com',28800,'CNAME','imap.interactivate.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (8,'mail.rmvrodeo.com',28800,'CNAME','mail.interactivate.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (9,'pop.rmvrodeo.com',28800,'CNAME','pop.interactivate.com.',20030504123238);
INSERT INTO rmvrodeo_com VALUES (10,'shell.rmvrodeo.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO rmvrodeo_com VALUES (11,'www.rmvrodeo.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO rmvrodeo_com VALUES (13,'www2.rmvrodeo.com',28800,'A','216.120.59.227',20030803190145);

--
-- Table structure for table 'samherman_com'
--

CREATE TABLE samherman_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'samherman_com'
--


INSERT INTO samherman_com VALUES (1,'samherman.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000050804 14400 3600 604800 28800',20030504123238);
INSERT INTO samherman_com VALUES (2,'samherman.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO samherman_com VALUES (3,'samherman.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO samherman_com VALUES (4,'localhost.samherman.com',28800,'A','127.0.0.1',20030504123238);

--
-- Table structure for table 'sandiegozoosucks_com'
--

CREATE TABLE sandiegozoosucks_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sandiegozoosucks_com'
--


INSERT INTO sandiegozoosucks_com VALUES (1,'sandiegozoosucks.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002120203 14400 3600 604800 300',20030504123238);
INSERT INTO sandiegozoosucks_com VALUES (2,'sandiegozoosucks.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sandiegozoosucks_com VALUES (3,'sandiegozoosucks.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sandiegozoosucks_com VALUES (4,'sandiegozoosucks.com',28800,'NS','ns2.interactivate.com.',20030504123238);
INSERT INTO sandiegozoosucks_com VALUES (5,'sandiegozoosucks.com',28800,'MX','100 bongo.sandiegozoo.org.',20030504123238);
INSERT INTO sandiegozoosucks_com VALUES (6,'sandiegozoosucks.com',28800,'A','216.120.88.242',20030621132157);
INSERT INTO sandiegozoosucks_com VALUES (7,'al.sandiegozoosucks.com',28800,'A','216.120.88.244',20030621132157);
INSERT INTO sandiegozoosucks_com VALUES (8,'dev.sandiegozoosucks.com',28800,'A','216.120.88.243',20030621132157);
INSERT INTO sandiegozoosucks_com VALUES (9,'www.sandiegozoosucks.com',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'sandiegozoosucks_org'
--

CREATE TABLE sandiegozoosucks_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sandiegozoosucks_org'
--


INSERT INTO sandiegozoosucks_org VALUES (1,'sandiegozoosucks.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002120203 14400 3600 604800 300',20030504123238);
INSERT INTO sandiegozoosucks_org VALUES (2,'sandiegozoosucks.org',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sandiegozoosucks_org VALUES (3,'sandiegozoosucks.org',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sandiegozoosucks_org VALUES (4,'sandiegozoosucks.org',28800,'NS','ns2.interactivate.com.',20030504123238);
INSERT INTO sandiegozoosucks_org VALUES (5,'sandiegozoosucks.org',28800,'MX','100 bongo.sandiegozoo.org.',20030504123238);
INSERT INTO sandiegozoosucks_org VALUES (6,'sandiegozoosucks.org',28800,'A','216.120.88.242',20030621132157);
INSERT INTO sandiegozoosucks_org VALUES (7,'al.sandiegozoosucks.org',28800,'A','216.120.88.244',20030621132157);
INSERT INTO sandiegozoosucks_org VALUES (8,'dev.sandiegozoosucks.org',28800,'A','216.120.88.243',20030621132157);
INSERT INTO sandiegozoosucks_org VALUES (9,'www.sandiegozoosucks.org',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'sanjuancreekpark_com'
--

CREATE TABLE sanjuancreekpark_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sanjuancreekpark_com'
--


INSERT INTO sanjuancreekpark_com VALUES (1,'sanjuancreekpark.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO sanjuancreekpark_com VALUES (2,'sanjuancreekpark.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO sanjuancreekpark_com VALUES (3,'sanjuancreekpark.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sanjuancreekpark_com VALUES (4,'sanjuancreekpark.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sanjuancreekpark_com VALUES (5,'localhost.sanjuancreekpark.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO sanjuancreekpark_com VALUES (6,'www.sanjuancreekpark.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'sanjuancreekregionalrecreationcorridor_com'
--

CREATE TABLE sanjuancreekregionalrecreationcorridor_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sanjuancreekregionalrecreationcorridor_com'
--


INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (1,'sanjuancreekregionalrecreationcorridor.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (2,'sanjuancreekregionalrecreationcorridor.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123238);
INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (3,'sanjuancreekregionalrecreationcorridor.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (4,'sanjuancreekregionalrecreationcorridor.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (5,'localhost.sanjuancreekregionalrecreationcorridor.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO sanjuancreekregionalrecreationcorridor_com VALUES (6,'www.sanjuancreekregionalrecreationcorridor.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'santaluz_com'
--

CREATE TABLE santaluz_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluz_com'
--


INSERT INTO santaluz_com VALUES (1,'santaluz.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluz_com VALUES (2,'santaluz.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003011005 14400 3600 604800 28800',20030625160147);
INSERT INTO santaluz_com VALUES (3,'santaluz.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluz_com VALUES (4,'santaluz.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluz_com VALUES (5,'santaluz.com',28800,'MX','10 mail.santaluz.com.',20030504123238);
INSERT INTO santaluz_com VALUES (6,'localhost.santaluz.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluz_com VALUES (7,'mail.santaluz.com',28800,'A','66.27.57.252',20030504123238);
INSERT INTO santaluz_com VALUES (8,'mail1.santaluz.com',28800,'A','209.232.177.130',20030504123238);
INSERT INTO santaluz_com VALUES (9,'mail2.santaluz.com',28800,'A','66.27.57.252',20030504123238);
INSERT INTO santaluz_com VALUES (10,'sdts1.santaluz.com',28800,'A','66.27.57.253',20030504123238);
INSERT INTO santaluz_com VALUES (11,'ts1.santaluz.com',28800,'A','64.173.89.11',20030504123238);
INSERT INTO santaluz_com VALUES (12,'updates.santaluz.com',28800,'MX','10 mail.interactivate.com.',20030504123238);
INSERT INTO santaluz_com VALUES (13,'www.santaluz.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluz_com VALUES (15,'www2.santaluz.com',28800,'A','216.120.59.227',20030803190146);

--
-- Table structure for table 'santaluz_net'
--

CREATE TABLE santaluz_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluz_net'
--


INSERT INTO santaluz_net VALUES (1,'santaluz.net',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluz_net VALUES (2,'santaluz.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002040306 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluz_net VALUES (3,'santaluz.net',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluz_net VALUES (4,'santaluz.net',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluz_net VALUES (5,'cybermail.santaluz.net',28800,'A','207.239.241.92',20030504123238);
INSERT INTO santaluz_net VALUES (6,'localhost.santaluz.net',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluz_net VALUES (7,'www.santaluz.net',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluz_org'
--

CREATE TABLE santaluz_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluz_org'
--


INSERT INTO santaluz_org VALUES (1,'santaluz.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003031503 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluz_org VALUES (2,'santaluz.org',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluz_org VALUES (3,'santaluz.org',28800,'NS','ns2.interactivate.com.',20030504123238);
INSERT INTO santaluz_org VALUES (4,'santaluz.org',28800,'NS','ns3.interactivate.com.',20030504123238);
INSERT INTO santaluz_org VALUES (5,'santaluz.org',28800,'MX','10 mail.santaluz.com.',20030504123238);
INSERT INTO santaluz_org VALUES (6,'santaluz.org',28800,'MX','30 mail1.santaluz.com.',20030504123238);
INSERT INTO santaluz_org VALUES (7,'santaluz.org',28800,'MX','100 smtp-relay.pbi.net.',20030504123238);
INSERT INTO santaluz_org VALUES (8,'santaluz.org',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluz_org VALUES (9,'cybermail.santaluz.org',28800,'A','207.239.241.92',20030504123238);
INSERT INTO santaluz_org VALUES (10,'mail.santaluz.org',28800,'A','66.27.49.10',20030504123238);
INSERT INTO santaluz_org VALUES (11,'mail1.santaluz.org',28800,'A','209.232.177.130',20030504123238);
INSERT INTO santaluz_org VALUES (12,'ts1.santaluz.org',28800,'A','64.173.89.11',20030504123238);
INSERT INTO santaluz_org VALUES (13,'www.santaluz.org',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzclub_com'
--

CREATE TABLE santaluzclub_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzclub_com'
--


INSERT INTO santaluzclub_com VALUES (1,'santaluzclub.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072304 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzclub_com VALUES (2,'santaluzclub.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzclub_com VALUES (3,'santaluzclub.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzclub_com VALUES (4,'localhost.santaluzclub.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzclub_com VALUES (5,'localhost.santaluzclub.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzclub_com VALUES (6,'www.santaluzclub.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzcommunity_com'
--

CREATE TABLE santaluzcommunity_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzcommunity_com'
--


INSERT INTO santaluzcommunity_com VALUES (1,'santaluzcommunity.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzcommunity_com VALUES (2,'santaluzcommunity.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzcommunity_com VALUES (3,'santaluzcommunity.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzcommunity_com VALUES (4,'localhost.santaluzcommunity.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzcommunity_com VALUES (5,'localhost.santaluzcommunity.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzcommunity_com VALUES (6,'www.santaluzcommunity.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzcountryhomes_com'
--

CREATE TABLE santaluzcountryhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzcountryhomes_com'
--


INSERT INTO santaluzcountryhomes_com VALUES (1,'santaluzcountryhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzcountryhomes_com VALUES (2,'santaluzcountryhomes.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzcountryhomes_com VALUES (3,'santaluzcountryhomes.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzcountryhomes_com VALUES (4,'localhost.santaluzcountryhomes.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzcountryhomes_com VALUES (5,'localhost.santaluzcountryhomes.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzcountryhomes_com VALUES (6,'www.santaluzcountryhomes.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzcourthomes_com'
--

CREATE TABLE santaluzcourthomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzcourthomes_com'
--


INSERT INTO santaluzcourthomes_com VALUES (1,'santaluzcourthomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzcourthomes_com VALUES (2,'santaluzcourthomes.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzcourthomes_com VALUES (3,'santaluzcourthomes.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzcourthomes_com VALUES (4,'localhost.santaluzcourthomes.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzcourthomes_com VALUES (5,'localhost.santaluzcourthomes.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzcourthomes_com VALUES (6,'www.santaluzcourthomes.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzcustomhomesites_com'
--

CREATE TABLE santaluzcustomhomesites_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzcustomhomesites_com'
--


INSERT INTO santaluzcustomhomesites_com VALUES (1,'santaluzcustomhomesites.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzcustomhomesites_com VALUES (2,'santaluzcustomhomesites.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzcustomhomesites_com VALUES (3,'santaluzcustomhomesites.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzcustomhomesites_com VALUES (4,'localhost.santaluzcustomhomesites.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzcustomhomesites_com VALUES (5,'localhost.santaluzcustomhomesites.com',28800,'A','207.110.61.90',20030504123238);
INSERT INTO santaluzcustomhomesites_com VALUES (6,'www.santaluzcustomhomesites.com',28800,'A','207.110.61.90',20030504123238);

--
-- Table structure for table 'santaluzgardenhomes_com'
--

CREATE TABLE santaluzgardenhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzgardenhomes_com'
--


INSERT INTO santaluzgardenhomes_com VALUES (1,'santaluzgardenhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzgardenhomes_com VALUES (2,'santaluzgardenhomes.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzgardenhomes_com VALUES (3,'santaluzgardenhomes.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzgardenhomes_com VALUES (4,'localhost.santaluzgardenhomes.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzgardenhomes_com VALUES (5,'localhost.santaluzgardenhomes.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzgardenhomes_com VALUES (6,'www.santaluzgardenhomes.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzgolf_com'
--

CREATE TABLE santaluzgolf_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzgolf_com'
--


INSERT INTO santaluzgolf_com VALUES (1,'santaluzgolf.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzgolf_com VALUES (2,'santaluzgolf.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzgolf_com VALUES (3,'santaluzgolf.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzgolf_com VALUES (4,'localhost.santaluzgolf.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzgolf_com VALUES (5,'localhost.santaluzgolf.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzgolf_com VALUES (6,'www.santaluzgolf.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzhaciendassur_com'
--

CREATE TABLE santaluzhaciendassur_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzhaciendassur_com'
--


INSERT INTO santaluzhaciendassur_com VALUES (1,'santaluzhaciendassur.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzhaciendassur_com VALUES (2,'santaluzhaciendassur.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzhaciendassur_com VALUES (3,'santaluzhaciendassur.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzhaciendassur_com VALUES (4,'localhost.santaluzhaciendassur.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzhaciendassur_com VALUES (5,'localhost.santaluzhaciendassur.com',28800,'A','207.110.61.90',20030504123238);
INSERT INTO santaluzhaciendassur_com VALUES (6,'www.santaluzhaciendassur.com',28800,'A','207.110.61.90',20030504123238);

--
-- Table structure for table 'santaluzhomes_com'
--

CREATE TABLE santaluzhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzhomes_com'
--


INSERT INTO santaluzhomes_com VALUES (1,'santaluzhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzhomes_com VALUES (2,'santaluzhomes.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzhomes_com VALUES (3,'santaluzhomes.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzhomes_com VALUES (4,'localhost.santaluzhomes.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzhomes_com VALUES (5,'localhost.santaluzhomes.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzhomes_com VALUES (6,'www.santaluzhomes.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzhouse_com'
--

CREATE TABLE santaluzhouse_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzhouse_com'
--


INSERT INTO santaluzhouse_com VALUES (1,'santaluzhouse.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzhouse_com VALUES (2,'santaluzhouse.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzhouse_com VALUES (3,'santaluzhouse.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzhouse_com VALUES (4,'localhost.santaluzhouse.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzhouse_com VALUES (5,'localhost.santaluzhouse.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzhouse_com VALUES (6,'www.santaluzhouse.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzlife_com'
--

CREATE TABLE santaluzlife_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzlife_com'
--


INSERT INTO santaluzlife_com VALUES (1,'santaluzlife.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzlife_com VALUES (2,'santaluzlife.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002062403 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzlife_com VALUES (3,'santaluzlife.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzlife_com VALUES (4,'santaluzlife.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzlife_com VALUES (5,'santaluzlife.com',28800,'MX','10 mail.santaluz.com.',20030504123238);
INSERT INTO santaluzlife_com VALUES (6,'santaluzlife.com',28800,'MX','30 mail1.santaluz.com.',20030504123238);
INSERT INTO santaluzlife_com VALUES (7,'santaluzlife.com',28800,'MX','100 smtp-relay.pbi.net.',20030504123238);
INSERT INTO santaluzlife_com VALUES (8,'cybermail.santaluzlife.com',28800,'A','207.239.241.92',20030504123238);
INSERT INTO santaluzlife_com VALUES (9,'cybermail.santaluzlife.com',28800,'MX','200 santaluz.unitymail.net.',20030504123238);
INSERT INTO santaluzlife_com VALUES (10,'localhost.santaluzlife.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzlife_com VALUES (11,'mail.santaluzlife.com',28800,'A','66.27.49.10',20030504123238);
INSERT INTO santaluzlife_com VALUES (12,'mail1.santaluzlife.com',28800,'A','209.232.177.130',20030504123238);
INSERT INTO santaluzlife_com VALUES (13,'ts1.santaluzlife.com',28800,'A','64.173.89.11',20030504123238);
INSERT INTO santaluzlife_com VALUES (14,'www.santaluzlife.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzrealestate_com'
--

CREATE TABLE santaluzrealestate_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzrealestate_com'
--


INSERT INTO santaluzrealestate_com VALUES (1,'santaluzrealestate.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzrealestate_com VALUES (2,'santaluzrealestate.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzrealestate_com VALUES (3,'santaluzrealestate.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzrealestate_com VALUES (4,'localhost.santaluzrealestate.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzrealestate_com VALUES (5,'localhost.santaluzrealestate.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzrealestate_com VALUES (6,'www.santaluzrealestate.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzrealty_com'
--

CREATE TABLE santaluzrealty_com (
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

--
-- Dumping data for table 'santaluzrealty_com'
--


INSERT INTO santaluzrealty_com VALUES (1,'santaluzrealty.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003063005 14400 3600 604800 28800',20030630103719);
INSERT INTO santaluzrealty_com VALUES (2,'santaluzrealty.com',28800,'NS','icg.interactivate.com.',20030630101200);
INSERT INTO santaluzrealty_com VALUES (3,'santaluzrealty.com',28800,'NS','ns2.interactivate.com.',20030630101200);
INSERT INTO santaluzrealty_com VALUES (4,'santaluzrealty.com',28800,'NS','ns3.interactivate.com.',20030630101200);
INSERT INTO santaluzrealty_com VALUES (5,'santaluzrealty.com',28800,'A','216.120.59.229',20030630102659);
INSERT INTO santaluzrealty_com VALUES (6,'www.santaluzrealty.com',28800,'A','216.120.59.229',20030630102650);
INSERT INTO santaluzrealty_com VALUES (8,'www2.santaluzrealty.com',28800,'A','216.120.59.227',20030803190200);

--
-- Table structure for table 'santaluzsentinels_com'
--

CREATE TABLE santaluzsentinels_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzsentinels_com'
--


INSERT INTO santaluzsentinels_com VALUES (1,'santaluzsentinels.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzsentinels_com VALUES (2,'santaluzsentinels.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzsentinels_com VALUES (3,'santaluzsentinels.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzsentinels_com VALUES (4,'localhost.santaluzsentinels.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzsentinels_com VALUES (5,'localhost.santaluzsentinels.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzsentinels_com VALUES (6,'www.santaluzsentinels.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'santaluzspanishbungalows_com'
--

CREATE TABLE santaluzspanishbungalows_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'santaluzspanishbungalows_com'
--


INSERT INTO santaluzspanishbungalows_com VALUES (1,'santaluzspanishbungalows.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001072305 14400 3600 604800 28800',20030504123238);
INSERT INTO santaluzspanishbungalows_com VALUES (2,'santaluzspanishbungalows.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO santaluzspanishbungalows_com VALUES (3,'santaluzspanishbungalows.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO santaluzspanishbungalows_com VALUES (4,'localhost.santaluzspanishbungalows.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO santaluzspanishbungalows_com VALUES (5,'localhost.santaluzspanishbungalows.com',28800,'A','216.120.59.239',20030621132157);
INSERT INTO santaluzspanishbungalows_com VALUES (6,'www.santaluzspanishbungalows.com',28800,'A','216.120.59.239',20030621132157);

--
-- Table structure for table 'saveoneillranch_com'
--

CREATE TABLE saveoneillranch_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'saveoneillranch_com'
--


INSERT INTO saveoneillranch_com VALUES (1,'saveoneillranch.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO saveoneillranch_com VALUES (2,'saveoneillranch.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123238);
INSERT INTO saveoneillranch_com VALUES (3,'saveoneillranch.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO saveoneillranch_com VALUES (4,'saveoneillranch.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO saveoneillranch_com VALUES (5,'localhost.saveoneillranch.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO saveoneillranch_com VALUES (6,'www.saveoneillranch.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'scdesigninc_com'
--

CREATE TABLE scdesigninc_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'scdesigninc_com'
--


INSERT INTO scdesigninc_com VALUES (1,'scdesigninc.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002062607 14400 3600 604800 60',20030504123238);
INSERT INTO scdesigninc_com VALUES (2,'scdesigninc.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO scdesigninc_com VALUES (3,'scdesigninc.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO scdesigninc_com VALUES (4,'scdesigninc.com',28800,'A','216.120.60.16',20030621132157);
INSERT INTO scdesigninc_com VALUES (5,'scdesigninc.com',28800,'MX','5 mail1.scdesigninc.com.',20030504123238);
INSERT INTO scdesigninc_com VALUES (6,'scdesigninc.com',28800,'MX','10 mail.scdesigninc.com.',20030504123238);
INSERT INTO scdesigninc_com VALUES (7,'scdesigninc.com',28800,'MX','20 smtp-relay.pbi.net.',20030504123238);
INSERT INTO scdesigninc_com VALUES (8,'apps.scdesigninc.com',28800,'A','216.70.243.132',20030504123238);
INSERT INTO scdesigninc_com VALUES (9,'localhost.scdesigninc.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO scdesigninc_com VALUES (10,'mail.scdesigninc.com',28800,'A','67.116.205.35',20030504123238);
INSERT INTO scdesigninc_com VALUES (11,'mail1.scdesigninc.com',28800,'A','216.70.243.131',20030504123238);
INSERT INTO scdesigninc_com VALUES (12,'www.scdesigninc.com',28800,'A','216.120.60.16',20030621132157);
INSERT INTO scdesigninc_com VALUES (14,'www2.scdesigninc.com',28800,'A','216.120.59.227',20030803190149);

--
-- Table structure for table 'sdballpark_com'
--

CREATE TABLE sdballpark_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sdballpark_com'
--


INSERT INTO sdballpark_com VALUES (1,'sdballpark.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO sdballpark_com VALUES (2,'sdballpark.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002062106 14400 3600 604800 28800',20030504123238);
INSERT INTO sdballpark_com VALUES (3,'sdballpark.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sdballpark_com VALUES (4,'sdballpark.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sdballpark_com VALUES (5,'localhost.sdballpark.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO sdballpark_com VALUES (6,'test.sdballpark.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO sdballpark_com VALUES (7,'www.sdballpark.com',28800,'A','216.120.60.15',20030621132157);
INSERT INTO sdballpark_com VALUES (9,'www2.sdballpark.com',28800,'A','216.120.59.227',20030803190149);

--
-- Table structure for table 'sdsushi_com'
--

CREATE TABLE sdsushi_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sdsushi_com'
--


INSERT INTO sdsushi_com VALUES (1,'sdsushi.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123238);
INSERT INTO sdsushi_com VALUES (2,'sdsushi.com',28800,'NS','ns.connectnet.com.',20030504123238);
INSERT INTO sdsushi_com VALUES (3,'sdsushi.com',28800,'NS','icg.interactivate.com.',20030504123238);
INSERT INTO sdsushi_com VALUES (4,'localhost.sdsushi.com',28800,'A','127.0.0.1',20030504123238);
INSERT INTO sdsushi_com VALUES (5,'localhost.sdsushi.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO sdsushi_com VALUES (6,'www.sdsushi.com',28800,'A','216.120.60.7',20030621132157);

--
-- Table structure for table 'seacountryhome_com'
--

CREATE TABLE seacountryhome_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'seacountryhome_com'
--


INSERT INTO seacountryhome_com VALUES (1,'seacountryhome.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071004 14400 3600 604800 300',20030504123239);
INSERT INTO seacountryhome_com VALUES (2,'seacountryhome.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO seacountryhome_com VALUES (3,'seacountryhome.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO seacountryhome_com VALUES (4,'seacountryhome.com',28800,'MX','10 mail.seacountryhome.com.',20030504123239);
INSERT INTO seacountryhome_com VALUES (5,'ftp.seacountryhome.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhome_com VALUES (6,'localhost.seacountryhome.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO seacountryhome_com VALUES (7,'localhost.seacountryhome.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhome_com VALUES (8,'mail.seacountryhome.com',28800,'A','209.76.235.6',20030504123239);
INSERT INTO seacountryhome_com VALUES (9,'www.seacountryhome.com',28800,'A','216.120.60.3',20030621132157);

--
-- Table structure for table 'seacountryhomes_biz'
--

CREATE TABLE seacountryhomes_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'seacountryhomes_biz'
--


INSERT INTO seacountryhomes_biz VALUES (1,'seacountryhomes.biz',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_biz VALUES (2,'seacountryhomes.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071003 14400 3600 604800 300',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (3,'seacountryhomes.biz',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (4,'seacountryhomes.biz',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (5,'seacountryhomes.biz',28800,'MX','10 mail.seacountryhomes.biz.',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (6,'ftp.seacountryhomes.biz',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_biz VALUES (7,'localhost.seacountryhomes.biz',28800,'A','127.0.0.1',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (8,'mail.seacountryhomes.biz',28800,'A','209.76.235.6',20030504123239);
INSERT INTO seacountryhomes_biz VALUES (9,'www.seacountryhomes.biz',28800,'A','216.120.60.3',20030621132157);

--
-- Table structure for table 'seacountryhomes_com'
--

CREATE TABLE seacountryhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'seacountryhomes_com'
--


INSERT INTO seacountryhomes_com VALUES (1,'seacountryhomes.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_com VALUES (2,'seacountryhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 200109108 14400 3600 604800 300',20030602105242);
INSERT INTO seacountryhomes_com VALUES (3,'seacountryhomes.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO seacountryhomes_com VALUES (4,'seacountryhomes.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO seacountryhomes_com VALUES (5,'seacountryhomes.com',28800,'MX','10 mail.seacountryhomes.com.',20030504123239);
INSERT INTO seacountryhomes_com VALUES (15,'smtp.seacountryhomes.com',28800,'A','67.105.118.66',20030530121704);
INSERT INTO seacountryhomes_com VALUES (7,'ftp.seacountryhomes.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_com VALUES (8,'localhost.seacountryhomes.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO seacountryhomes_com VALUES (9,'mail.seacountryhomes.com',28800,'A','67.105.118.66',20030602105242);
INSERT INTO seacountryhomes_com VALUES (10,'updates.seacountryhomes.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO seacountryhomes_com VALUES (11,'www.seacountryhomes.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_com VALUES (20,'www2.seacountryhomes.com',28800,'A','216.120.59.227',20030803190150);
INSERT INTO seacountryhomes_com VALUES (13,'brokers.seacountryhomes.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_com VALUES (14,'broker.seacountryhomes.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_com VALUES (16,'seacountryhomes.com',28800,'MX','20 smtp.seacountryhomes.com.',20030530121729);
INSERT INTO seacountryhomes_com VALUES (17,'seacountryhomes.com',28800,'MX','30 mail.mathewsmachinery.com.',20030530124302);
INSERT INTO seacountryhomes_com VALUES (18,'seacountry.seacountryhomes.com',28800,'A','67.105.118.66',20030530124641);

--
-- Table structure for table 'seacountryhomes_info'
--

CREATE TABLE seacountryhomes_info (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'seacountryhomes_info'
--


INSERT INTO seacountryhomes_info VALUES (1,'seacountryhomes.info',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071003 14400 3600 604800 300',20030504123239);
INSERT INTO seacountryhomes_info VALUES (2,'seacountryhomes.info',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO seacountryhomes_info VALUES (3,'seacountryhomes.info',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO seacountryhomes_info VALUES (4,'seacountryhomes.info',28800,'MX','10 mail.seacountryhomes.info.',20030504123239);
INSERT INTO seacountryhomes_info VALUES (5,'ftp.seacountryhomes.info',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_info VALUES (6,'localhost.seacountryhomes.info',28800,'A','127.0.0.1',20030504123239);
INSERT INTO seacountryhomes_info VALUES (7,'localhost.seacountryhomes.info',28800,'A','216.120.60.3',20030621132157);
INSERT INTO seacountryhomes_info VALUES (8,'mail.seacountryhomes.info',28800,'A','209.76.235.6',20030504123239);
INSERT INTO seacountryhomes_info VALUES (9,'www.seacountryhomes.info',28800,'A','216.120.60.3',20030621132157);

--
-- Table structure for table 'shopzoo_net'
--

CREATE TABLE shopzoo_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'shopzoo_net'
--


INSERT INTO shopzoo_net VALUES (1,'shopzoo.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000050106 14400 3600 604800 28800',20030504123239);
INSERT INTO shopzoo_net VALUES (2,'shopzoo.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO shopzoo_net VALUES (3,'shopzoo.net',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO shopzoo_net VALUES (4,'localhost.shopzoo.net',28800,'A','127.0.0.1',20030504123239);
INSERT INTO shopzoo_net VALUES (5,'www.shopzoo.net',28800,'A','209.242.137.181',20030504123239);

--
-- Table structure for table 'shopzoo_org'
--

CREATE TABLE shopzoo_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'shopzoo_org'
--


INSERT INTO shopzoo_org VALUES (1,'shopzoo.org',28800,'A','207.242.137.181',20030504123239);
INSERT INTO shopzoo_org VALUES (2,'shopzoo.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2000092504 14400 3600 604800 28800',20030504123239);
INSERT INTO shopzoo_org VALUES (3,'shopzoo.org',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO shopzoo_org VALUES (4,'shopzoo.org',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO shopzoo_org VALUES (5,'localhost.shopzoo.org',28800,'A','127.0.0.1',20030504123239);
INSERT INTO shopzoo_org VALUES (6,'www.shopzoo.org',28800,'A','209.242.137.181',20030504123239);

--
-- Table structure for table 'silverleaf_com'
--

CREATE TABLE silverleaf_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'silverleaf_com'
--


INSERT INTO silverleaf_com VALUES (1,'silverleaf.com',28800,'A','216.120.60.25',20030621132157);
INSERT INTO silverleaf_com VALUES (2,'silverleaf.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003039103 14400 3600 604800 28800',20030504123239);
INSERT INTO silverleaf_com VALUES (3,'silverleaf.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO silverleaf_com VALUES (4,'silverleaf.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO silverleaf_com VALUES (5,'silverleaf.com',28800,'NS','ns3.interactivate.com.',20030504123239);
INSERT INTO silverleaf_com VALUES (6,'silverleaf.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO silverleaf_com VALUES (7,'updates.silverleaf.com',28800,'MX','30 mail.interactivate.com.',20030504123239);
INSERT INTO silverleaf_com VALUES (8,'updates.silverleaf.com',28800,'A','216.120.60.25',20030621132157);
INSERT INTO silverleaf_com VALUES (9,'www.silverleaf.com',28800,'A','216.120.60.25',20030621132157);
INSERT INTO silverleaf_com VALUES (11,'www2.silverleaf.com',28800,'A','216.120.59.227',20030803190151);

--
-- Table structure for table 'simplesalad_com'
--

CREATE TABLE simplesalad_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'simplesalad_com'
--


INSERT INTO simplesalad_com VALUES (1,'simplesalad.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123239);
INSERT INTO simplesalad_com VALUES (2,'simplesalad.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO simplesalad_com VALUES (3,'simplesalad.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO simplesalad_com VALUES (4,'simplesalad.com',28800,'MX','10 mail.avocado.org.',20030504123239);
INSERT INTO simplesalad_com VALUES (5,'simplesalad.com',28800,'MX','20 relay1.eni.net.',20030504123239);
INSERT INTO simplesalad_com VALUES (6,'simplesalad.com',28800,'A','216.120.59.246',20030621132157);
INSERT INTO simplesalad_com VALUES (7,'localhost.simplesalad.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO simplesalad_com VALUES (8,'www.simplesalad.com',28800,'A','216.120.59.246',20030621132157);
INSERT INTO simplesalad_com VALUES (11,'www2.simplesalad.com',28800,'A','216.120.59.227',20030803190151);

--
-- Table structure for table 'sirenakids_com'
--

CREATE TABLE sirenakids_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sirenakids_com'
--


INSERT INTO sirenakids_com VALUES (1,'sirenakids.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO sirenakids_com VALUES (2,'sirenakids.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO sirenakids_com VALUES (3,'sirenakids.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO sirenakids_com VALUES (4,'localhost.sirenakids.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO sirenakids_com VALUES (5,'www.sirenakids.com',28800,'A','207.110.42.223',20030504123239);

--
-- Table structure for table 'sirenaswim_com'
--

CREATE TABLE sirenaswim_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sirenaswim_com'
--


INSERT INTO sirenaswim_com VALUES (1,'sirenaswim.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO sirenaswim_com VALUES (2,'sirenaswim.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO sirenaswim_com VALUES (3,'sirenaswim.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO sirenaswim_com VALUES (4,'localhost.sirenaswim.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO sirenaswim_com VALUES (5,'www.sirenaswim.com',28800,'A','207.110.42.223',20030504123239);

--
-- Table structure for table 'stallionscrossing_com'
--

CREATE TABLE stallionscrossing_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'stallionscrossing_com'
--


INSERT INTO stallionscrossing_com VALUES (1,'stallionscrossing.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002022103 14400 3600 604800 300',20030504123239);
INSERT INTO stallionscrossing_com VALUES (2,'stallionscrossing.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO stallionscrossing_com VALUES (3,'stallionscrossing.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO stallionscrossing_com VALUES (4,'stallionscrossing.com',28800,'MX','10 mail.stallionscrossing.com.',20030504123239);
INSERT INTO stallionscrossing_com VALUES (5,'ftp.stallionscrossing.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO stallionscrossing_com VALUES (6,'localhost.stallionscrossing.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO stallionscrossing_com VALUES (7,'localhost.stallionscrossing.com',28800,'A','216.120.60.3',20030621132157);
INSERT INTO stallionscrossing_com VALUES (8,'mail.stallionscrossing.com',28800,'A','209.76.235.6',20030504123239);
INSERT INTO stallionscrossing_com VALUES (9,'www.stallionscrossing.com',28800,'A','216.120.60.3',20030621132157);

--
-- Table structure for table 'summerlane_net'
--

CREATE TABLE summerlane_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'summerlane_net'
--


INSERT INTO summerlane_net VALUES (1,'summerlane.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO summerlane_net VALUES (2,'summerlane.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO summerlane_net VALUES (3,'summerlane.net',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO summerlane_net VALUES (4,'localhost.summerlane.net',28800,'A','127.0.0.1',20030504123239);

--
-- Table structure for table 'summerlanehomes_com'
--

CREATE TABLE summerlanehomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'summerlanehomes_com'
--


INSERT INTO summerlanehomes_com VALUES (1,'summerlanehomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999061003 14400 3600 604800 28800',20030504123239);
INSERT INTO summerlanehomes_com VALUES (2,'summerlanehomes.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO summerlanehomes_com VALUES (3,'summerlanehomes.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO summerlanehomes_com VALUES (4,'localhost.summerlanehomes.com',28800,'A','127.0.0.1',20030504123239);

--
-- Table structure for table 'surveyorsource_com'
--

CREATE TABLE surveyorsource_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'surveyorsource_com'
--


INSERT INTO surveyorsource_com VALUES (1,'surveyorsource.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO surveyorsource_com VALUES (2,'surveyorsource.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO surveyorsource_com VALUES (3,'surveyorsource.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO surveyorsource_com VALUES (4,'localhost.surveyorsource.com',28800,'A','127.0.0.1',20030504123239);

--
-- Table structure for table 'sushideli2_com'
--

CREATE TABLE sushideli2_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sushideli2_com'
--


INSERT INTO sushideli2_com VALUES (1,'sushideli2.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123239);
INSERT INTO sushideli2_com VALUES (2,'sushideli2.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO sushideli2_com VALUES (3,'sushideli2.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO sushideli2_com VALUES (4,'localhost.sushideli2.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO sushideli2_com VALUES (5,'localhost.sushideli2.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO sushideli2_com VALUES (6,'www.sushideli2.com',28800,'A','216.120.60.7',20030621132157);

--
-- Table structure for table 'sushidelitoo_com'
--

CREATE TABLE sushidelitoo_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sushidelitoo_com'
--


INSERT INTO sushidelitoo_com VALUES (1,'sushidelitoo.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123239);
INSERT INTO sushidelitoo_com VALUES (2,'sushidelitoo.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO sushidelitoo_com VALUES (3,'sushidelitoo.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO sushidelitoo_com VALUES (4,'localhost.sushidelitoo.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO sushidelitoo_com VALUES (5,'localhost.sushidelitoo.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO sushidelitoo_com VALUES (6,'www.sushidelitoo.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO sushidelitoo_com VALUES (9,'www2.sushidelitoo.com',28800,'A','216.120.59.227',20030803190152);

--
-- Table structure for table 'sushisandiego_com'
--

CREATE TABLE sushisandiego_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'sushisandiego_com'
--


INSERT INTO sushisandiego_com VALUES (1,'sushisandiego.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001071204 14400 3600 604800 28800',20030504123239);
INSERT INTO sushisandiego_com VALUES (2,'sushisandiego.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO sushisandiego_com VALUES (3,'sushisandiego.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO sushisandiego_com VALUES (4,'localhost.sushisandiego.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO sushisandiego_com VALUES (5,'localhost.sushisandiego.com',28800,'A','216.120.60.7',20030621132157);
INSERT INTO sushisandiego_com VALUES (6,'www.sushisandiego.com',28800,'A','216.120.60.7',20030621132157);

--
-- Table structure for table 'talega_com'
--

CREATE TABLE talega_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'talega_com'
--


INSERT INTO talega_com VALUES (1,'talega.com',300,'A','216.120.59.243',20030729011509);
INSERT INTO talega_com VALUES (2,'talega.com',300,'SOA','ns.interactivate.com. dns.interactivate.com. 200304234 14400 3600 604800 86400',20030729011517);
INSERT INTO talega_com VALUES (3,'talega.com',300,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (4,'talega.com',300,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (5,'talega.com',300,'NS','ns3.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (6,'talega.com',300,'MX','10 talserver1.talega.com.',20030504123239);
INSERT INTO talega_com VALUES (7,'talega.com',300,'MX','20 mail.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (8,'imap.talega.com',300,'CNAME','imap.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (9,'mail.talega.com',300,'CNAME','mail.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (10,'old.talega.com',300,'A','216.120.59.243',20030729011500);
INSERT INTO talega_com VALUES (11,'pop.talega.com',300,'CNAME','pop.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (12,'talserver1.talega.com',300,'A','64.163.246.86',20030504123239);
INSERT INTO talega_com VALUES (13,'updates.talega.com',300,'MX','30 mail.interactivate.com.',20030504123239);
INSERT INTO talega_com VALUES (14,'www.talega.com',300,'A','216.120.59.243',20030729011517);
INSERT INTO talega_com VALUES (16,'www2.talega.com',28800,'A','216.120.59.227',20030803190153);

--
-- Table structure for table 'tehama_realty_com'
--

CREATE TABLE tehama_realty_com (
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

--
-- Dumping data for table 'tehama_realty_com'
--


INSERT INTO tehama_realty_com VALUES (1,'tehama-realty.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003062404 14400 3600 604800 28800',20030714164014);
INSERT INTO tehama_realty_com VALUES (2,'tehama-realty.com',28800,'NS','icg.interactivate.com.',20030624175547);
INSERT INTO tehama_realty_com VALUES (3,'tehama-realty.com',28800,'NS','ns2.interactivate.com.',20030624175547);
INSERT INTO tehama_realty_com VALUES (4,'tehama-realty.com',28800,'NS','ns3.interactivate.com.',20030624175547);
INSERT INTO tehama_realty_com VALUES (5,'tehama-realty.com',28800,'A','216.120.59.228',20030624175610);
INSERT INTO tehama_realty_com VALUES (6,'www.tehama-realty.com',28800,'A','216.120.59.228',20030624175620);
INSERT INTO tehama_realty_com VALUES (8,'www2.tehama-realty.com',28800,'A','216.120.59.227',20030803190200);

--
-- Table structure for table 'tgcofca_com'
--

CREATE TABLE tgcofca_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'tgcofca_com'
--


INSERT INTO tgcofca_com VALUES (1,'tgcofca.com',28800,'A','216.120.59.248',20030621132157);
INSERT INTO tgcofca_com VALUES (2,'tgcofca.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002091003 14400 3600 604800 28800',20030504123239);
INSERT INTO tgcofca_com VALUES (3,'tgcofca.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO tgcofca_com VALUES (4,'tgcofca.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO tgcofca_com VALUES (5,'tgcofca.com',28800,'MX','10 mail.tgcofca.com.',20030504123239);
INSERT INTO tgcofca_com VALUES (6,'amail.tgcofca.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO tgcofca_com VALUES (7,'localhost.tgcofca.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO tgcofca_com VALUES (8,'mail.tgcofca.com',28800,'A','216.65.210.41',20030504123239);
INSERT INTO tgcofca_com VALUES (9,'updates.tgcofca.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO tgcofca_com VALUES (10,'www.tgcofca.com',28800,'A','216.120.59.248',20030621132157);

--
-- Table structure for table 'thegolfclubofcalifornia_com'
--

CREATE TABLE thegolfclubofcalifornia_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'thegolfclubofcalifornia_com'
--


INSERT INTO thegolfclubofcalifornia_com VALUES (1,'thegolfclubofcalifornia.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002053106 14400 3600 604800 28800',20030806182101);
INSERT INTO thegolfclubofcalifornia_com VALUES (2,'thegolfclubofcalifornia.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (3,'thegolfclubofcalifornia.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (4,'thegolfclubofcalifornia.com',28800,'A','216.120.59.228',20030806182053);
INSERT INTO thegolfclubofcalifornia_com VALUES (5,'thegolfclubofcalifornia.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (6,'imap.thegolfclubofcalifornia.com',28800,'CNAME','mail.interactivate.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (8,'mail.thegolfclubofcalifornia.com',28800,'CNAME','mail.interactivate.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (9,'pop.thegolfclubofcalifornia.com',28800,'CNAME','mail.interactivate.com.',20030504123239);
INSERT INTO thegolfclubofcalifornia_com VALUES (10,'webmail.thegolfclubofcalifornia.com',28800,'A','216.120.59.242',20030621132157);
INSERT INTO thegolfclubofcalifornia_com VALUES (11,'www.thegolfclubofcalifornia.com',28800,'A','216.120.59.228',20030806182101);
INSERT INTO thegolfclubofcalifornia_com VALUES (14,'www2.thegolfclubofcalifornia.com',28800,'A','216.120.59.227',20030803190153);

--
-- Table structure for table 'thejobmarket_org'
--

CREATE TABLE thejobmarket_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'thejobmarket_org'
--


INSERT INTO thejobmarket_org VALUES (1,'thejobmarket.org',28800,'A','216.120.59.245',20030621132157);
INSERT INTO thejobmarket_org VALUES (2,'thejobmarket.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002111903 14400 3600 604800 28800',20030504123239);
INSERT INTO thejobmarket_org VALUES (3,'thejobmarket.org',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO thejobmarket_org VALUES (4,'thejobmarket.org',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO thejobmarket_org VALUES (5,'localhost.thejobmarket.org',28800,'A','127.0.0.1',20030504123239);
INSERT INTO thejobmarket_org VALUES (6,'www.thejobmarket.org',28800,'A','216.120.59.245',20030621132157);
INSERT INTO thejobmarket_org VALUES (8,'www2.thejobmarket.org',28800,'A','216.120.59.227',20030803190154);

--
-- Table structure for table 'thepinehills_com'
--

CREATE TABLE thepinehills_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'thepinehills_com'
--


INSERT INTO thepinehills_com VALUES (1,'thepinehills.com',28800,'A','216.120.60.21',20030621132157);
INSERT INTO thepinehills_com VALUES (2,'thepinehills.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002092303 14400 3600 604800 28800',20030504123239);
INSERT INTO thepinehills_com VALUES (3,'thepinehills.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (4,'thepinehills.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (5,'thepinehills.com',28800,'MX','10 mail.thepinehills.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (6,'amail.thepinehills.com',28800,'MX','20 mail.interactivate.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (7,'localhost.thepinehills.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO thepinehills_com VALUES (8,'mail.thepinehills.com',28800,'A','66.171.71.21',20030504123239);
INSERT INTO thepinehills_com VALUES (9,'preview.thepinehills.com',28800,'CNAME','dev.interactivate.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (10,'updates.thepinehills.com',28800,'MX','20 mail.interactivate.com.',20030504123239);
INSERT INTO thepinehills_com VALUES (11,'www.thepinehills.com',28800,'A','216.120.60.21',20030621132157);

--
-- Table structure for table 'thepinehills_net'
--

CREATE TABLE thepinehills_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'thepinehills_net'
--


INSERT INTO thepinehills_net VALUES (1,'thepinehills.net',28800,'A','216.120.60.21',20030621132157);
INSERT INTO thepinehills_net VALUES (2,'thepinehills.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052803 14400 3600 604800 28800',20030504123239);
INSERT INTO thepinehills_net VALUES (3,'thepinehills.net',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO thepinehills_net VALUES (4,'thepinehills.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO thepinehills_net VALUES (5,'thepinehills.net',28800,'MX','10 mail.thepinehills.net.',20030504123239);
INSERT INTO thepinehills_net VALUES (6,'localhost.thepinehills.net',28800,'A','127.0.0.1',20030504123239);
INSERT INTO thepinehills_net VALUES (7,'mail.thepinehills.net',28800,'A','66.171.71.21',20030504123239);
INSERT INTO thepinehills_net VALUES (8,'www.thepinehills.net',28800,'A','216.120.60.21',20030621132157);

--
-- Table structure for table 'theranchplan_com'
--

CREATE TABLE theranchplan_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'theranchplan_com'
--


INSERT INTO theranchplan_com VALUES (1,'theranchplan.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO theranchplan_com VALUES (2,'theranchplan.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002052312 14400 3600 604800 28800',20030504123239);
INSERT INTO theranchplan_com VALUES (3,'theranchplan.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO theranchplan_com VALUES (4,'theranchplan.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO theranchplan_com VALUES (5,'localhost.theranchplan.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO theranchplan_com VALUES (6,'www.theranchplan.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'theranchplan_net'
--

CREATE TABLE theranchplan_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'theranchplan_net'
--


INSERT INTO theranchplan_net VALUES (1,'theranchplan.net',28800,'A','216.120.60.17',20030621132157);
INSERT INTO theranchplan_net VALUES (2,'theranchplan.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123239);
INSERT INTO theranchplan_net VALUES (3,'theranchplan.net',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO theranchplan_net VALUES (4,'theranchplan.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO theranchplan_net VALUES (5,'localhost.theranchplan.net',28800,'A','127.0.0.1',20030504123239);
INSERT INTO theranchplan_net VALUES (6,'www.theranchplan.net',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'theranchplan_org'
--

CREATE TABLE theranchplan_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'theranchplan_org'
--


INSERT INTO theranchplan_org VALUES (1,'theranchplan.org',28800,'A','216.120.60.17',20030621132157);
INSERT INTO theranchplan_org VALUES (2,'theranchplan.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123239);
INSERT INTO theranchplan_org VALUES (3,'theranchplan.org',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO theranchplan_org VALUES (4,'theranchplan.org',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO theranchplan_org VALUES (5,'localhost.theranchplan.org',28800,'A','127.0.0.1',20030504123239);
INSERT INTO theranchplan_org VALUES (6,'www.theranchplan.org',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'theranchscam_com'
--

CREATE TABLE theranchscam_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'theranchscam_com'
--


INSERT INTO theranchscam_com VALUES (1,'theranchscam.com',28800,'A','216.120.60.17',20030621132157);
INSERT INTO theranchscam_com VALUES (2,'theranchscam.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002061813 14400 3600 604800 28800',20030504123239);
INSERT INTO theranchscam_com VALUES (3,'theranchscam.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO theranchscam_com VALUES (4,'theranchscam.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO theranchscam_com VALUES (5,'localhost.theranchscam.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO theranchscam_com VALUES (6,'www.theranchscam.com',28800,'A','216.120.60.17',20030621132157);

--
-- Table structure for table 'thevillageatplayavista_com'
--

CREATE TABLE thevillageatplayavista_com (
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

--
-- Dumping data for table 'thevillageatplayavista_com'
--


INSERT INTO thevillageatplayavista_com VALUES (1,'thevillageatplayavista.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003081403 14400 3600 604800 28800',20030814105450);
INSERT INTO thevillageatplayavista_com VALUES (2,'thevillageatplayavista.com',28800,'NS','icg.interactivate.com.',20030814105427);
INSERT INTO thevillageatplayavista_com VALUES (3,'thevillageatplayavista.com',28800,'NS','ns2.interactivate.com.',20030814105427);
INSERT INTO thevillageatplayavista_com VALUES (4,'thevillageatplayavista.com',28800,'NS','ns3.interactivate.com.',20030814105427);
INSERT INTO thevillageatplayavista_com VALUES (5,'thevillageatplayavista.com',28800,'A','216.120.59.228',20030814105440);
INSERT INTO thevillageatplayavista_com VALUES (6,'www.thevillageatplayavista.com',28800,'A','216.120.59.228',20030814105450);

--
-- Table structure for table 'thorndike_pinehills_com'
--

CREATE TABLE thorndike_pinehills_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'thorndike_pinehills_com'
--


INSERT INTO thorndike_pinehills_com VALUES (1,'thorndike-pinehills.com',28800,'SOA','ns.interactivate.com. dns.interactivate.com. 200303060 14400 3600 604800 86400',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (2,'thorndike-pinehills.com',28800,'NS','ns.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (3,'thorndike-pinehills.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (4,'thorndike-pinehills.com',28800,'MX','10 mail.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (5,'thorndike-pinehills.com',28800,'MX','20 mail2.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (6,'thorndike-pinehills.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO thorndike_pinehills_com VALUES (7,'ftp.thorndike-pinehills.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO thorndike_pinehills_com VALUES (8,'imap.thorndike-pinehills.com',28800,'CNAME','imap.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (9,'mail.thorndike-pinehills.com',28800,'CNAME','mail.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (10,'pop.thorndike-pinehills.com',28800,'CNAME','pop.interactivate.com.',20030504123239);
INSERT INTO thorndike_pinehills_com VALUES (11,'shell.thorndike-pinehills.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO thorndike_pinehills_com VALUES (12,'www.thorndike-pinehills.com',28800,'A','216.120.59.228',20030621132157);
INSERT INTO thorndike_pinehills_com VALUES (14,'www2.thorndike-pinehills.com',28800,'A','216.120.59.227',20030803190155);

--
-- Table structure for table 'truecalifornia_biz'
--

CREATE TABLE truecalifornia_biz (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'truecalifornia_biz'
--


INSERT INTO truecalifornia_biz VALUES (1,'truecalifornia.biz',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123239);
INSERT INTO truecalifornia_biz VALUES (2,'truecalifornia.biz',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (3,'truecalifornia.biz',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (4,'truecalifornia.biz',28800,'MX','100 relay1.hlc.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (5,'truecalifornia.biz',28800,'MX','200 relay2.hlc.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (6,'truecalifornia.biz',28800,'A','216.120.59.235',20030621132157);
INSERT INTO truecalifornia_biz VALUES (7,'localhost.truecalifornia.biz',28800,'A','127.0.0.1',20030504123239);
INSERT INTO truecalifornia_biz VALUES (8,'mail.truecalifornia.biz',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (9,'news.truecalifornia.biz',28800,'CNAME','news.eni.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (10,'pop.truecalifornia.biz',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (11,'smtp.truecalifornia.biz',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_biz VALUES (12,'www.truecalifornia.biz',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'truecalifornia_com'
--

CREATE TABLE truecalifornia_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'truecalifornia_com'
--


INSERT INTO truecalifornia_com VALUES (1,'truecalifornia.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001070804 14400 3600 604800 28800',20030504123239);
INSERT INTO truecalifornia_com VALUES (2,'truecalifornia.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO truecalifornia_com VALUES (3,'truecalifornia.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO truecalifornia_com VALUES (4,'truecalifornia.com',28800,'MX','100 relay1.hlc.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (5,'truecalifornia.com',28800,'MX','200 relay2.hlc.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (6,'truecalifornia.com',28800,'A','216.120.59.235',20030621132157);
INSERT INTO truecalifornia_com VALUES (7,'localhost.truecalifornia.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO truecalifornia_com VALUES (8,'mail.truecalifornia.com',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (9,'news.truecalifornia.com',28800,'CNAME','news.eni.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (10,'pop.truecalifornia.com',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (11,'smtp.truecalifornia.com',28800,'CNAME','pop.eni.net.',20030504123239);
INSERT INTO truecalifornia_com VALUES (12,'www.truecalifornia.com',28800,'A','216.120.59.235',20030621132157);

--
-- Table structure for table 'victoriabythebay_com'
--

CREATE TABLE victoriabythebay_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'victoriabythebay_com'
--


INSERT INTO victoriabythebay_com VALUES (1,'victoriabythebay.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO victoriabythebay_com VALUES (2,'victoriabythebay.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO victoriabythebay_com VALUES (3,'victoriabythebay.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO victoriabythebay_com VALUES (4,'localhost.victoriabythebay.com',28800,'A','127.0.0.1',20030504123239);

--
-- Table structure for table 'victoriabythebay_net'
--

CREATE TABLE victoriabythebay_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'victoriabythebay_net'
--


INSERT INTO victoriabythebay_net VALUES (1,'victoriabythebay.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO victoriabythebay_net VALUES (2,'victoriabythebay.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO victoriabythebay_net VALUES (3,'victoriabythebay.net',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO victoriabythebay_net VALUES (4,'localhost.victoriabythebay.net',28800,'A','127.0.0.1',20030504123239);

--
-- Table structure for table 'village_green_com'
--

CREATE TABLE village_green_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'village_green_com'
--


INSERT INTO village_green_com VALUES (1,'village-green.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO village_green_com VALUES (2,'village-green.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO village_green_com VALUES (3,'village-green.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO village_green_com VALUES (4,'localhost.village-green.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO village_green_com VALUES (5,'localhost.village-green.com',28800,'A','207.110.61.90',20030504123239);
INSERT INTO village_green_com VALUES (6,'www.village-green.com',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'village_green_net'
--

CREATE TABLE village_green_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'village_green_net'
--


INSERT INTO village_green_net VALUES (1,'village-green.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO village_green_net VALUES (2,'village-green.net',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO village_green_net VALUES (3,'village-green.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO village_green_net VALUES (4,'localhost.village-green.net',28800,'A','127.0.0.1',20030504123239);
INSERT INTO village_green_net VALUES (5,'localhost.village-green.net',28800,'A','207.110.61.90',20030504123239);
INSERT INTO village_green_net VALUES (6,'www.village-green.net',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'village_green_org'
--

CREATE TABLE village_green_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'village_green_org'
--


INSERT INTO village_green_org VALUES (1,'village-green.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO village_green_org VALUES (2,'village-green.org',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO village_green_org VALUES (3,'village-green.org',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO village_green_org VALUES (4,'localhost.village-green.org',28800,'A','127.0.0.1',20030504123239);
INSERT INTO village_green_org VALUES (5,'localhost.village-green.org',28800,'A','207.110.61.90',20030504123239);
INSERT INTO village_green_org VALUES (6,'www.village-green.org',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'villagegreen_com'
--

CREATE TABLE villagegreen_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'villagegreen_com'
--


INSERT INTO villagegreen_com VALUES (1,'villagegreen.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO villagegreen_com VALUES (2,'villagegreen.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO villagegreen_com VALUES (3,'villagegreen.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO villagegreen_com VALUES (4,'localhost.villagegreen.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO villagegreen_com VALUES (5,'localhost.villagegreen.com',28800,'A','207.110.61.90',20030504123239);
INSERT INTO villagegreen_com VALUES (6,'www.villagegreen.com',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'villagegreen_net'
--

CREATE TABLE villagegreen_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'villagegreen_net'
--


INSERT INTO villagegreen_net VALUES (1,'villagegreen.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO villagegreen_net VALUES (2,'villagegreen.net',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO villagegreen_net VALUES (3,'villagegreen.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO villagegreen_net VALUES (4,'localhost.villagegreen.net',28800,'A','127.0.0.1',20030504123239);
INSERT INTO villagegreen_net VALUES (5,'localhost.villagegreen.net',28800,'A','207.110.61.90',20030504123239);
INSERT INTO villagegreen_net VALUES (6,'www.villagegreen.net',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'villagegreen_org'
--

CREATE TABLE villagegreen_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'villagegreen_org'
--


INSERT INTO villagegreen_org VALUES (1,'villagegreen.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2001062805 14400 3600 604800 28800',20030504123239);
INSERT INTO villagegreen_org VALUES (2,'villagegreen.org',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO villagegreen_org VALUES (3,'villagegreen.org',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO villagegreen_org VALUES (4,'localhost.villagegreen.org',28800,'A','127.0.0.1',20030504123239);
INSERT INTO villagegreen_org VALUES (5,'localhost.villagegreen.org',28800,'A','207.110.61.90',20030504123239);
INSERT INTO villagegreen_org VALUES (6,'www.villagegreen.org',28800,'A','207.110.61.90',20030504123239);

--
-- Table structure for table 'wauwinet_com'
--

CREATE TABLE wauwinet_com (
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

--
-- Dumping data for table 'wauwinet_com'
--


INSERT INTO wauwinet_com VALUES (1,'wauwinet.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102756);
INSERT INTO wauwinet_com VALUES (2,'wauwinet.com',28800,'NS','icg.interactivate.com.',20030708102756);
INSERT INTO wauwinet_com VALUES (3,'wauwinet.com',28800,'NS','ns2.interactivate.com.',20030708102756);
INSERT INTO wauwinet_com VALUES (4,'wauwinet.com',28800,'NS','ns3.interactivate.com.',20030708102756);
INSERT INTO wauwinet_com VALUES (5,'wauwinet.com',28800,'A','216.120.59.228',20030708102756);
INSERT INTO wauwinet_com VALUES (6,'www.wauwinet.com',28800,'A','216.120.59.228',20030708102757);
INSERT INTO wauwinet_com VALUES (8,'www2.wauwinet.com',28800,'A','216.120.59.227',20030803190201);

--
-- Table structure for table 'wearabouts_com'
--

CREATE TABLE wearabouts_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wearabouts_com'
--


INSERT INTO wearabouts_com VALUES (1,'wearabouts.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123239);
INSERT INTO wearabouts_com VALUES (2,'wearabouts.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO wearabouts_com VALUES (3,'wearabouts.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO wearabouts_com VALUES (4,'localhost.wearabouts.com',28800,'A','127.0.0.1',20030504123239);
INSERT INTO wearabouts_com VALUES (5,'www.wearabouts.com',28800,'A','207.110.42.223',20030504123239);

--
-- Table structure for table 'whiteelephanthotel_com'
--

CREATE TABLE whiteelephanthotel_com (
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

--
-- Dumping data for table 'whiteelephanthotel_com'
--


INSERT INTO whiteelephanthotel_com VALUES (1,'whiteelephanthotel.com',28800,'SOA','ns.interactivate.com. hostmaster.interactivate.com. 2003070801 14400 3600 604800 28800',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (2,'whiteelephanthotel.com',28800,'NS','icg.interactivate.com.',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (3,'whiteelephanthotel.com',28800,'NS','ns2.interactivate.com.',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (4,'whiteelephanthotel.com',28800,'NS','ns3.interactivate.com.',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (5,'whiteelephanthotel.com',28800,'A','216.120.59.228',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (6,'www.whiteelephanthotel.com',28800,'A','216.120.59.228',20030708102758);
INSERT INTO whiteelephanthotel_com VALUES (8,'www2.whiteelephanthotel.com',28800,'A','216.120.59.227',20030803190202);

--
-- Table structure for table 'wildanimalpark_com'
--

CREATE TABLE wildanimalpark_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildanimalpark_com'
--


INSERT INTO wildanimalpark_com VALUES (1,'wildanimalpark.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002120203 14400 3600 604800 300',20030504123239);
INSERT INTO wildanimalpark_com VALUES (2,'wildanimalpark.com',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO wildanimalpark_com VALUES (3,'wildanimalpark.com',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO wildanimalpark_com VALUES (4,'wildanimalpark.com',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO wildanimalpark_com VALUES (5,'wildanimalpark.com',28800,'MX','100 bongo.sandiegozoo.org.',20030504123239);
INSERT INTO wildanimalpark_com VALUES (6,'wildanimalpark.com',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildanimalpark_com VALUES (7,'al.wildanimalpark.com',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildanimalpark_com VALUES (8,'dev.wildanimalpark.com',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildanimalpark_com VALUES (9,'www.wildanimalpark.com',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'wildanimalpark_net'
--

CREATE TABLE wildanimalpark_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildanimalpark_net'
--


INSERT INTO wildanimalpark_net VALUES (1,'wildanimalpark.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002120203 14400 3600 604800 300',20030504123239);
INSERT INTO wildanimalpark_net VALUES (2,'wildanimalpark.net',28800,'NS','ns.connectnet.com.',20030504123239);
INSERT INTO wildanimalpark_net VALUES (3,'wildanimalpark.net',28800,'NS','icg.interactivate.com.',20030504123239);
INSERT INTO wildanimalpark_net VALUES (4,'wildanimalpark.net',28800,'NS','ns2.interactivate.com.',20030504123239);
INSERT INTO wildanimalpark_net VALUES (5,'wildanimalpark.net',28800,'MX','100 bongo.sandiegozoo.org.',20030504123239);
INSERT INTO wildanimalpark_net VALUES (6,'wildanimalpark.net',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildanimalpark_net VALUES (7,'al.wildanimalpark.net',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildanimalpark_net VALUES (8,'dev.wildanimalpark.net',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildanimalpark_net VALUES (9,'www.wildanimalpark.net',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'wildanimalpark_org'
--

CREATE TABLE wildanimalpark_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildanimalpark_org'
--


INSERT INTO wildanimalpark_org VALUES (1,'wildanimalpark.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123240);
INSERT INTO wildanimalpark_org VALUES (2,'wildanimalpark.org',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO wildanimalpark_org VALUES (3,'wildanimalpark.org',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO wildanimalpark_org VALUES (4,'wildanimalpark.org',28800,'MX','100 bongo.sandiegozoo.org.',20030504123240);
INSERT INTO wildanimalpark_org VALUES (5,'wildanimalpark.org',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildanimalpark_org VALUES (6,'al.wildanimalpark.org',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildanimalpark_org VALUES (7,'dev.wildanimalpark.org',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildanimalpark_org VALUES (8,'www.wildanimalpark.org',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'wildbeast_com'
--

CREATE TABLE wildbeast_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildbeast_com'
--


INSERT INTO wildbeast_com VALUES (1,'wildbeast.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123240);
INSERT INTO wildbeast_com VALUES (2,'wildbeast.com',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO wildbeast_com VALUES (3,'wildbeast.com',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO wildbeast_com VALUES (4,'wildbeast.com',28800,'MX','100 bongo.sandiegozoo.org.',20030504123240);
INSERT INTO wildbeast_com VALUES (5,'wildbeast.com',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildbeast_com VALUES (6,'al.wildbeast.com',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildbeast_com VALUES (7,'dev.wildbeast.com',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildbeast_com VALUES (8,'www.wildbeast.com',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'wildbeast_net'
--

CREATE TABLE wildbeast_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildbeast_net'
--


INSERT INTO wildbeast_net VALUES (1,'wildbeast.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123240);
INSERT INTO wildbeast_net VALUES (2,'wildbeast.net',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO wildbeast_net VALUES (3,'wildbeast.net',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO wildbeast_net VALUES (4,'wildbeast.net',28800,'MX','100 bongo.sandiegozoo.org.',20030504123240);
INSERT INTO wildbeast_net VALUES (5,'wildbeast.net',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildbeast_net VALUES (6,'al.wildbeast.net',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildbeast_net VALUES (7,'dev.wildbeast.net',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildbeast_net VALUES (8,'www.wildbeast.net',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'wildbeast_org'
--

CREATE TABLE wildbeast_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'wildbeast_org'
--


INSERT INTO wildbeast_org VALUES (1,'wildbeast.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2002112603 14400 3600 604800 300',20030504123240);
INSERT INTO wildbeast_org VALUES (2,'wildbeast.org',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO wildbeast_org VALUES (3,'wildbeast.org',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO wildbeast_org VALUES (4,'wildbeast.org',28800,'MX','100 bongo.sandiegozoo.org.',20030504123240);
INSERT INTO wildbeast_org VALUES (5,'wildbeast.org',28800,'A','216.120.88.242',20030621132157);
INSERT INTO wildbeast_org VALUES (6,'al.wildbeast.org',28800,'A','216.120.88.244',20030621132157);
INSERT INTO wildbeast_org VALUES (7,'dev.wildbeast.org',28800,'A','216.120.88.243',20030621132157);
INSERT INTO wildbeast_org VALUES (8,'www.wildbeast.org',28800,'A','216.120.88.242',20030621132157);

--
-- Table structure for table 'williamlyonhomes_com'
--

CREATE TABLE williamlyonhomes_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'williamlyonhomes_com'
--


INSERT INTO williamlyonhomes_com VALUES (1,'williamlyonhomes.com',28800,'A','216.120.59.248',20030621132157);
INSERT INTO williamlyonhomes_com VALUES (2,'williamlyonhomes.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003021903 14400 3600 604800 28800',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (3,'williamlyonhomes.com',28800,'NS','ns.connectnet.com.',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (4,'williamlyonhomes.com',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (5,'williamlyonhomes.com',28800,'MX','10 mail.williamlyonhomes.com.',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (6,'localhost.williamlyonhomes.com',28800,'A','127.0.0.1',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (7,'mail.williamlyonhomes.com',28800,'A','216.65.210.41',20030504123240);
INSERT INTO williamlyonhomes_com VALUES (8,'www.williamlyonhomes.com',28800,'A','216.120.59.248',20030621132157);

--
-- Table structure for table 'williamlyonhomes_net'
--

CREATE TABLE williamlyonhomes_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'williamlyonhomes_net'
--


INSERT INTO williamlyonhomes_net VALUES (1,'williamlyonhomes.net',28800,'A','216.120.59.248',20030621132157);
INSERT INTO williamlyonhomes_net VALUES (2,'williamlyonhomes.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003021903 14400 3600 604800 28800',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (3,'williamlyonhomes.net',28800,'NS','ns.connectnet.com.',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (4,'williamlyonhomes.net',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (5,'williamlyonhomes.net',28800,'MX','10 mail.williamlyonhomes.net.',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (6,'localhost.williamlyonhomes.net',28800,'A','127.0.0.1',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (7,'mail.williamlyonhomes.net',28800,'A','216.65.210.41',20030504123240);
INSERT INTO williamlyonhomes_net VALUES (8,'www.williamlyonhomes.net',28800,'A','216.120.59.248',20030621132157);

--
-- Table structure for table 'williamlyonhomes_org'
--

CREATE TABLE williamlyonhomes_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'williamlyonhomes_org'
--


INSERT INTO williamlyonhomes_org VALUES (1,'williamlyonhomes.org',28800,'A','216.120.59.248',20030621132157);
INSERT INTO williamlyonhomes_org VALUES (2,'williamlyonhomes.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 2003021903 14400 3600 604800 28800',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (3,'williamlyonhomes.org',28800,'NS','ns.connectnet.com.',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (4,'williamlyonhomes.org',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (5,'williamlyonhomes.org',28800,'MX','10 mail.williamlyonhomes.org.',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (6,'localhost.williamlyonhomes.org',28800,'A','127.0.0.1',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (7,'mail.williamlyonhomes.org',28800,'A','216.65.210.41',20030504123240);
INSERT INTO williamlyonhomes_org VALUES (8,'www.williamlyonhomes.org',28800,'A','216.120.59.248',20030621132157);

--
-- Table structure for table 'yellowchair_com'
--

CREATE TABLE yellowchair_com (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'yellowchair_com'
--


INSERT INTO yellowchair_com VALUES (1,'yellowchair.com',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123240);
INSERT INTO yellowchair_com VALUES (2,'yellowchair.com',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO yellowchair_com VALUES (3,'yellowchair.com',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO yellowchair_com VALUES (4,'localhost.yellowchair.com',28800,'A','127.0.0.1',20030504123240);

--
-- Table structure for table 'yellowchair_net'
--

CREATE TABLE yellowchair_net (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'yellowchair_net'
--


INSERT INTO yellowchair_net VALUES (1,'yellowchair.net',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123240);
INSERT INTO yellowchair_net VALUES (2,'yellowchair.net',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO yellowchair_net VALUES (3,'yellowchair.net',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO yellowchair_net VALUES (4,'localhost.yellowchair.net',28800,'A','127.0.0.1',20030504123240);

--
-- Table structure for table 'yellowchair_org'
--

CREATE TABLE yellowchair_org (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'yellowchair_org'
--


INSERT INTO yellowchair_org VALUES (1,'yellowchair.org',28800,'SOA','icg.interactivate.com. dns.interactivate.com. 1999101203 14400 3600 604800 28800',20030504123240);
INSERT INTO yellowchair_org VALUES (2,'yellowchair.org',28800,'NS','icg.interactivate.com.',20030504123240);
INSERT INTO yellowchair_org VALUES (3,'yellowchair.org',28800,'NS','ns2.interactivate.com.',20030504123240);
INSERT INTO yellowchair_org VALUES (4,'localhost.yellowchair.org',28800,'A','127.0.0.1',20030504123240);

--
-- Table structure for table 'zonedata'
--

CREATE TABLE zonedata (
  ID int(12) NOT NULL auto_increment,
  NAME varchar(200) default NULL,
  TTL int(11) default NULL,
  RDTYPE varchar(50) default NULL,
  RDATA varchar(200) default NULL,
  CREATED timestamp(14) NOT NULL,
  OWNER varchar(50) default NULL,
  PRIMARY KEY  (ID),
  KEY name (NAME),
  KEY value (RDATA)
) TYPE=MyISAM;

--
-- Dumping data for table 'zonedata'
--



--
-- Table structure for table 'zones'
--

CREATE TABLE zones (
  zoneID int(8) NOT NULL auto_increment,
  domain varchar(100) NOT NULL default '',
  tablename varchar(100) NOT NULL default '',
  type varchar(25) NOT NULL default 'master',
  masters varchar(100) NOT NULL default '',
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

--
-- Dumping data for table 'zones'
--


INSERT INTO zones VALUES (1,'1-to-1mail.cc','1_to_1mail_cc','master','','','2003-05-04 12:32:32',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (3,'1to1mail.cc','1to1mail_cc','master','','','2003-05-04 12:32:32',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (244,'ladera-ranch.biz','ladera_ranch_biz','master','','LAD','2003-05-06 11:25:34',20030506113142,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (6,'27-133.212','27_133_212','master','','','2003-05-04 12:32:32',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (10,'aballparkforsandiego.com','aballparkforsandiego_com','master','','PAD','2003-05-04 12:32:32',20030709094612,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (11,'aballparkforsandiego.net','aballparkforsandiego_net','master','','PAD','2003-05-04 12:32:32',20030709094615,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (12,'aballparkforsandiego.org','aballparkforsandiego_org','master','','PAD','2003-05-04 12:32:32',20030709094616,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (13,'activatemail.cc','activatemail_cc','master','','IAI','2003-05-04 12:32:32',20030709094621,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (14,'activatemail.com','activatemail_com','master','','IAI','2003-05-04 12:32:32',20030709094623,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (15,'aguacate.info','aguacate_info','master','','CAC','2003-05-04 12:32:32',20030709094626,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (16,'aguacate.org','aguacate_org','master','','CAC','2003-05-04 12:32:32',20030709094627,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (17,'atomicwebdesign.com','atomicwebdesign_com','master','','ATOM','2003-05-04 12:32:32',20030709094633,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (18,'avocado.org','avocado_org','master','','CAC','2003-05-04 12:32:32',20030709094635,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (19,'avocados.org','avocados_org','master','','CAC','2003-05-04 12:32:32',20030709094638,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (20,'avoinfo.com','avoinfo_com','master','','CAC','2003-05-04 12:32:32',20030709094640,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (21,'billmageeblues.com','billmageeblues_com','master','','MAG','2003-05-04 12:32:32',20030709094642,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (23,'calflowers.com','calflowers_com','master','','FLO','2003-05-04 12:32:32',20030709094646,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (24,'calflowers.net','calflowers_net','master','','FLO','2003-05-04 12:32:32',20030709094648,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (25,'calflowers.org','calflowers_org','master','','FLO','2003-05-04 12:32:32',20030709094649,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (26,'california-avocado.org','california_avocado_org','master','','CAC','2003-05-04 12:32:32',20030709094652,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (27,'californiaavocado.info','californiaavocado_info','master','','CAC','2003-05-04 12:32:32',20030709094653,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (28,'californiaavocado.org','californiaavocado_org','master','','CAC','2003-05-04 12:32:33',20030709094655,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (29,'californiaavocados.info','californiaavocados_info','master','','CAC','2003-05-04 12:32:33',20030709094656,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (30,'californiaavocados.org','californiaavocados_org','master','','CAC','2003-05-04 12:32:33',20030709094657,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (31,'californiapacifichomes.com','californiapacifichomes_com','master','','CAP','2003-05-04 12:32:33',20030709094700,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (32,'caliskids.com','caliskids_com','master','','CAC','2003-05-04 12:32:33',20030709094703,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (33,'calpacifichomes.com','calpacifichomes_com','master','','CAP','2003-05-04 12:32:33',20030709094704,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (34,'changeage.com','changeage_com','master','','AGE','2003-05-04 12:32:33',20030709094708,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (35,'changeage.net','changeage_net','master','','AGE','2003-05-04 12:32:33',20030709094710,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (36,'changeage.org','changeage_org','master','','AGE','2003-05-04 12:32:33',20030709094712,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (37,'cinch5.com','cinch5_com','master','','JACK','2003-05-04 12:32:33',20030709094721,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (38,'davidsoncommunities.com','davidsoncommunities_com','master','','','2003-05-04 12:32:33',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (39,'delmarinteractive.com','delmarinteractive_com','master','','IAI','2003-05-04 12:32:33',20030709094729,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (40,'delmarinteractive.net','delmarinteractive_net','master','','IAI','2003-05-04 12:32:33',20030709094731,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (41,'delmarinteractive.org','delmarinteractive_org','master','','IAI','2003-05-04 12:32:33',20030709094732,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (42,'delmarwebdesign.com','delmarwebdesign_com','master','','IAI','2003-05-04 12:32:33',20030709094734,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (43,'distinctive-home.com','distinctive_home_com','master','','HOM','2003-05-04 12:32:33',20030709094736,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (44,'distinctivehomes.net','distinctivehomes_net','master','','HOM','2003-05-04 12:32:33',20030709094738,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (45,'duxfordfinancial.com','duxfordfinancial_com','master','','DUX','2003-05-04 12:32:33',20030709094741,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (46,'escala-homes.com','escala_homes_com','master','','ESC','2003-05-04 12:32:33',20030709094743,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (47,'escalahomes.com','escalahomes_com','master','','ESC','2003-05-04 12:32:33',20030709094745,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (48,'escalaliving.com','escalaliving_com','master','','ESC','2003-05-04 12:32:33',20030709094746,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (49,'escalamissionvalley.com','escalamissionvalley_com','master','','ESC','2003-05-04 12:32:33',20030709094748,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (50,'escalasandiego.com','escalasandiego_com','master','','ESC','2003-05-04 12:32:34',20030709094749,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (51,'escalasd.com','escalasd_com','master','','ESC','2003-05-04 12:32:34',20030709094750,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (52,'euroamprop.com','euroamprop_com','master','','EUR','2003-05-04 12:32:34',20030709094752,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (53,'eurogardens.com','eurogardens_com','master','','EUR','2003-05-04 12:32:34',20030709094754,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (54,'europeangardens.com','europeangardens_com','master','','EUR','2003-05-04 12:32:34',20030709094755,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (55,'executiveflowers.cc','executiveflowers_cc','master','','FLO','2003-05-04 12:32:34',20030709094802,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (56,'executiveflowers.com','executiveflowers_com','master','','FLO','2003-05-04 12:32:34',20030709094803,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (57,'executiveflowers.net','executiveflowers_net','master','','FLO','2003-05-04 12:32:34',20030709094804,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (58,'executiveflowers.org','executiveflowers_org','master','','FLO','2003-05-04 12:32:34',20030709094806,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (59,'executivewatch.com','executivewatch_com','master','','FLO','2003-05-04 12:32:34',20030709094809,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (60,'fallmagic.biz','fallmagic_biz','master','','EUR','2003-05-04 12:32:34',20030709094816,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (61,'fallmagic.com','fallmagic_com','master','','EUR','2003-05-04 12:32:34',20030709094818,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (62,'fallmagic.info','fallmagic_info','master','','EUR','2003-05-04 12:32:34',20030709094819,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (63,'fashionweekla.com','fashionweekla_com','master','','FWL','2003-05-04 12:32:34',20030709094821,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (64,'flowerandplant.com','flowerandplant_com','master','','FLO','2003-05-04 12:32:34',20030709094824,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (65,'flowerandplant.org','flowerandplant_org','master','','FLO','2003-05-04 12:32:34',20030709094825,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (66,'freshanddirect.com','freshanddirect_com','master','','FLO','2003-05-04 12:32:34',20030709094828,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (67,'freshanddirect.net','freshanddirect_net','master','','FLO','2003-05-04 12:32:34',20030709094829,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (68,'freshisbest.com','freshisbest_com','master','','FLO','2003-05-04 12:32:34',20030709094831,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (69,'freshisbest.net','freshisbest_net','master','','FLO','2003-05-04 12:32:34',20030709094832,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (70,'frozenzoo.com','frozenzoo_com','master','','ZOO','2003-05-04 12:32:34',20030709094834,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (71,'frozenzoo.net','frozenzoo_net','master','','ZOO','2003-05-04 12:32:34',20030709094836,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (72,'frozenzoo.org','frozenzoo_org','master','','ZOO','2003-05-04 12:32:34',20030709094837,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (73,'gardensofeurope.com','gardensofeurope_com','master','','EUR','2003-05-04 12:32:34',20030709094843,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (74,'greenleegrasses.com','greenleegrasses_com','master','','EUR','2003-05-04 12:32:34',20030709094845,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (75,'guacamole.info','guacamole_info','master','','CAC','2003-05-04 12:32:34',20030709094847,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (76,'guacamole.org','guacamole_org','master','','CAC','2003-05-04 12:32:34',20030709094848,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (77,'haciendasantaluz.com','haciendasantaluz_com','master','','LUZ','2003-05-04 12:32:34',20030709094851,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (78,'hapo.com','hapo_com','master','','CAC','2003-05-04 12:32:34',20030709094854,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (79,'icg-inc.net','icg_inc_net','master','','IAI','2003-05-04 12:32:34',20030709094856,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (80,'interact8.biz','interact8_biz','master','','IAI','2003-05-04 12:32:34',20030709094900,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (81,'interact8.info','interact8_info','master','','IAI','2003-05-04 12:32:35',20030709094901,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (82,'interactiv8.biz','interactiv8_biz','master','','IAI','2003-05-04 12:32:35',20030709094902,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (83,'interactiv8.com','interactiv8_com','master','','IAI','2003-05-04 12:32:35',20030709094904,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (84,'interactiv8.info','interactiv8_info','master','','IAI','2003-05-04 12:32:35',20030709094905,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (85,'interactiv8.net','interactiv8_net','master','','IAI','2003-05-04 12:32:35',20030709094907,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (86,'interactivate.biz','interactivate_biz','master','','IAI','2003-05-04 12:32:35',20030709094909,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (87,'interactivate.cc','interactivate_cc','master','','IAI','2003-05-04 12:32:35',20030709094910,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (88,'interactivate.com','interactivate_com','master','','IAI','2003-05-04 12:32:36',20030504214502,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (89,'interactivate.info','interactivate_info','master','','IAI','2003-05-04 12:32:36',20030709094913,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (90,'interactivate.org','interactivate_org','master','','IAI','2003-05-04 12:32:36',20030709094915,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (91,'interactivate8.net','interactivate8_net','master','','IAI','2003-05-04 12:32:36',20030709094916,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (92,'interactive8.net','interactive8_net','master','','IAI','2003-05-04 12:32:36',20030709094917,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (93,'iscapes.com','iscapes_com','master','','ISC','2003-05-04 12:32:36',20030709094921,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (94,'jackabbott.biz','jackabbott_biz','master','','JACK','2003-05-04 12:32:36',20030709094923,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (95,'jackabbott.com','jackabbott_com','master','','JACK','2003-05-04 12:32:36',20030709094925,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (96,'jackabbott.info','jackabbott_info','master','','JACK','2003-05-04 12:32:36',20030709094927,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (97,'jackabbottjr.com','jackabbottjr_com','master','','JACK','2003-05-04 12:32:36',20030709094928,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (98,'la-quinta-homes.com','la_quinta_homes_com','master','','','2003-05-04 12:32:36',20030709094947,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (99,'la-vina.com','la_vina_com','master','','','2003-05-04 12:32:36',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (100,'laderaranchrealty.com','laderaranchrealty_com','master','','LAD','2003-05-04 12:32:36',20030709094950,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (101,'livingwreath.com','livingwreath_com','master','','WREATH','2003-05-04 12:32:36',20030709094954,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (102,'lizclaiborneswim.com','lizclaiborneswim_com','master','','','2003-05-04 12:32:36',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (103,'lyon-pride.com','lyon_pride_com','master','','LYO','2003-05-04 12:32:36',20030709095002,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (104,'lyonhomes.com','lyonhomes_com','master','','LYO','2003-05-04 12:32:36',20030709095004,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (105,'lyonhomeslv.com','lyonhomeslv_com','master','','LYO','2003-05-04 12:32:36',20030709095006,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (106,'moiso.cc','moiso_cc','master','','LAD','2003-05-04 12:32:37',20030709095009,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (107,'myavocado.com','myavocado_com','master','','CAC','2003-05-04 12:32:37',20030709095011,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (108,'myavocado.net','myavocado_net','master','','CAC','2003-05-04 12:32:37',20030709095012,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (109,'myavocado.org','myavocado_org','master','','CAC','2003-05-04 12:32:37',20030709095014,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (110,'mygrasses.com','mygrasses_com','master','','EUR','2003-05-04 12:32:37',20030709095017,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (111,'mypws.com','mypws_com','master','','WOR','2003-05-04 12:32:37',20030709095022,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (112,'mysushi.com','mysushi_com','master','','SUS','2003-05-04 12:32:37',20030709095025,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (113,'mysushideli.com','mysushideli_com','master','','SUS','2003-05-04 12:32:37',20030709095026,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (114,'ob.com','ob_com','master','','','2003-05-04 12:32:37',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (115,'one-line-marketing.com','one_line_marketing_com','master','','IAI','2003-05-04 12:32:37',20030709095031,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (116,'one-line-marketing.net','one_line_marketing_net','master','','IAI','2003-05-04 12:32:37',20030709095032,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (117,'one-line-marketing.org','one_line_marketing_org','master','','IAI','2003-05-04 12:32:37',20030709095034,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (118,'oneillandmoiso.com','oneillandmoiso_com','master','','LAD','2003-05-04 12:32:37',20030709095037,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (119,'onelinemarketing.com','onelinemarketing_com','master','','IAI','2003-05-04 12:32:37',20030709095041,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (120,'onelinemarketing.net','onelinemarketing_net','master','','IAI','2003-05-04 12:32:37',20030709095043,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (121,'onelinemarketing.org','onelinemarketing_org','master','','IAI','2003-05-04 12:32:37',20030709095045,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (122,'onlineprequal.com','onlineprequal_com','master','','IAI','2003-05-04 12:32:37',20030709095047,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (123,'osbornedevelopment.com','osbornedevelopment_com','master','','','2003-05-04 12:32:37',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (124,'personalmail.cc','personalmail_cc','master','','','2003-05-04 12:32:37',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (125,'pfpresents.com','pfpresents_com','master','','PETER','2003-05-04 12:32:37',20030709095055,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (126,'pinehills.com','pinehills_com','master','','PIN','2003-05-04 12:32:37',20030709095057,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (127,'pinehills.net','pinehills_net','master','','PIN','2003-05-04 12:32:37',20030709095059,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (128,'prideoflyon.com','prideoflyon_com','master','','LYO','2003-05-04 12:32:37',20030709095101,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (129,'provenselections.biz','provenselections_biz','master','','PRO','2003-05-04 12:32:37',20030709095103,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (130,'provenselections.com','provenselections_com','master','','PRO','2003-05-04 12:32:37',20030709095104,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (131,'provenselections.info','provenselections_info','master','','PRO','2003-05-04 12:32:37',20030709095105,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (132,'provenselections.net','provenselections_net','master','','PRO','2003-05-04 12:32:37',20030709095106,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (133,'provenselections.org','provenselections_org','master','','PRO','2003-05-04 12:32:37',20030709095107,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (134,'provenwinners.info','provenwinners_info','master','','PRO','2003-05-04 12:32:37',20030709095108,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (135,'provenwinners.net','provenwinners_net','master','','PRO','2003-05-04 12:32:37',20030709095109,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (136,'provenwinners.org','provenwinners_org','master','','PRO','2003-05-04 12:32:37',20030709095110,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (137,'ranchocarillo.biz','ranchocarillo_biz','master','','RMV','2003-05-04 12:32:37',20030709095125,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (138,'ranchocarillohomes.biz','ranchocarillohomes_biz','master','','RMV','2003-05-04 12:32:37',20030709095126,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (139,'ranchocarrillo.biz','ranchocarrillo_biz','master','','RMV','2003-05-04 12:32:37',20030709095128,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (140,'ranchocarrillo.com','ranchocarrillo_com','master','','RMV','2003-05-04 12:32:37',20030709095130,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (141,'ranchocarrillohomes.biz','ranchocarrillohomes_biz','master','','RMV','2003-05-04 12:32:37',20030709095131,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (142,'ranchomissionviejo.cc','ranchomissionviejo_cc','master','','RMV','2003-05-04 12:32:37',20030709095133,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (143,'ranchomissionviejo.com','ranchomissionviejo_com','master','','RMV','2003-05-04 12:32:37',20030709095134,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (144,'ranchomissionviejo.net','ranchomissionviejo_net','master','','RMV','2003-05-04 12:32:37',20030709095146,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (145,'ranchomissionviejo.org','ranchomissionviejo_org','master','','RMV','2003-05-04 12:32:38',20030709095146,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (146,'ranchomissionviejolandpreserve.com','ranchomissionviejolandpreserve_com','master','','RMV','2003-05-04 12:32:38',20030709095145,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (147,'ranchomissionviejolandtrust.cc','ranchomissionviejolandtrust_cc','master','','RMV','2003-05-04 12:32:38',20030709095143,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (148,'ranchomissionviejolandtrust.com','ranchomissionviejolandtrust_com','master','','RMV','2003-05-04 12:32:38',20030709095140,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (149,'ranchomissionviejolandtrust.net','ranchomissionviejolandtrust_net','master','','RMV','2003-05-04 12:32:38',20030709095139,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (150,'ranchopenspace.com','ranchopenspace_com','master','','RMV','2003-05-04 12:32:38',20030709095137,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (151,'readypac.biz','readypac_biz','master','','REA','2003-05-04 12:32:38',20030709095150,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (152,'readypac.info','readypac_info','master','','REA','2003-05-04 12:32:38',20030709095151,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (153,'readypacproduce.biz','readypacproduce_biz','master','','REA','2003-05-04 12:32:38',20030709095152,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (154,'readypacproduce.com','readypacproduce_com','master','','REA','2003-05-04 12:32:38',20030709095153,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (155,'readypacproduce.info','readypacproduce_info','master','','REA','2003-05-04 12:32:38',20030709095154,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (156,'rmv.cc','rmv_cc','master','','RMV','2003-05-04 12:32:38',20030709095157,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (157,'rmvcmp.com','rmvcmp_com','master','','RMV','2003-05-04 12:32:38',20030709095159,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (158,'rmvconservationmanagementplan.com','rmvconservationmanagementplan_com','master','','RMV','2003-05-04 12:32:38',20030709095200,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (159,'rmvlandtrust.com','rmvlandtrust_com','master','','RMV','2003-05-04 12:32:38',20030709095201,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (160,'rmvrodeo.com','rmvrodeo_com','master','','RMV','2003-05-04 12:32:38',20030709095202,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (161,'samherman.com','samherman_com','master','','','2003-05-04 12:32:38',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (162,'sandiegozoosucks.com','sandiegozoosucks_com','master','','ZOO','2003-05-04 12:32:38',20030709095206,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (163,'sandiegozoosucks.org','sandiegozoosucks_org','master','','ZOO','2003-05-04 12:32:38',20030709095207,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (164,'sanjuancreekpark.com','sanjuancreekpark_com','master','','RMV','2003-05-04 12:32:38',20030709095211,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (165,'sanjuancreekregionalrecreationcorridor.com','sanjuancreekregionalrecreationcorridor_com','master','','RMV','2003-05-04 12:32:38',20030709095212,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (166,'santaluz.com','santaluz_com','master','','LUZ','2003-05-04 12:32:38',20030709095214,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (167,'santaluz.net','santaluz_net','master','','LUZ','2003-05-04 12:32:38',20030709095216,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (168,'santaluz.org','santaluz_org','master','','LUZ','2003-05-04 12:32:38',20030709095217,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (169,'santaluzclub.com','santaluzclub_com','master','','LUZ','2003-05-04 12:32:38',20030709095218,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (170,'santaluzcommunity.com','santaluzcommunity_com','master','','LUZ','2003-05-04 12:32:38',20030709095219,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (171,'santaluzcountryhomes.com','santaluzcountryhomes_com','master','','LUZ','2003-05-04 12:32:38',20030709095220,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (172,'santaluzcourthomes.com','santaluzcourthomes_com','master','','LUZ','2003-05-04 12:32:38',20030709095221,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (173,'santaluzcustomhomesites.com','santaluzcustomhomesites_com','master','','LUZ','2003-05-04 12:32:38',20030709095222,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (174,'santaluzgardenhomes.com','santaluzgardenhomes_com','master','','LUZ','2003-05-04 12:32:38',20030709095223,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (175,'santaluzgolf.com','santaluzgolf_com','master','','LUZ','2003-05-04 12:32:38',20030709095224,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (176,'santaluzhaciendassur.com','santaluzhaciendassur_com','master','','LUZ','2003-05-04 12:32:38',20030709095224,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (177,'santaluzhomes.com','santaluzhomes_com','master','','LUZ','2003-05-04 12:32:38',20030709095225,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (178,'santaluzhouse.com','santaluzhouse_com','master','','LUZ','2003-05-04 12:32:38',20030709095226,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (179,'santaluzlife.com','santaluzlife_com','master','','LUZ','2003-05-04 12:32:38',20030709095227,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (180,'santaluzrealestate.com','santaluzrealestate_com','master','','LUZ','2003-05-04 12:32:38',20030709095227,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (181,'santaluzsentinels.com','santaluzsentinels_com','master','','LUZ','2003-05-04 12:32:38',20030709095228,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (182,'santaluzspanishbungalows.com','santaluzspanishbungalows_com','master','','LUZ','2003-05-04 12:32:38',20030709095229,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (183,'saveoneillranch.com','saveoneillranch_com','master','','RMV','2003-05-04 12:32:38',20030709095233,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (184,'scdesigninc.com','scdesigninc_com','master','','SCD','2003-05-04 12:32:38',20030709095235,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (185,'sdballpark.com','sdballpark_com','master','','PAD','2003-05-04 12:32:38',20030709095237,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (186,'sdsushi.com','sdsushi_com','master','','SUS','2003-05-04 12:32:38',20030709095238,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (187,'seacountryhome.com','seacountryhome_com','master','','SEA','2003-05-04 12:32:39',20030709095239,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (188,'seacountryhomes.biz','seacountryhomes_biz','master','','SEA','2003-05-04 12:32:39',20030709095240,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (189,'seacountryhomes.com','seacountryhomes_com','master','','SEA','2003-05-04 12:32:39',20030709095241,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (190,'seacountryhomes.info','seacountryhomes_info','master','','SEA','2003-05-04 12:32:39',20030709095242,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (191,'shopzoo.net','shopzoo_net','master','','ZOO','2003-05-04 12:32:39',20030709095244,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (192,'shopzoo.org','shopzoo_org','master','','ZOO','2003-05-04 12:32:39',20030709095245,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (193,'silverleaf.com','silverleaf_com','master','','DMB','2003-05-04 12:32:39',20030709095253,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (194,'simplesalad.com','simplesalad_com','master','','SAL','2003-05-04 12:32:39',20030709095257,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (195,'sirenakids.com','sirenakids_com','master','','CAC','2003-05-04 12:32:39',20030709095259,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (196,'sirenaswim.com','sirenaswim_com','master','','CAC','2003-05-04 12:32:39',20030709095300,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (197,'stallionscrossing.com','stallionscrossing_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (198,'summerlane.net','summerlane_net','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (199,'summerlanehomes.com','summerlanehomes_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (200,'surveyorsource.com','surveyorsource_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (201,'sushideli2.com','sushideli2_com','master','','SUS','2003-05-04 12:32:39',20030709095307,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (202,'sushidelitoo.com','sushidelitoo_com','master','','SUS','2003-05-04 12:32:39',20030709095308,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (203,'sushisandiego.com','sushisandiego_com','master','','SUS','2003-05-04 12:32:39',20030709095310,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (204,'talega.com','talega_com','master','','TAL','2003-05-04 12:32:39',20030709095311,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (205,'tgcofca.com','tgcofca_com','master','','GCC','2003-05-04 12:32:39',20030709095317,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (206,'thegolfclubofcalifornia.com','thegolfclubofcalifornia_com','master','','GCC','2003-05-04 12:32:39',20030709095319,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (207,'thejobmarket.org','thejobmarket_org','master','','WOR','2003-05-04 12:32:39',20030709095321,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (208,'thepinehills.com','thepinehills_com','master','','PIN','2003-05-04 12:32:39',20030709095322,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (209,'thepinehills.net','thepinehills_net','master','','PIN','2003-05-04 12:32:39',20030709095324,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (210,'theranchplan.com','theranchplan_com','master','','RMV','2003-05-04 12:32:39',20030709095325,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (211,'theranchplan.net','theranchplan_net','master','','RMV','2003-05-04 12:32:39',20030709095326,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (212,'theranchplan.org','theranchplan_org','master','','RMV','2003-05-04 12:32:39',20030709095328,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (213,'theranchscam.com','theranchscam_com','master','','RMV','2003-05-04 12:32:39',20030709095329,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (214,'thorndike-pinehills.com','thorndike_pinehills_com','master','','PIN','2003-05-04 12:32:39',20030709095331,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (215,'truecalifornia.biz','truecalifornia_biz','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (216,'truecalifornia.com','truecalifornia_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (217,'victoriabythebay.com','victoriabythebay_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (218,'victoriabythebay.net','victoriabythebay_net','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (219,'village-green.com','village_green_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (220,'village-green.net','village_green_net','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (221,'village-green.org','village_green_org','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (222,'villagegreen.com','villagegreen_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (223,'villagegreen.net','villagegreen_net','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (224,'villagegreen.org','villagegreen_org','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (225,'wearabouts.com','wearabouts_com','master','','','2003-05-04 12:32:39',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (226,'wildanimalpark.com','wildanimalpark_com','master','','ZOO','2003-05-04 12:32:39',20030709095340,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (227,'wildanimalpark.net','wildanimalpark_net','master','','ZOO','2003-05-04 12:32:39',20030709095341,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (228,'wildanimalpark.org','wildanimalpark_org','master','','ZOO','2003-05-04 12:32:40',20030709095343,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (229,'wildbeast.com','wildbeast_com','master','','ZOO','2003-05-04 12:32:40',20030709095344,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (230,'wildbeast.net','wildbeast_net','master','','ZOO','2003-05-04 12:32:40',20030709095347,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (231,'wildbeast.org','wildbeast_org','master','','ZOO','2003-05-04 12:32:40',20030709095348,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (232,'williamlyonhomes.com','williamlyonhomes_com','master','','LYO','2003-05-04 12:32:40',20030709095349,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (233,'williamlyonhomes.net','williamlyonhomes_net','master','','LYO','2003-05-04 12:32:40',20030709095352,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (234,'williamlyonhomes.org','williamlyonhomes_org','master','','LYO','2003-05-04 12:32:40',20030709095353,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (235,'yellowchair.com','yellowchair_com','master','','','2003-05-04 12:32:40',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (236,'yellowchair.net','yellowchair_net','master','','','2003-05-04 12:32:40',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (237,'yellowchair.org','yellowchair_org','master','','','2003-05-04 12:32:40',20030504124033,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (243,'ladera-ranch.org','ladera_ranch_org','master','','LAD','2003-05-06 11:24:39',20030506112846,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (246,'ladera-ranch.cc','ladera_ranch_cc','master','','LAD','2003-05-06 11:26:58',20030506112711,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (245,'ladera-ranch.info','ladera_ranch_info','master','','LAD','2003-05-06 11:26:22',20030506112815,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (238,'59.120.216.in-addr.arpa','59_120_216_in_addr_arpa','master','','',NULL,20030504130208,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (239,'60.120.216.in-addr.arpa','60_120_216_in_addr_arpa','master','','',NULL,20030504130227,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (240,'133.212.65.in-addr.arpa','133_212_65_in_addr_arpa','master','','',NULL,20030504130513,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (247,'playavistaliving.com','playavistaliving_com','master','','AFFL','2003-05-09 16:31:09',20030509163109,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (248,'bringcannyhome.com','bringcannyhome_com','master','','ONG','2003-06-16 19:58:26',20030616195826,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (249,'greenmeadowgrowers.com','greenmeadowgrowers_com','master','','EUR','2003-06-23 12:32:31',20030623123231,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (250,'tehama-realty.com','tehama_realty_com','master','','DMB','2003-06-24 17:55:47',20030624175547,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (251,'bringourcannyhome.org','bringourcannyhome_org','master','','IAI','2003-06-25 16:28:37',20030625162837,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (252,'santaluzrealty.com','santaluzrealty_com','master','','LUZ','2003-06-30 10:11:59',20030630101159,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (253,'laderaranch.net','laderaranch_net','master','','LAD','2003-07-02 11:29:27',20030702112927,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (254,'laderaranchrealty.org','laderaranchrealty_org','master','','LRR','2003-07-02 11:38:26',20030702114426,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (255,'wauwinet.com','wauwinet_com','master','','WAU','2003-07-08 10:27:56',20030709100035,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (256,'harborhousevillage.com','harborhousevillage_com','master','','HHV','2003-07-08 10:27:57',20030708102757,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (257,'harborviewcottages.com','harborviewcottages_com','master','','COT','2003-07-08 10:27:57',20030708102757,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (258,'nantucketboatbasin.com','nantucketboatbasin_com','master','204.249.164.1','NBB','2003-07-08 10:27:58',20030709100950,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (259,'whiteelephanthotel.com','whiteelephanthotel_com','master','','WEH','2003-07-08 10:27:58',20030709100030,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (260,'nantucketislandresorts.com','nantucketislandresorts_com','master','204.249.164.1','NIR','2003-07-08 10:27:58',20030709100950,1,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (261,'centexsouthcoast.com','centexsouthcoast_com','master','','CEN','2003-07-21 18:13:22',20030721181322,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (263,'duxford.com','duxford_com','master','','DUX','2003-07-29 17:03:20',20030729170320,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (265,'monterra-monterey.com','monterra_monterey_com','master','','MON','2003-07-31 10:09:09',20030731100909,0,1,0,'216.120.59.226','dns','mail','activate');
INSERT INTO zones VALUES (266,'prequalnow.com','prequalnow_com','master','','PRE','2003-08-14 10:53:49',20030814105349,0,1,0,'65.212.133.173','dns','mail','activate');
INSERT INTO zones VALUES (267,'thevillageatplayavista.com','thevillageatplayavista_com','master','','vpv','2003-08-14 10:54:27',20030814105427,0,1,0,'65.212.133.173','dns','mail','activate');
INSERT INTO zones VALUES (268,'homequalifynow.com','homequalifynow_com','master','','PRE','2003-08-14 10:55:31',20030814105531,0,1,0,'65.212.133.173','dns','mail','activate');
INSERT INTO zones VALUES (269,'homeprequalify.com','homeprequalify_com','master','','PRE','2003-08-14 10:57:32',20030814105732,0,1,0,'65.212.133.173','dns','mail','activate');

