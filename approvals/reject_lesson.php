<?php
    require_once "../config.php";

    $sub = $_POST["sub"];

    $link -> query('update lesson_plan_approval set status="rejected" where sub="' . $sub . '" and hod = "' . $_SESSION['username'] . '"');
    
    header("Location: approvals.php");

?>