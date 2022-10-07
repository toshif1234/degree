<?php

require_once "config1.php";
session_start();
$branch = $_POST["branch"];
$sec = $_POST["sec"];
$sem = $_POST["sem"];
$sub = $_POST["sub"];
$q = "select * from students where branch = \"" . $branch . "\" and section = \"" . $sec . "\" and semester = \"" . $sem . "\"" ;
$q4="select * from lab_marks where branch = \"" . $branch . "\" and sec = \"" . $sec . "\" and sem = \"" . $sem . "\" and sub=\"". $sub . "\"" ;
// echo $q;
// echo $q4;
$result = $con->query($q);
$result1=$con->query($q4);

$_SESSION["branch"] = $_POST["branch"];
$_SESSION["sec"] = $_POST["sec"];
$_SESSION["sem"] = $_POST["sem"];
$_SESSION["sub"] = $_POST["sub"];
$sub_code=explode(" - ",$sub);

// print_r($result1);

foreach($result as $r){
    $count=0;
    foreach($result1 as $r1)
    {
        if($r1["adm_no"]==$r["adm_no"])
        {
         $count=1;   
        }
    }
    // echo "<br>";
    if($count==0){
    $q1 = "insert into lab_marks (`adm_no`, `usn`, `name` ,`sec`, `branch`, `sem`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\", \"" . $r["fname"] . "\",  \"" . $sec . "\", \"" . $branch . "\", \"" . $sem . "\",\"" . $sub . "\")";
    // $q2 = "insert into ia_marks2 (`adm_no`, `usn`, `name` ,`sec`, `branch`, `sem`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\", \"" . $r["fname"] . "\",  \"" . $sec . "\", \"" . $branch . "\", \"" . $sem . "\",\"" . $sub . "\")";
    // $q3 = "insert into ia_marks3 (`adm_no`, `usn`, `name` ,`sec`, `branch`, `sem`,`sub`) values ( \"" . $r["adm_no"] .  "\", \"" . $r["usn"] . "\", \"" . $r["fname"] . "\",  \"" . $sec . "\", \"" . $branch . "\", \"" . $sem . "\",\"" . $sub . "\")";
    // echo $q1;
    $con -> query($q1);
    // $con -> query($q2);
    // $con -> query($q3);
    }  
   


   

}
$q2="insert into lab_co_mapping (`subcode`,`dept`) values(\"" . $sub . "\",\"" . $branch . "\");";
// echo $q2;
    $con->query($q2);
header("Location: lab_marks.php");
?>