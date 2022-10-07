<?php 
include("../template/fac-auth.php");
include("../template/sidebar-fac.php");
$q = 'select * from dept_pso';
$result = $link->query($q);

?>

    <div class="container">
    <form action="./user_privilege.php" method="post">
        <div class="row">
            
                <div class="col col-12 col-md-6 col-lg-6 mt-2">
                    <select name="dept" class="form-control" id="dept">
                        <option selected disabled>Select Department</option>
                        <?php
                            foreach($result as $r){
                        ?>
                        <option value="<?php echo $r['dept_name'] ?>"><?php echo $r['dept_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                
                <div class="col col-12 col-md-6 col-lg-6 mt-2">
                    <button type="submit" class="btn btn-primary ">Submit</button>
                </div>
            
        </div>
        </form> 
    </div>




<?php include("../template/footer-fac.php") ?>