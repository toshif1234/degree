<?php
require_once '../config.php';

session_start();

$q = "UPDATE   `assignment_marks" . $_SESSION['assignment_no'] . "` SET `marks_obt`= \"" . $_POST['marks_obt'] . "\" ,`max_marks`=\"" . $_POST['max_marks'] . "\",`fac_name`=\"" . $_SESSION['username'] . "\",`sub_name`=\"" . $_SESSION['sub_name'] . "\" WHERE usn = \"" . $_POST['usn'] . "\" ";

if ($link->query($q)) {
    header("Location: ../assignment/fac_assign_marks_lastpage.php");
 
} else {
       
       echo $q;
   }



?>