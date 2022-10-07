<?php
require_once '../config.php';
session_start();
$_SESSION['semester'] = $_POST['semester'];
$_SESSION['section'] = $_POST['section'];
$_SESSION['branch'] = $_POST['branch'];
$_SESSION['sub_name'] = $_POST['sub_name'];
header("Location: ../assignment/fac_assignment_avg_marks.php");
?>