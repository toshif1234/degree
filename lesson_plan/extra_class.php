<?php
include("../config.php");
$_SESSION["flag_save"] = 1;
// session_start();
$sem = $_POST["sem"];
$sec = $_POST["sec"];
$sub = $_POST["subid"];
$module = $_POST["module"];
$doe = $_POST["doe"];
$completed = $_POST["completed"];
$txt = $_POST['txt'];

$q = "INSERT INTO `lessonpanl`( `sem`, `subid`, `section`, `module`,  `dop_exe`, `complet`, `dop_Plan`, `pending` , `branch`, `textbook`) VALUES (\"" . $sem . "\", \"" . $sub . "\",\"" . $sec . "\", \"" . $module . "\",\"" . $doe . "\",\"" . $completed . "\",\"" . $doe . "\",\"" . " " . "\",\"" . $_SESSION['branch'] . "\", \"" . $txt . "\")";
// echo $q;
// $con = mysqli_connect("localhost", "root", "", "erp_alvas");

$r = $link->query($q);

header("Location: execution_viewing.php");
