<?php
    
    require_once '../config.php';
    session_start();
    $_SESSION['branch'] = $_POST['branch'] ?? '';
$_SESSION['batch'] = $_POST['batch'] ?? '';
header("Location: ../dept_admin/student_view_details.php");
?>