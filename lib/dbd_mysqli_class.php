<?php
/**
 * dbd_mysqli_class.php - provide an abstracted object-oriented interface for MySQL DB access
 *
 * @author Christopher D. Robison <cdr@netoasis.net>
 * @copyright (c) Copyright, 2024 - All Rights Reserved
 * @package dbobj
 */
/**
 * dbd_mysql Class definition
 */
/**
 * dbd_mysql Class definition
 * Class to handle low-level interaction with mysql database[s]
 * @package dbobj
 */
class dbd_mysql {
#@ _OUTLINE_1_
/**#@+
 * @access public
 * @var string
 */
   var $db;
   var $errstr = "";
/**#@-*/
/**#@+
 * @access public
 * @var bool
 */
   var $connid = 0;
   var $errno = 0;
   var $halt_on_error = 1;
   var $result = 0;
   var $num_rows = 0;
   var $last_id = 0;
/**#@-*/
/**#@+
 * @access public
 * @var struct
 */
/**#@-*/

#@ _OUTLINE_1_

/**
 * Object contructor
 *
 */
function dbd_mysql() {
//   $this->connect();
}
/**
 * Error handling 
 *
 * If $halt_on_error is set, print a message and die.
 * Otherwise silently return so caller can return an error
 * code to its caller.
 *
 */
function error($msg) {
#@ _ERROR_

   if (!$this->halt_on_error)
      return;

   $msg .= "\n";
   
   # If an error code is known, include error info
   if ($this->errno) 
      $msg .= sprintf("Error: %s(%d)\n", $this->errstr, $this->errno);
   
   die( nl2br(htmlspecialchars($msg)));
}
#@ _ERROR_

/**
 * Establish connection to database server
 *
 * Test for an active connection; try to establish one if none exists.
 * The connection parameters should have been set before invoking
 * this routine.  Normally, there is no need to call it explicitly,
 * because execute() does so automatically.  This means you can
 * start issuing queries whevever you want without first connecting to
 * the server as long as you've set the connection parameters properly.
 *
 * Return the connection ID for a successful connection.  If a
 * connection cannot be established or the database cannot be selected,
 * this calls error(), which terminates the script if $halt_on_error isn't
 * disabled.
 *
 */
function &connect($forcedb='', $dbuser='', $dbpass='', $dbhost='localhost') {
#@ _CONNECT_
   global $dbhost;
   global $dbuser;
   global $dbpass;
   global $dbhost;

   if (file_exists('DB_conf.php')) require('DB_conf.php');
   if (file_exists('conf.php')) require('conf.php');

   $this->errno = 0;       # clear the error variables
   $this->errstr = "";
   $this->db = $forcedb;

   if (!$dbhost) $dbhost = (!$host) ? 'localhost' : $host;
   if (!$dbuser) $dbuser = (!$user) ? 'pimp' : $user;
   if (!$dbpass) $dbpass = (!$pass) ? 'pimpin' : $pass;
   if (!$db) $db = (!$forcedb) ? 'sys' : $forcedb;

   if (!$this->db) $this->db = (!$db) ? 'sys' : $db;
   if ($forcedb) $db = $this->db = $forcedb;

   $this->errstr = "";
 
   # Connect if not already connected
   if (!$this->connid)  {
      $this->connid = mysqli_connect( $dbhost, 
                                      $dbuser,
                                      $dbpass,
                                      false,
                                      65536
                                     );

      # Use mysqli_errno($this->connid)/mysqli_error($this->connid) if they work for
      # connection errors; use $php_errormsg otherwise
      if (!$this->connid) {
         
         # mysqli_connect_errno() returns nonzero if it's
         # functional for connection errors
         if (mysqli_connect_errno()) {
            $this->errno = mysqli_connect_errno();
            $this->errstr = mysqli_connect_error();
         } else {
            $this->errno = -1;
            $this->errstr = $php_errormsg;
         }
         $this->error("Cannot connect to server ".$this->host." as ".$this->user);
         return(FALSE);
      }
      $this->select_db($this->db);
      $this->execute('SET NAMES latin1');
   }
   return($this->connid);
}

function get_connection() {
   if (!$this->connid) $this->connid = $this->connect($this->db);

   return($this->connid);
}

function &select_db($db) {
   global $dbuser;
   global $dbpass;
   if (!$this->connid) $this->connid = $this->connect($db, $dbuser, $dbpass);

   if (isset($db)) {
      $this->db = $db;
      # select database if one has been specified
      if (isset($this->db) && $this->db != "") {

         if (!@mysqli_select_db($this->connid, $this->db)) {

            $this->errno = mysqli_errno($this->connid);
            $this->errstr = mysqli_error($this->connid);
            $this->error("Cannot select database: ".$this->db);
            return(FALSE);
         } else {
            return(TRUE);
         }
         
      }
   }
}
#@ _CONNECT_

/**
 * Disconnect from database server
 */
function disconnect() {
#@ _DISCONNECT_

   # Close any open connections
   if ($this->connid != 0)    {
      mysqli_close($this->connid);
      $this->connid = 0;
      unset($this->user);
      unset($this->host);
      unset($this->db);
      unset($this->halt_on_error);
      unset($this->errno);
      unset($this->errstr);
      unset($this->query_pieces);

}

   return(TRUE);
}
#@ _DISCONNECT_

/**
 * Quote function to escape string in preparation for use in a SQL statement.
 * 
 * This convenience function discovers the best method to use for quoting, preferring
 * the mysqli_escape_string() function, if it exists, and falls back to the builtin addslashes().  
 *
 * You may optionally pass a 'true' value as a 3rd argument to this method to have an empty values 
 * return NULL and not an empty string('').  
 *
 */
function sql_quote($str, $quote="'", $null=false) {
#@ _QUOTE_

   if (!isset($str) || $str == "NULL") {
      if ($null || $str == "NULL") {
         return("NULL");
      } else {
         return($quote.$quote);
      }
   }
   if (get_magic_quotes_gpc()) $str = stripslashes($str);

   $func = function_exists("mysqli_real_escape_string") ? "mysqli_real_escape_string" : "addslashes";

    if (is_string($str)) {
        return($quote . $func($str) . $quote);
    } else {
        return $str;
    }
}
#@ _QUOTE_


/**
 * Prepare a query.  
 *
 * Prepares query for execution.  Placeholders are represented by ? characters.
 *
 */
function prepare_query($query) {
#@ _PREPARE_QUERY_

   $this->query_pieces = explode("?", $query);
   return(TRUE);
}
#@ _PREPARE_QUERY_

/**
 * Send a query to the database server.
 *
 * Return the result ID for a successful query.  If the query fails, and
 * $halt_on_error is disabled, return FALSE.
 *
 * If the argument is a string, execute it directly.
 * If the argument is an array, interpret its elements as values to be
 * bound to a previously prepared query.  There must be one data value
 * per placeholder.
 *
 */
function execute($arg = "") {
#@ _EXECUTE_

   if ($arg == "") {          # if no argument, assume prepared statement
      $arg = array();      # with no values to be bound
   }

   if (!$this->connid) $this->connect($this->db);

   if (is_string($arg)) {     
      
      # $arg is a simple query
      $query_str = $arg;

   } else if ( is_array($arg) ) {   
      
      # $arg contains data values for placeholders
      if (count($arg) != count($this->query_pieces) - 1) {
         $this->errno = -1;
         $this->errstr = "data value/placeholder count mismatch";
         $this->error("Cannot execute query");
         return(FALSE);
      }

      # insert data values into query at placeholder 
      # positions, quoting values as we go
      $query_str = $this->query_pieces[0];
      for($i = 0; $i < count($arg); $i++) {
         $query_str .= $this->sql_quote($arg[$i]) . $this->query_pieces[$i+1];
      }

   } else {                
      
      # $arg is garbage
      $this->errno = -1;
      $this->errstr = "Unknown argument type to execute";
      $this->error("Cannot execute query");
      return(FALSE);

   }

   $this->num_rows = 0;

   $this->result = mysqli_query($this->connid, $query_str);
   $this->errno = mysqli_errno($this->connid);
   $this->errstr = mysqli_error($this->connid);
   
   if ($this->errno) {
      $this->error("Cannot execute query: $query_str [".$this->errstr."]");
      return(FALSE);
   }
   # get number of affected rows for non-SELECT; this also returns
   # number of rows for a SELECT
   $this->num_rows = mysqli_affected_rows($this->connid);
   
   return($this->result);
}
#@ _EXECUTE_

/**
 * Frees result set
 *
 * Close the result set, if there is one
 *
 */
function free_result() {
#@ _FREE_RESULT_

   if ($this->result)
      mysqli_free_result($this->result);
      unset($this->row);
   $this->result = 0;
   return(TRUE);
}
#@ _FREE_RESULT_


/**
 * Return the next row of the result set as an associative array,
 * numeric-index array, or an object.
 * Return FALSE when no more rows are left.
 *
 */
function fetch_array() {
#@ _FETCH_ARRAY_

   $this->row = mysqli_fetch_array($this->result);
   $this->errno = mysqli_errno($this->connid);
   $this->errstr = mysqli_error($this->connid);
   
   if ($this->errno) {
      $this->error("fetch_array error");
      return(FALSE);
   }

   if (is_array($this->row)) {
      return($this->row);
   }

   $this->free_result();
   
   return(FALSE);
}
#@ _FETCH_ARRAY_

/**
 * Fetch the next row as an array with numeric indexes
 *
 */
function fetch_row() {
#@ _FETCH_ROW_

   $this->row = mysqli_fetch_row($this->result);
   $this->errno = mysqli_errno($this->connid);
   $this->errstr = mysqli_error($this->connid);
   
   if ($this->errno) {
      $this->error("fetch_row error");
      return(FALSE);
   }

   if (is_array($this->row)) {
      return($this->row);
   }

   $this->free_result();

   return(FALSE);
}
#@ _FETCH_ROW_

/**
 * Fetch the next row as an object indexed by field names
 *
 */
function fetch_object($nothis='') {
#@ _FETCH_OBJECT_

   $this->select_db($this->db);
   
   if ($this->result) {
      $tmpobj = mysqli_fetch_object($this->result);
   
      if (!$nothis) $this->data = $tmpobj;
      $this->errno = mysqli_errno($this->connid);
      $this->errstr = mysqli_error($this->connid);
   } else {
      $this->error("fetch_object error: no valid result resource to fetch: ".print_r($this->result, true));
      return(FALSE);
   }
   if ($this->errno) {
      $this->error("fetch_object error");
      return(FALSE);
   }

   if (is_object($tmpobj)) {
      return($tmpobj);
   }

   $this->free_result();

   return(FALSE);
}
#@ _FETCH_OBJECT_


/**
 * Return the AUTO_INCREMENT value generated by the most recent query
 *
 */
function get_insert_id() {

   return(mysqli_insert_id($this->connid));
}


/** 
 *  Return the number of columns in the current result set
 *
 */
function get_num_fields_count() {

   return(mysqli_num_fields($this->result));
}


/**
 * Return FIELD# column info structure for the current result set
 *
 */
function fetch_field($i) {

   return(mysqli_fetch_field_direct($this->result, $i));
}

/**
 * Retrieves list of databases in current database or resource.
 * Returns array of databases as well as sets 'databases' property on
 * current object
 *
 */
function list_databases($db='') {
   $cond = ($db) ? " LIKE '$db'" : '';
   
   $result = $this->execute("show databases $cond");
   $this->databases = array();
   $databases = array();
   
   while ($row = mysqli_fetch_array($result)) {
      $this->databases[] = $row[0];
      $databases[] = $row[0];
   }

   //$result->errno = mysqli_errno($this->connid);
   //$result->errstr = mysqli_error($this->connid);
   
   if ($result->errno) {
      $this->status = "error";
      $this->error("list_databases error");
      return(FALSE);
   }

   if (count($databases)) {
      $this->status = "ok";
      return($databases);
   }

   mysqli_free_result($result);
}


/**
 * Retrieves list of tables in current database or resource.
 * Returns array of tables as well as sets 'tables' property on
 * current object
 *
 */
function list_tables($db='') {
   $db = (!$db) ? $this->db : $db;
   $this->select_db($db);
   
   $result = $this->execute("show tables");
   $this->tables = array();
   $tables = array();
   
   while ($row = mysqli_fetch_array($result)) {
      $this->tables[] = $row[0];
      $tables[] = $row[0];
   }

   // $result->errno = mysqli_errno($this->connid);
   // $result->errstr = mysqli_error($this->connid);
   
   if ($result->errno) {
      $this->status = "error";
      $this->error("list_tables error");
      return(FALSE);
   }

   if (count($tables)) {
      $this->status = "ok";
      return($tables);
   }

   mysqli_free_result($result);
}

/**
 * Retrieves field information for current resource. Also sets primary_key attribute
 * on current object.  Returns array of field names
 *
 */
function fetch_fields($table='') {
   $table = (!$table) ? $this->resource : $table;

   if (!$table) {
      $this->status = "error";
      $this->error("No table specified in fetch_fields()");
      return(FALSE);
   }
   $result = $this->execute("show columns from `$table`");
   $this->fields = array();
   $fieldlist = array();
   $meta = array();
   $this->primary_keys = array();

   if ($result->errno) {
      $this->status = "error";
      $this->error("fetch_fields error");
      return(FALSE);
   } else {
      while ($row = mysqli_fetch_object($result)) {
         if (($row->Key == 'PRI') && (!$this->primary_key)) $this->primary_key = $row->Field;
         if ($row->Key == 'PRI') $this->primary_keys[] = $row->Field;
         array_push($fieldlist, $row->Field);
         array_push($meta, $row);
      }
      $this->fields = $meta;
   } 
   
   if ($result) {
      //$result->errno = mysqli_errno($this->connid);
      //$result->errstr = mysqli_error($this->connid);
   } 
   if (is_array($fieldlist)) {
      $this->status = "ok";
      return($fieldlist);
   }

   mysqli_free_result($result);
}
/**
 * Returns primary key for specified table or current resource
 *
 */
function primary_key($table='') {
   if (!$table) $table = $this->resource;
   
   $this->select_db($this->db);
   if (!$table) {
      $this->status = "error";
      $this->error("No table specified in fetch_fields()");
      return(FALSE);
   }
   
   $result = $this->execute("show columns from `$table`");
   $keys = array();

   while ($row = mysqli_fetch_object($result)) {
      if ($row->Key == 'PRI') {
         if (!$primary_key) $primary_key = $row->Field;
         $keys[] = $row->Field;
      }
   }
   
   if (count($keys) > 1) $primary_key = $keys;

   return($primary_key);
}

#@ _OUTLINE_2_
} # end dbd_mysql
#@ _OUTLINE_2_

?>
