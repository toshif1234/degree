<?php

    require_once "../config.php";
    include "attendance_average.php";
    include "../error_display_all.php";
    $i = $_POST['i'];
    $iii = $_POST['iii'];
    $usn = $_POST['usn'];
    // print_r($_SESSION['dates']);
    $sem = $_SESSION['sem'];
    $dates = $_SESSION['dates'];
    $sec = $_SESSION['sec'];
    $sub = $_SESSION['sub'];
    $branch = $_SESSION['branch'];
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $usn . '";';
    $result = $link->query($q);
    $r = mysqli_fetch_assoc($result);
    $arr = array();
    for($j=1;$j<=$iii;$j++)
    {
        $arr[] = $_POST['row' . $i . $j] ?? 'off';
    }



    $arr_att = explode(';',$r['att']);

    
    $arr_att_new = array();
    foreach($arr_att as $a){
        $f = explode(':', $a);
        $arr_att_new[] = $f[0] . ':' . $f[1];
    }
    $j = 0;
// print_r($arr_att_new);
    // $result = $link->query($q);
    // $r = mysqli_fetch_assoc($result);
    $entire_date = explode(';', $r['att']);
    foreach($dates as $d){
            // echo gettype($d);
        // echo gettype($arr_att[0]);
        $k = array_search($d, $arr_att_new);
        // echo $k;
        if($arr[$j] == 'on'){
            $up = 1;
        }
        else{
            $up = 0;
        }
        // $new = $d . ':' . $up; 
        $entire_date[$k] =  $d . ':' . $up;
        $j++;
        
    }
    $entire_date = implode(';', $entire_date);
    // echo $entire_date;
    $arr = $entire_date;
    // print_r($arr_att_new);
    // $att = implode(';', $arr_att_new);
$q_up = 'update attendance_new set att = "' . $arr . '" where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $usn . '";';
// echo $q_up;
    $link->query($q_up);
calculate_avg($link, $sub, $sem, $branch, $sec, $usn);
    header("Location: View_or_Edit_Attendence.php");