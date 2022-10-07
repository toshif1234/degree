<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);



// $fac_sub = "SELECT sub_name FROM faculty_mapping WHERE faculty_name = \"" . $_SESSION['username'] . "\"";
// //  echo $fac_sub;
// $result = $link->query($fac_sub);

$q1 = "select distinct branch from students";
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";

$result1 = $link->query($q1);
$result2 = $link->query($q2);
$result3 = $link->query($q3);
$faculty_name = $_SESSION["username"];

?>

<div class="container-fluid">
    <form action="fac_assignment_add_upload.php" method="post" enctype="multipart/form-data">

        <div class=" row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="sub">Subject</label>
                    <select class="form-control" name="sub_name" required>
                        <option value="" selected disabled>Select Subject</option>
                        <?php
                        $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                            $qt = "select a.sub_name, a.sub_code, a.lab from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                        } else {
                            $qt = "select a.sub_name, a.sub_code, a.sub_id from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                                "\" and b.sub_name = a.sub_name  and a.branch = \"" . $fac_branch . "\"";
                        }
                        $resultst = $link->query($qt);
                        echo $qt;
                        foreach ($resultst as $r) {
                            if ($r['sub_id'] != 3) {
                        ?>
                                <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                            <?php  } elseif (isset($r['lab']) && $r['lab'] != 1) {
                            ?>
                                <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                        <?php
                            }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Branch</label>
                    <select name="branch" class="form-control" required>
                        <option selected disabled>Select Branch </option>

                        <?php

                        foreach ($result1 as $r) {


                            echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Semester</label>
                    <select name="semester" class="form-control" required>
                        <option selected disabled>Select Semester </option>
                        <?php

                        foreach ($result2 as $r) {


                            echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Section</label>
                    <select name="section" class="form-control" required>
                        <option selected>Select Section </option>
                        <?php

                        foreach ($result3 as $r) {


                            echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="Asno">Assignment No. </label>
                    <select class="form-control" name="assignment_no" required>
                        <option selected disabled>Select assignment no. </option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>


            <div class="col-md-2">
                <div class="form-group">
                    <label for="">CO's</label>

                    <select class="form-control" name="co_no[]" required multiple>
                        <option selected disabled>Select CO's</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>

                </div>
            </div>



            <div class="col-md-2">
                <div class="form-group">
                    <label for="last_date">Last Date:</label>
                    <input type="date" class="form-control" id="last_date" name="last_date" required>
                </div>
            </div>
        </div>

        <div class="col col-3 col-mg-3 col-lg-3 mt-3">
            <!-- actual upload which is hidden -->
            <label for="actual-btn">Assignment PDF</label> <br>
            <input type="file" name="pdf" id="actual-btn" hidden required />

            <!-- our custom upload button -->
            <label class="label1" for="actual-btn">Choose File</label>
            <input type="hidden" name="MAX_FILE_SIZE" required value="100000">
            <!-- name of file chosen -->
            <span id="file-chosen">No file chosen</span>
            <!-- UPLOAD: <input type="file" name="ufile" id=""> -->
            <input type="hidden" name="MAX_FILE_SIZE" value="100000">
            <!-- <input type="submit" name="submit" value="UPLOAD" > -->
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="form-group mt-5">
                    <label for=""></label>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    const actualBtn = document.getElementById('actual-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function() {
        fileChosen.textContent = this.files[0].name
    })
</script>




<?php include("../template/footer-fac.php") ?>