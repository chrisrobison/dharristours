INSERT INTO `Module` (`ModuleID`, `Module`, `Resource`, `URL`, `Template`, `Form`, `Help`, `ClassName`, `JS`, `SubmitHandler`, `OverviewQuery`, `OverviewFunction`, `PreCondition`, `PreAction`, `PreFail`, `PostCondition`, `PostAction`, `PostFail`, `Access`, `Buttons`, `Sequence`) VALUES (20,'HR Forms','Action','/timeclock/view.php?t=Personnel','','','','','','','','','','','','','','',4,7,15),(23,'HR Manager','Action','/timeclock/view.php?t=HRManager','','','','','','','','','','','','','','',128,7,16);
INSERT INTO `Process` (`ProcessID`, `ParentID`, `ModuleID`, `Process`, `Resource`, `URL`, `Template`, `Form`, `Help`, `JS`, `SubmitHandler`, `OverviewQuery`, `OverviewFunction`, `OverviewHeight`, `SearchFields`, `PreCondition`, `PreAction`, `PreFail`, `PostCondition`, `PostAction`, `PostFail`, `Access`, `Buttons`, `Sequence`, `ConditionID`, `NoTrack`, `NoTable`, `NoSearch`) VALUES (153,0,20,'Schedule Request','ScheduleRequest','','templates/default.php','templates/ScheduleRequest.php','','','','select ScheduleRequestID, concat(Employee.LastName, \', \', Employee.FirstName) as Employee, ScheduleRequest as Request, ScheduleRequest.Type, date_format(ScheduleRequest.Created, \'%c/%e/%Y\') as Date from ScheduleRequest, Employee where ScheduleRequest.EmployeeID=Employee.EmployeeID\r\n','','','','','','','','','',32768,7,10,0,1,1,1),(154,0,20,'Note to Supervisor','NoteToSupervisor','','templates/default.php','templates/NotetoSupervisor.php','','','','select NoteToSupervisorID, concat(Employee.LastName, \', \', Employee.FirstName) as Employee, NoteToSupervisor as Title, date_format(NoteToSupervisor.Created, \'%c/%e/%Y\') as Date from NoteToSupervisor, Employee where NoteToSupervisor.EmployeeID=Employee.EmployeeID','','','','','','','','','',65536,7,20,0,1,1,1),(155,0,20,'Overtime Authorization','Overtime','','templates/default.php','templates/OvertimeAuthorization.php','','','','','','','','','','','','','',131072,7,30,0,1,1,1),(156,0,20,'Makeup Time Request','MakeupTime','','templates/default.php','templates/MakeupTimeRequest.php','','','','','','','','','','','','','',262144,7,40,0,1,1,1),(157,0,20,'Note to Payroll','NoteToPayroll','','templates/default.php','templates/NotetoPayroll.php','','','','','','','','','','','','','',524288,7,50,0,1,1,1),(158,0,20,'Missed Punch','MissedPunch','','templates/default.php','templates/MissedPunch.php','','','','','','','','','','','','','',1048576,7,60,0,1,1,1),(160,0,20,'Missed Break','MissedBreak','','templates/default.php','templates/MissedBreak.php','','','','','','','','','','','','','',2097152,7,70,0,1,1,1),(166,0,23,'Schedule Request','ScheduleRequest','','templates/default.php','templates/ScheduleRequest.php','','','','select ScheduleRequestID, concat(Employee.LastName, \', \', Employee.FirstName) as Employee, ScheduleRequest as Request, ScheduleRequest.Type, date_format(ScheduleRequest.Created, \'%c/%e/%Y\') as Date from ScheduleRequest, Employee where ScheduleRequest.EmployeeID=Employee.EmployeeID\r\n','','','','','','','','','',32768,7,10,0,1,0,0),(167,0,23,'Note to Supervisor','NoteToSupervisor','','templates/default.php','templates/NotetoSupervisor.php','','','','select NoteToSupervisorID, concat(Employee.LastName, \', \', Employee.FirstName) as Employee, NoteToSupervisor as Title, date_format(NoteToSupervisor.Created, \'%c/%e/%Y\') as Date from NoteToSupervisor, Employee where NoteToSupervisor.EmployeeID=Employee.EmployeeID','','','','','','','','','',65536,7,20,0,1,0,0),(168,0,23,'Overtime Authorization','Overtime','','templates/default.php','templates/OvertimeAuthorization.php','','','','','','','','','','','','','',131072,7,30,0,1,0,0),(169,0,23,'Makeup Time Request','MakeupTime','','templates/default.php','templates/MakeupTimeRequest.php','','','','','','','','','','','','','',262144,7,40,0,1,0,0),(170,0,23,'Note to Payroll','NoteToPayroll','','templates/default.php','templates/NotetoPayroll.php','','','','','','','','','','','','','',524288,7,50,0,1,0,0),(171,0,23,'Missed Punch','MissedPunch','','templates/default.php','templates/MissedPunch.php','','','','select   concat(Employee.LastName, \', \', Employee.FirstName) as Employee, MissedPunch as `Missed Punch`, date_format(MissedPunch.Created, \'%c/%e/%Y\') as Date from MissedPunch, Employee where MissedPunch.EmployeeID=Employee.EmployeeID','','','','','','','','','',1048576,7,60,0,1,0,0),(172,0,23,'Missed Break','MissedBreak','','templates/default.php','templates/MissedBreak.php','','','','','','','','','','','','','',2097152,7,70,0,1,0,0);
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MakeupTime` (
  `MakeupTimeID` int(15) NOT NULL AUTO_INCREMENT,
  `MakeupTime` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `DateOff` date DEFAULT NULL,
  `StartTimeOff` time DEFAULT NULL,
  `EndTimeOff` time DEFAULT NULL,
  `BreakLengthOff` decimal(4,2) DEFAULT NULL,
  `Reason` text,
  `MakeupDate` date DEFAULT NULL,
  `MakeupStartTime` time DEFAULT NULL,
  `MakeupEndTime` time DEFAULT NULL,
  `MakeupBreak` decimal(4,2) DEFAULT NULL,
  `MakeupDate2` date DEFAULT NULL,
  `MakeupStartTime2` time DEFAULT NULL,
  `MakeupEndTime2` time DEFAULT NULL,
  `MakeupBreak2` decimal(4,2) DEFAULT NULL,
  `MakeupDate3` date DEFAULT NULL,
  `MakeupStartTime3` time DEFAULT NULL,
  `MakeupEndTime3` time DEFAULT NULL,
  `MakeupBreak3` time DEFAULT NULL,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  `NoteToSupervisor` text,
  `SupervisorID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`MakeupTimeID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MissedBreak` (
  `MissedBreakID` int(15) NOT NULL AUTO_INCREMENT,
  `MissedBreak` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `MissedBreakDate` date DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  `SupervisorID` int(11) DEFAULT NULL,
  `Reason` text,
  `SupervisorAware` tinyint(4) DEFAULT NULL,
  `EmployeeAware` tinyint(4) DEFAULT NULL,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  `PayrollEAuth` datetime DEFAULT NULL,
  `PayrollComments` text,
  PRIMARY KEY (`MissedBreakID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MissedPunch` (
  `MissedPunchID` int(15) NOT NULL AUTO_INCREMENT,
  `MissedPunch` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `EmployeeID` int(11) DEFAULT NULL,
  `SupervisorID` int(11) DEFAULT NULL,
  `DateMissedPunch` date DEFAULT NULL,
  `IncorrectTime` time DEFAULT NULL,
  `CorrectTime` time DEFAULT NULL,
  `Reason` text,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  PRIMARY KEY (`MissedPunchID`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NoteToPayroll` (
  `NoteToPayrollID` int(15) NOT NULL AUTO_INCREMENT,
  `NoteToPayroll` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `SupervisorID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (`NoteToPayrollID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NoteToSupervisor` (
  `NoteToSupervisorID` int(15) NOT NULL AUTO_INCREMENT,
  `NoteToSupervisor` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `SupervisorID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NoteToSupervisorID`),
  KEY `EmployeeID` (`EmployeeID`),
  KEY `SupervisorID` (`SupervisorID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Overtime` (
  `OvertimeID` int(15) NOT NULL AUTO_INCREMENT,
  `Overtime` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `Date` date DEFAULT NULL,
  `NumberHours` decimal(4,2) DEFAULT NULL,
  `Reason` text,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  `NoteToSupervisor` text,
  PRIMARY KEY (`OvertimeID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ScheduleRequest` (
  `ScheduleRequestID` int(15) NOT NULL AUTO_INCREMENT,
  `ScheduleRequest` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Notes` text,
  `SupervisorID` int(8) DEFAULT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `FirstDay` date DEFAULT NULL,
  `LastDay` date DEFAULT NULL,
  `LeaveTime` time DEFAULT NULL,
  `ReturnTime` time DEFAULT NULL,
  `BenefitUsed` float(4,2) DEFAULT NULL,
  `BenefitRemain` float(4,2) DEFAULT NULL,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  `ModifiedBy` varchar(100) DEFAULT NULL,
  `EmployeeID` int(8) DEFAULT NULL,
  PRIMARY KEY (`ScheduleRequestID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
