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

$path = $_SERVER['DOCUMENT_ROOT'] . $boss->app->Assets ; 
if (file_exists($path . $dir)) {
   
	$files = scandir($path . $dir);
	natcasesort($files);
	if( $files ) {
		print "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
         $fullpath = htmlentities($dir . $file);
         if (!preg_match("/^(\.|CVS)/", $file)) {
            if ( file_exists($path . $dir . '/' . $file) && $file != '.' && $file != '..' && is_dir($path . $dir . '/' . $file) ) {
               print "<li class='directory collapsed'><a href='#' target='browserFrame' type='dir' rel=\"" . $fullpath . "/\">" . htmlentities($file) . "</a></li>";
            }
         }
		}
		// All files
		foreach( $files as $file ) {
         $fullpath = htmlentities($reldir . $file);
         if (!preg_match("/^\./", $file)) {
            if( file_exists($path . $dir . '/' . $file) && $file != '.' && $file != '..' && !is_dir($path . $dir . '/' . $file) ) {
               $type = mime_content_type($dir . $file);
               $ext = preg_replace('/^.*\./', '', $file);
               print "<li class='file ext_$ext'><a href='#' type='$type' rel=\"" . $fullpath . "\">" . htmlentities($file) . "</a></li>";
            }
         }
		}
		print "</ul>";	
	}
}

?>
