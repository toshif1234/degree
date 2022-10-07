<?php
require_once "config1.php";

session_start();
$branch = $_SESSION["branch"];
    $sec = $_SESSION["sec"];
    $sem = $_SESSION["sem"];
    $sub = $_SESSION["sub"];
// echo $_POST["1a"];
// echo $_POST["usn"];
$cc = $_POST["cc2"];
$q_elec = 'select * from subjects_new where sub_name = "' . explode(' - ', $sub)[1] . '"';
$open = mysqli_fetch_assoc($link->query($q_elec))['sub_id'];
if($open == '1'){
    $q5 = 'select * from ia_marks1 a, fac_elec_stud f where a.sem="' . $sem . '" and f.usn=a.usn and f.sub="' . $sub . '" and f.faculty_name="' . $_SESSION['username'] . '";';
}
else{
$q5="select * from ia_marks1 where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\";";
}
$result1=$link->query($q5);
$c=[];
foreach($result1 as $r1)
{
    $c[]=$r1["usn"];
}
$b=array_diff($c,$_POST["att"]);
// print_r($b);
foreach($b as $a){
$q4="update ia_marks3 set att=0 where  usn = \""  . $a . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\";";
// echo $a;d
$link->query($q4);
// echo $a;
}
foreach($_POST["att"] as $d)
{
    $q4="update ia_marks3 set att=1 where  usn = \""  . $d . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\";";
    // echo $q4;
    $link->query($q4); 
}
for($i = 1; $i <= $cc; $i++){
    $total1 = ((intval($_POST["1a" . $i] ?? 0)) + (intval($_POST["1b" . $i] ?? 0)) + (intval($_POST["1c" . $i] ?? 0))) > ((intval($_POST["2a" . $i] ?? 0)) + (intval($_POST["2b" . $i] ?? 0)) + (intval($_POST["2c" . $i] ?? 0))) ? ((intval($_POST["1a" . $i] ?? 0)) + (intval($_POST["1b" . $i] ?? 0)) + (intval($_POST["1c" . $i] ?? 0))) : ((intval($_POST["2a" . $i] ?? 0)) + (intval($_POST["2b" . $i] ?? 0)) + (intval($_POST["2c" . $i] ?? 0)));

    $total2 = ((intval($_POST["3a" . $i] ?? 0)) + (intval($_POST["3b" . $i] ?? 0)) + (intval($_POST["3c" . $i] ?? 0))) > ((intval($_POST["4a" . $i] ?? 0)) + (intval($_POST["4b" . $i] ?? 0)) + (intval($_POST["4c" . $i] ?? 0))) ? ((intval($_POST["3a" . $i] ?? 0)) + (intval($_POST["3b" . $i] ?? 0)) + (intval($_POST["3c" . $i] ?? 0))) : ((intval($_POST["4a" . $i] ?? 0)) + (intval($_POST["4b" . $i] ?? 0)) + (intval($_POST["4c" . $i] ?? 0)));
    $vv = array();
    $vv[] = !empty($_POST['1a' . $i]) ? $_POST['1a' . $i] : "NULL";
    $vv[] = !empty($_POST['1b' . $i]) ? $_POST['1b' . $i] : "NULL";
    $vv[] = !empty($_POST['1c' . $i]) ? $_POST['1c' . $i] : "NULL";
    
    $vv[] = !empty($_POST['2a' . $i]) ? $_POST['2a' . $i] : "NULL";
    $vv[] = !empty($_POST['2b' . $i]) ? $_POST['2b' . $i] : "NULL";
    $vv[] = !empty($_POST['2c' . $i]) ? $_POST['2c' . $i] : "NULL";
    
    $vv[] = !empty($_POST['3a' . $i]) ? $_POST['3a' . $i] : "NULL";
    $vv[] = !empty($_POST['3b' . $i]) ? $_POST['3b' . $i] : "NULL";
    $vv[] = !empty($_POST['3c' . $i]) ? $_POST['3c' . $i] : "NULL";
    
    $vv[] = !empty($_POST['4a' . $i]) ? $_POST['4a' . $i] : "NULL";
    $vv[] = !empty($_POST['4b' . $i]) ? $_POST['4b' . $i] : "NULL";
    $vv[] = !empty($_POST['4c' . $i]) ? $_POST['4c' . $i] : "NULL";
    $q="update ia_marks3 set 1a=" . $vv[0]  . "
                                    ,1b=" . $vv[1]  . "
                                    ,1c=" . $vv[2]  . "
                                    ,2a=" . $vv[3]  . "
                                    ,2b=" . $vv[4]  . "
                                    ,2c=" . $vv[5]  . "
                                    ,3a=" . $vv[6]  . "
                                    ,3b=" . $vv[7]  . "
                                    ,3c=" . $vv[8]  . "
                                    ,4a=" . $vv[9]  . "
                                    ,4b=" . $vv[10]  . "
                                    ,4c=" . $vv[11]  . "
                                    ,total3=" . ($total1+$total2) . "
                                    where usn = \""  . $_POST["usn" . $i] . "\" and branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub = \"" . $sub . "\"";
    $reuslt=$con->query($q);
    // echo $q . "<br>";
}

header("Location: ia_marks1.php");

?>