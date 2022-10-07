<!-- <!DOCTYPE html> -->
<?php
    include("../template/fac-auth.php");
    include("../template/sidebar-fac.php");
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
//echo $faculty_id;
$q_s1 = "Select distinct semester from students order by semester";
$q_s2 = "Select distinct section from students order by section";
// echo $q_s;
$result_s1 = $con->query($q_s1); 
$result_s2 = $con->query($q_s2); 
?>


            <!-- page content start -->
            <div class="container">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-link active " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Plan</a>
                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Executed</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="test.php" method="POST" enctype="multipart/form-data">
                            <div class="row mt-5">
                                <div class="col col-3 col-mg-3 col-lg-3">
                                    <label for="sem">Semester</label>
                                    <select class="form-control" name="sem" id="sem" aria-label="Default select example">
                                        <option selected disabled>Select Semester</option>
                                        <?php
                                            foreach($result_s1 as $r){ ?>
                                        <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col col-3 col-mg-3 col-lg-3">
                                    <label for="sec">Section</label>
                                    <select class="form-control" name="sec" id="sec" aria-label="Default select example">
                                        <option selected disabled>Select Section</option>
                                        <?php
                                            foreach($result_s2 as $r){ ?>
                                        <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col col-3 col-mg-3 col-lg-3">
                                    <label for="sub">Subject</label>
                                    <select class="form-control" name="sub" id="sub" aria-label="Default select example">
                                        <option selected disabled>Select Subject</option>
                                        <?php
                                        $q1 = "select a.sub_name, a.sub_code from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                                        $results1 = $con->query($q1);
                                        foreach ($results1 as $r) {

                                        ?>
                                            <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>
                                <div class="col col-3 col-mg-3 col-lg-3">
                                    <!-- actual upload which is hidden -->
                                    <label for="actual-btn">Syllabus copy</label> <br>
                                    <input type="file" name="ufile" id="actual-btn" hidden required />

                                    <!-- our custom upload button -->
                                    <label class="label1" for="actual-btn">Choose File</label>
                                    <input type="hidden" name="MAX_FILE_SIZE" required value="100000">
                                    <!-- name of file chosen -->
                                    <span id="file-chosen">No file chosen</span>
                                    <!-- UPLOAD: <input type="file" name="ufile" id=""> -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000">
                                    <!-- <input type="submit" name="submit" value="UPLOAD" > -->
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-sm-1 mt-4">
                                    <input type="text" value="<?php echo $faculty_id ?>" name="faculty_id" hidden>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                                            foreach($result_s1 as $r){ ?>
                                        <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col col-4 col-mg-4 col-lg-4">
                                    <label for="sec1">Section</label>
                                    <select class="form-control" name="sec" id="sec1" aria-label="Default select example">
                                        <option selected disabled>Select Section</option>
                                        <?php
                                            foreach($result_s2 as $r){ ?>
                                        <option value="<?php echo $r['section'] ?>"><?php echo $r['section'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col col-4 col-mg-4 col-lg-4">
                                    <label for="sub1">Subject</label>

                                    <select class="form-control" name="subid" id="sub1" aria-label="Default select example">
                                        <option selected disabled>Select Subject</option>
                                        <?php
                                        $q1 = "select a.sub_name, a.sub_code from faculty_mapping b, subjects a where faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                                        $results2 = $con->query($q1);
                                        foreach ($results2 as $r) {

                                        ?>
                                            <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>"><?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                                        <?php  } ?>
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>