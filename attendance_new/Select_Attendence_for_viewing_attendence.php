<?php
// session_start();
// error_reporting( error_reporting() & ~E_NOTICE );

include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q1 = "select distinct branch from students";
// echo $q1;
$result = $link->query($q1);
$q2 = "select distinct semester from students";
$q3 = "select distinct section from students";
$result1 = $link->query($q2);
$result2 = $link->query($q3);
$faculty_name = $_SESSION["username"];
$_SESSION["temp"] = 0;
$_SESSION['lab_view_batch'] = 1;
if (isset($_SESSION["check_error"]) && $_SESSION["check_error"] == 1) {
    $_SESSION["check_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Subject and semester doesnot match</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}

$q_year = 'select distinct att from attendance_new';
$result_year = $link->query($q_year);
$arr_dates = array();
$month = array(
    '01' => 'JANUARY',
    '02' => 'FEBRUARY',
    '03' => 'MARCH',
    '04' => 'APRIL',
    '05' => 'MAY',
    '06' => 'JUNE',
    '07' => 'JULY',
    '08' => 'AUGUST',
    '09' => 'SEPTEMBER',
    '10' => 'OCTOBER',
    '11' => 'NOVEMBER',
    '12' => 'DECEMBER'
);
// echo $month['01'];
foreach ($result_year as $r2) {
    $p = explode(';', $r2['att']);
    
    foreach ($p as $p2) {
        // print_r($p2);
        // echo '<br>';
        $q = explode(':', $p2);
        $q = explode('-', $q[0]);
        if(!isset($q[1])){
            continue;
        }
        $ele = $q[0] . '-' . $q[1];
        if (in_array($ele, $arr_dates)) {
            continue;
        }
        $arr_dates[] = $q[0] . '-' . $q[1];
    }
}
// print_r($arr_dates);

?>



<!-- page content start -->

<form action="View_or_Edit_Attendence.php" method="post">
    <div class="container mb-5">
        <div class="row mt-5">
            <div class="col-md-4 col-lg-4">
                <label for="sem">Semester</label>
                <select name="sem" class="form-control">
                    <option selected disabled>Select Semester </option>
                    <?php

                    foreach ($result1 as $r) {


                        echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <label for="sec">Section</label>
                <select name="sec" class="form-control">
                    <option selected disabled>Select Section </option>
                    <?php

                    foreach ($result2 as $r) {


                        echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="sub">Branch</label>
                    <select name="branch" class="form-control">
                        <option selected disabled>Select Branch </option>

                        <?php

                        foreach ($result as $r) {
                        ?>
                            <option value="<?php echo $r['branch'] ?>"><?php echo $r['branch'] ?></option>
                        <?php
                        }  ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="Subject"> Subject </label>
                    <select name="sub" class="form-control" id="Subject">
                        <option value="" selected disabled>Select Subject</option>
                        <?php
                        $fac_branch = mysqli_fetch_assoc($link->query('select faculty_dept from faculty_details where faculty_name = "' . $_SESSION['username'] . '"'))['faculty_dept'];

                        $qt = "select * from faculty_mapping b, subjects_new a where b.faculty_name = \"" . $faculty_name .
                            "\" and b.sub_name = a.sub_name";
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
            </div>
            <div class="col-md-4 col-lg-4">
                <div class="form-group">
                    <label for="month"> Month </label>
                    <select name="month" class="form-control" id="Period">
                        <?php
                        sort($arr_dates);
                        foreach ($arr_dates as $arr) {
                            $q = explode('-', $arr);
                            // if($q==""){
                            //     continue;
                            // }
                        ?>
                            <option value="<?php echo $arr ?>"><?php echo $q[0] . ' - ' . $month[$q[1]]; ?></option>
                        <?php }  ?>
                        <!-- <option value="02">Feb</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">Aug</option>
                        <option value="09">Sept</option>
                        <option value="10">Oct</option>
                        <option value="11">November</option>
                        <option value="12">December</option> -->
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-lg mt-4" type="submit" value="Load" name="Filter" id="Filter">Load</button>
        <!-- <div class="col mt-5">
            <!-- <div class="form-group"> -->
        <!-- <label for="Date"> </label> -->
        <!-- <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary" id="Filter"> -->
        <!-- </div> -->
    </div>


    <!-- <div class="col">
                <div class="form-group">
                    <!-- <label for="Date"> Date </label> -->
    <!-- <input type="date" name="date" class="form-control" id="Date"> -->
    </div>

</form>
</div>
<!-- page content end -->
<?php include("../template/footer-fac.php"); ?>