<?php
    require_once "../config.php";
session_start();
    $sub = $_POST["sub"];

    $link -> query('update co_po set approval="approved" where sub="' . $sub . '" and to_hod = "' . $_SESSION['username'] . '"');

    header("Location: approvals.php");

?>