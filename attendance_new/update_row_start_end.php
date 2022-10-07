<?php

    require_once "../config.php";
    $sem = $_POST['sem'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    $link->query('update sem_start_end set start = "' . $start . '", end = "' . $end . '" where sem = "' . $sem . '"');
    // echo 'update sem_start_end set start = "' . $start . '", end = "' . $end . '" where sem = "' . $sem . '"';
    header("Location: sem_start_end.php");