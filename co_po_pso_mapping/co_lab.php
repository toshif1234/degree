<?php

require_once "../config.php";
$co1 = $_POST['co1'];
if ($co1 == 'N/A') {
    $co1 = '0';
}
$co2 = $_POST['co2'];
if ($co2 == 'N/A') {
    $co2 = '0';
}
$co3 = $_POST['co3'];
if ($co3 == 'N/A') {
    $co3 = '0';
}
$co4 = $_POST['co4'];
if($co4 == 'N/A'){
    $co4 = '0';
}
$co5 = $_POST['co5'];
if ($co5 == 'N/A') {
    $co5 = '0';
}
$co6 = $_POST['co6'];
if ($co6 == 'N/A') {
    $co6 = '0';
}

$fac_id = $_POST['fac_id'];
$branch = $_POST['branch'];
$sub = $_POST['sub'];

$q = 'UPDATE `co` SET `co1`= "' . $co1 . '",`co2`="' . $co2 . '",`co3`="' . $co3 . '",`co4`="' . $co4 . '",`co5`="' . $co5 . '",`co6`="' . $co6 . '" where faculty_id = "' . $fac_id . '" and dept = "' . $branch . '" and sub like "' . explode(' - ', $sub)[0] .'%"';
$link->query($q);
header("Location: co_po_pso.php");

