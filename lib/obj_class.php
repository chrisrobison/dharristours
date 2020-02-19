<?php
/**
 * obj_class.php - Generic wrapper class for db based object model
 *
 * @author Christopher D. Robison <cdr@netoasis.net>
 * @copyright (c) Copyright, 2004 - All Rights Reserved
 *
 * @package dbobj
 */
/**
 * obj_class.php - Generic wrapper class for db based object model
 *
 */

require_once("dbobj_class.php");

/**
 * @package dbobj
 *
 *
 */
class obj {
   /**
    *
    *
    */
    /**  NOTE: The parameters passed here should be changed to use a single
     *        standardized URI string instead of multiple values and such.
     *        By using a URI scheme instead of static $dbname, $dbuser, etc,
     *        it paves the way for allowing connections to any data source and
     *        not just Mysql.  Initially, the only 'protocol' recognized will
     *        be 'mysql'.  However, addition of other types such as 'ldap', 'pgsql', 
     *        'imap', 'pop', 'csv', and others could be added in future, with 
     *        new 'dbd_*_class.php' classes to handle the actual low-level data exchanges.
     *        Client code only uses the API exposed in dbobj_class.php so modifications 
     *        to the backend should not break existing client apps so long as the 
     *        dbobj interface is not modified.  dbobj_class.php will need to updated to
     *        not build SQL queries but to instead call on a yet-to-be-defined set of classes
     *        that generate the appropriate data and structures for interacting with 
     *        the current data source type (eg: ldap vs sql) [should/could this be handled in
     *        the 'dbd_*' classes?].  The following are examples of what the URI's should 
     *        look like:
     *
     *            mysql://dbuser:dbpass@dbhost/dbname
     *            ldap://authuser:authpass@ldaphost/  [TODO: refer to RFCs for specific ldap format]
     *            imap://login:pass@imapserver/foldername
     */ 
   function obj($dbname, $dbuser='', $dbpass='', $dbhost='localhost') {
      $this->dbname = $dbname;
      $this->dbuser = $dbuser;
      $this->dbpass = $dbpass;
      $this->dbhost = $dbhost;

      $this->dbobj = new dbobj($dbname, $dbuser, $dbpass, $dbhost);
   }

   function destroy() {

   }

   function addResource($rcs, $db='') {
      $path = preg_split("/\./", $rcs);
      if (count($path) > 1) {
         $db = $path[0];
         $this->$path[0] = new obj($path[0]);
         $target = $path[0];
      } 
      $rcs = array_pop($path);
      
      
      if ((!class_exists($rcs)) && ($rcs)) {
         if (file_exists($rcs."_class.php")) {
            require_once($rcs."_class.php");
         } elseif (file_exists("./lib/".$rcs."_class.php")) {
            require_once("./lib/".$rcs."_class.php");
         } else {
            $class_code = "class ".$rcs." extends dbobj { function ".$rcs.'() { $this->resource = "'.$rcs.'"; $this->host = "' . $this->dbhost . '"; $this->db = "'.(($db) ? $db : $this->dbname).'"; } }';
            /*
class TABLE extends dbobj {
   function TABLE() {
      $this->resource = TABLE;
      $this->host = HOST;
      $this->db = DB;
   }
}
            */
            eval("class ".$rcs." extends dbobj { function ".$rcs.'() { $this->resource = "'.$rcs.'"; $this->host = "' . $this->dbhost . '"; $this->db = "'.(($db) ? $db : $this->dbname).'"; } }');
         }
      }
      if ($target) {
         $this->$target->$rcs = new $rcs();
         $this->$target->$rcs->select_db($db);
      } else {
         $this->$rcs = new $rcs();
      }
   }
}

?>
