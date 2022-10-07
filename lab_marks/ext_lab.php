<?php

require_once "../config.php";
$cc2 = $_POST['cc2'];
$sub = $_POST['sub'];

for($i = 1; $i <= $cc2; $i++){
    $q = 'update lab_marks set exam_mark = "' . $_POST['ext' . $i] . '" where sub = "' . $sub . '" and usn = "' . $_POST['usn' . $i] . '"';
    $link->query($q);
}
header("Location: lab_marks.php");