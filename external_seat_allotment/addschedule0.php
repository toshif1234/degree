<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
// $q1 = "select distinct us_code from exam_schedule_details";
// $res = $link->query($q1);
$q2 = "select distinct semester from students";
$result1 = $link->query($q2);
?>
<script>
    function myfun1() {
        var a = document.getElementById("sem").value;
        if (a == "") {
            document.getElementById("message1").innerHTML = "  **Please Select Valid Sem";
            return false;
        }
    }
</script>
<div class="container mt-5">
    <div class="mt-5">
        <form action="../external_seat_allotment/addschedule1.php" method="POST" class="row g-3 " onsubmit="return myfun1()">
            <div class="row">
                <h4 class="mt-5 fw-bolder">Add Exam Schedule</h4>
                <div class="col-md-6">
                    <label for="exam-sem" class="form-label fw-bolder mt-2">Exam for the semester</label>
                    <!-- <input type="number" name="sem" min="1" max="8" class="form-control" id="exam-sem" placeholder="eg. 7" required> -->
                    <select name="sem" id="sem" class="form-control">
                        <option value="" selected disabled>Select Semester </option>
                        <?php
                        foreach ($result1 as $r) {
                            echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                        }  ?>
                    </select>
                    <span id="message1" style="color: red;"></span>
                </div>
                <div class="col-md--1 mt-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>


</div>


<?php
include "../template/footer-fac.php";
?>