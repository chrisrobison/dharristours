create table incident (
   incidentID int(10) not null auto_increment primary key,
   Incident char(50) not null default '',
   Fix text,
   Cause text,
   Solution text,
   Notes text,
   Clients char(150) not null default '',
   Services char(150) not null default '',
   Hosts char(150) not null default '',
   Downtime char(25) not null default '',
   Time datetime,
   TimeFixed datetime,
   NotifiedBy char(150) not null default '',
   NotifiedAt datetime,
   Created datetime,
   LastModified timestamp
);   

