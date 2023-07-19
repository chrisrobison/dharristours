<?php
// include_once("clamper_class.php");
/**
 * utility class
 *
 **/
 
//class Utility  extends Clamper{
class Utility {
    function init() {

    }

    function store($obj, $rsc) {
        $obj->db->update($rsc);
    }
    
    function buildGridSearch() {
        global $in;
        global $process;
        global $boss;
        global $rsc;
        
        $sys = $boss->db;

        if ($in['_search']=="true") {
            $cmp = array('eq'=>'=','ne'=>'!=','lt'=>'<','le'=>'<=','gt'=>'>','ge'=>'>=','bw'=>'like','bn'=>'not like','in'=>'like','ni'=>'not like','ew'=>'like','en'=>'not like','cn'=>'like','nc'=>'not like');
            if (!$in['searchString']) {
                if (!$in['searchOper']) $in['searchOper'] = 'cn';

                if ($process && $process->OverviewQuery) {
                    $dbh = $sys->{$rsc}->execute($process->OverviewQuery . " LIMIT 1");
                    $row = mysql_fetch_object($dbh);
                    $fields = array_keys((array)$row);
                } else {
                    $fields = $sys->dbobj->fetch_fields($in['rsc']);
                }
                
                foreach ($fields as $field) {
                    if ($in[$field]!="" && ($field != $rsc."ID")) {
                        $searchArr[] = $field." like '%".$boss->_quote($in[$field], '')."%'";
                        $in['searchField'] = $field;
                        $in['searchString'] = $in[$field];
                    } else if ($in[$field] && ($field == $rsc."ID")) {
                        $searchArr[] = $rsc.'.'.$field." like '%".$boss->_quote($in[$field], '')."%'";
                    }
                }
                if (count($searchArr)) {
                    $searchQuery = implode(" AND ", $searchArr);
                }
            }
 
            if (!$searchQuery) {
                if (preg_match("/bw|bn/", $in['searchOper'])) $in['searchString'] = $in['searchString'] .'%';
                if (preg_match("/ew|en/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'];
                if (preg_match("/in|ni|cn|nc/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'].'%';
                    
                $searchQuery = $in['searchField'] . " " . $cmp[$in['searchOper']] . " " . $boss->_quote($in['searchString']);
            }
        } else {
            $searchQuery = '1=1';
        }
        
        if ($in['sidx'] && $in['sord']) $searchQuery .= " ORDER BY {$in['sidx']} {$in['sord']}";
        
        return $searchQuery;
    }

    /**
     * storeObject - Takes input returned from form and recusively updates, adds, and clamps records
     *
     **/ 
    function storeObject($obj, $data, $parent='', $parentID='') {
        global $in;
        // Grab list of our tables 
        $obj->db->dbobj->list_tables();
        $tbls = $obj->db->dbobj->tables;
        if (!$util) $util = new Utility();

        // Iterate through each table, checking $data for an element of the same name
        // that is also an array
        foreach ($tbls as $idx=>$tbl) {
            //print "Checking for $tbl data...\n";
            
            if (is_array($data[$tbl])) {
              
                if (!$obj->db->$tbl) {
                    $obj->db->addResource($tbl);
                }
// print_r($data);
                if ($in['debug']) {
                    print "________________________\nUpdating $tbl (".count($data[$tbl])." records, ".count($data[$tbl]['new1'])." fields)\n";
                }
                
                // Update all records in this table's array
                $ids = $obj->db->{$tbl}->update_multi($data[$tbl]);

                if ($in['debug']) {
                    print "Updated the following IDs in $tbl: ".join(', ', $ids)."\nChecking related\n";
                }

                if (!count($ids)) {
                    $ids = array_keys($data[$tbl]);
                }

                // Check current $data[table] elements for child tables for each added/updated ID
                foreach ($ids as $ididx=>$newID) {
                    
                    if ((!$in[$tbl.'ID'] || (preg_match("/^new/i", $in[$tbl.'ID']))) && $newID) $in[$tbl.'ID'] = $newID;
                    if (($tbl!='Track') && (!$in['ID'] || (preg_match("/^new/i", $in['ID']))) && $newID) $in['ID'] = $newID;
                    
                    if ($in['debug']) {
                        print "Checking for data related to $newID\n";
                        print_r($data[$tbl]);
                    }
                    if ($data[$tbl][$newID]) {
                        foreach ($data[$tbl][$newID] as $tidx=>$reltbl) {
                            // If we have an array, call storeObject again with child data
                            if (is_array($data[$tbl][$newID][$tidx])) {
                                
                                if ($in['debug']) print "Calling storeObject recursively for $tbl=>$tidx...\n";
                                $pass = array($tidx=>$data[$tbl][$newID][$tidx]);
                                $util->storeObject($obj, $pass, $tbl, $newID);
                            }
                        }
                    }

                    // Clamp record to parent if parent specified
                    if ((isset($parent)) && ($parentID))  {
                        $util->clampRecord($obj->db, $parent, $parentID, $tbl, $newID);
                        $util->clampRecord($obj->db, $tbl, $newID, $parent, $parentID);
                    }
                }
            }
        }
        return $ids;
    }
  
    function getRelated($db, $resource) {
        if (!$db->Clamp) $db->addResource('Clamp');
        
        $db->Clamp->getlist("Local='$resource' and LocalID=0 and RemoteID=0");
        
        return($db->Clamp->Clamp);
    }
    
    function clampRecord($db, $local, $localID, $remote, $remoteID, $doReverse=false) {
        if (!$db->Clamp) $db->addResource('Clamp');
        
        $db->dbobj->execute("delete from Clamp where (Local='$local' and LocalID='$localID' and Remote='$remote' and RemoteID='$remoteID')");
        
        $link = array('Local'=>$local, 'LocalID'=>$localID, 'Remote'=>$remote, 'RemoteID'=>$remoteID);
        $newID = $db->Clamp->add($link);
        
        if ($doReverse) {
            $db->dbobj->execute("delete from Clamp where (Remote='$local' and RemoteID='$localID' and Local='$remote' and LocalID='$remoteID')");
            $link = array('Local'=>$remote, 'LocalID'=>$remoteID, 'Remote'=>$local, 'RemoteID'=>$localID);
            $revID = $db->Clamp->add($link);

            return array($newID, $revID);
        } else {
            return $newID;
        }
    }
    
    function buildSearchSelect($db, $process) {
        $searchtxt = "<select name='searchField' id='searchField'>";
        if ($process->SearchFields) {
            $tmp = preg_split("/\,/", $process->SearchFields);
            foreach ($tmp as $item) {
                list($show, $val) = preg_split("/\:/", $item);
                if (!$val) $val = $show;
                $searchtxt .= "<option value='$val'>$show</option>\n";
            }
            $searchtxt .= "</select>\n";
        } else {
            $flds = $db->dbobj->fetch_fields($process->Resource);

            if (count($flds)) {
                foreach ($flds as $fld) {
                    $searchtxt .= "<option>".$fld."</option>";
                }
                $searchtxt .= "</select>";
            }
        }

        return $searchtxt;
    }
    function sortArrayOfObjects($a, $b) { return (strcmp (strtolower($a['val']), strtolower($b['val']))); } 
    function buildSelect($list, $id, $key, $val, $name) {
        $domid = preg_replace("/^.*\[.*\]\[/", '', preg_replace("/\]$/", '', $name));
        $out = "<select name='$name' id='$domid' rel='$val' class='genSelect'>";
        
        $vals = preg_split("/_/", $val);
        if (count($vals) > 1) {
            $val = $vals[1];
        }


        foreach ($list as $l=>$item) {
            $list[$l]->SortBy = $val;
        }
        uasort($list, function($a, $b) {
            $val = $a->SortBy;
            return (strcmp(strtolower($a->$val), strtolower($b->$val)));
        });
        $listcount = count($list);
        $opts = "<option value=''>--</option>";
        
        foreach ($list as $l=>$item) {
            $s = ($list[$l]->$key == $id) ? ' SELECTED' : '';
            $opts .= "<option value='".$list[$l]->$key."'$s>".$list[$l]->$val."</option>";
        }

        $out .= $opts . "</select>";

        return $out;
    }
    function buildRatesSelect($list, $id, $key, $val, $name, $sortfield='') {
      global $boss;
        $domid = preg_replace("/^.*\[.*\]\[/", '', preg_replace("/\]$/", '', $name));
        $out = "<select name='$name' id='$domid' rel='$val' class='genSelect' style='width:20em;'>";
        
        $vals = preg_split("/_/", $val);
        if (count($vals) > 1) {
            $val = $vals[1];
        }
        if (!$sortfield) {
            $sortfield = $val;
        }
        foreach ($list as $l=>$item) {
            $list[$l]->SortBy = $sortfield;
        }
        uasort($list, function($a, $b) {
            $val = $a->SortBy;
            return (strcmp(strtolower($a->$val), strtolower($b->$val)));
        });
        $listcount = count($list);
        $opts = "<optgroup label='Select Rate'><option value=''>--</option>";
        $optgroup = "";
        foreach ($list as $l=>$item) {
            if ($item->Rate != $optgroup) {
                $opts .= "</optgroup><optgroup label=\"{$item->Rate}\">\n";
                $optgroup = $item->Rate;
            }
         $rates = $boss->getObject("Rates", "RateID='{$item->RateID}'");
            foreach ($rates->Rates as $i=>$obj) {
                if ($obj->RatesID) {
                    $s = ($obj->RatesID == $id) ? ' SELECTED' : '';
                    $opts .= "<option value='".$obj->RatesID."'$s>{$obj->Rate} - {$obj->Pax} [\${$obj->FirstFour}/\${$obj->Overtime}/\${$obj->OneWay}]</option>";
                }
            }
        }

        $out .= $opts . "</select>";

        return $out;
    }
 
    function buildTable($arr, $pid=0, $rsc, $fields='', $sort='', $sortdir='', $captions = null, $tblname='oviewTable') {
        global $in;
        $listItems = ""; 
        $x = 1;
		//sort the array if $sort was passed
		if ($sort) {
		    if ($sortdir == "desc") {
			    $op = ">";
			} else {
			    $op = "<";
			}
		    echo $class;
			$classIterator = md5(rand());
		    eval("class CustomSort" . $classIterator . "Obj {\n "
                ."function cmp_obj(\$a, \$b) {\n "
				    ."\$a = (array)\$a;\n "
				    ."\$b = (array)\$b;\n "
                    ."\$al = strtolower(\$a['$sort']);\n "
                    ."\$bl = strtolower(\$b['$sort']);\n "
                    ."if (\$al == \$bl) {\n "
                        ."return 0;\n "
                    ."}\n "
                    ."return (\$al $op \$bl) ? +1 : -1;\n "
                ."}\n "
            ."}\n ");
            usort($arr, array("CustomSort" . $classIterator . "Obj", "cmp_obj"));
		}
        
        if (!count($arr)) return false;
        
        if (!$fields) {
            $fields = array();
            foreach ($arr[0] as $key=>$val) {
                if (preg_match("/ID|$rsc|Status|LastModified/", $key)) {
                    $fields[] = $key;
                }
            }
        }
		if (!$captions) $captions = $fields;
        $listItems .= "<table id='$tblname' class='listTable' cellpadding='4' cellspacing='0' border='0' width='100%'>";
        // $listItems .= "<div class='headRow'>";
        $listItems .= "<tr class='headRow'>";
        foreach ($fields as $key=>$field) {
            // $listItems .= "<span class='headCell'>".$field."</span>";
            if (!preg_match("/".$rsc."ID/", $field)) {
                $listItems .= "<th onclick=\"doSort('$field')\" class='headCell".(($sort==$field) ? ' sortField' : '').(($sort==$field && $sortdir=='desc')?' desc':'')."'>".$captions[$key]."</th>\n";
            }
        }
        $listItems .= "</tr>\n";
        // $listItems .= "</div><br />\n";

        foreach($arr as $key=>$listItem) {
            $x ^= 1;
            if ($in['ID'] && $rsc && ($in['ID'] === $listItem->{$rsc.'ID'})) {
                $sel = ' current';
                $scrollto = 'row'.$recID;
            } else {
                $sel = '';
            }

            //$listItems .= "<div class='listItemRow row$x'>";
            $listItems .= "<tr class='listItemRow row$x$sel' id='row$recID'>";
            foreach ($fields as $idx=>$field) {
			    $value = $listItem->$field;
				if (!isset($listItem->$field) && is_array($listItem)) {
                    $value = $listItem[$field];
                }
			    $recID = $listItem->{$rsc.'ID'};
				if (!isset($listItem->{$rsc.'ID'}) && is_array($listItem)) {
                    $recID = $listItem[$rsc.'ID'];
                }
                if (!preg_match("/".$rsc."ID/", $field)) {
                    $listItems .= "<td class='listItemCell' onclick=\"loadRecord('".$recID."','$rsc','$pid')\">".$value."&nbsp;</td>";
                }
            }
            $listItems .= "</tr>";
        }
        $listItems .= "</table>\n";
        
        if ($scrollto) {
            //print "<script language='Javascript' type='text/javascript'>\nsetTimeout(\"document.getElementById('$scrollto').scrollIntoView()\", 500);\n</script>\n";
            print "<script language='Javascript' type='text/javascript'>\nvar doScroll = '$scrollto';\n</script>\n";
        }
        
        return $listItems;
    }

    function buildTableFromQuery($db, $pid=0, $rsc, $sql, $sort='', $sortdir='') {
        global $in;
        global $obj;
        
        if ($sort) {
            $sql = preg_replace("/order by.*/i", '', $sql);
            $sql .= ' order by `'.$sort.'` '.$sortdir;
        }

        $oview = $db->execute($sql);
        $arr = array();

        while ($row = $db->fetch_object( )) {
            $arr[] = $row;
        }
        
        if (count($arr)) {
            $fields = array();

            foreach ($arr[0] as $field=>$val) {
                $fields[] = $field;
            }
			return $this->buildTable($arr, $pid, $rsc, $fields, $sort, $sortdir);
        }
		return "";
    }
	
    function makeListOptions($name, $value) {
		$obj=new boss();
//pmp 11-08-11 moved table StaticList to new share db called SS_Share
        $obj->share->addResource('StaticList');
		$obj->share->StaticList->getlist("StaticList='".mysql_real_escape_string($name)."' order by Sequence");
		$slist = $obj->share->StaticList->StaticList;
//ppeterson add UserList to StaticList so StaticList can be expanded by clients
        $uobj=new boss();
		$uobj->db->addResource('UserList');
		$uobj->db->UserList->getlist("UserList='".mysql_real_escape_string($name)."' order by Sequence");
		$ulist = $uobj->db->UserList->UserList;
        $list = $slist + $ulist;
        //$list = array_merge($slist,$ulist);
//ppeterson end change
        if (!$list) return false;
        $out = "<option value=''>--</option>";
        $out .= "<option value=''".($value=='')?' SELECTED':''."></option>";
		foreach($list as $key=>$rec) {
		    $selected = "";
			if ($rec->Value == $value) $selected = " SELECTED";
			$out .= "<option value='" . $rec->Value . "' $selected>" . $rec->Caption . "</option>\n";
		}
		return $out;
	}
	
    function sendMail($msg, $from="support@simpsf.com", $name="Simple Support") {
        // $msg = preg_replace("/\r\n|\r|\n/s", "\r\n", $msg);
        
        //mail('to@blah.com','subject!','body!','From: from@blah.com','-f from@blah.com');
        $xtra = "";
        if ($from) {
            $xtra = "-f" . $from . " -F" . escapeshellarg($name);
        }
        $cmd = "/usr/sbin/sendmail -t $xtra";
        $sm = popen($cmd, 'w');

        if ($sm) {
            fputs($sm, $msg);
            pclose($sm);
        }
        
        $fh = fopen("/tmp/lastmsg", "w");
        fputs($fh, $cmd . "\n\n" . $msg);
        fclose($fh);
    }
    
    function createEmailMessage($to, $from, $cc, $bcc, $subject, $msg) {
	  if ($to) $out .= "To: $to\n";
	  if ($from) $out .= "From: $from\n";
	  if ($cc) $out .= "Cc: $cc\n";
	  if ($bcc) $out .= "Bcc: $bcc\n";
	  if ($subject) $out .= "Subject: $subject\n\n";
	  $out .= $msg;
	  return $out;    
    }
	
    function trackTime($obj, $data=array()) {
        $req = array('Track'=>$data);
        $now = time();
        $req['Track']['new1']['FormTime'] = $now - $_REQUEST['FormStart'];
        $req['Track']['new1']['ProcessID'] = $_REQUEST['ProcessID'];
        $req['Track']['new1']['Resource'] = $_REQUEST['Resource'];
        $req['Track']['new1']['ResourceID'] = $_REQUEST['ID'];
        $req['Track']['new1']['Email'] = $_SESSION['Email'];
        
        if (!$req['Track']['new1']['Quantity']) {
            $req['Track']['new1']['Quantity'] = ceil(($now - $_REQUEST['FormStart']) / 60);
        }
        $this->storeObject($obj, $req);

    }

    function logTransaction($obj) {
        $data = array('Transaction'=>array('new1'=>array()));
        $d =& $data['Transaction']['new1'];
        $d['User'] = $_SESSION['Email'];
        $d['Request'] = $_REQUEST['x'];
        $d['Resource'] = $_REQUEST['Resource'];
        $d['ResourceID'] = (!$_REQUEST[$_REQUEST['Resource'].'ID']) ? $_REQUEST['ID'] : $_REQUEST[$_REQUEST['Resource'].'ID'];
        
        $this->storeObject($obj, $data);
    }

    function buildAccess($in) {
        $modtotal = 0;
        $proctotal = 0;

        foreach ($in as $key=>$val) {
            if (preg_match("/^Process/", $key)) {
                if (!$proctotal & $val) $proctotal += $val;
            } elseif (preg_match("/^Module/", $key)) {
                if (!$modtotal & $val) $modtotal += $val;
            }
        }
        $_REQUEST['ProcessAccess'] = $proctotal;
        $_REQUEST['Access'] = $modtotal;

        return array($modtotal, $proctotal);
    }
    
    function buildNav($obj, $id=0) {
        if (!$nav) $nav = new stdClass;
        $obj->db->addResource('Nav');
        $obj->db->Nav->getlist('ParentID='.$id.' ORDER BY Sequence');
        $top = $obj->db->Nav->Nav;

        if (count($top)) {
            foreach ($top as $key=>$val) {
                $nav->{$val->Nav} = $val;
                $obj->db->Nav->getlist('ParentID='.$val->NavID);
                if ($obj->db->Nav->Nav) {
                    $nav->{$val->Nav.'_children'} = $this->buildNav($obj, $val->NavID);
                }
            }
        }
        $this->Nav = $nav;
        return $nav;
    }
    
    function buildTests($obj, $id=0) {
        if (!$test) $test = new stdClass;
        $obj->db->addResource('Test');
        $obj->db->Test->getlist('ParentID='.$id.' ORDER BY Sequence');
        $top = $obj->db->Test->Test;

        if (count($top)) {
            foreach ($top as $key=>$val) {
                $nav->{$val->Test} = $val;
                
                $obj->db->Test->getlist('ParentID='.$val->TestID);
                if ($obj->db->Test->Test) {
                    $nav->{$val->Test.'_children'} = $this->buildTests($obj, $val->TestID);
                }
            }
        }
        $this->Test = $nav;
        return $nav;
    }


/**
 * js_serialize(@string, @bool)
 *
 * Passed a variable, js_serialize will iterate over each element, building the string
 * required to instantiate a variable of the same type/structure in javascript.  If the 
 * second argument passed is 'true', js_serialize will recurse through any and all child 
 * objects or arrays contained in the passed variable.
 *
 **/
    function js_serialize($var, $recursed = false) {
        return (is_null($var) || is_resource($var)) ? 'null' : json_encode($var);
    }

/**
 * Helper function to check if an array is a hash or indexed.  
 * Returns true if the array is associative
 *
 **/
    function is_assoc_array( $var ) {
        /* Return false if not an array or empty */
        if ( (!is_array($var)) || (!count($var)) ) return false;
      
        foreach($var as $k=>$v) {
             if (! is_int($k)) return true;
        }

        return false;
    }

    function stopwatch(){
        static $mt_previous = 0;

        list($usec, $sec) = explode(" ",microtime());
        $mt_current = (float)$usec + (float)$sec;

        if (!$mt_previous) {
          $mt_previous = $mt_current;
          return "";
        } else {
          $mt_diff = ($mt_current - $mt_previous);
          $mt_previous = $mt_current;
          return sprintf('%.02f',$mt_diff);
        }
    }

    function login($boss, $data) {
        $obj = $boss->db;
        $obj->addResource('Login');
        $daystoexpire = ($data['remember']) ? 7 : 2;
        $expireTime = 60 * 60 * 24 * $daystoexpire; // 2 days
        session_set_cookie_params($expireTime);
        
        if (!session_id()) {
            session_start();
        } else {
            session_regenerate_id(true);
        }

        if ($data['email']) {
            $obj->Login->get($data['email'], 'Email');
            if (!count($obj->Login->Login)) $obj->Login->get(preg_replace("/@.*/", '', $data['email']), 'Login');
            $user = $obj->Login->Login[0];
            
            if (!$user->LoginID) {
                $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
                $sys->addResource('Login');
                $dbh = $sys->Login->execute("select * from SS_System.Login where Email='".mysql_real_escape_string($data['email'])."'");
                if ($dbh) {
		     $user = mysql_fetch_object($dbh);
		     $admin = true;
		     $dbr = $sys->Login->execute("select sum(a.Access) as ModuleAccess from (select distinct(Access) from Module) as a");
		     $mrec = mysql_fetch_object($dbr);
		     $user->Access = $mrec->ModuleAccess;
// select sum(a.Access) from (select distinct(Access) from Process) as a
		     $dbp = $sys->Login->execute("select sum(a.Access) as ProcessAccess from (select distinct(Access) from Process) as a");
		     $prec = mysql_fetch_object($dbp);
		     $user->ProcessAccess = $prec->ProcessAccess;
	     }
            }
            if (!$user->LoginID) {
                return false;
            } else {
                if (($data['password'] != $user->Passwd) && (sha1($data['password']) != $user->Passwd)) {
                    return false;
                } else {
                    $upd = array('LoginID'=>$user->LoginID, 'LoggedIn'=>'1', 'LastLogin'=>date('YmdHis'));
                    if (!$admin) {
                        $obj->Login->update($user->LoginID, $upd);
                        $obj->Login->get($user->Email, 'Email');
                        if (count($obj->Login->Login)) $_SESSION['Login'] = $obj->Login->Login[0];

                        $obj->addResource('Employee');
                        if ($obj->Employee) $obj->Employee->get($user->Email, 'Email');
                        if (count($obj->Employee->Employee)) $_SESSION['Employee'] = $obj->Employee->Employee[0];
                    } else {
                        $_SESSION['Login'] = $user;
                        $_SESSION['Admin'] = true;
                    }
                    $_SESSION['LoginID'] = $user->LoginID;
                    $_SESSION['UserID'] = $user->LoginID;
                    $_SESSION['BusinessID'] = $user->BusinessID;
                    $_SESSION['Email'] = $user->Email;
                    $_SESSION['FirstName'] = $user->FirstName;
                    $_SESSION['LastName'] = $user->LastName;
                    $_SESSION['Access'] = $user->Access;
                    $_SESSION['ProcessAccess'] = $user->ProcessAccess;
                    $_SESSION['Valid']='Yes';
                    session_write_close();

                    return true;
                }
            }
        }
    }
    function switchUser($boss, $in) {
        global $boss;
        global $in;
        $obj = $boss->db;
        $obj->addResource('Login');

        if (!session_id()) {
            session_start();
        } else {
            session_regenerate_id(true);
        }

        if ($_SESSION['Login']->Admin || $_SESSION['Admin']) {
            if (array_key_exists("email", $in)) {
                $obj->Login->get($in['email'], 'Email');
            } else if (array_key_exists("id", $in)) {
                $obj->Login->get($in['id'], 'LoginID');
            }
            $login = $obj->Login->Login[0];

            if (!$login->LoginID) {
                return false;
            }
                 
            $_SESSION['Login'] = $login;
            $_SESSION['Admin'] = 1;
            $_SESSION['LoginID'] = $login->LoginID;
            $_SESSION['UserID'] = $login->LoginID;
            $_SESSION['Email'] = $login->Email;
            $_SESSION['FirstName'] = $login->FirstName;
            $_SESSION['LastName'] = $login->LastName;
            $_SESSION['Access'] = $login->Access;
            $_SESSION['ProcessAccess'] = $login->ProcessAccess;
            $_SESSION['Valid'] = "Yes";
            session_write_close();
            return true;
        }
    }
    function logout($boss) {
        $obj = $boss->db;
        $obj->addResource('Login');

        if ($_SESSION['UserID']) {
            $upd = array('LoginID'=>$_SESSION['UserID'], 'LoggedIn'=>'0');
            $obj->Login->update($_SESSION['UserID'], $upd);
            
            session_unset();	
            session_destroy();
            session_write_close();
        }
    }
    
    function getImages($path) {
        $fh = opendir($path);
        while ($file = readdir($fh)) {
            if (preg_match("/\.(jpg|png|gif)/", $file)) {
                $out[] = $path . '/' . $file;
            }
        }
        return $out;
    }

    function checkThumbs($arr, $path, $type='png') {
        if (!file_exists($path)) mkdir($path, 0775);

        $spath = preg_replace("/\//", '\\/', $_SERVER['DOCUMENT_ROOT']);
        $webpath = preg_replace("/$spath/", '', $path);

        foreach ($arr as $idx=>$file) {
            $paths = preg_split("/\//", $file);
            $tmp = array_pop($paths);
            $tmp2 = preg_split("/\./", $tmp);
            $ext = array_pop($tmp2);
            $fn = join('.', $tmp2);
            $fn .= '.' . $type;

            if (!file_exists($path.'/'.$fn)) {
                $this->makeThumb($file, $path.'/'.$fn, 32, 32, 80);
            }
            $thumbs[$idx] = $webpath . '/' . $fn;
        }
        return $thumbs;
    }

    function makeThumb($src, $dest, $width, $height, $quality) {
        $size = getimagesize($src, $info);
        
        $types = array('', 'gif', 'jpeg', 'png');

        $type = $types[$size[2]];
        if ($type) {
            eval("\$source = imagecreatefrom$type(\$src);");
            
            if (($size[0] > $width) || ($size[1] > $height)) {
                    
                if ($width && ($size[0] > $width) && ($size[0] > $size[1])) {
                    $r = ($width / $size[0]);
                    $width  = $r * $size[0];
                    $height = $r * $size[1];
                } else if ($height && ($size[1] > $height) && ($size[1] > $size[0])) {
                    $r = ($height / $size[1]);
                    $width  = $r * $size[0];
                    $height = $r * $size[1];
                } else {
                    $width = $size[0];
                    $height = $size[1];
                }
                
                if ($width && $height) {
                    $thumb = $this->imagecreatetransparent($width, $height);
                }
                
                if ($thumb) {
                    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
                    imagepng($thumb, $dest, $quality);
                }
            } else {
                copy($src, $dest);
            }
        }
        return true;
    }

    function imagecreatetransparent($x, $y) {
        $out    = @imagecreatetruecolor($x, $y);
        if ($out) {
            imagesavealpha($out, true);
            imagealphablending($out, false);
            $tlo = imagecolorallocatealpha($out, 220, 220, 220, 127);
            imagefill($out, 0, 0, $tlo);
        }
        
        return $out;
    }
    function getFilePath($file) {
        if (!$boss) { $boss = new boss(); }
        $file = preg_replace("|".$_SERVER['DOCUMENT_ROOT']."|", "", $file);

        $check[] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/';
        $check[] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/templates/';
        $check[] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/apps/';
        $check[] = $_SERVER['DOCUMENT_ROOT'].$boss->app->Assets.'/apps/templates/';
        $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/';
        $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/templates/';

        foreach ($check as $path) {
            if (file_exists($path . $file)) {
                return $path.$file;
            }
        }
        return null; 
    }

    function getFile($file) {
        $path = $this->getFilePath($file);
        $content = null;
        if ($path) {
            $content = file_get_contents($path);
        }
        return $content;
    }

    function titlecase($str) {
        $exception = array('/(\b)(Llc)(\b)/','/(\b)(Pr)(\b)/','/(\b)(Dba)(\b)/','/(\b)(Llp)(\b)/','/(\b)(Rpa)(\b)/','/(\b)(Cpa)(\b)/','/(\b)(Ii)(\b)/','/(\b)(Iii)(\b)/','/(\b)(Iv)(\b)/','/(\b)(Vii)(\b)/','/(\b)(Viii)(\b)/','/(\b)(Ix)(\b)/','/(\b)(Xi)(\b)/','/(\b)(Xii)(\b)/','/(\b)(Xiii)(\b)/','/(\b)(Xiv)(\b)/','/(\b)(Xv)(\b)/','/(\b)(Xx)(\b)/','/(\b)(Of)(\b)/','/(\b)(A)(\b)/','/(\b)(The)(\b)/','/(\b)(And)(\b)/','/(\b)(An)(\b)/','/(\b)(Or)(\b)/','/(\b)(Nor)(\b)/','/(\b)(But)(\b)/','/(\b)(Is)(\b)/','/(\b)(If)(\b)/','/(\b)(Then)(\b)/','/(\b)(Else)(\b)/','/(\b)(When)(\b)/','/(\b)(At)(\b)/','/(\b)(From)(\b)/','/(\b)(By)(\b)/','/(\b)(On)(\b)/','/(\b)(Off)(\b)/','/(\b)(For)(\b)/','/(\b)(In)(\b)/','/(\b)(Out)(\b)/','/(\b)(Over)(\b)/','/(\b)(To)(\b)/','/(\b)(Into)(\b)/','/(\b)(With)(\b)/','/(\b)(Usa)(\b)/');
        $replacer  = array('$1LLC$3','$1PR$3','$1DBA$3','$1LLP$3','$1RPA$3','$1CPA$3','$1II$3','$1III$3','$1IV$3','$1VII$3','$1VIII$3','$1IX$3','$1XI$3','$1XII$3','$1XIII$3','$1XIV$3','$1XV$3','$1XX$3','$1of$3','$1a$3','$1the$3','$1and$3','$1an$3','$1or$3','$1nor$3','$1but$3','$1is$3','$1if$3','$1then$3','$1else$3','$1when$3','$1at$3','$1from$3','$1by$3','$1on$3','$1off$3','$1for$3','$1in$3','$1out$3','$1over$3','$1to$3','$1into$3','$1with$3','$1USA$3');
        $str = preg_replace("/\"\"/",'"', $str);
        $str = ucwords(preg_replace("/^[\"\']*/", '', preg_replace("/[\"\']*$/", '', preg_replace("/\s[\'\"]*(\w)/", ' $1', $str))));
        $str = preg_replace($exception, $replacer, $str);
        $str = preg_replace("/(-[a-z])/e","strtoupper('$1')", $str);
        return $str;
    }
}
?>
