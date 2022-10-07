<?php

require_once "../config.php";
$id = $_POST["fac_id"];

$q1 = 'delete from hod where faculty_id="'. $id .'"';
$res = $link->query($q1);
header("Location: view_hod.php");

?>