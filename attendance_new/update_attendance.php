<?php
include "attendance_average.php";
require_once "../error_display_all.php";
// session_start();
// print_r($_POST['a']);
// print_r($_POST['b']);
require_once "../config.php";
$sub = $_SESSION['sub'];
$sem = $_SESSION['sem'];
$sec = $_SESSION['sec'];
$branch = $_SESSION['branch'];
$att = $_SESSION['att'];
$date = $_SESSION['date'];
// echo $date;
$period = $_SESSION['period'];
$c = explode(' - ', $sub);
$search = $date . ":" . $period . ":0";
$subtype = mysqli_fetch_assoc($link->query('select sub_id from subjects_new where sub_code = "' . $c[0] . '"'))['sub_id'];
if ($subtype == '3') {
    $q = 'select * from attendance_new a, students s where a.sub="' . $sub . '" and a.sem="' . $sem . '" and a.sec="' . $sec . '" and a.branch="' . $branch . '" and s.lab_batch = "' . $_SESSION['lab_batch'] . '" and s.usn = a.usn';
} elseif ($subtype == '1') {
    $q = 'select * from attendance_new a, fac_elec_stud e where a.sub="' . $sub . '" and a.sem="' . $sem . '" and e.faculty_name="' . $_SESSION['username'] . '" and a.usn=e.usn';
} else {
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" order by usn;';
}
$result = $link->query($q);
// echo $q;
$studs = array();
foreach ($result as $r) {
    $studs[] = $r['usn'];
}
$stud_abs = array_diff($studs, $_POST["a"]);
// print_r($stud_abs);

foreach ($stud_abs as $s) {
    $q2 = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $s . '";';
    $result1 = $link->query($q2);
    $r = mysqli_fetch_assoc($result1);
    $p = strstr($r['att'], $att);
    $q = explode(';', $r['att']);
    $p = explode(':', $p);
    if (strstr($r['att'], $search) != false) {
        continue;
    }
    $p[2] = '0';
    $p = implode(':', $p);
    $q[count($q) - 1] = $p;
    $q = implode(';', $q);
    if($subtype == '1'){
        $q_up = 'update attendance_new set att = "' . $q . '" where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $s . '";';
    }
    else{
        $q_up = 'update attendance_new set att = "' . $q . '" where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" and usn = "' . $s . '";';
    }
    // echo $q_up;
    $link->query($q_up);
    calculate_avg($link, $sub, $sem, $branch, $sec, $s);
    // echo $q_avg;
    // echo $q_up . '<br>';
}
if ($_POST['b'] ?? 0) {
    foreach ($_POST['b'] as $b) {
        $q2 = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn = "' . $b . '";';
        $result1 = $link->query($q2);
        $r = mysqli_fetch_assoc($result1);
        // echo $r['att'];
        $p = strstr($r['att'], $search);
        // echo $search;
        $q = explode(';', $r['att']);
        $p = explode(':', $p);

        $p[2] = '1';
        $p = implode(':', $p);
        $q[count($q) - 1] = $p;
        $q = implode(';', $q);
        if($subtype == '1'){
            $q_up = 'update attendance_new set att = "' . $q . '" where sub="' . $sub . '" and sem="' . $sem . '" and usn = "' . $b . '";';
        }
        else{
            $q_up = 'update attendance_new set att = "' . $q . '" where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" and usn = "' . $b . '";';
        }
        $link->query($q_up);
        calculate_avg($link, $sub, $sem, $branch, $sec, $b);
        // echo $q_up;
    }
}


foreach($studs as $usn){
    calculate_avg($link, $sub, $sem, $branch, $sec, $usn);
}

header("Location: mark_attendance.php");
