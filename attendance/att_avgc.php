<?php
    require_once "config.php";
    session_start();
    // echo $_SESSION["branch"];
    
    $date1=str_replace("-","_",$_POST["startdate"]);
    $date2=str_replace("-","_",$_POST["enddate"]);
    $q="SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME BETWEEN '" . $date1 . "' and '" . $date2 . "'";
    // echo $q;
    $f = [];
    $c=0;
    $result=$link->query($q);
    foreach($result as $r){
    $q1="select " . $r["Column_Name"] . " from attendance where " . $r["Column_Name"] . " is null and branch='" . $_SESSION["branch"] . "' and sem=" . $_SESSION["sem"] . " and section='" . $_SESSION["sec"] . "' and subject='" . $_SESSION["sub"] . "';";
    // echo $q1;
    
    $st=implode($r);
    $rr=explode("_",$st);
    // print_r($rr);
    // echo $_SESSION["month"];
    if($rr[1]==$_SESSION["month"]){
    
    $result1=$link->query($q1);
    if(!mysqli_num_rows($result1)){
        $c++;
        $f[]=$r["Column_Name"];
    }
}
}
$q3 = "select * from attendance where branch=\"" . $_SESSION["branch"] . "\" and sem=\"" . $_SESSION["sem"] . "\" and section=\"" . $_SESSION["sec"] . "\" and subject=\"" . $_SESSION["sub"] . "\" order by usn;";
 $result3=$link->query($q3);
//  echo $q3;
$q6 = "select * from marks where branch=\"" . $_SESSION["branch"] . "\" and sem=\"" . $_SESSION["sem"] . "\" and sec=\"" . $_SESSION["sec"] . "\" and sub=\"" . $_SESSION["sub"] . "\" order by usn;";
$result5=$link->query($q6);  
foreach($result3 as $r3){           
// print_r($f);
if(!mysqli_num_rows($result5)){
$q5="insert into marks(`usn`, `name`, `branch`, `sem`, `sec`, `sub`,`att_avg`) values ( \"" . $r3["usn"] . "\", \"" . $r3["name"] . "\",  \"" . $_SESSION["branch"] . "\", \"" . $_SESSION["sem"] . "\", \"" . $_SESSION["sec"] . "\",\"" . $_SESSION["sub"] . "\", 0)";
$link->query($q5);
}
$c1=0;
foreach($f as $v){
    $q2 = "select " . $v . " from attendance where branch=\"" . $_SESSION["branch"] . "\" and sem=\"" . $_SESSION["sem"] . "\" and section=\"" . $_SESSION["sec"] . "\" and subject=\"" . $_SESSION["sub"] . "\" and usn=\"" . $r3["usn"] . "\";"; 
    // echo $q2;
    $result4=$link->query($q2);
    if(mysqli_fetch_assoc($result4)["$v"]==1)
    {
        $c1++;
    }

 }
 $q4="update marks set att_avg=" . (($c1/$c)*100) . " where branch=\"" . $_SESSION["branch"] . "\" and sem=\"" . $_SESSION["sem"] . "\" and sec=\"" . $_SESSION["sec"] . "\" and sub=\"" . $_SESSION["sub"] . "\" and usn=\"" . $r3["usn"] . "\";"; 
//  echo $q4;
//  echo $c;
//  echo $r3["usn"];
//  echo $c1;
//  echo "<br>";
$link->query($q4);
}
header("Location: Select Attendence_for_viewingattendence.php");
    

?>