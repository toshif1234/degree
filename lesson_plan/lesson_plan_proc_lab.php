<?php

require_once "../config.php";
$_SESSION['sem'] = $_POST["sem"];
$sem = $_POST["sem"];
$_SESSION['sec'] = $_POST["sec"];
$sec = $_POST["sec"];
$_SESSION['branch'] = $_POST["branch"];
$branch = $_POST["branch"];
$_SESSION['sub'] = $_POST["sub"];
$sub = $_POST["sub"];
$_SESSION['noe'] = $_POST['no_exp'];
$noe = $_POST['no_exp'];



$q_id = 'select * from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';
$fac_id = mysqli_fetch_assoc($link->query($q_id))['faculty_id'];
// $_SESSION['fac_id']

$c = 'select count(*) as c from lessonpanl where sem="' . $_POST['sem'] . '" and section="' . $_POST['sec'] . '" and subid = "' . $_POST['sub'] . '" and branch = "' . $_POST['branch'] . '"';
$res1 = mysqli_fetch_assoc($link->query($c));

if ($res1['c'] == 0) {
    for($i = 1; $i <= $noe; $i++){
        $q = 'insert into lessonpanl(`branch`, `sem`, `subid`, `section`,`module`) values("' . $branch . '","' . $sem . '","' . $sub . '","' . $sec . '","' . $i . '");';
        $result = $link->query($q);
    }
    $link->query('insert into co values("' . $fac_id . '", "' . $sub . '", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0", "0","' . $branch . '")');
}
header("Location: display_lab.php");