<?php
require_once '../config.php';

// echo $_POST['semester'];
// echo $_POST['section'];
$q_del = "delete from add_assignment where sub_name = \"" . $_POST["sub_name"] . "\" and assignment_no = \"" . $_POST["assignment_no"] . "\" and semester = \"" . $_POST["semester"] . "\"and section = \"" . $_POST["section"] . "\" and branch = \"" . $_POST["branch"] . "\"";
$notification_del = "delete from notification where subject = \"" . $_POST["sub_name"] . "\" and  sem = \"" . $_POST["semester"] . "\"and section = \"" . $_POST["section"] . "\" and branch = \"" . $_POST["branch"] . "\" and assignment_no =  \"" . $_POST["assignment_no"] . "\"";
// echo $q_del;
// $f_n = $_POST['file_name'];
// echo $f_n;
// echo '../upload/assignment'  . $_POST['file_name'];

$assignment_no = "a" . $_POST["assignment_no"];
$marks_update = "update assignment_marks set $assignment_no = 0 where semester = \"" . $_POST["semester"] . "\" and section = \"" . $_POST["section"] . "\" and branch = \"" . $_POST["branch"] . "\" and sub_name = \"" . $_POST["sub_name"] . "\" and fac_name = \"" . $_SESSION['username'] . "\"";

// echo $marks_update;
// echo $notification_del;

if ($link->query($q_del)) {

    $link->query($notification_del);


    if ($link->query($marks_update)) {
        //for updating avg marks in marks table

        //begin
        $q = "select * from assignment_marks where semester = \"" . $_POST["semester"] . "\" and section = \"" . $_POST["section"] . "\" and branch = \"" . $_POST["branch"] . "\" and sub_name = \"" . $_POST["sub_name"] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";
        // echo $q;
        $assign_count = "select * from add_assignment where semester = \"" . $_POST["semester"] . "\" and section = \"" . $_POST["section"] . "\" and branch = \"" . $_POST["branch"] . "\" and sub_name = \"" . $_POST["sub_name"] . "\"  and fac_name = \"" . $_SESSION['username'] . "\"";

        $assinment_avg_in_marks = "select * from marks where  sem = \"" . $_POST["semester"] . "\" and sec = \"" . $_POST['section'] . "\" and branch = \"" . $_POST['branch'] . "\" and sub = \"" . $_POST['sub_name'] . "\"";
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
                    $upd_in_marks = "UPDATE `marks` SET `assignment_avg`= " . $avg_in_marks . " WHERE  usn =\"" . $row['usn'] . "\"  and sem = \"" . $_POST['semester'] . "\" and sec = \"" . $_POST['section'] . "\" and branch = \"" . $_POST['branch'] . "\" and sub = \"" . $_POST['sub_name'] . "\"";
                    $link->query($upd_in_marks);
                }
            } else {
                if (in_array($row['usn'], $students_in_marks)) {
                    $upd_in_marks = "UPDATE `marks` SET `assignment_avg`= " . 0 . " WHERE  usn =\"" . $row['usn'] . "\"  and sem = \"" . $_POST['semester'] . "\" and sec = \"" . $_POST['section'] . "\" and branch = \"" . $_POST['branch'] . "\" and sub = \"" . $_POST['sub_name'] . "\"";
                    $link->query($upd_in_marks);
                }
            }
        }
        //end
        echo "success";
    }

    if (file_exists('../upload/'  . $_POST['file_name'])) {
        unlink('../upload/'  . $_POST['file_name']);
    }

    header("Location: ../assignment/fac_assignment.php");
} else {
    echo $q3;
    echo "<h1>Assignment deletion failed</h1>";
}
