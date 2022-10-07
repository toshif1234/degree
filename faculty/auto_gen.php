<?php
require_once "../config.php";
session_start();



$q = "select * from faculty_details";
// echo $q;
$result = $link->query($q);
foreach($result as $r){
$id = mysqli_fetch_assoc($link->query('select max(id) from users'))['max(id)'] + 1;
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);

$q_p = 'insert into users(`id`, `username`,`password`,`identity`,`dept`) values("' . $id . '","' . $r["faculty_email"] . '","' . $password . '",2,"' . $r["faculty_dept"] . '")';
// echo $q_p;
echo $r["faculty_email"];
echo "<br>";
try {
    $result = $link->query($q_p);
} catch (Exception $e) {
    
}

}
header('Location: register.php');