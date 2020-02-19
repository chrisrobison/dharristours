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

   function buildSelect($list, $id, $key, $val, $name) {
      $out = "<select name='$name' id='$name' class='tissueSelect'>";

      $listcount = count($list);

      for ($l=0; $l<$listcount; $l++) {
         $s = ($list[$l]->$key == $id) ? ' SELECTED' : '';
         $out .= "<option value='".$list[$l]->$key."'$s>".$list[$l]->$val."</option>";
      }
      $out .= "</select>";

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
         if ($key != $rsc.'ID') {
         // $listItems .= "<span class='headCell'>".$field."</span>";
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
            if ($field != $rsc.'ID') {
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
		$obj = new boss();
		$obj->db->addResource('StaticList');
		$obj->db->StaticList->get(null, null, "Name = '$name'");
		$list = $obj->db->StaticList->StaticList[0];
		if (!isset($value) && $list->DefaultValue) $value = $list->DefaultValue;
		if (!$list) return false;
		$obj->db->addResource('StaticListItem');
		$obj->db->StaticListItem->getlist("StaticListID = '" . $list->StaticListID . "' order by Sequence");
		$out = "";
		foreach($obj->db->StaticListItem->StaticListItem as $key=>$rec) {
		   $selected = ($rec->Value == $value) ? ' selected' : '';
			$out .= "\t<option value='{$rec->Value}'$selected>{$rec->Caption}</option>\n";
		}
		return $out;
	}
	
   function sendMail($msg) {
      $msg = preg_replace("/\r\n|\r|\n/s", "\r\n", $msg);

      $sm = popen("/usr/local/sbin/exim -t", 'w');

      if ($sm) {
         fputs($sm, $msg);
         pclose($sm);
      }
      $fh = fopen("/tmp/lastmsg", "w");
      fputs($fh, $msg);
      fclose($fh);
   }
   
   function createEmailMessage($args, $data='' ) {
      $reqHdrs = array('To', 'From', 'Subject');
      $args = (array)$args;
      
      $hdrs[] = "Date: " . date('r');
      foreach ($args as $key=>$arg) {
         $hdrs[$key] = $key . ': ' . $arg;
      }
      
      foreach ($reqHdrs as $req) {
         if (!$hdrs[$req]) {
            print "**Error from createEmailMessage(): Missing required header field '$req'";
            return false;
         }
      }
      return(join("\r\n", $hdrs) . "\r\n\r\n" . $data);
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
      $this->storeRecord($obj, $req);

   }

   function logTransaction($obj) {
      $data = array('Transaction'=>array('new1'=>array()));
      $d =& $data['Transaction']['new1'];
      $d['User'] = $_SESSION['Email'];
      $d['Request'] = $_REQUEST['x'];
      $d['Resource'] = $_REQUEST['Resource'];
      $d['ResourceID'] = (!$_REQUEST[$_REQUEST['Resource'].'ID']) ? $_REQUEST['ID'] : $_REQUEST[$_REQUEST['Resource'].'ID'];
      
      $this->storeRecord($obj, $data);
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
      $active = ($showall) ? '' : " AND Display='Active' ";
      $obj->db->Nav->getlist("ParentID='$id'".$active.$access.' ORDER BY Sequence');
      $top = $obj->db->Nav->Nav;

      if ($withcontent) $obj->db->addResource('Content');
      if (count($top)) {
         foreach ($top as $key=>$val) {
            unset($val->Created);
            unset($val->LastModified);
            
            if ($withaccess) {
               if (($id==0) || ((int) $_SESSION['ContentAccess'] & (int) $val->Access) == $val->Access) {
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
            if ($val->NavID != $val->ParentID) {
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

               $js .= "'".preg_replace("/\'/", "\\'", $k)."':".$this->js_serialize($v, true).",";
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

   function login($boss, $data) {
      $obj = $boss->db;
      $obj->addResource('Login');
      
      if ($data['email']) {
         $obj->Login->get($data['email'], 'Login');
         if (!count($obj->Login->Login)) {
            $obj->Login->get($data['email'], 'Email');
         }
         $user = $obj->Login->Login[0];
         
         if (!$user->LoginID) {
            return false;
         } else {
            if ($data['password'] != $user->Passwd) {
               return false;
            } else {
               $upd = array('LoginID'=>$user->LoginID, 'LoggedIn'=>'1', 'LastLogin'=>date('YmdHis'));
               $obj->Login->update($user->LoginID, $upd);
               $obj->addResource('Groups');
               $obj->Groups->get($user->GroupsID,"GroupsID");
               $grp = $obj->Groups->Groups[0];
               $_SESSION = array();
               $_SESSION['UserID'] = $user->LoginID;
               $_SESSION['Email'] = $user->Email;
               $_SESSION['FirstName'] = $user->FirstName;
               $_SESSION['LastName'] = $user->LastName;
               $_SESSION['Access'] = $grp->Access;
               $_SESSION['ProcessAccess'] = $grp->ProcessAccess;
               $_SESSION['ContentAccess'] = $grp->ContentAccess;
               $_SESSION['Valid'] = 'Yes';
               $_SESSION['Login'] = $user;
         
               /** 
                *  These next two should be removed once everything that references
                *  them has been hunted down and changed to the proper 'Access' & 'ProcessAccess'
                *  session keys
                *
                **/
               $_SESSION['access_level'] = $grp->Access;
               $_SESSION['process_access_level'] = $grp->ProcessAccess;
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
               imagejpeg($thumb, $dest, $quality);
            }
         } else {
            copy($src, $dest);
         }
      }
      return true;
   }

   function imagecreatetransparent($x, $y) {
      $out   = imagecreatetruecolor($x, $y);
      if ($out) {
         imagesavealpha($out, true);
         imagealphablending($out, false);
         $tlo = imagecolorallocatealpha($out, 220, 220, 220, 127);
         imagefill($out, 0, 0, $tlo);
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
            case 8:
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

            if (($field == 'Image') || ($field == 'Thumb')) {
               if ($val->{$field} && file_exists('.'.$val->{$field})) {
                  list($width, $height, $imgtype, $attr) = getimagesize('.'.$val->{$field});
                  while ($width > 75) {
                     $width = intval($width / 2);
                     $height = intval($height / 2);
                  }
               }
         
               $txt = "<img src='" . $val->{$field} . "' width='$width' height='$height' border='0'/>";
            } else {
               $txt = $val->{$field};
            }
            $tbl .= "<td class='navCell$xtraClass'$xtra>" . $txt . "</td>";
         }

         if ($type==0) $tbl .= "<td class='navCell' style='text-align:right;'><a href='oda.php?Resource={$rsc}&x=edit&t={$_REQUEST['t']}&{$rsc}ID=" . $val->{$rsc.'ID'} . "'>edit</a> | <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\">delete</a></td>";
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
             
           if ($val->Dynamic != 1 and $val->TopLevel!=1) { 
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='site.php?Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            } else {
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='site.php?Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> ";
            }
            if ($val->Dynamic != 1 and $val->TopLevel !=1) {
               $tbl .= "<a target='_blank' href='/editor/index.php?{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>modify</a>";
            }
            if (!$val->TopLevel ){
                  if( $val->ParentID!=0 || $val->Dynamic != 1) $tbl .= " | <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> ";
            }
            if (!$val->TopLevel && $val->NavID != 1) $tbl .= "| <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
         }
         if ($type==3) {
            $tbl .= "<td class='navCell' style='text-align:right;'>";
            $tbl .= " <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a>";
            //$tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
         }
         if ($type==4) {
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='site.php?NavID={$navID}&Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==5) {
            $tbl .= "<td class='navCell' style='text-align:right;'>";
            $tbl .= "<a target='_blank' href='site.php?NavID=383&Resource={$rsc}&{$rsc}ID=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==6) {
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='/form.php?id=" . $val->{$rsc.'ID'} . "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type==7) {
            $tbl .= "<td class='navCell' style='text-align:right;'>";
            $tbl .= " <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
            $tbl .= "</td>";
 
         }
         if ($type == 8) {
            $page = '';
            switch($val->Type) {
               case 'news':
                  $page = 'site.php?NavID=381&ArticleID=' . $val->ArticleID;
                  break;
               case 'press release':
                  $page = 'site.php?NavID=382';
                  break;
               case 'event':
                  $page = 'site.php?NavID=382';
                  break;
               case 'snippet':
                  $boss = new boss();
                  $boss->db->addResource('Nav');
                  $boss->db->Nav->getList('Nav="' . $val->Section . '"');
                  $page = 'site.php?NavID=' . $boss->db->Nav->Nav[0]->NavID;
                  // I need to make this link point to the overview page that the shout box sits in
                  break;
               default:
                  break;
            }
            //$tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='/site/" . ($val->Type == 'news' ? 'News.php?aid=' . $val->{$rsc.'ID'} : ($val->Type == 'press release' ? 'PressReleases.php?aid=' . $val->{$rsc.'ID'} : 'Events.php')) . "' style='$vtitle'>view</a> | ";
            $tbl .= "<td class='navCell' style='text-align:right;'><a target='_blank' href='/";
            $tbl .= $page;            
            $tbl .= "' style='$vtitle'>view</a> | ";
            $tbl .= " <a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=edit&{$rsc}ID=" . $val->{$rsc.'ID'} . "' class='oda'>edit</a> | ";
            $tbl .= "<a href='oda.php?t={$_REQUEST['t']}&Resource={$rsc}&x=delete&{$rsc}ID=" . $val->{$rsc.'ID'} . "' onclick=\"return confirm('Are you sure you want to delete this entry?');\" class='oda'>delete</a>";
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
         if (!$nav->TopLevel && $nav->ParentID!=1) {
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
         $boss = new boss();
         $currentNav = $boss->getObject('Nav', $navID);
         $n = 0;
         foreach ($navItems as $title=>$nav) {
            $sel = ($nav->NavID==$navID || ($currentNav->TopLevel == 1 && $n == 0)) ? 'Selected' . ($nav->HasChild == '1' ? ' withSubChildren ' : ''): ($currentNav->ParentID == $nav->NavID ? ' withSubChildrenSelected ' : '' );
            $n ++;
            $icon = $nav->ClassName.$sel;
            $ischild = $this->isNavChild($nav->_children, $navID);
            $xtra = (preg_match("/node/i", $nav->ClassName)) ? 'navNode'.$sel : '';
            $out .= "<a class='navLink$sel $xtra' href='{$nav->URL}'><div class='{$icon}' id='Nav_{$nav->NavID}'>{$nav->Nav}</div></a>";
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

   function flagRelated($id, $rsc='Nav', $flag=1) {
      $boss = new boss();
      $obj = $boss->getObject($rsc, $id);
      
      if ($obj->{$rsc.'ID'}) {
         
         if ($obj->ParentID) {
            // Get object for parent and flag as modified
            $parent = $boss->getObject($rsc, $obj->ParentID);
            $upd[$rsc][$parent->{$rsc.'ID'}]['Modified'] = 2;

            // Get list of siblings and flag them too
            $boss->db->addResource($rsc);
            $boss->db->Nav->getlist('ParentID='.$obj->ParentID);
            
            foreach ($boss->db->{$rsc}->{$rsc} as $item) {
               $upd[$rsc][$item->{$rsc.'ID'}]['Modified'] = 2;
               $childs = $this->getNavChildren($item->{$rsc.'ID'});
               if (count($childs)) {
                  foreach ($childs as $child) {
                     $upd[$rsc][$child->{$rsc.'ID'}]['Modified'] = 2;
                  }
               }
            }
            
            // flag myself
            $upd[$rsc][$id]['Modified'] = $flag;

            // ship it off 
            $boss->storeRecord($upd);

         } else if ($rsc=='Article') {
            switch ($obj->Type) {
               case 'press release':
                  $script = 'genarticles.php';
                  break;
               case 'news':
                  $script = 'genarticles.php';
                  break;
               case 'event':
                  $script = 'genarticles.php';
                  break;
               default:
                  $script = 'genarticles.php';
                  
            }

            if ($script) {
               $boss->db->dbobj->execute("update Nav set Modified='1' where Script like '%{$script}%'");
            }
         }
      }
   }
   

   function readTemplate($file) {
      $out = '';
      $fh = @fopen($file, 'r');
      if ($fh) {
         while ($line = fgets($fh, 4096)) {
            $out .= $line;
         }
         
         fclose($fh);
      }
      return $out;
   }      
   
   function compareContent($file, $content) {
      $txt = $this->readTemplate($file);

      return($txt!=$content);
   }

   function writeFile($file, $content) {
      if ($fh = fopen($file, 'w')) {
         fwrite($fh, $content);
         fclose($fh);
      } else {
         print "Error opening $file for writing\n";
      }
   }

   function genPage($file, $args='') {
      if (file_exists($file)) {
         $fh = popen("/usr/local/bin/php $file $args", 'r');
         $out = '';
         while ($line = fgets($fh, 4096)) {
            $out .= $line;
         }
         pclose($fh);
      } else {
         print "Error generating page: $file does not exist.\n";
      }
      return $out;
   }
}
