#!/usr/bin/php
<?php
    
for ($i=8; $i<25; $i++) {
    $num = sprintf("%1$03d", $i);
    $filename = sprintf("EPSON%1$03d.PDF", $i);

    $cmd = "ocrmypdf -r --sidecar {$num}.txt --redo-ocr EPSON{$num}.PDF $num.pdf";
    print $cmd."\n";
    system($cmd);


}
?>
