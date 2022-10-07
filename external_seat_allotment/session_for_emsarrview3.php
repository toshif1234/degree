<?php

use WindowsAzure\ServiceManagement\Models\Location;

require_once "../config.php";
session_start();
echo  $ps = $_POST['us_code'] ;
$_SESSION['us_code']=$ps;
header("Location: ../external_seat_allotment/emsviewarr3.php");
?>

<?php
include "../template/footer-fac.php";
?>