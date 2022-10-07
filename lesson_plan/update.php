<?php
require_once '../config.php';
$con = $link;
// session_start();
$con1 = $_SESSION["con1"];
$con2 = 0;
$sem = $_SESSION["sem"];
$subid = $_SESSION["subid"];
$sec = $_SESSION["sec"];
$q1 = "select * from lessonpanl where sem=\"" . $sem . "\" and subid =\"" . $subid . "\" and section =\"" . $sec . "\" and branch = \"" . $_SESSION['branch'] . "\"";
$result = $con->query($q1);
// echo $q1 . '<br><br>';
$r = mysqli_fetch_assoc($result);
// echo $_POST['dop_Plan1'];
// foreach($result as $r){
//     print_r($r);
//     echo "<br>";
//     echo "<br>";
//     echo "<br>";
// }
foreach ($result as $r) {
    $sl_no = $r['sr_no'];
    $con2++;
    $date = $_POST["dop_Plan$con2"];
    $topic = $_POST["topic$con2"];
    $textbook = $_POST["textbook$con2"];
    $co_select = $_POST["co_select$con2"];
    $lvl_select = $_POST["lvl_select$con2"];
    $q3 = "update lessonpanl set dop_Plan=\"" . $date . "\", pending =\"" . $topic . "\", textbook =\"" . $textbook . "\", co =\"" . $co_select . "\", bt_evel =\"" . $lvl_select . "\" where sr_no=\"" . $sl_no . "\"";
    $r1 = $con->query($q3);
    // echo $q3 . '<br>';


}
header("Location: display.php");
// for($i=1;$i<=$con1;$i++)
// {
//     $date=$_POST["dop_plan$con1"];
//     $topic=$_POST["topic$con1"];
//     $textbook=$_POST["textbook$con1"];
//     $co_select=$_POST["co_select$con1"];
//     $lvl_select=$_POST["lvl_select$con1"];
//     $q="update lessonpanl set dop_Plan =\"" .  
// }
