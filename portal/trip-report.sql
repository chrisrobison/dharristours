select Vehicle, count(LogBookID) Trips, sum(Distance) total_miles, year(StartTime) year, month(StartTime) month from LogBook group by year(StartTime), month(StartTime), Vehicle with rollup;
