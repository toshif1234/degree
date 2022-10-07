<?php

use WindowsAzure\ServiceManagement\Models\Location;

require_once "../config.php";
session_start();
  $ps = $_POST['ps_code'] ;
$_SESSION['ps_code']=$ps;
header("Location: ../external_seat_allotment/hodviewarr4.php");
?>

<?php
include "../template/footer-fac.php";
?>