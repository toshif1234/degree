<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$a1 = $_POST['us_code'];
$q1 = "select * from exam_subject_details where us_code = '$a1'";
$res = $link->query($q1);
?>


<?php
foreach ($res as $r) {


    $r = 'insert into exam_schedule_details (date,stime,etime,session,us_code,sub,sem) values("' . $_POST['date'] . '", "' . $_POST['StartTime'] . '","' . $_POST['EndTime'] . '", "' . $_POST['period'] . '","' . $_POST['us_code'] . '","' . $r['sub'] . '","' . $r['sem'] . '")';
    // // echo $r;
    $link->query($r); ?>
    <br>
<?php
}

?>

<script>
    window.location.href = 'addschedule3.php';
</script>

<?php
include "../template/footer-fac.php";
?>