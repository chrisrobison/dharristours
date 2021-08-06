#!/usr/local/bin/php
<?php
include("/simple.dev/lib/boss_class.php");

array_shift($argv);

$sysdb = new obj("SS_System", 'pimp', 'pimpin', 'localhost');
$sysdb->addResource('App');

while ($client = array_shift($argv)) {
   $dbh = $sysdb->App->execute("select * from App where Host='$client'");
   $row = mysql_fetch_object($dbh);

   $boss = new boss($client.".dev.sscsf.com");
   $email = $row->Email;
   $login = mysql_real_escape_string(preg_replace("/@.*/", '', $email));
   $parts = explode(" ", $row->Name);
   $ln = mysql_real_escape_string(array_pop($parts));
   $fn = mysql_real_escape_string(implode(" ", $parts));

   // First create employee record
   if (mysql_num_rows( $boss->db->dbobj->execute("show tables like 'Employee'"))) {
      $sql = "insert into ".$row->DB.".Employee (Employee, FirstName, LastName, Email, Phone) values ('{$row->Name}', '$ln', '$fn', '{$email}', '{$row->Phone}')";
      $boss->db->dbobj->execute($sql);
      $eid = $boss->db->dbobj->get_insert_id();
      file_put_contents("/simple.dev/log/simpledb.log", $sql."\n", FILE_APPEND);
   }

   // Then create login record
   $sql = "insert into ".$row->DB.".Login (Login, Passwd, FirstName, LastName, Email, Phone, Access, ProcessAccess, EmployeeID) values ('{$login}', sha1('{$row->Passwd}'), '$fn', '$ln', '{$email}', '$row->Phone', (select sum(distinct Access) from Module), (select sum(distinct Access) from Process), '{$eid}')";
   $boss->db->dbobj->execute($sql);
   file_put_contents("/simple.dev/log/simpledb.log", $sql."\n", FILE_APPEND);
   
   /*
   $sql = "insert into ".$row->DB.".Login (Login, Passwd, FirstName, LastName, Email, Phone, Access, ProcessAccess) values ('{$login}', sha1('{$row->Passwd}'), '$ln', '$fn', '{$email}', '$row->Phone', (select sum(distinct Access) from Module), (select sum(distinct Access) from Process))";
   $boss->db->dbobj->execute($sql);
   file_put_contents("/tmp/simpledb.log", $sql."\n", FILE_APPEND);
   */
}
