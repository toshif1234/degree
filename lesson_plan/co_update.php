<?php

    require_once "../config.php";
    // session_start();
//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    $c1 = $_POST['co1'];
    $c2 = $_POST['co2'];
    $c3 = $_POST['co3'];
    $c4 = $_POST['co4'];
    $c5 = $_POST['co5'];
    $c6 = $_POST['co6'];

    $sub = $_POST['sub'];

    $q = 'update co set co1 = "' . $c1 . '", co2 = "' . $c2 . '", co3 = "' . $c3 . '", co4 = "' . $c4 . '", co5 = "' . $c5 . '", co6 = "' . $c6 . '" where sub = "' . $sub . '" and dept = "' . $_SESSION['branch'] . '"';
    // echo $q;
    $link->query($q);
    header("Location: display.php");
?>