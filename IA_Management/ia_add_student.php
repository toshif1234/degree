<?php

require_once "config1.php";
// session_start();
$branch = $_POST["branch"] ?? 0;
$sec = $_POST["sec"] ?? 0;
$sem = $_POST["sem"];
$sub = $_POST["sub"];
$c = explode("-", $sub);
$a = $c[0];

$z = preg_split("/[A-Za-z]*/", $a);
// echo $z[4];
$m = $z[4];
if ($m == $sem) {
    $sub_only = explode('- ', $sub);
    //   print_r($sub_only);
    $p_sub = $sub_only[0];
    // echo $p_sub;
    $p_subject = substr($p_sub, 2, -3);
    // echo $p_subject;
    $p_subcode = "CSP";
    if (strpos($p_sub, $p_subcode) != false) {
        $_SESSION["branch"] = $_POST["branch"];
        $_SESSION["sec"] = $_POST["sec"];
        $_SESSION["sem"] = $_POST["sem"];
        $_SESSION["sub"] = $_POST["sub"];

        // project phase
        // echo "Project Phase";

        $q = "select * from students where branch = \"" . $branch . "\" and section = \"" . $sec . "\" and semester = \"" . $sem . "\"";
        $result = $con->query($q);
        $q4 = "select * from project_phase where branch =\"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ";
        // print_r(($result));
        $result1 = $con->query($q4);
        $count = 0;
        foreach ($result as $r) {
            // print_r($r);
            // foreach($result1 as $r1)
            // {
            if (mysqli_num_rows($result1) >= 1) {
                $count = 1;
            }
            // }
            // echo "<br>";
            if ($count == 0) {
                $q1 = "insert into project_phase(`adm_no`,`usn`,`name`,`branch`,`sem`,`sec`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\", \"" . $r["fname"] . "\",  \"" . $branch . "\", \"" . $sem . "\", \"" . $sec . "\")";

                // echo $q1 . '<br>';
                // echo $q2 . '<br>';
                // echo $q3 . '<br>';
                // echo '<br><br>';



                $x = $con->query($q1);
            }
            header("Location: ../project_phase/phase1.php");

            // echo '<script>window.location.replace("../project_phase/phase1.php");</script>';
        }
    } else {

        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
            $q_e = 'select * from subjects where sub_name ="' . $sub_only[1] . '" and branch = "' . $branch . '"';
        } else {
            $q_e = 'select * from subjects_new where sub_name ="' . $sub_only[1] . '"';
        }
        $result_e = $con->query($q_e);
        // echo $q_e;
        if(mysqli_num_rows($result_e) > 1){
            $q_e = 'select * from subjects_new where sub_name ="' . $sub_only[1] . '" and branch = "' . $branch . '"';
            $result_e = $con->query($q_e);
        }
        // echo $q_e;
        $r_e = mysqli_fetch_assoc($result_e);

        if ($r_e['sub_id'] == '0') {
            $q = "select * from students where branch = \"" . $branch . "\" and section = \"" . $sec . "\" and semester = \"" . $sem . "\"";
        }elseif($r_e['sub_id'] == '2'){
            $q = "select * from students s, elective_maping e where s.branch =\"" . $branch . "\" and s.semester = \"" . $sem . "\" and s.usn = e.usn and e.sub_name = \"" . $sub . "\" and section=\"" . $sec . "\"";
        } 
        elseif($r_e['sub_id'] == '1') {
            $open = 1;
            $q = "select * from students s, fac_elec_stud e where s.semester = \"" . $sem . "\" and s.usn = e.usn and e.sub = \"" . $sub . "\" and e.faculty_name = \"" . $_SESSION['username'] . "\"";
        }
        
        

        // echo $q;
        $_SESSION["branch"] = $_POST["branch"] ?? 0;
        $_SESSION["sec"] = $_POST["sec"] ?? 0;
        $_SESSION["sem"] = $_POST["sem"];
        $_SESSION["sub"] = $_POST["sub"];
        if(isset($open)){
            $q4 = "select * from ia_marks1 i, fac_elec_stud f where i.sub = \"" . $sub . "\" and i.usn = f.usn and f.faculty_name = '" . $_SESSION['username'] . "'";
        }
        else{
            $q4 = "select * from ia_marks1 where branch =\"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
        }
        // echo $q4;
        // echo $q;
        $result = $con->query($q);
        $result1 = $con->query($q4);



        // echo mysqli_num_rows($result);
        // print_r($result1);

        $count = 0;
        foreach ($result as $r) {
            // print_r($r);
            // foreach($result1 as $r1)
            // {
            if (mysqli_num_rows($result1) >= 1) {
                $count = 1;
            }
            // }
            // echo "<br>";
            if ($count == 0) {
                if(isset($open)){
                    $branch = $r['branch'];
                }
                $q1 = "insert into ia_marks1(`adm_no`,`usn`,`name`,`branch`,`sem`,`sec`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\",  \"" . ucfirst(strtolower($r["fname"])) . " " . ucfirst(strtolower($r["mname"])) . " " . ucfirst(strtolower($r["lname"])) . "\",  \"" . $branch . "\", \"" . $sem . "\", \"" . $sec . "\",\"" . $sub . "\")";
                $q2 = "insert into ia_marks2(`adm_no`,`usn`,`name`,`branch`,`sem`,`sec`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\",  \"" . ucfirst(strtolower($r["fname"])) . " " . ucfirst(strtolower($r["mname"])) . " " . ucfirst(strtolower($r["lname"])) . "\",  \"" . $branch . "\", \"" . $sem . "\", \"" . $sec . "\",\"" . $sub . "\")";
                $q3 = "insert into ia_marks3(`adm_no`,`usn`,`name`,`branch`,`sem`,`sec`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\",  \"" . ucfirst(strtolower($r["fname"])) . " " . ucfirst(strtolower($r["mname"])) . " " . ucfirst(strtolower($r["lname"])) . "\",  \"" . $branch . "\", \"" . $sem . "\", \"" . $sec . "\",\"" . $sub . "\")";
                $q4 = "insert into marks( `usn`, `name`, `branch`, `sem`, `sec`, `sub`,`att_avg`) values ( \"" . $r["usn"] . "\", \"" . ucfirst(strtolower($r["fname"])) . " " . ucfirst(strtolower($r["mname"])) . " " . ucfirst(strtolower($r["lname"])) . "\",  \"" . $branch . "\", \"" . $sem . "\", \"" . $sec . "\",\"" . $sub . "\", 0)";
                // echo $q1 . '<br>';
                // echo $q2 . '<br>';
                // echo $q3 . '<br>';
                // echo '<br><br>';

                $con->query($q1);
                $con->query($q2);
                $con->query($q3);
                $con->query($q4);
            }
        }
        header("Location: ia_marks1.php");
    }
} else {
    $_SESSION["check_error"] = 1;
    header("Location: ia_marks.php");
}
