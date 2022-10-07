<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$q = "select distinct date,session from exam_duty";
$res = $link->query($q);
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
<form action="session_for_ems4.php" method="POST" onsubmit="return myfunc()">
<h4>EMS View</h4><br>
    <div class="col-3 mt-3 ">

        <select name="date" id="date" class="form-select">
            <option value="null">Select Date</option>
            <?php
            foreach ($res as $r) {

            ?>
                <option value="<?php echo $r['date'] . $r['session'] ?>" required><?php echo $r['date'] . "-" . $r['session'] ?></option>
            <?php
            } ?>
            
        </select>
        <span id="message2" style="color: red;"></span>
    </div>



    <div class="col-sm-12 col-md-4 mt-3">
        <!-- <a type="submit" class="btn btn-info" href="ems2.php?date=<?php echo $r['date'] ?>&ss=<?php echo $r['session'] ?>">Load</a> -->
        <input type="submit" class="btn btn-primary p-2" value="Submit" name="sub1">
    </div>
</form>

<?php
include "../template/footer-fac.php";
?>