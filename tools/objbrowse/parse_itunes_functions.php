<?


$to_display= array("Name", "Artist", "Album", "Size");

function cmp ($a, $b) 
{
	$sort = !empty($_GET["sort_by"]) ? $_GET["sort_by"] : "Artist";
    return strcmp($a[$sort], $b[$sort]);
}

function array_to_table($array, $printable)
{
  //expects multi-dimensional array, all with the same keys
  $first_time=TRUE;
  $str = "<table border='1'>\n";
  $str .= "<tr>\n";
  foreach($array as $elem_key=>$element){
    if($first_time){
      $header_itmes=array_keys($element);
      foreach($header_itmes as $header){
          if(in_array($header, $printable)){
            $str .= "<th><a href='" . $_SERVER["PHP_SELF"]
            . "?sort_by=" . urlencode($header) . "'>" . $header 
            . "</a></th>\n";
          }
      }
      $str .= "</tr>\n";
      $first_time=FALSE;
    }
    $str .= "<tr>\n";
    foreach($element as $k => $v){
      if(in_array($k, $printable)){
        $str .= "<td>" . $v . "</td>\n";
      }
    }
    $str .= "</tr>\n";
  }
  $str .= "</table>";
  return $str;
} 

?>
