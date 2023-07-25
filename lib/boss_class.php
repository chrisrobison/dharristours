<?php
/**
 * boss_class.php - provides flexible framework for business process management and automation
 *
 * @author Christopher D. Robison <cdr@netoasis.net>
 * @copyright (c) Copyright, 2004,2005,2007,2010 - All Rights Reserved
 * @package boss 
 */
/**
 * Boss Class definition
 */
require_once("obj_class.php");
require_once("utility_class.php");

class boss {
   /**
    * Main object constructor 
    *
    **/
   function boss($server="") {
      $this->app = $this->getAppInfo($server);
      $this->share = new obj('SS_Share', 'pimp', 'pimpin', 'localhost');
      $this->db = new obj($this->app->DB, $this->app->DBUser, $this->app->DBPwd, $this->app->DBHost);
 
      $clientutil = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/ClientUtility_class.php';
      
      if (file_exists($clientutil)) {
         require_once($clientutil);
         $this->utility = new ClientUtility();
      } else {
         $this->utility = new utility();
      }
   }
   
   function getAppInfo($server="") {
 
      if (!$server) { $server = ($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "admin.dev.sscsf.com"; }
// error_log("Boss class using server: $server\n");
      $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
      $domparts = explode(".", $server);
      
      $host = array_shift($domparts);
      $domain = join(".", $domparts);
      
      $sys->addResource('App');
      $sys->App->getlist("Host='".$host."' AND Domain='".$domain."'");
      
      if (!count($sys->App->App)) {
         $host .= '.' . array_shift($domparts);
         $domain = join(".", $domparts);
         
         $sys->App->getlist("Host='".$host."' AND Domain='".$domain."'");
         
         if (!count($sys->App->App)) {
            header("Location: http://www.simpsf.com/site/index.php");
            exit;
         }
      }
      return $sys->App->App[0];
   }
   
   function getPath($file) {
      if (!$file) { return false; }
      
      $globalForm = preg_replace("/\/\//", '/', $_SERVER['DOCUMENT_ROOT']."/apps/".$file);
      $localForm = preg_replace("/\/\//", '/', $_SERVER['DOCUMENT_ROOT'].$this->app->Assets."/".$file);
      
      return (!file_exists($localForm) && file_exists($globalForm)) ? $globalForm : $localForm; 
   }

   function makeForm($pid, $current=array()) {
      if (!$pid) die("Invalid Process ID");
      $process = $this->getObject("Process", $pid);
      $rsc = $process->Resource;

      if  ($process->Form && !$_REQUEST['genform']) {
         include($process->Form);
      } else {
         $file = preg_replace("/\s/", '', $process->Process).'.php';
         $file = $this->app->Assets."/templates/".$file;
         
         if (!file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
            $form = $this->buildForm($rsc, $current, 1);

            $fh = fopen($_SERVER['DOCUMENT_ROOT'].$file, 'w');
            if (!fwrite($fh, $form)) print "<h1>Error writing to file templates/$file</h1>";
            fclose($fh);
            system("/usr/bin/cvs ci -m 'Automated check-in of generated form: $file' ".$_SERVER['DOCUMENT_ROOT'].$file);
            $form = $boss->buildForm($rsc, $current);
            print eval("?>".$form);
         }
      }
   }

   function getTables($nosys=1) {
      $forbidden = array();
      if ($nosys) {
         $sys = new obj('SS_System', 'pimp', 'pimpin', 'localhost');
         $sys->addResource('SystemTables');
         $sys->SystemTables->getlist();
         
         foreach ($sys->SystemTables->SystemTables as $systbl) {
            $forbidden[$systbl->SystemTables] = $systbl->SystemTables;
         }
      }
      $this->db->dbobj->list_tables();

      $tables = array();
      foreach ($this->db->dbobj->tables as $key=>$tbl) {
         if (!$forbidden[$tbl]) { 
            $tables[$tbl] = $tbl;
         }
      }
      $this->tables = $tables;
      return $tables;
   }
   
   function get($resource, $id='') {
      
      if (isset($resource)) {     
         $this->db->addResource($resource);
         
         // Perform 'get' if we have a numeric ID
         if (!is_array($id) && preg_match("/^\d+$/", $id)) {
            $this->db->$resource->get($id, $resource.'ID');
         } else if (is_array($id)) {
            $q = array();
            foreach ($id as $key=>$val) {
               $q[] = $resource."ID=".$this->_quote($val);
            }  
            $qt = join(" OR ", $q);
            $this->db->$resource->getlist($qt);
         } else {  // Otherwise, assume query string
            $in = $_GET + $_POST;
            $limit = "";
            if ($in['rows']) {
               $in['page'] = ($in['page']) ? $in['page'] : 1;
               $limit = " LIMIT ".(($in['page'] - 1) * $in['rows']).",".$in['rows'];
            }
            $this->db->$resource->getlist($id.$limit);
         }
         
         return $this->db->$resource->{$resource};
      }
   }

   /**
    * Convenience function to return a data object structure for the 
    * requested ID and resource.  Optionally, you may specify to retrieve 
    * any externally related child records as linked in the Clamp table
    *
    **/
   function getObjectRelated($resource, $id='', $recurse='', $parent='', $reltxt='related_', $seen=array()) {
      if ($recurse=='all') $recurse = $this->getRelationships($resource);
      if ($recurse && $recurse[$resource]) $recurse = $recurse[$resource];
      
      if (!$seen[$resource]) {
         $seen[$resource] = $resource;
         // Add requested resource 
         $this->db->addResource($resource);
         
         // Perform 'get' if we have a numeric ID
         if (!is_array($id) && preg_match("/^\d+$/", $id)) {
            $this->db->$resource->get($id, $resource.'ID');
         } else if (is_array($id)) {
            $q = array();
            foreach ($id as $key=>$val) {
               $q[] = $resource."ID=".$this->_quote($val);
            }  
            $qt = join(" OR ", $q);
            $this->db->$resource->getlist($qt);
         } else {  // Otherwise, assume query string
            $limit = "";
            /*
            $in = $_GET + $_POST;
            if ($in['rows']) {
               $in['page'] = ($in['page']) ? $in['page'] : 1;
               $limit = " LIMIT ".(($in['page'] - 1) * $in['rows']).",".$in['rows'];
            }
            */
            $this->db->$resource->getlist($id.$limit);
         }
         
         $out = array();
         foreach ($this->db->$resource->{$resource} as $idx=>$core) {
            // Retrieve list of relevent clamp records
            $related = $this->getRelated($resource, $core->{$resource.'ID'});
            $acnt = count($related);
            
            // $this->db->$resource->{$resource}[$idx]->{'_clamped'} = $related;
            // $core = $this->db->$resource->{$resource}[0];

            // Loop through clamp records, retrieving all associated remote records
            for ($a=0; $a<$acnt; $a++) {
               $rtbl = $related[$a]->Remote;

               if ($rtbl!=$parent) {
                  $this->db->addResource($rtbl);

                  if ($related[$a]->RemoteID > 0) {
                     $this->db->$rtbl->get($related[$a]->RemoteID, $rtbl.'ID');
                     if (!$this->db->$rtbl->{$rtbl}[0]) $this->db->$rtbl->{$rtbl}[0] = new stdClass();
                     $this->db->$rtbl->{$rtbl}[0]->{'_pid'} = $related[$a]->ProcessID;
                     $this->db->$rtbl->{$rtbl}[0]->{'_context'} = $related[$a]->Context;
                     $this->db->$rtbl->{$rtbl}[0]->{'_ClampID'} = $related[$a]->ClampID;
                  }

                  if (!is_array($core->{$reltxt.$rtbl})) {
                     // $core->{"_clamped_" . $rtbl} = $related;
                     $self = $core->{$reltxt.$rtbl} = $this->db->$rtbl->$rtbl;
                  } else {
                     $oid = $this->db->$rtbl->{$rtbl}[0]->{$rtbl.'ID'};
                     //if ($oid) $self = $core->{$reltxt.$rtbl}[$oid] = $this->db->$rtbl->{$rtbl}[0];
                     $self = $core->{$reltxt.$rtbl}[] = $this->db->$rtbl->{$rtbl}[0];
                     // $core->{$reltxt.$rtbl}[count($core->{$reltxt.$rtbl})-1]->_clamped = $related;
                     // $core->{$reltxt.$rtbl}['_clamped'] = $related;
                  }
                  
                  if ($recurse && $recurse[$rtbl] && is_array($recurse[$rtbl])) {
                     
                     foreach ($recurse[$rtbl] as $key=>$val) {
                        $clamped = $this->db->$rtbl->getClamped($rtbl, $related[$a]->RemoteID, $key);
 
                        if ($clamped && ($rtbl!=$parent)) {
                          foreach ($clamped as $cid) {
                              $tmp = $this->getObjectRelated($key, $cid->{$key.'ID'}, $recurse[$rtbl], $rtbl, $reltxt, $seen, $cid);

                              if (!$core->{$rtbl}[count($core->{$rtbl})-1]->$key) $core->{$rtbl}[count($core->{$rtbl})-1]->$key = array();
                              if ($tmp->{$key.'ID'}) {
                                 $core->{$rtbl}[count($core->{$rtbl})-1]->{$key}[$tmp->{$key.'ID'}] = $tmp;
                                 // $core->{$rtbl}[count($core->{$rtbl})-1]->{$key}[$tmp->{$key.'ID'}]->_Clamp = $related[$a];
                              }
                              //$core->{$rtbl}[count($core->{$rtbl})-1]->{$key}[] = $tmp;
                           }
                        }
                     }
                  } 
               }
            }
            $pkey = $this->db->dbobj->primary_key($resource);
            
            if ($pkey && $core->{$pkey}) {
               $out['_ids'][] = $core->{$pkey};
            }
            $out[] = $core;
         }
         if (!$newout) $newout = new stdClass();
         $newout->{$resource} = $out;
         $this->Object = (preg_match("/^\d+$/", $id)) ? $out[0] : $newout;
         return $this->Object;
      } else {
         return false;
      }
   }

   /**
    * Convenience function to retrieve a record and all data associated
    * with that record by querying the Clamp table for Local table entries
    * with a LocalID of 0 and linking each Remote table.  Alternatively, you 
    * may pass an array structure to define the object returned.
    *
    **/
   function getObject($resource, $id='', $recurse='', $parent='', $seen=array()) {
      if ($recurse=='all') $recurse = $this->getRelationships($resource);
      if ($recurse && $recurse[$resource]) $recurse = $recurse[$resource];
      
      if (!$seen[$resource]) {
         $seen[$resource] = $resource;
         // Add requested resource 
         $this->db->addResource($resource);
         
         // Perform 'get' if we have a numeric ID
         if (!is_array($id) && preg_match("/^\d+$/", $id)) {
            $this->db->$resource->get($id, $resource.'ID');
         } else if (is_array($id)) {
            $q = array();
            foreach ($id as $key=>$val) {
               $q[] = $resource."ID=".$this->_quote($val);
            }  
            $qt = join(" OR ", $q);
            $this->db->$resource->getlist($qt);
         } else {  // Otherwise, assume query string
            $limit = "";
            /*
            $in = $_GET + $_POST;
            if ($in['rows']) {
               $in['page'] = ($in['page']) ? $in['page'] : 1;
               $limit = " LIMIT ".(($in['page'] - 1) * $in['rows']).",".$in['rows'];
            }
            */
            $this->db->$resource->getlist($id.$limit);
         }
         
         $out = array();
         foreach ($this->db->$resource->{$resource} as $core) {
            // Retrieve list of relevent clamp records
            $related = $this->getRelated($resource, $core->{$resource.'ID'});
            $acnt = count($related);
            
            // $this->db->$resource->{$resource}[$idx]->{'_clamped'} = $related;
            // $core = $this->db->$resource->{$resource}[0];

            // Loop through clamp records, retrieving all associated remote records
            for ($a=0; $a<$acnt; $a++) {
               $rtbl = $related[$a]->Remote;
               
               if ($rtbl!=$parent) {
                  $this->db->addResource($rtbl);

                  if ($related[$a]->RemoteID > 0) {
                     $this->db->$rtbl->get($related[$a]->RemoteID, $rtbl.'ID');
                  }

                  if (!is_array($core->$rtbl)) {
                     $self = $core->$rtbl = $this->db->$rtbl->$rtbl;
                  } else {
                     $oid = $this->db->$rtbl->{$rtbl}[0]->{$rtbl.'ID'};
                     if ($oid) $self = $core->{$rtbl}[$oid] = $this->db->$rtbl->{$rtbl}[0];
                  }
                  
                  if ($recurse && $recurse[$rtbl] && is_array($recurse[$rtbl])) {
                     foreach ($recurse[$rtbl] as $key=>$val) {
                        $clamped = $this->db->$rtbl->getClamped($rtbl, $related[$a]->RemoteID, $key);

                        if ($clamped && ($rtbl!=$parent)) {
                           foreach ($clamped as $cid) {
                              $tmp = $this->getObject($key, $cid->{$key.'ID'}, $recurse[$rtbl], $rtbl, $seen);
                              if (!$core->{$rtbl}[count($core->{$rtbl})-1]->$key) $core->{$rtbl}[count($core->{$rtbl})-1]->$key = array();
                              if ($tmp->{$key.'ID'}) $core->{$rtbl}[count($core->{$rtbl})-1]->{$key}[$tmp->{$key.'ID'}] = $tmp;
                              //$core->{$rtbl}[count($core->{$rtbl})-1]->{$key}[] = $tmp;
                           }
                        }
                     }
                  } 
               }
            }
            $pkey = $this->db->dbobj->primary_key($resource);

            if ($pkey && $core->{$pkey}) {
               $out['_ids'][] = $core->{$pkey};
            }
            $out[] = $core;
         }
         if (!$newout) $newout = new stdClass();
         $newout->{$resource} = $out;

         $this->Object = (preg_match("/^\d+$/", $id)) ? $out[0] : $newout;

         return $this->Object;
      } else {
         return false;
      }
   }
   
   function buildSearch() {
      global $in, $process;
      // $cmp = array('eq'=>'=','ne'=>'!=','lt'=>'<','le'=>'<=','gt'=>'>','ge'=>'>=','bw'=>'like','bn'=>'not like','in'=>'like','ni'=>'not like','ew'=>'like','en'=>'not like','cn'=>'like','nc'=>'not like');
      if (!$in['searchString']) {
         if (!$in['searchOper']) $in['searchOper'] = 'cn';
         
         if ($process->OverviewQuery) {
            $dbh = $this->db->{$rsc}->execute($process->OverviewQuery . " LIMIT 1");
            $row = mysql_fetch_object($dbh);
            $fields = array_keys((array)$row);
         } else {
            $fields = $this->db->dbobj->fetch_fields($in['rsc']);
         }
         
         foreach ($fields as $field) {
            if ($in[$field] && ($field != $rsc."ID")) {
               $searchArr[] = $field." like '%".$this->_quote($in[$field], '')."%'";
               $in['searchField'] = $field;
               $in['searchString'] = $in[$field];
            } else if ($in[$field] && ($field == $rsc."ID")) {
               $searchArr[] = $rsc.'.'.$field." like '%".$this->_quote($in[$field], '')."%'";
            }
         }
         if (count($searchArr)) {
            $searchQuery = implode(" AND ", $searchArr);
         }
      }         
      
      if (!$searchQuery && $in['searchOper'] && $in['searchString']) {
         if (preg_match("/bw|bn/", $in['searchOper'])) $in['searchString'] = $in['searchString'] .'%';
         if (preg_match("/ew|en/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'];
         if (preg_match("/in|ni|cn|nc/", $in['searchOper'])) $in['searchString'] = '%'.$in['searchString'].'%';
            
         $searchQuery = $in['searchField'] . " " . $cmp[$in['searchOper']] . " " . $this->_quote($in['searchString']);
      } else {
         $searchQuery = '1=1';
      }

      return $searchQuery;
   }

   function makeCondition($rsc, $arr, $join='AND') {
      if (!$arr) {
         return false;
      }

      foreach ($arr as $key=>$val) {
         if (!is_array($val) && !is_object($val)) {
            if (preg_match("/^\s*\!/", $val)) {
               $val = preg_replace("/^\s*\!/", '', $val);
               $negative = 1;
            }
            $op = '';
            if (preg_match("/\%/", $val)) {
               $op .= ($negative) ? ' NOT LIKE ' : ' LIKE ';
            } 
            
            if (preg_match("/^\s*([\<\>]\s*=?\s*)/", $val, $match)) {
               $op .= ($negative) ? '!'.$match[1] : $match[1];
               $val = preg_replace("/^\s*[\<\>]\s*=?\s*/", '', $val);
            }

            if (!$op) {
               $op .= ($negative) ? " != " : " = ";
            }
            
            $out[] = "$rsc.$key$op".$this->db->dbobj->sql_quote($val);
         }
      }

      if (count($out)) {
         $str = join(' '.$join.' ', $out);
      }

      return $str;
   }

   /**
    * Prepares array structure for submission to 'searchObject' by removing attributes that
    * have no value (such as an array struct that was submitted from an HTML form). 
    * Returns clean array object that contains only attributes that have values or children
    *
    **/
   function cleanObject($data, $clean='', $wildphone=0) {
      $newdata = array();
      foreach ($data as $key=>$val) {
         if (is_array($val) || is_object($val)) {
            $result = $this->cleanObject($val, $clean, $wildphone);

            if ($result) $newdata[$key] = $result;
         } elseif (($val!='') && ($key != "undefined")) {
            if (($clean && ($key!='LastModified' && $key!='Created')) || (!$clean)) {
               if (($key=="Phone") && ($wildphone)) {
                  if (strlen($val) < 7) {
                     $val .= '%';
                  }
               } else if ((strtolower($key) == "passwd") || (strtolower($key) == "password")) {
                  if (strlen($val) < 40) {
                     $val = sha1($val);
                  }
               }
               $newdata[$key] = $val;
            }
         }
      }

      if (count($newdata)) {
         return $newdata;
      } else {
         return false;
      }
   }

    /**
    * Convenience function to retrieve a record and all data associated
    * with that record by querying the Clamp table for Local table entries
    * with a LocalID of 0 and linking each Remote table and utilizing
    * data passed in the $search array/object for filtering the data
    *
    **/
   function searchObject($resource, $search, $parent='', $grandparent='', $sort='') {
      $query = array();
      $resultset = array();
      $parent = (!$parent) ? $resource : $parent;
      
      if (preg_match("/(search.*)/i", $resource, $match)) {
         $resource = $parent;
         $search[$resource] = $search[$match[1]];
         unset($search[$match[1]]);
         $parent = $grandparent;
      }
      
      $this->db->addResource($resource);
      
      if (is_array($search[$resource])) {
         if (is_array($search[$resource]['search'])) {
            $search[$resource] = $search[$resource]['search'];
         }
         for ($i=0; $i<10; $i++) {
            if (is_array($search[$resource]['search'.$i])) {
               $search[$resource] = $search[$resource]['search'.$i];
            }
         }
         if ($search[$resource][$resource.'ID']) {
            $query[] = "{$resource}ID='{$search[$resource][$resource.'ID']}'";
            $resultset = (count($resultset)) ? array_intersect($resultset, $newresults) : array($search[$resource][$resource.'ID']=>$search[$resource][$resource.'ID']);

         } else {
            foreach ($search[$resource] as $key=>$val) {
               
               if (is_array($val)) {
                  $pass = (is_array($search[$resource]['search'])) ? $search[$resource]['search'] : $search[$resource];
                  $newresults = $this->searchObject($key, $pass, $resource, $parent, $sort);
                  if (count($newresults)) {
                     $resultset = (count($resultset)) ?  array_intersect($resultset, $newresults) : $newresults;
                  }
               } elseif ($val) {
                  if ($cond = $this->makeCondition($resource, array($key=>$val))) {
                     $query[] = $cond;
                  }
               }
            }
         }
      }

      if ($resource!=$parent) {

         $qstr = "SELECT * FROM Clamp, $resource WHERE Clamp.Local='$resource' AND Clamp.Remote='$parent' ". 
                  "AND {$resource}.{$resource}ID=Clamp.LocalID";
         $where = ' AND ';
      } elseif (!count($query) && ($resource==$parent) && count($resultset)) {

         $ids = $resultset;
         return $ids;

      } else {
         $qstr = "SELECT {$resource}ID as LocalID, {$resource}ID as RemoteID FROM $resource";
         $qstr .= (count($query)) ? ' WHERE ' : '';
         $where = '';
      }

      if (count($query)) {
         $qstr .= $where.join(' AND ', $query);
      }
      
      if ($sort && is_string($sort)) {
         $qstr .= ' ORDER BY ' . $sort;
      } else if ($sort && is_array($sort)) {
         $qstr .= ' ORDER BY ' . join(",", $sort);
      }
     
      $ids = array();
      $this->db->dbobj->execute($qstr);

      while ($crow = $this->db->dbobj->fetch_object(1)) {
         if (count($resultset) && ($resultset[$crow->LocalID])) {
            $ids[$crow->RemoteID] = $crow->RemoteID;
         } elseif (!count($resultset)) {
            $ids[$crow->RemoteID] = $crow->RemoteID;
         }
      }
      // print "[$resource] $parent IDs: ".join(",", $ids)."\n";
      
      return $ids;
   }
   
   function getRelationships($resource, $seen=array()) {
      if (!$this->db->Clamp) $this->db->addResource('Clamp');
      $all = $this->db->Clamp->getlist("Local=".$this->_quote($resource)." AND LocalID=0 AND RemoteID=0");
      
      $seen[$resource] = 1;
      
      foreach ($all as $item) {
         if (!$seen[$item->Remote]) {
            $seen[$item->Remote] = 1;
            $tmp = $this->getRelationships($item->Remote, $seen);

            $out[$resource][$item->Remote] = ($tmp[$item->Remote]) ? $tmp[$item->Remote] : 1;
         }
      }
      if (is_array($out)) $keys = array_keys($out);
      if (!count($keys)) $out = 1;
      return ((!count($keys))? 1 : $out);
   }

   function getRelated($resource, $id=0, $pid=0) {
      if (!$this->db->Clamp) $this->db->addResource('Clamp');
      $cond = "Local='$resource'";
      if (!$id) {
         $cond .= ' AND LocalID=0 AND RemoteID=0';
      } else {
         $cond .= ' AND LocalID='.$this->_quote($id).' AND RemoteID!=0';
      }
      if ($pid) $cond .= " AND ProcessID=".$this->_quote($pid);

      $related = $this->db->Clamp->getlist($cond);
      return($related);
   }
    
   function _quote($txt,$char="'") {
      return($this->db->dbobj->sql_quote($txt,$char));
   }

   function q($txt, $char="'") {
      return($this->_quote($txt, $char));
   }
   
   /**
    * storeObject - Takes input returned from form and recusively updates, adds, and clamps records
    *
    **/ 
   function storeObject($data, $parent='', $parentID='') {
      global $in;
      // Grab list of our tables 
      $this->db->dbobj->list_tables();
      $tbls = $this->db->dbobj->tables;

      if (is_object($data)) $data = (array) $data;
      // Iterate through each table, checking $data for an element of the same name
      // that is also an array
      foreach ($tbls as $idx=>$tbl) {
         if ($in['debug']) print "Checking for $tbl data...\n";

         if (is_object($data[$tbl])) $data[$tbl] = (array)$data[$tbl];
         if (is_array($data[$tbl])) {
            if (!$this->db->$tbl) {
               $this->db->addResource($tbl);
            }
            
            if (is_object($data[$tbl][0])) $data[$tbl][0] = (array)$data[$tbl][0];
            if ($data[$tbl][0] && $data[$tbl][0][$tbl.'ID']) {
               $data[$tbl][$data[$tbl][0][$tbl.'ID']] = $data[$tbl][0];
               unset($data[$tbl][0]);
            }
            if ($in['debug']) print "Found $tbl!<br>\n\n";
            if ($in['debug']) print "Calling update_multi with the following:\n".var_dump($data[$tbl])."<br>\n";
            // Update all records in this table's array
            $ids = $this->db->{$tbl}->update_multi($data[$tbl]);
            if (!$ids && $in['debug']) {
               print "update_multi complained: ";
               print_r($this->db->{$tbl});
            }
            if ($in['debug']) print "update_multi returned: ".var_dump($ids)."\n";

            if (!count($ids)) {
               $ids = array_keys($data[$tbl]);
            }

            // Check current $data[table] elements for child tables for each added/updated ID
            if ($ids) {
               
               foreach ($ids as $ididx=>$newID) {
                  if ((!$in[$tbl.'ID'] || (preg_match("/^new/i", $in[$tbl.'ID']))) && $newID) $in[$tbl.'ID'] = $newID;
                  if (($tbl!='Track') && (!$in['ID'] || (preg_match("/^new/i", $in['ID']))) && $newID) $in['ID'] = $newID;
                  
                  if ($data[$tbl][$newID]) {
                     foreach ($data[$tbl][$newID] as $tidx=>$reltbl) {
                        // If we have an array, call storeObject again with child data
                        if (is_object($data[$tbl][$newID])) $data[$tbl][$newID] = (array) $data[$tbl][$newID];
                        if (is_array($data[$tbl][$newID][$tidx])) {
                           if ($in['debug']) print "Calling storeRecord recursively for $tbl=>$tidx...\n";
                           $pass = array($tidx=>$data[$tbl][$newID][$tidx]);
                           $this->storeObject($pass, $tbl, $newID);
                        }
                     }
                  }

                  // Clamp record to parent if parent specified
                  if ((isset($parent)) && ($parentID))  {
                     $this->clampRecord($parent, $parentID, $tbl, $newID, $_REQUEST['pid']);
                     $this->clampRecord($tbl, $newID, $parent, $parentID, $_REQUEST['pid']);
                  }
               }
            }
         }
      }
      return $ids;
   }
  
    function storeRecord($data, $parent='', $parentID='') {
      return $this->storeObject($data, $parent, $parentID);
    }
     
   function clampRecord($local, $localID, $remote, $remoteID, $doReverse=false, $context="", $pid=0) {
      $db = $this->db;
      if (!$db->Clamp) $db->addResource('Clamp');
      if (!$pid) $pid = ($_POST['pid']) ? $_POST['pid'] : $_GET['pid'];

      $db->dbobj->execute("delete from Clamp where (Local='$local' and LocalID='$localID' and Remote='$remote' and RemoteID='$remoteID')");
      
      $link = array('Local'=>$local, 'LocalID'=>$localID, 'Remote'=>$remote, 'RemoteID'=>$remoteID, 'Context'=>$context, 'ProcessID'=>$pid);
      $newID = $db->Clamp->add($link);
      
      if ($doReverse) {
         $db->dbobj->execute("delete from Clamp where (Remote='$local' and RemoteID='$localID' and Local='$remote' and LocalID='$remoteID')");
         $link = array('Local'=>$remote, 'LocalID'=>$remoteID, 'Remote'=>$local, 'RemoteID'=>$localID, 'Context'=>$context, 'ProcessID'=>$pid);
         $revID = $db->Clamp->add($link);

         return array($newID, $revID);
      } else {
         return $newID;
      }
   }
   
   function headers($type, $nocache=true, $extra='') {
      $types = array('json'=>'application/json','html'=>'text/html','js'=>'application/javascript');
      if ($types[$type]) $type = $types[$type];

      if (!headers_sent()) {
         if ($nocache) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Thu, 15 Oct 1970 05:00:00 GMT');
         }
         if ($extra) {
            foreach ($extra as $key=>$val) {
               if ($key && $val) {
                  header($key.": ".$val);
               }
            }
         }
         header('Content-type: '.$type);
      }
   }
  function csv2array(&$string, $CSV_SEPARATOR = ',', $CSV_ENCLOSURE = '"', $CSV_LINEBREAK = "\n") {
     $o = array();

     $cnt = strlen($string);
     $esc = false;
     $escesc = false;
     $num = 0;
     $i = 0;
     while ($i < $cnt) {
       $s = $string[$i];

       if ($s == $CSV_LINEBREAK) {
         if ($esc) {
           $o[$num] .= $s;
         } else {
           $i++;
           break;
         }
       } elseif ($s == $CSV_SEPARATOR) {
         if ($esc) {
           $o[$num] .= $s;
         } else {
           $num++;
           $esc = false;
           $escesc = false;
         }
       } elseif ($s == $CSV_ENCLOSURE) {
         if ($escesc) {
           $o[$num] .= $CSV_ENCLOSURE;
           $escesc = false;
         }

         if ($esc) {
           $esc = false;
           $escesc = true;
         } else {
           $esc = true;
           $escesc = false;
         }
       } else {
         if ($escesc) {
           $o[$num] .= $CSV_ENCLOSURE;
           $escesc = false;
         }

         $o[$num] .= $s;
       }

       $i++;
     }

   //  $string = substr($string, $i);

     return $o;
   }
   function cleanCSV($infile) {
      # include parseCSV class.
      require_once('parsecsv.lib.php');
      $outfile = "/tmp/import".uniqid().".csv";

      $fo = fopen($outfile, 'w');
      $fh = fopen($infile, 'r');
      $fline = fgets($fh);
      $ftype = preg_match("/^\\xFF\\xFE/", $fline);

      if ($ftype) { $fline = mb_convert_encoding($fline, "UTF-8", "UTF-16"); }

      $fields = preg_split("/[,]/", preg_replace("/\"/",'',$fline));
      $fcnt = count($fields);

      for ($x=0;$x<$fcnt;$x++) {
         $fields[$x] = preg_replace("/\W/", '', $fields[$x]);
      }
      fwrite($fo, implode(",", $fields)."\n");

      while ($line = fgets($fh)) {
         if ($ftype) {
            $line = mb_convert_encoding($line, "UTF-8", "UTF-16");
         }
         fwrite($fo, $line);
      }
      fclose($fh);
      fclose($fo);


   }
   function importCSV($rsc, $file) {
      global $in;
      $this->db->addResource($rsc);
      $fieldDefs = $this->db->dbobj->fields;
      $fcnt = count($fieldDefs);
      for ( $i=0; $i<$fcnt; $i++ ) {
         $dbfields[$fieldDefs[$i]->Field] = $fieldDefs[$i]->Type;
      }
      $num = $cnt = 0;
      $ids = $fields = array();
      
      if (($handle = fopen($file, "r")) !== FALSE) {
         
         while (($data = fgets($handle)) !== FALSE) {
            
            $vals = $this->csv2array($data);
            $cnt = count($vals);

            if (  ( $num && 
                  ( $cnt < $num ) ) || 
                  ( $cnt === 1 ) ) {
               $vals = preg_split("/[,\|\t]/", $data); 
            }
            
            if ($in['debug']) print "Data: $data\nVals: ".count($vals)."\n========\n";
            
            if (!$fields) { 
               
               $fields = $vals;
               $num = count($fields);
            
            } else {
            
               if (count($vals) < $num) {
                  
                  if ($in['debug']) print "Vals: ".count($vals)."\nFields: ".$num."\n";
                  
                  $loop = 1;
                  
                  while (count($vals) < $num) {
                     
                     if ($in['debug']) print "Loop # ".$loop."\n";
                     
                     $data = preg_replace("/\r?\n/", '\\n', $data);
                     $data .= fgets($handle);
                     
                     if ($in['debug']) print $data."\n===========\n";
                     
                     $vals = $this->csv2array($data);
                     
                     if (count($vals) < count($fields)) $vals = preg_split("/[,\|\t]/", $data);
                     
                     if ($in['debug']) print "Vals: ".count($vals)."\n";
                     
                     ++$loop;
                  }
               }
               $arr = array();
               for ($c=0; $c < $num; $c++) {
                  $arr[$rsc]['new1'][$fields[$c]] = $vals[$c];
               }
               $ids[] = $lastids = $this->storeObject($arr);
            }
         }
      }
      fclose($handle);
      return $ids;
   }
   
   function parseImport($rsc, $datatxt) {
      global $in;
      $dataarr = preg_split("/(\r\n|\r|\n)/s", $datatxt);
      $fieldstxt = array_shift($dataarr);
      $fields = preg_split("/[\t\|]/", $fieldstxt);
      
      $new = 1;
      $out->$rsc = array();
      foreach ($dataarr as $row) {
         if (preg_match("/\w/", $row)) {
            $vals = preg_split("/[\t\|]/", $row);
            $rec = array();
            if (count($vals)>1) {
               foreach ($fields as $idx=>$field) {
                  if (preg_match("/\w/", $vals[$idx])) {
                     $rec[$field] = $vals[$idx];
                  }
               }
               // $rec = array_combine($fields, $vals);
               $id = $rec[$rsc.'ID'];
               if (!$rec[$rsc.'ID']) $id = 'new'.$new++; // $rec[$rsc.'ID'] = 'new'.$new++;
               $out->{$rsc}[$id] = $rec;
            }
         }
      }
      return $out;
   }
   
   function genCreateTable($data) {
      $fields = array();
      $defs = array();
      foreach ($data as $tblname=>$records) {
         foreach ($records as $id=>$rec) {
            if (!count($fields)) {
               $fields = array_keys((array)$rec);
               print "Got fields: \n\t".join("\n\t", $fields)."\n\n";
            }
            
            foreach ($rec as $field=>$val) {
               $typ = "varchar(100) not null";
               $isdate = date("r", strtotime($val));
               if ($isdate) {
                  $typ = (preg_match("/\d\d:\d\d:\d\d/", $isdate)) ? "datetime" : "date";
               }

               $defs[] = $typ;
            }
         }
      }
   }

   function getHelpPath($file) {
      $file = preg_replace("|".$_SERVER['DOCUMENT_ROOT']."|", "", $file);

      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/help/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/templates/help/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/apps/help/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/help/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/templates/help/';

      foreach ($check as $path) {
         if (file_exists($path . $file)) {
            return $path.$file;
         }
      }
      return(preg_replace("/\/\//", '/', $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/help/'.$file)); 
   }

   function getFilePath($file) {
      $file = preg_replace("|".$_SERVER['DOCUMENT_ROOT']."|", "", $file);
      $file = preg_replace("/templates\//", '', $file);
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/templates/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/apps/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/apps/templates/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/';
      $check[] = $_SERVER['DOCUMENT_ROOT'].'/apps/templates/';

      foreach ($check as $path) {
         if (file_exists($path . $file)) {
            return $path.$file;
         }
      }
      return(preg_replace("/\/\//", '/', $_SERVER['DOCUMENT_ROOT'].$this->app->Assets.'/templates/'.$file)); 
   }

   function getFile($file) {
      $path = $this->getFilePath($file);
      $content = null;
      if ($path) {
         $content = file_get_contents($path);
      }
      return $content;
   }

   function getModel($pid, $force=false) {
      if ($pid) {
         $process = $this->getObject("Process", $pid);
         $models = $this->getObject("Model", "ProcessID='".mysql_real_escape_string($pid)."' AND LoginID='".mysql_real_escape_string($_SESSION['LoginID'])."'");
         
         if (!count($models->Model['_ids'])) {
            $models = $this->getObject("Model", "ProcessID='".mysql_real_escape_string($pid)."'");
         } 
      }

      if (!$process || ($process->ProcessID!=$pid)) {
         die("Invalid Process specified in boss->getModel() - PID: $pid");
      }
      if (!$process->Resource) {
         return false; 
      }
      if ($models->Model && $models->Model['_ids'] && !$force && !$_REQUEST['dynamic'] && !$process->Dynamic) {
         if ((count($models->Model['_ids'])>0) && ($models->Model[0]->ProcessID==$pid)) {
            return $models->Model[0];
         } 
      } else {
         return($this->genModel($process, (array)$models, $force));
      }
      return false;
   }

   function genTableModel($rsc, $models=array(), $save=false, $all=false) {
      $sys = $this->db;
      $sys->addResource($rsc);
      $defs = $sys->dbobj->execute("desc `".mysql_real_escape_string($rsc)."`");

      $excl = preg_split("/\,\s*/", $_REQUEST['no']);
      if ($_REQUEST['only']) $only = preg_split("/\,\s*/", $_REQUEST['only']);
      
      $fields = array();
      while ($row = mysql_fetch_object($defs)) {
         $obj = new stdClass;
         foreach ($row as $key=>$val) {
            $obj->{$key} = $val;
         }
         $obj->Length = preg_replace("/\w*\((.*)\)/", "$1", $obj->Type);
         $obj->Type = preg_replace("/\(.*\)/", "", $obj->Type);

         $fields[$obj->Field] = $obj;
      }
//    print_r($fields);

      $sys->{$rsc}->getlist();
      // $sys->{$rsc}->getlist("1=1 limit 1");
      $results = $sys->$rsc->$rsc;
      
      $predefined = array(
                     $rsc."ID"=>array("hidden"=>false, "hidedlg"=>true, "editable"=>false,"resizable"=>false, "key"=>true),
                     $rsc=>array("hidden"=>false),
                     "Description"=>array("hidden"=>false),
                     "Created"=>array("hidden"=>true),
                     "CreatedBy"=>array("hidden"=>true),
                     "LastModified"=>array("hidden"=>true),
                     "LastModifiedBy"=>array("hidden"=>true)
                   );

      $grid = new stdClass;
      $colnames = array();
      $colmodel = array();
      if ($results && $results[0]) {
         $cols = $results[0];
      } else {
         $cols = $fields;
      }
      foreach ($cols as $key=>$val) {
         $colnames[] = preg_replace("/([a-z])([A-Z])/", "$1 $2", $key);
         $field = new stdClass;
         $field->name = $key;
         $field->index = $key;
         //$field->sortable = true;
         
         if (is_array($predefined[$key])) {
            foreach ($predefined[$key] as $pkey=>$pval) {
               $field->$pkey = $pval;
            }
         }
         /*
         if (is_array($predefined[$key]) && array_key_exists("key", $predefined[$key])) {
            $field->key = $predefined[$key]["editable"];
         }
         
         if (is_array($predefined[$key]) && array_key_exists("resizable", $predefined[$key])) {
            $field->resizable = $predefined[$key]["resizable"];
         }
         */
         if ($predefined[$key]["hidden"] || in_array($key, $excl)) {
            $field->hidden = true;
            $field->hidedlg = true;
         }
         if ($_REQUEST['only'] && !in_array($key, $only)) {
            $field->hidden = true;
            $field->hidedlg = true;
         }
         if ($fields[$key]->Type=="tinyint") {
            $field->formatter = "checkbox";
            $field->edittype = "checkbox";
            $field->editoptions->value = "true:false";
            $field->align = 'center';
         } else if ($fields[$key]->Type=="text") {
            $field->edittype = "textarea";
            $field->editoptions->rows = "4";
            $field->editoptions->cols = "30";
         } else if ($fields[$key]->Type=="int") {
            $field->editrules->integer = true;
            $field->align = 'right';
            $field->width = 30;
            $field->formatter = 'integer';
            $field->formatoptions->thousandsSeparator = '';
         } else if ($fields[$key]->Type=="decimal") {
            $field->align = 'right';
            $field->formatter = 'number';
            $field->formatoptions->thousandsSeparator = '';
            $l = preg_split("/,\s*/", $fields[$key]->Length);
            $field->formatoptions->decimalPlaces = ($l[1]) ? $l[1] : '2';
//         } else if ($fields[$key]->Type=="date") {
//            $field->editrules->date = true;
//            $field->formatter = 'date';
         } else if ($fields[$key]->Type=="time") {
            $field->editrules->time = true;
            $field->formatter = 'date';
            $field->formatoptions->srcformat = "H:i:s";
            $field->formatoptions->newformat = "h:i a";
         } else {
            $field->editoptions->size = 25;
            $field->editoptions->maxlength = $fields[$key]->Length;
         }

         if (preg_match("/^state$/i", $key)) {
            $field->align = 'center';
            $field->width = 50;
            $field->editoptions->size = 5;
         }

         if (preg_match("/email/i", $key) && (!$field->formatter)) $field->formatter = 'email';
         if (preg_match("/date/i", $key) && (!$field->formatter)) $field->formatter = 'date';
         if ($predefined[$key]) {
            $field->hidden = $predefined[$key]['hidden'];
            $field->hidedlg = $predefined[$key]['hidedlg'];
         } else {
            $field->hidden = true;
         }
         $colmodel[] = $field;
      }
   
      $grid->colNames = $colnames;
      $grid->colModel = $colmodel;
      $grid->jsonReader->repeatitems = false;
      $grid->jsonReader->id = $process->Process . "ID"; // "0"; 
      $grid->rowList = array(10,50,100,500,1000,5000,10000);
      $grid->caption = $process->Process;
      $grid->datatype = "json";
      $grid->url = "ctl.php?pid=".$process->ProcessID;
      $grid->editurl = "ctl.php?x=edit&pid=".$process->ProcessID."&";
      $grid->rowNum = 100;
      // $grid->sortname = $rsc;
      // $grid->sortorder = "asc";
      $grid->height = $_REQUEST['h'] ? $_REQUEST['h'] : 150;
      $grid->autowidth = true;
      $grid->resizable = true;
      $grid->viewrecords = true;
      $grid->gridview = true;
      $grid->scrollrows = true;
      $grid->pager = '#'.$process->Resource.'Nav';
      $grid->scroll = 1;

      $json = json_encode($grid);
      $mid = ($models[0]->ModelID) ? $models[0]->ModelID : 'new1';
      $model = array();

      if (count($models)) {
         $model['Model'][$mid] = array(
               'Config'=>$json,
               'ModelID'=>$models[0]->ModelID,
               'Resource'=>$rsc,
               'Model'=> $process->Process. " Model",
               'ProcessID'=>$process->ProcessID);

      } else {
         $model['Model'][$mid] = array('Config'=> $json,
                                         'Model'=>$rsc . " Model", 
                                         'Resource'=>$rsc, 
                                         'ProcessID'=>$process->ProcessID);
      }
      if ($save || (!$models[0]->ModelID)) {
         $ids = $this->storeObject($model);
         if ($ids) {
            $newid = array_shift(array_values($ids));
         }
         // $newmodel = $this->getObject("Model", $newid);  
      }
      return (object) $model['Model'][$mid];
   }
    function genModel($process, $models=array(), $save=true) {
      $pid = $process->ProcessID;
      $rsc = $process->Resource;
      $sys = $this->db;
      $sys->addResource($rsc);
      $defs = $sys->dbobj->execute("desc `".mysql_real_escape_string($rsc)."`");

      $excl = preg_split("/\,\s*/", $_REQUEST['no']);
      if ($process->Only) $only = preg_split("/\,\s*/", $process->Only);
      if ($_REQUEST['only']) $only = preg_split("/\,\s*/", $_REQUEST['only']);
      
      $fields = array();
      while ($row = mysql_fetch_object($defs)) {
         $obj = new stdClass;
         foreach ($row as $key=>$val) {
            $obj->{$key} = $val;
         }
         if (preg_match("/[\(\)]/", $obj->Type)) {
            $obj->Length = preg_replace("/\w*\((.*)\)/", "$1", $obj->Type);
            $obj->Type = preg_replace("/\(.*\)/", "", $obj->Type);
            $obj->Args = preg_split("/\,\s*/", $obj->Length);
         }

         $fields[$obj->Field] = $obj;
      }
      // print_r($fields);

      if ($process->OverviewProcedure) {
         $dbq = $sys->{$rsc}->execute("call " . $process->OverviewProcedure);
         while ($row = mysql_fetch_object($dbq)) {
            $results[] = $row;
         }
      } else if ($process->OverviewQuery) {
         //$dbq = $sys->{$rsc}->execute($process->OverviewQuery." limit 1");
         $dbq = $sys->{$rsc}->execute($process->OverviewQuery);
         $results[] = mysql_fetch_object($dbq);
      } else {
         $sys->{$rsc}->getlist("1=1 limit 1");
         $results = $sys->$rsc->$rsc;
      }
      $predefined = array(
                     $rsc."ID"=>array("hidden"=>false, "editable"=>false,"resizable"=>false,"width"=>90, "key"=>true),
                     $rsc=>array("hidden"=>false, "width"=>300),
                     "Description"=>array("hidden"=>false,"width"=>500),
                     "Created"=>array("hidden"=>true),
                     "CreatedBy"=>array("hidden"=>true),
                     "LastModified"=>array("hidden"=>true),
                     "LastModifiedBy"=>array("hidden"=>true)
                  );

      $grid = new stdClass;
      $colnames = array();
      $colmodel = array();
      $cols = ($results && $results[0]) ? $results[0] : $cols = $fields;
      
      foreach ($cols as $key=>$val) {
         $colnames[] = preg_replace("/([a-z])([A-Z])/", "$1 $2", $key);
         $field = new stdClass;
         $field->name = $key;
         $field->index = $key;
         // $field->sortable = true;

         if (is_array($predefined[$key])) {
            foreach ($predefined[$key] as $pkey=>$pval) {
               $field->$pkey = $pval;
            }
         }
         
         /*
         if (is_array($predefined[$key]) && array_key_exists("key", $predefined[$key])) { $field->key = $predefined[$key]["key"]; }
         if (is_array($predefined[$key]) && array_key_exists("resizable", $predefined[$key])) { $field->resizable = $predefined[$key]["resizable"]; }
         */

         if ($predefined[$key]["hidden"] || in_array($key, $excl)) {
            $field->hidden = true;
            $field->hidedlg = true;
         }
         if ($_REQUEST['only'] && !in_array($key, $only)) {
            $field->hidden = true;
            $field->hidedlg = true;
         }
         if ($fields[$key]->Type=="tinyint") {
            $field->formatter = "checkbox";
            $field->edittype = "checkbox";
            $field->editoptions = new stdClass();
            $field->editoptions->value = "true:false";
         } else if (preg_match("/text$/", $fields[$key]->Type)) {
            $field->edittype = "textarea";
            $field->editoptions = new stdClass();
            $field->editoptions->rows = "4";
            $field->editoptions->cols = "30";
         } else if ($fields[$key]->Type=="int") {
            $field->editrules = new stdClass();
            $field->editrules->integer = true;
            // $field->align = 'right';
            $field->width = 80;
            $field->formatter = 'integer';
            $field->formatoptions = new stdClass();
            $field->formatoptions->thousandsSeparator = '';
         } else if ($fields[$key]->Type=="float") {
            // $field->align = 'right';
            $field->formatter = 'number';
            $field->formatoptions = new stdClass();
            $field->formatoptions->thousandsSeparator = '';
            $l = preg_split("/,\s*/", $fields[$key]->Length);
            $field->formatoptions->decimalPlaces = ($l[1]) ? $l[1] : '2';
         } else if ($fields[$key]->Type=="date") {
            if (!isset($field->editrules)) {
               $field->editrules = new stdClass();
            }
            $field->editrules->date = true;
            $field->width = 150;
            $field->formatter = 'date';
            $field->sorttype = 'datetime';
            $field->datefmt = 'm/d/Y';
            $field->formatoptions = new stdClass();
            $field->formatoptions->srcformat = 'Y-m-d';
            $field->formatoptions->newformat = 'm/d/Y';
         } else if ($fields[$key]->Type=="time") {
            if (!isset($field->editrules)) {
               $field->editrules = new stdClass();
            }
            $field->editrules->time = true;
            $field->width = 120;
            $field->formatter = "time";
         } else if ($fields[$key]->Type=="datetime") {
            $field->editrules = new stdClass();
            $field->editrules->date = true;
            $field->width = 200;
            $field->formatter = 'date';
            $field->sorttype = 'date';
            $field->datefmt = 'm/d/Y h:i a';
            if (!$field->editoptions) $field->editoptions = new stdClass();
            $field->formatoptions = new stdClass();
            $field->formatoptions->srcformat = 'Y-m-d G:i:s';
            $field->formatoptions->newformat = 'm/d/Y g:i:s a';
         } else {
            $field->width = 200;
            $field->editoptions = new stdClass();
            $field->editoptions->size = 25;
            $field->editoptions->maxlength = $fields[$key]->Length;
         }

         if (preg_match("/^state$/i", $key)) {
            $field->width = 50;
            if (!$field->editoptions) $field->editoptions = new stdClass();
            $field->editoptions->size = 5;
         }
         
         if (is_array($predefined[$key]) && array_key_exists("width", $predefined[$key])) {
            $field->width = $predefined[$key]["width"];
         }

         if (preg_match("/email/i", $key) && (!$field->formatter)) $field->formatter = 'email';
         if (preg_match("/date/i", $key) && (!$field->formatter)) $field->formatter = 'date';
         
         if ($predefined[$key]) {
            $field->hidden = $predefined[$key]['hidden'];
            $field->hidedlg = $predefined[$key]['hidedlg'];
         } else {
            $field->hidden = true;
         }
         $colmodel[] = $field;
      }
      $cmTemplate = new stdClass();
      $cmTemplate->align = "center";
      $cmTemplate->sortable = true;
      $cmTemplate->resizable = true;
      // $cmTemplate->editable = false;

      $grid->cmTemplate = $cmTemplate;
      $grid->colNames = $colnames;
      $grid->colModel = $colmodel;
      
      // $grid->cellEdit = true;
      // $grid->cellurl = "ctl.php?pid=".$process->ProcessID."&x=edit&";
      if (!$grid->jsonReader) $grid->jsonReader = new stdClass();
      $grid->jsonReader->repeatitems = false;
      $grid->jsonReader->id = "0"; 
      $grid->rowList = array(10,50,100,500,1000,5000,10000);
      $grid->caption = $process->Process;
      $grid->datatype = "json";
      $grid->url = "ctl.php?pid=".$process->ProcessID;
      $grid->editurl = "ctl.php?x=edit&pid=".$process->ProcessID."&";
      $grid->rowNum = 100;
      // $grid->sortname = $rsc;
      // $grid->sortorder = "asc";
      $grid->autowidth = true;
      $grid->resizable = true;
      $grid->shrinkToFit = false;
      $grid->viewrecords = true;
      $grid->gridview = true;
      $grid->altRows = true;
      $grid->pager = "#{$rsc}Nav";
      $grid->scrollrows = true;
      $grid->scroll = 1;

      $json = json_encode($grid);
      $mid = ($models[0]->ModelID) ? $models[0]->ModelID : 'new1';
      $model = array();

      if (count($models)) {
         $model['Model'][$mid] = array(
               'Config'=>$json,
               'ModelID'=>$models[0]->ModelID,
               'Resource'=>$rsc,
               'Model'=> $process->Process. " Model",
               'ProcessID'=>$process->ProcessID);

      } else {
         $model['Model'][$mid] = array('Config'=> $json,
                                         'Model'=>$rsc . " Model", 
                                         'Resource'=>$rsc, 
                                         'ProcessID'=>$process->ProcessID);
      }
      if ($save || (!$models[0]->ModelID)) {
         if ($save) $sys->dbobj->execute("delete from Model where ProcessID={$process->ProcessID}");
         
         $ids = $this->storeObject($model);
         if ($ids) {
            $newid = array_shift(array_values($ids));
            $newmodel = $this->getObject("Model", $newid);
         }
      }
      return (object) $model['Model'][$mid];
   }
   
   function getForm($process, $force=false) {
      if (!$process->Form) $form = $process->Form =  'templates/' .  preg_replace("/\W/", '', $process->Process) .  '.php'; 
      $pform = $this->getFilePath($process->Form);
      $rsc = $process->Resource;
      $boss = $this;
      
      if (!$_REQUEST['dynamic'] && !$process->Dynamic && file_exists($pform) && !is_dir($pform) && !$_REQUEST['genform'] && !$force) {
         return file_get_contents($pform); 
      } else {
         $form = $this->app->Assets.'/templates/'.preg_replace("/\W/", "", $process->Process).".php";
         // $pform = $this->getPath($form);
         $pform = preg_replace("/\/\//", "/", $_SERVER['DOCUMENT_ROOT'].'/'.$form);
         
         $template = $this->buildForm($rsc, $current, 1); 
         
         if (is_writable(dirname($pform)) && !$in['dynamic'] && !$process->Dynamic) {
            $fh = fopen($pform, 'w');
            if ($fh && !fwrite($fh, $template)) print "<h1>Error writing to file $pform</h1>";
            fclose($fh);
            $cvsout = `/usr/bin/cvs add $pform`;
            $cvsout .= `/usr/bin/cvs ci -m 'Addition of autogenerated form' $pform`;
            return file_get_contents($pform);
         } else {  
            // $curform = $this->buildForm($rsc, $current);
            print eval("?>".$template); // <?php
         }
         
         $upd = array('ProcessID'=>$process->ProcessID, 'Form'=>'templates/'.preg_replace("/\W/", "", $process->Process).".php");
         $this->db->addResource('Process');
         $this->db->Process->update($in['ProcessID'], $upd);
      }
   }

   function showForm($process, $force=false) {
      global $in;
      global $current; 
      if ($process && !$process->Form && $process->Process) $form = $process->Form =  'templates/' .  preg_replace("/\W/", '', $process->Process) .  '.php'; 
      $pform = $this->getFilePath($process->Form);
      $rsc = $process->Resource;
      $boss = $this;
      
      if (!$_REQUEST['dynamic'] && !$process->Dynamic && file_exists($pform) && !is_dir($pform) && !$_REQUEST['genform']) {
         print "<!--form: {$pform}-->\n";
         include($pform); 
      } else {
         $form = $this->app->Assets.'/templates/'.preg_replace("/\W/", "", $process->Process).".php";
         // $pform = $this->getPath($form);
         $pform = preg_replace("/\/\//", "/", $_SERVER['DOCUMENT_ROOT'].'/'.$form);

         $template = $this->buildForm($rsc, $current, 1);
         
         if (is_writable(dirname($pform)) && !$in['dynamic'] && !$process->Dynamic) {
            $fh = fopen($pform, 'w');
            if (!fwrite($fh, $template)) print "<h1>Error writing to file templates/$file</h1>";
            fclose($fh);
            $cvsout = `/usr/bin/cvs add $pform`;
            $cvsout .= `/usr/bin/cvs ci -m 'Addition of autogenerated form' $pform`;
            include($pform);
         } else {  
            // $curform = $this->buildForm($rsc, $current);
            print eval("?>".$template);
         }
         
         $upd = array('ProcessID'=>$process->ProcessID, 'Form'=>'templates/'.preg_replace("/\W/", "", $process->Process).".php");
         $this->db->addResource('Process');
         $this->db->Process->update($in['ProcessID'], $upd);
      }
   }

/**
    * Attach Module object 
    *
    **/
   function addModule($module='') {
      // why is the module called boss?
      $this->boss = new _Module($module, $process, $this->db);
      $this->class = 'Module';
   }

   /**
    * Attach Process object 
    *
    **/
   function addProcess($module='', $process='') {
      $this->Process = new _Process($module, $process, $this->db);
      $this->class = 'Process';
   }

   /**
    * Attach Action object 
    *
    **/
   function addAction($process='', $action='') {
      $this->Action = new _Action($process, $action, $this->db);
      $this->class = 'Action';
   }
   
   function add($resource, $pid='', $rid='') {
      $rcs = '_'.ucfirst($resource);

      $this->$resource = new $rcs($pid, $rid, $this->db);
      $this->class = $resource;

   }

   /**
    * Set base 'Resource'
    *
    **/
   function setResource($resource='') {
      $this->resource = $resource;
   }
   
   /**
    * Generate generic HTML form for current base resource
    *
    **/
   function buildForm($rcs, $data=array(), $tpl=0) {
      $rsc = ($rcs) ? $rcs : ((!$this->resource) ? 'User' : $this->resource);

      if (!$this->db->$rsc) {
         $this->addResource($rsc);
      }

      $this->db->$rsc->fetch_fields($rsc);
      
      $html = <<<EOT
<div class='tableGroup'>
   <div class='formHeading'>{$rcs} ID: <?php print \$current->{$rsc}ID; ?></div>
   <div class='fieldcontainer'>
      <div class='fieldcolumn fieldfloater'>

EOT;
      // Filter system fields and stuff into $fields array
      $tmpfields = $this->db->$rsc->fields;
      $fields = array();

      if ($process->Only) $only = preg_split("/\,\s*/", $process->Only);
      if ($_REQUEST['only']) $only = preg_split("/\,\s*/", $_REQUEST['only']);

      foreach ($tmpfields as $fld=>$field) {
         if (!preg_match("/^(LastModified|Created|{$rsc}ID|LastModifiedBy|CreatedBy)$/", $field->Field)) {
            $fields[] = $field;
         }
      }
      $rcnt = count($fields);
      $split = floor($rcnt / 2);
      $lasthtml = "";
      /*
       * Build form markup for table fields
       */
      for ($r=0; $r<$rcnt; ++$r) {
         $htmlclose = $out = "";
         /*
          * Check for 'ID' field and select list of data from the linked resource
          */
         // !preg_match("/\_/", $fields[$r]->Field) &&  <-- Was in following conditional but doesn't appear to be needed or wanted
         if (preg_match("/(\w+)ID/", $fields[$r]->Field, $match)) {
            /* Check if field ends in 'ID' and has an '_' character and use the following convention for field label and linked resource */
            if ((preg_match("/_/", $match[1])) && ($rsc != $fields[$r]->Field) && ($match[1] != $rsc)) {
               $x = preg_split("/\_/", $match[1]);
               $fields[$r]->ShowField = $x[0];
               $match[1] = $x[1];
            } else {
               $fields[$r]->ShowField = preg_replace("/([a-z])([A-Z])/", "$1 $2", $fields[$r]->Field);
            }
            $fields[$r]->ShowField = preg_replace("/([a-z])([A-Z])/", "$1 $2", $fields[$r]->ShowField);
            $fields[$r]->ShowField = preg_replace("/ID$/", '', $fields[$r]->ShowField); 
            $html .= "         <div class='contentField'><label>" . $fields[$r]->ShowField . "</label>";
            
            if (!$tpl) {
               $this->db->addResource($match[1]);
               $arr = $this->db->$match[1]->getlist();

               $out = $this->utility->buildSelect($arr, 0, $match[1]."ID", $match[1], $rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . ']')."</div>";
            } else {
               $out = '<?php $boss->db->addResource("'.$match[1].'");';
               $out .= '$arr = $boss->db->'.$match[1].'->getlist();';
               $out .= 'print $boss->utility->buildSelect($arr, $current->'.$match[1].'ID, "'.$match[1].'ID", "'.$match[1].'", "'.$rsc.'[$current->'.$rsc.'ID]['.$fields[$r]->Field.']")."</div>";?>';
            }
            $html .= $out."\n";
         } else if (!preg_match("/LastModified|Created|{$rsc}ID/", $fields[$r]->Field)) {
            $sz = preg_replace("/\D/", '', $fields[$r]->Type);
            if (!$sz) $sz = 25;
            if ($sz > 50) $sz = 50;
            $fields[$r]->ShowField = preg_replace("/([a-z])([A-Z])/", "$1 $2", $fields[$r]->Field);
            if ($fields[$r]->Field!='Notes')  $html .= "         <div class='contentField'><label>" . $fields[$r]->ShowField . "</label>";
            
            if (preg_match("/tinyint/", $fields[$r]->Type)) {
               $html .= "<select dbtype='".$fields[$r]->Type."' name='".$rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . "]' id='" . $fields[$r]->Field . "'>";
               $html .= "<option value='0'>No</option>";
               $html .= "<option value='1'>Yes</option>";
               $htmlclose = "</select></div>";

            } else if (!preg_match("/text|blob/", $fields[$r]->Type)) {
               $typ = (preg_match("/^pass/i", $fields[$r]->Field)) ? 'password' : 'text';
               $html .= "<input type='$typ' dbtype='".$fields[$r]->Type."' name='".$rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . "]' id='" . $fields[$r]->Field . "' value='";
               $htmlclose = "' size='".$sz."' class='boxValue".((preg_match("/date/i", $fields[$r]->Type) || preg_match("/date/i", $fields[$r]->Field))?' date' : '')."' /></div>";
            } else {
               if ($fields[$r]->Field=='Notes') {
                  $lasthtml .= "         <div class='contentField' style='clear:left'><label>" . $fields[$r]->ShowField . "</label>";
                  $lasthtml .= "<textarea dbtype='".$fields[$r]->Type."' name='".$rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . "]' id='" . $fields[$r]->Field . "' style='width:48em;' class='textBox'>";
                  $lasthtml .= "</textarea></div>";
                  $htmlclose = "";
               } else if (preg_match("/blob/", $fields[$r]->Type)) {
                  $html .= "<input type='file' dbtype='".$fields[$r]->Type."' name='".$rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . "]' id='" . $fields[$r]->Field . "' class='boxValue'>";
                  $htmlclose = "</div>";

               } else {
                  $html .= "<textarea dbtype='".$fields[$r]->Type."' name='".$rsc.'[<?php print $current->'.$rsc.'ID; ?>][' . $fields[$r]->Field . "]' id='" . $fields[$r]->Field . "' class='textBox'>";
                  $htmlclose = "</textarea></div>";
               }
            }
            
            if ($tpl) {
               $html .= '<?php print $current->'.$fields[$r]->Field."; ?>";
            } else {
               $html .= ((is_array($data)) ? $data[$fields[$r]->Field] : $data->{$fields[$r]->Field});
            }
            
            $html .= $htmlclose ."\n";
            
            if (!$splitted && ($r >= ($split))) {
               $html .= "      </div>\n      <div class='fieldcolumn'>\n";
               $splitted = 1;
            }
         }
      }
      
      $html .= "</div>\n".$lasthtml."</div>\n</div>";
      $this->html = $html;

      return $html;
   }
   /**
    * Add pass-thru addResource to dbobj
    *
    **/
   function addResource($rcs) {
      $this->db->addResource($rcs);
   }
}

/**
 * _Module class definition
 * @package boss
 */
class _Module {
   /**
    * Main object constructor
    *
    **/
   function _Module($moduleID='', $parent='', $db='') {
      $this->db = $db;
      $this->db->addResource('Module');
      $this->util = new Utility();

      if ($moduleID) {
         $this->setModuleID($moduleID);
      }
      $this->get();
   }
   /**
    * Get Module record if ModuleID is set, otherwise
    * retrieve a list of modules.  Also returns Processes
    * associated with each module.
    *
    **/
   function get() {
      if (isset($this->ModuleID)) {
         $this->db->Module->get($this->ModuleID, 'ModuleID');
      } else {
         $sql = "(Access & " . ($_SESSION['Access'] * 1) . ") != 0 ORDER BY Sequence";
         $this->db->Module->getlist($sql);
      }
      $this->Modules =& $this->db->Module->Module;
   }

   /**
    * Set current ModuleID
    *
    **/
   function setModuleID($mid) {
      $this->ModuleID = $mid;
   }
   /**
    * Get current ModuleID
    *
    **/
   function getModule() {
      return($this->ModuleID);
   }
   
   /**
    * Add utility class to current object
    *
    **/
   function addUtils() {
      $this->util = new Utility();
   }
   
   /**
    * Attach processes 
    *
    **/
   function addProcess($pid='') {
      $this->db->addResource('Process');
      for ($m=0; $m<count($this->Modules); $m++) {
         $tmparr = new _Process($this->Modules[$m]->ModuleID, $pid, $this->db);
         $this->Modules[$m]->Processes = $tmparr->Processes;
      }
   }
}

/**
 * _Process class definition
 * @package boss
 */
class _Process extends boss {
   /**
    * Main Proces object constructor.  Requires 
    *
    * @param   int   $module - ModuleID to associate this Process object with [optional]
    * @param   int   $process - ProcessID to associate this Process object with [optional]
    **/
   function _Process($moduleID='', $process='', $db) {
      $this->dbobj = $db;
      $this->dbobj->addResource('Process');
      $this->db =& $this->dbobj->Process;
      $this->util = new Utility();

      if ($moduleID)  $this->setModuleID($moduleID);
      if ($process) $this->setProcess($process);
      
      $this->get($process);
   }
 
   /**
    * Get Process record if ProcessID is set, otherwise
    * retrieve a list of processes.  Also returns actions
    * associated with each process.
    *
    * @param   int   $pid - ProcessID of record to retrieve from the 'Process' table [optional]
    *
    **/
   function get($pid='', $resource='Process') {
      $this->db->linkResource('Action', 'ProcessID', 'ProcessID');
      $pid = (!$pid) ? $this->ProcessID : $pid;

      if (isset($pid)) {
         $this->db->get($pid, 'ProcessID');
      } else {
         $this->db->getlist("ModuleID='".$this->ModuleID."' and ParentID=0 and (Access & " . ($_SESSION['ProcessAccess'] * 1) . ") != 0 order by Sequence");
      }

      $this->Processes = $this->db->Process;

      foreach ($this->Processes as $idx=>$proc) {
         $children = array();
         $newchildren = $this->getProcessChildren($proc->ProcessID);
         if ($newchildren) {
            $this->Processes[$idx]->_children = $newchildren;
         }
      }
      reset($this->Processes);

      return ($this->db->error) ? FALSE : TRUE;
   }
   
   function getProcessChildren($pid) {
      $this->db->linkResource('Process', 'ProcessID', 'ParentID');
      $pid = (!$pid) ? $this->ProcessID : $pid;
      $children = array();
      $this->db->execute("select * from Process where ParentID='".$pid."' and (Access & " . ($_SESSION['ProcessAccess'] * 1) . ") != 0 order by Sequence");
      while ($row = $this->db->fetch_object()) {
         $children[] = $row;
      }

      if (count($children)) {
         $pc = count($children);
         foreach ($children as $idx=>$proc) {
            $subchild = $this->getProcessChildren($proc->ProcessID);
            if ($subchild) {
               $children[$idx]->_children = $subchild;
            }
         }
      }
      return $children;
   }

   /**
    * Return list of actions associated with current Process
    *
    * @param   int   $pid - ProcessID of Actions to retrieve.  If no ProcessID is specified, all 
    *                       processes and their associate actions are retrieved for the current module.
    *                       Keep in mind this could potentially be a large object
    *
    **/
   function listActions($pid='') {
      if (!count($this->db->Process)) {
         $this->get($pid);
      }

      return $this->db->Process[0]->Action;
   }

   /**
    * Set current ModuleID
    *
    **/
   function setModuleID($mid='') {
      $this->ModuleID = $mid;

      return TRUE;
   }

   /**
    * Set current ModuleID
    *
    **/
   function getModule() {
      return $this->ModuleID;
   }
  
   /**
    * Set current ProcessID
    *
    * @param int
    **/
   function setProcess($pid='') {
      $this->ProcessID = $pid;

      return TRUE;
   }
  
   /**
    * Get ProcessID for current module
    *
    **/
   function getProcess() {
      return $this->ProcessID;
   }

   /**
    * Get ProcessID for current module
    *
    **/
   function getNextProcess($cid) {
      $cid = (!$cid) ? $this->db->Process->Process[0]->ConditionID : $pid;

      $this->db->addResource('Condition');
      $this->db->Condition->get($pid, 'ConditionID');
      $cond = $this->db->Condition->Condition[0];
      $proc = $this->db->Process->Process[0];

      if ($cond) {
         if (eval($cond->Condition)) {
            if ($cond->isSuccessIDCondition) {
               $this->getNextProcess($cond->SuccessID);   
            } else {
               $this->setProcess($cond->SuccessID);
            }
         } else {
            if ($cond->isFailureIDCondition) {
               $this->getNextProcess($cond->FailureID);   
            } else {
               $this->setProcess($cond->FailureID);
            }
         }
      }
      
      return $this->ProcessID;
   }
   
   /**
    * Add utility class to current object
    *
    **/
   function addUtils() {
      $this->util = new Utility();
   }
  
   /**
    * Applies 'PreCondition' to current object and if true,
    * performs the method call specified in 'PreAction'
    *
    * >>NOTE: In the case where the current object has no ProcessID
    *         assigned, the 'get' call will return the entire list and process
    *         each records condition if defined.  ***We may not want to allow this***
    *         The code will be left in for now but if problems arise the functionality
    *         of this method may be scaled back to handle only individual records.
    **/ 
   function prepare() {
      $pcnt = count($this->db->Process);
      
      if (!$pcnt) { 
         $this->get();
         $pcnt = count($this->db->Process);
      }

      if ($pcnt) {
         for ($p=0; $p<$pcnt; $p++) {
            $rec = $this->db->Process[$p];
            
            $cond = $rec->PreCondition;
            $action = $rec->PreAction;
            $fail = $rec->PreFail;
            
            if ($cond) {
               eval("\$result = \$this->util->$cond;");

               if ($result && $action) {
                  eval("\$result = \$this->util->$action;");
               } elseif (!$result && $fail) {
                  eval("\$result = \$this->util->$fail;");
               }
            }
         }
      }

      return $result;
   }

   /**
    * Applies 'PostCondition' to current object and if true,
    * performs the method call specified in 'PostAction'
    *
    * >>NOTE: The same warning applies to the 'complete' method as with 
    *          the 'prepare' method.  Be sure to have a current processID
    *          set before calling 'complete' or you may not get the results
    *          you expect.
    **/ 
   function complete() {
      $pcnt = count($this->db->Process);
      
      if (!$pcnt) { 
         $this->get();
         $pcnt = count($this->db->Process);
      }
      if ($pcnt) {
         for ($p=0; $p<$pcnt; $p++) {
            $rec = $this->db->Process[$p];
            
            $cond = $rec->PostCondition;
            $action = $rec->PostAction;
            $fail = $rec->PostFail;
            if ($cond) {
				
               eval("\$result = \$this->util->$cond;");
               if ($result && $action) {
                  eval("\$result = \$this->util->$action;");
                  //echo "\$result = \$this->util->$action;";
               } elseif (!$result && $fail) {
                  //echo "got here2";
                  eval("\$result = \$this->util->$fail;");
               } 
            }
         }
      }

      return $result;
   }

   /**
    * Attach processes 
    *
    **/
   function addAction($process='', $resource='Action') {
      $pid = $process;
      $this->dbobj->addResource('Action');
      for ($m=0; $m<count($this->Processes); $m++) {
         $tmparr = new _Action($this->Processes[$m]->ProcessID, $pid, $this->dbobj);
         $this->Processes[$m]->Actions = $tmparr->Actions;
      }
   }
}

/**
 * _Action class definition
 * @package boss
 */
class _Action extends boss {
   /**
    * Main object constructor
    *
    **/
   function _Action($process='', $action='', $db) {
      $this->dbobj =& $db;
      $this->dbobj->addResource('Action');
      $this->db =& $this->dbobj->Action;
      $this->util = new Utility();

      if ($process) $this->setProcess($process);
      if ($action)  $this->setAction($action);
      
      $this->get($action);
   }
   
   /**
    * Get Process record if ProcessID is set, otherwise
    * retrieve a list of processes.  Also returns actions
    * associated with each process.
    *
    **/
   function get($aid='', $resource='') {
      $aid = (!$aid) ? $this->ActionID : $aid;
      $this->db->linkResource('Operation', 'ActionID', 'ActionID');

      if (isset($aid)) {
         $this->db->get($aid, 'ActionID');
      } else {
         $this->db->getlist("ProcessID='".$this->ProcessID."'");
      }

      $this->Actions =& $this->db->Action;

      return ($this->db->error) ? FALSE : TRUE;
   }

   /**
    * Set current ActionID
    *
    **/
   function setAction($pid) {
      $this->ActionID = $pid;
   }

   /**
    * Get current ActionID
    *
    **/
   function getAction() {
      return($this->ActionID);
   }
   
   /**
    * Set current ProcessID
    *
    * @param int
    **/
   function setProcess($pid='') {
      $this->ProcessID = $pid;

      return TRUE;
   }
  
   /**
    * Get ProcessID for current module
    *
    **/
   function getProcess() {
      return $this->ProcessID;
   }
    /**
    * Add utility class to current object
    *
    **/
   function addUtils() {
      $this->util = new Utility();
   }

   /**
    * Applies 'PreCondition' to current object and if true,
    * performs the method call specified in 'PreAction'
    *
    * >>NOTE: In the case where the current object has no ProcessID
    *         assigned, the 'get' call will return the entire list and process
    *         each records condition if defined.  ***We may not want to allow this***
    *         The code will be left in for now but if problems arise the functionality
    *         of this method may be scaled back to handle only individual records.
    **/ 
   function prepare() {
      $pcnt = count($this->db->Action);
      
      if (!$pcnt) { 
         $this->get();
         $pcnt = count($this->db->Action);
      }

      if ($pcnt) {
         for ($p=0; $p<$pcnt; $p++) {
            $rec = $this->db->Action[$p];
            
            $cond = $rec->PreCondition;
            $action = $rec->PreAction;
            $fail = $rec->PreFail;
            $result = false;

            if ($cond) {
               eval("\$result = \$this->util->$cond;");

               if ($result && $action) {
                  eval("\$endresult = \$this->util->$action;");
               } elseif (!$result && $fail) {
                  eval("\$endresult = \$this->util->$fail;");
               }
            }
         }
      }

      return $result;
   }

   /**
    * Applies 'PostCondition' to current object and if true,
    * performs the method call specified in 'PostAction'
    *
    * >>NOTE: The same warning applies to the 'complete' method as with 
    *          the 'prepare' method.  Be sure to have a current processID
    *          set before calling 'complete' or you may not get the results
    *          you expect.
    **/ 
   function complete() {
      $pcnt = count($this->db->Action);
      
      if (!$pcnt) { 
         $this->get();
         $pcnt = count($this->db->Action);
      }

      if ($pcnt) {
         for ($p=0; $p<$pcnt; $p++) {
            $rec = $this->db->Action[$p];
            
            $cond = $rec->PostCondition;
            $action = $rec->PostAction;
            $fail = $rec->PostFail;
            
            if ($cond) {
               eval("\$result = \$this->util->$cond;");

               if ($result && $action) {
                  eval("\$result = \$this->util->$action;");
               } elseif (!$result && $fail) {
                  eval("\$result = \$this->util->$fail;");
               }
            }
         }
      }

      return $result;
   }

   /**
    * Perform 'Operations' associated with current Action 
    *
    **/
   function execute() {
      $ocnt = count($this->db->Action[0]->Operation);
      if (!$this->util) $this->util = $this->addUtils();

      if (!$ocnt) {
         $this->get();
         $ocnt = count($this->db->Action[0]->Operation);
      }

      if ($ocnt) {
         for ($o=0; $o<$ocnt; $o++) {
            $do = $this->db->Action[0]->Operation[$o]->Operation;
            eval("\$this->util->$do");
         }
      }

   }
   

}

?>
