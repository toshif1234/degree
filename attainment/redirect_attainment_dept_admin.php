<?php
session_start();
$_SESSION['dept_admin'] = 1;
header("Location: attainment_select.php");
