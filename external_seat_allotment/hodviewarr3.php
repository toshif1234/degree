<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
 $sem = $_SESSION['sem'];
 $us = $_POST['us_code'];
$_SESSION['us_code'] = $us;
$q1 = "select distinct ps_code from exam_arrear_details where sem= '$sem' and us_code='$us'";
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
<form action="../external_seat_allotment/hodviewarr4.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
    <div class="row">
        <div class="col-md-4">
            <label for="ps_code" class="form-label fw-bolder mt-2">Subject Code</label>
            <select name="ps_code" class="form-control" id="code">
                <option selected disabled value="">Select Subject Code </option>
                <?php
                foreach ($result1 as $r) {
                    echo "<option value=\"" . $r["ps_code"] . "\"> " . $r["ps_code"] . "</option>";
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



