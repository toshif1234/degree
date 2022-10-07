<?php
require_once "config.php";
session_start();
// $_SESSION["branch"]=$_SESSION["branch"];
// $_SESSION["batch"]=$_SESSION["batch"];
$q="update students set semester=\"" . $_POST["semester"] . "\" where branch=\"" . $_SESSION["branch"] . "\" and batch=\"" . $_SESSION["batch"] . "\"";

$result=$con->query($q);
header("Location: batch_creation.php");


?>