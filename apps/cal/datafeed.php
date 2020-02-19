<?php
require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");
include_once("functions.php");

global $boss;

function addCalendar($boss, $st, $et, $sub, $ade){
  $ret = array();
  try{
    $sql = "insert into `Calendar` (`Calendar`, `StartTime`, `EndTime`, `AllDayEvent`, `Owner`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2mysqltime(js2PhpTime($st))."', '"
      .php2mysqltime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($_SESSION['Email'])."' )";
    //print($sql);
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


function addDetailedCalendar($boss, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $sql = "insert into `Calendar` (`Calendar`, `StartTime`, `EndTime`, `AllDayEvent`, `Description`, `Location`, `Color`, `Owner`) values ('"
      .mysql_real_escape_string($sub)."', '"
      .php2mysqltime(js2PhpTime($st))."', '"
      .php2mysqltime(js2PhpTime($et))."', '"
      .mysql_real_escape_string($ade)."', '"
      .mysql_real_escape_string($dscr)."', '"
      .mysql_real_escape_string($loc)."', '"
      .mysql_real_escape_string($color)."', '"
      .mysql_real_escape_string($_SESSION['Email'])."')";
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

function listCalendarByRange($boss, $sd, $ed){
  $ret = array();
  $ret['events'] = array();
  $ret["issort"] =true;
  $ret["start"] = php2jstime($sd);
  $ret["end"] = php2jstime($ed);
  $ret['error'] = null;
  try{
    $sql = "select * from `Calendar` where `starttime` between '"
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
        $row->CalendarID,
        $row->Calendar,
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
        $_SESSION['Email']
      );
    }
	}catch(Exception $e){
     $ret['error'] = $e->getMessage();
  }
  return $ret;
}

function listCalendar($boss, $day, $type){
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
  return listCalendarByRange($boss, $st, $et);
}

function updateCalendar($boss, $id, $st, $et){
  $ret = array();
  try{
    $sql = "update `Calendar` set";
    if ($st) $sql .= " `starttime`='" . php2mysqltime(js2PhpTime($st)) . "', ";
    if ($et) $sql .= " `endtime`='" . php2mysqltime(js2PhpTime($et)) . "' "
      . "where `CalendarID`=" . $id;
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

function updateDetailedCalendar($boss, $id, $st, $et, $sub, $ade, $dscr, $loc, $color, $tz){
  $ret = array();
  try{
    $sql = "update `Calendar` set"
      . " `StartTime`='" . php2mysqltime(js2PhpTime($st)) . "', "
      . " `EndTime`='" . php2mysqltime(js2PhpTime($et)) . "', "
      . " `Calendar`='" . mysql_real_escape_string($sub) . "', "
      . " `AllDayEvent`='" . mysql_real_escape_string($ade) . "', "
      . " `Description`='" . mysql_real_escape_string($dscr) . "', "
      . " `Location`='" . mysql_real_escape_string($loc) . "', "
      . " `Color`='" . mysql_real_escape_string($color) . "' "
      . " `Owner`='" . mysql_real_escape_string($_SESSION['Email']) . "' "
      . "where `CalendarID`=" . $id;
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

function removeCalendar($boss, $id){
  $ret = array();
  try{
    $sql = "delete from `Calendar` where `CalendarID`=" . $id;
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
        $ret = addCalendar($boss, $_POST["CalendarStartTime"], $_POST["CalendarEndTime"], $_POST["CalendarTitle"], $_POST["AllDayEvent"]);
        break;
    case "list":
        $ret = listCalendar($boss, $_POST["showdate"], $_POST["viewtype"]);
        break;
    case "update":
        $ret = updateCalendar($boss, $in["CalendarID"], $_POST["CalendarStartTime"], $_POST["CalendarEndTime"]);
        break; 
    case "remove":
        $ret = removeCalendar($boss,  $in["CalendarID"]);
        break;
    case "adddetails":
      $in = $_REQUEST;
      $cal = $_POST['Calendar'];
      $id = ($in['id']) ? $in['id'] : 'new1';

      $cal[$id]['StartTime'] = date("Y-m-d H:i:s", strtotime($in["stpartdate"] . " " . $in["stparttime"]));
      $cal[$id]['EndTime'] = date("Y-m-d H:i:s", strtotime($in["etpartdate"] . " " . $in["etparttime"]));
      $out['Calendar'] = $cal;
      print_r($out);
      $ids = $boss->storeObject($out);
      if (count($ids)) {
         $ret['IsSuccess'] = true;
         $ret['Msg'] = 'Updated event information.';
         $ret['Call'] = 'refreshCalendar';
      } else {
         $ret['IsSuccess'] = false;
         $ret['Msg'] = 'Error updating event information.';
      }
      /*
        $st = $_POST["stpartdate"] . " " . $_POST["stparttime"];
        $et = $_POST["etpartdate"] . " " . $_POST["etparttime"];
        if(isset($_GET["id"])){
            $ret = updateDetailedCalendar($boss, $_GET["id"], $st, $et, 
                $_POST["Calendar"], isset($_POST["AllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }else{
            $ret = addDetailedCalendar($boss, $st, $et,                    
                $_POST["Calendar"], isset($_POST["AllDayEvent"])?1:0, $_POST["Description"], 
                $_POST["Location"], $_POST["colorvalue"], $_POST["timezone"]);
        }        
        */
        break; 


}
   print json_encode($ret); 



?>
