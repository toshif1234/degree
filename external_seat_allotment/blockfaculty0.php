<?php
require_once "../config.php";
error_reporting(0);
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$use = $_SESSION['username'];
$q = "select distinct date,session from exam_schedule_details where status='unblocked'";
$res = $link->query($q);


$deldate = array();
foreach ($res as $r5) {
    $date = $r5['date'] . '-' . $r5['session'];
    $deldate[] = $date;
}
// print_r($deldate);
$deldate1 = "select date,session from exam_block where faculty_name='$use'";
$deldate3 = array();

$deldate2 = $link->query($deldate1);
foreach ($deldate2 as $r6) {
    $date = $r6['date'] . '-' . $r6['session'];
    $deldate3[] = $date;
}
//print_r($deldate3);
foreach ($deldate3 as $deldate4) {
    $del = array_search($deldate4, $deldate);
    unset($deldate[$del]);
}
//print_r($deldate);

$ex1 = $_SESSION['date'];
$ss1 = $_SESSION['session'];
$q1 = "Select count as tot from exam_faculty_count where date='$ex1' and session='$ss1'";
$res1 = $link->query($q1);
$a1 = mysqli_fetch_assoc($res1);
$num_rows1 = $a1['tot'];
$num_rows1;


$q4 = "Select count(*) as total from exam_block where date='$ex1' and session='$ss1';";
$res10 = $link->query($q4);

$a = mysqli_fetch_assoc($res10);
$num_rows = $a['total'];
$num_rows;
if ($num_rows >= $num_rows1) {
    $delete = "update exam_schedule_details set status='blocked' where date='$ex1' and session='$ss1'";
    $resdel = $link->query($delete);
}
?>

<script>
    function myfunc() {
        var a = document.getElementById("date").value;
        if (a == "null") {
            document.getElementById("message2").innerHTML = "  **Please Select Valid Date and Session";
            return false;
        }
    }
</script>
<?php
if($_SESSION['doneblock'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['doneblock'] ?>
</div>
<?php
unset($_SESSION['doneblock']);
}
?>

<h4>Exam Blocking</h4><br>
<a href="blockfaculty3.php" class="btn btn-info view1">View Block Details</a>
<form action="blockfaculty1.php" method="POST" onsubmit="return myfunc()">
    <div class="col-3 mt-3 ">

        <select name="date" id="date" class="form-select">
            <option value="null">Select Date and Session</option>
            <?php
            foreach ($deldate as $r) {

            ?>
                <!-- <option value="<?php echo $r['date'] . $r['session'] ?>"><?php echo $r['date'] . "-" . $r['session'] ?></option> -->
                <option value="<?php echo $r ?>"><?php echo $r ?></option>
            <?php
            } ?>
        </select>
        <span id="message2" style="color: red;"></span>
    </div>
    <br>


    <div class="col-sm-12 col-md-4">
        <input type="submit" class="btn btn-primary p-2" value="Submit" name="sub1">
    </div>
</form>



<?php
include "../template/footer-fac.php";
?>