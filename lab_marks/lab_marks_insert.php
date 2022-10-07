<?php
require_once "config1.php";
// error_reporting(0);
// session_start();
$branch = $_SESSION["branch"];
    $sec = $_SESSION["sec"];
    $sem = $_SESSION["sem"];
    $sub = $_SESSION["sub"];
$q = 'select distinct no_exp from lab_marks where sub = "' . $sub . '" and branch = "' . $branch . '"';
// echo $_POST["1a"];
// echo $_POST["usn"];
echo $_POST['count'];
$no_exp = mysqli_fetch_assoc($con->query($q))['no_exp'];
for($i = 1; $i <= $_POST['count']; $i++){
    $total1 = 0;
    for($j = 1; $j <= $no_exp; $j++){
        $total1 = $total1 + $_POST['exp' . $j . '-' . $i];
    }

// $total1 = ($_POST["exp1" . $i]+$_POST["exp2" . $i]+$_POST["exp3" . $i]+$_POST["exp4" . $i]+$_POST["exp5" . $i]+$_POST["exp6" . $i]+$_POST["exp7" . $i]+$_POST["exp8" . $i]+$_POST["exp9" . $i]+$_POST["exp10" . $i]+$_POST["exp11" . $i]+$_POST["exp12" . $i]+$_POST["exp13" . $i]+$_POST["exp14" . $i]+$_POST["exp15" . $i]+$_POST["exp16" . $i]);
$avg = ceil($total1/mysqli_fetch_assoc($con->query($q))['no_exp']);
// echo $avg . '<br>';
//$total2 = (($_POST["3a"]+$_POST["3b"]+$_POST["3c"])>($_POST["4a"]+$_POST["4b"]+$_POST["4c"]))?($_POST["3a"]+$_POST["3b"]+$_POST["3c"]):($_POST["4a"]+$_POST["4b"]+$_POST["4c"]);
$q2="update lab_marks set exp1=\"" . $_POST["exp1-" . $i]  . "\"
                                ,exp2=\"" . $_POST["exp2-" . $i]  . "\"
                                ,exp3=\"" . $_POST["exp3-" . $i]  . "\"
                                ,exp4=\"" . $_POST["exp4-" . $i]  . "\"
                                ,exp5=\"" . $_POST["exp5-" . $i]  . "\"
                                ,exp6=\"" . $_POST["exp6-" . $i]  . "\"
                                ,exp7=\"" . $_POST["exp7-" . $i]  . "\"
                                ,exp8=\"" . $_POST["exp8-" . $i]  . "\"
                                ,exp9=\"" . $_POST["exp9-" . $i]  . "\"
                                ,exp10=\"" . $_POST["exp10-" . $i]  . "\"
                                ,exp11=\"" . $_POST["exp11-" . $i]  . "\"
                                ,exp12=\"" . $_POST["exp12-" . $i]  . "\"
                                ,exp13=\"" . $_POST["exp13-" . $i]  . "\"
                                ,exp14=\"" . $_POST["exp14-" . $i]  . "\"
                                ,exp15=\"" . $_POST["exp15-" . $i]  . "\"
                                ,exp16=\"" . $_POST["exp16-" . $i]  . "\"
                                

                                ,exp_total=\"" . $total1 . "\"
                                ,exp_avg = \"" . $avg . "\"
                                where usn = \""  . $_POST["usn" . $i] . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
// echo $_POST['usn' . $i];
                                $result2=$con->query($q2);
// echo $q2; 
// echo '<br>';
}
header("Location: lab_marks.php");

?>