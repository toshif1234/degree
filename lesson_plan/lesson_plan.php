<!-- <!DOCTYPE html> -->
<?php
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
// error_reporting(0);
require_once "../config.php";
// session_start();
// require_once "config1.php";
$_SESSION["flag_save"] = 0;

// $con = mysqli_connect("localhost", "root", "", "erp_alvas");
$con = $link;

$faculty_name = $_SESSION["username"];
$q_f = "select faculty_id from faculty_details where faculty_name=\"" . $faculty_name . "\"";
// echo $q_f;
$res = $con->query($q_f);
$r_co = mysqli_fetch_assoc($res);
$faculty_id = $r_co["faculty_id"];
// echo $faculty_id;
$_SESSION['faculty_id'] = $faculty_id;
$q_s1 = "Select distinct semester from students order by semester";
$q_s2 = "Select distinct section from students order by section";
// echo $q_s;
$result_s1 = $con->query($q_s1);
$result_s2 = $con->query($q_s2);
if (isset($_SESSION["check_error"]) && $_SESSION["check_error"] == 1) {
    $_SESSION["check_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Subject and semester doesnot match</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>


<!-- page content start -->
<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo
    </button>
    <!-- <script>
    let demo = document.getElementById("demoVideo")
    var vid = document.getElementById("myVideo"); 
    demo.addEventListener('focus', function() {
        vid.pause();
});

</script> -->
    <!-- Modal -->
    <div class="modal fade" id="demoVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">demo on lesson plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <video controls width="100%">
                        <source src="https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4" type="video/mp4">
                        <source src="https://www.learningcontainer.com/wp-content/uploads/2020/05/sample-mp4-file.mp4" type="video/ogg">
                        Your browser does not support HTML video.
                    </video>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="container">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Plan</a>
            <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Execution</a>
            <a class="nav-link" id="nav-labp-tab" data-toggle="tab" href="#nav-labp" role="tab" aria-controls="nav-labp" aria-selected="false">LAB Plan</a>
            <a class="nav-link" id="nav-labe-tab" data-toggle="tab" href="#nav-labe" role="tab" aria-controls="nav-labe" aria-selected="false">LAB Execution</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

            <?php
            if (isset($_SESSION["lesson_done"])) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                ' . $_SESSION["lesson_done"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                unset($_SESSION["lesson_done"]);
            }
            ?>

            <form action="lesson_plan_proc.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-5">
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sem">Semester</label>
                        <select class="form-control" name="sem" id="sem" aria-label="Default select example">
                            <option selected disabled>Select Semester</option>
                            <?php
                            foreach ($result_s1 as $r) { ?>
                                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sec">Section</label>
                        <select class="form-control" name="sec" id="sec" aria-label="Default select example">
                            <option selected disabled>Select Section</option>
                            <?php
                            foreach ($result_s2 as $r) { ?>
                                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sub">Subject</label>
                        <select class="form-control" name="sub" id="sub1" aria-label="Default select example">
                            <option selected disabled>Select Subject</option>
                            <?php
                            $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                            } else {
                                $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                                    "\" and b.sub_name = a.sub_name";
                            }
                            // echo $qt;
                            // echo 'select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';

                            $results2 = $con->query($qt);
                            $subjects_arr = array();
                            echo $fac_branch;
                            if ($fac_branch == 'MATHEMATICS') {
                                foreach ($results2 as $r2) {
                                    if(in_array($r2["sub_code"] . " - " . $r2["sub_name"], $subjects_arr)){
                                        continue;
                                    }
                                    $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
                                }
                            } else {
                                if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                    foreach ($results2 as $r) {
                                        if ($r['lab'] != '1') {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                        } else {
                                            if ($r['branch'] == $fac_branch) {
                                                $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                            }
                                        }
                                    }
                                } else {
                                    foreach ($results2 as $r) {
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
                    <div class="col col-3 col-mg-3 col-lg-3">

                        <label for="sub">Course</label>
                        <select name="branch" class="form-control">
                            <option selected disabled>Select Course </option>

                            <?php
                            $p1 = "select distinct branch from students";
                            // echo $q1;
                            $zp = $con->query($p1);
                            foreach ($zp as $r) {


                                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                            }  ?>
                        </select>

                    </div>

                </div>

                <div class="row">
                    <div class="col col-md-6 col-lg-6">
                        <div class="card mt-5" style="width: 18rem;">
                            <div class="card-body">
                                <label for="total_hour">Total Contact Hour</label>
                                <input type="number" class="form-control" name="total_hour">
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <label for="mod1">Module 1</label>
                                        <input type="number" class="form-control" id="mod1" name="mod1">
                                    </div>
                                    <div class="col">
                                        <label for="mod2">Module 2</label>
                                        <input type="number" class="form-control" id="mod2" name="mod2">
                                    </div>
                                    <div class="col">
                                        <label for="mod3">Module 3</label>
                                        <input type="number" class="form-control" id="mod3" name="mod3">
                                    </div>
                                    <div class="col">
                                        <label for="mod4">Module 4</label>
                                        <input type="number" class="form-control" id="mod4" name="mod4">
                                    </div>
                                    <div class="col">
                                        <label for="mod5">Module 5</label>
                                        <input type="number" class="form-control" id="mod5" name="mod5">
                                    </div>


                                </div>


                            </div>
                        </div>
                    </div>

                    <div style="position: relative;" class="col col-md-6 col-lg-6 mt-4">
                        <input type="text" value="<?php echo $faculty_id ?>" name="faculty_id" hidden>
                        <button type="submit" style="position: absolute;bottom: 0; left: 0" class="btn btn-lg btn-primary">Submit</button>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-1 mt-4">

                    </div>
                    <div class="col">
                    </div>
                </div>
            </form>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <form action="execution_viewing.php" method="POST">
                <div class="row mt-5">
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sem1">Semester</label>

                        <select class="form-control" name="sem" id="sem1" aria-label="Default select example">
                            <option selected disabled>Select Semester</option>
                            <?php
                            foreach ($result_s1 as $r) { ?>
                                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sec1">Section</label>
                        <select class="form-control" name="sec" id="sec1" aria-label="Default select example">
                            <option selected disabled>Select Section</option>
                            <?php
                            foreach ($result_s2 as $r) { ?>
                                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sub1">Subject</label>

                        <select class="form-control" name="subid" id="sub1" aria-label="Default select example">
                            <option selected disabled>Select Subject</option>
                            <?php
                            $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                            } else {
                                $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                                    "\" and b.sub_name = a.sub_name";
                            }
                            $results2 = $con->query($qt);
                            $subjects_arr = array();
                            if ($fac_branch == 'MATHEMATICS') {
                                foreach ($results2 as $r2) {
                                    if(in_array($r2["sub_code"] . " - " . $r2["sub_name"], $subjects_arr)){
                                        continue;
                                    }
                                    $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"];
                                }
                            } else {
                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                foreach ($results2 as $r) {
                                    if ($r['lab'] != '1') {
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                    } else {
                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                        }
                                    }
                                }
                            } else {
                                foreach ($results2 as $r) {
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
                    <div class="col col-3 col-mg-3 col-lg-3">

                        <label for="sub">Course</label>
                        <select name="branch" class="form-control">
                            <option selected disabled>Select Course </option>

                            <?php
                            $p1 = "select distinct branch from students";
                            // echo $q1;
                            $zp = $con->query($p1);
                            foreach ($zp as $r) {


                                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                            }  ?>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col">
                    </div>
                </div>

            </form>

        </div>
        <div class="tab-pane fade" id="nav-labp" role="tabpanel" aria-labelledby="nav-labp-tab">
            <?php
            if (isset($_SESSION["lesson_done"])) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                ' . $_SESSION["lesson_done"] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>';
                unset($_SESSION["lesson_done"]);
            }
            ?>

            <form action="lesson_plan_proc_lab.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-5">
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sem">Semester</label>
                        <select class="form-control" name="sem" id="sem" aria-label="Default select example">
                            <option selected disabled>Select Semester</option>
                            <?php
                            foreach ($result_s1 as $r) { ?>
                                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sec">Section</label>
                        <select class="form-control" name="sec" id="sec" aria-label="Default select example">
                            <option selected disabled>Select Section</option>
                            <?php
                            foreach ($result_s2 as $r) { ?>
                                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-3 col-mg-3 col-lg-3">
                        <label for="sub">Subject</label>
                        <select class="form-control" name="sub" id="sub1" aria-label="Default select example">
                            <option selected disabled>Select Subject</option>
                            <?php
                            $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];
                            // echo 'select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"';
                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                            } else {
                                $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                            }
                            // echo $fac_branch;
                            $results2 = $con->query($qt);
                            $subjects_arr = array();

                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                foreach ($results2 as $r) {
                                    if ($r['lab'] == '1') {
                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                        }
                                    }
                                }
                            } else {
                                foreach ($results2 as $r) {
                                    if ($r['sub_id'] == '3') {
                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
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
                    <div class="col col-3 col-mg-3 col-lg-3">

                        <label for="sub">Course</label>
                        <select name="branch" class="form-control">
                            <option selected disabled>Select Course </option>

                            <?php
                            $p1 = "select distinct branch from students";
                            // echo $q1;
                            $zp = $con->query($p1);
                            foreach ($zp as $r) {


                                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                            }  ?>
                        </select>

                    </div>

                </div>
                <!-- <?php echo $qt; ?> -->
                <div class="row mt-4">
                    <div class="col col-md-3 col-lg-3">
                        <label for="no_exp">No. of Experiments</label>
                        <input type="number" name="no_exp" id="no_exp" class="form-control" min="1" max="16">
                    </div>

                    <div style="" class="col col-md-4 col-lg-4">
                        <input type="text" value="<?php echo $faculty_id ?>" name="faculty_id" hidden>

                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-1 mt-4">
                        <button type="submit" style="" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col">
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="nav-labe" role="tabpanel" aria-labelledby="nav-labe-tab">
            <form action="execution_viewing_lab.php" method="POST">
                <div class="row mt-5">
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sem1">Semester</label>

                        <select class="form-control" name="sem" id="sem1" aria-label="Default select example">
                            <option selected disabled>Select Semester</option>
                            <?php
                            foreach ($result_s1 as $r) { ?>
                                <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sec1">Section</label>
                        <select class="form-control" name="sec" id="sec1" aria-label="Default select example">
                            <option selected disabled>Select Section</option>
                            <?php
                            foreach ($result_s2 as $r) { ?>
                                <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col col-4 col-mg-4 col-lg-4">
                        <label for="sub1">Subject</label>

                        <select class="form-control" name="subid" id="sub1" aria-label="Default select example">
                            <option selected disabled>Select Subject</option>
                            <?php
                            $fac_branch = mysqli_fetch_assoc($con->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                $qt = "select * from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                            } else {
                                $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                                    "\" and b.sub_name = a.sub_name";
                            }
                            $results2 = $con->query($qt);
                            $subjects_arr = array();
                            if (isset($_SESSION['is_archive']) && $_SESSION['is_archive'] == 1) {
                                foreach ($results2 as $r) {
                                    if ($r['lab'] == '1') {

                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"];
                                        }
                                    }
                                }
                            } else {
                                foreach ($results2 as $r) {
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
                    <div class="col col-3 col-mg-3 col-lg-3">

                        <label for="sub">Course</label>
                        <select name="branch" class="form-control">
                            <option selected disabled>Select Course </option>

                            <?php
                            $p1 = "select distinct branch from students";
                            // echo $q1;
                            $zp = $con->query($p1);
                            foreach ($zp as $r) {


                                echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                            }  ?>
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-1 mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="col">
                    </div>
                </div>

            </form>

        </div>
    </div>


</div>
<!-- page content end -->
</div>
</div>
<script>
    const actualBtn = document.getElementById('actual-btn');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function() {
        fileChosen.textContent = this.files[0].name
    })
</script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    }); -->
</script>
</body>

</html>