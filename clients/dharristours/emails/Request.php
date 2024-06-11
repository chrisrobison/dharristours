<?php

include('/simple/.env');
include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/lib/auth.php');

$in = $_REQUEST;

if (isset($in['id'])) {
    $html = file_get_contents("Request.html");
    
    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
    $sql = "SELECT * from Request WHERE RequestID='{$in['id']}'";
    
    $res = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_object($res)) {
        $row->RoundTrip = ($row->RoundTrip) ? "Yes" : "No";
        $row->ADA = ($row->ADA) ? "Yes" : "No";
        $row->Shuttle = ($row->Shuttle) ? "Yes" : "No";
        $row->Text = ($row->Text) ? "Yes" : "No";
        $row->FullDate = date("l, F jS", strtotime($row->Date)); 
        $row->Date = date("m/d/Y", strtotime($row->Date));

        if ($row->Business) {
$row->BusinessRow = <<<EOT
    <tr>
      <td class="tbl-label" style="text-align:right;vertical-align:top;padding:0.25em;background-color:#eee;">Business</td>
      <td class="tbl-value" style="vertical-align:top;border-top:1px solid #aaa;border-left:1px solid #aaa;padding:0.25em;background-color:#fff;">{$row->Business}</td>
    </tr>
EOT;
        }
        
        if ($row->Phone) {
            $row->Phone = formatPhone($row->Phone);
        }
        if (!preg_match("/\w/", $row->Name) && $row->Business) {
            $row->Name = $row->Business;
        }
        $html = preg_replace_callback("/\{\{([^\}]*)\}\}/", function($m) {
            global $row;
            if (isset($row->{$m[1]})) {
                return $row->{$m[1]};
            } else {
                return "";
            }
        }, $html);
        
    }

}

print $html;

function formatPhone($num) {
    $num = preg_replace("/\D/", "", $num);

    if (preg_match("/(\d\d\d)(\d\d\d)(\d\d\d\d)/", $num, $m)) {
        $newnum = "({$m[1]}) {$m[2]}-{$m[3]}";
    }
    return $newnum;
}
