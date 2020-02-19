alter VIEW `JobCal` 
AS select 
`Job`.`JobID` AS `JobID`,
`Job`.`JobID` AS `Job`,
`Job`.`Created` AS `Created`,
`Job`.`LastModified` AS `LastModified`,
coalesce(`Employee`.`Employee`,'TBD') as `Employee`,
coalesce(`Job`.`NumberOfItems`,0) AS `NumberOfItems`,
`Job`.`Description` as `Description`,
coalesce(addtime(`Job`.`JobDate`,`Job`.`PickupTime`),addtime(`Job`.`JobDate`,maketime(0,0,1))) AS `StartDateTime`,
(case when (coalesce(time_to_sec(timediff(addtime(`Job`.`JobDate`,coalesce(`Job`.`DropOffTime`,maketime(23,59,59))),addtime(`Job`.`JobDate`,coalesce(`Job`.`PickupTime`,maketime(1,1,1))))),1) < 900) then 14400 else coalesce(time_to_sec(timediff(addtime(`Job`.`JobDate`,coalesce(`Job`.`DropOffTime`,maketime(23,59,59))),addtime(`Job`.`JobDate`,coalesce(`Job`.`PickupTime`,maketime(1,1,1))))),1) end) AS `Duration`,
0 AS `LoginID`,
case 
	when `Job`.`Confirmed` and `Job`.`EmployeeID` = 0 then 'red'
	when `Job`.`Confirmed` and `Job`.`EmployeeID` <> 0 then 'green'
	else 'sandybrown' 
end AS `Color` 
from `Job` 
	left join `Employee` on
		`Job`.`EmployeeID` = `Employee`.`EmployeeID`
where 
	`Job`.`JobDate` is not null
	and `Job`.`JobDate` > (now() + interval -(30) day)
	and not(`Job`.`JobCancelled`);