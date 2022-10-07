<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);
$q = "select distinct date,session from exam_schedule_details";
$res = $link->query($q);
// $q = "select distinct date,session from exam_schedule_details where status='unblocked' ";
// $res = $link->query($q);


$deldate = array();
foreach ($res as $r5) {
    $date = $r5['date'] . '-' . $r5['session'];
    $deldate[] = $date;
}
// print_r($deldate);
$deldate1 = "select date,session from exam_faculty_count where status='unblocked'";
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

?>


<script>
    function myfun() {
        var a = document.getElementById("datee").value;

        //document.write(b);
        if (a == "defult") {
            document.getElementById("message").innerHTML = "  **Please Select valid Date and Session";
            return false;
        }

        var b = document.getElementById("count").value;
        if (b >= 100) {
            document.getElementById("message1").innerHTML = "  **Please Enter Less than 100 Faculty";
            return false;
        }
    }
</script>
<?php
if($_SESSION['success1'])
{

?>
<div class="alert alert-dismissible alert-success custom-success-alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <strong>Hey!</strong> <?php echo $_SESSION['success1'] ?>
</div>
<?php
unset($_SESSION['success1']);
}
?>
<h4>Faculty Count</h4>
<br>
<a href="facultycount3.php" class="btn btn-info">View Faculty Count</a>
<br> <br>
<form action="facultycount2.php" method="POST" onsubmit="return myfun()">
    <div class="col-3 mt-3 ">
        <label for="datee">Select Date and Session</label>
        <select name="datee" id="datee" class="form-select">
            <option value="defult">Select Date and Session</option>
            <?php
            foreach ($deldate as $r) {

            ?>
                <!-- <option value="<?php echo $r['date'] . $r['session'] ?>"><?php echo $r['date'] . "-" . $r['session'] ?></option> -->
                <option value="<?php echo $r ?>"><?php echo $r ?></option>
            <?php
            }
            ?>
        </select>
        <span id="message" style="color: red;"></span>
    </div>

    <div class="col-3">
        <div class="form-group ">
            <div>
                <label for="count">Faculty Count</label>
                <input type="text" name="count" id="count" class="form-control" required>
                <span id="message1" style="color: red;"></span>
            </div>
        </div>
    </div>
    <br>
    <input type="submit" name="sub" class="btn btn-info">
</form>


<?php
include "../template/footer-fac.php";
?>