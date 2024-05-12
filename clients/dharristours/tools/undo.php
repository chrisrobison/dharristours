<?php
include("/simple/.env");

$link = mysqli_connect($env->db->host, $env->db->user, $env->db->pass, "SS_DHarrisTours");
$in = $_REQUEST;

$sql = "SELECT * FROM History WHERE `Undo` like '%" . $in['id'] . "%'";


