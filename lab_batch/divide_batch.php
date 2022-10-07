<?php
session_start();
require_once("../config.php");

$_SESSION["sec"] = $_POST["sec"];
$_SESSION["branch"] = $_POST["branch"];
$_SESSION["batch"] = $_POST["batch"];
$no_of_div = $_POST["no_of_div"];
// echo $no_of_div;

$q1 = 'select * from students where section = "' . $_SESSION["sec"] . '" and branch = "' . $_SESSION["branch"] . '" and batch = "' . $_SESSION["batch"] . '" order by usn';
$result = $link->query($q1);
$count = mysqli_num_rows($result);
// echo $q1;
$val = floor($count/$no_of_div);
for($i=0;$i<$no_of_div;$i++)
        {
            // echo "we";
            $next = "1";
            for($j=0;$j<$val;$j++)
            {
                $res2 = $result -> fetch_assoc();
                $q1="update students set lab_batch=\"batch " . chr(ord($next) + $i)  . "\" where adm_no=\"" . $res2["adm_no"] . "\"";
                // echo $q1;
                $res3=$link->query($q1);
                // header("Location: batch_creation.php");
            }


        }
        header("Location:batch_create.php");
;

?>