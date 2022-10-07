<?php
error_reporting(0);
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct branch from students";
// echo $q1;
$_SESSION['lab'] = 0;
$result = $link->query($q1);
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$result1 = $link->query($q2);
$result2 = $link->query($q3);
$faculty_name = $_SESSION["username"];
if (isset($_SESSION["check_error"]) && $_SESSION["check_error"] == 1) {
    $_SESSION["check_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-dismissible alert-danger custom-danger-alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Subject and semester doesnot match
</div>';
}
if (isset($_SESSION["period_error"]) && $_SESSION["period_error"] == 1) {
    $_SESSION["period_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-dismissible alert-danger custom-danger-alert">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>Date:Period selected is already marked
</div>';
}



$_SESSION["temp"] = 0; ?>

<form action="Add_Attendence.php" method="post">
    <div id="dateWarning" style="display: none;" class="alert alert-warning">
        <button type="button" class="btn-close" onclick="dateWarningClose()"></button>
        <h4 class="alert-heading">Warning!</h4>
        <p class="mb-0" style="color: white;">
            atendence of <span id="sd" style="color: rgb(230, 73, 73);"></span> cannot be assigned today, <span id="td" style="color: rgb(175, 241, 136);"></span> selected instead
        </p>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-4 col-lg-4">
                <label for="sub">Semester</label>
                <select name="sem" class="form-control" required>
                    <option selected value="" disabled> Semester </option>
                    <?php

                    foreach ($result1 as $r) {


                        echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="sub">Section</label>
                <select name="sec" class="form-control" required>
                    <option selected value="" disabled> Section </option>
                    <?php

                    foreach ($result2 as $r) {


                        echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="sub">Branch</label>
                    <select name="branch" class="form-control" required>
                        <option selected value="" disabled> Branch </option>

                        <?php

                        foreach ($result as $r) {


                            echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                        }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="Subject"> Subject </label>
                    <select name="sub" class="form-control" id="Subject" required>
                        <option value="" selected disabled>Subject</option>
                        <?php
                        $fac_branch = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                        $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                            "\" and b.sub_name = a.sub_name";
                        $resultst = $link->query($qt);
                        $r = mysqli_fetch_assoc($resultst);
                        $subjects_arr = array();
                        if ($fac_branch == 'MATHEMATICS') {
                            foreach ($resultst as $r2) {
                                if(in_array($r2["sub_code"] . " - " . $r2["sub_name"] . ';' . $r['sub_id'], $subjects_arr)){
                                    continue;
                                }
                                $subjects_arr[] = $r2["sub_code"] . " - " . $r2["sub_name"] . ';' . $r['sub_id'];
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
                                        $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"] . ';' . $r['sub_id'];
                                    } else {
                                        if ($r['branch'] == $fac_branch) {
                                            $subjects_arr[] = $r["sub_code"] . " - " . $r["sub_name"] . ';' . $r['sub_id'];
                                        }
                                    }
                                }
                            }
                        }
                        print_r($subjects_arr);
                        foreach ($subjects_arr as $r) {
                            $sub_ext = explode(';', $r);
                        ?>
                            <option class="form-control" value="<?php echo $r ?>"><?php echo $sub_ext[0] ?></option>
                        <?php  } ?>
                    </select>
                </div>

            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="Period"> Period </label>
                    <select name="period" class="form-control" id="Period" required>
                        <option selected value="" disabled>Period No</option>
                        <option value="1"> 1</option>
                        <option value="2"> 2</option>
                        <option value="3"> 3</option>

                    </select>
                </div>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="date"> Date </label>
                    <input type="date" name="date" onchange="setDate()" class="form-control" id="Date" required>
                </div>
                <script>
                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var today = now.getFullYear() + "-" + (month) + "-" + (day);

                    function setDate() {

                        Selecteddate = document.getElementById("Date").value;
                        if (Selecteddate > today) {
                            $('#Date').val(today);
                            $('#sd').html(Selecteddate);
                            $('#td').html(today);
                            $("#dateWarning").css("display", "block");
                        }
                    }

                    function dateWarningClose() {
                        $("#dateWarning").css("display", "none");
                    }
                </script>
            </div>

        </div>
        <!-- <div class="col-md-4 col-lg-4"> -->
        <div class="mt-4">
            <label for="Date"> </label>
            <button type="Submit" name="Filter" class="btn btn-lg btn-primary" id="Filter">Load</button>
        </div>
    </div>
    </div>
    </div>
</form>
</div>
<!-- page content end -->
</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
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
    });
</script>
</body>

</html>