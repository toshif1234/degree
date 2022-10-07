<?php 
session_start();
require_once "config.php";
 $qdel="select usn from attendance where branch=\"" . $_POST["branch"] . "\" and sem=\"" . $_POST["sem"] . "\" and section=\"" . $_POST["sec"] . "\" and subject=\"" . $_POST["sub"] . "\"";
//  echo $qdel;
 $result=$link->query($qdel);
 foreach($result as $r)
 {
     $q="update attendance set " . $_POST["column_name"] . "=NULL where usn=\"" . $r["usn"] . "\" and subject=\"" . $_POST["sub"] . "\"";
     $result2=$link->query($q);
    //  echo $q;
 }
 $_SESSION["temp"]=1;
header("Location: View_or_Edit_Attendence.php")

?>