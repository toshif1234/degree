<?php
require_once "../config.php";
session_start();
 $ps=$_POST['code1'];
 $us=$_SESSION['code'];
$usn=$_SESSION['usn1'];
$sem=$_SESSION['sem'];
$use = $_SESSION['username'];

?>
<?php
 $q = "insert into exam_arrear_details(usn,sem,us_code,ps_code,faculty_name) values('$usn','$sem','$us','$ps','$use')";
 $res = $link->query($q);
?>
<?php
header("Location: addarr1.php");
?>
<?php
include "../template/footer-fac.php";
?>