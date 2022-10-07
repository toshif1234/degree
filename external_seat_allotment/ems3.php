<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
//session_start();
$i1=$_POST['ii'];
if (isset($_POST["sub"])) {
    for($j=1;$j<=$i1;$j++){
    $date1 = $_POST['date1'.$j];
    $si = $_POST['si'.$j];
    $fi = $_POST['fi'.$j];
    $fn = $_POST['fn'.$j];
    $session1 = $_POST['session1'.$j];
    $sem = $_POST['sem'.$j];
    $duty = $_POST['duty'.$j];
    $q = "insert into exam_duty(date,faculty_id,faculty_name,session,sem,duty) values('$date1','$fi','$fn','$session1','$sem','$duty')";
    $res = $link->query($q);
    $update = "UPDATE exam_block SET status = 'blocked' WHERE si_id='$si'";
    $res1 = $link->query($update);
    }
    if($res)
    {
        $_SESSION['emssub']="Successfully Submitted All Data";
        
    }
}
?>
<script>
    window.location.href = 'ems2.php';
</script>

<?php
include "../template/footer-fac.php";
?>