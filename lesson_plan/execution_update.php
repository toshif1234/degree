<?php
require_once '../config.php';
$con = $link;
session_start();
$flag=0;
$sem=$_SESSION["sem1"];
$subid=$_SESSION["subid1"];
$sec=$_SESSION["sec1"];
$sr_num=$_POST["sr_num"];
$branch = $_SESSION['branch'];
// $con1=$_POST["con1"];
$q1 = "select * from lessonpanl where sem=\"" . $sem . "\" and subid =\"" . $subid . "\" and section =\"" . $sec . "\" and sr_no=\"" . $sr_num . "\" and branch = \"" . $branch . "\"";

$result = $con -> query($q1);
$r = mysqli_fetch_assoc($result);
// echo $_POST['dop_Plan1'];
// foreach($result as $r){
//     print_r($r);
//     echo "<br>";
//     echo "<br>";
//     echo "<br>";

// }

    

    $doe = $_POST["doe"];
    $comp = $_POST["compin"];
    // echo $doe;
    // echo "<br><b>";
    // echo $comp;
    $q3 = "update lessonpanl set dop_exe=\"" . $doe . "\", complet=\"" . $comp . "\" where sr_no=\"" . $sr_num . "\"";
    // echo $q3;
    $r1 = $con -> query($q3);
    if($r1 == 1 ){
        $flag=1;
    }
    $_SESSION["flag"] = $flag;

    $_SESSION["flag_save"]=1;
header("Location: execution_viewing.php");





// for($i=1;$i<=$con1;$i++)
// {
//     $date=$_POST["dop_plan$con1"];
//     $topic=$_POST["topic$con1"];
//     $textbook=$_POST["textbook$con1"];
//     $co_select=$_POST["co_select$con1"];
//     $lvl_select=$_POST["lvl_select$con1"];
//     $q="update lessonpanl set dop_Plan =\"" .  
// }



?>