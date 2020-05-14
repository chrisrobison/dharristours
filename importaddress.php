<?php
include('.env');

$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, $env->db->db);
 //$results = mysqli_query($link, "SELECT * from ZipCode where ZipCode='".$zip."'");
$lines = file("addresses.txt", FILE_IGNORE_NEW_LINES);
$cnt = count($lines);
$fields = preg_split("/\|/", $lines[0]);

for ($i=1; $i<$cnt; $i++) {
   $parts = preg_split("/\|/", $lines[$i]);
if (count($parts) != 4) {
} else {
   $out = "INSERT INTO Address (".implode(",", $fields).") VALUES (\"". implode('","', $parts)."\");\n";
   print $out;

}
}

?>
