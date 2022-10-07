<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$sem = $_POST['sem'];
$_SESSION['sem'] = $sem;
$q1 = "select distinct us_code from exam_arrear_details where sem= $sem";
$result1 = $link->query($q1);
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
<form action="../external_seat_allotment/hodviewarr3.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
    <div class="row">
        <div class="col-md-4">
            <label for="us_code" class="form-label fw-bolder mt-2">Common Subject Code</label>
            <select name="us_code" class="form-control" id="code">
                <option selected disabled value="">Select Common Subject Code </option>
                <?php
                foreach ($result1 as $r) {
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



