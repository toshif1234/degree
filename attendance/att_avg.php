<?php
                    // session_start();
                    error_reporting(0);

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
$_SESSION["temp"] = 0; ?>


<!-- page content start -->

<form action="att_avgc.php" method="post">
<div class="form-group">
    <div class="container mb-5">
        <div class="row">

            <div class="col-md-2 col-sm-12">
                <label for="sub">Semester</label>
                <select name="sem" class="form-control">
                    <option selected> Semester </option>
                    <?php

                    foreach ($result1 as $r) {


                        echo "<option value=\"" . $r["semester"] . "\"> " . $r["semester"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-12">
                <label for="sub">Section</label>
                <select name="sec" class="form-control">
                    <option selected> Section </option>
                    <?php

                    foreach ($result2 as $r) {


                        echo "<option value=\"" . $r["section"] . "\"> " . $r["section"] . "</option>";
                    }  ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <label for="Subject"> Subject </label>
                    <select name="sub" class="form-control" id="Subject">
                        <?php
                        $qt = "select a.sub_name, a.sub_code from faculty_mapping b, subjects a where b.faculty_name = \"" . $faculty_name . "\" and b.sub_name = a.sub_name";
                        $resultst = $link->query($qt);
                        echo $qt;
                        foreach ($resultst as $r) {

                        ?>
                        <option class="form-control" value="<?php echo $r["sub_code"] . " - " . $r["sub_name"] ?>">
                            <?php echo $r["sub_code"] . " - " . $r["sub_name"] ?></option>
                        <?php  } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2 col-sm-12">
                <label for="sub">Branch</label>
                <select name="branch" class="form-control">
                    <option selected disabled> Branch </option>

                    <?php

                    foreach ($result as $r) {
                    ?>
                    <option value="<?php echo $r['branch'] ?>"><?php echo $r['branch'] ?></option>
                    <?php
                    }  ?>
                </select>
            </div>
           
                <div class="col-md-2 col-sm-12">
                <label for="sub">SD</label>
                    <input type="date" class="form-control" name="startdate">
                </div>
                <div class="col-md-2 col-sm-12">
                <label for="sub">ED</label>
                    <input type="date" class="form-control" name="enddate">
                </div>
            </div>
            <!-- <div class="form-group"> -->
                    <!-- <label for="Date"> </label> -->
                    <input type="Submit" value="Load" name="Filter" class="form-control btn btn-primary" id="Filter">
                
        </div>
    </div>
</form>

</body>