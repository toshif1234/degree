<?php
require_once "../config.php";
session_start();
 $si=$_SESSION['si']; //primary key for update
echo $us=$_POST['sub_name1'];
echo $ps=$_POST['sub_name2'];
echo $br=$_SESSION['branch'];
echo $sem=$_SESSION['semester'];
echo $sub = $_POST['subject'];
$r = "update  exam_subject_details set sem='$sem',branch='$br',sub='$sub',us_code='$us', ps_code='$ps' where si_no='$si' ";
$link->query($r);
if($r)
{
    $_SESSION['updatesub']="Successfully Updated";
    
}
header("Location: addsub4.php");
?>


<?php
include "../template/footer-fac.php";
?>