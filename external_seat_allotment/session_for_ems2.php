<?php

use WindowsAzure\ServiceManagement\Models\Location;

require_once "../config.php";
session_start();
$date = $_POST['date'] ;
$_SESSION['date']=$date;
header("Location: ../external_seat_allotment/ems2.php");
?>

<?php
include "../template/footer-fac.php";
?>