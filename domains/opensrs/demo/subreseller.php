<?
$callArray = array (
        "func" => "subresGet",
        "data" => array (
                "username" => "simple"
        )
);

require_once("../opensrs/openSRS_loader.php");

$callstring = json_encode($callArray);

$osrsHandler = processOpenSRS ("json", $callstring);

echo (" In: ". $callstring ."<br>");
echo ("Out: ". $osrsHandler->resultFormated);
?>
