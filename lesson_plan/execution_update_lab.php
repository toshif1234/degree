<?php

require_once "../config.php";
$_SESSION["flag_save"] = 1;
$sub = $_SESSION['sub'];
$sem = $_SESSION['sem'];
$sec = $_SESSION['sec'];
$branch = $_SESSION['branch'];
// $q = 'select * from lessonpanl where subid = "' . $sub . '" and sem = "' . $sem . '" and sec = "' . $sec . '" and branch = "' . $branch . '" order by module, sr_no';
// $result = $r
$count = $_POST['count'];

for($i = 1; $i <= $count; $i++){
    $doe = $_POST['doe' . $i];
    $sr_no = $_POST['sr' . $i];
    $q3 = "update lessonpanl set dop_exe=\"" . $doe . "\" where sr_no=\"" . $sr_no . "\"";
    // echo $q3 . '<br>';
    $r1 = $link->query($q3);
}





header("Location: execution_viewing_lab.php");


