<?php

    require_once "../config.php";
    $c = $_POST['count'];
    for($i = 1; $i <= $c; $i++){
        $link->query('update marks set external = "' . $_POST['ext_mark' . $i] . '" where sem = "' . $_POST['sem'] . '" and sec = "' . $_POST['sec'] . '" and sub = "' . $_POST['sub'] . '" and usn = "' . $_POST['usn' . $i] . '"');        
    }
    header("Location: ia_marks1.php");