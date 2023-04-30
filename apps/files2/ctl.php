<?php
   require($_SERVER['DOCUMENT_ROOT'].'/lib/auth.php');

   $fileman = new fileman($_REQUEST, $boss);

   if (!$_REQUEST['x']) $_REQUEST['x'] = "get_children";
   $out = $fileman->{$_REQUEST['x']}($_REQUEST);
   
   if ($out) {
      header("Content-type: application/json");
      print json_encode($out);
   }

   class fileman {
      function __construct($in, $boss) {
         $this->boss = $boss;
         $this->in = $in;
         $path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets . preg_replace("/-_-/", "/", $in['id']);
         
         // $this->path = (is_dir($path)) ? $path : dirname($path);
         // $this->file = ($in['title']) ? $in['title'] : (is_dir($path)) ? $path : preg_replace("|".dirname($path)."|", "", $path);
         
         $this->fullpath = $path;
         $this->path = dirname($path);
         $this->file = basename($path);
      }
      
      function get_children($in) {
         $out = array();
         $in['id'] = preg_replace("/-_--_-/", "-_-", $in['id']);

         $dh = opendir($this->fullpath);
         $rpath = preg_replace("/\-_\-/", "/", $in['id']);

         while ($file = readdir($dh)) {
            if ((!preg_match("/^\./", $file)) && (!preg_match("/^CVS$/", $file))) {
               $tmp = new stdClass();
               $tmp->attr = new stdClass();
               $tmp->attr->id = preg_replace("/-_--_-/", "-_-", preg_replace("/\//", "-_-", $in['id'] . '/' . $file));
               $tmp->data = $file;
               $tmp->path = $rpath . '/' . $file;

               if (is_dir($this->fullpath . '/' . $file)) {
                  $tmp->attr->rel = "folder";
                  $tmp->state = "closed";
               } else {
                  $tmp->attr->rel = "default";
               }

               $out[] = $tmp;
            }
         }
         closedir($dh);
         sort($out);
         return $out;
      }

      function move($in) {
         $dest = $_SERVER['DOCUMENT_ROOT'] . $this->boss->app->Assets . preg_replace("/-_-/", "/", $in['ref']);
         $file = $this->fullpath;
         // mv: rename /home/cdr/domains/dev.sscsf.com/base/clients/admin/thankyou//home/cdr/domains/dev.sscsf.com/base/clients/admin/thankyou to /home/cdr/domains/dev.sscsf.com/base/clients/admin/Test/thankyou: No such file or directory
         $out = new stdClass();

         if ($in["copy"]) {
            $file = preg_replace("/\/\//", '/', $file);
            $dest = preg_replace("/\/\//", '/', $dest);
            $results = `/bin/cp "$file" "$dest" 2>&1`;
            file_put_contents("/tmp/files2.log", "cp $file $dest\n$results\n--\n", FILE_APPEND);
            $results = ($results) ? $results : "Successfully copied {$this->file} to $dest.";

         } else {
            $results = `/bin/mv "$file" "$dest" 2>&1`;
            file_put_contents("/tmp/files2.log", "mv '$file' '$dest'\n$results\n--\n", FILE_APPEND);
            $results = ($results) ? $results : "Successfully moved {$this->file} to $dest.";
         }
         
         $out->id = preg_replace("|/|", "-_-", $in['ref']);
         $out->status = (preg_match("/\w/", $results)) ? "Error" : "OK";
         $out->results = $results;
         
         return $out;
      }

      function create($in) {
         $out = new stdClass();
         
         $file = preg_replace("/-_--_-/", "-_-", preg_replace("/-_-/", "/", $in['id'] . '/' . $in['title']));
         $path = $_SERVER['DOCUMENT_ROOT'] . $this->boss->app->Assets . $file;
         $results = `/usr/bin/touch {$path} 2>&1`;
         file_put_contents("/tmp/files2.log", "create $file in $path\n$results\n", FILE_APPEND);

         $out->id = preg_replace("|/|", "-_-", $this->boss->app->Assets . $file);
         $out->status = !$results ? "OK" : "Error";
         $out->results = $results;

         return $out;
      }

      function rename($in) {
         $out = new stdClass();

         $out->status = "OK";
         $out->results = $results;
         $out->error = "Called rename with " . var_dump($in);

         return $out;
      }

   }
?>
