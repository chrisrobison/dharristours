#!/usr/local/bin/php
<?php
    include((($_SERVER['DOCUMENT_ROOT']) ? $_SERVER['DOCUMENT_ROOT'] : '/simple') . '/.env');

    $link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");

    $sql = "select JobID, Job, JobDate from Job where JobCancelled=0 and Job like '% buses%';";
    $results = mysqli_query($link, $sql);
    
    $records = array();

    while ($row = mysqli_fetch_object($results)) {
       $records[] = $row; 
    }

    $out = array();
    foreach ($records as $rec) {
        $search = preg_replace("/\d\sbuses.*/", '', $rec->Job);
        $search = preg_replace("/\d\s+of\s+\d\s+buses.*/", '', $search);
        $search = preg_replace("/\*/", '', $search);

        $sql = "SELECT JobID, Job, JobDate from Job where Job like '%" . mysqli_real_escape_string($link, $search) ."%'";
        $results = mysqli_query($link, $sql);
        $sub = array();
        while ($row = mysqli_fetch_object($results)) {
            if (!array_key_exists($row->JobDate, $sub)) {
                $sub[$row->JobDate] = array();
            }
            $sub[$row->JobDate][] = $row;
        }
        $out[] = $sub;
    }
$seen = array();    
$sqlup = array();
    foreach ($out as $item) {
        foreach ($item as $date=>$list) {
            if (count($list) > 1) {
                $parent = array_shift($list);
                $pid = $parent->JobID;
                foreach ($list as $rec) {
                    if (!array_key_exists($rec->JobID, $seen)) {
                        $upd = "UPDATE Job set ParentID='$pid' WHERE JobID='$rec->JobID';";
                        $sqlup[] = $upd;
                        $seen[$rec->JobID] = $pid;
                    }
                }
            }
        }
    }
    print implode("\n", $sqlup);
?>
