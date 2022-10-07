<?php

require_once "../config.php";
include "../error_display_all.php";
$date = $_POST['date'];
$sem = $_SESSION['sem'];
$sec =  $_SESSION['sec'];
$branch = $_SESSION['branch'];
$sub = $_SESSION['sub'];
$c = explode(' - ', $sub);
$subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_code = "' . $c[0] . '"'))['sub_id'];
if ($subtype == '3') {
    $q = 'select * from attendance_new a, students s where a.sub="' . $sub . '" and a.sem="' . $sem . '" and a.sec="' . $sec . '" and a.branch="' . $branch . '" and s.lab_batch = "' . $_SESSION['lab_batch'] . '" and s.usn = a.usn';
} elseif($subtype == '1') {
    $q = 'select * from attendance_new a, fac_elec_stud e where a.sub="' . $sub . '" and a.sem="' . $sem . '" and e.faculty_name="' . $_SESSION['username'] . '" and a.usn=e.usn and e.sub = a.sub';
}

else{
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" order by usn;';
}
$result = $link->query($q);
$r = mysqli_fetch_assoc($result);
$entire_date = explode(';', $r['att']);
foreach ($entire_date as $n) {
    $display_dates[] = explode(':', $n)[0] . ':' . explode(':', $n)[1];
}
$k = array_search($date, $display_dates);
foreach ($result as $r) {
    $entire_date = explode(';', $r['att']);
    unset($entire_date[$k]);
    $arr = implode(';', $entire_date);
    // print_r($arr);
    // echo '<br>';
    $q_up = 'update attendance_new set att = "' . $arr . '" where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $r['usn'] . '";';

    $link->query($q_up);
}
header("Location: View_or_Edit_Attendence.php");
