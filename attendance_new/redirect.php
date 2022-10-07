<?php

    session_start();
    if($_SESSION['period_error'] == 1){
    header("Location: Select_Attendence_for_Adding_attendence.php");
    }
    else{
        header("Location: mark_attendance.php");
    }