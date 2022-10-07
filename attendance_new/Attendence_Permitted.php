<?php 

    include_once "../template/fac-auth.php";
    include_once "../template/sidebar-fac.php";
    require_once "../config.php";
    $q="select distinct semester from students";
    $q1="select distinct branch from students";
    $res=$link->query($q);
    $res1=$link->query($q1);

?>

<div class="container">
    <form action="display_Permitted_Attendance.php" method="post">
        <div class="row">
            
            <div class="col-md-4 mt-4">
                <label for="branch" class="">Select Branch:</label>
                <select name="branch" id="branch" class="form-control">
                    <option selected disabled>Select Branch</option>
                    <?php
                        foreach($res1 as $r){
                    ?>
                    <option value="<?php echo $r["branch"] ?>"><?php echo $r["branch"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mt-4">
                <label for="semester" class="">Select Semester:</label>
                <select name="semester" id="semester" class="form-control">
                    <option selected disabled>Select Semester</option>
                    <?php
                        foreach($res as $r){
                    ?>
                    <option value="<?php echo $r["semester"] ?>"><?php echo $r["semester"] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4 mt-4">
                <label for="date" class="">Select Date:</label>
                <input type = "date" name="ldate" class="form-control" required>
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
