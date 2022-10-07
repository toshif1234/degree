<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct sem from exam_arrear_details";
$result1 = $link->query($q1);
?>
<script>
    function myfunc() {
        var a = document.getElementById("sem").value;
        if (a == "") {
            document.getElementById("message1").innerHTML = "  **Please Select Sem";
            return false;
        }
    }
</script>
<h4 class="mt-5 fw-bolder">View Arrear Student Details</h4>
<br>
<form action="../external_seat_allotment/emsviewarr2.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
    <div class="row">
        <div class="col-md-4">
            <label for="exam-sem" class="form-label fw-bolder mt-2">Exam for the semester</label>
            <select name="sem" class="form-control" id="sem">
                <option selected disabled value="">Select Semester </option>
                <?php
                foreach ($result1 as $r) {
                    echo "<option value=\"" . $r["sem"] . "\"> " . $r["sem"] . "</option>";
                }  ?>
            </select>
            <span id="message1" style="color: red;"></span>
        </div>
        <div class="col-md-5 mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>


<?php
include "../template/footer-fac.php";
?>