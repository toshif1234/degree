<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
// $sem = $_POST['sem'];
// $usn = $_POST['usn1'];
$a1 = $_POST['code'];
$_SESSION['code'] = $a1;

$q1 = "select ps_code from exam_subject_details where us_code = '$a1'";
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
<form action="../external_seat_allotment/addarr4.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
    <div class="col-md-4">
        <label for="code" class="form-label fw-bolder mt-2">Exam Subject Code</label>
        <!-- <input type="number" name="code" min="1" max="8" class="form-control" id="exam-sem" placeholder="eg. 7" required> -->
        <select name="code1" class="form-control" id="code">
            <option selected disabled value="">Select Exam Subject Code </option>
            <?php
            foreach ($res as $r) {
                echo "<option value=\"" . $r["ps_code"] . "\"> " . $r["ps_code"] . "</option>";
            }  ?>
        </select>
        <span id="message1" style="color: red;"></span>

    </div>
    <div class="col-md-4">
        <br>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<?php
include "../template/footer-fac.php";
?>