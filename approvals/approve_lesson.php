<?php
    require_once "../config.php";
    session_start();
    $sub = $_POST["sub"];

    $link -> query('update lesson_plan_approval set status="approved" where sub="' . $sub . '" and hod="' . $_SESSION['username'] . '"');
    // echo 'update lesson_plan_approval set status="approved" where sub="' . $sub . '" and hod="' . $_SESSION['username'] . '"';
    header("Location: approvals.php");

?>