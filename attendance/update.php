<?php 
require_once "config.php";
session_start();
$_SESSION["temp"]=1;
// $q3="select usn from attendance where sem=\"" . $_SESSION["sem"] . "\" and section=\"" . $_SESSION["sec"] . "\"and subject=\"" . $_SESSION["sub"] . "\";";
// $result1=$link->query($q3);
// $a[]=$_POST
$q3="SELECT Column_Name FROM INFORMATION_SCHEMA.COLUMNS WHERE COLUMN_NAME LIKE '%\\_" . $_SESSION["month"] ."\\_%';";
$result2=$link->query($q3);
foreach($result2 as $r2){
    $c[]=$r2["Column_Name"];
    
    }
    print_r($c);
    if(!empty($_POST["column"])){
    print_r($_POST["column"]);
    
    echo "<br>";
    $res1=array_diff($c,$_POST["column"]);
    print_r($res1);
    
    foreach($res1 as $s)
    {
    
            
        
            $q1="update attendance set " . $s . "=0 where usn=\"" . $_POST["usn"] . "\";";
            // echo $q1;
            $link->query($q1);
    }
    foreach($_POST["column"] as $w)
    {
        $q6="update attendance set " . $w . "=1 where usn=\"" . $_POST["usn"] . "\";";
            // echo $q1;
            $link->query($q6);
    }
}
else
{
    foreach($c as $s)
    {
    
            
        
            $q1="update attendance set " . $s . "=0 where usn=\"" . $_POST["usn"] . "\";";
            // echo $q1;
            $link->query($q1);
    } 
}
header("Location: View_or_Edit_Attendence.php")
?>