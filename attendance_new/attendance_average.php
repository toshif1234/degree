<?php
function calculate_avg($link, $sub, $sem, $branch, $sec, $usn)
{
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn="' . $usn .'";';
    $result = $link->query($q);
    $r = mysqli_fetch_assoc($result);
    $q = explode(';', $r['att']);
    $num_of_classes = count($q);
    $num_of_attended = 0;
    // echo $num_of_classes;
    foreach($q as $n){
        $p = explode(':', $n);
        if($p[2] == 1){
            $num_of_attended++;
        }
    }
    // echo $num_of_attended;
    $avg = round($num_of_attended/$num_of_classes, 2) * 100;
    $q_avg = 'update attendance_average set att_avg = "' . $avg . '" where usn = "' . $usn . '" and sub = "' . $sub . '";';
    $link->query($q_avg);
    // echo $q_avg;
}