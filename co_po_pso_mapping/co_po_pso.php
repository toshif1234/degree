<?php
error_reporting(0);
include "../template/fac-auth.php";
include("../template/sidebar-fac.php");
require_once "config.php"; ?>
<?php
$result = $con->query('Select faculty_id, faculty_dept from faculty_details where faculty_name="' . $_SESSION["username"] . '"');
$res = mysqli_fetch_assoc($result);


$q2 = 'select * from dept_pso where dept_name = "' . $res["faculty_dept"] . '"';
$result2 = $con->query($q2);
$res2 = mysqli_fetch_assoc($result2);

$q3 = 'select * from co where faculty_id="' . $res["faculty_id"] . '"';
$result3 = $con->query($q3);
$_SESSION["f_co"] = 0;
// print_r($res2);
// print_r($res1);
?>


<form action="co_po_pso_viewing.php" method="post">

    <div class="row mb-3">
        <div class="col col-4 col-lg-4 col-md-4">
            <label for="sub" class="ml-5">Select Subject:</label>
            <select name="sub" id="sub" class="form-control">
                <option selected disabled>Select Subject</option>
                <?php
                $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                    $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $_SESSION["username"] . "\" and b.sub_name = a.sub_name";
                } else {
                    $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $_SESSION["username"] .
                        "\" and b.sub_name = a.sub_name  and a.branch = \"" . $fac_branch . "\"";
                }
                $resultst = $con->query($qt);
                // echo $qt;
                $subjects_arr = array();
                if ($fac_branch == 'MATHEMATICS') {
                    foreach ($results2 as $r2) {
                        $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
                    }
                } else {
                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                        foreach ($resultst as $r) {
                            if ($r['branch'] == $fac_branch) {
                                $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                            }
                        }
                    } else {
                        foreach ($resultst as $r) {
                            if ($r['sub_id'] == '1') {
                                $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                            } else {
                                if ($r['branch'] == $fac_branch) {
                                    $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                }
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
        <div class="col col-4 col-md-4 col-lg-4">

            <button type="submit" class="btn btn-info mt-4" id="nn" name="co_sub">SUBMIT</button>
        </div>
    </div>

</form>


<?php include("../template/footer-fac.php") ?>