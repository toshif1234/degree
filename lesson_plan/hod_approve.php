<?php
include "../config.php";
// session_start();
$p = 'select * from lesson_plan_approval where sem="' . $_POST['sem'] . '" and sec="' . $_POST['sec'] . '" and sub="' . $_POST['sub'] . '" and branch ="' . $_SESSION['branch'] . '"';
// echo $p;
try {
    $pre = mysqli_num_rows($link->query($p));
} catch (Exception $e) {
    $pre = 0;
}
if ($pre == 0) {

    $q = 'INSERT INTO `lesson_plan_approval`( `sem`, `sec`, `sub`, `hod`, `status`, `branch`) VALUES ("' . $_POST["sem"] . '","' . $_POST["sec"] . '","' . $_POST["sub"] . '","' . $_POST["hod_select"] . '","Pending", "' . $_SESSION['branch'] . '")';
// echo $q;
}
else{
    $q = 'update lesson_plan_approval set status="Pending" where sub="' . $_POST['sub'] . '" and hod="' . $_POST['hod_select'] . '"';
}
// echo $q;
$link->query($q);
header("Location: display.php");
