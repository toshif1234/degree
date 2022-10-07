<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
error_reporting(0);
require_once "../config.php";

$link2 = mysqli_connect('localhost', 'archive_archive20212022', 'Hype#123');
$link2->query('use archive20212022');
$tables = $link->query('SHOW TABLES');
$q1 = "SELECT distinct Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%sem%' order by Column_Name;";
$result1 = $link->query($q1);


foreach ($tables as $table) {
    foreach ($result1 as $r1) {

        $q2 = "SELECT * FROM " . $table['Tables_in_erpalvas']  . " where " . $r1['Column_Name'] . "=" . $_POST['sem'] . ";";
        $result = $link->query($q2);
        if (mysqli_num_rows($result) != 0) {
            break;
        }

        if (mysqli_num_rows($result) == 0) {
            $q2 = "SELECT * FROM " . $table['Tables_in_erpalvas'] . ";";
            $result = $link->query($q2);
        }
    }
    // echo $q2;

    $arr = array();
    $res;
    $q3 = "desc " . $table['Tables_in_erpalvas'];
    // echo $q3;
    $result2 = $link->query($q3);
    foreach ($result2 as $row1) {
        array_push($arr, $row1['Field']);
    }
    $arr1 = implode(',', $arr);

    // print_r($arr1);
    foreach ($result as $r4) {
        $arr2 = array();
        for ($i = 0; $i < count($arr); $i++) {
            array_push($arr2, $r4[$arr[$i]]);
        }
        $arr2 = implode('","', $arr2);
        // print_r($arr2);
        $q_insert = 'insert into ' . $table['Tables_in_erpalvas'] . '(' . $arr1 . ') values ("' . $arr2 . '");';
        // echo "<br>";
        // echo $q_insert;
        $link2->query($q_insert);
        // break;
        $link2->query("select * from add_assignment");
    }
    // break;
    //        $q4="INSERT INTO " . $table['Tables_in_erpalvasdev'] . "(" . $row1['Field']) VALUES ('".implode("', '",array_values($row))."')")
    //         mysqli_query($link2,"INSERT INTO " . $table['Tables_in_erpalvasdev'] . " (".implode(", ",array_keys($row)).") VALUES ('".implode("', '",array_values($row))."')");
}
// $tables = $link->query('SHOW TABLES');
// $result1 = $link->query($q1);
// print_r($tables);

$q_fac = 'select * from faculty_mapping f, subjects s where f.sub_name = s.sub_name and s.sem = "' . $_POST['sem'] . '"';
$result_fac = $link->query($q_fac);
foreach ($result_fac as $r_fac) {
    $link->query("delete from faculty_mapping where sub_name = '" . $r_fac['sub_name'] . "' and faculty_name = '" . $r_fac['faculty_name'] . "'");
    try {
        $qq = 'delete from elective_maping where sub_name = "' . $r_fac['sub_code'] . ' - ' . $r_fac['sub_name'] . '"';
        // echo $qq;
        // echo "<br>";
        $link->query($qq);
    } catch (Exception $E) {
    }
}


foreach ($tables as $t) {
    $cc = 0;
    if ($t['Tables_in_erpalvas'] == 'students' || $t['Tables_in_erpalvas'] == 'users' || $t['Tables_in_erpalvas'] == 'sslc_details' || $t['Tables_in_erpalvas'] == 'puc_details' || $t['Tables_in_erpalvas'] == 'parents_details' || $t['Tables_in_erpalvas'] == 'hod' || $t['Tables_in_erpalvas'] == 'faculty_workshop_details' || $t['Tables_in_erpalvas'] == 'faculty_ppr_details' || $t['Tables_in_erpalvas'] == 'faculty_details' || $t['Tables_in_erpalvas'] == 'display_pic' || $t['Tables_in_erpalvas'] == 'dept_pso' || $t['Tables_in_erpalvas'] == 'targets' || $t['Tables_in_erpalvas'] == 'co_po' || $t['Tables_in_erpalvas'] == 'co_pso') {
        continue;
    }
    foreach ($result1 as $r1) {
        $q2 = "delete FROM " . $t['Tables_in_erpalvas']  . " where " . $r1['Column_Name'] . "=" . $_POST['sem'] . ";";
        try {
            $link->query($q2);
        } catch (Exception $th) {
            $cc++;
        }
        if ($cc == 2) {
            $q2 = "delete FROM " . $t['Tables_in_erpalvas'] . ";";
            $link->query($q2);
        }
    }
}
$q_co_po = 'select distinct sub, faculty_id from co_po group by faculty_id';
$q_co_pso = 'select distinct sub, faculty_id from co_pso group by faculty_id';
$result_co_po = $link->query($q_co_po);
$result_co_pso = $link->query($q_co_pso);

foreach ($result_co_po as $r) {
    $flag_co_po = 0;
    $sub = explode(' - ', $r['sub']);
    if (is_numeric($sub[0][4]) == 1) {
        if ($_POST['sem'] == $sub[0][4]) {
            $flag_co_po = 1;
        }
    } else {
        if ($_POST['sem'] == $sub[0][5]) {
            $flag_co_po = 1;
        }
    }
    if ($flag_co_po == 1) {
        $link->query('delete from co_po where faculty_id = "' . $r['faculty_id'] . '"');
    }
}
foreach ($result_co_pso as $r) {
    $flag_co_pso = 0;
    $sub = explode(' - ', $r['sub']);
    if (is_numeric($sub[0][4]) == 1) {
        if ($_POST['sem'] == $sub[0][4]) {
            $flag_co_pso = 1;
        }
    } else {
        if ($_POST['sem'] == $sub[0][5]) {
            $flag_co_pso = 1;
        }
    }
    if ($flag_co_pso == 1) {
        $link->query('delete from co_pso where faculty_id = "' . $r['faculty_id'] . '"');
    }
}
// foreach($tables as $t)
// {

// }
header("Location: archive.php");
