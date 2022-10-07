<?php 
require_once "../config.php";
include("../template/admin-auth.php");
error_reporting(0);

include("../template/sidebar-admin.php");
$con=$link;
$q1 = "select distinct branch from subjects";
                    // echo $q1;
     $result = $con->query($q1);

?>

<div class="container">
    <form action="view_sub.php" method="post">
        <div class="row">
            <div class="col-md-4">
                <select name="branch" class="form-control">
                    <option selected disabled>Select Branch </option>
                    <?php
                foreach($result as $r){                
                    echo "<option value=\"" . $r["branch"] . "\"> " . $r["branch"] . "</option>";
                }?>
                </select>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>





<?php
include("../template/footer-admin.php");
?>