<?php

include "../template/fac-auth.php";
include "../template/sidebar-fac.php";
$con = $link;
$_SESSION['lab'] = 0;
?>
<form action="redirect_download.php" method="post" target="_blank">
    <div class="row">
        <div class="col col-3 col-md-3 col-lg-3">
            <?php
            $q = 'select distinct semester from students order by semester';
            $result = $link->query($q);
            ?>
            <label for="sem">Semester</label>
            <select name="sem" id="sem" class="form-control">
                <option selected disabled>Select Semester</option>
                <?php foreach ($result as $r) { ?>
                    <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col col-3 col-md-3 col-lg-3">
            <?php
            $q = 'select distinct section from students';
            $result = $link->query($q);
            ?>
            <label for="sec">Section</label>
            <select name="sec" id="sec" class="form-control">
                <option selected disabled>Select Section</option>
                <?php foreach ($result as $r) { ?>
                    <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col col-3 col-md-3 col-lg-3">
            <?php
            $q = 'select * from dept_pso';
            $result = $link->query($q);
            ?>
            <label for="branch">Course</label>
            <select name="branch" id="branch" class="form-control">
                <option selected disabled>Select Course</option>
                <?php foreach ($result as $r) { ?>
                    <option value="<?php echo $r['dept_name'] ?>"><?php echo $r['dept_name'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="col col-3 col-md-3 col-lg-3">
            <label for="Subject">Subject</label>
            <select name="sub" class="form-control" id="Subject">
                <option value="" selected disabled>Select Subject</option>
                <?php

                    $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
                    $faculty_name= $_SESSION["username"];
                    if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                        $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name and a.branch = '" . $fac_branch . "'";
                    } else {
                        $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                    }
                    // echo $fac_branch;
                    $resultst = $con->query($qt);
                    $subjects_arr = array();
                    if ($fac_branch == 'MATHEMATICS') {
                        echo "1";
                        foreach ($resultst as $r2) {
                            if(in_array($r2["sub_code"] . " - " . $r2["sub_name"], $subjects_arr)){
                                continue;
                            }
                            $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
                        }
                    } else {
                        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                            foreach ($resultst as $r) {
                                if ($r['lab'] != '1') {
                                    $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                } else {
                                    if ($r['branch'] == $fac_branch) {
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                    }
                                }
                            }
                        } else {
                            foreach ($resultst as $r) {
                                if ($r['sub_id'] != '3') {
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
                    }
                    // print_r($subjects_arr);
                    foreach ($subjects_arr as $r) {
                    ?>
                        <option class="form-control" value="<?php echo $r ?>"><?php echo $r ?></option>
                    <?php  } ?>
            </select>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
</form>



<?php
include "../template/footer-fac.php";
?>