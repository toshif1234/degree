<?php   
    require_once "../config.php";
    $set_target = $_POST['set_target'];
    $f_percentage = $_POST['formate_percent'];
    $summative_percent = $_POST['summative_percent'];
    $direct = $_POST['direct'];
    $indirect = $_POST['indirect'];
    $l1 = $_POST['l1'];
    $l2 = $_POST['l2'];
    $l3 = $_POST['l3'];
    $summative_max_marks = $_POST['summative_max_marks'];
    $batch = $_POST['batch'];
    $dept = $_POST['dept'];

    $q = 'select * from targets where dept = "' . $dept . '" and batch = "' . $batch . '"';
    if(mysqli_num_rows($link->query($q)) > 0){
        $q2 = "UPDATE `targets` SET `set_target`=$set_target,`f_percentage`=$f_percentage,`s_percentage`=$summative_percent,`direct`=$direct,`indirect`=$indirect,`l1`=$l1,`l2`=$l2,`l3`=$l3,`s_max`=$summative_max_marks WHERE 1";
        $link->query($q2);
    }
    else{
        $q2 = "INSERT INTO `targets`(`dept`, `set_target`, `f_percentage`, `s_percentage`, `direct`, `indirect`, `l1`, `l2`, `l3`, `s_max`, `batch`) VALUES ('$dept',$set_target,$f_percentage,$summative_percent,$direct,$indirect,$l1,$l2,$l3,$summative_max_marks,$batch)";
        $link->query($q2);
    }
    header("Location: attainment_target.php");
