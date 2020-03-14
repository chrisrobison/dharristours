<?php
require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
include_once("functions.php");

global $boss;

function addAvailability($boss, $st, $et, $sub, $ade){
  $ret = array();
  try{
    $sql = "insert into `Availability` (`Availability`, `StartTime`, `EndTime`, `AllDayEvent`, `Owner`, `LoginID`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .date("Y-m-d H:i:s", strtotime($st))."', '"
      .date("Y-m-d H:i:s", strtotime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($_SESSION['Email'])."','".$_SESSION['LoginID']."' )";
    // print($sql);
		if($boss->db->dbobj->execute($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Successfully added new event.';
      $ret['Data'] = mysql_insert_id();
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}


function addDetailedAvailability($boss, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $sql = "insert into `Availability` (`Availability`, `StartTime`, `EndTime`, `AllDayEvent`, `Description`, `Location`, `Color`, `Owner`, `LoginID`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2mysqltime(js2PhpTime($st))."', '"
      .php2mysqltime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."', '"
      .mysql_real_escape_string($_SESSION['Email'])."', '".$_SESSION['LoginID']."')";
    print($sql);
	 if ($boss->db->dbobj->execute($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    } else {
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'add success';
      $ret['Data'] = mysql_insert_id();
    }
	} catch(Exception $e) {
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function listAvailabilityByRange($boss, $sd, $ed){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2jstime($sd);
  $ret["end"] = php2jstime($ed);
  $ret['error'] = null;
  try{
    $sql = "select * from `Availability` where `LoginID`='".$_SESSION['LoginID']."' AND `starttime` between '"
      .php2mysqltime($sd)."' and '". php2mysqltime($ed)."'";
    $handle = $boss->db->dbobj->execute($sql);
    //print $sql;
    while ($row = mysql_fetch_object($handle)) {
      //$ret['events'][] = $row;
      //$attends = $row->AttendeeNames;
      //if($row->OtherAttendee){
      //  $attends .= $row->OtherAttendee;
      //}
      //print $row->StartTime;
      $ret['events'][] = array(
        $row->AvailabilityID,
        $row->Availability,
        php2jstime(mysql2phptime($row->StartTime)),
        php2jstime(mysql2phptime($row->EndTime)),
        $row->AllDayEvent,
        0, //more than one day event
        //$row->InstanceType,
        0,//Recurring event,
        $row->Color,
        1,//editable
        $row->Location, 
        '',//$attends
        $_SESSION['Email'],
        $_SESSION['LoginID']
      );
    }
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listAvailability($boss, $day, $type){
  $phpTime = js2PhpTime($day);
  // print $phpTime . "+" . $type;
  switch($type){
    case "month":
      $st = mktime(0, 0, 0, date("m", $phpTime), 1, date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime)+1, 1, date("Y", $phpTime));
      break;
    case "week":
      //suppose first day of a week is monday 
      $monday  =  date("d", $phpTime) - date('N', $phpTime) + 1;
      //print date('N', $phpTime);
      $st = mktime(0,0,0,date("m", $phpTime), $monday, date("Y", $phpTime));
      $et = mktime(0,0,-1,date("m", $phpTime), $monday+7, date("Y", $phpTime));
      break;
    case "day":
      $st = mktime(0, 0, 0, date("m", $phpTime), date("d", $phpTime), date("Y", $phpTime));
      $et = mktime(0, 0, -1, date("m", $phpTime), date("d", $phpTime)+1, date("Y", $phpTime));
      break;
  }
  // print '--'.$st . "--" . $et;
  return listAvailabilityByRange($boss, $st, $et);
}

function updateAvailability($boss, $id, $st, $et){
  $ret = array();
  try{
    $sql = "update `Availability` set";
    if ($st) $sql .= " `starttime`='" . php2mysqltime(js2PhpTime($st)) . "', ";
    if ($et) $sql .= " `endtime`='" . php2mysqltime(js2PhpTime($et)) . "' "
      . "where `AvailabilityID`=" . $id;
    //print $sql;
		if($boss->db->dbobj->execute($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function updateDetailedAvailability($boss, $id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $sql = "update `Availability` set"
      . " `StartTime`='" . php2mysqltime(js2PhpTime($st)) . "', "
      . " `EndTime`='" . php2mysqltime(js2PhpTime($et)) . "', "
      . " `Availability`='" . mysql_real_escape_string($sub) . "', "
      . " `AllDayEvent`='" . mysql_real_escape_string($ade) . "', "
      . " `Description`='" . mysql_real_escape_string($dscr) . "', "
      . " `Location`='" . mysql_real_escape_string($loc) . "', "
      . " `Color`='" . mysql_real_escape_string($color) . "' "
      . " `Owner`='" . mysql_real_escape_string($_SESSION['Email']) . "' "
      . "where `AvailabilityID`=" . $id;
    //print $sql;
		if($boss->db->dbobj->execute($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Event updated successfully.';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}

function removeAvailability($boss, $id){
  $ret = array();
  try{
    $sql = "delete from `Availability` where `AvailabilityID`=" . $id;
		if($boss->db->dbobj->execute($sql)==false){
      $ret['IsSuccess'] = false;
      $ret['Msg'] = mysql_error();
    }else{
      $ret['IsSuccess'] = true;
      $ret['Msg'] = 'Succefully';
    }
	}catch(Exception $e){
     $ret['IsSuccess'] = false;
     $ret['Msg'] = $e->getMessage();
  }
  return $ret;
}




header('Content-type:text/javascript;charset=UTF-8');
$method = $_GET["method"];
switch ($method) {
    case "add":
        $ret = addAvailability($boss, $_POST["AvailabilityStartTime"], $_POST["AvailabilityEndTime"], $_POST["AvailabilityTitle"], $_POST["AllDayEvent"]);
        break;
    case "list":
        $ret = listAvailability($boss, $_POST["showdate"], $_POST["viewtype"]);
        break;
    case "update":
        $ret = updateAvailability($boss, $in["AvailabilityID"], $_POST["AvailabilityStartTime"], $_POST["AvailabilityEndTime"]);
        break; 
    case "remove":
        $ret = removeAvailability($boss,  $in["AvailabilityID"]);
        break;
    case "adddetails":
      $in = $_REQUEST;
      $cal = $_POST['Availability'];
      $id = ($in['id']) ? $in['id'] : 'new1';

      $cal[$id]['StartTime'] = date("Y-m-d H:i:s", strtotime($in["stpartdate"] . " " . $in["stparttime"]));
      $cal[$id]['EndTime'] = date("Y-m-d H:i:s", strtotime($in["etpartdate"] . " " . $in["etparttime"]));
      $out['Availability'] = $cal;
      print_r($out);
      $ids = $boss->storeObject($out);
      if (count($ids)) {
         $ret['IsSuccess'] = true;
         $ret['Msg'] = 'Updated event information.';
         $ret['Call'] = 'refreshAvailability';
      } else {
         $ret['IsSuccess'] = false;
         $ret['Msg'] = 'Error updating event information.';
      }
      /*
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"])){
            $ret = updateDetailedAvailability($boss, $_GET["id"], $st, $et, 
                $_POST["Availability"], isset($_POST["AllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }else{
            $ret = addDetailedAvailability($boss, $st, $et,                    
                $_POST["Availability"], isset($_POST["AllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }        
        */
        break; 


}
   print json_encode($ret); 



?>
