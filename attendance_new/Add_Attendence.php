<?php


require_once "../config.php";

$branch = $_POST["branch"] ?? $_SESSION['branch'];
$_SESSION['branch'] = $branch;
$sem = $_POST["sem"] ?? $_SESSION['sem'];
$_SESSION['sem'] = $sem;
$sec = $_POST["sec"] ?? $_SESSION['sec'];
$_SESSION['sec'] = $sec;
$sub = $_POST['sub'] ?? $_SESSION['sub_and_id'];
$_SESSION['sub_and_id'] = $sub;
$c = explode(';', $sub);
$sub = $c[0];

$_SESSION['sub'] = $sub;
$date = $_POST["date"] ?? $_SESSION['date'];
$_SESSION['date'] = $date;
$period = $_POST["period"] ?? $_SESSION['period'];
$_SESSION['period'] = $period;
$att = $date . ":" . $period . ":" . "1";
$_SESSION['att'] = $att;
if ($c[1] == '1') {
    $q = 'select * from attendance_new a, fac_elec_stud e where a.sub="' . $sub . '" and a.sem="' . $sem . '" and e.faculty_name="' . $_SESSION['username'] . '" and a.usn=e.usn and e.sub = a.sub';
}
else{
    $q = 'select * from attendance_new where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '";';
}

// echo mysqli_num_rows($result);
// $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] .'"'))['faculty_dept'];
// $subject = explode(' - ',$sub);
// $qt = "select * subjects_new where sub_name = \"" . $subject[0] . "\" and branch=\"" . $fac_branch;
// $result_sub = $link->query($qt);
if ($_SESSION['lab'] == 1) {
    $_SESSION['lab_batch'] = $_POST['lab_batch'];
    $lab_batch = $_SESSION['lab_batch'];
}
if ($_SESSION['lab'] == 1) {
    $num_of_stud_att = mysqli_num_rows($link->query($q));
    $num_of_stud = mysqli_num_rows($link->query("select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\" order by usn;"));
    $count_stud = intval($num_of_stud) - intval($num_of_stud_att);
    // echo $count_stud;
    // echo gettype($count_stud);
    $q = 'select * from attendance_new a, students s where a.sub="' . $sub . '" and a.sem="' . $sem . '" and a.sec="' . $sec . '" and a.branch="' . $branch . '" and s.lab_batch = "' . $_SESSION['lab_batch'] . '" and s.usn = a.usn';
}

$result = $link->query($q);

$flag = 0;

if ((mysqli_num_rows($result) > 0)  && $c[1] != '3') {
    $flag = 1;
}
if(isset($count_stud) && $count_stud == 0){
    $flag = 1;
}
// echo $flag;
if ($flag == 1 && $c[1] != '3') {
    $r = mysqli_fetch_assoc($result);
    if (strstr($r['att'], $att) != false) {
        // echo $flag;
        $_SESSION['period_error'] = 1;
        // echo '<script>window.location.replace("Select_Attendence_for_Adding_attendence.php");</script>';
        // header("Location: Select_Attendence_for_Adding_attendence.php");
        goto label;
    }
}

if ($c[1] == '3' && isset($_SESSION['lab']) && $_SESSION['lab'] == 0) {
    $_SESSION['lab'] = 1;
    header("Location: lab_batch_select.php");
    exit();
}
// echo $flag;



if ($flag == 0) {
    if ($c[1]  == '1') {
        $q1 = "select a.adm_no,a.usn,a.fname,a.mname,a.lname from students a,fac_elec_stud e where a.semester=\"" . $sem . "\" and a.usn = e.usn and e.sub=\"" . $sub . "\" and e.faculty_name=\"" . $_SESSION['username'] . "\" order by a.usn;";
    } elseif ($c[1] == '2') {
        $q1 = "select a.adm_no,a.usn,a.fname,a.mname,a.lname from students a,elective_maping e where a.semester=\"" . $sem . "\" and a.usn = e.usn and a.section = \"" . $sec . "\" and a.branch=\"" . $branch . "\" and e.sub_name=\"" . $sub . "\"  order by a.usn;";
    } elseif ($c[1] == '3') {
        $q1 = "select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\" and lab_batch = \"" . $lab_batch . "\" order by usn;";
    } else {
        $q1 = "select adm_no,usn,fname,mname,lname from students where branch=\"" . $branch . "\" and semester=\"" . $sem . "\" and section=\"" . $sec . "\" order by usn;";
    }
    // echo $q1;
    $result1 = $link->query($q1);
    foreach ($result1 as $r) {
        $q2 = 'INSERT INTO `attendance_new`(`adm_no`, `usn`, `name`, `sem`, `sec`, `branch`, `sub`, `att`) VALUES ("' . $r["adm_no"] . '", "' . $r['usn'] . '", "' . $r['fname'] . ' ' . $r['lname'] . '", "' . $sem . '", "' . $sec . '", "' . $branch . '", "' . $sub . '", "' . $att . '")';
        // echo $q2 . '<br>';
        $link->query($q2);
        $q3 = 'insert into `attendance_average`(`usn`, `sub`, `sem`, `sec`, `branch`) values("' . $r['usn'] . '", "' . $sub . '","' . $sem . '","' . $sec . '","' . $branch . '")';
        $link->query($q3);
    }
} else {
    foreach ($result as $r) {

        $att1 = $r['att'] . ';' . $att;
        // print_r($c);
        if($c[1] == '1'){
            $q2 = 'update attendance_new set att = "' . $att1 . '" where sub="' . $sub . '" and sem="' . $sem . '" and branch="' . $branch . '" and usn="' . $r['usn'] . '";';
        }
        else{
            $q2 = 'update attendance_new set att = "' . $att1 . '" where sub="' . $sub . '" and sem="' . $sem . '" and sec="' . $sec . '" and branch="' . $branch . '" and usn="' . $r['usn'] . '";';
        }
        // echo $q2 . '<br>';
        $link->query($q2);
    }
}
$_SESSION['period_error'] = 0;
label: header("Location: redirect.php");
