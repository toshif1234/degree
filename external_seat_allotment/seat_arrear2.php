<?php
require_once "../config.php";
include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$sem=$_POST['sem'];
$_SESSION['sem']=$sem;
$q1 = "select distinct us_code from exam_schedule_details where sem=$sem";
$res = $link->query($q1);
?>
    <div class="container mt-5">
        <div class="mt-5">
            <form action="../external_seat_allotment/seat_arrear3.php" method="POST" class="row g-3 ">
                <div class="row">
                    <h4 class="mt-5 fw-bolder">External Arrear Exam Seating Allotment</h4>
                    <div class="col-md-4">
                        <label for="roomRows" class="form-label fw-bolder mt-2">The room's row count</label>
                        <input type="text" name="count" id="roomRows" class="form-control" placeholder="The total number of rows in the room" required>
                    </div> 
                    <div class="col-md-4">
                        <label for="exam-sem" class="form-label fw-bolder mt-2">Exam Code</label>
                        <!-- <input type="number" name="sem" min="1" max="8" class="form-control" id="exam-sem" placeholder="eg. 7" required> -->
                        <select name="code" class="form-control">
                            <option selected disabled>Select Exam Code </option>
                            <?php
                            foreach ($res as $r) {
                                echo "<option value=\"" . $r["us_code"] . "\"> " . $r["us_code"] . "</option>";
                            }  ?>
                    </select>
                    </div>
                    <div class="col-md-3 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>


    </div>


<?php
include "../template/footer-fac.php";
?>