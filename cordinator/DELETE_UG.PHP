<?php

require_once "../config.php";
$id = $_POST["fac_id"];

$q1 = 'update coordinator set ug_coordinator =0   where faculty_id="'. $id .'"';
$res = $link->query($q1);
header("Location: view_ug.php");

?>