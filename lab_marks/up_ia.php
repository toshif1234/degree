<?php

require_once '../config.php';
$q_no = 'update lab_marks set total_ia = "' . $_POST['total_ia'] . '" where sub = "' . $_POST['sub'] . '"';
    // echo $q_no;
    $link->query($q_no);
    header('Location: lab_marks.php');