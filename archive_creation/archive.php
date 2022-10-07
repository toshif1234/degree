<?php 
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
$q = 'select * from dept_pso';
$q1 = 'select distinct semester FROM students ';
$result = $link->query($q);
$r1 = $link -> query($q1);
?>

    <div class="container">
    <form action="transferdata.php" method="post">
        <div class="row">

        <div class="col col-12 col-md-4 col-lg-4 mt-2">
                    <select name="sem" class="form-control" id="sem">
                        <option selected disabled>Select Semester</option>
                        <?php
                            foreach($r1 as $r){
                        ?>
                        <option value="<?php echo $r['semester'] ?>"><?php echo $r['semester'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            
                <!-- <div class="col col-12 col-md-4 col-lg-4 mt-2">
                    <select name="dept" class="form-control" id="dept">
                        <option selected disabled>Select Department</option>
                        <?php
                            foreach($result as $r){
                        ?>
                        <option value="<?php echo $r['dept_name'] ?>"><?php echo $r['dept_name'] ?></option>
                        <?php } ?>
                    </select>
                </div> -->
                
                <div class="col col-12 col-md-4 col-lg-4 mt-2">
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            
        </div>
        </form> 
    </div>




<?php include("../template/footer-admin.php") ?>