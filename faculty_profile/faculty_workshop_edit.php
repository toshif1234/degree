<?php
// session_start();
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);
require_once '../config.php';
?>

<!-- page content start -->
<div>

    <?php
    $con = $link;
    $faculty_name = $_SESSION["username"];
    $faculty_id = $_POST["faculty_id"];
    $workshop_id = $_POST['workshop_id'];
    $work_name = $_POST['work_name'] ?? " ";
    $work_title = $_POST['work_title'] ?? " ";
    $work_days = $_POST['work_days']  ?? " ";

    ?>

    <form action="faculty_workshop_update.php" method="POST">

    <input type="text" name="workshop_id" id="workshop_id" value="<?php echo $workshop_id ?>" hidden>


    <input type="text" name="faculty_id" id="faculty_id" value="<?php echo $faculty_id ?>" hidden>
        <input type="text" name="id" id="" value="<?php echo $id ?>" hidden>
        <div class="form-row form-inline mb-4">
            <div class="col-md-4">
                <label for="faculty_name" class="col-form-label">Faculty Name :</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="faculty_name" id="faculty_name" class="form-control" required value="<?php echo   $faculty_name  ?>" readonly>
            </div>
        </div>
        <div class="form-row form-inline mb-4">
            <div class=" col-md-4">
                <label for="faculty_workshop_name" class="col-form-label">Workshop Title :</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="faculty_workshop_name" id="faculty_workshop_name" class="form-control" required value="<?php echo $work_name ?>">
            </div>
        </div>
        <div class="form-row form-inline mb-4">
            <div class="col-md-4">
                <label for="faculty_workshop_title" class="col-form-label">Workshop Organized By :</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="faculty_workshop_title" id="faculty_workshop_title" class="form-control" required value="<?php echo  $work_title ?>">
            </div>
        </div>
        <div class="form-row form-inline mb-3">
            <div class="col-md-4">
                <label for="faculty_workshop_no_of_days" class="col-form-label">No of Days Conducted :</label>
            </div>
            <div class="col-md-4">
                <input type="text" name="faculty_workshop_no_of_days" id="faculty_workshop_no_of_days" class="form-control" required value="<?php echo  $work_days ?>">
            </div>
        </div>
        <div class="">
            <button type="submit" value="Submit" class="btn btn-primary"> Update</button>
        </div>
    </form>
    <?php

    ?>





</div>
<!-- page content end -->


<?php include("../template/footer-fac.php") ?>