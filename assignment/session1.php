<?php

session_start();
$_SESSION['sub_name'] = $_POST['sub_name'];

// echo $_SESSION['sub_name'];
header("Location: ../assignment/assign_marks.php");
 


?>