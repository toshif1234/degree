<?php

require_once "../config.php";
session_start();
// include "../template/fac-auth.php";
// include "../template/sidebar-fac.php";
$a = $_POST['semester'];
$_SESSION['feedback_name'] = $_POST['feedback_name'];
$_SESSION['from_date'] = $_POST['from_date'];
$_SESSION['to_date'] = $_POST['to_date'];
// echo $_POST['semester'];
$q_not = 'select sem from feedback_notification where feedback_name="' . $_SESSION['feedback_name'] . '"';
echo $q_not;
$e_qnot = $link->query($q_not);
$arr = array();
$arr1 = array();
$i = 0;
if (mysqli_num_rows($e_qnot)) {
    foreach ($e_qnot as $r) {
        print_r($r);
        foreach ($r as $s) {
            $arr[$i] = $s;
            $i++;
        }
    }
}
// echo "felo";
// print_r($arr);
// echo "felo";

$i = 0;

// $k=;
// echo $k;
// echo "hh";
if (in_array($a[0], $arr)) {
    // $arr1[$i++]=$t;
    $_SESSION['flag'] = 1;
    $_SESSION['repsem'] = $a[0];
} else {

    // $a=array_diff($a,$arr1);

    $q_dept = 'select faculty_dept from faculty_details where faculty_name="' . $_SESSION['username'] . '"';
    $r_dept = mysqli_fetch_assoc($link->query($q_dept));
    // $a=join(",",$arr);
    // $arr1=join(",",$arr1);
    $req = 'select max(id) from feedback_notification';
    $e_req = $link->query($req);
    // $id=$e_req;
    if (empty($e_req)) {
        $id = 0;
    } else {

        $id = mysqli_fetch_assoc($e_req)['max(id)'];
    }
    // if(!empty($a))
    // {
    print_r($a);
    $q = 'insert into feedback_notification values("' . ($id + 1) . '","' . $_SESSION['feedback_name'] . '","' . ($a[0]) . '","' . $r_dept['faculty_dept'] . '" , "yes","' . $_SESSION['from_date'] . '","' . $_SESSION['to_date'] . '" )';
    echo $q;
    $link->query($q);

    // }
}

// $r='select * from feedback_all where feedback_name="'.$_SESSION['feedback_name'].'" and sem="'.$_SESSION['sem'].'" and 
header('Location: enable.php');
