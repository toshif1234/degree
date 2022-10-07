<?php
session_start();
require_once '../config.php';
$co =  implode(',', $_POST["co_no"]);


$q3 = "update add_assignment set `semester` = \"" . $_POST["semester"] . "\", `section` =\"" . $_POST["section"] . "\",`co_no` = \"$co\", `last_date` = \"" . $_POST["last_date"] . "\" where `sub_name` = \"" . $_POST["sub_name"] . "\" and `assignment_no` =  \"" . $_POST["assignment_no"] . "\" and 
`branch` = \"" . $_POST["branch"] . "\" and
`semester` = \"" . $_POST["semester"] . "\" and
`section` = \"" . $_POST["section"] . "\" and
`fac_name` = \"" . $_POST["fac_name"] . "\" 
";

// echo $q3;
if ($link->query($q3)) {
    $_SESSION['assignment_update'] = "success";
    header("Location: ../assignment/fac_assignment.php");
} else {
    echo $q3;
    echo "<h1>Assignment failed</h1>";
    $_SESSION['assignment_update'] = "failed";
    header("Location: ../assignment/fac_assignment.php");
}
?>