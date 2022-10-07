<?php

    require_once "../section_creation/config.php";
    session_start();
    $t1 = $_POST['t1'];
    $t2 = $_POST['t2'];
    $t3 = $_POST['t3'];
    $t4 = $_POST['t4'];
    $t5 = $_POST['t5'];
    $t6 = $_POST['t6'];

    $sub = $_POST['sub'];

    $q = 'update co set t1 = "' . $t1 . '", t2 = "' . $t2 . '", t3 = "' . $t3 . '", t4 = "' . $t4 . '", t5 = "' . $t5 . '", t6 = "' . $t6 . '" where sub = "' . $sub . '" and dept = "' . $_SESSION['branch'] . '"';
    $con->query($q);
    // echo $q;
    header("Location: display.php");
?>