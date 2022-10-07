<?php
    session_start();
    $_SESSION['is_archive'] = 0;
header("Location: ../dashboard/fac_dashboard.php");  