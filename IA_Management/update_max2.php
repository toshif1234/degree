<?php
session_start();
require_once "../config.php";
$branch = $_SESSION["branch"];
$sec = $_SESSION["sec"];
$sem = $_SESSION["sem"];
$sub = $_SESSION["sub"];
$r1=explode(' - ',$sub);

// $flag=$_POST['1c'] ?? 0;
// echo $flag;
$q="update ia2_max_marks set 1a=" . ($_POST['1a'] ?? 0) . ",1b=" . ($_POST['1b'] ?? 0) . ",1c=" . ($_POST['1c'] ?? 0) . ",2a=" . ($_POST['2a'] ?? 0) . ",2b=" . ($_POST['2b'] ?? 0) . ",2c=" . ($_POST['2c'] ?? 0) . ",3a=" . ($_POST['3a'] ?? 0) . ",3b=" . ($_POST['3b'] ?? 0) . ",3c=" . ($_POST['3c'] ?? 0) . ",4a=" . ($_POST['4a'] ?? 0) . ",4b=" . ($_POST['4b'] ?? 0) . ",4c=" . ($_POST['4c'] ?? 0) . " where sub_code='" . $r1[0] . "' and dept='" . $branch . "';";
echo $q;
$q2="update ia2_co_mapping set 1a='" . ($_POST['1a-co'] ?? 0) . "',1b='" . ($_POST['1b-co'] ?? 0) . "',1c='" . ($_POST['1c-co'] ?? 0) . "',2a='" . ($_POST['2a-co'] ?? 0) . "',2b='" . ($_POST['2b-co'] ?? 0) . "',2c='" . ($_POST['2c-co'] ?? 0) . "',3a='" . ($_POST['3a-co'] ?? 0) . "',3b='" . ($_POST['3b-co'] ?? 0) . "',3c='" . ($_POST['3c-co'] ?? 0) . "',4a='" . ($_POST['4a-co'] ?? 0) . "',4b='" . ($_POST['4b-co'] ?? 0) . "',4c='" . ($_POST['4c-co'] ?? 0) . "'where sub_code='" . $r1[0] . "' and dept='" . $branch . "';";
echo $q2;
$link->query($q2);
// try{
$link->query($q);
// }
// catch(Exception $e){
//     $q1="delete from ia2_max_marks where sub_code=\"" . $r1[0] . "\"";
    
    // $q3="delete from ia2_co_mapping where sub_code=\"" . $r1[0] . "\"";
    // $link->query($q1);
    // $link->query($q3);
    // $link->query($q);
// $link->query($q2);
// }
header("Location:ia_marks1.php")
?>