<?php
   require_once($_SERVER['DOCUMENT_ROOT']."/lib/auth.php");

   if (!function_exists('mime_content_type')) {
      function mime_content_type($f) {
         $f = escapeshellarg($f);
         return trim( `file -bi $f` );
      }
   }

   $dir = urldecode($_REQUEST['dir']);
   $reldir = preg_replace("|".$_SERVER['DOCUMENT_ROOT']."|", '', $dir);
   $root = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets;

if( file_exists($root . $dir) ) {
	$files = scandir($root . $dir);
	natcasesort($files);
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		print "<ul class='filetree' rel='$dir' style='display:none;'>";
		// All dirs
		foreach( $files as $file ) {
         
         $fullpath = htmlentities($dir . $file);
         if (!preg_match("/^(\.|CVS)/", $file)) {
            if ( file_exists($root . $dir . $file) && $file != '.' && $file != '..' && is_dir($root . $dir . $file) ) {
               print "<li class='directory collapsed'><a href='{$fullpath}' target='browserFrame' type='dir' rel=\"" . $fullpath . "/\">" . htmlentities($file) . "</a></li>";
            }
         }
		}
		// All files
		foreach( $files as $file ) {
         $fullpath = htmlentities($reldir . $file);
         if (!preg_match("/^\./", $file)) {
            if( file_exists($root . $dir . $file) && $file != '.' && $file != '..' && !is_dir($root . $dir . $file) ) {
               $type = mime_content_type($root . $dir . $file);
               $ext = preg_replace('/^.*\./', '', $file);
               print "<li class='file ext_$ext'><a href='#{$fullpath}' type='$type' rel=\"" . $fullpath . "\">" . htmlentities($file) . "</a></li>";
            }
         }
		}
		print "</ul>";	
	}
}

?>
