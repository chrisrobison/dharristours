<?php
/*
   jQuery File Tree PHP Connector
  
   Version 2.02
   
   Christopher D. Robison <cdr@cdr2.com>
   Updated: 12/21/2009

   Based on original by:
   Cory S.N. LaViska [http://abeautifulsite.net/)
   24 March 2008
  
   History:
   2.03 - added function mime_content_type for php installations without it (requires 'file' command)
   2.02 - added file extension CSS classes to relevant files
   2.01 - updated anchors to use href's as well as rel's for path information; 
   2.00 - split files and directory handling; updated security issue with unquoted input;  
   1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
   1.00 - released (24 March 2008)
  
   Output a list of files for jQuery File Tree
*/
if (!function_exists('mime_content_type')) {
   function mime_content_type($f) {
      $f = escapeshellarg($f);
      return trim( `file -bi $f` );
   }
}


$dir = urldecode($_POST['dir']);

if( file_exists($root . $dir) ) {
	$files = scandir($root . $dir);
	natcasesort($files);
	if( count($files) > 2 ) { /* The 2 accounts for . and .. */
		print "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
		// All dirs
		foreach( $files as $file ) {
         $fullpath = htmlentities($dir . $file);
         if (!preg_match("/^\.|CVS/", $file)) {
            if ( file_exists($root . $dir . $file) && $file != '.' && $file != '..' && is_dir($root . $dir . $file) ) {
               print "<li class='directory collapsed'><a href='#' type='dir' rel=\"" . $fullpath . "/\">" . htmlentities($file) . "</a></li>";
            }
         }
		}
		// All files
		foreach( $files as $file ) {
         $fullpath = htmlentities($dir . $file);
         if (!preg_match("/^\./", $file)) {
            if( file_exists($root . $dir . $file) && $file != '.' && $file != '..' && !is_dir($root . $dir . $file) ) {
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
