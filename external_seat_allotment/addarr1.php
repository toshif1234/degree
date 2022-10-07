<?php
require_once "../config.php";
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct us_code from exam_schedule_details";
$res = $link->query($q1);
$q2 = "select distinct semester from students";
$result1 = $link->query($q2);
?>
<script>
    function myfunc()
    {
        var a=document.getElementById("semester").value;
        if(a=="")
        {
            document.getElementById("message1").innerHTML="  **Please Select Valid Semester";
            return false;
        }
        
    }
    </script>
 <h4 class="mt-5 fw-bolder">Add Arrear Student Details</h4>
 <br>
<form action="../external_seat_allotment/addarr2.php" method="POST" class="row g-3 " onsubmit="return myfunc()">
    <div class="row">
        <div class="col-md-4">
            <label for="exam-sem" class="form-label fw-bolder mt-2">Exam for the semester</label>
            <!-- <input type="number" name="sem" min="1" max="8" class="form-control" id="exam-sem" placeholder="eg. 7" required> -->
            <select name="sem" class="form-control" id="semester">
                <option selected disabled value="" >Select Semester </option>
                <?php
                foreach ($result1 as $r) {
                    echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                }  ?>
            </select>
            <span id="message1" style="color: red;"></span>
        </div>
        <div class="col-md-4">
            <label for="usn1" class="form-label fw-bolder mt-2">University Seat Number</label>
            <input type="text" name="usn1" id="usn1" class="form-control" placeholder="4AL12AB345" required>
        </div>
        <div class="col-md-5 mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>
<?php
include "../template/footer-fac.php";
?>


