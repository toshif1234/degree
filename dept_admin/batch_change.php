<?php 
session_start();
require_once "config.php";
$val = 99999;
        $branch = $_SESSION["branch"];
        $batch = $_SESSION["batch"];    
    $q="select * from students where branch=\"" . $branch . "\" and batch =\"" . $batch . "\" order by usn"; 
    // echo $q;
    $result=$con->query($q);
    
        $count_rows = mysqli_num_rows($result);
        $division = $_POST["division"];
        $val = floor($count_rows/$division);
        
        for($i=0;$i<$division;$i++)
        {
            $next = "A";
            for($j=0;$j<$val;$j++)
            {
                $res2 = $result -> fetch_assoc();
                $q1="update students set section=\"" . chr(ord($next) + $i)  . "\" where adm_no=\"" . $res2["adm_no"] . "\"";
                // echo $q1;
                $res3=$con->query($q1);
                
            }


        }
        
    
    header("Location: batch_creation.php");


?>