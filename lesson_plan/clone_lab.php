<?php
require_once "../config.php";
session_start();

$q = 'select * from lessonpanl where subid = "' . $_SESSION['sub'] . '" and sem = "' . $_SESSION['sem'] . '" and section = "' . $_SESSION['sec'] . '" and branch = "' . $_POST['branch'] . '"';
$result = $link->query($q);
// echo $q;
$q2 = 'select * from lessonpanl where subid = "' . $_SESSION['sub'] . '" and sem = "' . $_SESSION['sem'] . '" and section = "' . $_POST['sec'] . '" and branch = "' . $_POST['branch'] . '" order by sr_no';
$result2 = $link->query($q2);
$sr_no = mysqli_fetch_assoc($link->query('select max(sr_no) from lessonpanl'))['max(sr_no)'];
if (mysqli_num_rows($result2) > 0) {
    foreach ($result as $r) {
        $r2 = mysqli_fetch_assoc($result2);
        $link->query('update lessonpanl set module = "' . $r['module'] . '", dop_Plan = "' . $r['dop_Plan'] . '", pending = "' . $r['pending'] . '", textbook = "' . $r['textbook'] . '", co = "' . $r['co'] . '", bt_evel = "' . $r['bt_evel'] . '", dop_exe = "' . $r['dop_exe'] . '", complet = "' . $r['complet'] . '", vtu_textbook = "' . $r['vtu_textbook'] . '", vtu_co = "' . $r['vtu_co'] . '" where sr_no = "' . $r2['sr_no'] . '"');
    }
} else {
    foreach ($result as $r) {
        $sr_no++;
        $q1 = 'insert into lessonpanl(sr_no, sem, subid, section, module, dop_Plan, pending, textbook, co, bt_evel, dop_exe, complet, vtu_textbook, vtu_co, branch) values ("' . $sr_no . '", "' . $r['sem'] . '","' . $r['subid'] . '","' . $_POST['sec'] . '","' . $r['module'] . '","' . $r['dop_Plan'] . '","' . $r['pending'] . '","' . $r['textbook'] . '","' . $r['co'] . '","' . $r['bt_evel'] . '","' . $r['dop_exe'] . '","' . $r['complet'] . '","' . $r['vtu_textbook'] . '","' . $r['vtu_co'] . '","' . $_POST['branch'] . '")';
        $link->query($q1);
    }
}
$_SESSION["sec"] = $_POST["sec"];
header("Location: display_lab.php");
