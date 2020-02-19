<?php
    $contents = file("https://csv.telematics.tomtom.com/extern?account=harris-tours&username=cdr&password=Simple1%21&apikey=2b6c8db8-071f-44c0-988f-d82718b1be29&lang=en&action=showObjectReportExtern&outputformat=json")[0];
    
    $obj = json_decode($contents);

    $busid = $_GET['bus'];
    if (!$busid) {
    	$busid = '3601';
    }
    if ($busid) {
        for ($i=0; $i<count($obj); $i++) {
            if ($obj[$i]->objectno == $busid) {
                $bus = $obj[$i];
            }
        }
    }
    $mapurl = "https://maps.google.com/?q=" . urlencode($bus->latitude) . "+" . urlencode($bus->longitude) . "&t=k";

?>
<script>
    window.location = "<?php print $mapurl; ?>";
</script>
