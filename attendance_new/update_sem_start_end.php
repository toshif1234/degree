<?php
require_once "../config.php";
// session_start();
    $sem = $_POST['sem'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    
    $q = 'INSERT INTO `sem_start_end`(`sem`, `start`, `end`) VALUES ("' . $sem . '","' . $start . '","' . $end . '");';
    echo $q;
    if($link->query($q)){
        $link->query($q);
    }
    else
    {
        $_SESSION['check_data'] = 1;
    }
    echo $_SESSION['check_data'];
    header("Location: sem_start_end.php");
?>