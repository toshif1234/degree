<?php
// session_start();
require_once "../config.php";
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // echo 'in';

    header("location: ../index.php");
    // exit;

}

$q1 = "select * from users where identity = 2 or identity = 3";
$u_name = $link->query($q1);
// echo $_SESSION['username'];

$flag = 0;
// echo $_SESSION['username'];
if ($_SESSION["username"] == "vivek_alva@alvas.org") {
    $flag = 1;
} else {

    foreach ($u_name as $u) {
        $q = 'select faculty_email from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';
        // echo $q;
        $user = mysqli_fetch_assoc($link->query($q))['faculty_email'];
        // echo $user;
        if ($u["username"] == $user) {
            $flag = 1;
        }
    }
}

if (!$flag) {
    header("location: ../index.php");
}

$hod = 0;

$qh = "select * from hod";
$rh = $link->query($qh);
foreach ($rh as $r) {
    if ($_SESSION["username"] == $r["name"]) {
        $hod = 1;
        break;
    }
}
