<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";

$ex = $_POST['date']; 
$se = $_POST['sem'];
$ss = $_POST['session'];
echo $examstime=$_POST['examstime'];
echo $exametime=$_POST['exametime'];

$count = 0;
$fii = $_SESSION['faculty_id'];
$fn = $_SESSION['username'];

$ch = $_POST['scales'];

// $q = "select distinct date,session from exam_schedule_details where date='$ex' and session='$ss' ";
// $res1 = $link->query($q);
// for($i=0;$i<$fcount;$i++)
// {
//echo $ex;
$q = "insert into exam_block (date,faculty_id,faculty_name,sem,session,stime,etime,checkbox) values('$ex','$fii','$fn','$se','$ss','$examstime','$exametime','$ch')";
$res = $link->query($q);
if($res)
{
    $_SESSION['doneblock']="Successfully Blocked";
    
}

//session_start();
$ex = $_POST['date'];
$_SESSION['date']=$ex;
$ss = $_POST['session'];
$_SESSION['session']=$ss;

// $q1 = "Select count as tot from exam_faculty_count where date='$ex' and session='$ss'";
// $res1 = $link->query($q1);
// $a1 = mysqli_fetch_assoc($res1);
// $num_rows1 = $a1['tot'];
// echo $num_rows1;
// // foreach ($res1 as $r8) {
// //   $countf = $r8['count'];
// // }

// $q4 = "Select count(*) as total from exam_block where date='$ex' and session='$ss';";
// $res10 = $link->query($q4);
// // print_r($res10);
// // echo $countd;
// $a = mysqli_fetch_assoc($res10);
// $num_rows = $a['total'];
// echo $num_rows;
// if ($num_rows >= $num_rows1) {
//   echo "greater";
//   $delete="update exam_schedule_details set status='blocked' where date='$ex' and session='$ss'";
//   $resdel=$link->query($delete);
// }
// if($res10>=$res1)
// {
//   //$delete="delete from exam_schedule_details where date='$ex' and session='$ss'";
//   
// }
//header("Location: ../External_seat_allotment/blockfaculty0.php");
?>
<script>
window.location.href = 'blockfaculty0.php';
</script>
<?php
include "../template/footer-fac.php";

?>