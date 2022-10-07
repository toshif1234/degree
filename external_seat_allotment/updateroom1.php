<?php

require_once "../config.php";
include "../template/fac-auth.php";
 include "../template/sidebar-fac.php";
//error_reporting(0);
   $roid=$_SESSION['si'];

   // echo "$roid";
    $rona=$_POST['sub_name2'];
    $rosr=$_POST['sub_name3'];
    $brna=$_POST['sub_name4'];
    $brnd=$_POST['sub_name5'];
    $brnc=$_POST['sub_name6'];
    $q="update exam_rooms set room_number='$rona', room_desk='$rosr', std_count='$brna' , block='$brnd' , floor='$brnc' where si_no='$roid'";
    $res=$link->query($q);
    if($res)
    {
        $_SESSION['updateroom']="Successfully Updated";
        
    }
    //header("Location: addroom3.php");

    // if($res)
    // {
    //     echo "<script> alert('Record Updated')</script>";
    // }
    // else
    // {
    //     echo "<style color:'red';> Failed to Update</style>";
    // }

//header("Location: addroom3.php");





?>

<script>
    window.location.href='addroom3.php';
</script>

<?php
include "../template/footer-fac.php";
?>