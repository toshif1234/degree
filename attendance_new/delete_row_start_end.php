<?php 
require_once "../config.php";
$sem = $_POST['sem'];
$q = 'delete from sem_start_end where sem="' . $sem . '";';
$link->query($q);
header("Location: sem_start_end.php");
?>