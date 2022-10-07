<?php
require_once "../config.php";
session_start();



$q = 'select * from students where branch ="' . $_POST["dept"] . '"';
// echo $q;
$result = $link->query($q);
foreach($result as $r){
$id = mysqli_fetch_assoc($link->query('select max(id) from users'))['max(id)'] + 1;
$password = password_hash($r["usn"], PASSWORD_DEFAULT);

$q_p = 'insert into users(`id`, `username`,`password`,`identity`,`dept`) values("' . $id . '","' . $r["usn"] . '","' . $password . '",-1,"' . $_SESSION['dept'] . '")';
// echo $q_p;
try {
    $result = $link->query($q_p);
} catch (Exception $e) {
    
}


}
header('Location: register_stud.php');

?>