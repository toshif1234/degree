<?php
require_once "config.php";
session_start();
// $_SESSION["branch"]=$_SESSION["branch"];
// $_SESSION["batch"]=$_SESSION["batch"];
$q="update students set section=\"" . $_POST["section"] . "\" ,semester=\"" . $_POST["semester"] . "\" where branch=\"" . $_SESSION["branch"] . "\" and batch=\"" . $_SESSION["batch"] . "\" and adm_no=\"" . $_POST["adm_no"] . "\"";
$q2 = 'update ia_marks1 set sec = "' . $_POST["section"] . '" where adm_no = "' . $_POST["adm_no"] . '"'; 
$q3 = 'update ia_marks2 set sec = "' . $_POST["section"] . '" where adm_no = "' . $_POST["adm_no"] . '"'; 
$q4 = 'update ia_marks3 set sec = "' . $_POST["section"] . '" where adm_no = "' . $_POST["adm_no"] . '"'; 
$q6 = 'update attendance set section = "' . chr(ord($next) + $i) . '" where usn = "' . $res2['usn'] . '"';
$q5 = 'update marks set sec = "' . chr(ord($next) + $i) . '" where usn = "' . $res2['usn'] . '"';
$con->query($q2);
// echo $q6;
$con->query($q3);
$con->query($q4);
$con->query($q5);
$con->query($q6);
$result=$con->query($q);
header("Location: batch_creation.php");


?>