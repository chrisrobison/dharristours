<?

include "parse_itunes_functions.php";

$dom=domxml_open_file("library.xml");

//$dicts will contain an array <dict> elements
$dicts=$dom->get_elements_by_tagname("dict");

//I'm interested in everything within the second dict tag
//that's where the entire music library is
//$childs will contain an array of <dicts>.
//The sub-elements of each <dict> contain all song data.

$song_nodes = $dicts[1]->get_elements_by_tagname("dict");

// get the first "dict" object (the first object with song data)
$song_node = $song_nodes[0];

// now iterate through the song objects and their data
// using the next_sibling() method to move
$i = 0;

while ($song_node){
    $data_node = $song_node->first_child();
    while($data_node)    {
	    if($data_node->node_name() != "#text"){
	    	if($data_node->node_name() == "key"){ // found a key
	    		$array_key=$data_node->get_content();
	    	} else {// found the value for the current key
	    		$songs[$i][$array_key]=$data_node->get_content();
	    	}
	    }
	    // now advance to the next data node at this level (within a song)
        $data_node = $data_node->next_sibling();
   }
   $i++;
   // advance to the next song node
   $song_node = $song_node->next_sibling();
}


usort($songs, "cmp");
echo array_to_table($songs, $to_display);


?>


