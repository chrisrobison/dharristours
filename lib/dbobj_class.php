<?php
/**
 * dbobj_class.php - provide a standardized and abstracted object-oriented 
 *                   interface for data manipulation
 *
 * @author Christopher D. Robison <cdr@netoasis.net>
 * @copyright (c) Copyright, 2004 - All Rights Reserved
 * @package dbobj
 */
/**
 * dbobj Class definition.
 *
 **/
require_once("dbd_mysql_class.php");
/**
 * dbobj Class definition.
 * DB abstraction layer for interacting with 'resources' which, for now, are simply
 * mysql database tables.  Future extensions will allow attaching and linking various
 * external data sources such as other db servers, xml files, imap/pop email, ical, ldap, etc
 * using the same standardized interface for data manipulation. 
 * @package dbobj
 */
class dbobj extends dbd_mysql {
   /**#@+
    * @access public
    * @var string
    */
   var $resource;
   var $id;
   var $action;
   var $status;
   var $error;
   
/**#@-*/
/**#@+
 * @access public
 * @var struct
 */
   var $link;
   var $data;
   private static 
   $reserved = array('ABS'=>1, 'ACOS'=>1, 'ADDDATE'=>1, 'ADDTIME'=>1,
                     'AES_DECRYPT'=>1, 'AES_ENCRYPT'=>1, 'ASCII'=>1,
                     'ASIN'=>1, 'ATAN2'=>1, 'ATAN'=>1, 'AVG'=>1,
                     'BENCHMARK'=>1, 'BIN'=>1, 'BIT_AND'=>1, 'BIT_COUNT'=>1,
                     'BIT_LENGTH'=>1, 'BIT_OR'=>1, 'BIT_XOR'=>1, 'CAST'=>1,
                     'CEIL'=>1, 'CEILING'=>1, 'CHAR_LENGTH'=>1, 'CHAR'=>1,
                     'CHARACTER_LENGTH'=>1, 'CHARSET'=>1, 'COALESCE'=>1,
                     'COERCIBILITY'=>1, 'COLLATION'=>1, 'COMPRESS'=>1,
                     'CONCAT_WS'=>1, 'CONCAT'=>1, 'CONNECTION_ID'=>1,
                     'CONV'=>1, 'CONVERT_TZ'=>1, 'Convert'=>1, 'COS'=>1,
                     'COT'=>1, 'COUNT(DISTINCT)'=>1, 'COUNT'=>1, 'CRC32'=>1,
                     'CURDATE'=>1, 'CURRENT_DATE'=>1, 'CURRENT_TIME'=>1,
                     'CURRENT_TIMESTAMP'=>1, 'CURRENT_USER'=>1, 'CURTIME'=>1,
                     'DATABASE'=>1, 'DATE_ADD'=>1, 'DATE_FORMAT'=>1,
                     'DATE_SUB'=>1, 'DATE'=>1, 'DATEDIFF'=>1, 'DAY'=>1,
                     'DAYNAME'=>1, 'DAYOFMONTH'=>1, 'DAYOFWEEK'=>1,
                     'DAYOFYEAR'=>1, 'DECODE'=>1, 'DEFAULT'=>1, 'DEGREES'=>1,
                     'DES_DECRYPT'=>1, 'DES_ENCRYPT'=>1, 'ELT'=>1,
                     'ENCODE'=>1, 'ENCRYPT'=>1, 'EXP'=>1, 'EXPORT_SET'=>1,
                     'EXTRACT'=>1, 'FIELD'=>1, 'FIND_IN_SET'=>1, 'FLOOR'=>1,
                     'FORMAT'=>1, 'FOUND_ROWS'=>1, 'FROM_DAYS'=>1,
                     'FROM_UNIXTIME'=>1, 'GET_FORMAT'=>1, 'GET_LOCK'=>1,
                     'GREATEST'=>1, 'GROUP_CONCAT'=>1, 'HEX'=>1, 'HOUR'=>1,
                     'IF'=>1, 'IFNULL'=>1, 'IN'=>1, 'INET_ATON'=>1,
                     'INET_NTOA'=>1, 'INSERT'=>1, 'INSTR'=>1, 'INTERVAL'=>1,
                     'IS_FREE_LOCK'=>1, 'IS_USED_LOCK'=>1, 'ISNULL'=>1,
                     'LAST_INSERT_ID'=>1, 'LCASE'=>1, 'LEAST'=>1, 'LEFT'=>1,
                     'LENGTH'=>1, 'LN'=>1, 'LOAD_FILE'=>1, 'LOCALTIME'=>1,
                     'LOCATE'=>1, 'LOG10'=>1, 'LOG2'=>1, 'LOG'=>1, 'LOWER'=>1,
                     'LPAD'=>1, 'LTRIM'=>1, 'MAKE_SET'=>1, 'MAKEDATE'=>1,
                     'MASTER_POS_WAIT'=>1, 'MAX'=>1, 'MD5'=>1, 'MICROSECOND'=>1,
                     'MID'=>1, 'MIN'=>1, 'MINUTE'=>1, 'MOD'=>1, 'MONTH'=>1,
                     'MONTHNAME'=>1, 'NAME_CONST'=>1, 'NOW'=>1, 'NULL'=>1, 'NULLIF'=>1,
                     'OCT'=>1, 'OCTET_LENGTH'=>1, 'OLD_PASSWORD'=>1, 'ORD'=>1,
                     'PASSWORD'=>1, 'PERIOD_ADD'=>1, 'PERIOD_DIFF'=>1, 'PI'=>1,
                     'POSITION'=>1, 'POW'=>1, 'POWER'=>1, 'QUARTER'=>1, 'QUOTE'=>1,
                     'RADIANS'=>1, 'RAND'=>1, 'RELEASE_LOCK'=>1, 'REPEAT'=>1,
                     'REPLACE'=>1, 'REVERSE'=>1, 'RIGHT'=>1, 'ROUND'=>1,
                     'ROW_COUNT'=>1, 'RPAD'=>1, 'RTRIM'=>1, 'SCHEMA'=>1,
                     'SEC_TO_TIME'=>1, 'SECOND'=>1, 'SESSION_USER'=>1, 'SHA1'=>1,
                     'SHA'=>1, 'SIGN'=>1, 'SIN'=>1, 'SLEEP'=>1, 'SOUNDEX'=>1,
                     'SPACE'=>1, 'SQRT'=>1, 'STD'=>1, 'STDDEV_POP'=>1,
                     'STDDEV_SAMP'=>1, 'STDDEV'=>1, 'STR_TO_DATE'=>1, 'STRCMP'=>1,
                     'SUBDATE'=>1, 'SUBSTR'=>1, 'SUBSTRING_INDEX'=>1, 'SUBSTRING'=>1,
                     'SUBTIME'=>1, 'SUM'=>1, 'SYSDATE'=>1, 'SYSTEM_USER'=>1,
                     'TAN'=>1, 'TIME_FORMAT'=>1, 'TIME_TO_SEC'=>1, 'TIME'=>1,
                     'TIMEDIFF'=>1, 'TIMESTAMP'=>1, 'TIMESTAMPADD'=>1,
                     'TIMESTAMPDIFF'=>1, 'TO_DAYS'=>1, 'TRIM'=>1, 'TRUNCATE'=>1,
                     'UCASE'=>1, 'UNCOMPRESS'=>1, 'UNCOMPRESSED_LENGTH'=>1,
                     'UNHEX'=>1, 'UNIX_TIMESTAMP'=>1, 'UPPER'=>1, 'USER'=>1,
                     'UTC_DATE'=>1, 'UTC_TIME'=>1, 'UTC_TIMESTAMP'=>1, 'UUID'=>1,
                     'VALUES'=>1, 'VAR_POP'=>1, 'VAR_SAMP'=>1, 'VARIANCE'=>1,
                     'VERSION'=>1, 'WEEK'=>1, 'WEEKDAY'=>1, 'WEEKOFYEAR'=>1,
                     'YEAR'=>1, 'YEARWEEK'=>1); 
/**#@-*/

/**#@+
 * @access private
 * @var array 
 */
   private $_fields;
   private $_sort;
/**#@-*/
   
   /**
    * Main object constructor 
    *
    * Establishes new db connection if one does not exist
    *
    **/
   function dbobj($db='', $dbuser='', $dbpass='', $dbhost='localhost') {
      $this->db = $db;
      $this->user = $dbuser;
      $this->pass = $dbpass;
      $this->host = $dbhost;

      $this->connect($db, $dbuser, $dbpass, $dbhost);
   }
   
   /**
    * Destroy dbobj
    *
    * Destroys dbobj instance and all related children
    *
    **/
   function destroy() {
      $this->close();
		// Destroy child objects first
      if ($this->data != null) {
			$this->data->destroy();
			$this->data = null;
		}

      // Now destroy properties
      unset($this->id);
      unset($this->resource);
      unset($this->action);
      unset($this->status);
      unset($this->error);
   }
   
   /**
    * Close database connection
    *
    **/
   function close() {
      parent::disconnect();
      unset($this->dbconn);
   }

   /**
    * Error handler
    *
    *
    */
   function error($error) {
      file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/log/dbobj_error.log", "---\nIn Class '".get_class($this)."', method '$method'.\n  An error occured in $file on line $line: $error - [".$this->errno.'] '.$this->errstr."\n".print_r($_SERVER, true)."\n---\n", FILE_APPEND);
      $this->message = $error;
   }

   /**
    * Attach primary resource identifier, such as table name or file directory 
    *
    */
   function attachResource($resource) {
      $this->resource = $resource;
   }
   
   /**
    * Specify fields to return from object.  
    *
    * Defaults to returning all fields if none have been defined.
    */
   function addField($fieldname) {
      $this->_fields[] = $fieldname;
   }
   
   /**
    * List fields defined for object.  
    *
    * Defaults to returning all fields if none have been defined.
    */
   function getFields() {
      return (count($this->_fields)) ? $this->_fields : $this->fetch_fields();
   }

   /**
    * Specify sort order to return objects in.  
    *
    */
   function addSort($fieldname) {
      $this->_sort[] = $fieldname;
   }
 
   /**
    * Add resource[s] to link against primary resource 
    * 
    * Add resource[s] to link against primary resource.  Link keys are looked up in 
    * map table and returned as array property of $link name in $this->data
    */
   function linkResource($target, $source_key='', $target_key='', $condition=null) { //2005/01/28
      $source_key = ($source_key) ? $source_key : parent::primary_key($this->resource);
      $target_key = ($target_key) ? $target_key : parent::primary_key($target);

      $tobj = new stdClass;
      $tobj->source = $this->resource;
      $tobj->target = $target;
      $tobj->target_key = $target_key;
      $tobj->source_key = $source_key;
		$tobj->condition = $condition; //2005/01/28
      
      if (!is_array($this->_links)) $this->_links = array();
      
      array_push($this->_links, $tobj);
   }
   
   /**
    * Add record to current resource
    *
    * Adds content of $data hash to current resource or a specific 
    * table name may be specified as a second argument.
    *
    **/
   function add( $data, $table = '') {
      $table = (!$table) ? $this->resource : $table;
      $this->select_db($this->db);
      global $in;
      if (!$table) {
         $this->status = 'error';
         $this->error("No valid resource specified $table");
         return(FALSE);
      }
      $this->action = "add";
      
      $fields = parent::fetch_fields($table);
      
      $vals = array();
      $flds = array();
      
      $who = trim(($_SESSION['Email']) ? $_SESSION['Email'] .'|'. $_SERVER['REMOTE_ADDR'] : $_SERVER['REMOTE_ADDR'] . `whoami`);

      if (count($fields)) {
         foreach ($fields as $field) {
            $value = (is_array($data)) ? $data[$field] : $data->$field;
            if ($field!=$table.'ID') {
               if (($field=="Created") || ($field=="LastModified")) { 
                  $flds[] = '`'.$field.'`';
                  array_push($vals, "now()");
               } else if ($field == "CreatedBy") {
                  $flds[] = '`'.$field.'`';
                  array_push($vals, $this->sql_quote($who));
               } else if ($field == "LastModifiedBy") {
                  $flds[] = '`'.$field.'`';
                  array_push($vals, $this->sql_quote($who));
               } else if (is_string($value) && preg_match("/^(\w+)\([^\)]*\)/", $value, $match)) {
                  $flds[] = '`'.$field.'`';

                  if ($reserved[strtoupper($match[1])]) {
                     array_push($vals, $value);
                  } else {
                     array_push($vals, $this->sql_quote($value));
                  }
               } else if (isset($value)) {
                  $flds[] = '`'.$field.'`';
		  if ($value == "NULL") {
		     array_push($val, $value);
		  } else {
                     array_push($vals, $this->sql_quote($value));
                  }
               }
            }
         }
         $query = "insert ignore into $table (".join(",", $flds).") values (".join(",", $vals).")";
         file_put_contents("/tmp/dbobj.log", date("Y-m-d H:i:s\t").$query."\n", FILE_APPEND);
         if ($in['debug']) print $query."\n";
      }
      
      if (parent::execute($query)) {
         $this->status = 'ok';
      } else {
         $this->staus = 'error';
      }

      return(parent::get_insert_id());

   }
   
   function get_insert_id() {
      return(parent::get_insert_id());
   }

   /**
    * Remove record from current resource
    *
    * Removes record identified by $id from current resource.
    * You may override the table affected by passing a table 
    * name as a second argument
    *
    */
   function remove( $id, $table = "") {
      $table = (!$table) ? $this->resource : $table;
      $this->select_db($this->db);
      
      if (!$table) {
         $this->status = 'error';
         $this->error("No valid resource specified $table in remove()");
         return(FALSE);
      }
      $key = parent::primary_key($table);

      if (!$id) {
         $this->status = 'error';
         $this->error("No valid id specified for deletion from $table in remove()");
         return(FALSE);
      }

      $this->action = "remove";
      
      $check = parent::execute("delete from $table where $key='$id'");
      
      if ($check) {
         $this->status = 'ok';
      } else {
         $this->status = 'error';
      }
   }
   
   /**
    * Update record data
    *
    * Updates record identified by $id with contents in $data hash
    * You may pass an optional table to update instead of the currently
    * set resource.  
    *
    * You may pass a query condition in $data['condition'] instead of
    * an id.  This is to allow you to update multiple records instead of
    * just one.  Passing a ('') or 0 for $id requires you to have passed 
    * a condition. 
    **/
   function update( $id, $info, $table='', $cond='') {
      $table = (!$table) ? $this->resource : $table;
      $this->select_db($this->db);
      $data = (is_object($info)) ? (array)$info : $info;


      if (!$table) {
         $this->status = 'error';
         $this->error("No valid resource specified $table in update()");
         return(FALSE);
      }

      if ((!$id) && (!$data['_condition'])) {
         $this->status = 'error';
         // print "<h1>update:</h1>ID: $id<br>info: ";print_r($info);print "<br>table: $table<br>cond: $cond\n";
         $this->error("No record id specified and no condition defined for update()");
         return(FALSE);
      }
      $this->action = "update";
      
      $fields = $this->fetch_fields($table);
      
      $vals = array();
      $undo = array();
      $undos = array();
      
      $who = trim(($_SESSION['Email']) ? $_SESSION['Email'] .'|'. $_SERVER['REMOTE_ADDR'] : $_SERVER['REMOTE_ADDR'] . `whoami`);

      $key = (!$key) ? $this->primary_key : $table.'ID';
      if (!$key) $key = $table.'ID';

      $curvals = $this->get($id, $key);

      foreach ($fields as $field) {
         $value = (is_array($data)) ? $data[$field] : $data->$field;
         
         if ($field == '_condition') $have_cond = 1;
         
         if ($field == 'LastModified') {
            array_push($vals, "`LastModified`=now()");
         } else if ($field == "LastModifiedBy") {
            array_push($vals, "`$field`=".$this->sql_quote($who));
         } else if (is_string($value) && preg_match("/^(\w+)\([^\)]*\)/", $value, $match)) {
            if ($reserved[strtoupper($match[1])]) {
               array_push($vals, $value);
            } else {
               array_push($vals, "`$field`=".$this->sql_quote($value));
            }
         } else if (isset($data[$field])) {
            array_push($vals, "`$field`=".$this->sql_quote($value));
            array_push($undo, "`$field`=".$this->sql_quote($value));
         }
      }
      if (count($vals)) {
         $query = "update $table set ".join(',', $vals)." where ";
         
         if ($id) $query .= $this->primary_key."='".$id."'";
         
         if (($data['_condition']) && (!$have_cond))  $query .= (($query) ? ' AND ' : ' ').$data['_condition'];
         if ($cond && $query) $query .= ' AND '.$cond;

         //print "<!-- update: $query -->";
         
         file_put_contents("/tmp/dbobj.log", date("Y-m-d H:i:s\t").$query."\n", FILE_APPEND);
         
         $check = $this->execute($query);

         $undo_sql = "UPDATE $table SET ".join(',', $undo)." WHERE `" .$key."`=".parent::sql_quote($rec);
         $redo_sql = "UPDATE $table SET ".join(',', $vals)." WHERE `" .$key."`=".parent::sql_quote($rec);
         $newundo_sql = "INSERT INTO `History` (`Undo`, `Redo`, `LoginID`, `Email`, `LastModified`, `Created`) VALUES (".parent::sql_quote($undo_sql).", ".parent::sql_quote($redo_sql).", ".$_SESSION['LoginID'].", ".$this->sql_quote($_SESSION['Email']).", now(), now())";
         $this->execute($newundo_sql);
         file_put_contents("/tmp/dbobj-undo.log", date("Y-m-d H:i:s\t").$newundo_sql."\n", FILE_APPEND);
      }

      if ($check) {
         $this->status = 'ok';
      } else {
         $this->status = 'error';
      }
   }


   /**
    * Update multiple records in multiple tables
    *
    * Updates records in $data array which is keyed by the records primary key
    * and is itself another hashed array of field names and values.
    * You may pass an optional table to update instead of the currently
    * set resource.  
    *
    * You may pass a query condition in $data['condition'] instead of
    * an id.  This is to allow you to update multiple records instead of
    * just one.  Passing a ('') or 0 for $id requires you to have passed 
    * a condition. 
    * 
    * $arr[51]['Field'] = 'value';
    * $arr[52]['Field2'] = 'value2';
    * 
    **/
   function update_multi( &$data, $table='', $key='', $cond='') {
      $table = (!$table) ? $this->resource : $table;
      $this->select_db($this->db);
      if (is_object($data)) $data = (array) $data;

      if (!$table) {
         $this->status = 'error';
         $this->error("No valid resource specified $table in update_multi()");
         return(FALSE);
      }

      $fields = parent::fetch_fields($table);
      $key = (!$key) ? $this->primary_key : $table.'ID';
      if (!$key) $key = $table.'ID';

      if ((!$key) && (!$data['condition'])) {
         $this->status = 'error';
         $this->error("No key specified and no condition defined for update_multi()");
         return(FALSE);
      }
      $this->action = "update";
      
      $ids = array();
      global $in;
      // $in['debug'] = 1;
      foreach ($data as $rec=>$content) {
         if (is_object($content)) $content = (array) $content;
         $vals = array();
         $undo = array();
         $undos = array();

         if (preg_match("/^new/i", $rec)) {
            if ($in['debug']) { print "\nIn update_multi...adding new record...\n"; }
            $newid = $this->add($content);
            if ($in['debug']) print "New ID: $newid\n";
            $ids[$newid] = $newid;
            $data[$newid] = $data[$rec];
            unset($data[$rec]);
            array_push($undos, "DELETE FROM $table WHERE $key='$newid'");
         } else {
            $this->get($rec, $key);
            if ($in['debug']) { print "In update_multi....checking for changed records...\n"; }
            if ($this->data) {
               if ($in['debug']) print "Retrieved $table ID $rec via $key.  Checking for changed information...";
				   $ids[$rec] = $rec;
               $check = $this->data;

               foreach ($this->data as $idx=>$val) {
                  if ($in['debug']) print "Checking $idx; old value: $val, new value: " . $content[$idx] . "\n";
                  if ($idx != $key) {
                     $content[$idx] = (preg_match("/^true$/i", $content[$idx])) ? 1 : $content[$idx];
                     $content[$idx] = (preg_match("/^false$/i", $content[$idx])) ? 0 : $content[$idx];
                     $val = (preg_match("/^true$/i", $val)) ? 1 : $val;
                     $val = (preg_match("/^false$/i", $val)) ? 0 : $val;

                     if (($content[$idx] != "") && ($content[$idx]!=$val)) {
                        $content[$idx] = rtrim($content[$idx]);
                        if ($in['debug']) print "\nFound changed value for $table ID $rec field '$idx' [old value: ".$val.", new value: ".$content[$idx]."]\n";
                        array_push($vals, "`$idx`=".parent::sql_quote($content[$idx]));
                        array_push($undo, "`$idx`=".parent::sql_quote($val));
                     }
                  }
               }

            } else {
               if ($in['debug']) print "Thought we had a record but we don't [$table ID: $rec]: adding new record...";
               $newid = $this->add($content);
               $ids[$newid] = $newid;
               $data[$newid] = $data[$rec];
               if ($in['debug']) print "New record in $table ID: $newid created.\n";
            }

            if (count($vals)) {
               $query = "UPDATE $table SET ".join(',', $vals)." WHERE "."`$key`='$rec'";
               
               // Add extra query condition if passed
               if ($cond && $query) $query .= ' AND '.$cond;
               
               if ($in['debug']) print "update query: $query\n";
               file_put_contents($_SERVER["DOCUMENT_ROOT"] . "/log/boss-updates.log", $query."\n", FILE_APPEND);
               
               file_put_contents("/tmp/dbobj.log", date("Y-m-d H:i:s\t").$query."\n", FILE_APPEND);
               $check = parent::execute($query);
  
               $undo_sql = "UPDATE $table SET ".join(',', $undo)." WHERE `" .$key."`=".parent::sql_quote($rec);
               $redo_sql = "UPDATE $table SET ".join(',', $vals)." WHERE `" .$key."`=".parent::sql_quote($rec);
               $newundo_sql = "INSERT INTO History (`Undo`, `Redo`, `LoginID`, `Email`, `LastModified`, `Created`) VALUES (".parent::sql_quote($undo_sql).", ".parent::sql_quote($redo_sql).", ". $_SESSION['LoginID'].",".$this->sql_quote($_SESSION['Email']).", now(), now())";
               file_put_contents("/tmp/dbobj-undo.log", date("Y-m-d H:i:s\t").$newundo_sql."\n", FILE_APPEND);

               $check = $this->execute($newundo_sql);

            }
         }
      }

      if ($check) {
         $this->status = 'ok';
      } else {
         $this->status = 'error';
      }

      return $ids;
   }
   
   /**
    * Grab record from current resource 
    * 
    * Retrieves record from current resource (or passed table) and identified by $id
    * Performs linking any linked resources by referencing the objmap table on the
    * server and building an object structure derived from the structures defined there.
    * 
    **/
   function get( $id, $key='', $cond='', $table='') {
      $table = (!$table) ? $this->resource : $table;
      if ($id && !$key) {
         $key = ($key) ? $key : parent::primary_key($this->resource);
      }

      $this->select_db($this->db);

      if (!$table) {
         $this->status = 'error';
         exit("No valid resource specified $table");
      }
      $this->action = "get";
      
       
      $fields = (count($this->_fields)) ? '`' . join('`,`', $this->_fields) . '`' : '*';
      $query = "select $fields from $table";
      
      $conds = array();

      if ($key && $id) {
         if (preg_match("/[\%_]/", $id)) {
            $conds[] = "$key like '$id'";
         } else {
            $conds[] = "$key=".$this->sql_quote($id);
         }
      }
      if ($cond) $conds[] = $cond;
      if (count($conds) > 0) {
			$where = " where ".join(" AND ", $conds);
         $query .= $where;
		}
      
      if (count($this->_sort)) $query .= ' ' . join(',', $this->_sort);

//      print "<!-- get($id, $key, $cond, $table): $query -->\n";
      parent::execute($query);
      
      $this->$table = array();
            
      $row = parent::fetch_object( );
      if ($row) $this->{$table}[] = $row;
      $this->data =& $row;

      $this->status = ($row) ? 'ok' : 'error';
      $this->id = $this->data->id;

     if (count($this->_links) > 0) {
         $lcond = array();
         $ltbl = array();
         foreach ($this->_links as $link) {
            $lquery = $link->target_key."='". $this->{$table}[0]->{$link->source_key} ."'";
            $cond = 'WHERE '.$lquery;
				if ($link->condition) $cond .= "AND (" . $link->condition . ")"; //2005/01/28
            $query = 'SELECT * FROM `'.$link->target.'` '.$cond;

            parent::execute($query);
            
            if (!is_array($this->{$table}[0]->{$link->target})) {
               $this->{$table}[0]->{$link->target} = array();
            }

            while ($row = parent::fetch_object( 1 )) {
               $this->{$table}[0]->{$link->target}[] = $row;
            }
         }
      }
 
      parent::free_result();
   }
   
   /**
    * Grab list of records 
    *
    * Retrieves an array of objects for the currently defined resource
    * or passed table argument. An optional condition may be passed as the 
    * first arg.  Currently, the condition is passed as a string that is tacked
    * on the end of the SQL statement.  Setting conditions should probably be handled
    * via a passed object or array or something.
    *
    **/
   function getlist( $cond = '', $table = '', $link = '', $extra='') {
      $table = (!$table) ? $this->resource : $table;

      $this->select_db($this->db);

      if (!$table) {
         $this->status = "error";
         $this->error("No valid resource specified [$table]");
         return false;
      }

      $this->action = "getlist";
      
      $fields = (count($this->_fields)) ? '`' . join('`,`', $this->_fields) . '`' : '*';
      
      $query = "select SQL_CALC_FOUND_ROWS $fields from `$table`";
      if ($link) $query .= ",$link";
         
      if ($cond) $query .= " where ".$cond;
      if (count($this->_sort)) $query .= ' ' . join(',', $this->_sort);

      if ($extra) $query .= ' '.$extra;
      // print ">>>> query 1: $query\n";
      parent::execute($query);
      
      $rows = array();
      while ($row = parent::fetch_object( )) {
         $rows[] = $row;
      }

      $this->{$table} = $rows;
      parent::execute("select FOUND_ROWS() as total");
      
      $row = parent::fetch_object();
      //print_r($row);
      $this->rows = $row->total;
      
      if (count($this->_links) > 0) {
         $currow = 0;
         foreach ($rows as $idx=>$row) {
            $lcond = array();
            $ltbl = array();
            
            foreach ($this->_links as $link) {
               $lquery = $link->target_key."='". $row->{$link->source_key} ."'";
               $cond = 'WHERE '.$lquery;
					if ($link->condition) $cond .= " AND (" .$link->condition . ") ";
               $query = 'SELECT * FROM `'.$link->target.'` '.$cond;
               parent::execute($query);
               
               if (!is_array($this->{$table}[0]->{$link->target})) {
                  $this->{$table}[$currow]->{$link->target} = array();
               }
               while ($lrow = parent::fetch_object( 1 )) {
                  $this->{$table}[$currow]->{$link->target}[] = $lrow;
               }
            }
            ++$currow;
            reset($this->_links);
         }
      }
 
     /* if ($link) {
         $this->$link = $rows;
      } else {
         //$this->{$table}[] = $rows;
      }
      */
      $this->status = "ok";
      unset($row);
      return($rows);
   }

   function list_tables( ) {
      $table = (!$table) ? $this->resource : $table;

      $this->select_db($this->db);
      $this->tables = parent::list_tables();      
   }

   function distinct($field, $sort='') {
      $query = "SELECT DISTINCT($field) from `" . $this->resource . "`";
      
      if ($sort) {
         $query .= " ORDER BY " . $sort;
      }

      parent::execute($query);
      
      $results = array();
      while ($row = parent::fetch_object( )) {
         $results[] = $row->{$field};
      }
      
      return $results;
   }

   function getClamped($local, $localId, $remote) {
      $sql = "SELECT * FROM Clamp WHERE Local=".$this->sql_quote($local)." AND LocalID=".$this->sql_quote($localId)." AND Remote=".$this->sql_quote($remote)." AND Remote!=0";
      
      $this->execute($sql);
      
      $rows = array();
      while ($row = $this->fetch_object( )) {
         $rows[] = $row;
      }
      return $rows;
   }

   function clamp($local, $lid, $remote, $rid, $reverse=true) {
      if ($local && $lid && $remote && $rid) {
         $sql = "insert into Clamp (Local, LocalID, Remote, RemoteID) values ('$local','$lid','$remote','$rid')";
         $this->execute($sql);

         $sql = "insert into Clamp (Remote, RemoteID, Local, LocalID) values ('$local','$lid','$remote','$rid')";
         $this->execute($sql);
      }
   }
   function getRealIpAddr()
   {
       if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
       {
           $ip=$_SERVER['HTTP_CLIENT_IP'];
       }
       elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
       {
          $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
       }
       else
       {
         $ip=$_SERVER['REMOTE_ADDR'];
       }
       return $ip;
   }
}
