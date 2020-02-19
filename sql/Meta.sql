CREATE TABLE `Meta` (
  `MetaID` int(15) NOT NULL auto_increment primary key,
  `Resource` varchar(75) NOT NULL default '',
  `Field` varchar(75) NOT NULL default '',
  `Datatype` varchar(75) NOT NULL default '',
  `Validation` varchar(75) NOT NULL default '',
  `Input` varchar(75) NOT NULL default '',
  `Output` text default '',
  `Default` varchar(75) NOT NULL default '',
  `Script` varchar(75) NOT NULL default '',
  `SQL` varchar(75) NOT NULL default ''
);
