<?php
require_once "../config.php";
session_start();
echo $branch=$_SESSION['branch'];
echo $sem=$_SESSION['semester'];
echo $subject=$_POST['subject'];
echo $us=$_POST['sub_name1'];
echo $ps=$_POST['sub_name2'];

$r = "insert into exam_subject_details(ps_code,sem,branch,sub,us_code) values ('$ps','$sem','$branch','$subject','$us')";
  
$res=$link->query($r);
header("Location: addsub4.php");


?>

<?php
include "../template/footer-fac.php";
?>