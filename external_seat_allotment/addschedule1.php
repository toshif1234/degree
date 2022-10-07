<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$sem=$_POST['sem'];
$q1 = "select distinct us_code from exam_subject_details where sem='$sem'";
$res = $link->query($q1);



?>
<script>
    function myfun1()
    {
        var a=document.getElementById("Period").value;
        if(a=="select")
        {
            document.getElementById("message1").innerHTML="  **Please Select Valid Session";
            return false;
        }
        var b=document.getElementById('us_code').value;
        if(b=="nullus"){
            document.getElementById("message2").innerHTML="  **Please Select Valid Subject Uniq Code";
            return false;
        }
    }
    </script>

<h4 class="mb-3"> Add Schedule Details</h4>
 <form action="addschedule2.php" method="POST" onsubmit="return myfun1()">
<div class="row ">
    <div class="col-3">
        <div class="form-group">
            <label for="date"> Date </label>
            <input type="date" name="date" class="form-control" id="Date" min="<?php echo date('Y-m-d'); ?>" required>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="StartTime"> Exam Start Time </label>
            <input type="time" name="StartTime" class="form-control" id="StartTime" required>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group">
            <label for="EndTime"> Exam End Time </label>
            <input type="time" name="EndTime" class="form-control" id="EndTime" require>
        </div>
    </div>
    <div class="col-2">
        <div class="form-group">
            <label for="Period"> Session </label>
            <select name="period" class="form-control" id="Period">
                <option value="select">Choose Session</option>
                <option value="FN"> FN </option>
                <option value="AN"> AN </option>

            </select>
            <span id="message1" style="color: red;"></span>
        </div>
    </div>


    <div class="col-2 mt-3 ">
        <select name="us_code" id="us_code" class="form-select">
            <option value="nullus">Select uniq code</option>
            <?php
            foreach ($res as $r) {

            ?>
                <option value="<?php echo $r['us_code'] ?>"><?php echo $r['us_code'] ?></option>
            <?php
            } ?>
        </select>
        <span id="message2" style="color: red;"></span>
    </div>
    <div class="col-5 mt-3">
            <div class="form-group col-2">
                <input type="Submit" value="ADD" name="Filter" class="form-control btn btn-primary" id="Filter">
            </div>
                </div>
        </form>
    </div>
</div>

<?php
include "../template/footer-fac.php";
?>