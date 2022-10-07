

<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
error_reporting(0);

$ri=$_GET['si'];
$rn=$_GET['date'];
$rs=$_GET['st'];
$br=$_GET['et'];
$ss=$_GET['ss'];

?>
 <form action="../external_seat_allotment/addschedule2.php" method="POST">
<div class="row ">
    <div class="col-3">
        <div class="form-group">
            <label for="date"> Date </label>
            <input type="date" name="date" class="form-control" id="Date" value="<?php echo $rn?>">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="StartTime"> Exam Start Time </label>
            <input type="time" name="StartTime" class="form-control" id="StartTime" value="<?php echo $rs?>">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="EndTime"> Exam End Time </label>
            <input type="time" name="EndTime" class="form-control" id="EndTime" value="<?php echo $br?>">
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="Period"> Session </label>
            <select name="period" class="form-control" id="Period">
                <option value="<?php echo $ss?>">Choose Session</option>
                <option value="FN"> FN </option>
                <option value="AN"> AN </option>

            </select>
        </div>
    </div>
    <div class="col-5">
            <div class="form-group col-2">
                <input type="Submit" value="Update" name="Filter" class="form-control btn btn-info" id="Filter">
            </div>
                </div>
        </form>
    </div>
</div>

<?php
include "../template/footer-fac.php";
?>