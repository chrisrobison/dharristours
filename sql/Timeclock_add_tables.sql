use SS_Seed;
DROP TABLE IF EXISTS MakeupTime;
CREATE TABLE `MakeupTime` (
  `MakeupTimeID` int(15) NOT NULL  AUTO_INCREMENT,
  `MakeupTime` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  PRIMARY KEY (MakeupTimeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS MissedBreak;
CREATE TABLE `MissedBreak` (
  `MissedBreakID` int(15) NOT NULL AUTO_INCREMENT,
  `MissedBreak` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  PRIMARY KEY (MissedBreakID)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS MissedPunch;
CREATE TABLE `MissedPunch` (
  `MissedPunchID` int(15) NOT NULL AUTO_INCREMENT,
  `MissedPunch` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Notes` text,
  `EmployeeID` int(11) DEFAULT NULL,
  `SupervisorID` int(11) DEFAULT NULL,
  `DateMissedPunch` date DEFAULT NULL,
  `IncorrectTime` time DEFAULT NULL,
  `CorrectTime` time DEFAULT NULL,
  `Reason` text,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  PRIMARY KEY (MissedPunchID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS NoteToPayroll;
CREATE TABLE `NoteToPayroll` (
  `NoteToPayrollID` int(15) NOT NULL AUTO_INCREMENT,
  `NoteToPayroll` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Notes` text,
  `SupervisorID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) DEFAULT NULL,
  PRIMARY KEY (NoteToPayrollID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS NoteToSupervisor;
CREATE TABLE `NoteToSupervisor` (
  `NoteToSupervisorID` int(15) NOT NULL AUTO_INCREMENT,
  `NoteToSupervisor` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Notes` text,
  `SupervisorID` int(11) DEFAULT NULL,
  `EmployeeID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (NoteToSupervisorID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Overtime;
CREATE TABLE `Overtime` (
  `OvertimeID` int(15) NOT NULL AUTO_INCREMENT,
  `Overtime` varchar(100) NOT NULL DEFAULT '',
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Notes` text,
  `Date` date DEFAULT NULL,
  `NumberHours` decimal(4,2) DEFAULT NULL,
  `Reason` text,
  `EmployeeEAuth` datetime DEFAULT NULL,
  `SupervisorEAuth` datetime DEFAULT NULL,
  `NoteToSupervisor` text,
  PRIMARY KEY (OvertimeID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS Payroll;
CREATE TABLE `Payroll` (
  `PayrollID` int(8) NOT NULL AUTO_INCREMENT,
  `EmployeeID` int(15) NOT NULL DEFAULT '0',
  `Name` char(60) NOT NULL DEFAULT '',
  `PayNum` int(5) NOT NULL DEFAULT '0',
  `TaxFreq` int(5) DEFAULT NULL,
  `CancelPay` decimal(7,2) DEFAULT NULL,
  `RegEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `TotalHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `VacationHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `VacationEarnings` decimal(4,2) NOT NULL DEFAULT '0.00',
  `SickHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `SickEarnings` decimal(4,2) NOT NULL DEFAULT '0.00',
  `BonusEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `HolidayEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `RetroEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `BereavementEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `MedicalRemitEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `AdjustParking` decimal(7,2) NOT NULL DEFAULT '0.00',
  `PeriodStart` date DEFAULT NULL,
  PRIMARY KEY (PayrollID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS PayrollHourly;
CREATE TABLE `PayrollHourly` (
  `PayrollHourlyID` int(8) NOT NULL AUTO_INCREMENT,
  `EmployeeID` int(15) NOT NULL DEFAULT '0',
  `Name` char(60) NOT NULL DEFAULT '',
  `PayNum` int(5) NOT NULL DEFAULT '0',
  `TaxFreq` int(5) DEFAULT NULL,
  `CancelPay` decimal(7,2) DEFAULT NULL,
  `RegHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `OvertimeHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `DoubletimeHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `VacationHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `SickHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `BonusEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `HolidayEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `RetroEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `BereavementEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `MedicalRemitEarnings` decimal(7,2) NOT NULL DEFAULT '0.00',
  `MealPenaltiesHours` decimal(7,2) NOT NULL DEFAULT '0.00',
  `AdjustParking` decimal(7,2) NOT NULL DEFAULT '0.00',
  `PeriodStart` date DEFAULT NULL,
  `Created` datetime DEFAULT NULL,
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (PayrollHourlyID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS SS_Seed.Timecard;
CREATE TABLE `Timecard` (
  `TimecardID` int(15) NOT NULL AUTO_INCREMENT,
  `Timecard` varchar(100) NOT NULL DEFAULT '',
  `Date` date NOT NULL DEFAULT '0000-00-00',
  `Regular` decimal(3,2) NOT NULL DEFAULT '0.00',
  `Overtime` decimal(3,2) NOT NULL DEFAULT '0.00',
  `Doubletime` decimal(3,2) NOT NULL DEFAULT '0.00',
  `Total` decimal(5,2) NOT NULL,
  `EmployeeID` int(15) NOT NULL DEFAULT '0',
  `Created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastModified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Notes` text,
  PRIMARY KEY (TimecardID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
