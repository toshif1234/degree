<?php
session_start();
    $_SESSION['dept_admin'] = 1;
    header("Location: lab_parallel_attainment_select.php");