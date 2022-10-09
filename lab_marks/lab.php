<?php
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
require_once "config1.php";
error_reporting(0);

$q1 = "select distinct branch from students";
$result = $con->query($q1);
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$q4 = 'select disticnt no_exp from lab_marks';

$result1 = $con->query($q2);
$result2 = $con->query($q3);
$faculty_name = $_SESSION["username"];

?>



<div class="container">
    <form action="lab_add_student.php" method="post">
        <div class="row mb-4">

            <div class="col col-3 col-mg-3 col-lg-3">
                <label for="sub">Subject</label>
                <select class="form-control" name="sub" id="sub" aria-label="Default select example" required>
                    <option value="" selected disabled>Select Subject</option>
                    <?php

                    $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] .'"'))['faculty_dept'];

                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                        $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                    } else {
                        $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name and a.branch = \"" . $fac_branch . "\"";
                    }
                    echo $qt;
                    $resultst = $con->query($qt);
                    $subjects_arr = array();
                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                        foreach ($resultst as $r) {
                            if ($r['lab'] == '1') {
                                if ($r['branch'] == $fac_branch) {
                                    if(in_array($r["sub_code"] . " - " . $r["sub_name"], $subjects_arr)){
                                        continue;
                                    }
                                    $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                }
                            }
                        }
                    } else {
                        foreach ($resultst as $r) {
                            if ($r['sub_id'] == '3') {
                                    if ($r['branch'] == $fac_branch) {
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                    }
                                }
                            }
                        
                    }
                    print_r($subjects_arr);
                    foreach ($subjects_arr as $r) {
                    ?>
                        <option class="form-control" value="<?php echo $r ?>"><?php echo $r ?></option>
                    <?php  } ?>
                </select>
            </div>
            <div class="col">
                <label for="sub">Course</label>
                <select name="branch" class="form-control"  required>
                    <option selected disabled>Select Course</option>

                    <?php

                    foreach ($result as $r) {

                    ?>
                        <option value="<?php echo $r["branch"] ?>"><?php echo $r["branch"] ?></option>"

                    <?php   }  ?>
                </select>
            </div>

            <div class="col">
                <label for="sub">Semester</label>
                <select name="sem" class="form-control"  required>
                    <option selected disabled>Select Semester</option>
                    <?php

                    foreach ($result1 as $r) {


                        echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                    }  ?>
                </select>
            </div>

            <div class="col">
                <label for="sub">Section</label>
                <select name="sec" class="form-control"  required>  
                    <option selected disabled>Select Section</option>
                    <?php

                    foreach ($result2 as $r) {


                        echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="container">
                <div class="col-11">
                </div>
                <div class="col-1">
                    <button class="btn btn-primary mt-4" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    <?php  ?>

    document.getElementById('ia-marks').onclick = function() {
        var disabled = document.getElementById("ia_marks_value").disabled;
        if (disabled) {
            document.getElementById("ia_marks_value").disabled = false;
        } else {
            document.getElementById("ia_marks_value").disabled = true;
        }
    }
</script>
<?php include("../template/footer-fac.php");
