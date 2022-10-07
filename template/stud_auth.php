<?php
// session_start();
require_once "../config.php";
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // echo 'in';
    
    header("location: ../index.php");
    // exit;
    
}



?>