<?php
require_once "config.php";
error_reporting(0);
session_start();
// $_SESSION["branch"]=$_SESSION["branch"];
// $_SESSION["batch"]=$_SESSION["batch"];
$q="update students set section=\"" . $_POST["section"] . "\" ,semester=\"" . $_POST["semester"] . "\" where branch=\"" . $_SESSION["branch"] . "\" and batch=\"" . $_SESSION["batch"] . "\" and adm_no=\"" . $_POST["adm_no"] . "\"";
$result=$con->query($q);
header("Location: batch_creation.php");


?>