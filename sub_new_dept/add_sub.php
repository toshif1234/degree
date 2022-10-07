<?php 
require_once "../config.php";
include("../template/fac-auth.php");
                        // error_reporting(0);

include("../template/sidebar-fac.php");
if (isset($_SESSION["sub_error"]) && $_SESSION["sub_error"] == 1) {
    $_SESSION["sub_error"] = 0;
    echo '<div style="width:50%;" class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Subject Already Exists</strong> 
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>

<?php $q="select distinct branch from students";
$result=$link->query($q);
$q1="select distinct semester from students";
$result1=$link->query($q1);
?>
<div class="container">
    <form action="add_sub_proc.php" method="POST">
        <div class="row">
            <div class="col-sm-12 col-md-5">
                <div class="form-group ">
                    <label for="Branch">Branch:</label>
                    <select name="branch" id="" class="form-control">

                        <option id="Branch" selected>Branch</option>
                        <?php
                                foreach($result as $r)
                                {
                            ?>
                        <option value="<?php echo $r["branch"]  ?>"><?php echo $r["branch"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- <div class="col-md-2"></div> -->
            <div class="col-sm-12 col-md-5">
                <div class="form-group ">
                    <label for="Semester">Semester:</label>

                    <select name="sem" id="" class="form-control">
                        <option selected id="Semester">Semester </option>
                        <?php
                                foreach($result1 as $r1)
                                {
                            ?>
                        <option value="<?php echo $r1["semester"]  ?>"><?php echo $r1["semester"]  ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-12 col-md-5">
                <div class="form-group ">
                    <div>
                        <label for="sub_name">Subject Name:</label>
                        <input type="text" name="sub_name" class="form-control" required>
                    </div>
                </div>
            </div>
            <!-- <div class="col-md-1"></div> -->
            <div class="col-sm-12 col-md-5">
                <div class="form-group ">
                    <div>
                        <label for="sub_code">Subject Code:</label>
                        <input type="text" name="sub_code" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
        </div>
        <div class="row mt-4">

            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="open_elective">Open Elective : </label>
                        <input  class="form-check-input" id="open_elective" value="1" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="pro_elective">Professional Elective : </label>
                        <input  class="form-check-input" id="pro_elective" value="2" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="lab">Lab : </label>
                        <input  class="form-check-input" id="lab" value="3" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="internship">Internship : </label>
                        <input  class="form-check-input" id="internship" value="4" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="seminar">Seminar : </label>
                        <input  class="form-check-input" id="seminar" value="5" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                        <label class="form-check-label p-1"  for="project">Project : </label>
                        <input  class="form-check-input" id="project" value="6" type="radio" name="type" style="width: 20px; height: 20px;">
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-sm-12 col-md-4">
                <button class="btn btn-info" type="submit">ADD</button>
            </div>
        </div>
    </form>
</div>

</div>


</div>
<!-- page content end -->
<?php

include "../template/footer-admin.php";