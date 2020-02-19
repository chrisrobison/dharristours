<?php
header('Content-Type: text/html; charset=UTF-8');
$in = $_GET;

$start = microtime(true);

$out =  implode('', file('results.html'));
$out = str_replace('{self}', $_SERVER['PHP_SELF'], $out);
// $out = preg_replace("/\{([^\}]+)\}/e", '$out[\$1]', $out);

$out = preg_replace("/\{query\}/", $in['query'], $out);

$resout = extract_block($out, 'results');

if (isSet($_GET['query'])) {
	$query = $_GET['query'];

	include_once('whois.main.php');
	include_once('whois.utils.php');

	$whois = new Whois();

	// Set to true if you want to allow proxy requests
	$allowproxy = false;
	$whois->non_icann = true;
	$result = $whois->Lookup($query);

	// $resout = preg_replace("/\{query\}/", $query, $out);
	$winfo = '';

	switch ($in['output']) {
		case 'object':
			if ($whois->Query['status'] < 0) {
				$html = implode($whois->Query['errstr'],"\n<br></br>");
         } else {
				$utils = new utils;
				$html = $utils->showObject($result);
         }
			break;
      case 'json':
         header("Content-type: application/javascript");
         $obj = new stdClass();
         $obj->request = $in;
         $obj->result = $result;
         $obj->time = sprintf("%.02f", microtime(true) - $start);

         print json_encode($obj);
         exit;
         break;
		case 'nice':
			if (!empty($result['rawdata'])) {
				$utils = new utils;
				$winfo = $utils->showHTML($result);
            $out = preg_replace("/\{result\}/", $utils->showHTML($result), $out);
         } else {
				if (isset($whois->Query['errstr']))
					$winfo = implode($whois->Query['errstr'],"\n<br></br>");
				else
					$winfo = 'Unexpected error';
         }
         break;

		case 'proxy':
			if ($allowproxy)
				exit(serialize($result));

		default:
         print_r($result);
			if(!empty($result['rawdata'])) {
				$html .= '<pre>'.implode($result['rawdata'],"\n").'</pre>';
         } else {
				$html = implode($whois->Query['errstr'],"\n<br></br>");
         }
		}

	// $resout = str_replace('{result}', $winfo, $resout);
	}
else
	$resout = '';

$out = preg_replace("/\{result\}/m", $html, $out);

print $out;

//-------------------------------------------------------------------------

function extract_block (&$plantilla,$mark,$retmark='') {
   $start = strpos($plantilla,'<!--'.$mark.'-->');
   $final = strpos($plantilla,'<!--/'.$mark.'-->');

   if ($start === false || $final === false) return;

   $ini = $start + 7 + strlen($mark);

   $ret=substr($plantilla, $ini, $final - $ini);

   $final += 8 + strlen($mark);

   if ($retmark === false) {
      $plantilla=substr($plantilla, 0, $start).substr($plantilla, $final);
   } else	{
      if ($retmark == '') $retmark = $mark;
      $plantilla = substr($plantilla,0,$start) . '{' . $retmark . '}' . substr($plantilla, $final);
   }
      
   return $ret;
}
?>
