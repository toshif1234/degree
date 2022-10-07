<?php
require_once "../config.php";
session_start();
$id = mysqli_fetch_assoc($link->query('select max(id) from users'))['max(id)'] + 1;
$password = password_hash($_POST["usn"], PASSWORD_DEFAULT);

$q_p = 'insert into users(`id`, `username`,`password`,`identity`,`dept`) values("' . $id . '","' . $_POST["usn"] . '","' . $password . '",-1,"' . $_SESSION['dept'] . '")';
// echo $q_p;
$result = $link->query($q_p);
header('Location: register_stud.php');

?>