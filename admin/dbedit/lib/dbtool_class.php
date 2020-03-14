<?php

class database {
   var $database;

   function &database($database) {
      $this->database = $database;
   }

   function destroy() {
      $this->database = null;
   }

   function addTable($table) {
      if (!$this->tables) $this->tables = array();

      $this->tables[$table] = new table($table);
   }

   function rmTable($table) {
      if ($this->$table) {
         $this->$table = null;
      }
   }

}

class table {
   var $fields = array();

   function &table() {
   }

   function destroy() {
      $this->table = null;
   }

   function addField($field, $type='', $options='') {
      if (!$this->fields) $this->fields = array();

      $this->fields[$field] = new field($field, $options);

   }
}

class field {
   var $field;
   var $type;
   var $null;
   var $key;
   var $default;
   var $extra;

   function &field($field, $vals) {
      $this->field   = $field;
      $this->type    = $vals->Type;
      $this->null    = $vals->Null;
      $this->key    = $vals->Key;
      $this->default = $vals->Default;
      $this->extra = $vals->Extra;
   }
   
   function destroy() {
      $this->field   = null;
      $this->type    = null;
      $this->options = null;
   }
}




?>
