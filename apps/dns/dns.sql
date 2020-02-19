CREATE TABLE `DNS` (
  `DNSID` int(15) NOT NULL AUTO_INCREMENT,
  `Zone` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL DEFAULT '@',
  `TTL` int(11) NOT NULL DEFAULT '28800',
  `Type` varchar(50) DEFAULT NULL,
  `Data` varchar(150) DEFAULT NULL,
  `Created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Owner` varchar(100) NOT NULL,
  `MXPriority` int(5) DEFAULT NULL,
  PRIMARY KEY (`DNSID`),
  KEY `Name` (`Name`),
  KEY `Zone` (`Zone`),
  KEY `Name2` (`Zone`,`Name`),
  KEY `Owner` (`Owner`),
  KEY `Type` (`Type`),
  KEY `Zone_2` (`Zone`,`Name`,`Type`),
  KEY `Zone_3` (`Zone`,`Type`)
) ENGINE=InnoDB AUTO_INCREMENT=2786 DEFAULT CHARSET=utf8
