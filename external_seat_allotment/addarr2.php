<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$sem = $_POST['sem'];
$_SESSION['sem'] = $sem;
$usn = $_POST['usn1'];
$_SESSION['usn1'] = $usn;
$q1 = "select distinct us_code from exam_schedule_details where sem = '$sem'";
$res = $link->query($q1);
?>
<script>
    function myfunc()
    {
        var a=document.getElementById("code").value;
        if(a=="")
        {
            document.getElementById("message1").innerHTML="  **Please Select Valid Code";
            return false;
        }
    }
    </script>
<form action="../external_seat_allotment/addarr3.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
<div class="row">
    <div class="col-md-4">
        <label for="exam-sem" class="form-label fw-bolder mt-2">Exam Common Code</label>
        <!-- <input type="number" name="sem" min="1" max="8" class="form-control" id="exam-sem" placeholder="eg. 7" required> -->
        <select name="code" class="form-control" id="code">
            <option selected disabled value="">Select Exam Code </option>
            <?php
            foreach ($res as $r) {
                echo "<option value=\"" . $r["us_code"] . "\"> " . $r["us_code"] . "</option>";
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



