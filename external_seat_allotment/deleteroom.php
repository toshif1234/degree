<?php
session_start();
require_once '../config.php';
// echo $i1=$_POST['ii'];
// if (isset($_POST["del"])) {
//     for($j=1;$j<=$i1;$j++){
//      echo $date1 = $_POST['si'.$j];
//     }
// }
if (isset($_POST['deletedata'])) {
    echo $id = $_POST['delete_id'];
    $r = "delete from exam_rooms where si_no ='$id'";

    $link->query($q);
    if ($link->query($r)) {
       
            $_SESSION['delroom']="Successfully Deleted";    
        
        header("Location: addroom3.php");
    } else {
        echo "<h1>failed</h1>";
    }
}
