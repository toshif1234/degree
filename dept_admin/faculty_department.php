<?php 

    include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
error_reporting(0);
require_once "../config.php";
    
    $q1="select distinct faculty_dept from faculty_details";
    
    $res1=$link->query($q1);

?>
<form action="faculty_view_details.php" method="post">
        <div class="row">
            
            <div class="col-md-4 mt-4">
                <label for="branch" class="">Select Department:</label>
                <select name="branch" id="branch" class="form-control">
                    <option selected disabled>Select Department</option>
                    <?php
                        foreach($res1 as $r){
                    ?>
                    <option value="<?php echo $r["faculty_dept"] ?>"><?php echo $r["faculty_dept"] ?></option>
                    <?php } ?>
                </select>
            </div>
            
        </div>
        <div class="row mt-4">
            <div class="col col-4 col-md-4 col-lg-4">
                <label for="sub" class="mb-2"></label>
                <button type="submit" class="btn btn-info mt-4"> Submit </button>
            </div>
        </div>
</form>
<?php 
    include_once "../template/footer-admin.php";
?>
