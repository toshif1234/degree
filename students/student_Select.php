<?php 

    include_once "../template/admin-auth.php";
    include_once "../template/sidebar-admin.php";
error_reporting(0);
require_once "../config.php";
    $q="select distinct batch from students";
    $q1="select distinct branch from students";
    $res=$link->query($q);
    $res1=$link->query($q1);

?>

<div class="container">
    <form action="student_view_details.php" method="post">
        <div class="row">
            
            <div class="col-md-4 mt-4">
                <label for="branch" class="">Select Course:</label>
                <select name="branch" id="branch" class="form-control">
                    <option selected disabled>Select Course</option>
                    <?php
                        foreach($res1 as $r){
                    ?>
                    <option value="<?php echo $r["branch"] ?>"><?php echo $r["branch"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mt-4">
                <label for="batch" class="">Select Batch:</label>
                <select name="batch" id="batch" class="form-control">
                    <option selected disabled>Select Batch</option>
                    <?php
                        foreach($res as $r){
                    ?>
                    <option value="<?php echo $r["batch"] ?>"><?php echo $r["batch"] ?></option>
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
</div>


<?php 
    include_once "../template/footer-admin.php";
?>
