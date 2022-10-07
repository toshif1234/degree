<?php include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);

$fac_sub = "SELECT sub_name FROM faculty_mapping WHERE faculty_name = \"" . $_SESSION['username'] . "\"";

$result = $link->query($fac_sub);
$faculty_name = $_SESSION["username"];
// if (isset($_POST['submit'])) {
//     $_SESSION['sub_name'] = $_POST['sub_name'];
// }
?>

<div class="container-fluid">
    <form action="../assignment/session1.php" method="post">
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub">Subject</label>
                    <select class="form-control" name="sub_name" required>
                        <option selected disabled>Select Subject </option>
                        <?php
                        $fac_branch = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                        if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                            $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                        } else {
                            $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                                "\" and b.sub_name = a.sub_name";
                        }
                        $resultst = $link->query($qt);
                        $subjects_arr = array();
                        if ($fac_branch == 'MATHEMATICS') {
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
                        print_r($subjects_arr);
                        foreach ($subjects_arr as $r) {
                        ?>
                            <option class="form-control" value="<?php echo $r ?>"><?php echo $r ?></option>
                        <?php  } ?>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="sub"></label>
                    <div>
                        <button type="submit" class="btn btn-primary " name="submit">Submit</button>
                    </div>
                </div>

            </div>
    </form>


</div>

<?php include("../template/footer-fac.php") ?>