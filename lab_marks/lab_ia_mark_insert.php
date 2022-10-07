<?php
require_once "config1.php";

session_start();
$branch = $_SESSION["branch"];
    $sec = $_SESSION["sec"];
    $sem = $_SESSION["sem"];
    $sub = $_SESSION["sub"];
$r = mysqli_fetch_assoc($con->query('select distinct total_ia from lab_marks where sub = "' . $sub . '"'))['total_ia'];
// echo $_POST["1a"];
// echo $_POST["usn"];
for($i = 1; $i <= $_POST['count']; $i++){
    $ia2 = $_POST["ia2_marks" . $i];
    if($r == 1){
        $ia2 = 0;
    }
$total1 = ($_POST["ia1_mark" . $i]+$ia2);
$ia_avg=ceil($total1/$r);

//$total2 = (($_POST["3a"]+$_POST["3b"]+$_POST["3c"])>($_POST["4a"]+$_POST["4b"]+$_POST["4c"]))?($_POST["3a"]+$_POST["3b"]+$_POST["3c"]):($_POST["4a"]+$_POST["4b"]+$_POST["4c"]);
$q2="update lab_marks set ia1_expno=\"" . $_POST["ia1_expno" . $i]  . "\"
                                ,ia1_mark=\"" . $_POST["ia1_mark" . $i]  . "\"
                                ,ia2_expno=\"" . $_POST["ia2_expno" . $i]  . "\"
                                ,ia2_marks=\"" . $_POST["ia2_marks" . $i]  . "\"
                                
                                

                                ,ia_total=\"" . $total1 . "\"
                                ,ia_avg=\"" . $ia_avg . "\"

                                where usn = \""  . $_POST["usn" . $i] . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
    $result2=$con->query($q2);
}
// echo $q2;
header("Location: lab_marks.php");

?>