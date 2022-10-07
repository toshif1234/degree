<?php
    require_once "../config.php";

    $id = $_POST["id"];
    if(isset($_POST['approve']))
    {
    	$link -> query('update student_medical_leave set status=1 where id=' . $id . '');
    }

    if(isset($_POST['reject']))
    {
    	$link -> query('update student_medical_leave set status=2 where id=' . $id . '');
    }


    header("Location: approvals.php");

?>