<?php
/**
 * utility class
 *
 **/
 
class Utility {

   function Utility() {

   }
   
   function store($obj, $rsc) {
      $obj->db->update($rsc);
   }

   /**
    * storeRecord - Takes input returned from form and recusively updates, adds, and clamps records
    *
    **/ 
   function storeRecord($obj, $data, $parent='', $parentID='') {
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
                     // If we have an array, call storeRecord again with child data
                     if (is_array($data[$tbl][$newID][$tidx])) {
                        
                        if ($in['debug']) print "Calling storeRecord recursively for $tbl=>$tidx...\n";
                        $pass = array($tidx=>$data[$tbl][$newID][$tidx]);
                        $util->storeRecord($obj, $pass, $tbl, $newID);
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


   function buildSelect($list, $id, $key, $val, $name, $xtra='') {
      $out = "<select name='$name' id='$name' class=''$xtra>";

      $listcount = count($list);

      for ($l=0; $l<$listcount; $l++) {
         $s = ($list[$l]->$key == $id) ? ' SELECTED' : '';
         $out .= "<option value='".$list[$l]->$key."'$s>".$list[$l]->$val."</option>\n";
      }
      $out .= "</select>";

      return $out;
   }
   
   function buildOptions($list, $keyField, $valField, $id)  {
      foreach ($list as $idx=>$item) {
         if (!preg_match("/\D/", $idx)) {
            $s = ($item->$keyField == $id) ? ' SELECTED' : '';
            $out .= "<option value='".$item->$keyField."'$s>".$item->$valField."</option>\n";
         }
      }
   
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
            $listItems .= "<td onclick=\"doSort('$field')\" class='headCell".(($sort==$field) ? ' sortField' : '').(($sort==$field && $sortdir=='desc')?' desc':'')."'>".$captions[$key]."</td>\n";
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
               // $listItems .= "<td class='listItemCell' onclick=\"loadRecord('".$recID."','$rsc','$pid')\">".$value."&nbsp;</td>";
               $listItems .= "<td class='listItemCell' rel='".$rsc."__".$recID."__".$field."'>".$value."</td>";
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
		$obj->db->addResource('StaticList');
		$obj->db->StaticList->get(null, null, "Name = '$name'");
		$list = $obj->db->StaticList->StaticList[0];
		if (!isset($value) && $list->DefaultValue) $value = $list->DefaultValue;
		if (!$list) return false;
		$obj->db->addResource('StaticListItem');
		$obj->db->StaticListItem->getlist("StaticListID = '" . $list->StaticListID . "' order by Sequence");
		$out = "";
		foreach($obj->db->StaticListItem->StaticListItem as $key=>$rec) {
		   $selected = "";
			if ($rec->Value == $value) $selected = " selected";
			$out .= "<option value='" . $rec->Value . "' $selected>" . $rec->Caption . "</option>\n";
		}
		return $out;
	}
	
   function sendMail($msg) {
      $msg = preg_replace("/\r\n|\r|\n/s", "\r\n", $msg);

      $sm = popen("/usr/sbin/sendmail -t", 'w');

      if ($sm) {
         fputs($sm, $msg);
         pclose($sm);
      }
      $fh = fopen("/tmp/lastmsg", "w");
      fputs($fh, $msg);
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
      global $boss;
      if (!$boss) $boss = new boss();
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
      $boss->storeObject($obj, $req);

   }

   function logTransaction($obj) {
      global $boss;
      if (!$boss) $boss = new boss();
      $data = array('Transaction'=>array('new1'=>array()));
      $d =& $data['Transaction']['new1'];
      $d['User'] = $_SESSION['Email'];
      $d['Request'] = $_REQUEST['x'];
      $d['Resource'] = $_REQUEST['Resource'];
      $d['ResourceID'] = (!$_REQUEST[$_REQUEST['Resource'].'ID']) ? $_REQUEST['ID'] : $_REQUEST[$_REQUEST['Resource'].'ID'];
      
      $boss->storeObject($obj, $data);
   }

   function buildAccess($in) {
      $modtotal = 0;
      $proctotal = 0;

      foreach ($in as $key=>$val) {
         if (preg_match("/^Process/", $key)) {
            $proctotal += $val;
         } elseif (preg_match("/^Module/", $key)) {
            $modtotal += $val;
         }
      }
      $_REQUEST['ProcessAccess'] = $proctotal;
      $_REQUEST['Access'] = $modtotal;

      return array($modtotal, $proctotal);
   }
   
   function buildNav($obj, $id=0, $withcontent=0, $withaccess=0, $showall=0) {
      if (!$nav) $nav = new stdClass;
      $obj->db->addResource('Nav');

      // $access = ($withaccess && $_SESSION['Login']->NavAccess && ($id==0)) ? ' AND ('.$_SESSION['Login']->NavAccess . ' & Access)' : '';
      $active = ($showall) ? '' : " AND Active=1 ";
      $obj->db->Nav->getlist("ParentID='$id'".$active.$access.' ORDER BY Sequence');
      $top = $obj->db->Nav->Nav;

      if ($withcontent) $obj->db->addResource('Content');
      if (count($top)) {
         foreach ($top as $key=>$val) {
            unset($val->Created);
            unset($val->LastModified);
            
            if ($withaccess) {
               if (($id==0) || ($val->Access & $_SESSION['Login']->NavAccess)) {
                  $nav->{$val->Nav} = $val;
               } else {
                  continue;
               }
               // $nav->{$val->Nav} = $val;
            } else {
               $nav->{$val->Nav} = $val;
            }
            // Grab related content pages if requested
/*            if ($withcontent && $val->NavID) {
               $obj->db->Content->getlist('ParentID='.$val->NavID);
               if (count($obj->db->Content->Content)) {
                  $nav->{$val->Nav}->_Content = $obj->db->Content->Content;
               }
            }
*/
            // Check for children and recurse if they exist,
            // taking care not to recurse for records that have their own ID
            // listed as their parent ID
            if ($val->NavID!=$val->ParentID) {
               $children = $this->getNavChildren($val->NavID);
               if ($children) {
                  $nav->{$val->Nav}->_children = $this->buildNav($obj, $val->NavID, $withcontent, $withaccess);
               }
            }
         }
      }
      $this->Nav = $nav;
      return $nav;
   }
   
   function getNavChildren($id) {
      $boss = new boss();
      $boss->db->addResource('Nav');
      $boss->db->Nav->getlist('ParentID='.$id.' AND Display="Active"');
      return $boss->db->Nav->Nav;
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
      if (is_null($var) || is_resource($var)) return 'null';

      $js = '';
      
      /**
       * Handle objects and hashes first
       *
       **/
      if (is_object($var) || $this->is_assoc_array($var)) {
         /* Typecast to array in case we've been passed an object */
         $props = (array)$var;
             
         foreach($props as $k=>$v) {
            if ($k) {
               /* Index values are prefixed with 'idx_' */
               if (is_int($k)) $k = "idx_$k";

               $js .= "'".$k."':".$this->js_serialize($v, true).",";
            }
         }
          
         if (count($props)) {
            $js = substr($js, 0, strlen($js)-1);
         } 
          
         $js = '{'.$js."}";
          
         if (! $recursed) {
            $js = "($js)";
         }

      } elseif (is_array($var)) {      /* Serialize arrays */
         
         // Loop through array, calling js_serialize for each array item
         foreach($var as $v) {
            $js .= $this->js_serialize($v, true).",";
         }
         
         // Chomp off trailing comma (TODO:additions should be done via an array instead of text)
         if (count($var)) $js = substr($js, 0, strlen($js)-1);

         $js = "[$js]";
         
      } elseif (is_string($var)) {     /* Serialize strings */
         
         // Escape our string
         $var = htmlspecialchars($var, ENT_QUOTES);
         $var = preg_replace("/\&amp\;/", '&', $var);
         $var = str_replace( array('"', "\n", "\r"), array('\\"', '\\n'), $var );
         $js = $recursed ? "\"$var\"" : "(new String(\"$var\"))";
     
      } elseif (is_bool($var)) {       /* Serialize booleans */

          $var = ($var)?'true':'false';

          $js = $recursed ? $var : "(new Boolean($var))";
     
      } else {                         /* If we've made it this far, we should be an int or a float */

          $js = $recursed ? $var : "(new Number($var))";
      }

      return $js;
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

   function getPurchases($obj, $rsc, $id) {
      $struct = array($rsc=>array('Purchase'=>1));
      $results = $obj->getObject($rsc, $id, $struct);
      $ids = array();
      if (count($results->Purchase)) {
         foreach ($results->Purchase as $idx=>$rec) {
            $ids[$rec->PurchaseID] = $rec->PurchaseID;
         }
      }
      return $ids;
   }

   function login($boss, $data) {
      $obj = $boss->db;
      $obj->addResource('Login');
      if (session_id() == '') session_start();
      
      $expireTime = 60 * 60 * 24 * 2; // 2 days
      session_set_cookie_params($expireTime);

      if ($data['email']) {
         $obj->Login->get($data['email'], 'Email');
         if (!count($obj->Login->Login)) $obj->Login->get($data['email'], 'Login');

         $user = $obj->Login->Login[0];
         
         if (!$user->LoginID) {
            return false;
         } else {
            if ($data['password'] != $user->Passwd) {
               return false;
            } else {
               $upd = array('LoginID'=>$user->LoginID, 'LoggedIn'=>'1', 'LastLogin'=>date('YmdHis'));
               $obj->Login->update($user->LoginID, $upd);
               $obj->Login->get($user->Email, 'Email');
               if (count($obj->Login->Login)) $_SESSION['Login'] = $obj->Login->Login[0];

               $obj->addResource('Employee');

               $obj->Employee->get($user->Email, 'Email');
               if (count($obj->Employee->Employee)) $_SESSION['Employee'] = $obj->Employee->Employee[0];
               
               $_SESSION['LoginID'] = $user->LoginID;
               $_SESSION['UserID'] = $user->LoginID;
               $_SESSION['Email'] = $user->Email;
               $_SESSION['FirstName'] = $user->FirstName;
               $_SESSION['LastName'] = $user->LastName;
               $_SESSION['Access'] = $user->Access;
               $_SESSION['ProcessAccess'] = $user->ProcessAccess;
               $_SESSION['Valid']='Yes';
         
               /** 
                *  These next two should be removed once everything that references
                *  them has been hunted down and changed to the proper 'Access' & 'ProcessAccess'
                *  session keys
                *
                **/
               $_SESSION['access_level'] = $user->Access;
               $_SESSION['process_access_level'] = $user->ProcessAccess;
               session_write_close();

               return true;
            }
         }
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
   
   function getFiles($path) {
      $out = array();
      $fh = opendir($path);
      while ($file = readdir($fh)) {
         if (!is_dir($path.'/'.$file) &&  !preg_match("/^\./", $file)) {
            $out[] = $path . '/' . $file;
         }
      }
      return $out;
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
      $out   = @imagecreatetruecolor($x, $y);
      if ($out) {
         imagesavealpha($out, true);
         imagealphablending($out, false);
         $tlo = imagecolorallocatealpha($out, 220, 220, 220, 127);
         imagefill($out, 0, 0, $tlo);
      }
      
      return $out;
   }
   
   function getTimeclock($start, $end, $id='', $emp=false) {
      $boss = new boss();
      if ($start > $end) {
         $x = $end;
         $end = $start;
         $start = $x;
      }
      $date['start'] = date("Y-m-d", $start);
      $date['end']   = date("Y-m-d", $end);
      $userid = (!$id) ? '' : 'EmployeeID=' . $id . ' AND ';
      $sql = "SELECT * FROM Timeclock WHERE $userid Date>='".$date['start']."' AND Date<='".$date['end']."'";

      $boss->db->dbobj->execute($sql);
      $employee = array();
      while ($row = $boss->db->dbobj->fetch_object()) {
         $dates = preg_split("/\-/", $row->Date);
         if ($id) {
            if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            }
            if ($emp==true) {
               $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("H:i:s", strtotime($row->Date.' '.$row->Time));
               if ($row->ModifiedBy) $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
               $out['Employee'][$id]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
            } else {
               $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("h:i a", strtotime($row->Date.' '.$row->Time));
               if ($row->ModifiedBy) $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
               $out[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
            }
         } else {
            $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch] = date("H:i:s", strtotime($row->Date.' '.$row->Time));
            if ($row->ModifiedBy) $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'_modified'] = 1;
            $out['Employee'][$row->EmployeeID]->Timeclock[$dates[0]][$dates[1]][$dates[2]][$row->Punch.'ID'] = $row->TimeclockID;
         }
      }
      return $out;
   }
   
   function tallyPunches($start='', $end='', $id='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      
      $boss = new boss();
      $boss->db->addResource('Timecard');
      $tc = $boss->db->Timecard;
     
      $timeclock = $this->getTimeclock($start, $end, $id, true);
      
      if ($timeclock && $timeclock['Employee']) {
         // First loop through each employee
         foreach ($timeclock['Employee'] as $id=>$rec) {
            // Now through timeclock entries, starting with the year
            foreach ($rec->Timeclock as $year=>$months) {
               // Now through the months
               foreach ($months as $month=>$days) {
                  // Now through the days
                  foreach ($days as $day=>$punches) {
                     $weeknum = date('W', strtotime($year.'-'.$month.'-'.$day));
                     if (!$week[$weeknum]) $week[$weeknum] = 0;
                     
                     // Now tally the punches
                     $seconds['in'] = $this->convertSeconds($punches['in']);
                     $seconds['lunch'] = $this->convertSeconds($punches['lunch']);
                     $seconds['return'] = $this->convertSeconds($punches['return']);
                     $seconds['out'] = $this->convertSeconds($punches['out']);
                  
                     $total = 0;
                     if ($seconds['lunch'] && $seconds['in'] && $seconds['out'] && $seconds['return']) {
                        $total = sprintf("%02.2f", (($seconds['lunch'] - $seconds['in']) / 3600) + (($seconds['out'] - $seconds['return']) / 3600));
                     } else if (($seconds['in'] && $seconds['out']) && (!$seconds['lunch'] || !$seconds['return'])) {
                        $total = sprintf("%02.2f", ($seconds['out'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['out'] && !$seconds['return'] && !$seconds['lunch']) {
                        $total = sprintf("%02.2f", ($seconds['out'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['lunch'] && !$seconds['out'] && $seconds['return']) {
                        $total = sprintf("%02.2f", ($seconds['lunch'] - $seconds['in']) / 3600);
                     } else if ($seconds['in'] && $seconds['lunch'] && !$seconds['out'] && !$seconds['return']) {
                        $total = sprintf("%02.2f", ($seconds['lunch'] - $seconds['in']) / 3600);
                     }
                     $upd = array();
                     $out['Timecard']['new1'] = array();
                     $new =& $out['Timecard']['new1'];
                     $new['EmployeeID'] = $id;
                     $new['Date'] = $year.'-'.$month.'-'.$day;
                     $new['Total'] = sprintf("%02.2f", $total);
                     $new['Regular'] = $new['Doubletime'] = $new['Overtime'] = 0;
                     
                     if ($new['Total'] <= 8) {
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = $new['Total'];
                           $week[$weeknum] += $new['Regular'];
                        } else {
                           $new['Regular'] = '0.0';
                           $new['Overtime'] = $new['Total'];
                           $week[$weeknum] += $new['Total'];
                        }
                     } else if ((($new['Total'] > 8) && ($new['Total'] <= 12))) {
                        
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = sprintf("%02.2f", 8);
                           $new['Overtime'] = sprintf("%02.2f", ($new['Total'] - 8));
                        } else {
                           $new['Regular'] = sprintf("%02.2f", 0);
                           $new['Overtime'] = sprintf("%02.2f", $new['Total']);
                        }
                     } else if ($new['Total'] > 12) {
                        $subt = 0;
                        if ($week[$weeknum] <= 40) {
                           $new['Regular'] = sprintf("%02.2f", 8);
                           $subt = -8;
                        }
                        $new['Overtime'] = sprintf("%02.2f", 12 + $subt);
                        $new['Doubletime'] = sprintf("%02.2f", $new['Total'] - 12);
                     }

                     $totals['Regular'] += $new['Regular'];
                     $totals['Overtime'] += $new['Overtime'];
                     $totals['Doubletime'] += $new['Doubletime'];
                     
                     // Check for existing timecard entries for this date and employee
                     $tc->get("$year-$month-$day", 'Date', "EmployeeID='$id'");
                     
                     // Perform update if existing timecard entries exist, otherwise create new entry
                     if (count($tc->Timecard)) {
                        $upd['Timecard'][$tc->Timecard[0]->TimecardID] = $new;

                        $boss->storeObject($upd, 'Timecard');
                     } else {
                        $boss->storeObject($out, 'Timecard');
                     }
                  }
               }
            }
         }
      }
      return $totals;
   }
   
   function getTimecard($start, $end, $id='', $tally='') {
      $boss = new boss();
      if ($start > $end) {
         $x = $end;
         $end = $start;
         $start = $x;
      }
      $date['start'] = date("Y-m-d", $start);
      $date['end']   = date("Y-m-d", $end);
      
      $userid = (!$id) ? '' : 'EmployeeID=' . $id . ' AND ';
      
      if ($tally) $this->tallyPunches($start, $end, $id);

      $sql = "SELECT * FROM Timecard WHERE $userid Date>='".$date['start']."' AND Date<='".$date['end']."' order by EmployeeID, Date";

      $boss->db->dbobj->execute($sql);
      $employee = array();
      while ($row = $boss->db->dbobj->fetch_object()) {
         $dates = preg_split("/\-/", $row->Date);
         if ($id) {
            /* if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            } */
            
            $out[$dates[0]][$dates[1]][$dates[2]] = $row;
         } else {
            if (!$employee[$row->EmployeeID]) {
               $employee[$row->EmployeeID] = $boss->getObject('Employee', $row->EmployeeID);
               $out['Employee'][$row->EmployeeID] = $employee[$row->EmployeeID];
            }
          $out['Employee'][$row->EmployeeID]->Timecard[$dates[0]][$dates[1]][$dates[2]] = $row;
         }
         $out[] = $row;
      }
      return $out;
   }
   
   function convertSeconds($time) {
      $t = preg_split("/\:/", $time);
      if (count($t)>2) $sec = $count[2];
      $sec += ($t[1] * 60); 
      $sec += ($t[0] * 60 * 60);
      
      return $sec;
   }
   
   function buildHourTable($start='', $end='', $id='', $manage='', $nototals='', $periodstart='', $periodend='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 7) : $end;
      $endDate = date("Y-m-d", $end);
      $id = (!$id) ? $_SESSION['Employee']->EmployeeID : $id;
      $boss = new boss();
      $emp = $boss->getObject('Employee', $id);

      // Grab timecard object for start/end dates for EmployeeID
      $times = $this->getTimecard($start, $end, $id);
      
      // Define our row names
      if ($emp->PayStatus=='hourly') {
         $fields = array('Total', 'Regular', 'Overtime', 'Doubletime');
      } else {
         $fields = array('Total');
      }
      
      // Setup each row with the field name associated with that row
      foreach ($fields as $field) { $rows[$field] = "<tr><td class='ts_cell ts_label'>$field</td>"; }
      
      // Loop for 7 days, appending to each relevent row table cell containing 
      // the calculated work time and tracking a sum for each pay type
      for ($i=$start; $i<=$end; $i+=86400) {
         $nowdays = date("Y-m-d-D", $i);
         $nows = preg_split("/\-/", $nowdays);
         $now = $times[$nows[0]][$nows[1]][$nows[2]];
         $xtraBase = (!$now->Regular) ? 1 : '';
         
         $flop = 0;
         foreach ($fields as $field) {
            $xtra = $xtraBase;
            if (($periodstart && $periodend) && (($i < $periodstart) || ($i > $periodend))) $xtra .= ' notnow'.$flop;
            if (($periodstart && $periodend) && (($i >= $periodstart) && ($i <= $periodend))) $totals[$field] += $now->$field;
            $rows[$field] .= "<td class='ts_cell ts_row$flop$xtra'>" . $now->$field . "</td>\n";
            $flop ^= 1;
         }
      }
      if (!$nototals) {
         $flop = 0;
         foreach ($fields as $field) {
            $rows[$field] .= "<td class='ts_cell ts_row{$flop} right'>".sprintf("%01.2f", $totals[$field])."</td><td class='ts_cell ts_label'>$field</td></tr>\n";
            $flop ^= 1;
         }
      } else {
         foreach ($fields as $field) { $rows[$field] = "<td class='ts_cell ts_label'>$field</td></tr>"; }
      }
      $out = $rows['Total'] . $rows['Regular'] . $rows['Overtime'] . $rows['Doubletime'];
      // $out =  $rows['Regular'] . $rows['Overtime'] . $rows['Doubletime'] . $rows['Total'];
      
      if ($nototals) {
         return $out;
      } else {
         return array($out, $totals);
      }
   }
   function buildPunchTable($start='', $end='', $id='', $manage='', $nototals=0, $periodstart='', $periodend='') {
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $end = (!$end) ? $start + (60 * 60 * 24 * 6) : $end;
      
      $boss = new boss();
      $startDate = date("Y-m-d", $start);
      $endDate = date("Y-m-d", $end);
      $id = (!$id) ? $_SESSION['Employee']->EmployeeID : $id;
      $times = $this->getTimeclock($start, $end, $id);
     
      $rows = array( 'head'=>"<tr><th class='ts_head'>&nbsp;</th>",
                     'in'=>"<tr><td class='ts_cell ts_label'>In</td>",
                     'lunch'=>"<tr><td class='ts_cell ts_label'>Lunch</td>",
                     'return'=>"<tr><td class='ts_cell ts_label'>Return</td>",
                     'out'=>"<tr><td class='ts_cell ts_label'>Out</td>"
                     );
      
      $cnt = 0;
      for ($i=$start; $i<=$end; $i+=86400) {
         $nowdays = date("Y-m-d-D", $i);
         $nows = preg_split("/\-/", $nowdays);
         $now = $times[$nows[0]][$nows[1]][$nows[2]];
         $weeknum = date('W', strtotime($nows[0].'-'.$nows[1].'-'.$nows[2]));
         $rows['head'] .= "<th class='ts_head'>".preg_replace("/^0/", '', $nows[1])."/".preg_replace("/^0/", '', $nows[2])."<br/>".$nows[3]."</th>\n";
         $xtraBase = (!count($now)) ? '1' : '';

         print "<!-- Periodstart: $periodstart\n<br/>";
         print "Periodend: $periodend\n<br/>";
         print "I: $i\n<br/> -->";
         if (($periodstart && $periodend) && (($i < $periodstart) || ($i > $periodend))) $xtraBase .= ' notnow';
         
         // In
         $cnt++;
         $xtra = $xtraBase.'0';
         if ($now['in_modified']) $xtra .= ' punchModified0';
         $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['inID']) ? 'new'.$cnt : $now['inID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'in')\" ondoubleclick=\"return false;\"";
         $rows['in'] .= "<td id='in_{$nows[0]}{$nows[1]}{$nows[2]}' name='in_" . ((!$now['inID']) ? 'new'.$cnt : $now['inID']) . "_{$id}' class='ts_cell ts_row0$xtra'$click>" . $now['in'] . "</td>\n";
         
         // Lunch
         $cnt++;
         $xtra = $xtraBase.'1';
         if ($now['lunch_modified']) $xtra .= ' punchModified1';
         $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[".((!$now['lunchID'])?'new'.$cnt:$now['lunchID'])."]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'lunch')\" ondoubleclick=\"return false;\"";
         $rows['lunch'] .= "<td id='lunch_{$nows[0]}{$nows[1]}{$nows[2]}' name='lunch_" . ((!$now['lunchID']) ? 'new'.$cnt : $now['lunchID']) . "_{$id}' class='ts_cell ts_row1$xtra'$click>" . $now['lunch'] . "</td>\n";
         
         // Return
         $cnt++;
         $xtra = $xtraBase.'0';
         if ($now['return_modified']) $xtra .= ' punchModified0';
         $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['returnID']) ? 'new'.$cnt : $now['returnID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'return')\" ondoubleclick=\"return false;\"";
         $rows['return'] .= "<td id='return_{$nows[0]}{$nows[1]}{$nows[2]}' name='return_" . ((!$now['returnID']) ? 'new'.$cnt : $now['returnID']) . "_{$id}' class='ts_cell ts_row0$xtra'$click>" . $now['return'] . "</td>\n";
         
         // Out
         $cnt++;
         $xtra = $xtraBase.'1';
         if ($now['out_modified']) $xtra .= ' punchModified1';
         $click = (!$manage) ? '' : " onclick=\"editPunch(this, 'Timeclock[" . ((!$now['outID']) ? 'new'.$cnt : $now['outID']) . "]','{$nows[0]}-{$nows[1]}-{$nows[2]}', '{$id}', 'out')\" ondoubleclick=\"return false;\"";
         $rows['out'] .= "<td id='out_{$nows[0]}{$nows[1]}{$nows[2]}' name='out_" . ((!$now['outID']) ? 'new'.$cnt : $now['outID']) . "_{$id}' class='ts_cell ts_row1$xtra'$click>" . $now['out'] . "</td>\n";
      }
      if (!$nototals) {
         $rows['head']  .= "<th class='ts_head'>Totals</th><th class='ts_head'></th></tr>";
      } else {
         $rows['head']  .= "<th class='ts_head'></th></tr>";
      } 

      $rows['in']    .= '</tr>';
      $rows['lunch'] .= '</tr>';
      $rows['return'].= '</tr>';
      $rows['out']   .= '</tr>';

      $out =   $rows['head']  . "\n" . 
               $rows['in']    . "\n" . 
               $rows['lunch'] . "\n" . 
               $rows['return']. "\n" . 
               $rows['out']   . "\n";

      return $out;
   }
   
   function doPayroll($start, $end, $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      $split = preg_split("/\-/", $startDate);
      
      $times = $this->getTimecard($start, $end, '', $tally);
      $boss->db->addResource('Payroll');

      foreach ($times['Employee'] as $employee=>$obj) {
         if ($obj->PayStatus=='salary') {
          // print_r($obj); 
            $emp = $boss->getObject('Employee', $employee);
            $out[$employee] = $emp;
            foreach ($obj->Timecard[$split[0]][$split[1]] as $day) {
               if ($day->Total) $out[$employee]->Payroll['new1']['TotalHours'] += $day->Total;
            }
            $out[$employee]->Payroll['new1']['PeriodStart'] = $startDate;
            $out[$employee]->Payroll['new1']['PeriodEnd'] = $endDate;
            $out[$employee]->Payroll['new1']['EmployeeID'] = $employee;
            $out[$employee]->Payroll['new1']['Name'] = $emp->LastName.', '.$emp->FirstName;
            
            $boss->db->Payroll->get($employee, 'EmployeeID', "PeriodStart='".$startDate."'");
            if (count($boss->db->Payroll->Payroll)) {
               if ($boss->db->Payroll->Payroll[0]->VacationHours==0) $out[$employee]->Payroll['new1']['VacationHours'] = $this->getVacation($emp);
               $id = $boss->db->Payroll->Payroll[0]->PayrollID;
            } else {
               $out[$employee]->Payroll['new1']['VacationHours'] = $this->getVacation($emp);
               $id = 'new1';
            }
            $upd['Payroll'][$id] = $out[$employee]->Payroll['new1'];

            $res = $boss->storeObject($upd);
            
         }
      }

   }

   function getVacation($emp) {
      $hired = strtotime($emp->HireDate);
      $onboard = time() - $hired;
      $years = round($onboard / 31536000) + 1;
      $boss = new boss();
      $vacation = $boss->getObject('Vacation', $years);
      return $vacation->HoursPerPeriod;
   }

   function doPayrollHourly($start, $end, $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);
      $split = preg_split("/\-/", $startDate);
      
      $boss->db->addResource('Employee');
      $boss->db->Employee->getlist("PayStatus='hourly'");
      $employees = $boss->db->Employee->Employee;

      // $times = $this->getTimecard($start, $end, '', $tally);
      $boss->db->addResource('PayrollHourly');
      foreach ($employees as $obj) {
         if ($obj->PayStatus=='hourly') {
            
            $times = $this->getTimecard($start, $end, $obj->EmployeeID, $tally);
            // $emp = $boss->getObject('Employee', $employee);
            $employee = $obj->EmployeeID;
            $out[$obj->EmployeeID] = $obj;
            if ($times[$split[0]][$split[1]]) {
               foreach ($times[$split[0]][$split[1]] as $day) {
                  if ($day->Regular) $out[$employee]->PayrollHourly['new1']['RegHours'] += $day->Regular;
                  if ($day->Overtime) $out[$employee]->PayrollHourly['new1']['OvertimeHours'] += $day->Overtime;
                  if ($day->Doubletime) $out[$employee]->PayrollHourly['new1']['DoubletimeHours'] += $day->Doubletime;
               }
            }
            $upd = array();

            $boss->db->PayrollHourly->get($obj->EmployeeID, 'EmployeeID', "PeriodStart='".$startDate."'");
            if (count($boss->db->PayrollHourly->PayrollHourly)>1) {
               $boss->db->dbobj->execute("delete from PayrollHourly where EmployeeID={$obj->EmployeeID} AND PeriodStart='{$startDate}'");
               $boss->db->PayrollHourly->PayrollHourly = array();
            }
            if (count($boss->db->PayrollHourly->PayrollHourly)) {
               $out[$employee]->PayrollHourly['new1']['PeriodStart'] = $startDate;
               $out[$employee]->PayrollHourly['new1']['PeriodEnd'] = $endDate;
               $out[$employee]->PayrollHourly['new1']['EmployeeID'] = $employee;
               $out[$employee]->PayrollHourly['new1']['Name'] = $obj->LastName.', '.$obj->FirstName;
               
               if ($boss->db->PayrollHourly->PayrollHourly[0]->VacationHours==0) $out[$employee]->PayrollHourly['new1']['VacationHours'] = $this->getVacation($obj);
               $id = $boss->db->PayrollHourly->PayrollHourly[0]->PayrollHourlyID;
               $out[$employee]->PayrollHourly['new1']->PayrollHourlyID = $id;
            } else {
               $out[$employee]->PayrollHourly['new1']['VacationHours'] = $this->getVacation($obj);
               $id = 'new1';
            }
            if ($out[$employee]->PayrollHourly['new1']) $upd['PayrollHourly'][$id] = $out[$employee]->PayrollHourly['new1'];

            if (count($upd['PayrollHourly'])) $res = $boss->storeObject($upd);
            
         }
      }
   }
   
   function exportPayrollHourly($start, $end, $html='', $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayrollHourly($start, $end, $tally);
      $boss->db->addResource('PayrollHourly');
      $prfields = "PayrollHourly.EmployeeID,Name,PayNum,TaxFreq,CancelPay,RegHours,OvertimeHours,DoubletimeHours,PayrollHourly.VacationHours,PayrollHourly.SickHours,PayrollHourly.BonusEarnings,PayrollHourly.HolidayEarnings,PayrollHourly.RetroEarnings,PayrollHourly.BereavementEarnings,PayrollHourly.MedicalRemitEarnings,PayrollHourly.MealPenaltiesHours,PayrollHourly.AdjustParking,PayrollHourly.PeriodStart";
      $boss->db->dbobj->execute("select $prfields from PayrollHourly, Employee where PeriodStart='{$startDate}' and PayrollHourly.EmployeeID=Employee.EmployeeID and Employee.PayStatus='hourly'");
      $out = '';
      $fields = '';
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) && (!preg_match("/PayrollHourlyID|LastModified|Created/", $field))) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head'>".join("</th><th class='ts_head'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         if (!$seen[$row['EmployeeID']]) {
            $vals = array();
            foreach ($row as $key=>$val) {
               if (preg_match("/\D/", $key) && (!preg_match("/PayrollHourlyID|LastModified|Created/", $key))) {
                  $vals[$key] = $val;
               }
            }
            if ($html) {
               $out .= "<tr>";
               foreach ($vals as $idx=>$val) {
   //               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\" ondoubleclick='return false;'";
                  $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
                  $out .= "<td class='ts_cell$right'$click>".$val."</td>";
               }
               $out .= "</tr>\n";
            } else {
               $out .= join("\t", $vals)."\n";
            }
         }
         $seen[$row['EmployeeID']] = 1;
      }
      return $out;
   }
   
   function exportPayroll($start, $end, $html='', $tally='') {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayroll($start, $end, $tally);
      $boss->db->addResource('Payroll');
      $prfields = "Payroll.EmployeeID,Name,PayNum,TaxFreq,CancelPay,Payroll.TotalHours,Payroll.RegEarnings,Payroll.VacationHours,Payroll.SickHours,Payroll.BonusEarnings,Payroll.HolidayEarnings,Payroll.RetroEarnings,Payroll.BereavementEarnings,Payroll.MedicalRemitEarnings,Payroll.AdjustParking,Payroll.PeriodStart";
      $boss->db->dbobj->execute("select $prfields from Payroll, Employee where PeriodStart='{$startDate}' and Payroll.EmployeeID=Employee.EmployeeID and Employee.PayStatus='salary' order by Employee.LastName");
      $out = '';
      $fields = '';
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) && (!preg_match("/PayrollID|LastModified|Created/", $field))) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head'>".join("</th><th class='ts_head'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         if (!$seen[$row['EmployeeID']]) {
            $vals = array();
            foreach ($row as $key=>$val) {
               if (preg_match("/\D/", $key) && (!preg_match("/PayrollID|LastModified|Created/", $key))) {
                  $vals[$key] = $val;
               }
            }
            if ($html) {
               $out .= "<tr>";
               foreach ($vals as $idx=>$val) {
   //               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\" ondoubleclick='return false;'";
                  $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
                  $out .= "<td class='ts_cell$right'$click>".$val."</td>";
               }
               $out .= "</tr>\n";
            } else {
               $out .= join("\t", $vals)."\n";
            }
         }
         $seen[$row['EmployeeID']] = 1;
      }
      return $out;
   }
   /*
   function exportPayroll($start, $end, $html='', $tally) {
      $boss = new boss();
      
      $start = (!$start) ? time() - (date('w', time()) * 86400) : $start;
      $startDate = date("Y-m-d", $start);

      $end = (!$end) ? $start + (60 * 60 * 24 * 30) : $end;
      $endDate = date("Y-m-d", $end);

      $this->doPayroll($start, $end, $tally);
      $boss->db->addResource('Payroll');
      $boss->db->dbobj->execute("select * from Payroll where PeriodStart>='{$startDate}'");
      $out = '';
      $fields = '';
      while ($row = $boss->db->dbobj->fetch_array()) {
         if (!$fields) {
            foreach ($row as $field=>$val) {
               if (preg_match("/\D/", $field) ) {
                  $fields[] = preg_replace("/([a-z])([A-Z])/", '$1 $2', $field); 
               }
            }
            if ($html) {
               $out .= "<tr><th class='ts_head2'>".join("</th><th class='ts_head2'>", $fields)."</th></tr>\n";
            } else {
               $out .= join("\t", $fields)."\n";
            }
         }
         $vals = array();
         foreach ($row as $key=>$val) {
            if (preg_match("/\D/", $key)) {
               $vals[$key] = $val;
            }
         }
         if ($html) {
            $out .= "<tr>";
            foreach ($vals as $idx=>$val) {
//               $click = " onclick=\"editPayroll(this, 'Payroll[{$vals['PayrollID']}][{$idx}]')\"";
               $right = (preg_match("/[a-zA-Z]/", $val)) ? '' : ' right';
               $out .= "<td class='ts_cell$right'$click>".$val."</td>";
            }
            $out .= "</tr>\n";
         } else {
            $out .= join("\t", $vals)."\n";
         }
      }
      return $out;
   }
*/
   function listEmployees($id) {
      $boss = new boss();
      $searchEmployee['Employee'];
      $employeeID = $boss->searchObject('Employee', $searchEmployee, '', '', 'LastName');
      $out = '';
      foreach ($employeeID as $value) {
         $employee = $boss->getObject('Employee', $value);
         $out .= '<option' .  ($id == $employee->EmployeeID ? ' SELECTED' : '' ) . ' value="' . $employee->EmployeeID . '">' . $employee->LastName.', ' . $employee->FirstName . '</option>';
      }
      return $out;
   }
   function generatePassword ($length = 10) {
     // start with a blank password
     $password = "";

     // define possible characters
     $possible = '0123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ!@#$%^&'; 
       
     // set up a counter
     $i = 0; 
       
     // add random characters to $password until $length is reached
     while ($i < $length) { 

       // pick a random character from the possible ones
       $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
           
       // we don't want this character if it's already in the password
       if (!strstr($password, $char)) { 
         $password .= $char;
         $i++;
       }

     }

     // done!
     return $password;
   }
   
   function getEmployeeTime($empID, $start) {
      global $boss;
      $employee = $boss->getObject('Employee', $empID);
      
      // Save actual timeperiod start since we're going to munge $start
      $periodstart = $start;

      /**
       * Calculate beginning of week (last Sunday) for requested period date
       * by subtracting the day of the week for our period (0=Sun,1=Mon, etc) 
       * multiplied by the # of seconds in a day (86400) from $start
       *
       **/
      $startday = date("w", $start);
      $start -= ($startday * 86400);
      
      $start2 = $start + (7 * 86400);
      $start3 = $start + (14 * 86400);
      $start4 = $start + (21 * 86400);
      
      $endtmp = date("d", $periodstart);
      $end = ($endtmp==1) ? strtotime(date("Y-m-15", $periodstart)) : strtotime(date("Y-m-t", $periodstart));

      $boss->utility->tallyPunches($start, $end, $empID);
      $punches[0] = $boss->utility->buildPunchTable($start, ($start2 - 60), $empID, 1, 0, $periodstart, $end);
      list($hours[0], $totals[0]) = $boss->utility->buildHourTable($start, ($start2 - 60), $empID, 1, 0, $periodstart, $end);

      $punches[1] = $boss->utility->buildPunchTable($start2, ($start3 - 60), $empID, 1, 0, $periodstart, $end);
      list($hours[1], $totals[1]) = $boss->utility->buildHourTable($start2, ($start3 - 60), $empID, 1, 0, $periodstart, $end);
      
      $punches[2] = $boss->utility->buildPunchTable($start3, ($start4 - 60), $empID, 1, 0, $periodstart, $end);
      list($hours[2], $totals[2]) = $boss->utility->buildHourTable($start3, ($start4 - 60), $empID, 1, 0, $periodstart, $end);
      
      $out['Punches'] = $punches;
      $out['Hours'] = $hours;
      $out['Totals'] = $totals;

      return $out;
   }
   
   function buildPayperiodSelect($current) {
      // Build date selection box for 1 years worth of payperiods
      $sixago = strtotime("6 months ago");
      $sixagoDate = date('Y-m-1', $sixago);
      $sixago = strtotime($sixagoDate);

      $now = time();
      for ($i=0; $i<12; $i++) {
         $val = date("Y-m-01", $sixago);
         $val .= date(":Y-m-15", $sixago);
         
         $val2 = date("Y-m-16", $sixago);
         $val2 .= date(":Y-m-t", $sixago);
         
         $s = ($val == $current) ? ' SELECTED' : '';
         $out .= "<option value='$val'$s>".date("F 1, Y", $sixago).' - '.date("F 15, Y", $sixago)."</option>\n";
         
         $s = ($val2 == $current) ? ' SELECTED' : '';
         $out .= "<option value='$val2'$s>".date("F 16, Y", $sixago).' - '.date("F t, Y", $sixago)."</option>\n";

         $sixago += (date("t", $sixago)*86400);
      }
      
      return $out;
   }

   function getMyEmployees($supID) {
      $search['Employee']['search']['SupervisorID'] = $supID;
      $boss = new boss();
      $ids = $boss->searchObject('Employee', $search, '', '', 'LastName');
      $out = array();

      if (count($ids)) {
         foreach ($ids as $id) {
            $emp = $boss->getObject('Employee', $id);

         }
      }

      return $out;
   }
   function buildODASelect($rsc, $nav, $depth=0, $fields='',$selected='') {
      foreach ($nav as $key=>$val) {
         $s = ($val->{$rsc.'ID'} == $selected) ? ' SELECTED' : '';
         $opt .= str_repeat("\t", $depth) . "<option value='" . $val->{$rsc.'ID'} . "'$s>" . str_repeat('--', $depth);
         if (!$fields) {
            $opt .= $val->{$rsc};
         } else {
            foreach ($fields as $field) {
               $opt .= $val->{$field} . ' ';
            }
         }
         $opt .= "</option>\n";
         if ($val->_children) $opt .= $this->buildODASelect($rsc, $val->_children, ($depth + 1), $fields, $selected);
         if ($val->_Content) $tbl .= $this->buildODASelect('Content', $val->_Content, ($depth + 1), $fields, $selected);
      }
      return $opt;
   }
   
   function buildODATable($rsc, $nav, $depth=0, $fields='', $sect='', $type=0, $navID=0) {
      if (!$fields) $fields = array($rsc=>preg_replace("/(\w)([A-Z])/", '$1 $2', $rsc));
      $sect = (!$sect) ? 'Sections' : $sect;

      if ($depth == 0) {
         $tbl = "<tr>";
         $s = " style='text-align:left;'";
         foreach ($fields as $key=>$val) {
            $tbl .= "<th class='navHead'$s>" . $key . "</th>";
         }
         switch ($type) {
            case 0:
               $tbl .= "<th style='text-align:right;' class='navHead'>Action</th>";
               break;
            case 1:
               $tbl .= "<th class='navHead'>Order</th>";
               break;
            case 2:
               $tbl .= "<th style='text-align:right;padding-right:2em;' class='navHead'>Action</th>";
               break;
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
               $tbl .= "<th style='text-align:right;padding-right:2em;' class='navHead'>Actions</th>";
               break;
         }
         $tbl .= "</tr>\n";
      }

      $vtitle = 'color:#003333;';
      foreach ($nav as $key=>$val) {
         $firstcell = 0;
         $tbl .= "<tr>";
         foreach ($fields as $name=>$field) {
            $xtra = (!$firstcell && ($val->ParentID!=0)) ? " style='padding-left:" . (($depth * 16) + 24) . "px;background-position:".($depth * 16)."px;'" : '';
            if ($val->TopLevel) $xtra = " style='padding-left:8px;'";
            $xtraClass = (!$firstcell && ($val->ParentID!=0) && (($type==2) && ($val->TopLevel!=1)) ) ? ' childNodeArrow' : '';
            $xtraClass .= (!$firstcell && ($val->ParentID!=0)) ? ' childNode' : '';
            $xtraClass .= (!$firstcell && ($val->ParentID!=0) && (($type==2) && ($val->TopLevel==1)) ) ? ' topLevel' : '';
            if (!$firstcell) $firstcell = 1;
            $tbl .= "<td class='navCell$xtraClass'$xtra>" . $val->{$field} . "</td>";
         }

         if ($type==0) $tbl .= "<td class='navCell' style='text-align:right;'><a href='cmd.php?Resource={$rsc}&x=edit&t={$_REQUEST['t']}&{$rsc}ID=" . $val->{$rsc.'ID'} . "'>edit</a> | <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\">delete</a></td>";
         if ($type==1) $tbl .= "<td class='navCell' style='text-align:center'><input type='text' name='{$rsc}[".$val->{$rsc.'ID'}."][Sequence]' size='3' style='width:4em;' value='{$val->Sequence}'/></td>";
         if ($type==2) {
            /**
             * This was to check for existing content and changing the color of the link according
             * to the content availablity for this nav item.
             *
             *
            $boss = new boss();
            $boss->db->addResource('Content');
            $boss->db->Content->get($val->NavID, 'NavID');
            $content = $boss->db->Content->Content[0];
            $vtitle = (strlen($content->Content) > 0) ? 'color:#003333;' : 'color:#a0a0a0;';
             *
             **/
             
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='site.php?Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= "<a target='_blank' href='/editor/index.php?{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>modify</a>";
            $tbl .= " | <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> ";
            if (!$val->TopLevel) $tbl .= "| <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
         }
         if ($type==3) {
            $tbl .= "<td class='navCell' style='text-align:right;'>";
            $tbl .= " <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
         }
         if ($type==4) {
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='site.php?NavID={$navID}&Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==5) {
            $tbl .= "<td class='navCell' style='text-align:right;'><a href='cmd.php?t=Applicants&JobID=" . $val->JobID . "' style='$vtitle'>view applicants</a> | ";
            $tbl .= "<a target='_blank' href='site.php?type=".urlencode($val->Type)."&NavID={$val->NavID}&Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==6) {
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='/site/form.php?id=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==7) {
            $tbl .= "<td class='navCell' style='text-align:right;'>";
            $tbl .= " <a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='cmd.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         $tbl .= "</tr>\n";
         
         if ($val->_children) $tbl .= $this->buildODATable($rsc, $val->_children, ($depth + 1), $fields, $sect, $type);
         if ($val->_Content) $tbl .= $this->buildODATable('Content', $val->_Content, ($depth + 1), array('Section'=>'Name','Status'=>'Display'), $sect, $type);
      }
      return $tbl;
   }
   
   function getTopLevel($navID) {
      if (!$navID) return false;
      $boss = new boss();
      $nav = $boss->getObject('Nav', $navID);
      if ($nav->NavID) {
         if (!$nav->TopLevel && $nav->ParentID) {
            $result = $this->getTopLevel($nav->ParentID);
         } else {
            $result = $nav->NavID;
         }
      }
      return $result;
   }
   
   function isNavChild($navItems, $navID) {
      if ($navItems) {
         foreach ($navItems as $nav) {
            if ($navID==$nav->NavID) {
               return true;
            }
            if ($nav->_children) {
               $result = $this->isNavChild($nav->_children, $navID);
               if ($result) return $result;
            }
         }
      }
      return false;
   }
   
   function buildNavHTML($root='navContainer', $navItems, $navID=0, $show='', $top=0) {
//      print "------------\n\tNav Item: $who\n\tValues:\n ";
//      foreach ($navItems as $key=>$val) { print "\t\t$key: $val\n"; }
      
      if ($navItems) {
         foreach ($navItems as $title=>$nav) {
            $sel = ($nav->NavID==$navID) ? 'Selected' : '';
            $icon = $nav->ClassName.$sel;
            $ischild = $this->isNavChild($nav->_children, $navID);
            $xtra = (preg_match("/node/i", $nav->ClassName)) ? 'navNode'.$sel : '';
            $out .= "<div class='{$icon}' id='Nav_{$nav->NavID}'><a class='navLink$sel $xtra' href='/site/{$nav->File}'>{$nav->Nav}</a></div>";
            if ($nav->_children && ($ischild || $show || $sel)) {
               $show = (($nav->NavID==$navID) || $top || $show || $this->isNavChild($nav->_children, $navID)) ? '' : " style='display:none;'";
               $out .= "<div id='{$nav->Nav}_children'$show>";
               $out .= $this->buildNavHTML($nav->Nav, $nav->_children, $navID);
               $out .= "</div>";
            }
         }
      }
      return $out;
   }
   
   function getCVSTags($file, $today='') {
      if ($today) $date = date('Ymd', time());
      $fh = popen('/usr/bin/cvs status -v ' . $file, 'r');
      while ($line = fgets($fh, 4096)) {
         if ($tagstart) {
            if (preg_match("/^\s*([\w\-\.]+)\s+\(revision/", $line, $match)) {
               if ($today) {
                  if (preg_match("/$date/", $line)) $tags[] = $match[1];
               } else {
                  $tags[] = $match[1];
               }
            }
         }
         if (preg_match("/Existing\sTags\:/i", $line)) $tagstart = 1;
      }
      pclose($fh);
      return $tags;
   }
   
   function formatCurrency($num) {
      $num = preg_replace("/[^0-9\.\-]+/", '', $num);
      return('$'.number_format($num, 2, '.', ','));
   }

   function stripFileList($dir) {
      $files = $this->getFiles($dir);

      foreach ($files as $file) {
         $key = preg_replace("/".preg_quote($dir, '/')."\//", '', $file);
         $key = strtoupper(preg_replace("/\..*/", '', $key));
         $out.= "<a href='".$file."'>".$key."</a><br/>\n";
         
      }
      return($out);
   }

   function compoundInterest($amount, $percent, $length) {
      if ($percent > 1.0) $percent /= 100.0;
      
      $paid = 1;
      for ($i=0; $i<$length; $i++) {
         $result[$i] = $amount * ($paid *= (1 + $percent));
      }

      return($result);
   }

   function compoundTotal($amount, $percent, $length) {
      if ($percent > 1.0) $percent /= 100.0;
      
      $paid = 1;
      for ($i=0; $i<$length; $i++) {
         $result[$i] = $amount * ($paid *= (1 + $percent));
         $total = $result[$i];
      }
      return(sprintf("%0.02f", $total));
   }

   function getSetAside($rate, $fee, $length) {
      $obj->rate = $rate;
      $obj->fee = $fee;
      $obj->length = $length;
      $comp  =  $obj->fee * ((pow((1+$obj->rate),($obj->length+1)) - (1+$obj->rate)) / ($obj->rate * pow((1+$obj->rate), $obj->length)));

      return $comp;
   }

   function titleCase($string) {
      $len=strlen($string);
      $i=0;
      $last= "";
      $new= "";
      $string=strtoupper($string);
      while ($i<$len):
         $char=substr($string,$i,1);
         if (ereg( "[A-Z]",$last)):
            $new.=strtolower($char);
         else:
            $new.=strtoupper($char);
         endif;
      $last=$char;
      $i++;
      endwhile;
      return($new);
   } 
}

   
?>
