<?php
require_once '../config.php';
$q_no = 'update lab_marks set no_exp = "' . $_POST['no_exp'] . '" where sub = "' . $_POST['sub'] . '"';
    // echo $q_no;
    $link->query($q_no);
    header('Location: lab_marks.php');

?>