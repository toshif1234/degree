<?php
require_once '../config.php';
$count = $_POST['count'];

session_start();
$a = 'a' . $_SESSION['assignment_no'];
$qr = "select * from assignment_marks where semester = \"" . $_SESSION['semester'] . "\" and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub_name = \"" . $_SESSION['sub_name'] . "\" and fac_name = \"" . $_SESSION['username'] . "\" order by usn";
for ($i = 1; $i <= $count; $i++) {
    $flag = 0;


    $u = $_POST['usn' . $i];
    $stud_name = $_POST['stud_name' . $i];
    $sem = $_SESSION['semester'];
    $sec = $_SESSION['section'];
    $branch = $_SESSION['branch'];
    $sub_na = $_SESSION['sub_name'];
    $uname = $_SESSION['username'];

    $result1 = $link->query($qr);
    foreach ($result1 as $row) {
        if ($row['usn'] == $u && $row['stud_name'] == $stud_name && $row['semester'] == $sem && $row['section'] == $sec && $row['branch'] == $branch && $row['sub_name'] == $sub_na && $row['fac_name'] == $uname) {
            $flag = 1;
            // echo "inside for loop";
            // echo $row['usn'];
            // echo "<br>";
            break;
        }
    }
    if ($flag) {
        $up = "update assignment_marks set $a = \"" . $_POST['marks_obt' . $i] . "\" where stud_name = \"" . $_POST['stud_name' . $i] . "\" and usn = \"" . $_POST['usn' . $i] . "\" and semester = \"" . $_SESSION['semester'] . "\" and section = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and fac_name = \"" . $_SESSION['username'] . "\" and sub_name = \"" . $_SESSION['sub_name'] . "\" ";

        // echo $up;
        if ($link->query($up)) {

            // header("Location: ../assignment/fac_assign_marks_lastpage.php");
            // echo "success";
        } else {

            // echo "<h1>Updation Failed</h1>";
        }
    } else {


        $q = "insert into assignment_marks(usn,stud_name,semester,section,branch,$a,max_marks,fac_name,sub_name) values( \"" . $_POST['usn' . $i] . "\",\"" . $_POST['stud_name' . $i] . "\",\"" . $_SESSION['semester'] . "\",\"" . $_SESSION['section'] . "\",\"" . $_SESSION['branch'] . "\",\"" . $_POST['marks_obt' . $i] . "\",10,\"" . $_SESSION['username'] . "\",\"" . $_SESSION['sub_name'] . "\")";

        // echo $q;

        if ($link->query($q)) {

            // header("Location: ../assignment/fac_assign_marks_lastpage.php");
            // echo "success";
        } else {

            // echo "<h1>Insertion failed</h1>";
        }
    }
}
//for updating avg marks in marks table

//begin
$q = "select * from assignment_marks where semester = \"" . $_SESSION["semester"] . "\" and section = \"" . $_SESSION["section"] . "\" and branch = \"" . $_SESSION["branch"] . "\" and sub_name = \"" . $_SESSION["sub_name"] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";
// echo $q;
$assign_count = "select * from add_assignment where semester = \"" . $_SESSION["semester"] . "\" and section = \"" . $_SESSION["section"] . "\" and branch = \"" . $_SESSION["branch"] . "\" and sub_name = \"" . $_SESSION["sub_name"] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";

$assinment_avg_in_marks = "select * from marks where  sem = \"" . $_SESSION["semester"] . "\" and sec = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub = \"" . $_SESSION['sub_name'] . "\"";
$av = $link->query($assinment_avg_in_marks);
// echo $assinment_avg_in_marks;
$students_in_marks = array();
foreach ($av as $a) {
    $students_in_marks[] = $a['usn'];
}

$count = 0;
$ac = $link->query($assign_count);
$assignment_numbers = array();
foreach ($ac as $a) {
    $assignment_numbers[] = $a['assignment_no'];
    $count++;
}


$result = $link->query($q);


foreach ($result as $row) {
    if ($count != 0) {

        $avg = ($row['a1'] + $row['a2'] + $row['a3'] + $row['a4'] + $row['a5']) / $count;
        $avg_in_marks = ceil($avg);
        if (in_array($row['usn'], $students_in_marks)) {
            $upd_in_marks = "UPDATE `marks` SET `assignment_avg`= " . $avg_in_marks . " WHERE  usn =\"" . $row['usn'] . "\"  and sem = \"" . $_SESSION['semester'] . "\" and sec = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub = \"" . $_SESSION['sub_name'] . "\"";
            $link->query($upd_in_marks);
        }
    } else {
        if (in_array($row['usn'], $students_in_marks)) {
            $upd_in_marks = "UPDATE `marks` SET `assignment_avg`= " . 0 . " WHERE  usn =\"" . $row['usn'] . "\"  and sem = \"" . $_SESSION['semester'] . "\" and sec = \"" . $_SESSION['section'] . "\" and branch = \"" . $_SESSION['branch'] . "\" and sub = \"" . $_SESSION['sub_name'] . "\"";
            $link->query($upd_in_marks);
        }
    }
}
//end
header("Location: ../assignment/fac_assign_marks_lastpage.php");
