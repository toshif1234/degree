<?php
require_once "../config.php";
$_SESSION["flag_save"] = 1;
$sr_no = $_GET['sr_no'];
$q = 'delete from lessonpanl where sr_no = "' . $sr_no . '"';
// echo $q;
$link->query($q);

header("Location: execution_viewing.php");
