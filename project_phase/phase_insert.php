<?php
require_once "../config.php";
$con=$link;
session_start();
$branch = $_SESSION["branch"];
    $sec = $_SESSION["sec"];
    $sem = $_SESSION["sem"];
    $sub = $_SESSION["sub"];
// echo $_POST["phase1"];
// echo $_POST["usn"];

$cc = $_POST["cc"];
// print_r($_POST['att']);
$q5="select * from project_phase where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ;";
// echo $q5;
$result1=$link->query($q5);
$c=[];
foreach($result1 as $r1)
{
    $c[]=$r1["usn"];
}
// $b=array_diff($c,$_POST["att"]);
// print_r($b);
// foreach($b as $a){
// $q4="update project_phase set att=0 where  usn = \""  . $a . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ;";
// // echo $a;d
// $link->query($q4);
// // echo $a;
// }
// foreach($_POST["att"] as $d)
// {
//     $q4="update project_phase set att=1 where  usn = \""  . $d . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ;";
//     // echo $q4;
//     $link->query($q4); 
// }
if($sem=="7") {

    for($i = 1; $i <= $cc; $i++){
   
        $vv = array();
        $vv[] = !empty($_POST['phase1' . $i]) ? $_POST['phase1' . $i] : "NULL";
        
        $q="update project_phase set phase1=" . $vv[0]  . " where usn = \""  . $_POST["usn" . $i] . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ";
        $reuslt=$con->query($q);
        // echo $q . "<br>";
    }

}
else if($sem=="8"){

    for($i = 1; $i <= $cc; $i++){

        // $phase_total=($_POST["phase1" . $i]??0)+($_POST["phase2" . $i]??0);
        // echo gettype($_POST['phase3'.$i]);
        $s1=intval($_POST['phase2'.$i]);
        $s2=intval($_POST['phase3'.$i]);
        $phase_total=$s1+$s2;

   
        $vv = array();
        $vv[] = !empty($_POST['phase2' . $i]) ? $_POST['phase2' . $i] : "NULL";
        $vv[] = !empty($_POST['phase3' . $i]) ? $_POST['phase3' . $i] : "NULL";
        
        $q="update project_phase set phase2=" . $vv[0]  . ",phase3=" . $vv[1]  . ",phase_total=" . $phase_total  . " where usn = \""  . $_POST["usn" . $i] . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" ";
        $reuslt=$con->query($q);
        // echo $q . "<br>";
    }
}

header("Location: phase1.php");

// echo '<script>window.location.replace("phase1.php");</script>';

?>