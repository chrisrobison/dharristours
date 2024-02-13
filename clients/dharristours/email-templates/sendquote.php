<?php
    $env = "prod";  // Change this to 'prod' for production environment or 'dev' from dev env

    $conf['dev'] = array("root"=>"/simple.dev",
                        "host"=>"dharristours.dev.sscsf.com",
                        "db"=>"SS_DHarrisTours");

    $conf['prod'] = array("root"=>"/simple",
                         "host"=>"dharristours.simpsf.com",
                         "db"=>"SS_DHarrisTours");

    require("/simple/lib/boss_class.php");

    $in = $_REQUEST;
    $boss = new boss("dharristours.simpsf.com");

    $obj = $boss->getObject("Request", $in['id']);

    $result = `./htmlmail.sh -s "Quote for trip on {$obj->Date}" -f "D Harris Tours <noreply@dharristours.com>" -t "{$obj->Name} <{$obj->Email}>" 'https://dharristours.simpsf.com/files/email-templates/example.php?id={$obj->RequestID}' > /simple/spool/Request_{$obj->RequestID}.eml`;
    $result = `./htmlmail.sh -s "Quote for trip on {$obj->Date}" -f "D Harris Tours <noreply@dharristours.com>" -t "{$obj->Name} <{$obj->Email}>" 'https://dharristours.simpsf.com/files/email-templates/example.php?id={$obj->RequestID}' > /tmp/Request_{$obj->RequestID}.eml`;

    $out = new stdClass();
    $out->status = "ok";

    header("Content-type: application/json");
    print json_encode($out);

?>
