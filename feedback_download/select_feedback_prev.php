<?php

session_start();
$_SESSION['down'] = 1;

header("Location: select_feedback.php");