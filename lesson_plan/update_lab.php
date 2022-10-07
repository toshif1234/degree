<?php

require_once "../config.php";

$count = $_POST['count'];
$sem = $_SESSION['sem'];
$sub = $_SESSION['sub'];
$branch = $_SESSION['branch'];
$sec = $_SESSION['sec'];

for($i = 1; $i <= $count; $i++){
    $q = 'update lessonpanl set pending = "' . $_POST['exp_name' . $i] . '", dop_Plan = "' . $_POST['plan-date' . $i] . '" where branch = "' . $branch . '" and sem = "' . $sem . '" and section = "' . $sec . '" and subid = "' . $sub . '" and module = "' . $i . '"';
    // echo $q . '<br>';
    $link->query($q);
}

header("Location: display_lab.php");