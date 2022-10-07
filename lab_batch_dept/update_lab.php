<?php
session_start();
require_once("../config.php");
$adm_no = $_POST["adm_no"];
$lab_batch = $_POST["lab_batch"];

$_SESSION["sec"] = $_POST["sec"];
$_SESSION["branch"] = $_POST["branch"];
$_SESSION["batch"] = $_POST["batch"];
$q1 = 'update students set lab_batch = "' . $lab_batch . '" where adm_no = "' . $adm_no . '"';
if($link->query($q1)){
    echo "done";
    header("Location:batch_create.php");
}
else{
    echo "failed";
}
?>