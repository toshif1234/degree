<?php
    session_start();
    $_SESSION['dept'] = $_POST["branch"] ?? "";
    echo $_SESSION['dept'];
    header("Location: faculty_view_details.php");

?>