select Job.Job, 
       Job.JobDate as JobDate,
       Job.PickupTime as PickupTime, 
       Job.DropoffTime as DropoffTime, 
       Job.PickupLocation as PickupFrom, 
       Job.DropoffLocation as DropoffTo, 
       concat(Employee.FirstName, ' ', Employee.LastName) as Driver 
   from Job, Bus, Employee 
   where 
      Job.JobDate='2020-02-02' AND 
      Job.BusID=Bus.BusID AND 
      Job.EmployeeID=Employee.EmployeeID AND
      Bus.BusNumber='3301' 

