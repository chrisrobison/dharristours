<?php

include "parse_itunes_functions.php";

function parse_via_pcre($contents)
{
	//get everything between the <Tracks> and <Playlists>
	//tags, which will include each library element.
	preg_match("/Tracks<\/key>.*?<dict>(.*)<key>Playlists/s", $contents, $whole_match);
	
	//the text between each <dict> tag will be a library item	
	preg_match_all("/<dict>(.*?)<\/dict>/s", $whole_match[1], $items);
	$songs=array();
	//$j is a generic counter.
	$j=0;
	foreach($items[1] as $value){
	
	//this function creates two needed arrays
	//$elements[1], which stores the values within the <key> tags, and
	//$elements[2], which stores the values within the tags that follow <key>
	preg_match_all("/<key>(.*?)<\/key>.*?<.*?>(.*?)<\/.*?>/s", $value, $elements);

		//for each element assign a key and value to $songs array
		for($i=0; $i < count($elements[1]); $i++){
			$key=$elements[1][$i];
			$value=$elements[2][$i];
			$songs[$j][$key]=$value;
		}
		$j++;	
	}
	return $songs;
}


$fp=fopen("library.xml", "r");
$contents=fread($fp, filesize("library.xml"));
fclose($fp);
$songs=parse_via_pcre($contents);
usort($songs, "cmp");
echo array_to_table($songs, $to_display);

?>